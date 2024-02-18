<?php

namespace app\Controllers;
use \CodeIgniter\Controller;
use App\Models\LoginModel;

class Service extends Controller {
    
    public $loginModel;
    
    /**
     * Constructor for the class.
     * Initializes the form helper and creates a new instance of the LoginModel.
     */
    public function __construct() {
        helper('form');
        $this->loginModel = new LoginModel();
    }
    
    /**
     * Retrieves the index page.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse|\CodeIgniter\View\View
     */
    public function index() {
        $data = [];
        $userData = $this->loginModel->getLoggedInUser();
        if (is_null($userData)) {
            return redirect()->to(base_url() . "/logout");
        } else {
            $data['userData'] = $userData;
            return view('service/list',$data);
        }
    }
    
    /**
     * Retrieve the list of services.
     *
     * This method retrieves the list of services and returns a view with the data.
     * If the user is not logged in, it redirects to the logout page.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse|\CodeIgniter\View\View
     */
    public function list() {
        $data = [];
        $userData = $this->loginModel->getLoggedInUser();
        if (is_null($userData)) {
            return redirect()->to(base_url() . "/logout");
        } else {
            $data['userData'] = $userData;
            return view('service/list',$data);
        }
    }
}
