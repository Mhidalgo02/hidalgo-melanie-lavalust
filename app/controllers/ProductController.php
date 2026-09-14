<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: ProductController
 * 
 * Automatically generated via CLI.
 */
class ProductController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->Model('ProductModel');
        $this->call->database();
    }

    public function index()
    {
        // 1. Process form submission when a POST request is sent
        if ($this->request->is_post()) {
            $usernameInput = $this->request->post('username');
            $passwordInput = $this->request->post('password');

            if ($usernameInput === 'hello' && $passwordInput === 'world') {
                $this->call->library('session');
                $this->session->set_userdata([
                    'username'  => $usernameInput,
                    'password'  => $passwordInput,
                    'logged_in' => true
                ]);

                redirect('/products');
                return;
            }

            // If credentials don't match, reload the login page
            redirect('/');
            return;
        }

        // 2. Display the login view for standard GET requests
        $this->call->view('product/login');
    }


    public function display()
    {
        $data['records'] = $this->ProductModel->all();
        $this->call->view('product/products', $data);
    }

    public function create()
    {
       
        if($this->request->is_post()) {
            $this->ProductModel->insert([
                'product_name' => $this->request->post('product_name'),
                'description' => $this->request->post('description'),
                'quantity' => $this->request->post('quantity'),
                'price' => $this->request->post('price'),
            ]);

            redirect('/products');
            return;
        }
        $this->call->view('product/create');
    }
/*
    public function edit($id)
    {
        $data['record'] = $this->ProductModel->find($id);

        if (!$data['record']) {
            redirect('/products');
            return;
        }

        $this->call->view('/products/edit', $data);
    }
    
    public function update($id)
    {
        if($this->request->is_post()) {
            $data = [
                'product_name' => $this->request->post('product_name'),
                'description' => $this->request->post('description'),
                'quantity' => $this->request->post('quantity'),
                'price' => $this->request->post('price'),
            ];
            $this ->ProductModel->update($id, $data);
            redirect('/products');
            return;
        }
    }
*/
    public function edit($id)
    {
        $data['record'] = $this->ProductModel->find($id);

        if (!$data['record']) {
            redirect('/products');
            return;
        }
        if ($this->request->is_post()) {
            $this->ProductModel->update_data($id, [
                'product_name' => $this->request->post('product_name'),
                'description' => $this->request->post('description'),
                'quantity' => $this->request->post('quantity'),
                'price' => $this->request->post('price')
            ]);
            redirect('/products');
        }
        $this->call->view('product/edit', $data);
    }

    public function delete($id)
    {
        $this->ProductModel->delete($id);
        redirect('/products');
    }

    public function logout()
    {
        $this->call->library('session');
        $this->session->unset_userdata(['username', 'password', 'logged_in']);
        $this->session->sess_destroy();

        redirect('/');
        return;
    }
}