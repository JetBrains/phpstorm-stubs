<?php

/**
 * CURLStringFile makes it possible to upload a file directly from a variable. This is similar to
 * CURLFile, but works with the contents of the file, not filename. This class or CURLFile should be
 * used to upload the contents of the file with CURLOPT_POSTFIELDS.
 * @link https://php.net/manual/en/class.curlstringfile.php
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
