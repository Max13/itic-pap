<?php

class ErrorDocument
{
    static public function show404()
    {
        http_response_code(404);
        header('Content-Type: application/json');

        die('Not Found');
    }
}
