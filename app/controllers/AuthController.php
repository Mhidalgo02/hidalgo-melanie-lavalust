<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->library('api');
        $this->call->database();
    }
    public function login()
    {
        $this->api->require_method('POST');
        $input    = $this->api->body();
        $username = $input['username'] ?? '';
        $password = $input['password'] ?? '';

        if ($username === '' || $password === '') {
            $this->api->respond_error('Username and password are required', 400);
        }

        $stmt = $this->db->raw('SELECT * FROM users WHERE username = ?', [$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !$user['is_active'] || !password_verify($password, $user['password'])) {
            $this->api->respond_error('Invalid credentials', 401);
        }

        $token = $this->api->encode_jwt([
            'sub'  => $user['id'],
            'role' => $user['role'],
        ]);

        $this->api->respond([
            'token' => $token,
            'user'  => [
                'id'       => $user['id'],
                'username' => $user['username'],
                'role'     => $user['role'],
            ],
        ]);
    }
}
