<?php

/**
 * Creates the first login account for the API.
 * The username/email/password are read from .env (never written in code).
 */
class seed_admin_user
{

    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->database();
    }

    public function up()
    {
        $username = getenv('ADMIN_USERNAME') ?: 'admin';
        $email    = getenv('ADMIN_EMAIL') ?: 'admin@example.com';
        $password = getenv('ADMIN_PASSWORD');

        if (!$password) {
            throw new Exception('ADMIN_PASSWORD is not set in .env. Set it, then run the migration again.');
        }

        $stmt = $this->_lava->db->raw('SELECT id FROM users WHERE username = ? LIMIT 1', [$username]);
        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            return; // user already exists
        }

        $this->_lava->db->raw(
            'INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)',
            [$username, $email, password_hash($password, PASSWORD_DEFAULT), 'admin']
        );
    }

    public function down()
    {
        $username = getenv('ADMIN_USERNAME') ?: 'admin';
        $this->_lava->db->raw('DELETE FROM users WHERE username = ?', [$username]);
    }
}
