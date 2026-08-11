<?php

/**
 * @since 8.1
 */
class CURLStringFile
{
    public string $data;
    public string $mime;
    public string $postname;

    /**
     * Create a CURLStringFile object
     *
     * Creates a CURLStringFile object, used to upload a file with CURLOPT_POSTFIELDS.
     *
     * @link https://php.net/manual/en/curlstringfile.construct.php
     * @param string $data The contents to be uploaded.
     * @param string $postname The name of the file to be used in the upload data.
     * @param string $mime MIME type of the file (default is application/octet-stream).
     */
    public function __construct(string $data, string $postname, string $mime = 'application/octet-stream') {}
}
