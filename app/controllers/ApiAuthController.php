<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class ApiAuthController extends Controller
{
    public function before_action()
    {
        $this->call->library('api');   // CORS + answers browser preflight (OPTIONS)
        $this->call->database();
    }

    // POST /api/login  { "username": "...", "password": "..." }
    public function login()
    {
        // Read the raw JSON so the password is not altered by the API library's HTML-escaping.
        $input    = json_decode(file_get_contents('php://input'), true);
        $username = is_array($input) ? trim((string)($input['username'] ?? '')) : '';
        $password = is_array($input) ? (string)($input['password'] ?? '') : '';

        if ($username === '' || $password === '') {
            $this->api->respond_error('Username and password are required.', 422);
        }

        $user = $this->db->table('users')->where('username', $username)->get();

        if (!$user || empty($user['is_active']) || !password_verify($password, $user['password'])) {
            $this->api->respond_error('Invalid username or password.', 401);
        }

        $tokens = $this->api->issue_tokens([
            'id'     => $user['id'],
            'role'   => $user['role'],
            'scopes' => ['read', 'write'],
        ]);

        $this->api->respond([
            'message' => 'Login successful',
            'user'    => [
                'id'       => $user['id'],
                'username' => $user['username'],
                'role'     => $user['role'],
            ],
            'tokens'  => $tokens,
        ]);
    }

    // POST /api/refresh  { "refresh_token": "..." }
    public function refresh()
    {
        $data  = $this->api->body();
        $token = $data['refresh_token'] ?? '';

        if ($token === '') {
            $this->api->respond_error('refresh_token is required.', 422);
        }

        $this->api->refresh_access_token($token); // sends the response itself
    }

    // POST /api/logout  (needs Bearer token)  { "refresh_token": "..." }
    public function logout()
    {
        $this->api->require_jwt();

        $data  = $this->api->body();
        $token = $data['refresh_token'] ?? '';

        if ($token !== '') {
            $this->api->revoke_refresh_token($token);
        }

        $this->api->respond(['message' => 'Logged out']);
    }
}
