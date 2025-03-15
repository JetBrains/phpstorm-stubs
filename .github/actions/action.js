const core = require('@actions/core');
const github = require('@actions/github');
const {exec} = require('child_process');
const fs = require('fs');
const path = require('path');
const util = require('util');
const execAsync = util.promisify(exec);
const SUBMODULE_PATH = 'meta/attributes/public';
const TEMP_DIR = process.env.TEMP_DIR || 'temp_submodule';
const PHP_FILES_DIR = process.env.PHP_FILES_DIR || 'filtered_submodule';

async function run() {
    try {
        const { token, gitUserName, gitUserEmail } = validateInputs();
        const octokit = github.getOctokit(token);
        const context = github.context;
        const tagName = await getTagName(context.ref);
        const releaseName = `PhpStorm ${tagName.replace('v', '')}`;

        await configureGit(gitUserName, gitUserEmail);

        try {
            await createTemporaryBranch();
            await manageSubmoduleFiles(TEMP_DIR, PHP_FILES_DIR);
        } finally {
            core.info('Cleaning up temporary directories...');
            await cleanupDirs([TEMP_DIR, PHP_FILES_DIR]);
        }

        await commitAndPushChanges(tagName);

        await createGithubRelease(octokit, tagName, releaseName, context);

    } catch (error) {
        core.error(`Run failed: ${error.message}`);
        core.setFailed(error.message);
    }
}

// Top-level error handling
run().catch(error => {
    core.error(`Unhandled error: ${error.message}`);
    core.setFailed(error.message);
});

/**
 * @param {string} dir - The directory to start reading from.
 * @returns {Array<string>} - A flat list of all file paths.
 */
async function readDirRecursively(dir) {
    try {
        const entries = await fs.promises.readdir(dir, { withFileTypes: true });
        const files = await Promise.all(entries.map(async (entry) => {
            const fullPath = path.join(dir, entry.name);
            return entry.isDirectory() ? await readDirRecursively(fullPath) : fullPath;
        }));
        return files.flat();
    } catch (error) {
        core.error(`Error reading directory ${dir}: ${error.message}`);
        throw error;
    }
}


async function configureGit(gitUserName, gitUserEmail) {
    core.info('Configuring Git...');
    try {
        await safeExec(`git config --global user.name "${gitUserName}"`);
        await safeExec(`git config --global user.email "${gitUserEmail}"`);
        core.info(`Git configured successfully with user: ${gitUserName}, email: ${gitUserEmail}`);
    } catch (error) {
        core.error('Failed to configure Git.');
        core.setFailed(error.message);
        throw error;
    }
}

async function manageSubmoduleFiles(tempDir, phpFilesDir) {
    core.info('Initializing and updating submodule...');
    await safeExec('git submodule update --init --recursive');

    core.info('Saving submodule files...');
    await createDir(tempDir)
    await createDir(phpFilesDir);
    await safeExec(`cp -r ${SUBMODULE_PATH}/*  ${tempDir}`);
    await copyPhpFiles(tempDir, phpFilesDir);

    core.info('Removing submodule...');
    await safeExec(`git submodule deinit -f -- ${SUBMODULE_PATH}`);
    await safeExec(`git rm -f ${SUBMODULE_PATH}`);
    await safeExec(`rm -rf .git/modules/${SUBMODULE_PATH}`);

    core.info('Restoring filtered PHP files...');
    await fs.promises.mkdir(`${SUBMODULE_PATH}`, { recursive: true });
    await safeExec(`cp -r ${phpFilesDir}/* ${SUBMODULE_PATH}`);
}

async function copyPhpFiles(sourceDir, destinationDir) {
    const phpFiles = [];
    const allFiles = await readDirRecursively(sourceDir);

    await Promise.all(
        allFiles.map(async (filePath) => {
            if (filePath.endsWith('.php')) {
                const fileName = path.basename(filePath);
                const destPath = path.join(destinationDir, fileName);
                phpFiles.push(filePath);
                await fs.promises.copyFile(filePath, destPath);
            }
        })
    );

    return phpFiles;
}

async function createTemporaryBranch() {
    const tempBranch = `release-${Date.now()}`;
    core.info(`Creating temporary branch ${tempBranch}...`);
    await safeExec(`git checkout -b ${tempBranch}`);
}

async function commitAndPushChanges(tagName) {
    core.info('Committing changes...');
    await safeExec('git add -f ' + SUBMODULE_PATH);
    await safeExec('git commit -m "Convert submodule to regular files for release"');

    core.info('Updating and pushing tag...');
    await safeExec(`git tag -f ${tagName}`);
    await safeExec('git push origin --force --tags');
}

async function getTagName(ref) {
    if (!ref.startsWith('refs/tags/')) {
        core.error(`Invalid ref: ${ref}. This action should be triggered by a tag push.`);
        throw new Error('This action expects a tag push event.');
    }
    const tagName = ref.replace('refs/tags/', '');
    core.info(`Tag identified: ${tagName}`);
    return tagName;
}

async function createGithubRelease(octokit, tagName, releaseName, context) {
    core.info(`Creating release ${releaseName} from tag ${tagName}...`);
    const release = await octokit.rest.repos.createRelease({
        ...context.repo,
        tag_name: tagName,
        name: releaseName,
        body: 'Automated release including submodule files',
        draft: false,
        prerelease: false
    });

    core.info('Release created successfully!');
    core.setOutput('release-url', release.data.html_url);
}

async function cleanupDirs(directories) {
    try {
        await Promise.all(
            directories.map(async (directory) => {
                await fs.promises.rm(directory, { recursive: true, force: true });
                core.info(`Successfully cleaned: ${directory}`);
            })
        );
    } catch (error) {
        core.warning(`Error during cleanup: ${error.message}`);
    }
}

function validateInputs() {
    const token = core.getInput('github-token', { required: true });
    const gitUserName = core.getInput('git-user-name') || 'GitHub Action';
    const gitUserEmail = core.getInput('git-user-email') || 'action@github.com';

    if (!token) {
        throw new Error('A valid GitHub Token is required to authenticate.');
    }

    return { token, gitUserName, gitUserEmail };
}

async function createDir(directory) {
    try {
        await fs.promises.mkdir(directory, { recursive: true });
        core.info(`Directory created: ${directory}`);
    } catch (error) {
        core.error(`Failed to create directory: ${directory}`);
        throw error;
    }
}

async function safeExec(command) {
    try {
        const { stdout, stderr } = await execAsync(command);
        if (stderr) {
            core.warning(`Command warning: ${stderr}`);
        }
        return stdout.trim();
    } catch (error) {
        core.error(`Command failed: ${command}`);
        core.error(`Error: ${error.message}`);
        throw error;
    }
}
