<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: StudentController
 * 
 * Automatically generated via CLI.
 */
class StudentController extends Controller {
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['student_access'] = true;
        $this->call->view('student/index');
    }

    public function profile(){
        // No manual middleware calls needed here!
        $data = [
            'student_id'   => 'MCC2024-00264',
            'name'         => 'Melanie Bartolome Hidalgo',
            'course'       => 'Bachelor of Science in Information Technology',
            'year_section' => '3-F6',
            'contact'      => '09264637041',
            'email'        => 'hidalgomelanie23@gmail.com',
            'subject'      => 'Web2'
        ];

        $this->call->view('student/profile', $data);
    }
    
}