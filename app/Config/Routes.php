<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$myRoutes = [];

$myRoutes['index'] = "Home::index";
$myRoutes['send-email'] = "CustomEmail::index";

// API
$myRoutes['api/register'] = "Api::register";
$myRoutes['api/login'] = "Api::login";
$myRoutes['api/admin-login'] = "Api::adminLogin";
$myRoutes['api/send-fcm'] = "Api::sendFCM";
$myRoutes['api/get-city'] = "Api::getCity";
$myRoutes['api/get-state'] = "Api::getState";
$myRoutes['api/get-country'] = "Api::getCountry";
$myRoutes['api/upload-file'] = "Api::uploadFile";
$myRoutes['api/add-brand'] = "Api::addNewBrand";
$myRoutes['api/get-brand'] = "Api::getBrand";

// market
$myRoutes['api/get-market'] = "Api::getMarket";
$myRoutes['api/get-market-byid'] = "Api::getMarketByid";
$myRoutes['api/add-market'] = "Api::addMarket";
$myRoutes['api/del-market'] = "Api::delMarket";
$myRoutes['api/upd-market'] = "Api::updMarket";


$myRoutes['api/search-brand'] = "Api::searchBrand";
$myRoutes['api/get-top-brands'] = "Api::topBrands";
$myRoutes['api/get-top-campaigns'] = "Api::getTopCampaigns";

$myRoutes['api/get-user-brand'] = "Api::getBrandByUser";
$myRoutes['api/profile'] = "Api::userProfile";
$myRoutes['api/add-review'] = "Api::addNewReview";
$myRoutes['api/search-review'] = "Api::searchReview";
$myRoutes['api/add-handle'] = "Api::addNewHandle";
$myRoutes['api/get-user-handle'] = "Api::getHandle";
$myRoutes['api/update-handle'] = "Api::updateHandle";
$myRoutes['api/delete-handle'] = "Api::deleteHandle";
$myRoutes['api/add-campaign'] = "Api::addNewCampaign";
$myRoutes['api/add-campaign-mood'] = "Api::addNewCampaignAttachment/3";
$myRoutes['api/add-campaign-attachment'] = "Api::addNewCampaignAttachment/4";
$myRoutes['api/add-logo'] = "Api::uploadLogo";
$myRoutes['api/campaign-search'] = "Api::searchCampaign";
$myRoutes['api/user-search'] = "Api::searchUser";
$myRoutes['api/get-my-campaigns'] = "Api::getMyCampaigns";
$myRoutes['api/get-campaign'] = "Api::getCampaign";
$myRoutes['api/get-campaign-type'] = "Api::getCampaignType";
$myRoutes['api/get-brand-connection'] = "Api::getBrandConnection";
$myRoutes['api/get-brand-com-cam'] = "Api::getBrandComCam";
$myRoutes['api/get-received-payment'] = "Api::getReceivedPayment";
$myRoutes['api/get-pending-payment'] = "Api::getPendingPayment";
$myRoutes['api/update-payment'] = "Api::updatePayment";
$myRoutes['api/payment-status'] = "Api::paymentStatus";
$myRoutes['api/payment-graph'] = "Api::paymentGraph";
$myRoutes['api/get-user-review'] = "Api::getUserReview";
$myRoutes['api/get-user-handles'] = "Api::getUserHandles";
$myRoutes['api/get-user-media'] = "Api::getUserMedia";
$myRoutes['api/get-top-influencer'] = "Api::topInfluencer";


$myRoutes['api/add-invite'] = "Api::addNewInvite";
$myRoutes['api/search-invite'] = "Api::searchInvite";
$myRoutes['api/update-invite'] = "Api::updateInvite";
$myRoutes['api/search-draft'] = "Api::searchDraft";
$myRoutes['api/update-draft'] = "Api::updateDraft";
$myRoutes['api/review-draft'] = "Api::reviewDraft";
$myRoutes['api/add-draft'] = "Api::addNewCampaignDraft";
$myRoutes['api/add-chat'] = "Api::addNewInboxMsg";
$myRoutes['api/search-chat'] = "Api::searchInboxMsg";
$myRoutes['api/update-chat'] = "Api::updateInboxMsg";

$myRoutes['api/send-otp'] = "Api::sendOTP";
$myRoutes['api/user-analytics'] = "Api::userAnalytics";
// $myRoutes['api/send-user-otp'] = "Api::sendUserOTP";
// $myRoutes['api/send-brand-otp'] = "Api::sendBrandOTP";
$myRoutes['api/send-referral'] = "Api::addNewInfluencerReferral";
$myRoutes['api/send-brand-invite'] = "Api::addNewBrandInvite";
$myRoutes['api/change-password'] = "Api::verifyChangePassword";
$myRoutes['api/forgot-password'] = "Api::verifyForgotPassword";
$myRoutes['api/send-change-password'] = "Api::sendChangePasswordMail";
$myRoutes['api/send-forgot-password'] = "Api::sendForgotPasswordMail";
$myRoutes['api/change-password/(:num)'] = "Api::verifyChangePassword/$1";
$myRoutes['api/forgot-password/(:num)'] = "Api::verifyForgotPassword/$1";
// $myRoutes['api/verify-otp/(:num)/(:num)/(:num)'] = "Api::verifyOTP/$1/$2/$3";
// $myRoutes['api/verify-user-otp/(:num)/(:num)'] = "Api::verifyUserOTP/$1/$2";
// $myRoutes['api/verify-brand-otp/(:num)/(:num)'] = "Api::verifyBrandOTP/$1/$2";
$myRoutes['api/change-password/(:num)/(:num)'] = "Api::verifyChangePassword/$1/$2";
$myRoutes['api/forgot-password/(:num)/(:num)'] = "Api::verifyForgotPassword/$1/$2";

$myRoutes['send-otp'] = "Api::sendOTP";
// $myRoutes['send-user-otp'] = "Api::sendUserOTP";
// $myRoutes['send-brand-otp'] = "Api::sendBrandOTP";
$myRoutes['send-referral'] = "Api::addNewInfluencerReferral";
$myRoutes['send-brand-invite'] = "Api::addNewBrandInvite";
$myRoutes['change-password'] = "Api::verifyChangePassword";
$myRoutes['forgot-password'] = "Api::verifyForgotPassword";
$myRoutes['send-change-password'] = "Api::sendChangePasswordMail";
$myRoutes['send-forgot-password'] = "Api::sendForgotPasswordMail";
$myRoutes['change-password/(:num)'] = "Api::verifyChangePassword/$1";
$myRoutes['forgot-password/(:num)'] = "Api::verifyForgotPassword/$1";
// $myRoutes['verify-otp/(:num)/(:num)/(:num)'] = "Api::verifyOTP/$1/$2/$3";
// $myRoutes['verify-user-otp/(:num)/(:num)'] = "Api::verifyUserOTP/$1/$2";
// $myRoutes['verify-brand-otp/(:num)/(:num)'] = "Api::verifyBrandOTP/$1/$2";
$myRoutes['change-password/(:num)/(:num)'] = "Api::verifyChangePassword/$1/$2";
$myRoutes['forgot-password/(:num)/(:num)'] = "Api::verifyForgotPassword/$1/$2";


$myRoutes['api/new-pay-request'] = "Api::addNewPayReq";
$myRoutes['api/get-req-pay'] = "Api::searchPayReq";
$myRoutes['api/user-referrals/(:num)'] = "Api::getReferralsByUserId/$1";


// insta handel
$myRoutes['api/add-insta-handel'] = "Api::addInstaHandel";
$myRoutes['api/get-insta-handel-byid'] = "Api::getInstaHandelByid";


// 
$myRoutes['api/add-contact'] = "Api::addContact";
$myRoutes['api/get-contact'] = "Api::getContact";
$myRoutes['api/add-dispute'] = "Api::addDispute";
$myRoutes['api/get-dispute'] = "Api::getDispute";
$myRoutes['api/add-bid'] = "Api::addBid";
$myRoutes['api/get-campaign-last-bid'] = "Api::getCampaignLastBid";
$myRoutes['api/get-campaign-bid'] = "Api::getCampaignBid";
$myRoutes['api/get-bid'] = "Api::getBid";
$myRoutes['api/get-bid-snapshot'] = "Api::getBidSnapshot";
$myRoutes['api/get-approved-bid'] = "Api::getApprovedBid";
$myRoutes['api/approve-bid'] = "Api::approveBid";


//filter
$myRoutes['api/add-filter'] = "Api::addFilter";
$myRoutes['api/get-filter'] = "Api::getFilter";
$myRoutes['api/get-filter-byid'] = "Api::getFilterById";



// team
$myRoutes['api/get-team'] = "Api::getTeam";
$myRoutes['api/get-team-byid'] = "Api::getTeamByid";
$myRoutes['api/add-team'] = "Api::addTeam";
$myRoutes['api/del-team'] = "Api::delTeam";
$myRoutes['api/upd-team'] = "Api::updTeam";


//newsblogevent
$myRoutes['api/get-neb'] = "Api::getNEB";
$myRoutes['api/get-neb-bytype'] = "Api::getNEBbyType";
$myRoutes['api/get-neb-byid'] = "Api::getNEBById";
$myRoutes['api/del-neb'] = "Api::delNEB";
$myRoutes['api/upd-neb'] = "Api::updNEB";
$myRoutes['api/add-neb'] = "Api::addNEB";
$myRoutes['api/search-neb'] = "Api::searchNEB";



$myRoutes['api/get-users'] = "Api::getusers";
$myRoutes['api/status-user'] = "Api::statususer";
$myRoutes['api/get-brands'] = "Api::getbrands";
$myRoutes['api/status-brand'] = "Api::statusbrand";
$myRoutes['api/get-campaigns'] = "Api::getcampaigns";
$myRoutes['api/status-campaign'] = "Api::statuscampaign";

$myRoutes['api/geofencing-campaign'] = "Api::geofencingCampaign";


$myRoutes['api/verify-user'] = "Api::verifyUser";


// karan
$myRoutes['api/getplatform'] = "Api::getplatform";
$myRoutes['api/getcurrency'] = "Api::getcurrency";

//category
$myRoutes['api/getcategory'] = "Api::getcategory";
$myRoutes['api/get-category-byid'] = "Api::getCategoryByid";
$myRoutes['api/add-category'] = "Api::addCategory";
$myRoutes['api/del-category'] = "Api::delCategory";
$myRoutes['api/upd-category'] = "Api::updCategory";



// languages
$myRoutes['api/getlanguage'] = "Api::getlanguage";


// country
$myRoutes['api/getcountry'] = "Api::getcountry";
$myRoutes['api/getcity'] = "Api::getcity";
$myRoutes['api/createchampaign'] = "Api::createChampaign";
$myRoutes['api/updateuser'] = "Api::updateUser";
$myRoutes['api/uploadavatar'] = "Api::uploadAvatar";
$myRoutes['api/getuser'] = "Api::getUserById";


$myRoutes['api/addTeam'] = "Api::addTeam";

$myRoutes['api/get-home'] = "Api::getHome";
$myRoutes['api/edit-home'] = "Api::editHome";
$myRoutes['api/edit-brand'] = "Api::editBrand";
$myRoutes['api/edit-campaign'] = "Api::editCampaign";
$myRoutes['api/edit-user'] = "Api::editUser";

$routes->map($myRoutes);

$routes->set404Override(function () {
    echo view('errors/custom/e404');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}