<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * Middleware: ProductMiddleware
 * 
 * Automatically generated via CLI.
 */
class ProductMiddleware
{
    /**
     * Handle the incoming request
     *
     * @param Closure $next
     * @return mixed
     */
    public function handle(Closure $next)
    {
        $lava = lava_instance();
        $lava->call->library('session');

        $username = $lava->session->userdata('username');
        $password = $lava->session->userdata('password');

        // Kick back to login (/) if not authorized
        if ($username !== 'hello' || $password !== 'world') {
            redirect('/');
            exit();
        }
         // TODO: Add your middleware logic here (authentication, authorization, etc.)

        return $next();
    }
}
