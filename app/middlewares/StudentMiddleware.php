<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * Middleware: StudentMiddleware
 * 
 * Automatically generated via CLI.
 */
class StudentMiddleware
{
    /**
     * Handle the incoming request
     *
     * @param Closure $next
     * @return mixed
     */
    public function handle(Closure $next)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['student_access']) || $_SESSION['student_access'] !== true) {
            header('Location: /student');
            exit;
        }

        return $next();
    }
}
