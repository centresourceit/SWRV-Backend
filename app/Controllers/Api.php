<?php

namespace app\Controllers;

use CodeIgniter\HTTP\URI;
use CodeIgniter\HTTP\CURLRequest;

use \CodeIgniter\Controller;
use App\Models\ApiModel;
use App\Models\CityModel;
use App\Models\StateModel;
use App\Models\CountryModel;
use App\Models\BrandModel;
use App\Models\CampaignModel;
use App\Models\MarketModel;
use App\Models\UserModel;
use App\Models\LoginModel;
use App\Models\HandleModel;
use App\Models\VillageModel;
use App\Models\CategoryModel;
use App\Models\LanguageModel;
use App\Models\InboxMsgModel;
use App\Models\CampaignInviteModel;
use App\Models\ReviewModel;
use App\Models\PayReqModel;
use App\Models\CampaignDraftModel;
use App\Models\DashboardModel;
use App\Models\NEBModel;
use App\Models\ContactDisputeModel;
use App\Models\BidModel;
use App\Models\InstaHandleModel;
use App\Models\HomeModel;
use App\Models\FilterModel;

class Api extends Controller
{

    public $session;
    public $apiModel;
    public $cityModel;
    public $stateModel;
    public $countryModel;
    public $marketModel;
    public $brandModel;
    public $campaignModel;
    public $userModel;
    public $loginModel;
    public $handleModel;
    public $villageModel;
    public $categoryModel;
    public $languageModel;
    public $dashboardModel;
    public $inboxMsgModel;
    public $campaignDraftModel;
    public $campaignInviteModel;
    public $reviewModel;
    public $payReqModel;
    public $nebModel;
    public $contactDisputeModel;
    public $bidModel;
    public $instaHandleModel;
    public $homeModel;
    public $filterModel;

    public function __construct()
    {
        helper(['form']);
        $this->apiModel = new ApiModel();
        $this->cityModel = new CityModel();
        $this->stateModel = new StateModel();
        $this->countryModel = new CountryModel();
        $this->marketModel = new MarketModel();
        $this->userModel = new UserModel();
        $this->brandModel = new BrandModel();
        $this->loginModel = new LoginModel();
        $this->reviewModel = new ReviewModel();
        $this->payReqModel = new PayReqModel();
        $this->handleModel = new HandleModel();
        $this->villageModel = new VillageModel();
        $this->categoryModel = new CategoryModel();
        $this->campaignModel = new CampaignModel();
        $this->inboxMsgModel = new InboxMsgModel();
        $this->languageModel = new LanguageModel();
        $this->dashboardModel = new DashboardModel();
        $this->campaignDraftModel = new CampaignDraftModel();
        $this->campaignInviteModel = new CampaignInviteModel();
        $this->nebModel = new NEBModel();
        $this->contactDisputeModel = new ContactDisputeModel();
        $this->bidModel = new BidModel();
        $this->instaHandleModel = new InstaHandleModel();
        $this->homeModel = new HomeModel();
        $this->filterModel = new FilterModel();

        $this->session = \Config\Services::session();

        $this->session->start();

        Header('Access-Control-Allow-Origin: *');
        Header('Access-Control-Allow-Headers: *');
        Header('Access-Control-Allow-Options: *');
        Header('Access-Control-Allow-Methods: *');
        Header('X-Content-Type-Options: *');
    }

    /**
     * Destroy the session and redirect to the index page.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function index()
    {
        $this->session->destroy();
        return redirect()->to(base_url() . "/index");
    }

    /**
     * Registers a new user.
     *
     * This method is responsible for registering a new user by validating the provided email, password, and confirm password.
     * If the validation passes, the user is created in the database with the provided details.
     * If the validation fails, an error message is returned indicating the validation errors.
     *
     * @return void
     */
    public function register()
    {
        $this->session->destroy();
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "register"];
        $rules = [
            'email' => [
                'rules' => 'required|min_length[6]|max_length[32]|valid_email|is_unique[user.userEmail]',
                'errors' => [
                    'required' => 'Email is REQUIRED',
                    'min_length' => 'Email {value} Should be GREATER THAN {param} Character(s)',
                    'max_length' => 'Email {value} Should be LESS THAN {param} Character(s)',
                    'valid_email' => 'Email {value} is NOT VALID',
                    'is_unique' => 'Email {value} Already Exists',
                ],
            ],
            'password' => [
                'rules' => 'required|min_length[6]|max_length[32]',
                'errors' => [
                    'required' => 'Password is REQUIRED',
                    'min_length' => 'Password {value} Should be GREATER THAN {param} Character(s)',
                    'max_length' => 'Password {value} Should be LESS THAN {param} Character(s)',
                ],
            ],
            'confirm-password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Confirm Password is REQUIRED',
                    'matches' => 'Password and Confirm Password DOES NOT MATCH',
                ],
            ],
        ];
        if ($this->validate($rules)) {
            $email = $this->request->getVar('email');
            $isBrand = $this->request->getVar('isBrand');
            $isInfluencer = $this->request->getVar('isInfluencer');
            $role = (((!isset($isBrand)) || (is_null($isBrand)) || (empty($isBrand))) ? (((!isset($isInfluencer)) || (is_null($isInfluencer)) || (empty($isInfluencer))) ? (10) : ((intval($isBrand) == 1) ? (10) : (10))) : ((intval($isBrand) == 1) ? (50) : (10)));
            $data['message'] = $this->apiModel->isValidEmail($email, ($role == 50));
            if ($data['message'] == 'success') {
                $password = $this->request->getVar('password');
                $data['message'] = $this->apiModel->isValidPassword($password, 6, 32, true, true, true, true);
                if ($data['message'] == 'success') {
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $id = $this->userModel->createUser(array("userName" => $email, "userPassword" => $password, "userEmail" => $email, "userRole" => $role, "userStatus" => 1));
                    if ($id > 0) {
                        $data = ["status" => true, "data" => ["id" => $id], "message" => "success", "command" => "register"];
                    } else {
                        $data['message'] = "Unable to Add New User";
                    }
                }
            }
        } else {
            $data['message'] = $this->validator->getError('email');
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('password');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('confirm-password');
            }
        }
        return die(json_encode($data));
    }

    /**
     * Logs in the user.
     *
     * This method destroys the current session and performs user login based on the provided email and password.
     * It validates the email and password using the specified rules and returns a JSON response with the login status,
     * user data, message, and command.
     *
     * @return void
     */
    public function login()
    {
        $this->session->destroy();
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "login"];
        $rules = [
            'email' => [
                'rules' => 'required|min_length[6]|max_length[32]|valid_email',
                'errors' => [
                    'required' => 'Email is REQUIRED',
                    'min_length' => 'Email {value} Should be GREATER THAN {param} Character(s)',
                    'max_length' => 'Email {value} Should be LESS THAN {param} Character(s)',
                    'valid_email' => 'Email {value} is NOT VALID',
                ],
            ],
            'password' => [
                'rules' => 'required|min_length[6]|max_length[32]',
                'errors' => [
                    'required' => 'Password is REQUIRED',
                    'min_length' => 'Password {value} Should be GREATER THAN {param} Character(s)',
                    'max_length' => 'Password {value} Should be LESS THAN {param} Character(s)',
                ],
            ],
        ];
        if ($this->validate($rules)) {
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');
            $user = $this->userModel->verifyUser($email);
            if (!isset($user) || is_null($user) || count($user) <= 0) {
                $data['message'] = "User " . $email . " NOT FOUND";
            } else if (password_verify($password, $user['userPassword'])) {
                $user = $this->apiModel->flattenToMultiDimensional($this->userModel->findOneUser($user['id']));
                $user['brand'] = $this->apiModel->flattenToMultiDimensional($this->brandModel->findOneBrand($user['brandId']));
                $user['categories'] = $this->apiModel->flattenToMultiDimensional($this->categoryModel->findCategoriesByUser($user['id']));
                $user['languages'] = $this->apiModel->flattenToMultiDimensional($this->languageModel->findLanguagesByUser($user['id']));
                $user['platforms'] = $this->apiModel->flattenToMultiDimensional($this->handleModel->findHandlesByUser($user['id']));
                $user['profileCompleteness'] = $this->apiModel->checkProfileCompleteness($user);
                $data = ["status" => true, "data" => $user, "message" => "success", "command" => "login"];
            } else {
                $data['message'] = "INVALID CREDENTIALS";
            }
        } else {
            $data['message'] = $this->validator->getError('email');
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('password');
            }
        }
        return die(json_encode($data));
    }

    /**
     * Logs in the admin user.
     *
     * This method destroys the current session and performs validation on the provided username and password.
     * If the validation passes, the method attempts to log in the user by calling the `adminLogin` method of the `userModel`.
     * If the login is successful, the method returns a JSON response with a status of true, the user data, a success message, and the command "login".
     * If the login fails, the method returns a JSON response with a status of false, an empty data array, an error message, and the command "login".
     *
     * @return void
     */
    public function adminLogin()
    {
        $this->session->destroy();
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "login"];
        $rules = [
            'userName' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Email is REQUIRED',
                ],
            ],
            'password' => [
                'rules' => 'required|min_length[6]|max_length[32]',
                'errors' => [
                    'required' => 'Password is REQUIRED',
                    'min_length' => 'Password {value} Should be GREATER THAN {param} Character(s)',
                    'max_length' => 'Password {value} Should be LESS THAN {param} Character(s)',
                ],
            ],
        ];
        if ($this->validate($rules)) {
            $username = $this->request->getVar('userName');
            $password = md5($this->request->getVar('password'), false);
            $user = array();
            $user["user"] = $this->apiModel->flattenToMultiDimensional($this->userModel->adminLogin($username, $password));
            if (!isset($user["user"]) || empty($user["user"]) || is_null($user["user"])) {
                $data['message'] = "INVALID CREDENTIALS";
            } else {
                $data = ["status" => true, "data" => $user["user"], "message" => "success", "command" => "login"];
            }
        } else {
            $data['message'] = $this->validator->getError('userName');
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('password');
            }
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves the user profile data.
     *
     * @return void
     */
    public function userProfile()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "userProfile"];
        $id = $this->request->getVar('id');
        if (!isset($id) || is_null($id) || ($id) <= 0) {
            $data['message'] = "INVALID USER ID";
        } else {
            $user = $this->apiModel->flattenToMultiDimensional($this->userModel->findOneUser($user['id']));
            $user['brand'] = $this->apiModel->flattenToMultiDimensional($this->brandModel->findOneBrand($user['brandId']));
            $user['categories'] = $this->apiModel->flattenToMultiDimensional($this->categoryModel->findCategoriesByUser($user['id']));
            $user['languages'] = $this->apiModel->flattenToMultiDimensional($this->languageModel->findLanguagesByUser($user['id']));
            $user['platforms'] = $this->apiModel->flattenToMultiDimensional($this->handleModel->findHandlesByUser($user['id']));
            $user['profileCompleteness'] = $this->apiModel->checkProfileCompleteness($user);
            $data = ["status" => true, "data" => $user, "message" => "success", "command" => "userProfile"];
        }
        return die(json_encode($data));
    }

    /**
     * Adds a new handle.
     *
     * This method is responsible for adding a new handle based on the provided data. It performs validation on the required fields and returns a JSON response with the status, data, message, and command.
     *
     * @return void
     */
    public function addNewHandle()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "addNewHandle"];
        $rules = [
            'userId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'userId is REQUIRED',
                ],
            ],
            'platformId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'platformId is REQUIRED',
                ],
            ],
            'handleName' => [
                'rules' => 'required|min_length[3]|max_length[32]',
                'errors' => [
                    'required' => 'handleName is REQUIRED',
                    'min_length' => 'handleName {value} Should be GREATER THAN {param} Character(s)',
                    'max_length' => 'handleName {value} Should be LESS THAN {param} Character(s)',
                ],
            ],
        ];
        if ($this->validate($rules)) {
            $user = [];
            $userId = $this->request->getVar('userId');
            $platformId = $this->request->getVar('platformId');
            $handleName = $this->request->getVar('handleName');
            $user['id'] = $userId;
            $handleId = $this->handleModel->createHandle(array("userId" => $userId, "platformId" => $platformId, "handleName" => $handleName));
            if ($handleId > 0) {
                $user = $this->apiModel->flattenToMultiDimensional($this->userModel->findOneUser($user['id']));
                $user['brand'] = $this->apiModel->flattenToMultiDimensional($this->brandModel->findOneBrand($user['brandId']));
                $user['categories'] = $this->apiModel->flattenToMultiDimensional($this->categoryModel->findCategoriesByUser($user['id']));
                $user['languages'] = $this->apiModel->flattenToMultiDimensional($this->languageModel->findLanguagesByUser($user['id']));
                $user['platforms'] = $this->apiModel->flattenToMultiDimensional($this->handleModel->findHandlesByUser($user['id']));
                $user['handleId'] = $handleId;
                $data = ["status" => true, "data" => $user, "message" => "success", "command" => "addNewHandle"];
            } else {
                $data['message'] = $this->validator->getError('handleName');
            }
        } else {
            $data['message'] = $this->validator->getError('userId');
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('platformId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('handleName');
            }
        }
        return die(json_encode($data));
    }
    /**
     * Updates the handle based on the provided data.
     *
     * @return void
     */
    public function updateHandle()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "updateHandle"];
        $rules = [
            'id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'id is REQUIRED',
                ],
            ],
            'handleName' => [
                'rules' => 'required|min_length[3]|max_length[32]',
                'errors' => [
                    'required' => 'handleName is REQUIRED',
                    'min_length' => 'handleName {value} Should be GREATER THAN {param} Character(s)',
                    'max_length' => 'handleName {value} Should be LESS THAN {param} Character(s)',
                ],
            ],
        ];
        if ($this->validate($rules)) {
            $id = $this->request->getVar('id');
            $handleName = $this->request->getVar('handleName');
            $handleId = $this->handleModel->updateHandle(array("handleName" => $handleName), $id);
            if ($handleId > 0) {
                $data = ["status" => true, "data" => [], "message" => "success", "command" => "updateHandle"];
            } else {
                $data = ["status" => false, "data" => [], "message" => "unable to update", "command" => "updateHandle"];
            }
        } else {
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('id');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('handleName');
            }
        }
        return die(json_encode($data));
    }

    /**
     * Deletes a handle based on the provided ID.
     *
     * @return void
     */
    public function deleteHandle()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "deleteHandle"];
        $rules = [
            'id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'id is REQUIRED',
                ],
            ],
        ];
        if ($this->validate($rules)) {
            $id = $this->request->getVar('id');
            $handleId = $this->handleModel->updateHandle(array("deletedAt" => date('Y-m-d H:i:s', time())), $id);
            if ($handleId > 0) {
                $data = ["status" => true, "data" => [], "message" => "success", "command" => "deleteHandle"];
            } else {
                $data = ["status" => false, "data" => [], "message" => "unable to update ", "command" => "deleteHandle"];
            }
        } else {
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('id');
            }
        }
        return die(json_encode($data));
    }

    /**
     * Adds a new influencer referral.
     *
     * This method handles the logic for adding a new influencer referral. It takes in the necessary data from the request and performs the following steps:
     * 1. Checks if the user already exists based on the provided email. If so, it returns an error response.
     * 2. Generates a random password and creates a new user with the provided data.
     * 3. Sends a verification email to the user's email address.
     * 4. Returns a success response if the email is sent successfully, or an error response if there is a failure.
     *
     * @return void
     */
    public function addNewInfluencerReferral()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "addNewInfluencerReferral"];

        if (1 == 1) { // $this->validate($rules)
            try {
                $userId = $this->request->getVar('userId');
                $username = $this->request->getVar('name');
                $contact = $this->request->getVar('contact');
                $email = $this->request->getVar('email');
                // if email alredy exist then give the error
                if ($this->userModel->isUserExist($email)) {
                    return die(json_encode(["status" => false, "data" => [], "message" => "User Already exist.", "command" => "addNewInfluencerReferral"]));
                }

                $password = time();
                $password2 = password_hash($password, PASSWORD_DEFAULT);
                $id = $this->userModel->createUser(array('userName' => $username, 'userKnownAs' => $username, 'userPassword' => $password2, 'userEmail' => $email, 'userContact' => $contact, 'referrerUserId' => $userId, 'userStatus' => 1, 'userRole' => 10));
                if ($id > 0) {
                    $nextUrl = "13.233.239.156:8080/verifyuser/" . $email;
                    $emailService = \Config\Services::email();
                    $emailService->setReplyTo('mail.swrv@gmail.com', 'SWRV');
                    $emailService->setFrom('mail.swrv@gmail.com', 'SWRV');
                    $emailService->setBCC('mail.swrv@gmail.com');
                    $emailService->setTo($email);
                    $emailService->setSubject('[SWRV] REFERRAL - Login Credential');
                    $emailService->setMessage(('<!DOCTYPE html><html><head><title>REFERRAL</title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1"><meta http-equiv="X-UA-Compatible" content="IE=edge" /><script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script><style type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"></style><script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script> <style type="text/css"> @media screen { @font-face { font-family: \'Lato\'; font-style: normal; font-weight: 400; src: local(\'Lato Regular\'), local(\'Lato-Regular\'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format(\'woff\'); } @font-face { font-family: \'Lato\'; font-style: normal; font-weight: 700; src: local(\'Lato Bold\'), local(\'Lato-Bold\'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format(\'woff\'); } @font-face { font-family: \'Lato\'; font-style: italic; font-weight: 400; src: local(\'Lato Italic\'), local(\'Lato-Italic\'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format(\'woff\'); } @font-face { font-family: \'Lato\'; font-style: italic; font-weight: 700; src: local(\'Lato Bold Italic\'), local(\'Lato-BoldItalic\'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format(\'woff\'); } } body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; } table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; } img { -ms-interpolation-mode: bicubic; } img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; } table { border-collapse: collapse !important; } body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; } a[x-apple-data-detectors] { color: inherit !important; text-decoration: none !important; font-size: inherit !important; font-family: inherit !important; font-weight: inherit !important; line-height: inherit !important; } @media screen and (max-width:600px) { h1 { font-size: 32px !important; line-height: 32px !important; } } div[style*="margin: 16px 0;"] { margin: 0 !important; } </style></head><body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;"> <table border="0" cellpadding="0" cellspacing="0" width="100%"> <tr> <td bgcolor="#FFA73B" align="center"> <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"> <tr> <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"></td> </tr> </table> </td> </tr> <tr> <td bgcolor="#FFA73B" align="center" style="padding: 0px 10px 0px 10px;"> <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"> <tr> <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;"> <h3 style="font-size: 29px; font-weight: 400; margin: 2;">Welcome ' . $username . '</h3> <img src=" https://img.icons8.com/clouds/100/000000/handshake.png" width="125" height="120" style="display: block; border: 0px;" /> </td> </tr> </table> </td> </tr> <tr> <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"> <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"> <tr> <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <p style="margin: 0; text-align: justify;">You had been referred to SWRV, we\'re excited to have you on our platform. First, you need to confirm your account. Use the following Credential to complete your procedures.</p> </td> </tr> <tr> <td bgcolor="#ffffff" align="left"> <table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;"> <table border="0" cellspacing="0" cellpadding="0"> <tr> <td align="center" style="border-radius: 3px;" bgcolor="#FFA73B"><a href="#" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #FFA73B; display: inline-block;">User Name : ' . $email . '</a><a href="#" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #FFA73B; display: inline-block;">Password : ' . $password . '</a></td> </tr> </table> </td> </tr> </table> </td> </tr><tr> <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> </td> </tr><tr> <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <p style="margin: 0;"><a href="' . $nextUrl . '" target="_blank" style="color: #FFA73B;">Verify Your Email</a></p> </td> </tr> <tr> <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <p style="margin: 0;">If you have any questions, just reply to this email&mdash;we\'re always happy to help out.</p> </td> </tr> <tr> <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <p style="margin: 0;">Cheers,<br />SWRV - Support Team<br/>Center Source</p> </td> </tr> </table> </td> </tr> <tr> <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;"> <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"> <tr> <td bgcolor="#FFECD1" align="center" style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">Need more help?</h2> <p style="margin: 0;"></p> </td> </tr> </table> </td> </tr> <tr> <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"> <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"> <tr> <td bgcolor="#f4f4f4" align="left" style="padding: 0px 30px 30px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;"> <br> <p style="margin: 0;">If these emails get annoying, please feel free to .</p> </td> </tr> </table> </td> </tr> </table></body></html>'));
                    if ($emailService->send()) {
                        return die(json_encode(json_decode(json_encode(array("status" => true, "data" => json_encode(json_decode(json_encode($emailService->printDebugger()), true)), "message" => "Mail Sent Successfully", "code" => "addNewInfluencerReferral")), true)));
                    } else {
                        return die(json_encode(json_decode(json_encode(array("status" => false, "data" => json_encode(json_decode(json_encode($emailService->printDebugger()), true)), "message" => "failed to send email", "code" => "addNewInfluencerReferral")), true)));
                    }
                } else {
                    return die(json_encode(json_decode(json_encode(array("status" => false, "data" => [], "message" => "failed to add user", "code" => "addNewInfluencerReferral")), true)));
                }
            } catch (Exception $ex) {
                return die(json_encode(json_decode(json_encode(array("status" => false, "data" => [], "message" => ($ex->getMessage()), "code" => "addNewInfluencerReferral")), true)));
            }
        } else {
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('userId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('name');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('contact');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('email');
            }
        }
        return die(json_encode($data));
    }

    /**
     * Adds a new brand invite.
     *
     * This function handles the process of adding a new brand invite. It retrieves the necessary data from the request,
     * validates it, and creates a new user with the provided information. It also sends an email to the user with their
     * login credentials.
     *
     * @return void
     */
    public function addNewBrandInvite()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "addNewBrandInvite"];
        if (1 == 1) { // $this->validate($rules)
            try {
                $userId = $this->request->getVar('userId');
                $brandId = $this->request->getVar('brandId');
                $username = $this->request->getVar('name');
                $contact = $this->request->getVar('contact');
                $email = $this->request->getVar('email');
                // if email alredy exist then give the error
                if ($this->userModel->isUserExist($email)) {
                    return die(json_encode(["status" => false, "data" => [], "message" => "User Already exist.", "command" => "addNewInfluencerReferral"]));
                }
                $password = time();
                $password2 = password_hash($password, PASSWORD_DEFAULT);
                $id = $this->userModel->createUser(array('userName' => $username, 'userKnownAs' => $username, 'userPassword' => $password2, 'userEmail' => $email, 'userContact' => $contact, 'referrerUserId' => $userId, 'brandId' => $brandId, 'userStatus' => 1, 'userRole' => 40));
                if ($id > 0) {
                    $nextUrl = "13.233.239.156:8080/verifyuser/" . $email;
                    $emailService = \Config\Services::email();
                    $emailService->setReplyTo('mail.swrv@gmail.com', 'SWRV');
                    $emailService->setFrom('mail.swrv@gmail.com', 'SWRV');
                    $emailService->setBCC('mail.swrv@gmail.com');
                    $emailService->setTo($email);
                    $emailService->setSubject('[SWRV] BRAND INVITE - Login Credential');
                    $emailService->setMessage(('<!DOCTYPE html><html><head><title>BRAND INVITE</title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1"><meta http-equiv="X-UA-Compatible" content="IE=edge" /><script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script><style type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"></style><script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script> <style type="text/css"> @media screen { @font-face { font-family: \'Lato\'; font-style: normal; font-weight: 400; src: local(\'Lato Regular\'), local(\'Lato-Regular\'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format(\'woff\'); } @font-face { font-family: \'Lato\'; font-style: normal; font-weight: 700; src: local(\'Lato Bold\'), local(\'Lato-Bold\'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format(\'woff\'); } @font-face { font-family: \'Lato\'; font-style: italic; font-weight: 400; src: local(\'Lato Italic\'), local(\'Lato-Italic\'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format(\'woff\'); } @font-face { font-family: \'Lato\'; font-style: italic; font-weight: 700; src: local(\'Lato Bold Italic\'), local(\'Lato-BoldItalic\'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format(\'woff\'); } } body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; } table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; } img { -ms-interpolation-mode: bicubic; } img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; } table { border-collapse: collapse !important; } body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; } a[x-apple-data-detectors] { color: inherit !important; text-decoration: none !important; font-size: inherit !important; font-family: inherit !important; font-weight: inherit !important; line-height: inherit !important; } @media screen and (max-width:600px) { h1 { font-size: 32px !important; line-height: 32px !important; } } div[style*="margin: 16px 0;"] { margin: 0 !important; } </style></head><body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;"> <table border="0" cellpadding="0" cellspacing="0" width="100%"> <tr> <td bgcolor="#FFA73B" align="center"> <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"> <tr> <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"></td> </tr> </table> </td> </tr> <tr> <td bgcolor="#FFA73B" align="center" style="padding: 0px 10px 0px 10px;"> <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"> <tr> <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;"> <h3 style="font-size: 29px; font-weight: 400; margin: 2;">Welcome ' . $username . '</h3> <img src=" https://img.icons8.com/clouds/100/000000/handshake.png" width="125" height="120" style="display: block; border: 0px;" /> </td> </tr> </table> </td> </tr> <tr> <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"> <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"> <tr> <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <p style="margin: 0; text-align: justify;">You had been referred to SWRV, we\'re excited to have you on our platform. First, you need to confirm your account. Use the following Credential to complete your procedures.</p> </td> </tr> <tr> <td bgcolor="#ffffff" align="left"> <table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;"> <table border="0" cellspacing="0" cellpadding="0"> <tr> <td align="center" style="border-radius: 3px;" bgcolor="#FFA73B"><a href="#" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #FFA73B; display: inline-block;">User Name : ' . $email . '</a><a href="#" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #FFA73B; display: inline-block;">Password : ' . $password . '</a></td> </tr> </table> </td> </tr> </table> </td> </tr><tr> <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">  </td> </tr><tr> <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <p style="margin: 0;"><a href="' . $nextUrl . '" target="_blank" style="color: #FFA73B;">Verify Your Email</a></p> </td> </tr> <tr> <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <p style="margin: 0;">If you have any questions, just reply to this email&mdash;we\'re always happy to help out.</p> </td> </tr> <tr> <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <p style="margin: 0;">Cheers,<br />SWRV - Support Team<br/>Center Source</p> </td> </tr> </table> </td> </tr> <tr> <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;"> <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"> <tr> <td bgcolor="#FFECD1" align="center" style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">Need more help?</h2> <p style="margin: 0;"></p> </td> </tr> </table> </td> </tr> <tr> <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"> <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"> <tr> <td bgcolor="#f4f4f4" align="left" style="padding: 0px 30px 30px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;"> <br> <p style="margin: 0;">If these emails get annoying, please feel free to .</p> </td> </tr> </table> </td> </tr> </table></body></html>'));
                    if ($emailService->send()) {
                        return die(json_encode(json_decode(json_encode(array("status" => true, "data" => json_encode(json_decode(json_encode($emailService->printDebugger()), true)), "message" => "Mail Sent Successfully", "code" => "addNewBrandInvite")), true)));
                    } else {
                        return die(json_encode(json_decode(json_encode(array("status" => false, "data" => json_encode(json_decode(json_encode($emailService->printDebugger()), true)), "message" => "failed to send email", "code" => "addNewBrandInvite")), true)));
                    }
                } else {
                    return die(json_encode(json_decode(json_encode(array("status" => false, "data" => [], "message" => "failed to add user", "code" => "addNewBrandInvite")), true)));
                }
            } catch (Exception $ex) {
                return die(json_encode(json_decode(json_encode(array("status" => false, "data" => [], "message" => ($ex->getMessage()), "code" => "addNewBrandInvite")), true)));
            }
        } else {
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('userId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('name');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('contact');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('email');
            }
        }
        return die(json_encode($data));
    }


    /**
     * Sends an OTP (One-Time Password) to the user's email address.
     *
     * @return void
     */
    public function sendOTP()
    {
        $res = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "sendOTP"];
        try {
            $userId = $this->request->getVar('userId');
            if ((!isset($userId)) || (is_null($userId)) || (empty($userId))) {
                $res = ["status" => false, "data" => [], "message" => "INVALID USER", "command" => "sendOTP"];
            } else {
                $user = $this->apiModel->flattenToMultiDimensional($this->userModel->findOneUser($userId));
                if ((!isset($user)) || (is_null($user)) || (empty($user))) {
                    $res = ["status" => false, "data" => [], "message" => "USER NOT FOUND", "command" => "sendOTP"];
                } else {
                    $userName = $user['userName'];
                    $email = $user['email'];
                    $otp = $this->request->getVar('otp');
                    if ((!isset($otp)) || (is_null($otp)) || (empty($otp))) {
                        $otp = rand(100000, 999999);
                    }
                    // $this->userModel->updateUser(array('otpNo' => $otp, 'userVerifiedAt' => NULL, 'emailVerifiedAt' => NULL), $userId);
                    $nextUrl = "http://13.233.239.156:8080/verifyuser/" . $email;
                    $emailService = \Config\Services::email();
                    $emailService->setReplyTo('mail.swrv@gmail.com', 'SWRV');
                    $emailService->setFrom('mail.swrv@gmail.com', 'SWRV');
                    $emailService->setBCC('mail.swrv@gmail.com');
                    $emailService->setTo($user['email']);
                    $emailService->setSubject('[SWRV] - Email Verification');
                    $emailService->setMessage(('<!doctypehtml><title>OTP</title><meta content="text/html; charset=utf-8"http-equiv=Content-Type><meta content="width=device-width,initial-scale=1"name=viewport><meta content="IE=edge"http-equiv=X-UA-Compatible><script src=https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js></script><style href=https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css rel=stylesheet></style><script src=https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js></script><style>@media screen{@font-face{font-family:\'Lato\';font-style:normal;font-weight:400;src:local(\'Lato Regular\'),local(\'Lato-Regular\'),url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format(\'woff\')}@font-face{font-family:\'Lato\';font-style:normal;font-weight:700;src:local(\'Lato Bold\'),local(\'Lato-Bold\'),url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format(\'woff\')}@font-face{font-family:\'Lato\';font-style:italic;font-weight:400;src:local(\'Lato Italic\'),local(\'Lato-Italic\'),url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format(\'woff\')}@font-face{font-family:\'Lato\';font-style:italic;font-weight:700;src:local(\'Lato Bold Italic\'),local(\'Lato-BoldItalic\'),url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format(\'woff\')}}a,body,table,td{-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}table,td{mso-table-lspace:0;mso-table-rspace:0}img{-ms-interpolation-mode:bicubic}img{border:0;height:auto;line-height:100%;outline:0;text-decoration:none}table{border-collapse:collapse!important}body{height:100%!important;margin:0!important;padding:0!important;width:100%!important}a[x-apple-data-detectors]{color:inherit!important;text-decoration:none!important;font-size:inherit!important;font-family:inherit!important;font-weight:inherit!important;line-height:inherit!important}@media screen and (max-width:600px){h1{font-size:32px!important;line-height:32px!important}}div[style*="margin: 16px 0;"]{margin:0!important}</style><body style=background-color:#f4f4f4;margin:0!important;padding:0!important><table border=0 cellpadding=0 cellspacing=0 width=100%><tr><td align=center style="padding:0 10px 0 10px"><table border=0 cellpadding=0 cellspacing=0 width=100% style=max-width:600px><tr><td align=center bgcolor=#ffffff style="padding:40px 20px 20px 20px;border-radius:4px 4px 0 0;color:#111;font-family:\'Lato\',Helvetica,Arial,sans-serif;font-size:48px;font-weight:400;letter-spacing:4px;line-height:48px"valign=top><h3 style=font-size:29px;font-weight:400;margin:2>Welcome ' . $userName . '</h3><img height=120 src=13.233.239.156:8080/images/swrvlogo.png style=display:block;border:0 width=125></table><tr><td align=center bgcolor=#f4f4f4 style="padding:0 10px 0 10px"><table border=0 cellpadding=0 cellspacing=0 width=100% style=max-width:600px><tr><td align=left bgcolor=#ffffff style="padding:20px 30px 10px 30px;color:#666;font-family:\'Lato\',Helvetica,Arial,sans-serif;font-size:18px;font-weight:400;line-height:25px"><p style=font-size:26px;margin:0;text-align:justify;font-weight:600>Welcome to SWRV Influencers Market<tr><td align=left bgcolor=#ffffff style="padding:10px 30px 10px 30px;color:#666;font-family:\'Lato\',Helvetica,Arial,sans-serif;font-size:18px;font-weight:400;line-height:25px"><p style=font-size:20px;margin:0;text-align:justify;font-weight:600>Congratulations!<tr><td align=left bgcolor=#ffffff style="padding:10px 30px 10px 30px;color:#666;font-family:\'Lato\',Helvetica,Arial,sans-serif;font-size:18px;font-weight:400;line-height:25px"><p style=font-size:18px;margin:0;text-align:justify>You have now created your account at SWRV Influencer Market!<tr><td align=left bgcolor=#ffffff style="padding:10px 30px 10px 30px;color:#666;font-family:\'Lato\',Helvetica,Arial,sans-serif;font-size:18px;font-weight:400;line-height:25px"><p style=font-size:20px;margin:0;text-align:justify>Just one more easy step and you will be able to access campaigns and start making money Before you get started please confirm your account registration.<tr><td align=left bgcolor=#ffffff><table border=0 cellpadding=0 cellspacing=0 width=100%><tr><td align=center bgcolor=#ffffff style="padding:20px 30px 60px 30px"><table border=0 cellpadding=0 cellspacing=0><tr><td align=center bgcolor=#03125e style=border-radius:3px><a href="' . $nextUrl . '" style="font-size:20px;font-family:Helvetica,Arial,sans-serif;color:#fff;text-decoration:none;color:#fff;text-decoration:none;padding:15px 25px;border-radius:2px;border:1px solid #03125e;display:inline-block">Confirm my account</a></table></table></table></table>'));
                    $user['otpNo'] = $otp;
                    $user['userVerifiedAt'] = NULL;
                    $user['emailVerifiedAt'] = NULL;
                    $user['nextUrl'] = $nextUrl;
                    if ($emailService->send()) {
                        return die(json_encode(json_decode(json_encode(array("status" => true, "data" => [$user], "message" => "OTP Sent Successfully", "code" => "sendOTP")), true)));
                    } else {
                        return die(json_encode(json_decode(json_encode(array("status" => false, "data" => json_encode(json_decode(json_encode($emailService->printDebugger()), true)), "message" => "failed to send email", "code" => "sendOTP")), true)));
                    }
                }
            }
        } catch (Exception $ex) {
            return die(json_encode(json_decode(json_encode(array("status" => false, "data" => [], "message" => ($ex->getMessage()), "code" => "sendOTP")), true)));
        }
    }

    /**
     * Sends a One Time Password (OTP) to the user for verification.
     *
     * @return void
     */
    public function sendUserOTP()
    {
        $res = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "sendOTP"];
        try {
            $userId = $this->request->getVar('userId');
            if ((!isset($userId)) || (is_null($userId)) || (empty($userId))) {
                $res = ["status" => false, "data" => [], "message" => "INVALID USER", "command" => "sendOTP"];
            } else {
                $user = $this->apiModel->flattenToMultiDimensional($this->userModel->findOneUser($userId));
                if ((!isset($user)) || (is_null($user)) || (empty($user))) {
                    $res = ["status" => false, "data" => [], "message" => "USER NOT FOUND", "command" => "sendOTP"];
                } else {
                    $userName = $user['userName'];
                    $otp = $this->request->getVar('otp');
                    if ((!isset($otp)) || (is_null($otp)) || (empty($otp))) {
                        $otp = rand(100000, 999999);
                    }
                    $this->userModel->updateUser(array('otpNo' => $otp, 'userVerifiedAt' => NULL, 'emailVerifiedAt' => NULL), $userId);
                    $nextUrl = (base_url() . '/api/verify-user-otp/' . $userId . '/' . $otp . '/' . ($user['brandId']));
                    $emailService = \Config\Services::email();
                    $emailService->setReplyTo('mail.swrv@gmail.com', 'SWRV');
                    $emailService->setFrom('mail.swrv@gmail.com', 'SWRV');
                    $emailService->setBCC('mail.swrv@gmail.com');
                    $emailService->setTo($user['email']);
                    $emailService->setSubject('[SWRV] OTP - One Time Password for Verification');
                    $emailService->setMessage(('<!DOCTYPE html><html><head><title>OTP</title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1"><meta http-equiv="X-UA-Compatible" content="IE=edge" /><script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script><style type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"></style><script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script> <style type="text/css"> @media screen { @font-face { font-family: \'Lato\'; font-style: normal; font-weight: 400; src: local(\'Lato Regular\'), local(\'Lato-Regular\'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format(\'woff\'); } @font-face { font-family: \'Lato\'; font-style: normal; font-weight: 700; src: local(\'Lato Bold\'), local(\'Lato-Bold\'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format(\'woff\'); } @font-face { font-family: \'Lato\'; font-style: italic; font-weight: 400; src: local(\'Lato Italic\'), local(\'Lato-Italic\'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format(\'woff\'); } @font-face { font-family: \'Lato\'; font-style: italic; font-weight: 700; src: local(\'Lato Bold Italic\'), local(\'Lato-BoldItalic\'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format(\'woff\'); } } body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; } table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; } img { -ms-interpolation-mode: bicubic; } img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; } table { border-collapse: collapse !important; } body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; } a[x-apple-data-detectors] { color: inherit !important; text-decoration: none !important; font-size: inherit !important; font-family: inherit !important; font-weight: inherit !important; line-height: inherit !important; } @media screen and (max-width:600px) { h1 { font-size: 32px !important; line-height: 32px !important; } } div[style*="margin: 16px 0;"] { margin: 0 !important; } </style></head><body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;"> <table border="0" cellpadding="0" cellspacing="0" width="100%"> <tr> <td bgcolor="#FFA73B" align="center"> <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"> <tr> <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"></td> </tr> </table> </td> </tr> <tr> <td bgcolor="#FFA73B" align="center" style="padding: 0px 10px 0px 10px;"> <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"> <tr> <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;"> <h3 style="font-size: 29px; font-weight: 400; margin: 2;">Welcome ' . $userName . '</h3> <img src=" https://img.icons8.com/clouds/100/000000/handshake.png" width="125" height="120" style="display: block; border: 0px;" /> </td> </tr> </table> </td> </tr> <tr> <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"> <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"> <tr> <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <p style="margin: 0; text-align: justify;">Thank you for choosing SWRV, we\'re excited to have you on our platform. First, you need to confirm your account. Use the following OTP to complete your procedures. OTP is valid for 5 minutes.</p> </td> </tr> <tr> <td bgcolor="#ffffff" align="left"> <table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;"> <table border="0" cellspacing="0" cellpadding="0"> <tr> <td align="center" style="border-radius: 3px;" bgcolor="#FFA73B"><a href="' . $nextUrl . '" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #FFA73B; display: inline-block;">' . $otp . '</a></td> </tr> </table> </td> </tr> </table> </td> </tr><tr> <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <p style="margin: 0;">If that doesn\'t work, copy and paste the following link in your browser:</p> </td> </tr><tr> <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <p style="margin: 0;"><a href="' . $nextUrl . '" target="_blank" style="color: #FFA73B;">' . $nextUrl . '</a></p> </td> </tr> <tr> <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <p style="margin: 0;">If you have any questions, just reply to this email&mdash;we\'re always happy to help out.</p> </td> </tr> <tr> <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <p style="margin: 0;">Cheers,<br />SWRV - Support Team<br/>Center Source</p> </td> </tr> </table> </td> </tr> <tr> <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;"> <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"> <tr> <td bgcolor="#FFECD1" align="center" style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">Need more help?</h2> <p style="margin: 0;"></p> </td> </tr> </table> </td> </tr> <tr> <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"> <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"> <tr> <td bgcolor="#f4f4f4" align="left" style="padding: 0px 30px 30px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;"> <br> <p style="margin: 0;">If these emails get annoying, please feel free to .</p> </td> </tr> </table> </td> </tr> </table></body></html>'));
                    $user['otpNo'] = $otp;
                    $user['userVerifiedAt'] = NULL;
                    $user['emailVerifiedAt'] = NULL;
                    $user['nextUrl'] = $nextUrl;
                    if ($emailService->send()) {
                        return die(json_encode(json_decode(json_encode(array("status" => true, "data" => [$user], "message" => "OTP Sent Successfully", "code" => "sendOTP")), true)));
                    } else {
                        return die(json_encode(json_decode(json_encode(array("status" => false, "data" => json_encode(json_decode(json_encode($emailService->printDebugger()), true)), "message" => "failed to send email", "code" => "sendOTP")), true)));
                    }
                }
            }
        } catch (Exception $ex) {
            return die(json_encode(json_decode(json_encode(array("status" => false, "data" => [], "message" => ($ex->getMessage()), "code" => "sendOTP")), true)));
        }
    }

    /**
     * Sends a brand OTP (One Time Password) for verification.
     *
     * @return void
     */
    public function sendBrandOTP()
    {
        $res = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "sendOTP"];
        try {
            $userId = $this->request->getVar('userId');
            if ((!isset($userId)) || (is_null($userId)) || (empty($userId))) {
                $res = ["status" => false, "data" => [], "message" => "INVALID USER", "command" => "sendOTP"];
            } else {
                $user = $this->apiModel->flattenToMultiDimensional($this->userModel->findOneUser($userId));
                if ((!isset($user)) || (is_null($user)) || (empty($user))) {
                    $res = ["status" => false, "data" => [], "message" => "USER NOT FOUND", "command" => "sendOTP"];
                } else {
                    $userName = $user['userName'];
                    $otp = $this->request->getVar('otp');
                    if ((!isset($otp)) || (is_null($otp)) || (empty($otp))) {
                        $otp = rand(100000, 999999);
                    }
                    $this->userModel->updateUser(array('otpNo' => $otp, 'userVerifiedAt' => NULL, 'emailVerifiedAt' => NULL), $userId);
                    $nextUrl = (base_url() . '/api/verify-brand-otp/' . $userId . '/' . $otp . '/' . ($user['brandId']));
                    $emailService = \Config\Services::email();
                    $emailService->setReplyTo('mail.swrv@gmail.com', 'SWRV');
                    $emailService->setFrom('mail.swrv@gmail.com', 'SWRV');
                    $emailService->setBCC('mail.swrv@gmail.com');
                    $emailService->setTo($user['email']);
                    $emailService->setSubject('[SWRV] OTP - One Time Password for Verification');
                    $emailService->setMessage(('<!DOCTYPE html><html><head><title>OTP</title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1"><meta http-equiv="X-UA-Compatible" content="IE=edge" /><script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script><style type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"></style><script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script> <style type="text/css"> @media screen { @font-face { font-family: \'Lato\'; font-style: normal; font-weight: 400; src: local(\'Lato Regular\'), local(\'Lato-Regular\'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format(\'woff\'); } @font-face { font-family: \'Lato\'; font-style: normal; font-weight: 700; src: local(\'Lato Bold\'), local(\'Lato-Bold\'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format(\'woff\'); } @font-face { font-family: \'Lato\'; font-style: italic; font-weight: 400; src: local(\'Lato Italic\'), local(\'Lato-Italic\'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format(\'woff\'); } @font-face { font-family: \'Lato\'; font-style: italic; font-weight: 700; src: local(\'Lato Bold Italic\'), local(\'Lato-BoldItalic\'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format(\'woff\'); } } body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; } table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; } img { -ms-interpolation-mode: bicubic; } img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; } table { border-collapse: collapse !important; } body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; } a[x-apple-data-detectors] { color: inherit !important; text-decoration: none !important; font-size: inherit !important; font-family: inherit !important; font-weight: inherit !important; line-height: inherit !important; } @media screen and (max-width:600px) { h1 { font-size: 32px !important; line-height: 32px !important; } } div[style*="margin: 16px 0;"] { margin: 0 !important; } </style></head><body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;"> <table border="0" cellpadding="0" cellspacing="0" width="100%"> <tr> <td bgcolor="#FFA73B" align="center"> <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"> <tr> <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"></td> </tr> </table> </td> </tr> <tr> <td bgcolor="#FFA73B" align="center" style="padding: 0px 10px 0px 10px;"> <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"> <tr> <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;"> <h3 style="font-size: 29px; font-weight: 400; margin: 2;">Welcome ' . $userName . '</h3> <img src=" https://img.icons8.com/clouds/100/000000/handshake.png" width="125" height="120" style="display: block; border: 0px;" /> </td> </tr> </table> </td> </tr> <tr> <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"> <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"> <tr> <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <p style="margin: 0; text-align: justify;">Thank you for choosing SWRV, we\'re excited to have you on our platform. First, you need to confirm your account. Use the following OTP to complete your procedures. OTP is valid for 5 minutes.</p> </td> </tr> <tr> <td bgcolor="#ffffff" align="left"> <table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;"> <table border="0" cellspacing="0" cellpadding="0"> <tr> <td align="center" style="border-radius: 3px;" bgcolor="#FFA73B"><a href="' . $nextUrl . '" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #FFA73B; display: inline-block;">' . $otp . '</a></td> </tr> </table> </td> </tr> </table> </td> </tr><tr> <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <p style="margin: 0;">If that doesn\'t work, copy and paste the following link in your browser:</p> </td> </tr><tr> <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <p style="margin: 0;"><a href="' . $nextUrl . '" target="_blank" style="color: #FFA73B;">' . $nextUrl . '</a></p> </td> </tr> <tr> <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <p style="margin: 0;">If you have any questions, just reply to this email&mdash;we\'re always happy to help out.</p> </td> </tr> <tr> <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <p style="margin: 0;">Cheers,<br />SWRV - Support Team<br/>Center Source</p> </td> </tr> </table> </td> </tr> <tr> <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;"> <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"> <tr> <td bgcolor="#FFECD1" align="center" style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">Need more help?</h2> <p style="margin: 0;"></p> </td> </tr> </table> </td> </tr> <tr> <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"> <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"> <tr> <td bgcolor="#f4f4f4" align="left" style="padding: 0px 30px 30px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;"> <br> <p style="margin: 0;">If these emails get annoying, please feel free to .</p> </td> </tr> </table> </td> </tr> </table></body></html>'));
                    $user['otpNo'] = $otp;
                    $user['userVerifiedAt'] = NULL;
                    $user['emailVerifiedAt'] = NULL;
                    $user['nextUrl'] = $nextUrl;
                    if ($emailService->send()) {
                        return die(json_encode(json_decode(json_encode(array("status" => true, "data" => [$user], "message" => "OTP Sent Successfully", "code" => "sendOTP")), true)));
                    } else {
                        return die(json_encode(json_decode(json_encode(array("status" => false, "data" => json_encode(json_decode(json_encode($emailService->printDebugger()), true)), "message" => "failed to send email", "code" => "sendOTP")), true)));
                    }
                }
            }
        } catch (Exception $ex) {
            return die(json_encode(json_decode(json_encode(array("status" => false, "data" => [], "message" => ($ex->getMessage()), "code" => "sendOTP")), true)));
        }
    }

    /**
     * Verify the OTP for a user.
     *
     * @param int $userId
     * @param int $otp
     * @param int $brandId
     * @return void
     * @throws Exception
     */
    public function verifyOTP($userId = 0, $otp = 0, $brandId = 0)
    {
        try {
            if ((!isset($userId)) || (is_null($userId)) || (empty($userId))) {
                die('<center><h1>Invalid USER</h1></center>');
            } else {
                $user = $this->apiModel->flattenToMultiDimensional($this->userModel->findOneUser($userId));
                if ((!isset($user)) || (is_null($user)) || (empty($user))) {
                    die('<center><h1>USER NOT FOUND</h1></center>');
                } else {
                    if ($otp == $user['otpNo']) {
                        if ($brandId == $user['brandId']) {
                            $this->brandModel->updateBrand(array('brandVerifiedAt' => (date('Y-m-d H:i:s', time())), 'brandStatus' => 1), $brandId);
                        }
                        $this->userModel->updateUser(array('otpNo' => NULL, 'userVerifiedAt' => (date('Y-m-d H:i:s', time())), 'emailVerifiedAt' => (date('Y-m-d H:i:s', time())), 'userStatus' => 1), $userId);
                        die('<center><h1>Successfully Verified</h1></center>');
                    } else {
                        die('<center><h1>INVALID OTP</h1></center>');
                    }
                }
            }
        } catch (Exception $ex) {
            die('<center><h1>' . ($ex->getMessage()) . '</h1></center>');
        }
    }

    /**
     * Verify the OTP for a user.
     *
     * @param int $userId
     * @param int $otp
     * @param int $brandId
     * @return void
     * @throws Exception
     */
    public function verifyUserOTP($userId = 0, $otp = 0, $brandId = 0)
    {
        try {
            if ((!isset($userId)) || (is_null($userId)) || (empty($userId))) {
                die('<center><h1>Invalid USER</h1></center>');
            } else {
                $user = $this->apiModel->flattenToMultiDimensional($this->userModel->findOneUser($userId));
                if ((!isset($user)) || (is_null($user)) || (empty($user))) {
                    die('<center><h1>USER NOT FOUND</h1></center>');
                } else {
                    if ($otp == $user['otpNo']) {
                        $this->userModel->updateUser(array('otpNo' => NULL, 'userVerifiedAt' => (date('Y-m-d H:i:s', time())), 'emailVerifiedAt' => (date('Y-m-d H:i:s', time())), 'userStatus' => 1), $userId);
                        die('<center><h1>Successfully Verified</h1></center>');
                    } else {
                        die('<center><h1>INVALID OTP</h1></center>');
                    }
                }
            }
        } catch (Exception $ex) {
            die('<center><h1>' . ($ex->getMessage()) . '</h1></center>');
        }
    }

    /**
     * Verify the brand OTP for a given user.
     *
     * @param int $userId
     * @param int $otp
     * @param int $brandId
     * @return void
     * @throws Exception
     */
    public function verifyBrandOTP($userId = 0, $otp = 0, $brandId = 0)
    {
        try {
            if ((!isset($userId)) || (is_null($userId)) || (empty($userId))) {
                die('<center><h1>Invalid USER</h1></center>');
            } else {
                $user = $this->apiModel->flattenToMultiDimensional($this->userModel->findOneUser($userId));
                if ((!isset($user)) || (is_null($user)) || (empty($user))) {
                    die('<center><h1>USER NOT FOUND</h1></center>');
                } else {
                    if ($otp == $user['otpNo']) {
                        $this->brandModel->updateBrand(array('brandVerifiedAt' => (date('Y-m-d H:i:s', time())), 'brandStatus' => 1), $brandId);
                        die('<center><h1>Successfully Verified</h1></center>');
                    } else {
                        die('<center><h1>INVALID OTP</h1></center>');
                    }
                }
            }
        } catch (Exception $ex) {
            die('<center><h1>' . ($ex->getMessage()) . '</h1></center>');
        }
    }

    /**
     * Sends a change password email to the user.
     *
     * @throws Exception
     * @return void
     */
    public function sendChangePasswordMail()
    {
        $res = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "sendChangePasswordMail"];
        try {
            $user = $this->apiModel->flattenToMultiDimensional($this->userModel->checkUserExists($this->request->getVar('user')));
            if ((!isset($user)) || (is_null($user)) || (empty($user))) {
                $res = ["status" => false, "data" => [], "message" => "INVALID USER", "command" => "sendChangePasswordMail"];
            } else {
                $userName = $user['userName'];
                $userId = $user['id'];
                $otp = $this->request->getVar('otp');
                if ((!isset($otp)) || (is_null($otp)) || (empty($otp))) {
                    $otp = rand(100000, 999999);
                }
                $this->userModel->updateUser(array('otpNo' => $otp, 'userPassword' => NULL, 'userVerifiedAt' => NULL), $userId);
                $nextUrl = (base_url() . '/api/change-password/' . $userId . '/' . $otp);
                $emailService = \Config\Services::email();
                $emailService->setReplyTo('mail.swrv@gmail.com', 'SWRV');
                $emailService->setFrom('mail.swrv@gmail.com', 'SWRV');
                $emailService->setBCC('mail.swrv@gmail.com');
                $emailService->setTo($user['userEmail']);
                $emailService->setSubject('[SWRV] Forgot Password');
                $emailService->setMessage(('<!DOCTYPE html><html><head><title>Forgot Password</title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1"><meta http-equiv="X-UA-Compatible" content="IE=edge" /><script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script><style type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"></style><script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script> <style type="text/css"> @media screen { @font-face { font-family: \'Lato\'; font-style: normal; font-weight: 400; src: local(\'Lato Regular\'), local(\'Lato-Regular\'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format(\'woff\'); } @font-face { font-family: \'Lato\'; font-style: normal; font-weight: 700; src: local(\'Lato Bold\'), local(\'Lato-Bold\'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format(\'woff\'); } @font-face { font-family: \'Lato\'; font-style: italic; font-weight: 400; src: local(\'Lato Italic\'), local(\'Lato-Italic\'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format(\'woff\'); } @font-face { font-family: \'Lato\'; font-style: italic; font-weight: 700; src: local(\'Lato Bold Italic\'), local(\'Lato-BoldItalic\'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format(\'woff\'); } } body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; } table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; } img { -ms-interpolation-mode: bicubic; } img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; } table { border-collapse: collapse !important; } body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; } a[x-apple-data-detectors] { color: inherit !important; text-decoration: none !important; font-size: inherit !important; font-family: inherit !important; font-weight: inherit !important; line-height: inherit !important; } @media screen and (max-width:600px) { h1 { font-size: 32px !important; line-height: 32px !important; } } div[style*="margin: 16px 0;"] { margin: 0 !important; } </style></head><body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;"> <table border="0" cellpadding="0" cellspacing="0" width="100%"> <tr> <td bgcolor="#FFA73B" align="center"> <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"> <tr> <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"></td> </tr> </table> </td> </tr> <tr> <td bgcolor="#FFA73B" align="center" style="padding: 0px 10px 0px 10px;"> <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"> <tr> <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;"> <h3 style="font-size: 29px; font-weight: 400; margin: 2;">Hi ' . $userName . ',</h3> <img src=" https://img.icons8.com/clouds/100/000000/handshake.png" width="125" height="120" style="display: block; border: 0px;" /> </td> </tr> </table> </td> </tr> <tr> <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"> <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"> <tr> <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <p style="margin: 0; text-align: justify;">We are sorry to hear that, we\'re excited to have you on our platform. First, you need to confirm your account. Use the following OTP to complete your procedure. OTP is valid for 5 minutes.</p> </td> </tr> <tr> <td bgcolor="#ffffff" align="left"> <table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;"> <table border="0" cellspacing="0" cellpadding="0"> <tr> <td align="center" style="border-radius: 3px;" bgcolor="#FFA73B"><a href="' . $nextUrl . '" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #FFA73B; display: inline-block;">' . $otp . '</a></td> </tr> </table> </td> </tr> </table> </td> </tr><tr> <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <p style="margin: 0;">If that doesn\'t work, copy and paste the following link in your browser:</p> </td> </tr><tr> <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <p style="margin: 0;"><a href="' . $nextUrl . '" target="_blank" style="color: #FFA73B;">' . $nextUrl . '</a></p> </td> </tr> <tr> <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <p style="margin: 0;">If you have any questions, just reply to this email&mdash;we\'re always happy to help out.</p> </td> </tr> <tr> <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <p style="margin: 0;">Cheers,<br />SWRV - Support Team<br/>Center Source</p> </td> </tr> </table> </td> </tr> <tr> <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;"> <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"> <tr> <td bgcolor="#FFECD1" align="center" style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"> <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">Need more help?</h2> <p style="margin: 0;"></p> </td> </tr> </table> </td> </tr> <tr> <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"> <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"> <tr> <td bgcolor="#f4f4f4" align="left" style="padding: 0px 30px 30px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;"> <br> <p style="margin: 0;">If these emails get annoying, please feel free to .</p> </td> </tr> </table> </td> </tr> </table></body></html>'));
                $user['otpNo'] = $otp;
                $user['userVerifiedAt'] = NULL;
                $user['nextUrl'] = $nextUrl;
                if ($emailService->send()) {
                    die(json_encode(json_decode(json_encode(array("status" => true, "data" => [$user], "message" => "OTP Sent Successfully", "code" => "sendChangePasswordMail")), true)));
                } else {
                    die(json_encode(json_decode(json_encode(array("status" => false, "data" => json_encode(json_decode(json_encode($emailService->printDebugger()), true)), "message" => "failed to send email", "code" => "sendChangePasswordMail")), true)));
                }
            }
        } catch (Exception $ex) {
            die(json_encode(json_decode(json_encode(array("status" => false, "data" => [], "message" => ($ex->getMessage()), "code" => "sendChangePasswordMail")), true)));
        }
        return die(json_encode(json_decode(json_encode($res), true)));
    }

    /**
     * Verifies and changes the password for a user.
     *
     * @param int $userId (optional) The ID of the user. If not provided, it will be retrieved from the request.
     * @param int $otpNo (optional) The OTP number. If not provided, it will be retrieved from the request.
     * @return View The view for the change password page with the updated data.
     */
    public function verifyChangePassword($userId = 0, $otpNo = 0)
    {
        $data = [];
        try {
            if ((!isset($userId)) || (is_null($userId)) || (empty($userId)) || ($userId <= 0)) {
                $userId = $this->request->getVar('userId');
            }
            $data['userId'] = $userId;
            $data['data']['userId'] = $userId;
            if ((!isset($otpNo)) || (is_null($otpNo)) || (empty($otpNo)) || ($otpNo <= 0)) {
                $otpNo = $this->request->getVar('otpNo');
            }
            $data['otpNo'] = $otpNo;
            $data['data']['otpNo'] = $otpNo;
            if ($this->request->getMethod() == "post") {
                $opassword = $this->request->getVar('opassword');
                $password = $this->request->getVar('password');
                $cpassword = $this->request->getVar('cpassword');
                if ((!isset($userId)) || (is_null($userId)) || (empty($userId)) || (!isset($otpNo)) || (is_null($otpNo)) || (empty($otpNo))) {
                    $data['error'] = "Invalid Input";
                    $data['success'] = NULL;
                } else {
                    $user = $this->apiModel->flattenToMultiDimensional($this->userModel->findOneUser($userId));
                    if ((!isset($user)) || (is_null($user)) || (empty($user))) {
                        $data['error'] = "User Not Found";
                        $data['success'] = NULL;
                    } elseif ($otpNo == $user['otpNo']) {
                        if ($password == $cpassword) {
                            $data['message'] = $this->apiModel->isValidPassword($password, 6, 32, true, true, true, true);
                            if ($data['message'] == 'success') {
                                $password = password_hash($password, PASSWORD_DEFAULT);
                                $this->userModel->updateUser(array('userPassword' => $password, 'otpNo' => NULL, 'userVerifiedAt' => (date('Y-m-d H:i:s', time())), 'userStatus' => 1), $userId);
                                $data['success'] = 'Success';
                                $data['error'] = NULL;
                            } else {
                                $data['error'] = $data['message'];
                                $data['success'] = NULL;
                            }
                        } else {
                            $data['error'] = "Password & Confirm Password Do Not Match";
                            $data['success'] = NULL;
                        }
                    } else {
                        $data['error'] = "Invalid OTP";
                        $data['success'] = NULL;
                    }
                }
            } else {
                $data['success'] = NULL;
                $data['error'] = NULL;
            }
        } catch (Exception $ex) {
            $data['error'] = $ex->getMessage();
            $data['success'] = NULL;
        }
        $data['otpNo'] = $otpNo;
        $data['userId'] = $userId;
        $data['data']['otpNo'] = $otpNo;
        $data['data']['userId'] = $userId;
        return View('change-password', $data);
    }

    public function sendForgotPasswordMail()
    /**
     * Sends a forgot password email to the user.
     *
     * @return void
     */
    {
        $res = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "sendForgotPasswordMail"];
        try {
            $user = $this->apiModel->flattenToMultiDimensional($this->userModel->checkUserExists($this->request->getVar('user')));
            if ((!isset($user)) || (is_null($user)) || (empty($user))) {
                $res = ["status" => false, "data" => [], "message" => "INVALID USER", "command" => "sendForgotPasswordMail"];
            } else {
                $userName = $user['userName'];
                $userId = $user['id'];
                $otp = $this->request->getVar('otp');
                if ((!isset($otp)) || (is_null($otp)) || (empty($otp))) {
                    $otp = rand(100000, 999999);
                }
                // $this->userModel->updateUser(array('otpNo' => $otp, 'userPassword' => NULL, 'userVerifiedAt' => NULL), $userId);
                $nextUrl = ("http://13.233.239.156/websites/swrv" . '/api/forgot-password/' . $userId . '/' . $otp);
                $emailService = \Config\Services::email();
                $emailService->setReplyTo('mail.swrv@gmail.com', 'SWRV');
                $emailService->setFrom('mail.swrv@gmail.com', 'SWRV');
                $emailService->setBCC('mail.swrv@gmail.com');
                $emailService->setTo($user['userEmail']);
                $emailService->setSubject('[SWRV] Forgot Password');
                $emailService->setMessage(('<!doctypehtml><title>OTP</title><meta content="text/html; charset=utf-8"http-equiv=Content-Type><meta content="width=device-width,initial-scale=1"name=viewport><meta content="IE=edge"http-equiv=X-UA-Compatible><script src=https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js></script><style href=https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css rel=stylesheet></style><script src=https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js></script><style>@media screen{@font-face{font-family:\'Lato\';font-style:normal;font-weight:400;src:local(\'Lato Regular\'),local(\'Lato-Regular\'),url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format(\'woff\')}@font-face{font-family:\'Lato\';font-style:normal;font-weight:700;src:local(\'Lato Bold\'),local(\'Lato-Bold\'),url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format(\'woff\')}@font-face{font-family:\'Lato\';font-style:italic;font-weight:400;src:local(\'Lato Italic\'),local(\'Lato-Italic\'),url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format(\'woff\')}@font-face{font-family:\'Lato\';font-style:italic;font-weight:700;src:local(\'Lato Bold Italic\'),local(\'Lato-BoldItalic\'),url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format(\'woff\')}}a,body,table,td{-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}table,td{mso-table-lspace:0;mso-table-rspace:0}img{-ms-interpolation-mode:bicubic}img{border:0;height:auto;line-height:100%;outline:0;text-decoration:none}table{border-collapse:collapse!important}body{height:100%!important;margin:0!important;padding:0!important;width:100%!important}a[x-apple-data-detectors]{color:inherit!important;text-decoration:none!important;font-size:inherit!important;font-family:inherit!important;font-weight:inherit!important;line-height:inherit!important}@media screen and (max-width:600px){h1{font-size:32px!important;line-height:32px!important}}div[style*="margin: 16px 0;"]{margin:0!important}</style><body style=background-color:#f4f4f4;margin:0!important;padding:0!important><table border=0 cellpadding=0 cellspacing=0 width=100%><tr><td align=center style="padding:0 10px 0 10px"><tr><td align=center bgcolor=#f4f4f4 style="padding:0 10px 0 10px"><table border=0 cellpadding=0 cellspacing=0 width=100% style=max-width:600px><tr><td align=left bgcolor=#ffffff style="padding:20px 30px 10px 30px;color:#666;font-family:\'Lato\',Helvetica,Arial,sans-serif;font-size:18px;font-weight:400;line-height:25px"><p style=font-size:26px;margin:0;text-align:justify;font-weight:600>SWRV Influencers Market - Forgot Password<tr><td align=left bgcolor=#ffffff style="padding:10px 30px 10px 30px;color:#666;font-family:\'Lato\',Helvetica,Arial,sans-serif;font-size:18px;font-weight:400;line-height:25px"><p style=font-size:20px;margin:0;text-align:justify;font-weight:600><tr><td align=left bgcolor=#ffffff style="padding:10px 30px 10px 30px;color:#666;font-family:\'Lato\',Helvetica,Arial,sans-serif;font-size:18px;font-weight:400;line-height:25px"><p style=font-size:18px;margin:0;text-align:justify>We understand you have lost access your account at SWRV Influencer Market!<tr><td align=left bgcolor=#ffffff style="padding:10px 30px 10px 30px;color:#666;font-family:\'Lato\',Helvetica,Arial,sans-serif;font-size:18px;font-weight:400;line-height:25px"><p style=font-size:18px;margin:0;text-align:justify>Just one more easy step and you will be able to access campaigns and start making money.<tr><td align=left bgcolor=#ffffff><table border=0 cellpadding=0 cellspacing=0 width=100%><tr><td align=center bgcolor=#ffffff style="padding:20px 30px 60px 30px"><table border=0 cellpadding=0 cellspacing=0><tr><td align=center bgcolor=#03125e style=border-radius:3px><a href="' . $nextUrl . '" style="font-size:20px;font-family:Helvetica,Arial,sans-serif;color:#fff;text-decoration:none;color:#fff;text-decoration:none;padding:15px 25px;border-radius:2px;border:1px solid #03125e;display:inline-block">Reset Password</a></table></table></table></table></boyd></html>'));
                $user['otpNo'] = $otp;
                $user['userVerifiedAt'] = NULL;
                $user['nextUrl'] = $nextUrl;
                if ($emailService->send()) {
                    die(json_encode(json_decode(json_encode(array("status" => true, "data" => [$user], "message" => "OTP Sent Successfully", "code" => "sendForgotPasswordMail")), true)));
                } else {
                    die(json_encode(json_decode(json_encode(array("status" => false, "data" => json_encode(json_decode(json_encode($emailService->printDebugger()), true)), "message" => "failed to send email", "code" => "sendForgotPasswordMail")), true)));
                }
            }
        } catch (Exception $ex) {
            die(json_encode(json_decode(json_encode(array("status" => false, "data" => [], "message" => ($ex->getMessage()), "code" => "sendForgotPasswordMail")), true)));
        }
        return die(json_encode(json_decode(json_encode($res), true)));
    }

    /**
     * Verifies the forgot password request.
     *
     * @param int $userId (optional) The user ID. Default is 0.
     * @param int $otpNo (optional) The OTP number. Default is 0.
     * @return View The view for the forgot password page.
     */
    public function verifyForgotPassword($userId = 0, $otpNo = 0)
    {
        $data = [];
        try {
            if ((!isset($userId)) || (is_null($userId)) || (empty($userId)) || ($userId <= 0)) {
                $userId = $this->request->getVar('userId');
            }
            $data['userId'] = $userId;
            $data['data']['userId'] = $userId;
            if ((!isset($otpNo)) || (is_null($otpNo)) || (empty($otpNo)) || ($otpNo <= 0)) {
                $otpNo = $this->request->getVar('otpNo');
            }
            $data['otpNo'] = $otpNo;
            $data['data']['otpNo'] = $otpNo;
            if ($this->request->getMethod() == "post") {
                $password = $this->request->getVar('password');
                $cpassword = $this->request->getVar('cpassword');
                if ((!isset($userId)) || (is_null($userId)) || (empty($userId)) || (!isset($otpNo)) || (is_null($otpNo)) || (empty($otpNo))) {
                    $data['error'] = "Invalid Input";
                    $data['success'] = NULL;
                } else {
                    $user = $this->apiModel->flattenToMultiDimensional($this->userModel->findOneUser($userId));
                    if ((!isset($user)) || (is_null($user)) || (empty($user))) {
                        $data['error'] = "User Not Found";
                        $data['success'] = NULL;
                    } else {
                        if ($password == $cpassword) {
                            $data['message'] = $this->apiModel->isValidPassword($password, 6, 32, true, true, true, true);
                            if ($data['message'] == 'success') {
                                $password = password_hash($password, PASSWORD_DEFAULT);
                                $this->userModel->updateUser(array('userPassword' => $password, 'otpNo' => NULL, 'userVerifiedAt' => (date('Y-m-d H:i:s', time())), 'userStatus' => 1), $userId);
                                $data['success'] = 'Success';
                                $data['error'] = NULL;
                            } else {
                                $data['error'] = $data['message'];
                                $data['success'] = NULL;
                            }
                        } else {
                            $data['error'] = "Password & Confirm Password Do Not Match";
                            $data['success'] = NULL;
                        }
                    }
                    // else {
                    //     $data['error'] = "Invalid OTP";
                    //     $data['success'] = NULL;
                    // }
                }
            } else {
                $data['success'] = NULL;
                $data['error'] = NULL;
            }
        } catch (Exception $ex) {
            $data['error'] = $ex->getMessage();
            $data['success'] = NULL;
        }
        $data['otpNo'] = $otpNo;
        $data['userId'] = $userId;
        $data['data']['otpNo'] = $otpNo;
        $data['data']['userId'] = $userId;
        return View('forgot-password', $data);
    }

    /**
     * Adds a new brand to the system.
     *
     * This method is responsible for creating a new brand in the system based on the provided input data. It performs validation on the input data and returns a JSON response indicating the success or failure of the operation.
     *
     * @return void
     */
    public function addNewBrand()
    {
        $this->session->destroy();
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "addNewBrand"];
        $rules = [
            'userId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'userId is REQUIRED',
                ],
            ],
            'cityId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'cityId is REQUIRED',
                ],
            ],
            'brandCode' => [
                'rules' => 'required|min_length[3]|max_length[9]',
                'errors' => [
                    'required' => 'brandCode is REQUIRED',
                    'min_length' => 'brandCode {value} Should be GREATER THAN {param} Character(s)',
                    'max_length' => 'brandCode {value} Should be LESS THAN {param} Character(s)',
                ],
            ],
            'brandName' => [
                'rules' => 'required|min_length[3]|max_length[63]',
                'errors' => [
                    'required' => 'brandName is REQUIRED',
                    'min_length' => 'brandName {value} Should be GREATER THAN {param} Character(s)',
                    'max_length' => 'brandName {value} Should be LESS THAN {param} Character(s)',
                ],
            ],
            'brandFullRegisteredAddress' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'brandFullRegisteredAddress is REQUIRED',
                ],
            ],
            'brandSupportEmail' => [
                'rules' => 'required|min_length[6]|max_length[32]|valid_email',
                'errors' => [
                    'required' => 'brandSupportEmail is REQUIRED',
                    'min_length' => 'brandSupportEmail {value} Should be GREATER THAN {param} Character(s)',
                    'max_length' => 'brandSupportEmail {value} Should be LESS THAN {param} Character(s)',
                    'valid_email' => 'brandSupportEmail {value} is NOT VALID',
                ],
            ],
            'brandSupportContact' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'brandSupportContact is REQUIRED',
                    'numeric' => 'brandSupportContact {value} Should be Number',
                ],
            ],
            'brandBioInfo' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'brandBioInfo is REQUIRED',
                ],
            ],
            'brandWebUrl' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'brandWebUrl is REQUIRED',
                ],
            ],
            'comapnyBio' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'comapnyBio is REQUIRED',
                ],
            ],
            'brandLogoUrl' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'brandLogoUrl is REQUIRED',
                ],
            ],
            'banner' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'banner is REQUIRED',
                ],
            ],
        ];
        if ($this->validate($rules)) {
            $user = [];
            $user['id'] = $this->request->getVar('userId');
            $user['brand'] = [];
            $user['brand']['cityId'] = $this->request->getVar('cityId');
            $user['brand']['adminUserId'] = $this->request->getVar('userId');
            $user['brand']['brandCode'] = $this->request->getVar('brandCode');
            $user['brand']['brandName'] = $this->request->getVar('brandName');
            $user['brand']['brandFullRegisteredAddress'] = $this->request->getVar('brandFullRegisteredAddress');
            $user['brand']['brandSupportEmail'] = $this->request->getVar('brandSupportEmail');
            $user['brand']['brandSupportContact'] = $this->request->getVar('brandSupportContact');
            $user['brand']['brandBioInfo'] = $this->request->getVar('brandBioInfo');
            $user['brand']['brandWebUrl'] = $this->request->getVar('brandWebUrl');
            $user['brand']['comapnyBio'] = $this->request->getVar('comapnyBio');
            $user['brand']['brandLogoUrl'] = $this->request->getVar('brandLogoUrl');
            $user['brand']['banner'] = $this->request->getVar('banner');
            $user['brand']['id'] = $this->brandModel->createBrand($user['brand']);
            if ($user['brand']['id'] > 0) {
                $this->userModel->updateUser(array("brandId" => ($user['brand']['id'])), $user['id']);
                $user = $this->apiModel->flattenToMultiDimensional($this->userModel->findOneUser($user['id']));
                $user['brand'] = $this->apiModel->flattenToMultiDimensional($this->brandModel->findOneBrand($user['brandId']));
                $user['categories'] = $this->apiModel->flattenToMultiDimensional($this->categoryModel->findCategoriesByUser($user['id']));
                $user['languages'] = $this->apiModel->flattenToMultiDimensional($this->languageModel->findLanguagesByUser($user['id']));
                $user['platforms'] = $this->apiModel->flattenToMultiDimensional($this->handleModel->findHandlesByUser($user['id']));
                $data = ["status" => true, "data" => $user, "message" => "success", "command" => "addNewBrand"];
            } else {
                $data['message'] = "FAILED TO ADD NEW BRAND";
            }
        } else {
            $data['message'] = $this->validator->getError('userId');
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('cityId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('brandCode');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('brandName');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('brandFullRegisteredAddress');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('brandSupportEmail');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('brandSupportContact');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('brandBioInfo');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('brandWebUrl');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('comapnyBio');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('brandLogoUrl');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('banner');
            }
        }
        return die(json_encode($data));
    }

    /**
     * Adds a new campaign.
     *
     * This method is responsible for creating a new campaign based on the provided data. It performs validation on the input data and returns a JSON response with the status, data, message, and command.
     *
     * @return void
     */
    public function addNewCampaign()
    {
        $this->session->destroy();
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "addNewCampaign"];
        $rules = [
            'brandUserId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'brandUserId is REQUIRED',
                ],
            ],
            'cityId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'cityId is REQUIRED',
                ],
            ],
            'brandId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'brandId is REQUIRED',
                ],
            ],
            'campaignTypeId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'campaignTypeId is REQUIRED',
                ],
            ],
            'currencyId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'currencyId is REQUIRED',
                ],
            ],
            'categories' => [
                'rules' => 'required|max_length[63]',
                'errors' => [
                    'required' => 'categories is REQUIRED',
                    'max_length' => 'categories {value} Should be LESS THAN {param} Character(s)',
                ],
            ],
            'platforms' => [
                'rules' => 'required|max_length[63]',
                'errors' => [
                    'required' => 'platforms is REQUIRED',
                    'max_length' => 'platforms {value} Should be LESS THAN {param} Character(s)',
                ],
            ],
            'campaignName' => [
                'rules' => 'required|min_length[3]|max_length[63]',
                'errors' => [
                    'required' => 'campaignName is REQUIRED',
                    'min_length' => 'campaignName {value} Should be GREATER THAN {param} Character(s)',
                    'max_length' => 'campaignName {value} Should be LESS THAN {param} Character(s)',
                ],
            ],
            'campaignInfo' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'campaignInfo is REQUIRED',
                ],
            ],
            'minEligibleRating' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'minEligibleRating is REQUIRED',
                    'decimal' => 'minEligibleRating should be DECIMAL',
                ],
            ],
            'minReach' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'minReach is REQUIRED',
                    'numeric' => 'minReach should be NUMERIC',
                ],
            ],
            'maxReach' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'maxReach is REQUIRED',
                    'numeric' => 'maxReach should be NUMERIC',
                ],
            ],
            'costPerPost' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'costPerPost is REQUIRED',
                    'numeric' => 'costPerPost should be DECIMAL',
                ],
            ],
            'totalBudget' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'totalBudget is REQUIRED',
                    'numeric' => 'totalBudget should be DECIMAL',
                ],
            ],
            'startAt' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'startAt is REQUIRED',
                ],
            ],
            'endAt' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'endAt is REQUIRED',
                ],
            ],
            'dos' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'dos is REQUIRED',
                ],
            ],
            'donts' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'donts is REQUIRED',
                ],
            ],
            'hashtags' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'hashtags is REQUIRED',
                ],
            ],
            'mentions' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'mentions is REQUIRED',
                ],
            ],
        ];
        if ($this->validate($rules)) {
            $user = [];
            $user['campaign'] = [];
            $user['id'] = $this->request->getVar('userId');
            $user['campaign']['brandUserId'] = $this->request->getVar('brandUserId');
            $user['campaign']['cityId'] = $this->request->getVar('cityId');
            $user['campaign']['brandId'] = $this->request->getVar('brandId');
            $user['campaign']['campaignTypeId'] = $this->request->getVar('campaignTypeId');
            $user['campaign']['currencyId'] = $this->request->getVar('currencyId');
            $user['campaign']['categories'] = $this->request->getVar('categories');
            $user['campaign']['platforms'] = $this->request->getVar('platforms');
            $user['campaign']['campaignName'] = $this->request->getVar('campaignName');
            $user['campaign']['campaignInfo'] = $this->request->getVar('campaignInfo');
            $user['campaign']['minEligibleRating'] = $this->request->getVar('minEligibleRating');
            $user['campaign']['minReach'] = $this->request->getVar('minReach');
            $user['campaign']['maxReach'] = $this->request->getVar('maxReach');
            $user['campaign']['costPerPost'] = $this->request->getVar('costPerPost');
            $user['campaign']['plannedBudget'] = $this->request->getVar('plannedBudget');
            $user['campaign']['minTarget'] = $this->request->getVar('minTarget');
            $user['campaign']['totalTarget'] = $this->request->getVar('totalTarget');
            $user['campaign']['totalParticipants'] = $this->request->getVar('totalParticipants');
            $user['campaign']['totalBudget'] = $this->request->getVar('totalBudget');
            $user['campaign']['remuneration'] = $this->request->getVar('remuneration');
            $user['campaign']['remunerationCash'] = $this->request->getVar('remunerationCash');
            $user['campaign']['remunerationProductDetail'] = $this->request->getVar('remunerationProductDetail');
            $user['campaign']['remunerationRevenuePer'] = $this->request->getVar('remunerationRevenuePer');
            $user['campaign']['dicountCoupon'] = $this->request->getVar('dicountCoupon');
            $user['campaign']['inviteStartAt'] = $this->request->getVar('inviteStartAt');
            $user['campaign']['inviteEndAt'] = $this->request->getVar('inviteEndAt');
            $user['campaign']['startAt'] = $this->request->getVar('startAt');
            $user['campaign']['endAt'] = $this->request->getVar('endAt');
            $user['campaign']['dos'] = $this->request->getVar('dos');
            $user['campaign']['donts'] = $this->request->getVar('donts');
            $user['campaign']['hashtags'] = $this->request->getVar('hashtags');
            $user['campaign']['mentions'] = $this->request->getVar('mentions');
            $user['campaign']['postApproval'] = $this->request->getVar('postApproval');
            $user['campaign']['highlightInfo'] = $this->request->getVar('highlightInfo');
            $user['campaign']['geoLat'] = $this->request->getVar('geoLat');
            $user['campaign']['geoLng'] = $this->request->getVar('geoLng');
            $user['campaign']['geoRadiusKm'] = $this->request->getVar('geoRadiusKm');
            $user['campaign']['audienceLocations'] = $this->request->getVar('audienceLocations');
            $user['campaign']['attach01'] = $this->request->getVar('attach01');
            $user['campaign']['attach02'] = $this->request->getVar('attach02');
            $user['campaign']['attach03'] = $this->request->getVar('attach03');
            $user['campaign']['attach04'] = $this->request->getVar('attach04');
            $user['campaign']['attach05'] = $this->request->getVar('attach05');
            $user['campaign']['purpose'] = $this->request->getVar('purpose');
            $user['campaign']['campaignPriority'] = $this->request->getVar('campaignPriority');
            $user['campaign']['isPublic'] = $this->request->getVar('isPublic');
            $user['campaign']['campaignStatus'] = $this->request->getVar('campaignStatus');
            $campaignId = $this->campaignModel->createCampaign($user['campaign']);
            if ($campaignId > 0) {
                $user = $this->apiModel->flattenToMultiDimensional($this->userModel->findOneUser($user['id']));
                $user['campaign'] = $this->apiModel->flattenToMultiDimensional($this->campaignModel->findOneCampaign($campaignId));
                $user['brand'] = $this->apiModel->flattenToMultiDimensional($this->brandModel->findOneBrand($user['brand']['id']));
                $user['categories'] = $this->apiModel->flattenToMultiDimensional($this->categoryModel->findCategoriesByUser($user['id']));
                $user['languages'] = $this->apiModel->flattenToMultiDimensional($this->languageModel->findLanguagesByUser($user['id']));
                $user['platforms'] = $this->apiModel->flattenToMultiDimensional($this->handleModel->findHandlesByUser($user['id']));
                $data = ["status" => true, "data" => $user, "message" => "success", "command" => "addNewCampaign"];
            } else {
                $data['message'] = "FAILED TO ADD NEW CAMPAIGN";
            }
        } else {
            $data['message'] = $this->validator->getError('cityId');
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('brandId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('campaignTypeId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('brandUserId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('currencyId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('categories');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('platforms');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('campaignName');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('campaignInfo');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('minEligibleRating');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('minReach');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('maxReach');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('costPerPost');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('totalBudget');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('startAt');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('endAt');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('dos');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('donts');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('hashtags');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('mentions');
            }
        }
        return die(json_encode($data));
    }

    /**
     * Adds a new campaign attachment.
     *
     * @param int $type (optional) The type of the campaign attachment.
     * @return void
     */
    public function addNewCampaignAttachment($type = 0)
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "addNewCampaignAttachment"];
        $rules = [
            'campaignId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'campaignId is REQUIRED',
                ],
            ],
            'title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'title is REQUIRED',
                ],
            ],
            'url' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'url is REQUIRED',
                ],
            ],
        ];
        if ($this->validate($rules)) {
            $data['data'] = [];
            $data['data']['campaignId'] = $this->request->getVar('campaignId');
            $data['data']['campaignAttachmentType'] = $type;
            $data['data']['campaignAttachmentName'] = $this->request->getVar('title');
            $data['data']['campaignAttachmentPriority'] = 0;
            $data['data']['campaignAttachmentStatus'] = 1;
            $data['data']['campaignAttachmentUrl'] = $this->request->getVar('url');
            $data['data']['id'] = $this->campaignModel->createCampaignAttachment($data['data']);
            if ($data['data']['id'] > 0) {
                $res = $this->apiModel->flattenToMultiDimensional($this->campaignModel->findOneCampaign($data['data']['campaignId']));
                $res['platforms'] = $this->apiModel->flattenToMultiDimensional($this->handleModel->getPlatformsByCampaign($data['data']['campaignId']));
                $res['moodBoards'] = $this->apiModel->flattenToMultiDimensional($this->campaignModel->findCampaignAttachments($data['data']['campaignId'], 3));
                $res['attachments'] = $this->apiModel->flattenToMultiDimensional($this->campaignModel->findCampaignAttachments($data['data']['campaignId'], 4));
                if ((!isset($res['brandId'])) || (is_null($res['brandId'])) || (empty($res['brandId']))) {
                    $res['brand'] = [];
                } else {
                    $res['brand'] = $this->apiModel->flattenToMultiDimensional($this->brandModel->findOneBrand($res['brandId']));
                }
                $data = ["status" => true, "data" => $res, "message" => "success", "command" => "addNewCampaignAttachment"];
            } else {
                $data['message'] = "FAILED TO ADD NEW RECORD";
            }
        } else {
            $data['message'] = $this->validator->getError('campaignId');
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('title');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('url');
            }
        }
        return die(json_encode(json_decode(json_encode($data), true)));
    }

    /**
     * Adds a new invite based on the provided data.
     *
     * This method validates the input data against a set of rules and adds a new invite if the validation passes.
     * If the validation fails, it returns an error message indicating the missing or invalid fields.
     *
     * @return void
     */
    public function addNewInvite()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "addNewInvite"];
        $rules = [
            'campaignId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'campaignId is REQUIRED',
                ],
            ],
            'influencerId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'influencerId is REQUIRED',
                ],
            ],
            'fromUserId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'fromUserId is REQUIRED',
                ],
            ],
            'toUserId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'toUserId is REQUIRED',
                ],
            ],
            'inviteMessage' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'inviteMessage is REQUIRED',
                ],
            ],
        ];
        if ($this->validate($rules)) {
            $data['ci'] = [];
            $data['ci']['campaignId'] = $this->request->getVar('campaignId');
            $data['ci']['influencerId'] = $this->request->getVar('influencerId');
            $data['ci']['fromUserId'] = $this->request->getVar('fromUserId');
            $data['ci']['toUserId'] = $this->request->getVar('toUserId');
            $data['ci']['inviteMessage'] = $this->request->getVar('inviteMessage');
            $data['ci']['status'] = 1;
            $data['ci']['id'] = $this->campaignInviteModel->addOne($data['ci']);
            if ($data['ci']['id'] > 0) {
                $data = ["status" => true, "data" => $data['ci'], "message" => "success", "command" => "addNewInvite"];
            } else {
                $data['message'] = "FAILED TO ADD NEW RECORD";
            }
        } else {
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('campaignId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('influencerId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('fromUserId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('toUserId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('inviteMessage');
            }
        }
        return die(json_encode(json_decode(json_encode($data), true)));
    }

    /**
     * Search for invites based on the given search criteria.
     *
     * @return void
     */
    public function searchInvite()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "searchInvite"];
        $search = json_decode(json_encode($this->request->getVar('search')), true);
        $invites = $this->apiModel->flattenToMultiDimensional($this->campaignInviteModel->searchAll($search));
        if (count($invites) > 0) {
            $data = ["status" => true, "data" => $invites, "message" => "success", "command" => "searchInvite"];
        } else {
            $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "searchInvite"];
        }
        return die(json_encode($data));
    }

    /**
     * Updates the invite status based on the request parameters.
     *
     * @return void
     */
    public function updateInvite()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "updateInvite"];
        $id = $this->request->getVar('id');
        $status = $this->request->getVar('status');
        $rejectReason = $this->request->getVar('rejectReason');
        $u = 0;
        if (intval($status) == 3) {
            $u = $this->campaignInviteModel->editOne(array('acceptedAt' => (date('Y-m-d H:i:s', time())), 'status' => 3), $id);
        } elseif (intval($status) == 5) {
            $u = $this->campaignInviteModel->editOne(array('rejectedAt' => (date('Y-m-d H:i:s', time())), 'rejectReason' => $rejectReason, 'status' => 5), $id);
        } else {
        }
        if ($u > 0) {
            $data = ["status" => true, "data" => [], "message" => "success", "command" => "updateInvite"];
        } else {
            $data = ["status" => false, "data" => [], "message" => "Failed To Update", "command" => "updateInvite"];
        }
        return die(json_encode($data));
    }

    /**
     * Adds a new review based on the provided data.
     *
     * @return void
     */
    public function addNewReview()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "addNewReview"];
        $rules = [
            'influencerId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'influencerId is REQUIRED',
                ],
            ],
            'brandId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'brandId is REQUIRED',
                ],
            ],
            'campaignId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'campaignId is REQUIRED',
                ],
            ],
            'rating1' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'rating1 is REQUIRED',
                ],
            ],
            'rating2' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'rating2 is REQUIRED',
                ],
            ],
            'rating3' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'rating3 is REQUIRED',
                ],
            ],
            'reviewType' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'reviewType is REQUIRED',
                ],
            ],
            'remark' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'remark is REQUIRED',
                ],
            ],
        ];
        if ($this->validate($rules)) {
            $data['ci'] = [];
            $data['ci']['influencerId'] = $this->request->getVar('influencerId');
            $data['ci']['brandId'] = $this->request->getVar('brandId');
            $data['ci']['campaignId'] = $this->request->getVar('campaignId');
            $data['ci']['rating1'] = $this->request->getVar('rating1');
            $data['ci']['rating2'] = $this->request->getVar('rating2');
            $data['ci']['rating3'] = $this->request->getVar('rating3');
            $data['ci']['reviewType'] = $this->request->getVar('reviewType');
            $data['ci']['remark'] = $this->request->getVar('remark');
            $data['ci']['priority'] = 1;
            $data['ci']['status'] = 1;
            $invites = $this->apiModel->flattenToMultiDimensional($this->reviewModel->searchAll(array("influencer" => ($data['ci']['influencerId']), "brand" => ($data['ci']['brandId']), "campaign" => ($data['ci']['campaignId']), "type" => ($data['ci']['reviewType']))));
            if (count($invites) > 0) {
                $data['message'] = "REVIEW ALREADY EXIST";
                unset($data['ci']);
            } else {
                $data['ci']['id'] = $this->reviewModel->addOne($data['ci']);
                if ($data['ci']['id'] > 0) {
                    $data = ["status" => true, "data" => $data['ci'], "message" => "success", "command" => "addNewReview"];
                } else {
                    $data['message'] = "FAILED TO ADD NEW RECORD";
                }
            }
        } else {
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('influencerId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('brandId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('campaignId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('rating1');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('rating2');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('rating3');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('reviewType');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('remark');
            }
        }
        return die(json_encode(json_decode(json_encode($data), true)));
    }

    /**
     * Searches for reviews based on the provided search criteria.
     *
     * @return void
     */
    public function searchReview()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "searchReview"];
        $search = json_decode(json_encode($this->request->getVar('search')), true);
        $invites = $this->apiModel->flattenToMultiDimensional($this->reviewModel->searchAll($search));
        if (count($invites) > 0) {
            $data = ["status" => true, "data" => $invites, "message" => "success", "command" => "searchReview"];
        } else {
            $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "searchReview"];
        }
        return die(json_encode($data));
    }

    /**
     * Adds a new payment request.
     *
     * This method validates the input data against a set of rules and adds a new payment request if the validation passes.
     * If the validation fails, it returns an error message.
     *
     * @return void
     */
    public function addNewPayReq()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "addNewPayReq"];
        $rules = [
            'userId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'userId is REQUIRED',
                ],
            ],
            'campaignId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'campaignId is REQUIRED',
                ],
            ],
            'amtReq' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'amtReq is REQUIRED',
                ],
            ],
            'draftId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'draftId is REQUIRED',
                ],
            ],
            'brandId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'brandId is REQUIRED',
                ],
            ],
            'paymentType' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'paymentType is REQUIRED',
                ],
            ],
        ];
        if ($this->validate($rules)) {
            $data['ci'] = [];
            $data['ci']['campaignId'] = $this->request->getVar('campaignId');
            $data['ci']['userId'] = $this->request->getVar('userId');
            $data['ci']['amtReq'] = $this->request->getVar('amtReq');
            $data['ci']['paidAt'] = $this->request->getVar('paidAt');
            $data['ci']['refNo'] = $this->request->getVar('refNo');
            $data['ci']['draftId'] = $this->request->getVar('draftId');
            $data['ci']['brandId'] = $this->request->getVar('brandId');
            $data['ci']['paymentType'] = $this->request->getVar('paymentType');
            $data['ci']['status'] = 1;
            $data['ci']['id'] = $this->payReqModel->addOne($data['ci']);
            if ($data['ci']['id'] > 0) {
                $data = ["status" => true, "data" => $data['ci'], "message" => "success", "command" => "addNewReview"];
            } else {
                $data['message'] = "FAILED TO ADD NEW RECORD";
            }

            //             $invites = $this->apiModel->flattenToMultiDimensional($this->payReqModel->searchAll(array("influencer" => ($data['ci']['userId']), "campaign" => ($data['ci']['campaignId']))));
            //             if (count($invites) > 0) {
            //                 $data['message'] = "PAY REQUEST ALREADY EXIST";
            //                 unset($data['ci']);
            //             } else {

            //             }
        } else {
            $data['message'] = "";
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('campaignId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('userId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('amtReq');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('draftId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('brandId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('paymentType');
            }
        }
        return die(json_encode(json_decode(json_encode($data), true)));
    }


    /**
     * Searches for pay requests based on the provided search criteria.
     *
     * @return void
     */
    public function searchPayReq()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "searchPayReq"];
        $search = json_decode(json_encode($this->request->getVar('search')), true);
        $invites = $this->apiModel->flattenToMultiDimensional($this->payReqModel->searchAll($search));
        if (count($invites) > 0) {
            $data = ["status" => true, "data" => $invites, "message" => "success", "command" => "searchPayReq"];
        } else {
            $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "searchPayReq"];
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves the received payment data.
     *
     * This method retrieves the received payment data based on the provided draftId and userId. It follows the following steps:
     * 1. Initializes the default response data with a status of false, empty data array, a default error message, and the command "addNewInboxMsg".
     * 2. Defines the validation rules for the required parameters draftId and userId.
     * 3. Validates the request parameters against the defined rules. If the validation passes:
     *    a. Retrieves the draftId and userId from the request.
     *    b. Calls the getRecived method of the payReqModel to fetch the received payment data.
     *    c. Flattens the fetched data to a multi
     */
    public function getReceivedPayment()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "addNewInboxMsg"];
        $rules = [
            'draftId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'draftId is REQUIRED',
                ],
            ],
            'userId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'userId is REQUIRED',
                ],
            ],
        ];

        if ($this->validate($rules)) {
            $draftId = $this->request->getVar('draftId');
            $userId = $this->request->getVar('userId');
            $msg = $this->apiModel->flattenToMultiDimensional($this->payReqModel->getRecived($userId, $draftId));
            if (count($msg) > 0) {
                $data = ["status" => true, "data" => $msg, "message" => "success", "command" => "searchInboxMsg"];
            } else {
                $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "searchInboxMsg"];
            }
            return die(json_encode($data));
        } else {
            $data['message'] = "";
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('draftId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('userId');
            }
        }
        return die(json_encode($data));
    }


    /**
     * Retrieves pending payment data based on the provided draftId and userId.
     *
     * @return void
     */
    public function getPendingPayment()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "addNewInboxMsg"];
        $rules = [
            'draftId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'draftId is REQUIRED',
                ],
            ],
            'userId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'userId is REQUIRED',
                ],
            ],
        ];

        if ($this->validate($rules)) {
            $draftId = $this->request->getVar('draftId');
            $userId = $this->request->getVar('userId');

            $msg = $this->apiModel->flattenToMultiDimensional($this->payReqModel->getPending($userId, $draftId));
            if (count($msg) > 0) {
                $data = ["status" => true, "data" => $msg, "message" => "success", "command" => "searchInboxMsg"];
            } else {
                $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "searchInboxMsg"];
            }
            return die(json_encode($data));
        } else {
            $data['message'] = "";
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('draftId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('userId');
            }
        }
        return die(json_encode($data));
    }
    /**
     * Update the payment status based on the request parameters.
     *
     * @return string
     */
    public function updatePayment()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "updatePayment"];
        $id = $this->request->getVar('id');
        $status = $this->request->getVar('status');
        $refNo = $this->request->getVar('refNo');


        $u = 0;
        // reject
        if (intval($status) == 3) {
            $u = $this->payReqModel->editOne(array('status' => 3), $id);
            // accept
        } elseif (intval($status) == 2) {
            $u = $this->payReqModel->editOne(array('paidAt' => (date('Y-m-d H:i:s', time())), 'refNo' => $refNo, 'status' => 2), $id);
        } else {
        }

        if ($u > 0) {
            $data = ["status" => true, "data" => [], "message" => "success", "command" => "updatePayment"];
        } else {
            $data = ["status" => false, "data" => [], "message" => "Failed To Update", "command" => "updatePayment"];
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves the payment status based on the provided userId.
     *
     * @return void
     */
    public function paymentStatus()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "paymentStatus"];
        $rules = [
            'userId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'userId is REQUIRED',
                ],
            ],
        ];

        if ($this->validate($rules)) {
            $userId = $this->request->getVar('userId');
            $msg = $this->apiModel->flattenToMultiDimensional($this->payReqModel->getPaymentStatus($userId));
            if (count($msg) > 0) {
                $data = ["status" => true, "data" => $msg, "message" => "success", "command" => "paymentStatus"];
            } else {
                $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "paymentStatus"];
            }
        } else {
            $data['message'] = "";
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('userId');
            }
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves the payment graph data based on the provided userId.
     *
     * @return void
     */
    public function paymentGraph()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "paymentGraph"];

        $rules = [
            'userId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'userId is REQUIRED',
                ],
            ],
        ];

        if ($this->validate($rules)) {
            $userId = $this->request->getVar('userId');
            $msg = $this->apiModel->flattenToMultiDimensional($this->payReqModel->getPaymentGraph($userId));
            if (count($msg) > 0) {
                $data = ["status" => true, "data" => $msg, "message" => "success", "command" => "paymentGraph"];
            } else {
                $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "paymentGraph"];
            }
        } else {
            $data['message'] = "";
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('userId');
            }
        }

        return die(json_encode($data));
    }

    /**
     * Retrieves the user review based on the provided userId.
     *
     * @return void
     */
    public function getUserReview()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getUserReview"];

        $rules = [
            'userId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'userId is REQUIRED',
                ],
            ],
        ];

        if ($this->validate($rules)) {
            $userId = $this->request->getVar('userId');
            $msg = $this->apiModel->flattenToMultiDimensional($this->reviewModel->getUserReview($userId));
            if (count($msg) > 0) {
                $data = ["status" => true, "data" => $msg, "message" => "success", "command" => "getUserReview"];
            } else {
                $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "getUserReview"];
            }
        } else {
            $data['message'] = "";
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('userId');
            }
        }

        return die(json_encode($data));
    }


    /**
     * Retrieves user handles based on the provided userId.
     *
     * @return void
     */
    public function getUserHandles()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getUserHandles"];

        $rules = [
            'userId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'userId is REQUIRED',
                ],
            ],
        ];

        if ($this->validate($rules)) {
            $userId = $this->request->getVar('userId');
            $msg = $this->apiModel->flattenToMultiDimensional($this->handleModel->getUserHandles($userId));
            if (count($msg) > 0) {
                $data = ["status" => true, "data" => $msg, "message" => "success", "command" => "getUserHandles"];
            } else {
                $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "getUserHandles"];
            }
        } else {
            $data['message'] = "";
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('userId');
            }
        }

        return die(json_encode($data));
    }

    /**
     * Retrieves user media based on the provided platformId.
     *
     * @return void
     */
    public function getUserMedia()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getUserMedia"];

        $rules = [
            'platformId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'platformId is REQUIRED',
                ],
            ],
        ];
        if ($this->validate($rules)) {
            $platformId = $this->request->getVar('platformId');
            $msg = $this->apiModel->flattenToMultiDimensional($this->handleModel->getUserMedia($platformId));
            if (count($msg) > 0) {
                $data = ["status" => true, "data" => $msg, "message" => "success", "command" => "getUserMedia"];
            } else {
                $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "getUserMedia"];
            }
        } else {
            $data['message'] = "";
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('platformId');
            }
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves the top influencer data.
     *
     * @return void
     */
    public function topInfluencer()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "topInfluencer"];
        $msg = $this->apiModel->flattenToMultiDimensional($this->handleModel->topInfluencer());
        if (count($msg) > 0) {
            $data = ["status" => true, "data" => $msg, "message" => "success", "command" => "topInfluencer"];
        } else {
            $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "topInfluencer"];
        }

        return die(json_encode($data));
    }



    /**
     * Adds a new inbox message.
     *
     * This method validates the input data against a set of rules and adds a new record to the inbox message table if the validation passes.
     * If the validation fails, it sets an appropriate error message based on the validation errors.
     *
     * @return void
     */
    public function addNewInboxMsg()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "addNewInboxMsg"];
        $rules = [
            'campaignDraftId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'campaignDraftId is REQUIRED',
                ],
            ],
            'fromUserId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'fromUserId is REQUIRED',
                ],
            ],
            'toUserId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'toUserId is REQUIRED',
                ],
            ],
            'comment' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'comment is REQUIRED',
                ],
            ],
        ];
        if ($this->validate($rules)) {
            $data['cd'] = [];
            $data['cd']['campaignDraftId'] = $this->request->getVar('campaignDraftId');
            $data['cd']['fromUserId'] = $this->request->getVar('fromUserId');
            $data['cd']['toUserId'] = $this->request->getVar('toUserId');
            $data['cd']['comment'] = $this->request->getVar('comment');
            $data['cd']['attach01'] = $this->request->getVar('attach01');
            $data['cd']['attach02'] = $this->request->getVar('attach02');
            $data['cd']['attach03'] = $this->request->getVar('attach03');
            $data['cd']['attach04'] = $this->request->getVar('attach04');
            $data['cd']['attach05'] = $this->request->getVar('attach05');
            $data['cd']['status'] = 1;
            $data['cd']['id'] = $this->inboxMsgModel->addOne($data['cd']);
            if ($data['cd']['id'] > 0) {
                $data = ["status" => true, "data" => $data['cd'], "message" => "success", "command" => "addNewInboxMsg"];
            } else {
                $data['message'] = "FAILED TO ADD NEW RECORD";
            }
        } else {
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('campaignDraftId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('fromUserId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('toUserId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('comment');
            }
        }
        return die(json_encode(json_decode(json_encode($data), true)));
    }

    /**
     * Searches for inbox messages based on the provided search criteria.
     *
     * @return void
     */
    public function searchInboxMsg()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "searchInboxMsg"];
        $search = json_decode(json_encode($this->request->getVar('search')), true);
        $msg = $this->apiModel->flattenToMultiDimensional($this->inboxMsgModel->searchAll($search));
        if (count($msg) > 0) {
            $data = ["status" => true, "data" => $msg, "message" => "success", "command" => "searchInboxMsg"];
        } else {
            $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "searchInboxMsg"];
        }
        return die(json_encode($data));
    }

    public function updateInboxMsg()
    /**
     * Update an inbox message based on the provided data and ID.
     *
     * @return void
     */
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "updateInboxMsg"];
        $id = $this->request->getVar('id');
        $d = json_decode(json_encode($this->request->getVar('data')), true);
        $u = $this->inboxMsgModel->editOne($d, $id);
        if ($u > 0) {
            $data = ["status" => true, "data" => [], "message" => "success", "command" => "updateInboxMsg"];
        } else {
            $data = ["status" => false, "data" => [], "message" => "Failed To Update", "command" => "updateInboxMsg"];
        }
        return die(json_encode($data));
    }

    /**
     * Adds a new campaign draft.
     *
     * This method validates the input data against a set of rules and adds a new campaign draft if the validation passes.
     * If the validation fails, it returns an error message indicating the missing or invalid fields.
     *
     * @return void
     */
    public function addNewCampaignDraft()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "addNewCampaignDraft"];
        $rules = [
            'campaignId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'campaignId is REQUIRED',
                ],
            ],
            'influencerId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'influencerId is REQUIRED',
                ],
            ],
            'handleId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'handleId is REQUIRED',
                ],
            ],
            'publishAt' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'publishAt is REQUIRED',
                ],
            ],
            'attach01' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'attach01 is REQUIRED',
                ],
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'description is REQUIRED',
                ],
            ],
        ];
        if ($this->validate($rules)) {
            $data['cd'] = [];
            $data['cd']['campaignId'] = $this->request->getVar('campaignId');
            $data['cd']['influencerId'] = $this->request->getVar('influencerId');
            $data['cd']['handleId'] = $this->request->getVar('handleId');
            $data['cd']['publishAt'] = $this->request->getVar('publishAt');
            $data['cd']['attach01'] = $this->request->getVar('attach01');
            $data['cd']['attach02'] = $this->request->getVar('attach02');
            $data['cd']['attach03'] = $this->request->getVar('attach03');
            $data['cd']['attach04'] = $this->request->getVar('attach04');
            $data['cd']['attach05'] = $this->request->getVar('attach05');
            $data['cd']['description'] = $this->request->getVar('description');
            $data['cd']['status'] = 1;
            $data['cd']['id'] = $this->campaignDraftModel->addOne($data['cd']);
            if ($data['cd']['id'] > 0) {
                $data = ["status" => true, "data" => $data['cd'], "message" => "success", "command" => "addNewCampaignDraft"];
            } else {
                $data['message'] = "FAILED TO ADD NEW RECORD";
            }
        } else {
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('campaignId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('influencerId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('handleId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('publishAt');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('description');
            }
        }
        return die(json_encode(json_decode(json_encode($data), true)));
    }


    /**
     * Searches for draft records based on the provided search criteria.
     *
     * @return void
     */
    public function searchDraft()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "searchDraft"];
        $search = json_decode(json_encode($this->request->getVar('search')), true);
        $drafts = $this->apiModel->flattenToMultiDimensional($this->campaignDraftModel->searchAll($search));
        if (count($drafts) > 0) {
            $data = ["status" => true, "data" => $drafts, "message" => "success", "command" => "searchDraft"];
        } else {
            $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "searchDraft"];
        }
        return die(json_encode($data));
    }


    /**
     * Update the draft based on the request parameters.
     *
     * @return void
     */
    public function updateDraft()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "updateDraft"];
        $id = $this->request->getVar('id');
        $status = $this->request->getVar('status');
        $rejectReason = $this->request->getVar('rejectReason');
        $linkCampaign = $this->request->getVar('linkCampaign');


        $publication_type = $this->request->getVar('publication_type');
        $target_react = $this->request->getVar('target_react');
        $publication_time = $this->request->getVar('publication_time');
        $draft_approval = $this->request->getVar('draft_approval');

        $u = 0;
        if (intval($status) == 3) {
            $u = $this->campaignDraftModel->editOne(array('acceptedAt' => (date('Y-m-d H:i:s', time())), 'status' => 3), $id);
        } elseif (intval($status) == 5) {
            $u = $this->campaignDraftModel->editOne(array('rejectedAt' => (date('Y-m-d H:i:s', time())), 'rejectReason' => $rejectReason, 'status' => 5), $id);
        } else {
        }
        if (isset($linkCampaign) || !is_null($linkCampaign)) {
            $u = $this->campaignDraftModel->editOne(array('linkCampaign' => $linkCampaign), $id);
        }

        if (isset($publication_type) || !is_null($publication_type) && isset($target_react) || !is_null($target_react) && isset($publication_time) || !is_null($publication_time) && isset($draft_approval) || !is_null($draft_approval)) {
            $u = $this->campaignDraftModel->editOne(array('publication_type' => $publication_type, 'target_react' => $target_react, 'publication_time' => $publication_time, 'draft_approval' => $draft_approval), $id);
        }

        if ($u > 0) {
            $data = ["status" => true, "data" => [], "message" => "success", "command" => "updateDraft"];
        } else {
            $data = ["status" => false, "data" => [], "message" => "Failed To Update", "command" => "updateDraft"];
        }
        return die(json_encode($data));
    }


    /**
     * Review the draft by updating the brand and influencer ratings and review messages.
     *
     * @return void
     */
    public function reviewDraft()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "reviewDraft"];
        $u = 0;
        $id = $this->request->getVar('id');
        $brandRating = $this->request->getVar('brandRating');
        $influencerRating = $this->request->getVar('influencerRating');
        $brandReviewMessage = $this->request->getVar('brandReviewMessage');
        $influencerReviewMessage = $this->request->getVar('influencerReviewMessage');
        if (floatval($brandRating) > 0) {
            $u = $this->campaignDraftModel->editOne(array('brandRating' => $brandRating, 'brandReviewMessage' => $brandReviewMessage), $id);
        } elseif (floatval($influencerRating) > 0) {
            $u = $this->campaignDraftModel->editOne(array('influencerRating' => $influencerRating, 'influencerReviewMessage' => $influencerReviewMessage), $id);
        } else {
        }
        if ($u > 0) {
            $data = ["status" => true, "data" => [], "message" => "success", "command" => "reviewDraft"];
        } else {
            $data = ["status" => false, "data" => [], "message" => "Failed To Update", "command" => "reviewDraft"];
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves campaign data based on the provided campaign ID.
     *
     * @return void
     */
    public function getCampaign()
    {
        $this->session->destroy();
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getCampaign"];
        $id = $this->request->getVar('id');
        if (!isset($id) || is_null($id) || empty($id) || ($id <= 0)) {
            $data['message'] = "INVALID CAMPAIGN ID";
        } else {
            $res = $this->apiModel->flattenToMultiDimensional($this->campaignModel->findOneCampaign($id));
            $res['platforms'] = $this->apiModel->flattenToMultiDimensional($this->handleModel->getPlatformsByCampaign($id));
            $res['moodBoards'] = $this->apiModel->flattenToMultiDimensional($this->campaignModel->findCampaignAttachments($id, 3));
            $res['attachments'] = $this->apiModel->flattenToMultiDimensional($this->campaignModel->findCampaignAttachments($id, 4));
            if ((!isset($res['brandId'])) || (is_null($res['brandId'])) || (empty($res['brandId']))) {
                $res['brand'] = [];
            } else {
                $res['brand'] = $this->apiModel->flattenToMultiDimensional($this->brandModel->findOneBrand($res['brandId']));
            }
            $data = ["status" => true, "data" => $res, "message" => "success", "command" => "getCampaign"];
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves the campaigns associated with the user.
     *
     * @return void
     */
    public function getMyCampaigns()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getMyCampaigns"];
        $user['id'] = $this->request->getVar('id');
        if (!isset($user['id']) || is_null($user['id']) || empty($user['id']) || ($user['id'] <= 0)) {
            $data['message'] = "INVALID USER ID";
        } else {
            $user = $this->apiModel->flattenToMultiDimensional($this->userModel->findOneUser($user['id']));
            $user['brand'] = $this->apiModel->flattenToMultiDimensional($this->brandModel->findOneBrand($user['brandId']));
            $user['categories'] = $this->apiModel->flattenToMultiDimensional($this->categoryModel->findCategoriesByUser($user['id']));
            $user['languages'] = $this->apiModel->flattenToMultiDimensional($this->languageModel->findLanguagesByUser($user['id']));
            $user['platforms'] = $this->apiModel->flattenToMultiDimensional($this->handleModel->findHandlesByUser($user['id']));
            $user['campaigns'] = [];
            $campaigns = $this->campaignModel->findCampaignsByUser($user['id']);
            for ($i = 0; $i < count($campaigns); $i++) {
                $campaigns[$i]['platforms'] = $this->apiModel->flattenToMultiDimensional($this->handleModel->getPlatformsByCampaign($campaigns[$i]['id']));
                $campaigns[$i]['moodBoards'] = $this->apiModel->flattenToMultiDimensional($this->campaignModel->findCampaignAttachments($campaigns[$i]['id'], 3));
                $campaigns[$i]['attachments'] = $this->apiModel->flattenToMultiDimensional($this->campaignModel->findCampaignAttachments($campaigns[$i]['id'], 4));
                if ((!isset($campaigns[$i]['brandId'])) || (is_null($campaigns[$i]['brandId'])) || (empty($campaigns[$i]['brandId']))) {
                    $campaigns[$i]['brand'] = [];
                } else {
                    $campaigns[$i]['brand'] = $this->apiModel->flattenToMultiDimensional($this->brandModel->findOneBrand($campaigns[$i]['brandId']));
                }
                array_push($user['campaigns'], $this->apiModel->flattenToMultiDimensional($campaigns[$i]));
            }
            $data = ["status" => true, "data" => $user, "message" => "success", "command" => "getMyCampaigns"];
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves the top campaigns.
     *
     * This method retrieves the top campaigns and returns them in a JSON format.
     *
     * @return void
     */
    public function getTopCampaigns()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getTopCampaigns"];
        $user['campaigns'] = [];
        $campaigns = $this->campaignModel->getTopCampaigns();
        for ($i = 0; $i < count($campaigns); $i++) {
            $campaigns[$i]['platforms'] = $this->apiModel->flattenToMultiDimensional($this->handleModel->getPlatformsByCampaign($campaigns[$i]['id']));
            $campaigns[$i]['moodBoards'] = $this->apiModel->flattenToMultiDimensional($this->campaignModel->findCampaignAttachments($campaigns[$i]['id'], 3));
            $campaigns[$i]['attachments'] = $this->apiModel->flattenToMultiDimensional($this->campaignModel->findCampaignAttachments($campaigns[$i]['id'], 4));
            if ((!isset($campaigns[$i]['brandId'])) || (is_null($campaigns[$i]['brandId'])) || (empty($campaigns[$i]['brandId']))) {
                $campaigns[$i]['brand'] = [];
            } else {
                $campaigns[$i]['brand'] = $this->apiModel->flattenToMultiDimensional($this->brandModel->findOneBrand($campaigns[$i]['brandId']));
            }
            array_push($user['campaigns'], $this->apiModel->flattenToMultiDimensional($campaigns[$i]));
        }
        $data = ["status" => true, "data" => $user, "message" => "success", "command" => "getTopCampaigns"];
        return die(json_encode($data));
    }

    /**
     * Search for campaigns based on the provided parameters.
     *
     * @return void
     */
    public function searchCampaign()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "searchCampaign"];
        $id = $this->request->getVar('id');
        $platform = $this->request->getVar('platform');
        $name = $this->request->getVar('name');
        $category = $this->request->getVar('category');
        $city = $this->request->getVar('city');
        $brand = $this->request->getVar('brand');
        $type = $this->request->getVar('type');
        $user = $this->request->getVar('user');
        $currency = $this->request->getVar('currency');
        $active = $this->request->getVar('active');
        $minReach = $this->request->getVar('minReach');
        $maxReach = $this->request->getVar('maxReach');
        $costPerPost = $this->request->getVar('costPerPost');
        $minTarget = $this->request->getVar('minTarget');
        $totalTarget = $this->request->getVar('totalTarget');
        $minRating = $this->request->getVar('minRating');
        $endDate = $this->request->getVar('endDate');
        $complete = $this->request->getVar('complete');
        $isPublic = $this->request->getVar('isPublic');

        $campaigns = $this->campaignModel->searchCampaigns($id, $name, $platform, $category, $city, $brand, $type, $user, $currency, $active, $minReach, $maxReach, $costPerPost, $minTarget, $totalTarget, $minRating, $endDate, $complete, $isPublic);
        for ($i = 0; $i < count($campaigns); $i++) {
            $campaigns[$i] = $this->apiModel->flattenToMultiDimensional($campaigns[$i]);
            $campaigns[$i]['platforms'] = $this->handleModel->getPlatformsByCampaign($campaigns[$i]['id']);
            $campaigns[$i]['moodBoards'] = $this->apiModel->flattenToMultiDimensional($this->campaignModel->findCampaignAttachments($campaigns[$i]['id'], 3));
            $campaigns[$i]['attachments'] = $this->apiModel->flattenToMultiDimensional($this->campaignModel->findCampaignAttachments($campaigns[$i]['id'], 4));
            if ((!isset($campaigns[$i]['brandId'])) || (is_null($campaigns[$i]['brandId'])) || (empty($campaigns[$i]['brandId']))) {
                $campaigns[$i]['brand'] = [];
            } else {
                $campaigns[$i]['brand'] = $this->apiModel->flattenToMultiDimensional($this->brandModel->findOneBrand($campaigns[$i]['brandId']));
            }
        }
        if (count($campaigns) > 0) {
            $data = ["status" => true, "data" => $campaigns, "message" => "success", "command" => "searchCampaign"];
        } else {
            $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "searchCampaign"];
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves the brand information based on the provided brand ID.
     * 
     * @return void
     */
    public function getBrand()
    {
        $this->session->destroy();
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getBrand"];
        $brandId = $this->request->getVar('id');
        if (!isset($brandId) || is_null($brandId) || empty($brandId) || ($brandId <= 0)) {
            $data['message'] = "INVALID BRAND ID";
        } else {
            $brand = $this->apiModel->flattenToMultiDimensional($this->brandModel->findOneBrand($brandId));
            $data = ["status" => true, "data" => $brand, "message" => "success", "command" => "getBrand"];
        }
        return die(json_encode($data));
    }

    /**
     * Search for brands based on the provided parameters.
     *
     * @return void
     */
    public function searchBrand()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "searchBrand"];
        $id = $this->request->getVar('id');
        $search = $this->request->getVar('search');
        $active = $this->request->getVar('active');
        $markets = $this->request->getVar('markets');
        $categories = $this->request->getVar('categories');
        $brands = $this->apiModel->flattenToMultiDimensional($this->brandModel->searchBrands($id, $search, $active, $markets, $categories));
        if (count($brands) > 0) {
            $data = ["status" => true, "data" => $brands, "message" => "success", "command" => "searchBrand"];
        } else {
            $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "searchBrand"];
        }
        return die(json_encode($data));
    }
    /**
     * Retrieves the brand connection data.
     *
     * This function retrieves the brand connection data based on the provided brandId. If the brandId is not provided or is null, an error message is returned. If the brand connection data is found, it is returned as a JSON response with a success message. If no record is found, an error message is returned.
     *
     * @return void
     */
    public function getBrandConnection()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getBrandConnection"];
        $brandId = $this->request->getVar('brandId');
        if (!isset($brandId) || is_null($brandId)) {
            $data = ["status" => false, "data" => [], "message" => "Please provide brandId", "command" => "getBrandConnection"];
        } else {
            $brandsConnection = $this->apiModel->flattenToMultiDimensional($this->brandModel->getbrandConnection($brandId));
            if (count($brandsConnection) > 0) {
                $data = ["status" => true, "data" => $brandsConnection, "message" => "success", "command" => "getBrandConnection"];
            } else {
                $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "getBrandConnection"];
            }
        }
        return die(json_encode($data));
    }
    /**
     * Retrieves the brand communication and campaign data.
     *
     * @return void
     */
    public function getBrandComCam()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getBrandComCam"];
        $brandId = $this->request->getVar('brandId');
        if (!isset($brandId) || is_null($brandId)) {
            $data = ["status" => false, "data" => [], "message" => "Please provide brandId", "command" => "getBrandComCam"];
        } else {
            $brandsConnection = $this->apiModel->flattenToMultiDimensional($this->brandModel->getBrandComCam($brandId));
            if (count($brandsConnection) > 0) {
                $data = ["status" => true, "data" => $brandsConnection, "message" => "success", "command" => "getBrandComCam"];
            } else {
                $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "getBrandComCam"];
            }
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves user analytics data.
     *
     * This function retrieves user analytics data based on the provided user ID. It first checks if a JSON file exists for the given ID. If the file exists, it reads the contents of the file and decodes it into an associative array. If the file does not exist or the decoded data is null, it sets the response data to indicate that no record was found. Otherwise, it sets the response data to indicate success and includes the retrieved user analytics data.
     *
     * @return void
     */
    public function userAnalytics()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "userAnalytics"];
        $id = $this->request->getVar('id');
        if (file_exists(FCPATH . 'public/json/' . $id . '.json')) {
            $userAnalytics = json_decode(file_get_contents(FCPATH . 'public/json/' . $id . '.json'), true);
        } else {
            $userAnalytics = null;
        }
        if (!is_null($userAnalytics)) {
            $data = ["status" => true, "data" => $userAnalytics, "message" => "success", "command" => "userAnalytics"];
        } else {
            $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "userAnalytics"];
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves the top brands from the database and returns them as a JSON response.
     *
     * @return void
     */
    public function topBrands()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "topBrands"];
        $brands = $this->apiModel->flattenToMultiDimensional($this->brandModel->getTopBrands());
        if (count($brands) > 0) {
            $data = ["status" => true, "data" => $brands, "message" => "success", "command" => "topBrands"];
        } else {
            $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "topBrands"];
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves the brand information for a user.
     *
     * This method retrieves the brand information for a user based on the provided user ID. It first checks if the user ID is valid, and if not, it sets an error message indicating an invalid user ID. If the user ID is valid, it retrieves the user, brand, categories, languages, and platforms associated with the user. The retrieved data is then flattened into a multi-dimensional array using the `flattenToMultiDimensional` method of the `apiModel`. Finally, the method returns a JSON-encoded response containing the status, data, message, and command information.
     *
     * @return void
     */
    public function getBrandByUser()
    {
        $this->session->destroy();
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getBrandByUser"];
        $user = [];
        $user['id'] = $this->request->getVar('userId');
        if (!isset($user['id']) || is_null($user['id']) || empty($user['id']) || ($user['id'] <= 0)) {
            $data['message'] = "INVALID USER ID";
        } else {
            $user = $this->apiModel->flattenToMultiDimensional($this->userModel->findOneUser($user['id']));
            $user['brand'] = $this->apiModel->flattenToMultiDimensional($this->brandModel->findOneBrand($user['brandId']));
            $user['categories'] = $this->apiModel->flattenToMultiDimensional($this->categoryModel->findCategoriesByUser($user['id']));
            $user['languages'] = $this->apiModel->flattenToMultiDimensional($this->languageModel->findLanguagesByUser($user['id']));
            $user['platforms'] = $this->apiModel->flattenToMultiDimensional($this->handleModel->findHandlesByUser($user['id']));
            $data = ["status" => true, "data" => $user, "message" => "success", "command" => "getBrandByUser"];
        }
        return die(json_encode($data));
    }

    /**
     * Searches for users based on the provided search parameters.
     *
     * @return void
     */
    public function searchUser()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "searchUser"];
        $ud['id'] = $this->request->getVar('id');
        $ud['city'] = $this->request->getVar('city');
        $ud['brand'] = $this->request->getVar('brand');
        $ud['currency'] = $this->request->getVar('currency');
        $ud['search'] = $this->request->getVar('search');
        $ud['gender'] = $this->request->getVar('gender');
        $ud['role'] = $this->request->getVar('role');
        $ud['age'] = $this->request->getVar('age');
        $ud['category'] = $this->request->getVar('category');
        $ud['language'] = $this->request->getVar('language');
        $ud['rating'] = $this->request->getVar('rating');
        $ud['platform'] = $this->request->getVar('platform');
        $ud['active'] = $this->request->getVar('active');
        $users = $this->userModel->searchUser($ud);
        for ($i = 0; $i < count($users); $i++) {
            $user = $this->apiModel->flattenToMultiDimensional($this->userModel->findOneUser($users[$i]['id']));
            $user['brand'] = $this->apiModel->flattenToMultiDimensional($this->brandModel->findOneBrand($users[$i]['brandId']));
            $user['categories'] = $this->apiModel->flattenToMultiDimensional($this->categoryModel->findCategoriesByUser($users[$i]['id']));
            $user['languages'] = $this->apiModel->flattenToMultiDimensional($this->languageModel->findLanguagesByUser($users[$i]['id']));
            $user['platforms'] = $this->apiModel->flattenToMultiDimensional($this->handleModel->findHandlesByUser($users[$i]['id']));
            $user['profileCompleteness'] = $this->apiModel->checkProfileCompleteness($user);
            $user['platformsdata'] = "data";

            if (count($user['platforms']) > 0) {
                $user['platformsdata'] = $this->apiModel->flattenToMultiDimensional($this->instaHandleModel->getUserById($user["id"], $user['platforms'][0]['id']));
            }
            $users[$i] = $user;
        }
        if (count($users) > 0) {
            $data = ["status" => true, "data" => $users, "message" => "success", "command" => "searchUser"];
        } else {
            $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "searchUser"];
        }
        return die(json_encode($data));
    }

    /**
     * Checks if the given object and field are set, and adds the field value to the session.
     *
     * @param mixed|null $obj
     * @param string|null $field
     * @return void
     */
    public function checkAndAddSession($obj = null, $field = null)
    {
        if (!isset($obj) || is_null($obj) || empty($obj)) {
            $obj[$field] = '';
        } else if (!isset($field) || is_null($field) || empty($field)) {
            $obj[$field] = '';
        } else {
            $this->session->set($field, $obj[$field]);
        }
    }

    /**
     * Get the platform data.
     *
     * This method retrieves the platform data by calling the `getAllhandles` method on the `handleModel` object.
     * If the result is null, it sets the response data to indicate an error occurred.
     * Otherwise, it sets the response data to indicate success and includes the retrieved data.
     *
     * @return void
     */
    public function getplatform()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getplatform"];
        $restult = $this->handleModel->getAllhandles();
        if ($restult == null) {
            $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getplatform"];
        } else {
            $data = ["status" => true, "data" => $restult, "message" => "success", "command" => "getplatform"];
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves the currency data.
     *
     * @return void
     */
    public function getcurrency()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getcurrency"];
        $restult = $this->handleModel->getAllcurrency();
        if ($restult == null) {
            $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getcurrency"];
        } else {
            $data = ["status" => true, "data" => $restult, "message" => "success", "command" => "getcurrency"];
        }
        return die(json_encode($data));
    }

    /**
     * Get the campaign type.
     *
     * @return void
     */
    public function getCampaignType()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getcategory"];
        $restult = $this->handleModel->getAllCampaignType();
        if ($restult == null) {
            $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getcategory"];
        } else {
            $data = ["status" => true, "data" => $restult, "message" => "success", "command" => "getcategory"];
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves the category data.
     *
     * @return void
     */
    public function getcategory()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getcategory"];
        $restult = $this->handleModel->getAllcategory();
        if ($restult == null) {
            $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getcategory"];
        } else {
            $data = ["status" => true, "data" => $restult, "message" => "success", "command" => "getcategory"];
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves a category by its ID.
     *
     * @return void
     */
    public function getCategoryByid()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getCategoryByid"];
        $id = $this->request->getVar("id");
        if (!isset($id) || is_null($id) || empty($id)) {
            $data = ["status" => false, "data" => [], "message" => "Please provide id", "command" => "getCategoryByid"];
        } else {
            $restult = $this->apiModel->flattenToMultiDimensional($this->categoryModel->getOne($id));
            if ($restult == 0) {
                $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getCategoryByid"];
            } else {
                $data = ["status" => true, "data" => [$restult[0]], "message" => "successfully get the data", "command" => "getCategoryByid"];
            }
        }
        return die(json_encode(json_decode(json_encode($data), true)));
    }

    /**
     * Deletes a category.
     *
     * This method deletes a category based on the provided ID. It first checks if the ID is provided and not empty. If the ID is not provided or empty, it returns an error message indicating that the ID is required. If the ID is provided, it calls the `delOne` method of the category model to delete the category with the given ID. It then flattens the result using the `flattenToMultiDimensional` method of the API model. If the result is empty, it returns an error message indicating that something went wrong. If the result is not empty, it returns a success message along with the deleted category data.
     *
     * @return void
     */
    public function delCategory()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "delCategory"];
        $id = $this->request->getVar("id");
        if (!isset($id) || is_null($id) || empty($id)) {
            $data = ["status" => false, "data" => [], "message" => "Please provide id", "command" => "delCategory"];
        } else {
            $restult = $this->apiModel->flattenToMultiDimensional($this->categoryModel->delOne($id));
            if (count($restult) == 0) {
                $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "delCategory"];
            } else {
                $data = ["status" => true, "data" => [$restult[0]], "message" => "successfully get the data", "command" => "delCategory"];
            }
        }
        return die(json_encode($data));
    }

    /**
     * Update a category.
     *
     * This method is responsible for updating a category based on the provided data.
     * It validates the input data against the defined rules and returns a JSON response
     * with the updated category information or an error message if validation fails.
     *
     * @return void
     */
    public function updCategory()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "updCategory"];
        $rules = [
            'categoryName' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'categoryName is REQUIRED',
                ],
            ],
            'categoryCode' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'categoryCode is REQUIRED',
                ],
            ],
        ];
        $id = $this->request->getVar("id");
        if (!isset($id) || is_null($id) || empty($id)) {
            $data = ["status" => false, "data" => [], "message" => "Please provide id", "command" => "updCategory"];
        } else {
            if ($this->validate($rules)) {
                $newdata['ad'] = [];
                $newdata['ad']['categoryName'] = $this->request->getVar('categoryName');
                $newdata['ad']['categoryCode'] = $this->request->getVar('categoryCode');
                $result = $this->apiModel->flattenToMultiDimensional($this->categoryModel->editOne($newdata["ad"], $id));
                if (count($result) <= 0) {
                    $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "updCategory"];
                } else {
                    $data = ["status" => true, "data" => $result, "message" => "success", "command" => "updCategory"];
                }
            } else {
                $data['message'] = $this->validator->getError('categoryName');
                if (empty($data['message'])) {
                    $data['message'] = $this->validator->getError('categoryCode');
                }
            }
        }
        return die(json_encode($data));
    }

    /**
     * Adds a new category.
     *
     * This method validates the input data against the specified rules and adds a new category to the database if the validation passes.
     * If the validation fails, an error message is returned.
     *
     * @return void
     */
    public function addCategory()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "addCategory"];
        $rules = [
            'categoryName' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'categoryName is REQUIRED',
                ],
            ],
            'categoryCode' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'categoryCode is REQUIRED',
                ],
            ],
        ];

        if ($this->validate($rules)) {
            $newdata['ad'] = [];
            $newdata['ad']['categoryName'] = $this->request->getVar('categoryName');
            $newdata['ad']['categoryCode'] = $this->request->getVar('categoryCode');
            $newdata['ad']['categoryStatus'] = 1;
            $newdata['ad']['id'] = $this->categoryModel->createCategory($newdata['ad']);
            if ($newdata['ad']['id'] > 0) {
                $data = ["status" => true, "data" => $newdata['ad'], "message" => "success", "command" => "addCategory"];
            } else {
                $data['message'] = "FAILED TO ADD NEW RECORD";
                $data['status'] = false;
            }
        } else {
            $data['message'] = $this->validator->getError('categoryName');
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('categoryCode');
            }
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves the language data.
     *
     * @return void
     */
    public function getlanguage()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getlanguage"];
        $restult = $this->handleModel->getAlllanguage();
        if ($restult == null) {
            $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getlanguage"];
        } else {
            $data = ["status" => true, "data" => $restult, "message" => "success", "command" => "getlanguage"];
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves country data based on the provided parameters.
     *
     * @return void
     */
    public function getCountry()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getCountry"];
        $id = $this->request->getVar('id');
        $stateId = $this->request->getVar('stateId');
        $cityId = $this->request->getVar('cityId');
        $restult = [];
        if (!((!isset($id)) || (is_null($id)) || (empty($id)))) {
            $restult = [$this->apiModel->flattenToMultiDimensional($this->countryModel->getOne($id))];
        } elseif (!((!isset($stateId)) || (is_null($stateId)) || (empty($stateId)))) {
            $restult = [$this->apiModel->flattenToMultiDimensional($this->countryModel->getOneByState($stateId))];
        } elseif (!((!isset($cityId)) || (is_null($cityId)) || (empty($cityId)))) {
            $restult = [$this->apiModel->flattenToMultiDimensional($this->countryModel->getOneByCity($cityId))];
        } else {
            $restult = $this->apiModel->flattenToMultiDimensional($this->countryModel->getAll());
        }
        if ($restult == null) {
            $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getCountry"];
        } else {
            $data = ["status" => true, "data" => $restult, "message" => "success", "command" => "getCountry"];
        }
        return die(json_encode(json_decode(json_encode($data), true)));
    }

    /**
     * Retrieves the handle based on the provided parameters.
     *
     * @return void
     */
    public function getHandle()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getHandle"];
        $id = $this->request->getVar('id');
        $userId = $this->request->getVar('userId');
        $platformId = $this->request->getVar('platformId');
        $restult = [];
        if (!((!isset($id)) || (is_null($id)) || (empty($id)))) {
            $restult = [$this->apiModel->flattenToMultiDimensional($this->handleModel->getOne($id))];
        } elseif (!((!isset($platformId)) || (is_null($platformId)) || (empty($platformId)) || (!isset($userId)) || (is_null($userId)) || (empty($userId)))) {
            $restult = $this->apiModel->flattenToMultiDimensional($this->handleModel->getAllByUserAndPlatform($userId, $platformId));
        } elseif (!((!isset($userId)) || (is_null($userId)) || (empty($userId)))) {
            $restult = $this->apiModel->flattenToMultiDimensional($this->handleModel->getAllByUser($userId));
        } else {
            $restult = $this->apiModel->flattenToMultiDimensional($this->handleModel->getAll());
        }
        if ($restult == null) {
            $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getHandle"];
        } else {
            $data = ["status" => true, "data" => $restult, "message" => "success", "command" => "getHandle"];
        }
        return die(json_encode(json_decode(json_encode($data), true)));
    }

    /**
     * Get the state data based on the provided parameters.
     *
     * @return void
     */
    public function getState()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getState"];
        $id = $this->request->getVar('id');
        $countryId = $this->request->getVar('countryId');
        $cityId = $this->request->getVar('cityId');
        $restult = [];
        if (!((!isset($id)) || (is_null($id)) || (empty($id)))) {
            $restult = [$this->apiModel->flattenToMultiDimensional($this->stateModel->getOne($id))];
        } elseif (!((!isset($countryId)) || (is_null($countryId)) || (empty($countryId)))) {
            $restult = $this->apiModel->flattenToMultiDimensional($this->stateModel->getAllByCountry($countryId));
        } elseif (!((!isset($cityId)) || (is_null($cityId)) || (empty($cityId)))) {
            $restult = [$this->apiModel->flattenToMultiDimensional($this->stateModel->getOneByCity($cityId))];
        } else {
            $restult = $this->apiModel->flattenToMultiDimensional($this->stateModel->getAll());
        }
        if ($restult == null) {
            $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getState"];
        } else {
            $data = ["status" => true, "data" => $restult, "message" => "success", "command" => "getState"];
        }
        return die(json_encode(json_decode(json_encode($data), true)));
    }

    /**
     * Retrieves city data based on the provided parameters.
     *
     * @return void
     */
    public function getCity()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getCity"];
        $id = $this->request->getVar('id');
        $countryId = $this->request->getVar('countryId');
        $stateId = $this->request->getVar('stateId');
        $search = $this->request->getVar('search');
        $restult = [];
        if (!((!isset($id)) || (is_null($id)) || (empty($id)))) {
            $restult = [$this->apiModel->flattenToMultiDimensional($this->cityModel->getOne($id, $search))];
        } elseif (!((!isset($countryId)) || (is_null($countryId)) || (empty($countryId)))) {
            $restult = $this->apiModel->flattenToMultiDimensional($this->cityModel->getAllByCountry($countryId, $search));
        } elseif (!((!isset($stateId)) || (is_null($stateId)) || (empty($stateId)))) {
            $restult = $this->apiModel->flattenToMultiDimensional($this->cityModel->getAllByState($stateId, $search));
        } else {
            $restult = $this->apiModel->flattenToMultiDimensional($this->cityModel->getAll($search));
        }

        if ($restult == null) {
            $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getCity"];
        } else {
            $data = ["status" => true, "data" => $restult, "message" => "success", "command" => "getCity"];
        }
        return die(json_encode(json_decode(json_encode($data), true)));
    }

    /**
     * Retrieves market data by its ID.
     *
     * @return void
     */
    public function getMarketByid()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getMarketByid"];
        $id = $this->request->getVar("id");
        if (!isset($id) || is_null($id) || empty($id)) {
            $data = ["status" => false, "data" => [], "message" => "Please provide id", "command" => "getMarketByid"];
        } else {
            $restult = $this->apiModel->flattenToMultiDimensional($this->marketModel->getOne($id));
            if ($restult == 0) {
                $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getMarketByid"];
            } else {
                $data = ["status" => true, "data" => [$restult[0]], "message" => "successfully get the data", "command" => "getMarketByid"];
            }
        }
        return die(json_encode(json_decode(json_encode($data), true)));
    }

    /**
     * Retrieves market data based on the provided parameters.
     *
     * @return void
     */
    public function getMarket()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getMarket"];
        $id = $this->request->getVar('id');
        $userId = $this->request->getVar('userId');
        $restult = [];
        if (!((!isset($id)) || (is_null($id)) || (empty($id)))) {
            $restult = [$this->apiModel->flattenToMultiDimensional($this->marketModel->getOne($id))];
        } elseif (!((!isset($userId)) || (is_null($userId)) || (empty($userId)))) {
            $restult = $this->apiModel->flattenToMultiDimensional($this->marketModel->getAllByUser($userId));
        } else {
            $restult = $this->apiModel->flattenToMultiDimensional($this->marketModel->getAll());
        }
        if ($restult == null) {
            $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getMarket"];
        } else {
            $data = ["status" => true, "data" => $restult, "message" => "success", "command" => "getMarket"];
        }
        return die(json_encode(json_decode(json_encode($data), true)));
    }

    /**
     * Adds a new market.
     *
     * This method validates the input data against the specified rules and adds a new market to the database if the validation passes.
     * If the validation fails, an error message is returned.
     *
     * @return void
     */
    public function addMarket()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "addMarket"];
        $rules = [
            'marketName' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'marketName is REQUIRED',
                ],
            ],
            'marketCode' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'marketCode is REQUIRED',
                ],
            ],
        ];

        if ($this->validate($rules)) {
            $newdata['ad'] = [];
            $newdata['ad']['marketName'] = $this->request->getVar('marketName');
            $newdata['ad']['marketCode'] = $this->request->getVar('marketCode');
            $newdata['ad']['marketStatus'] = 1;
            $newdata['ad']['id'] = $this->marketModel->addOne($newdata['ad']);
            if ($newdata['ad']['id'] > 0) {
                $data = ["status" => true, "data" => $newdata['ad'], "message" => "success", "command" => "addTeam"];
            } else {
                $data['message'] = "FAILED TO ADD NEW RECORD";
                $data['status'] = false;
            }
        } else {
            $data['message'] = $this->validator->getError('marketName');
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('marketCode');
            }
        }
        return die(json_encode($data));
    }

    /**
     * Update the market data.
     *
     * This method is responsible for updating the market data based on the provided parameters.
     * It validates the input data against the defined rules and returns the updated market data in JSON format.
     *
     * @return void
     */
    public function updMarket()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "updMarket"];
        $rules = [
            'marketName' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'marketName is REQUIRED',
                ],
            ],
            'marketCode' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'marketCode is REQUIRED',
                ],
            ],
        ];
        $id = $this->request->getVar("id");
        if (!isset($id) || is_null($id) || empty($id)) {
            $data = ["status" => false, "data" => [], "message" => "Please provide id", "command" => "updMarket"];
        } else {
            if ($this->validate($rules)) {
                $newdata['ad'] = [];
                $newdata['ad']['marketName'] = $this->request->getVar('marketName');
                $newdata['ad']['marketCode'] = $this->request->getVar('marketCode');
                $result = $this->apiModel->flattenToMultiDimensional($this->marketModel->editOne($newdata["ad"], $id));
                if (count($result) <= 0) {
                    $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "updMarket"];
                } else {
                    $data = ["status" => true, "data" => $result, "message" => "success", "command" => "updMarket"];
                }
            } else {
                $data['message'] = $this->validator->getError('marketName');
                if (empty($data['message'])) {
                    $data['message'] = $this->validator->getError('marketCode');
                }
            }
        }


        return die(json_encode($data));
    }

    /**
     * Deletes a market.
     *
     * This method deletes a market based on the provided ID. It first checks if the ID is provided and not empty. If the ID is not provided or empty, it returns an error message indicating that the ID is required. If the ID is provided, it calls the `delOne` method of the `marketModel` object to delete the market. It then flattens the result using the `flattenToMultiDimensional` method of the `apiModel` object. If the result is empty, it returns an error message indicating that something went wrong. If the result is not empty, it returns a success message along with the deleted market data.
     *
     * @return void
     */
    public function delMarket()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "delMarket"];
        $id = $this->request->getVar("id");
        if (!isset($id) || is_null($id) || empty($id)) {
            $data = ["status" => false, "data" => [], "message" => "Please provide id", "command" => "delMarket"];
        } else {
            $restult = $this->apiModel->flattenToMultiDimensional($this->marketModel->delOne($id));
            if (count($restult) == 0) {
                $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "delMarket"];
            } else {
                $data = ["status" => true, "data" => [$restult[0]], "message" => "successfully get the data", "command" => "delMarket"];
            }
        }
        return die(json_encode($data));
    }

    /**
     * Creates a new campaign based on the provided data.
     *
     * @return void
     */
    public function createChampaign()
    {
        $cdata = [
            "brandId" => $this->request->getVar("brandId"),
            "brandUserId" => $this->request->getVar("brandUserId"),
            "cityId" => $this->request->getVar("cityId"),
            "campaignTypeId" => $this->request->getVar("campaignTypeId"),
            "campaignName" => $this->request->getVar("campaignName"),
            "campaignInfo" => $this->request->getVar("campaignInfo"),
            "startAt" => $this->request->getVar("startAt"),
            "endAt" => $this->request->getVar("endAt"),
            "minReach" => $this->request->getVar("minReach"),
            "maxReach" => $this->request->getVar("maxReach"),
            "costPerPost" => $this->request->getVar("costPerPost"),
            "totalBudget" => $this->request->getVar("totalBudget"),
            "minEligibleRating" => $this->request->getVar("minEligibleRating"),
            "currencyId" => $this->request->getVar("currencyId"),
            "categories" => $this->request->getVar("categories"),
            "platforms" => $this->request->getVar("platforms")
        ];

        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "createChampaign"];

        $restult = $this->handleModel->createChampaign($cdata);
        if ($restult == 0) {
            $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "createChampaign"];
        } else {
            $data = ["status" => true, "data" => [$restult], "message" => "successfully created new champaign", "command" => "createChampaign"];
        }
        return die(json_encode($data));
    }

    /**
     * Get the referrals for a given user ID.
     *
     * @param int $userId
     * @return void
     */
    public function getReferralsByUserId($userId = 0)
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong1", "command" => "getReferralsByUserId"];
        if (!isset($userId) || is_null($userId) || empty($userId)) {
            $data = ["status" => false, "data" => [], "message" => "Please provide user id", "command" => "getReferralsByUserId"];
        } else {
            $restult = $this->apiModel->flattenToMultiDimensional($this->userModel->findOneUser($userId));
            $restult['refferrals'] = $this->apiModel->flattenToMultiDimensional($this->userModel->getRefferralsByUserId($userId));
            $restult['profileCompleteness'] = $this->apiModel->checkProfileCompleteness($restult);
            if ($restult == 0) {
                $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getReferralsByUserId"];
            } else {
                $data = ["status" => true, "data" => [$restult], "message" => "successfully get the all user data", "command" => "getReferralsByUserId"];
            }
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves user data by user ID.
     *
     * @return void
     */
    public function getUserById()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong1", "command" => "getUserById"];

        $userid = $this->request->getVar("id");
        if (!isset($userid) || is_null($userid) || empty($userid)) {
            $data = ["status" => false, "data" => [], "message" => "Please provide user id", "command" => "getUserById"];
        } else {

            // $restult = $this->userModel->findOneUser($userid);
            $restult = $this->apiModel->flattenToMultiDimensional($this->userModel->findOneUser($userid));
            // $restult['refferrals'] = $this->apiModel->flattenToMultiDimensional($this->userModel->getRefferralsByUserId($userid));
            $restult['brand'] = $this->apiModel->flattenToMultiDimensional($this->brandModel->findOneBrand($restult['brandId']));
            $restult['categories'] = $this->apiModel->flattenToMultiDimensional($this->categoryModel->findCategoriesByUser($restult['id']));
            $restult['languages'] = $this->apiModel->flattenToMultiDimensional($this->languageModel->findLanguagesByUser($restult['id']));
            $restult['platforms'] = $this->apiModel->flattenToMultiDimensional($this->handleModel->findHandlesByUser($restult['id']));
            $restult['market'] = $this->apiModel->flattenToMultiDimensional($this->marketModel->getAllByUser($restult['id']));
            $restult['profileCompleteness'] = $this->apiModel->checkProfileCompleteness($restult);
            if ($restult == 0) {
                $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getUserById"];
            } else {
                $data = ["status" => true, "data" => [$restult], "message" => "successfully get the all user data", "command" => "getUserById"];
            }
        }
        return die(json_encode($data));
    }

    /**
     * Updates the user data based on the request parameters.
     *
     * @return void
     */
    public function updateUser()
    {
        $userdata = [];
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "updateUser"];
        if ($this->request->getMethod() == "post") {
            $userid = $this->request->getVar("id");
            $cityId = $this->request->getVar("cityId");
            if (!isset($cityId) || is_null($cityId) || empty($cityId)) {
            } else {
                $userdata["cityId"] = $cityId;
            }
            $brandId = $this->request->getVar("brandId");
            if (!isset($brandId) || is_null($brandId) || empty($brandId)) {
            } else {
                $userdata["brandId"] = $brandId;
            }
            $currencyId = $this->request->getVar("currencyId");
            if (!isset($currencyId) || is_null($currencyId) || empty($currencyId)) {
            } else {
                $userdata["currencyId"] = $currencyId;
            }
            $referrerUserId = $this->request->getVar("referrerUserId");
            if (!isset($referrerUserId) || is_null($referrerUserId) || empty($referrerUserId)) {
            } else {
                $userdata["referrerUserId"] = $referrerUserId;
            }
            $userName = $this->request->getVar("userName");
            if (!isset($userName) || is_null($userName) || empty($userName)) {
            } else {
                $userdata["userName"] = $userName;
            }
            $userKnownAs = $this->request->getVar("userKnownAs");
            if (!isset($userKnownAs) || is_null($userKnownAs) || empty($userKnownAs)) {
            } else {
                $userdata["userKnownAs"] = $userKnownAs;
            }
            $userPassword = $this->request->getVar("userPassword");
            if (!isset($userPassword) || is_null($userPassword) || empty($userPassword)) {
            } else {
                $userdata["userPassword"] = $userPassword;
            }
            $userEmail = $this->request->getVar("userEmail");
            if (!isset($userEmail) || is_null($userEmail) || empty($userEmail)) {
            } else {
                $userdata["userEmail"] = $userEmail;
            }
            $emailVerifiedAt = $this->request->getVar("emailVerifiedAt");
            if (!isset($emailVerifiedAt) || is_null($emailVerifiedAt) || empty($emailVerifiedAt)) {
            } else {
                $userdata["emailVerifiedAt"] = $emailVerifiedAt;
            }
            $userContact = $this->request->getVar("userContact");
            if (!isset($userContact) || is_null($userContact) || empty($userContact)) {
            } else {
                $userdata["userContact"] = $userContact;
            }
            $contactVerifiedAt = $this->request->getVar("contactVerifiedAt");
            if (!isset($contactVerifiedAt) || is_null($contactVerifiedAt) || empty($contactVerifiedAt)) {
            } else {
                $userdata["contactVerifiedAt"] = $contactVerifiedAt;
            }
            $userFullPostalAddress = $this->request->getVar("userFullPostalAddress");
            if (!isset($userFullPostalAddress) || is_null($userFullPostalAddress) || empty($userFullPostalAddress)) {
            } else {
                $userdata["userFullPostalAddress"] = $userFullPostalAddress;
            }
            $userWebUrl = $this->request->getVar("userWebUrl");
            if (!isset($userWebUrl) || is_null($userWebUrl) || empty($userWebUrl)) {
            } else {
                $userdata["userWebUrl"] = $userWebUrl;
            }
            $userBioInfo = $this->request->getVar("userBioInfo");
            if (!isset($userBioInfo) || is_null($userBioInfo) || empty($userBioInfo)) {
            } else {
                $userdata["userBioInfo"] = $userBioInfo;
            }
            $userPayTmContact = $this->request->getVar("userPayTmContact");
            if (!isset($userPayTmContact) || is_null($userPayTmContact) || empty($userPayTmContact)) {
            } else {
                $userdata["userPayTmContact"] = $userPayTmContact;
            }
            $userGender = $this->request->getVar("userGender");
            if (!isset($userGender) || is_null($userGender) || empty($userGender)) {
            } else {
                $userdata["userGender"] = $userGender;
            }
            $userRole = $this->request->getVar("userRole");
            if (!isset($userRole) || is_null($userRole) || empty($userRole)) {
            } else {
                $userdata["userRole"] = $userRole;
            }
            $userDOB = $this->request->getVar("userDOB");
            if (!isset($userDOB) || is_null($userDOB) || empty($userDOB)) {
            } else {
                $userdata["userDOB"] = $userDOB;
            }
            $userVerifiedAt = $this->request->getVar("userVerifiedAt");
            if (!isset($userVerifiedAt) || is_null($userVerifiedAt) || empty($userVerifiedAt)) {
            } else {
                $userdata["userVerifiedAt"] = $userVerifiedAt;
            }
            $categories = $this->request->getVar("categories");
            if (!isset($categories) || is_null($categories) || empty($categories)) {
            } else {
                $userdata["categories"] = $categories;
            }
            $languages = $this->request->getVar("languages");
            if (!isset($languages) || is_null($languages) || empty($languages)) {
            } else {
                $userdata["languages"] = $languages;
            }
            $userAvgRating = $this->request->getVar("userAvgRating");
            if (!isset($userAvgRating) || is_null($userAvgRating) || empty($userAvgRating)) {
            } else {
                $userdata["userAvgRating"] = $userAvgRating;
            }
            $userWalletBalance = $this->request->getVar("userWalletBalance");
            if (!isset($userWalletBalance) || is_null($userWalletBalance) || empty($userWalletBalance)) {
            } else {
                $userdata["userWalletBalance"] = $userWalletBalance;
            }
            $appName = $this->request->getVar("appName");
            if (!isset($appName) || is_null($appName) || empty($appName)) {
            } else {
                $userdata["appName"] = $appName;
            }
            $appVersion = $this->request->getVar("appVersion");
            if (!isset($appVersion) || is_null($appVersion) || empty($appVersion)) {
            } else {
                $userdata["appVersion"] = $appVersion;
            }
            $devicePlatform = $this->request->getVar("devicePlatform");
            if (!isset($devicePlatform) || is_null($devicePlatform) || empty($devicePlatform)) {
            } else {
                $userdata["devicePlatform"] = $devicePlatform;
            }
            $deviceModelName = $this->request->getVar("deviceModelName");
            if (!isset($deviceModelName) || is_null($deviceModelName) || empty($deviceModelName)) {
            } else {
                $userdata["deviceModelName"] = $deviceModelName;
            }
            $deviceToken = $this->request->getVar("deviceToken");
            if (!isset($deviceToken) || is_null($deviceToken) || empty($deviceToken)) {
            } else {
                $userdata["deviceToken"] = $deviceToken;
            }
            $userPicUrl = $this->request->getVar("userPicUrl");
            if (!isset($userPicUrl) || is_null($userPicUrl) || empty($userPicUrl)) {
            } else {
                $userdata["userPicUrl"] = $userPicUrl;
            }
            $userStatus = $this->request->getVar("userStatus");
            if (!isset($userStatus) || is_null($userStatus) || empty($userStatus)) {
            } else {
                $userdata["userStatus"] = $userStatus;
            }
            $markets = $this->request->getVar("markets");
            if (!isset($markets) || is_null($markets) || empty($markets)) {
            } else {
                $userdata["markets"] = $markets;
            }
            $marketId = $this->request->getVar("marketId");
            if (!isset($marketId) || is_null($marketId) || empty($marketId)) {
            } else {
                $userdata["marketId"] = $marketId;
            }
            $personalHistory = $this->request->getVar("personalHistory");
            if (!isset($personalHistory) || is_null($personalHistory) || empty($personalHistory)) {
            } else {
                $userdata["personalHistory"] = $personalHistory;
            }
            $careerHistory = $this->request->getVar("careerHistory");
            if (!isset($careerHistory) || is_null($careerHistory) || empty($careerHistory)) {
            } else {
                $userdata["careerHistory"] = $careerHistory;
            }

            $externalLinks = $this->request->getVar("externalLinks");
            if (!isset($externalLinks) || is_null($externalLinks) || empty($externalLinks)) {
            } else {
                $userdata["externalLinks"] = $externalLinks;
            }

            $doc1 = $this->request->getVar("doc1");
            if (!isset($doc1) || is_null($doc1) || empty($doc1)) {
            } else {
                $userdata["doc1"] = $doc1;
            }

            $doc2 = $this->request->getVar("doc2");
            if (!isset($doc2) || is_null($doc2) || empty($doc2)) {
            } else {
                $userdata["doc2"] = $doc2;
            }

            $doc3 = $this->request->getVar("doc3");
            if (!isset($doc3) || is_null($doc3) || empty($doc3)) {
            } else {
                $userdata["doc3"] = $doc3;
            }

            $ifsc = $this->request->getVar("ifsc");
            if (!isset($ifsc) || is_null($ifsc) || empty($ifsc)) {
            } else {
                $userdata["ifsc"] = $ifsc;
            }

            $bankName = $this->request->getVar("bankName");
            if (!isset($bankName) || is_null($bankName) || empty($bankName)) {
            } else {
                $userdata["bankName"] = $bankName;
            }

            $branchName = $this->request->getVar("branchName");
            if (!isset($branchName) || is_null($branchName) || empty($branchName)) {
            } else {
                $userdata["branchName"] = $branchName;
            }


            $acNo = $this->request->getVar("acNo");
            if (!isset($acNo) || is_null($acNo) || empty($acNo)) {
            } else {
                $userdata["acNo"] = $acNo;
            }


            $restult = $this->userModel->updateUser($userdata, $userid);
            if ($restult == 0) {
                $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "updateUser"];
            } else {
                $data = ["status" => true, "data" => [$restult], "message" => "successfully created new champaign", "command" => "updateUser"];
            }
        } else {
            $data = ["status" => false, "data" => [], "message" => "Please provide post method", "command" => "updateUser"];
        }
        return die(json_encode($data));
    }

    /**
     * Uploads the avatar image and updates the user profile with the new image.
     *
     * @return void
     */
    public function uploadAvatar()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "uploadAvatar"];

        $file = $this->request->getFile('image');
        $profile_image = $file->getName();
        $filename = $file->getRandomName(); // sha1(date('Y-m-d H:i:s')) . $profile_image;
        // $newName = $file->getRandomName();
        // $data['filePath'] = (($file->move((FCPATH.'public/dist/img/userPic/'),$newName)) ? (base_url() . '/public/dist/img/' . $filePath . $newName) : "");
        if ($file->move((FCPATH . 'public/dist/img/userPic/'), $filename)) { // ($file->move(ROOTPATH . "public/assets/useravatar/",  $filename)) {
            $filePath = (base_url() . '/public/dist/img/userPic/' . $filename);
            $userid = $this->request->getVar("id");
            $userdata["userPicUrl"] = $filePath;
            $restult = $this->userModel->updateUser($userdata, $userid);
            if ($restult == 0) {
                $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "uploadAvatar"];
            } else {
                $data = ["status" => true, "data" => [$restult], "message" => "successfully updated user profile", "command" => "uploadAvatar"];
            }
        } else {
            $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "uploadAvatar"];
        }
        return die(json_encode($data));
    }

    /**
     * Uploads a logo file.
     *
     * This function handles the process of uploading a logo file. It expects a file named 'image' to be present in the request.
     * The file is moved to the 'public/dist/img/userPic/' directory with a random name generated using the `getRandomName()` method of the uploaded file.
     * If the file is successfully moved, the file path is stored in the `$userdata["userPicUrl"]` variable.
     * If the length of `$userdata["userPicUrl"]` is greater than 0, the function returns a JSON response with status true, the file path in the 'data' field, and a success message.
     * If the length of `$userdata["userPicUrl"]
     */
    public function uploadLogo()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "uploadLogo"];

        $file = $this->request->getFile('image');

        $filename = $file->getRandomName(); // sha1(date('Y-m-d H:i:s')) . $profile_image;
        // $newName = $file->getRandomName();
        // $data['filePath'] = (($file->move((FCPATH.'public/dist/img/userPic/'),$newName)) ? (base_url() . '/public/dist/img/' . $filePath . $newName) : "");
        if ($file->move((FCPATH . 'public/dist/img/userPic/'), $filename)) { // ($file->move(ROOTPATH . "public/assets/useravatar/",  $filename)) {
            $filePath = (base_url() . '/public/dist/img/userPic/' . $filename);
            // $userid = $this->request->getVar("id");
            // $userdata["userPicUrl"] = $filePath;
            // $restult = $this->userModel->updateUser($userdata, $userid);
            //$profile_image = $file->getName();
            // $filename = sha1(date('Y-m-d H:i:s')) . $profile_image;
            // if ($file->move(ROOTPATH . "public/assets/useravatar/",  $filename)) {
            // $userid = $this->request->getVar("id");
            $userdata["userPicUrl"] = $filePath;
            // $restult = $this->userModel->updateUser($userdata, $userid);
            if (strlen($userdata["userPicUrl"]) > 0) {
                $data = ["status" => true, "data" => [$userdata["userPicUrl"]], "message" => "successfully updated logo", "command" => "uploadLogo"];
            } else {
                $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "uploadLogo"];
            }
        } else {
            $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "uploadLogo"];
        }
        return die(json_encode($data));
    }

    /**
     * Uploads a file based on the request data.
     *
     * @return string JSON-encoded response
     */
    public function uploadFile()
    {
        $data = ["status" => false, "data" => [], "message" => "", "command" => "uploadFile"];
        try {
            if ($this->request->getMethod() == 'post') {
                $file = $this->request->getFile('file');
                $filePath = $this->request->getVar('path');
                $rules = ['file' => ['rules' => 'uploaded[file]|max_size[file,4096]|ext_in[file,pdf,jpg,jpeg,png,gif,doc,docx,ppt,pptx,xls,xlsx,txt,bmp,tiff]', 'errors' => ['uploaded' => 'Failed Uploading, Please Try Again', 'max_size' => 'Maximum Allowed File Size 4MB', 'ext_in' => 'Only PDF, JPG, JPEG, TIFF, PNG, GIF, DOC, DOCX, TXT, PPT, PPTX, XLS, XLSX, and BMP are Allowed']]];
                $validateBool = $this->validate($rules);
                $fileIsValidBool = (($validateBool) ? ($file->isValid()) : (false));
                $fileHasMovedBool = (($validateBool) ? ($file->hasMoved()) : (false));
                if ($validateBool && ($fileIsValidBool) && (!$fileHasMovedBool)) {
                    $newName = $file->getRandomName();
                    $data['status'] = true;
                    $data['data']['filePath'] = (($file->move((FCPATH . 'public/uploads/' . $filePath), $newName)) ? (base_url() . '/public/uploads/' . $filePath . $newName) : "");
                    $data['message'] = $file->getErrorString();
                } else if (!$validateBool) {
                    $data['message'] = $this->validator->getError('file');
                } else if (!$fileIsValidBool) {
                    $data['message'] = "Please Try Again, Valid File Not Upload";
                } else if ($fileHasMovedBool) {
                    $data['message'] = "Please Try Again, File Has Been Moved Already";
                } else {
                    $data['message'] = "Oops, Something Went Wrong";
                }
            } else {
                $data['message'] = "Invalid POST";
            }
        } catch (Exception $ex) {
            $data['message'] = $ex->getMessage();
        }
        return json_encode(json_decode(json_encode($data), true));
    }

    /**
     * Sends a Firebase Cloud Messaging (FCM) notification.
     *
     * Retrieves the necessary parameters from the request and constructs the FCM payload.
     * Sends the payload to the FCM server using cURL.
     * Returns the response from the FCM server.
     *
     * @return string The response from the FCM server.
     */
    function sendFCM()
    {
        $tokens = $this->request->getVar("tokens");
        $title = $this->request->getVar("title");
        $body = $this->request->getVar("body");
        $alert = $this->request->getVar("alert");
        $subtitle = $this->request->getVar("subtitle");
        $message = $this->request->getVar("message");
        $tag = $this->request->getVar("tag");
        $tickertext = $this->request->getVar("tickertext");
        $priority = $this->request->getVar("priority");
        $sound = $this->request->getVar("sound");
        $vibrate = $this->request->getVar("vibrate");
        $badge = $this->request->getVar("badge");
        $customParam = $this->request->getVar("customParam");
        $API_ACCESS_KEY = "AAAArx0b6KY:APA91bFK6k73XhrJdWF709lq5xo4BqTPBY4d4UjFi7-sbaOqMR5_sjNGtO1yQ26x5A-VzAxOKYzij7Q-Aj6qw-xTN8Dm7536TMiZlFuyMK6QWLr5lrIAHT5AqyJsHbLKdGpSWmzN27xq"; // CS SWRV
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            'priority' => "high",
            'time_to_live' => 3600,
            'registration_ids' => (json_decode(json_encode($tokens), true)),
            'data' => array(
                'title' => $title,
                'subtitle' => $subtitle,
                'body' => $body,
                'message' => $message,
                'alert' => $alert,
                'tag' => $tag,
                'tickertext' => $tickertext,
                'priority' => $priority,
                'icon' => (base_url() . "/public/dist/img/ddd_logo.png"),
                'image' => (base_url() . "/public/dist/img/photo1.png"),
                'smallIcon' => (base_url() . "/public/dist/img/ddd_logo.png"),
                'largeIcon' => (base_url() . "/public/dist/img/photo1.png"),
                'sound' => $sound,
                'vibrate' => $vibrate,
                'badge' => $badge,
                'cilck_action' => "FLUTTER_NOTIFICATION_CLICK",
                'customParam' => (json_decode(json_encode($customParam), true)),
            ),
            'notification' => array(
                'title' => $title,
                'subtitle' => $subtitle,
                'body' => $body,
                'message' => $message,
                'alert' => $alert,
                'tag' => $tag,
                'tickertext' => $tickertext,
                'priority' => $priority,
                'icon' => (base_url() . "/public/dist/img/ddd_logo.png"),
                'image' => (base_url() . "/public/dist/img/photo1.png"),
                'smallIcon' => (base_url() . "/public/dist/img/ddd_logo.png"),
                'largeIcon' => (base_url() . "/public/dist/img/photo1.png"),
                'sound' => $sound,
                'vibrate' => $vibrate,
                'badge' => $badge,
            ),
        );
        $headers = array(
            'Authorization: key=' . $API_ACCESS_KEY,
            'Content-Type: application/json',
            'Accept: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = json_decode(curl_exec($ch), true); // {"multicast_id":5701328038711092640,"success":5,"failure":0,"canonical_ids":0,"results":[{"message_id":"0:1670921935704579%0a9cde1b0a9cde1b"},{"message_id":"0:1670921935708651%0a9cde1b0a9cde1b"},{"message_id":"0:1670921935706688%25497ff525497ff5"},{"message_id":"0:1670921935705150%0a9cde1b0a9cde1b"},{"message_id":"0:1670921935707771%25497ff525497ff5"}]}
        curl_close($ch);
        return die(json_encode($result));
    }

    /**
     * Retrieves the team data.
     *
     * This method retrieves the team data by calling the `findTeam` method on the `userModel` object and flattening the result using the `flattenToMultiDimensional` method on the `apiModel` object. If the result is empty, it sets the response data to indicate an error. Otherwise, it sets the response data to indicate success and includes the retrieved team data.
     *
     * @return void
     */
    public function getTeam()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getTeam"];
        $restult = $this->apiModel->flattenToMultiDimensional($this->userModel->findTeam());
        if ($restult == 0) {
            $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getUserById"];
        } else {
            $data = ["status" => true, "data" => [$restult], "message" => "successfully get the all user data", "command" => "getUserById"];
        }
        return die(json_encode(json_decode(json_encode($data), true)));
    }
    public function getTeamByid()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getTeamByid"];
        $id = $this->request->getVar("id");
        if (!isset($id) || is_null($id) || empty($id)) {
            $data = ["status" => false, "data" => [], "message" => "Please provide id", "command" => "getTeamByid"];
        } else {
            $restult = $this->apiModel->flattenToMultiDimensional($this->userModel->getOneTeam($id));
            if (count($restult) == 0) {
                $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getTeamByid"];
            } else {
                $data = ["status" => true, "data" => [$restult[0]], "message" => "successfully get the data", "command" => "getTeamByid"];
            }
        }
        return die(json_encode(json_decode(json_encode($data), true)));
    }

    /**
     * Deletes a team.
     *
     * This method deletes a team based on the provided ID. It first checks if the ID is provided and not empty. If the ID is not provided or empty, it returns an error message indicating that the ID is required. If the ID is provided, it calls the `delOneTeam` method of the `userModel` object to delete the team. It then flattens the result using the `flattenToMultiDimensional` method of the `apiModel` object. If the result is empty, it returns an error message indicating that something went wrong. If the result is not empty, it returns a success message along with the deleted team data.
     *
     * @return void
     */
    public function delTeam()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "delTeam"];
        $id = $this->request->getVar("id");
        if (!isset($id) || is_null($id) || empty($id)) {
            $data = ["status" => false, "data" => [], "message" => "Please provide id", "command" => "delTeam"];
        } else {
            $restult = $this->apiModel->flattenToMultiDimensional($this->userModel->delOneTeam($id));
            if (count($restult) == 0) {
                $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "delTeam"];
            } else {
                $data = ["status" => true, "data" => [$restult[0]], "message" => "successfully get the data", "command" => "delTeam"];
            }
        }
        return die(json_encode($data));
    }

    /**
     * Updates a team record based on the provided data.
     *
     * @return void
     */
    public function updTeam()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "updTeam"];
        $rules = [
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'name is REQUIRED',
                ],
            ],
            'number' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'number is REQUIRED',
                    'numeric' => 'maxReach should be NUMERIC',
                ],
            ],
            'positon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'positon is REQUIRED',
                ],
            ],
            'dob' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'dob is REQUIRED',
                ],
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'description is REQUIRED',
                ],
            ],
            'imageUrl' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'imageUrl is REQUIRED',
                ],
            ],
        ];
        $id = $this->request->getVar("id");
        if (!isset($id) || is_null($id) || empty($id)) {
            $data = ["status" => false, "data" => [], "message" => "Please provide id", "command" => "updTeam"];
        } else {

            if ($this->validate($rules)) {
                $data['ad'] = [];
                $data['ad']['name'] = $this->request->getVar('name');
                $data['ad']['number'] = $this->request->getVar('number');
                $data['ad']['positon'] = $this->request->getVar('positon');
                $data['ad']['dob'] = $this->request->getVar('dob');
                $data['ad']['description'] = $this->request->getVar('description');
                $data['ad']['imageUrl'] = $this->request->getVar('imageUrl');
                $result = $this->apiModel->flattenToMultiDimensional($this->userModel->editOneTeam($data['ad'], $id));
                if (count($result) > 0) {
                    $data = ["status" => true, "data" => $data['ad'], "message" => "success", "command" => "updTeam"];
                } else {
                    $data['message'] = "FAILED TO ADD NEW RECORD";
                    $data["data"] = [];
                    unset($data["ad"]);
                }
            } else {
                $data['message'] = $this->validator->getError('name');
                if (empty($data['message'])) {
                    $data['message'] = $this->validator->getError('number');
                }
                if (empty($data['message'])) {
                    $data['message'] = $this->validator->getError('positon');
                }
                if (empty($data['message'])) {
                    $data['message'] = $this->validator->getError('dob');
                }
                if (empty($data['message'])) {
                    $data['message'] = $this->validator->getError('description');
                }
                if (empty($data['message'])) {
                    $data['message'] = $this->validator->getError('imageUrl');
                }
            }
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves the NEB (Network Equipment Building) data.
     *
     * This method retrieves the NEB data by calling the `findNEB` method of the `nebModel` object.
     * If the result is 0, it sets the response data to indicate an error occurred.
     * Otherwise, it sets the response data to indicate success and includes the retrieved NEB data.
     *
     * @return void
     */
    public function getNEB()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getTeam"];
        $restult = $this->apiModel->flattenToMultiDimensional($this->nebModel->findNEB());
        if ($restult == 0) {
            $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getUserById"];
        } else {
            $data = ["status" => true, "data" => [$restult], "message" => "successfully get the all user data", "command" => "getUserById"];
        }
        return die(json_encode(json_decode(json_encode($data), true)));
    }

    /**
     * Retrieves NEB data based on the provided type.
     *
     * @return void
     */
    public function getNEBbyType()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getNEB"];
        $nebtype = $this->request->getVar("type");
        if (!isset($nebtype) || is_null($nebtype) || empty($nebtype)) {
            $data = ["status" => false, "data" => [], "message" => "Please provide type", "command" => "getNEBbyType"];
        } else {
            $restult = $this->apiModel->flattenToMultiDimensional($this->nebModel->findNEBByType($nebtype));
            if ($restult == 0) {
                $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getNEBbyType"];
            } else {
                $data = ["status" => true, "data" => [$restult], "message" => "successfully get the all user data", "command" => "getNEBbyType"];
            }
        }
        return die(json_encode(json_decode(json_encode($data), true)));
    }

    /**
     * Retrieves NEB data by ID.
     *
     * This method retrieves NEB data by the provided ID. It first checks if the ID is provided, and if not, it returns an error message indicating that the ID is missing. If the ID is provided, it calls the `findOneNEB` method of the `nebModel` object to retrieve the NEB data. If the result is 0, it returns an error message indicating that something went wrong. Otherwise, it flattens the result using the `flattenToMultiDimensional` method of the `apiModel` object and returns the flattened data as a JSON response with a success status and a message indicating that the data was successfully retrieved.
     *
     * @return void
     */
    public function getNEBById()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong1", "command" => "getNEBById"];
        $nebid = $this->request->getVar("id");
        if (!isset($nebid) || is_null($nebid) || empty($nebid)) {
            $data = ["status" => false, "data" => [], "message" => "Please provide id", "command" => "getNEBById"];
        } else {
            $restult = $this->apiModel->flattenToMultiDimensional($this->nebModel->findOneNEB($nebid));
            if ($restult == 0) {
                $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getNEBById"];
            } else {
                $data = ["status" => true, "data" => [$restult], "message" => "successfully get the data", "command" => "getNEBById"];
            }
        }
        return die(json_encode($data));
    }

    /**
     * Searches for NEB (Nebula) data based on the provided type and search parameters.
     * Returns a JSON response containing the search results.
     *
     * @return void
     */
    public function searchNEB()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "searchNEB"];
        $nebtype = $this->request->getVar("type");
        $search = $this->request->getVar("search");
        if (!isset($nebtype) || is_null($nebtype) || empty($nebtype)) {
            $data = ["status" => false, "data" => [], "message" => "Please provide type parameter", "command" => "searchNEB"];
        } elseif (!isset($search) || is_null($search) || empty($search)) {
            $data = ["status" => false, "data" => [], "message" => "Please provide search parameter", "command" => "searchNEB"];
        } else {
            $restult = $this->apiModel->flattenToMultiDimensional($this->nebModel->searchNEB($nebtype, $search));
            if ($restult == 0) {
                $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "searchNEB"];
            } else {
                $data = ["status" => true, "data" => [$restult], "message" => "successfully get the all user data", "command" => "searchNEB"];
            }
        }
        return die(json_encode(json_decode(json_encode($data), true)));
    }


    /**
     * Deletes a NEB (Network Equipment Building) based on the provided ID.
     * 
     * @return void
     */
    public function delNEB()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "delNEB"];
        $id = $this->request->getVar("id");
        if (!isset($id) || is_null($id) || empty($id)) {
            $data = ["status" => false, "data" => [], "message" => "Please provide id", "command" => "delNEB"];
        } else {
            $restult = $this->apiModel->flattenToMultiDimensional($this->nebModel->delOneNEB($id));
            if (count($restult) == 0) {
                $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "delNEB"];
            } else {
                $data = ["status" => true, "data" => [$restult[0]], "message" => "successfully get the data", "command" => "delNEB"];
            }
        }
        return die(json_encode($data));
    }


    /**
     * Adds a new team to the system.
     *
     * This method validates the input data against a set of rules and adds the team if the validation passes.
     * If the validation fails, it returns an error message indicating the validation error.
     *
     * @return void
     */
    public function addTeam()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "addTeam"];
        $rules = [
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'name is REQUIRED',
                ],
            ],
            'number' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'number is REQUIRED',
                    'numeric' => 'maxReach should be NUMERIC',
                ],
            ],
            'positon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'positon is REQUIRED',
                ],
            ],
            'dob' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'dob is REQUIRED',
                ],
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'description is REQUIRED',
                ],
            ],
            'imageUrl' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'imageUrl is REQUIRED',
                ],
            ],
        ];

        if ($this->validate($rules)) {
            $data['ad'] = [];
            $data['ad']['name'] = $this->request->getVar('name');
            $data['ad']['number'] = $this->request->getVar('number');
            $data['ad']['positon'] = $this->request->getVar('positon');
            $data['ad']['dob'] = $this->request->getVar('dob');
            $data['ad']['description'] = $this->request->getVar('description');
            $data['ad']['imageUrl'] = $this->request->getVar('imageUrl');
            $data['ad']['status'] = 1;
            $data['ad']['id'] = $this->userModel->addOneTeam($data['ad']);
            if ($data['ad']['id'] > 0) {
                $data = ["status" => true, "data" => $data['ad'], "message" => "success", "command" => "addTeam"];
            } else {
                $data['message'] = "FAILED TO ADD NEW RECORD";
            }
        } else {
            $data['message'] = $this->validator->getError('name');
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('number');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('positon');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('dob');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('description');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('imageUrl');
            }
        }

        return die(json_encode($data));
    }

    /**
     * Update the NEB (New Event Board) record.
     *
     * This method is responsible for updating the NEB record based on the provided input data.
     * It performs validation on the input data and returns a JSON response indicating the success or failure of the update operation.
     *
     * @return void
     */
    public function updNEB()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "updNEB"];
        $rules = [
            'title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'title is REQUIRED',
                ],
            ],
            'titleDesc' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'titleDesc is REQUIRED',
                ],
            ],
            'shortDesc' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'shortDesc is REQUIRED',
                ],
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'description is REQUIRED',
                ],
            ],
            'dateTime' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'dateTime is REQUIRED',
                ],
            ],
            'type' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'type is REQUIRED',
                ],
            ],
            'imageUrl' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'imageUrl is REQUIRED',
                ],
            ],
        ];

        $id = $this->request->getVar("id");
        if (!isset($id) || is_null($id) || empty($id)) {
            $data = ["status" => false, "data" => [], "message" => "Please provide id", "command" => "updNEB"];
        } else {

            if ($this->validate($rules)) {
                $data['ad'] = [];
                $data['ad']['title'] = $this->request->getVar('title');
                $data['ad']['titleDesc'] = $this->request->getVar('titleDesc');
                $data['ad']['shortDesc'] = $this->request->getVar('shortDesc');
                $data['ad']['dateTime'] = $this->request->getVar('dateTime');
                $data['ad']['description'] = $this->request->getVar('description');
                $data['ad']['imageUrl'] = $this->request->getVar('imageUrl');
                $data['ad']['type'] = $this->request->getVar('type');
                $result = $this->apiModel->flattenToMultiDimensional($this->nebModel->editOneNEB($data['ad'], $id));
                if (count($result) > 0) {
                    $data = ["status" => true, "data" => $data['ad'], "message" => "success", "command" => "updNEB"];
                } else {
                    $data['message'] = "FAILED TO ADD NEW RECORD";
                    $data["data"] = [];
                    unset($data["ad"]);
                }
            } else {
                $data['message'] = $this->validator->getError('title');
                if (empty($data['message'])) {
                    $data['message'] = $this->validator->getError('titleDesc');
                }
                if (empty($data['message'])) {
                    $data['message'] = $this->validator->getError('shortDesc');
                }
                if (empty($data['message'])) {
                    $data['message'] = $this->validator->getError('dateTime');
                }
                if (empty($data['message'])) {
                    $data['message'] = $this->validator->getError('description');
                }
                if (empty($data['message'])) {
                    $data['message'] = $this->validator->getError('imageUrl');
                }
                if (empty($data['message'])) {
                    $data['message'] = $this->validator->getError('type');
                }
            }
        }
        return die(json_encode($data));
    }

    /**
     * Adds a new record to the database using the provided data.
     * Validates the data against the specified rules.
     * Returns a JSON response containing the status, data, message, and command.
     *
     * @return void
     */
    public function addNEB()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "addNEB"];
        $rules = [
            'title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'title is REQUIRED',
                ],
            ],
            'titleDesc' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'titleDesc is REQUIRED',
                ],
            ],
            'shortDesc' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'shortDesc is REQUIRED',
                ],
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'description is REQUIRED',
                ],
            ],
            'dateTime' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'dateTime is REQUIRED',
                ],
            ],
            'type' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'type is REQUIRED',
                ],
            ],
            'imageUrl' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'imageUrl is REQUIRED',
                ],
            ],
        ];



        if ($this->validate($rules)) {
            $data['ad'] = [];
            $data['ad']['title'] = $this->request->getVar('title');
            $data['ad']['titleDesc'] = $this->request->getVar('titleDesc');
            $data['ad']['shortDesc'] = $this->request->getVar('shortDesc');
            $data['ad']['dateTime'] = $this->request->getVar('dateTime');
            $data['ad']['description'] = $this->request->getVar('description');
            $data['ad']['imageUrl'] = $this->request->getVar('imageUrl');
            $data['ad']['type'] = $this->request->getVar('type');
            $data['ad']['status'] = 1;
            $data['ad']['id'] = $this->nebModel->addOneNEB($data['ad']);
            if ($data['ad']['id'] > 0) {
                $data = ["status" => true, "data" => $data['ad'], "message" => "success", "command" => "addNEB"];
            } else {
                $data['message'] = "FAILED TO ADD NEW RECORD";
                $data["data"] = [];
                unset($data["ad"]);
            }
        } else {
            $data['message'] = $this->validator->getError('title');
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('titleDesc');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('shortDesc');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('dateTime');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('description');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('imageUrl');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('type');
            }
        }

        return die(json_encode($data));
    }

    /**
     * Retrieves all users from the database and returns the result as a JSON response.
     *
     * @return void
     */
    public function getusers()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getusers"];
        $restult = $this->apiModel->flattenToMultiDimensional($this->userModel->getUsers());
        if ($restult == 0) {
            $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getusers"];
        } else {
            $data = ["status" => true, "data" => [$restult], "message" => "successfully get the all user data", "command" => "getusers"];
        }
        return die(json_encode(json_decode(json_encode($data), true)));
    }
    /**
     * Retrieves the brands from the API and returns them in a JSON format.
     *
     * @return void
     */
    public function getbrands()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getbrands"];
        $restult = $this->apiModel->flattenToMultiDimensional($this->brandModel->getBrands());
        if ($restult == 0) {
            $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getbrands"];
        } else {
            $data = ["status" => true, "data" => [$restult], "message" => "successfully get the all user data", "command" => "getbrands"];
        }
        return die(json_encode(json_decode(json_encode($data), true)));
    }
    /**
     * Retrieves the campaigns from the API and returns the result in JSON format.
     *
     * @return void
     */
    public function getcampaigns()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getcampaigns"];
        $restult = $this->apiModel->flattenToMultiDimensional($this->campaignModel->getCampaigns());
        if ($restult == 0) {
            $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getcampaigns"];
        } else {
            $data = ["status" => true, "data" => [$restult], "message" => "successfully get the all user data", "command" => "getcampaigns"];
        }
        return die(json_encode(json_decode(json_encode($data), true)));
    }


    /**
     * Retrieves the status of a user.
     *
     * This method is responsible for retrieving the status of a user based on the provided ID and status.
     * It returns a JSON response containing the status, data, message, and command.
     *
     * @return void
     */
    public function statususer()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "statususer"];
        $id = $this->request->getVar("id");
        $status = $this->request->getVar("status");
        if (!isset($id) || is_null($id) || empty($id)) {
            $data = ["status" => false, "data" => [], "message" => "Please provide id", "command" => "statususer"];
        }
        if (!isset($status) || is_null($status)) {
            $data = ["status" => false, "data" => [], "message" => "Please provide status", "command" => "statususer"];
        } else {
            $restult = $this->apiModel->flattenToMultiDimensional($this->userModel->updateStauts($id, $status));
            if (count($restult) == 0) {
                $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "statususer"];
            } else {
                $data = ["status" => true, "data" => [$restult[0]], "message" => "successfully updated the status", "command" => "statususer"];
            }
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves the status of a brand.
     *
     * This method is responsible for retrieving the status of a brand based on the provided id and status parameters.
     * It returns a JSON response containing the status, data, message, and command.
     *
     * @return void
     */
    public function statusbrand()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "statusbrand"];
        $id = $this->request->getVar("id");
        $status = $this->request->getVar("status");
        if (!isset($id) || is_null($id) || empty($id)) {
            $data = ["status" => false, "data" => [], "message" => "Please provide id", "command" => "statusbrand"];
        }
        if (!isset($status) || is_null($status)) {
            $data = ["status" => false, "data" => [], "message" => "Please provide status", "command" => "statusbrand"];
        } else {
            $restult = $this->apiModel->flattenToMultiDimensional($this->brandModel->updateStauts($id, $status));
            if (count($restult) == 0) {
                $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "statusbrand"];
            } else {
                $data = ["status" => true, "data" => [$restult[0]], "message" => "successfully updated the status", "command" => "statusbrand"];
            }
        }
        return die(json_encode($data));
    }
    /**
     * Retrieves the status of a campaign.
     *
     * This method is responsible for retrieving the status of a campaign based on the provided id and status.
     * It returns a JSON response containing the status, data, message, and command.
     *
     * @return void
     */
    public function statuscampaign()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "statuscampaign"];
        $id = $this->request->getVar("id");
        $status = $this->request->getVar("status");
        if (!isset($id) || is_null($id) || empty($id)) {
            $data = ["status" => false, "data" => [], "message" => "Please provide id", "command" => "statuscampaign"];
        }
        if (!isset($status) || is_null($status)) {
            $data = ["status" => false, "data" => [], "message" => "Please provide status", "command" => "statuscampaign"];
        } else {
            $restult = $this->apiModel->flattenToMultiDimensional($this->campaignModel->updateStauts($id, $status));
            if (count($restult) == 0) {
                $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "statuscampaign"];
            } else {
                $data = ["status" => true, "data" => [$restult[0]], "message" => "successfully updated the status", "command" => "statuscampaign"];
            }
        }
        return die(json_encode($data));
    }

    /**
     * Adds a contact to the system.
     *
     * This method validates the input data against a set of rules and adds the contact to the system if the validation passes.
     * If the validation fails, it returns an error message indicating the validation errors.
     *
     * @return void
     */
    public function addContact()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "addContact"];

        $rules = [
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'name is REQUIRED',
                ],
            ],
            'number' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'number is REQUIRED',
                    'numeric' => 'number {value} Should be Number',
                ],
            ],
            'isBrand' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'isBrand is REQUIRED',
                ],
            ],
            'message' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'message is REQUIRED',
                ],
            ],
        ];

        if ($this->validate($rules)) {
            $ud = [];
            $ud["name"] = $this->request->getVar('name');
            $ud["number"] = $this->request->getVar('number');
            $ud["message"] = $this->request->getVar('message');
            $ud["isBrand"] = $this->request->getVar('isBrand');
            $ud["status"] = 1;
            $msg = $this->apiModel->flattenToMultiDimensional($this->contactDisputeModel->addOne($ud));
            if ($msg > 0) {
                $data = ["status" => true, "data" => $msg, "message" => "success", "command" => "addContact"];
            } else {
                $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "addContact"];
            }
        } else {
            $data['message'] = "";
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('name');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('number');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('isBrand');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('message');
            }
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves the contact details.
     *
     * @return void
     */
    public function getContact()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getContact"];
        $restult = $this->apiModel->flattenToMultiDimensional($this->contactDisputeModel->getContact());
        if ($restult == 0) {
            $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getContact"];
        } else {
            $data = ["status" => true, "data" => [$restult], "message" => "successfully get the all contact details", "command" => "getContact"];
        }
        return die(json_encode(json_decode(json_encode($data), true)));
    }

    /**
     * Retrieves the dispute data.
     *
     * @return void
     */
    public function getDispute()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getDispute"];
        $restult = $this->apiModel->flattenToMultiDimensional($this->contactDisputeModel->getDispute());
        if ($restult == 0) {
            $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getDispute"];
        } else {
            $data = ["status" => true, "data" => [$restult], "message" => "successfully get the all contact details", "command" => "getDispute"];
        }
        return die(json_encode(json_decode(json_encode($data), true)));
    }

    /**
     * Adds a dispute.
     *
     * This method adds a dispute based on the provided input data. It performs validation on the input data using the specified rules. If the validation passes, the dispute is added and a success message is returned. If the validation fails, an error message is returned indicating the specific validation errors.
     *
     * @return void
     */
    public function addDispute()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "addContact"];

        $rules = [
            'type' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'type is REQUIRED',
                ],
            ],
            'isBrand' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'isBrand is REQUIRED',
                ],
            ],
            'userId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'userId is REQUIRED',
                ],
            ],
            'brandId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'brandId is REQUIRED',
                ],
            ],
            'message' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'message is REQUIRED',
                ],
            ],
        ];

        if ($this->validate($rules)) {
            $ud = [];
            $ud["type"] = $this->request->getVar('type');
            $ud["userId"] = $this->request->getVar('userId');
            $ud["brandId"] = $this->request->getVar('brandId');
            $ud["campaignId"] = $this->request->getVar('campaignId');
            $ud["message"] = $this->request->getVar('message');
            $ud["isBrand"] = $this->request->getVar('isBrand');
            $ud["status"] = 1;

            $msg = $this->apiModel->flattenToMultiDimensional($this->contactDisputeModel->addOne($ud));
            if ($msg > 0) {
                $data = ["status" => true, "data" => $msg, "message" => "success", "command" => "addContact"];
            } else {
                $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "addContact"];
            }
        } else {
            $data['message'] = "";
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('type');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('isBrand');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('userId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('brandId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('message');
            }
        }
        return die(json_encode($data));
    }

    /**
     * Adds a bid based on the provided data.
     *
     * @return void
     */
    public function addBid()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "addBid"];
        $rules = [
            'bidamount' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'bidamount is REQUIRED',
                ],
            ],
            'campaignId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'campaignId is REQUIRED',
                ],
            ],
            'brandId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'brandId is REQUIRED',
                ],
            ],
            'remark' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'remark is REQUIRED',
                ],
            ],
        ];


        if ($this->validate($rules)) {
            $ud = [];
            $ud["bidamount"] = $this->request->getVar('bidamount');
            $ud["brandId"] = $this->request->getVar('brandId');
            $ud["userId"] = $this->request->getVar('userId');
            $ud["campaignId"] = $this->request->getVar('campaignId');
            $ud["remark"] = $this->request->getVar('remark');
            $ud["status"] = 1;
            $ud["approved"] = 0;
            $msg = $this->apiModel->flattenToMultiDimensional($this->bidModel->addOne($ud));
            if ($msg > 0) {
                $data = ["status" => true, "data" => $msg, "message" => "success", "command" => "addBid"];
            } else {
                $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "addBid"];
            }
        } else {
            $data['message'] = "";
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('bidamount');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('campaignId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('brandId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('remark');
            }
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves the last bid for a campaign.
     *
     * This method retrieves the last bid for a campaign based on the provided campaign ID. It follows the following steps:
     * 1. Validates the input parameters using the provided rules.
     * 2. If the validation passes, it retrieves the campaign ID from the request.
     * 3. Calls the `getCampaignLastBid` method of the `bidModel` to retrieve the last bid for the campaign.
     * 4. Flattens the retrieved data to a multi-dimensional array using the `flattenToMultiDimensional` method of the `apiModel`.
     * 5. If there are records found, it sets the response data to include the retrieved data with a success message.
     *
     */
    public function getCampaignLastBid()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getCampaignLastBid"];
        $rules = [
            'campaignId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'campaignId is REQUIRED',
                ],
            ],
        ];

        if ($this->validate($rules)) {
            $campaignId = $this->request->getVar('campaignId');
            $msg = $this->apiModel->flattenToMultiDimensional($this->bidModel->getCampaignLastBid($campaignId));
            if (count($msg) > 0) {
                $data = ["status" => true, "data" => $msg, "message" => "success", "command" => "getCampaignLastBid"];
            } else {
                $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "getCampaignLastBid"];
            }
        } else {
            $data['message'] = "";
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('campaignId');
            }
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves the campaign bid based on the provided campaign ID.
     *
     * @return void
     */
    public function getCampaignBid()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getCampaignBid"];
        $rules = [
            'campaignId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'campaignId is REQUIRED',
                ],
            ],
        ];
        if ($this->validate($rules)) {
            $campaignId = $this->request->getVar('campaignId');
            $msg = $this->apiModel->flattenToMultiDimensional($this->bidModel->getCampaignApprovedBid($campaignId));
            if (count($msg) < 1) {
                $msgone = $this->apiModel->flattenToMultiDimensional($this->bidModel->getCampaignBid($campaignId));
                if (count($msgone) > 0) {
                    $data = ["status" => true, "data" => $msgone, "message" => "success", "command" => "getCampaignBid"];
                } else {
                    $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "getCampaignBid"];
                }
            } else {
                $data = ["status" => false, "data" => [], "message" => "Bid already accepted.", "command" => "getCampaignBid"];
            }
        } else {
            $data['message'] = "";
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('campaignId');
            }
        }
        return die(json_encode($data));
    }
    /**
     * Retrieves the bid data based on the provided campaign ID.
     *
     * @return void
     */
    public function getBid()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getBid"];
        $rules = [
            'campaignId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'campaignId is REQUIRED',
                ],
            ],
        ];
        if ($this->validate($rules)) {
            $campaignId = $this->request->getVar('campaignId');
            $msgone = $this->apiModel->flattenToMultiDimensional($this->bidModel->getCampaignBid($campaignId));
            if (count($msgone) > 0) {
                $data = ["status" => true, "data" => $msgone, "message" => "success", "command" => "getBid"];
            } else {
                $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "getBid"];
            }
        } else {
            $data['message'] = "";
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('campaignId');
            }
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves the bid snapshot for a campaign.
     *
     * This method retrieves the bid snapshot for a campaign based on the provided campaign ID. It follows the following steps:
     * 1. Initializes the default response data with a status of false, an empty data array, a default error message, and the command "getBid".
     * 2. Defines the validation rules for the request parameters, specifically the 'campaignId' parameter.
     * 3. Validates the request parameters against the defined rules. If the validation passes:
     *    a. Retrieves the campaignId from the request.
     *    b. Flattens the bid snapshot data obtained from the bid model into a multi-dimensional array using the api model.
     *    c. Checks if the
     */
    public function getBidSnapshot()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getBid"];
        $rules = [
            'campaignId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'campaignId is REQUIRED',
                ],
            ],
        ];
        if ($this->validate($rules)) {
            $campaignId = $this->request->getVar('campaignId');
            $msgone = $this->apiModel->flattenToMultiDimensional($this->bidModel->getCampaignBidSnapshot($campaignId));
            if (count($msgone) > 0) {
                $data = ["status" => true, "data" => $msgone, "message" => "success", "command" => "getBid"];
            } else {
                $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "getBid"];
            }
        } else {
            $data['message'] = "";
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('campaignId');
            }
        }
        return die(json_encode($data));
    }

    /**
     * Approve a bid.
     *
     * This method is responsible for approving a bid by updating its status in the database.
     * It takes the bid ID from the request and uses it to update the bid status.
     * If the bid ID is not provided or is empty, it returns an error message.
     * If the bid update is successful, it returns a success message along with the updated bid data.
     * If any error occurs during the process, it returns an error message.
     *
     * @return void
     */
    public function approveBid()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "approveBid"];

        $id = $this->request->getVar("id");
        if (!isset($id) || is_null($id) || empty($id)) {
            $data = ["status" => false, "data" => [], "message" => "Please provide id", "command" => "approveBid"];
        } else {
            $restult = $this->apiModel->flattenToMultiDimensional($this->bidModel->updateBid($id));
            if (count($restult) == 0) {
                $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "approveBid"];
            } else {
                $data = ["status" => true, "data" => [$restult[0]], "message" => "successfully updated the status", "command" => "approveBid"];
            }
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves the approved bid for a campaign.
     *
     * @return void
     */
    public function getApprovedBid()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "approveBid"];


        $rules = [
            'campaignId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'campaignId is REQUIRED',
                ],
            ],
        ];

        if ($this->validate($rules)) {
            $campaignId = $this->request->getVar('campaignId');
            $msg = $this->apiModel->flattenToMultiDimensional($this->bidModel->getCampaignApprovedBid($campaignId));
            if (count($msg) > 0) {
                $data = ["status" => true, "data" => $msg, "message" => "success", "command" => "getCampaignLastBid"];
            } else {
                $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "getCampaignLastBid"];
            }
        } else {
            $data['message'] = "";
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('campaignId');
            }
        }
        return die(json_encode($data));
    }

    /**
     * Adds an Instagram handle to the database.
     *
     * Retrieves data from the request and constructs an array with the necessary information for the handle.
     * Updates the last updated timestamp for the handle in the database.
     * Creates a new Instagram handle entry in the database using the constructed array.
     * Returns a JSON response with the status, data, message, and command.
     *
     * @return void
     */
    public function addInstaHandel()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "addInstaHandel"];
        $ud = [];

        $ud["userId"] = $this->request->getVar('userId');
        $ud["handleId"] = $this->request->getVar('handleId');
        $ud["userName"] = $this->request->getVar('userName');
        $ud["picUrl"] = $this->request->getVar('picUrl');
        $ud["followers"] = $this->request->getVar('followers');
        $ud["postCount"] = $this->request->getVar('postCount');
        $ud["engagementRate"] = $this->request->getVar('engagementRate');
        $ud["engagements"] = $this->request->getVar('engagements');
        $ud["city"] = $this->request->getVar('city');
        $ud["country"] = $this->request->getVar('country');
        $ud["language"] = $this->request->getVar('language');
        $ud["isVerified"] = $this->request->getVar('isVerified');
        $ud["isPrivate"] = $this->request->getVar('isPrivate');
        $ud["avgReelsPlays"] = $this->request->getVar('avgReelsPlays');
        $ud["avgLikes"] = $this->request->getVar('avgLikes');
        $ud["avgComments"] = $this->request->getVar('avgComments');
        $ud["avgViews"] = $this->request->getVar('avgViews');
        $ud["paidPostPerformance"] = $this->request->getVar('paidPostPerformance');
        $ud["genderMale"] = $this->request->getVar('genderMale');
        $ud["genderFemale"] = $this->request->getVar('genderFemale');
        $ud["geoCities1"] = $this->request->getVar('geoCities1');
        $ud["geoCities2"] = $this->request->getVar('geoCities2');
        $ud["geoCities3"] = $this->request->getVar('geoCities3');
        $ud["geoCities4"] = $this->request->getVar('geoCities4');
        $ud["geoCities5"] = $this->request->getVar('geoCities5');
        $ud["geoCountries1"] = $this->request->getVar('geoCountries1');
        $ud["geoCountries2"] = $this->request->getVar('geoCountries2');
        $ud["geoCountries3"] = $this->request->getVar('geoCountries3');
        $ud["geoCountries4"] = $this->request->getVar('geoCountries4');
        $ud["geoCountries5"] = $this->request->getVar('geoCountries5');
        $ud["ages13_17"] = $this->request->getVar('ages13_17');
        $ud["ages18_24"] = $this->request->getVar('ages18_24');
        $ud["ages25_34"] = $this->request->getVar('ages25_34');
        $ud["ages35_44"] = $this->request->getVar('ages35_44');
        $ud["ages45_64"] = $this->request->getVar('ages45_64');
        $ud["ages65_"] = $this->request->getVar('ages65_');
        $ud["likedPost1Url"] = $this->request->getVar('likedPost1Url');
        $ud["likedPost1CreatedAt"] = $this->request->getVar('likedPost1CreatedAt');
        $ud["likedPost1Likes"] = $this->request->getVar('likedPost1Likes');
        $ud["likedPost1Comments"] = $this->request->getVar('likedPost1Comments');
        $ud["liked1Post1Image"] = $this->request->getVar('liked1Post1Image');
        $ud["likedPost2Url"] = $this->request->getVar('likedPost2Url');
        $ud["likedPost2CreatedAt"] = $this->request->getVar('likedPost2CreatedAt');
        $ud["likedPost2Likes"] = $this->request->getVar('likedPost2Likes');
        $ud["likedPost2Comments"] = $this->request->getVar('likedPost2Comments');
        $ud["likedPost2Image"] = $this->request->getVar('likedPost2Image');
        $ud["likedPost3Url"] = $this->request->getVar('likedPost3Url');
        $ud["likedPost3CreatedAt"] = $this->request->getVar('likedPost3CreatedAt');
        $ud["likedPost3Likes"] = $this->request->getVar('likedPost3Likes');
        $ud["likedPost3Comments"] = $this->request->getVar('likedPost3Comments');
        $ud["likedPost3Image"] = $this->request->getVar('likedPost3Image');
        $ud["recentPost1Url"] = $this->request->getVar('recentPost1Url');
        $ud["recentPost1CreatedAt"] = $this->request->getVar('recentPost1CreatedAt');
        $ud["recentPost1Likes"] = $this->request->getVar('recentPost1Likes');
        $ud["recentPost1Comments"] = $this->request->getVar('recentPost1Comments');
        $ud["recentPost2Url"] = $this->request->getVar('recentPost2Url');
        $ud["recentPost2CreatedAt"] = $this->request->getVar('recentPost2CreatedAt');
        $ud["recentPost2Likes"] = $this->request->getVar('recentPost2Likes');
        $ud["recentPost2Comments"] = $this->request->getVar('recentPost2Comments');
        $ud["recentPost3Url"] = $this->request->getVar('recentPost3Url');
        $ud["recentPost3CreatedAt"] = $this->request->getVar('recentPost3CreatedAt');
        $ud["recentPost3Likes"] = $this->request->getVar('recentPost3Likes');
        $ud["recentPost3Comments"] = $this->request->getVar('recentPost3Comments');
        $ud["oneMonthAgoFollower"] = $this->request->getVar('oneMonthAgoFollower');
        $ud["oneMonthAgoAvgLike"] = $this->request->getVar('oneMonthAgoAvgLike');
        $ud["oneMonthAgoFollowing"] = $this->request->getVar('oneMonthAgoFollowing');
        $ud["twoMonthAgoFollower"] = $this->request->getVar('twoMonthAgoFollower');
        $ud["twoMonthAgoAvgLike"] = $this->request->getVar('twoMonthAgoAvgLike');
        $ud["twoMonthAgoFollowing"] = $this->request->getVar('twoMonthAgoFollowing');
        $ud["threeMonthAgoFollower"] = $this->request->getVar('threeMonthAgoFollower');
        $ud["threeMonthAgoAvgLike"] = $this->request->getVar('threeMonthAgoAvgLike');
        $ud["threeMonthAgoFollowing"] = $this->request->getVar('threeMonthAgoFollowing');
        $ud["fourMonthAgoFollower"] = $this->request->getVar('fourMonthAgoFollower');
        $ud["fourMonthAgoAvgLike"] = $this->request->getVar('fourMonthAgoAvgLike');
        $ud["fourMonthAgoFollowing"] = $this->request->getVar('fourMonthAgoFollowing');
        $ud["fiveMonthAgoFollower"] = $this->request->getVar('fiveMonthAgoFollower');
        $ud["fiveMonthAgoAvgLike"] = $this->request->getVar('fiveMonthAgoAvgLike');
        $ud["fiveMonthAgoFollowing"] = $this->request->getVar('fiveMonthAgoFollowing');
        $ud["status"] = 1;

        $dataupdate = array("lastUpdatedAt" => date("Y-m-d H:i:s"));

        $this->handleModel->updateHandle($dataupdate, $ud["handleId"]);

        $msg = $this->apiModel->flattenToMultiDimensional($this->instaHandleModel->createInstaHandle($ud));
        if ($msg > 0) {
            $data = ["status" => true, "data" => $msg, "message" => "success", "command" => "addInstaHandel"];
        } else {
            $data = ["status" => false, "data" => [], "message" => "Something went wrong.", "command" => "addInstaHandel"];
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves Instagram handle information by user ID and handle ID.
     *
     * @return void
     */
    public function getInstaHandelByid()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getInstaHandelByid"];
        $rules = [
            'userId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'userId is REQUIRED',
                ],
            ],
            'handleId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'handleId is REQUIRED',
                ],
            ],
        ];

        if ($this->validate($rules)) {
            $userId = $this->request->getVar('userId');
            $handleId = $this->request->getVar('handleId');
            $msg = $this->apiModel->flattenToMultiDimensional($this->instaHandleModel->getUserById($userId, $handleId));
            if (count($msg) > 0) {
                $data = ["status" => true, "data" => $msg, "message" => "success", "command" => "getInstaHandelByid"];
            } else {
                $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "getInstaHandelByid"];
            }
        } else {
            $data['message'] = "";
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('userId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('handleId');
            }
        }
        return die(json_encode($data));
    }
    /**
     * Retrieves geofencing campaign data based on latitude and longitude.
     *
     * @return void
     */
    public function geofencingCampaign()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "geofencingCampaign"];
        $rules = [
            'lat' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'lat is REQUIRED',
                    'numeric' => 'maxReach should be NUMERIC',
                ],
            ],
            'long' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'long is REQUIRED',
                    'numeric' => 'maxReach should be NUMERIC',
                ],
            ],
        ];

        if ($this->validate($rules)) {
            $lat = $this->request->getVar('lat');
            $long = $this->request->getVar('long');
            $msg = $this->apiModel->flattenToMultiDimensional($this->campaignModel->geofencingCampaign($lat, $long));
            if (count($msg) > 0) {
                $data = ["status" => true, "data" => $msg, "message" => "success", "command" => "geofencingCampaign"];
            } else {
                $data = ["status" => false, "data" => [], "message" => "No Record Found", "command" => "geofencingCampaign"];
            }
        } else {
            $data['message'] = "";
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('lat');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('long');
            }
        }
        return die(json_encode($data));
    }

    /**
     * Verifies the user's email address.
     *
     * This method validates the user's email address based on the provided rules.
     * If the email is valid, it checks if the user exists in the database.
     * If the user exists, it checks if the email has already been verified.
     * If the email is already verified, it returns a response indicating that the email is already verified.
     * If the email is not verified, it updates the user's record in the database to mark the email as verified.
     * If the update is successful, it returns a response indicating that the email has been successfully verified.
     * If the update fails, it returns a response indicating that something went wrong.
     * If the user does not exist, it returns a
     */
    public function verifyUser()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "verifyUser"];
        $rules = [
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'email is REQUIRED',
                ],
            ],
        ];
        if ($this->validate($rules)) {
            $email = $this->request->getVar('email');
            $user = $this->apiModel->flattenToMultiDimensional($this->userModel->searchUser(array("email" => $email)));

            if (count($user) > 0) {
                if (!empty($user[0]["emailVerifiedAt"]) || isset($user[0]["emailVerifiedAt"])) {
                    $data = ["status" => false, "data" => [], "message" => "User Email is already verified", "command" => "verifyUser"];
                } else {
                    $result = $this->userModel->updateUser(array('emailVerifiedAt' => date('Y-m-d H:i:s')), $user[0]["id"]);
                    if ($result == 0) {
                        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "verifyUser"];
                    } else {
                        $data = ["status" => true, "data" => [$result], "message" => "Successfully verified user Email", "command" => "verifyUser"];
                    }
                }
            } else {
                $data = ["status" => false, "data" => [], "message" => "NO user Exist with " . $email . " email id.", "command" => "verifyUser"];
            }
        } else {
            $data['message'] = "";
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('email');
            }
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves the home data.
     *
     * @return void
     */
    public function getHome()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getHome"];

        $home = $this->apiModel->flattenToMultiDimensional($this->homeModel->getHome());
        if (count($home) > 0) {
            $data = ["status" => true, "data" => $home, "message" => "Oops, something went wrong", "command" => "getHome"];
        } else {
            $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getHome"];
        }
        return die(json_encode($data));
    }

    /**
     * Edit the home data.
     *
     * This method is responsible for updating the home data based on the provided update parameter.
     * If the update parameter is not empty, it calls the updateHome method of the homeModel to perform the update.
     * If the update is successful, it returns a JSON response with a status of true, updated data, and a success message.
     * If the update fails, it returns a JSON response with a status of false, an empty data array, and an error message.
     *
     * @return void
     */
    public function editHome()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "editHome"];
        $update = $this->request->getVar('update');
        if (!empty($update)) {
            $result = $this->homeModel->updateHome($update);
            if (!empty($result)) {
                $data['status'] = true;
                $data['data'] = $result;
                $data['message'] = "Home updated successfully";
            }
        }

        return die(json_encode($data));
    }

    /**
     * Edit the brand based on the provided data.
     *
     * @return void
     */
    public function editBrand()
    {
        $data = ["status" => false, "data" => [], "message" => "NO Data modified", "command" => "editBrand"];

        $rules = [
            'id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'id is REQUIRED',
                ],
            ],
        ];
        if ($this->validate($rules)) {
            $id = $this->request->getVar('id');
            $update = $this->request->getVar('update');
            if (!empty($update)) {
                $result = $this->brandModel->updateBrand($update, $id);
                if (0 < $result) {
                    $data['status'] = true;
                    $data['data'] = $result;
                    $data['message'] = "Brand updated successfully";
                }
            }
        } else {
            $data['message'] = "";
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('id');
            }
        }
        return die(json_encode($data));
    }

    /**
     * Edit a campaign.
     *
     * This method is responsible for editing a campaign based on the provided data.
     * It validates the input data against the defined rules and updates the campaign if the validation passes.
     * The method returns a JSON response containing the status, data, and message of the operation.
     *
     * @return void
     */
    public function editCampaign()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "editCampaign"];

        $rules = [
            'id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'id is REQUIRED',
                ],
            ],
        ];

        if ($this->validate($rules)) {
            $id = $this->request->getVar('id');
            $update = $this->request->getVar('update');
            if (!empty($update)) {
                $result = $this->campaignModel->updateCampaign($update, $id);
                if (0 < $result) {
                    $data['status'] = true;
                    $data['data'] = $result;
                    $data['message'] = "Campaign updated successfully";
                }
            }
        } else {
            $data['message'] = "";
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('id');
            }
        }

        return die(json_encode($data));
    }
    /**
     * Edit a user based on the provided data.
     *
     * @return void
     */
    public function editUser()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "editUser"];

        $rules = [
            'id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'id is REQUIRED',
                ],
            ],
        ];

        if ($this->validate($rules)) {
            $id = $this->request->getVar('id');
            $update = $this->request->getVar('update');
            if (!empty($update)) {
                $result = $this->userModel->updateUser($update, $id);
                if (0 < $result) {
                    $data['status'] = true;
                    $data['data'] = $result;
                    $data['message'] = "User updated successfully";
                }
            }
        } else {
            $data['message'] = "";
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('id');
            }
        }

        return die(json_encode($data));
    }




    /**
     * Adds a filter based on the provided rules and request data.
     *
     * @return void
     */
    public function addFilter()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "addFilter"];

        $rules = [
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'name is REQUIRED',
                ],
            ],
            'userId' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'userId is REQUIRED',
                    'numeric' => 'userId {value} Should be Number',
                ],
            ],
            'type' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'type is REQUIRED',
                    'numeric' => 'type should be number',
                ],
            ],
            'data' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'data is REQUIRED',
                ],
            ],
        ];

        if ($this->validate($rules)) {
            $ud = [];
            $ud["name"] = $this->request->getVar('name');
            $ud["userId"] = $this->request->getVar('userId');
            $ud["type"] = $this->request->getVar('type');
            $ud["data"] = $this->request->getVar('data');
            $msg = $this->apiModel->flattenToMultiDimensional($this->filterModel->createFilter($ud));
            if ($msg > 0) {
                $data = ["status" => true, "data" => $msg, "message" => "success", "command" => "addFilter"];
            } else {
                $data = ["status" => false, "data" => [], "message" => "Unable to add filter", "command" => "addFilter"];
            }
        } else {
            $data['message'] = "";
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('name');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('userId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('type');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('data');
            }
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves the filter data based on the provided userId and type.
     * 
     * @return void
     */
    public function getFilter()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getFilter"];
        $rules = [
            'userId' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'userid is REQUIRED',
                ],
            ],
            'type' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'type is REQUIRED',
                ],
            ],
        ];
        if ($this->validate($rules)) {
            $userId = $this->request->getVar('userId');
            $type = $this->request->getVar('type');
            $filterdata = $this->filterModel->getFilter($userId, $type);
            if ($filterdata > 0) {
                $data = ["status" => true, "data" => $filterdata, "message" => "success", "command" => "getFilter"];
            } else {
                $data = ["status" => false, "data" => [], "message" => "unable to update", "command" => "getFilter"];
            }
        } else {
            $data['message'] = "";
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('userId');
            }
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('type');
            }
        }
        return die(json_encode($data));
    }

    /**
     * Retrieves filter data by ID and returns it as a JSON response.
     *
     * @return void
     */
    public function getFilterById()
    {
        $data = ["status" => false, "data" => [], "message" => "Oops, something went wrong", "command" => "getFilterById"];
        $rules = [
            'id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'id is REQUIRED',
                ],
            ],
        ];
        if ($this->validate($rules)) {
            $id = $this->request->getVar('id');
            $filterdata = $this->filterModel->getFilterById($id);
            if ($filterdata > 0) {
                $data = ["status" => true, "data" => $filterdata, "message" => "success", "command" => "getFilterById"];
            } else {
                $data = ["status" => false, "data" => [], "message" => "unable to get data ", "command" => "getFilterById"];
            }
        } else {
            $data['message'] = "";
            if (empty($data['message'])) {
                $data['message'] = $this->validator->getError('id');
            }
        }
        return die(json_encode($data));
    }

}