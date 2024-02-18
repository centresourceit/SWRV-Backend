<?php

namespace app\Controllers;
use \CodeIgniter\Controller;

class FileUpload extends Controller {
    
    /**
     * Constructor method for the class.
     * 
     * Initializes the class and loads the 'form' helper.
     */
    public function __construct() {
        helper(['form']);
    }
    
    /**
     * Uploads a file.
     *
     * This method checks if the request method is 'post'. If it is, it retrieves the file from the request and prints its details using print_r. 
     * Then, it terminates the script execution using die. 
     * If the request method is not 'post', it redirects the user to the logout page.
     *
     * @return void
     */
    public function uploadFile() {
        if ($this->request->getMethod()=='post') {
            echo('<pre>');
            die(print_r($this->request->getFile('file')));
        }
        return redirect()->to(base_url() . '/logout');
    }
    
}
