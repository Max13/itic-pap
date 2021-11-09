<?php

class Auth
{
    static public function login()
    {
        header('Content-Type: application/json');

        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;

        // Fake login
        if ($username && $password && $username == $password) {
            die(json_encode([
                'id' => random_int(1, 10),
                'username' => $username,
                'firstname' => ucfirst($username),
                'lastname' => strtoupper($username),
                'current_points' => random_int(0, 12),
                'max_points' => 12,
            ]));
        }

        http_response_code(403);
        die('Invalid credentials');
    }
}
