<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: UsersController
 * 
 * Automatically generated via CLI.
 */
class UsersController extends Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function users()
    {
        $this->call->model("UsersModel");
        $this->call->database();
        $users = $this->UsersModel->all();
        $this->call->view("user", ['users' => $users]);
    }
}