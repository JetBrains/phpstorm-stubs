<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->append(['.php_cs'])
    ->notName('PhpStormStubsMap.php')
;

$cacheDir = getenv('TRAVIS') ? getenv('HOME') . '/.php-cs-fixer' : __DIR__;

return PhpCsFixer\Config::create()
    ->setRules([
        'no_trailing_whitespace' => true,
        'no_trailing_whitespace_in_comment' => true,
        'no_whitespace_in_blank_line' => true,
        'single_blank_line_at_eof' => true,
        'line_ending' => true,
        'no_blank_lines_after_phpdoc' => true,
        'no_empty_comment' => true,
        'no_empty_phpdoc' => true,
        'non_printable_character' => true,
        'phpdoc_no_access' => true,
        'phpdoc_no_useless_inheritdoc' => true,
        'phpdoc_trim' => true,
        'phpdoc_trim_consecutive_blank_line_separation' => true,
        'phpdoc_var_annotation_correct_order' => true,
        'phpdoc_var_without_name' => true
        // 'unix_line_endings' => true,
    ])
    ->setFinder($finder)
    ->setCacheFile($cacheDir . '/.php_cs.cache')
;
