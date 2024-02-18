<?php

namespace app\Controllers;
use \CodeIgniter\Controller;
use App\Models\LoginModel;

class Page extends Controller {
    
    public $loginModel;
    
    /**
     * Class constructor.
     * Initializes the LoginController object by loading the 'form' helper and creating a new instance of the LoginModel.
     */
    public function __construct() {
        helper(['form']);
        $this->loginModel = new LoginModel();
    }
    
    public function index() {
        $data = [];
        $userData = $this->loginModel->getLoggedInUser();
        if (is_null($userData)) {
            return redirect()->to(base_url() . "/logout");
        } else {
            $data['userData'] = $userData;
            echo('Working ' . time());
        }
    }
    
}
