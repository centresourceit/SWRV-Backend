<?php

namespace app\Models;

use CodeIgniter\Model;

class ApiModel extends Model {

    /**
     * Validates if the given email address is valid.
     *
     * @param string $email The email address to validate.
     * @param bool $custom Whether to check for custom domain emails.
     * @return string The validation result.
     */
   
    public function isValidEmail($email = "", $custom = false) {
        if (!preg_match('/^([a-z0-9\+\_\-\.]+)@([a-z0-9\+\_\-\.]{2,})(\.[a-z]{2,4})$/i', $email)) {
            return "Email is NOT VALID";
        } else {
            if ($custom == true) {
                if (in_array((explode('.', ((explode('@', $email))[1]))[0]), array('gmail', 'yahoo', 'hotmail', 'aol', 'msn', 'ymail', 'outlook', 'live', 'googlemail', 'icloud', 'rocketmail', 'facebook', 'skype', 'aim', 'gmx', 'zoho', 'yahoomail'))) {
                    return "Company Domain Email is Required";
                } else {
                    return "success";
                }
            } else {
                return "success";
            }
        }
    }

    /**
     * Validates a password based on certain criteria.
     *
     * @param string $password The password to validate.
     * @param int $min The minimum length of the password.
     * @param int $max The maximum length of the password.
     * @param bool $caps Whether the password must contain at least one capital letter.
     * @param bool $ucaps Whether the password must contain at least one lowercase letter.
     * @param bool $num Whether the password must contain at least one numeric digit.
     * @param bool $spcl Whether the password must contain at least one special character.
     * @return string Returns a success message if the password is valid, or an error message if it is not.
     */
    public function isValidPassword($password = "", $min = 6, $max = 32, $caps = true, $ucaps = true, $num = true, $spcl = true) {
        $password = trim($password);
        if (strlen($password) < $min) {
            return "Password Must Contain Atleast " . $min . " Character(s)";
        } elseif (strlen($password) > $max) {
            return "Password Must NOT Contain More Than " . $max . " Character(s)";
        } elseif (($num == true) && (!preg_match("#[0-9]+#", $password))) {
            return "Password Must Contain Numeric Digit";
        } elseif (($caps == true) && (!preg_match("#[A-Z]+#", $password))) {
            return "Password Must Contain Capital Alphabet";
        } elseif (($ucaps == true) && (!preg_match("#[a-z]+#", $password))) {
            return "Password Must Contain Small Alphabet";
        } elseif (($spcl == true) && (!preg_match("#[\W]+#", $password))) {
            return "Password Must Contain Special Character(s)";
        } else {
            return "success";
        }
    }

    /**
     * Flattens a multi-dimensional array into a nested array using a delimiter.
     *
     * @param array $array The array to be flattened.
     * @param string $delimiter The delimiter used to separate nested keys.
     * @return array The flattened multi-dimensional array.
     */
    public function flattenToMultiDimensional($array = array(), $delimiter = '.') {
        $result = [];
        if ((!isset($array)) || (is_null($array)) || (empty($array))) { } else {
            $array = json_decode(json_encode($array));
            if (is_object($array)) {
                foreach ($array as $notations => $value) {
                    $keys = explode($delimiter, $notations);
                    $keys = array_reverse($keys);
                    $lastVal = $value;
                    foreach ($keys as $key) {
                        $lastVal = [$key => $lastVal];
                    }
                    $result = array_merge_recursive($result, $lastVal);
                }
            } elseif (is_array($array)) {
                $res = array();
                for ($i = 0; $i < count($array); $i++) {
                    $result = [];
                    foreach ($array[$i] as $notations => $value) {
                        $keys = explode($delimiter, $notations);
                        $keys = array_reverse($keys);
                        $lastVal = $value;
                        foreach ($keys as $key) {
                            $lastVal = [$key => $lastVal];
                        }
                        $result = array_merge_recursive($result, $lastVal);
                    }
                    array_push($res, $result);
                }
                $result = $res;
            } else {
                
            }
        }
        return $result;
    }

    /**
     * Checks the completeness of a user profile.
     *
     * @param array $user The user profile to check.
     * @return int Returns 1 if the profile is complete, 0 otherwise.
     */
    public function checkProfileCompleteness($user = array()) {
        if ((!isset($user)) || (is_null($user)) || (empty($user))) {
            return 0;
        } elseif ((!isset($user['userName'])) || (is_null($user['userName'])) || (empty($user['userName']))) {
            return 0;
        } elseif ((!isset($user['knownAs'])) || (is_null($user['knownAs'])) || (empty($user['knownAs']))) {
            return 0;
        } elseif ((!isset($user['email'])) || (is_null($user['email'])) || (empty($user['email']))) {
            return 0;
        } elseif ((!isset($user['contact'])) || (is_null($user['contact'])) || (empty($user['contact']))) {
            return 0;
        } elseif ((!isset($user['pic'])) || (is_null($user['pic'])) || (empty($user['pic']))) {
            return 0;
        } elseif ((!isset($user['dob'])) || (is_null($user['dob'])) || (empty($user['dob']))) {
            return 0;
        } elseif ((!isset($user['city'])) || (is_null($user['city'])) || (empty($user['city']))) {
            return 0;
        } elseif ((!isset($user['city']['id'])) || (is_null($user['city']['id'])) || (empty($user['city']['id'])) || (($user['city']['id']) <= 0)) {
            return 0;
        } elseif ((!isset($user['gender'])) || (is_null($user['gender'])) || (empty($user['gender']))) {
            return 0;
        } elseif ((!isset($user['gender']['code'])) || (is_null($user['gender']['code'])) || (empty($user['gender']['code']))) {
            return 0;
        } elseif ((!isset($user['role'])) || (is_null($user['role'])) || (empty($user['role']))) {
            return 0;
        } elseif ((!isset($user['role']['code'])) || (is_null($user['role']['code'])) || (empty($user['role']['code'])) || (($user['role']['code']) <= 0)) {
            return 0;
        } elseif ((!isset($user['categories'])) || (is_null($user['categories'])) || (empty($user['categories'])) || (count($user['categories']) <= 0)) {
            return 0;
        } elseif ((!isset($user['categories'][0]['id'])) || (is_null($user['categories'][0]['id'])) || (empty($user['categories'][0]['id'])) || (($user['categories'][0]['id']) <= 0)) {
            return 0;
        } elseif ((!isset($user['languages'])) || (is_null($user['languages'])) || (empty($user['languages'])) || (count($user['languages']) <= 0)) {
            return 0;
        } elseif ((!isset($user['languages'][0]['id'])) || (is_null($user['languages'][0]['id'])) || (empty($user['languages'][0]['id'])) || (($user['languages'][0]['id']) <= 0)) {
            return 0;
        } elseif ((!isset($user['platforms'])) || (is_null($user['platforms'])) || (empty($user['platforms'])) || (count($user['platforms']) <= 0)) {
            return 0;
        } elseif ((!isset($user['platforms'][0]['id'])) || (is_null($user['platforms'][0]['id'])) || (empty($user['platforms'][0]['id'])) || (($user['platforms'][0]['id']) <= 0)) {
            return 0;
        } elseif ($user['role']['code'] == 10) {
            if ((!isset($user['currency'])) || (is_null($user['currency'])) || (empty($user['currency']))) {
                return 0;
            } elseif ((!isset($user['currency']['id'])) || (is_null($user['currency']['id'])) || (empty($user['currency']['id'])) || (($user['currency']['id']) <= 0)) {
                return 0;
            } else {
                return 1;
            }
        } elseif ($user['role']['code'] == 50) {
            if ((!isset($user['brand'])) || (is_null($user['brand'])) || (empty($user['brand']))) {
                return 0;
            } elseif ((!isset($user['brand']['id'])) || (is_null($user['brand']['id'])) || (empty($user['brand']['id'])) || (($user['brand']['id']) <= 0)) {
                return 0;
            } else {
                return 1;
            }
        } else {
            return 0;
        }
    }

}
