<?php
declare(strict_types=1);
$descriptorspec = array(
    0 => array('pipe', 'r'),  // stdin is a pipe that the child will read from
    1 => array('pipe', 'w'),  // stdout is a pipe that the child will write to
    2 => array('file', '/tmp/error-output.txt', 'a') // stderr is a file to write to
);
proc_open("ls", $descriptorspec, $pipes, null);
var_dump((new ReflectionFunction("proc_open"))->getParameters()[3]->getType()->allowsNull());