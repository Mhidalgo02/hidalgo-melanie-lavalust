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
    { // 1. Get the LavaLust framework instance correctly
        $lava = $get_instance();

        // 2. Explicitly load session library
        $lava->call->library('session');

        // 3. Check if user is logged in
        if (!$lava->session->userdata('logged_in')) {
            redirect('/');
            exit(); // Stop execution immediately
        }

        return $next();
    }
}
