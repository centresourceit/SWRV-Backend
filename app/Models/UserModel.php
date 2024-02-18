<?php

namespace app\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

    /**
     * Create a new user with the given data.
     *
     * @param array $data
     * @return int The ID of the created user, or 0 if the data is empty or insertion fails.
     */
    public function createUser($data = array())
    {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('user');
            if ($builder->insert($data)) {
                return $this->db->insertID();
            } else {
                return 0;
            }
        }
    }

    /**
     * Update a user in the database with the given data.
     *
     * @param array $data
     * @param int $userId
     * @return int The number of affected rows
     */
    public function updateUser($data = array(), $userId = 0)
    {
        if (!isset($data) || is_null($data)) {
            return 0;
        } else {
            $builder = $this->db->table('user');
            $res = $builder->update($data, (' id = ' . $userId));
            if ($res) {
                $affectedRows = $this->db->affectedRows();
                return $affectedRows;
            } else {
                return 0;
            }
        }
    }

    /**
     * Find a user by their ID.
     *
     * @param int $userId
     * @return array|null
     */
    public function findOneUser($userId = 0)
    {
        if ($userId <= 0) {
            return null;
        } else {
            $query = $this->db->query("SELECT IFNULL(`user`.`id`,0) AS `id`, IFNULL(`city`.`id`,0) AS `city.id`, IFNULL(`city`.`cityCode`,'') AS `city.code`, IFNULL(`city`.`cityName`,'') AS `city.name`, IFNULL(`state`.`id`,0) AS `city.state.id`, IFNULL(`state`.`stateCode`,'') AS `city.state.code`, IFNULL(`state`.`stateName`,'') AS `city.state.name`, IFNULL(`country`.`id`,0) AS `city.state.country.id`, IFNULL(`country`.`countryCode`,'') AS `city.state.country.code`, IFNULL(`country`.`mobileISD`,'') AS `city.state.country.isd`, IFNULL(`country`.`countryName`,'') AS `city.state.country.name`, IFNULL(`user`.`marketId`,0) AS `marketId`,  IFNULL(`user`.`brandId`,0) AS `brandId`, IFNULL(`user`.`brandId`,0) AS `brand.id`, IFNULL(`currency`.`id`,0) AS `currency.id`, IFNULL(`currency`.`currencyCode`,'') AS `currency.code`, IFNULL(`currency`.`currencyAsciiSymbol`,'') AS `currency.symbol`, IFNULL(`currency`.`currencyName`,'') AS `currency.name`, IFNULL(`currency`.`currencyRateInd`,0) AS `currency.rate`, IFNULL(`referrerUser`.`id`,0) AS `referrer.id`, IFNULL(`referrerUser`.`userName`,'') AS `referrer.userName`, IFNULL(`user`.`userName`,'') AS `userName`, IFNULL(`user`.`userKnownAs`,'') AS `knownAs`, IFNULL(`user`.`userEmail`,'') AS `email`, IFNULL(`user`.`emailVerifiedAt`,'') AS `emailVerified`,  IFNULL(`user`.`userContact`,0) AS `contact`, IFNULL(`user`.`otpNo`,0) AS `otpNo`, IFNULL(`user`.`userFullPostalAddress`,'') AS `address`,IFNULL(`user`.`acNo`,'') AS `acNo`,IFNULL(`user`.`ifsc`,'') AS `ifsc`,IFNULL(`user`.`bankName`,'') AS `bankName`,IFNULL(`user`.`branchName`,'') AS `branchName`, IFNULL(`user`.`userWebUrl`,'') AS `website`, IFNULL(`user`.`deviceToken`,'') AS `deviceToken`, IFNULL(`user`.`userBioInfo`,'') AS `bio`, IFNULL(`user`.`personalHistory`,'') AS `personalHistory`, IFNULL(`user`.`careerHistory`,'') AS `careerHistory`, IFNULL(`user`.`externalLinks`,'') AS `externalLinks`, IFNULL(`user`.`userPayTmContact`,0) AS `paytm`, IFNULL(`user`.`userGender`,0) AS `gender.code`, (CASE WHEN (IFNULL(`user`.`userGender`,0)=0) THEN ('NA') ELSE (CASE WHEN (IFNULL(`user`.`userGender`,0)=1) THEN ('MALE') ELSE (CASE WHEN (IFNULL(`user`.`userGender`,0)=2) THEN ('FEMALE') ELSE (CASE WHEN (IFNULL(`user`.`userGender`,0)=3) THEN ('TRANSGENDER') ELSE ('NA') END) END) END) END) AS `gender.name`, IFNULL(`user`.`userRole`,0) AS `role.code`, (CASE WHEN (IFNULL(`user`.`userRole`,0)=0) THEN ('NA') ELSE (CASE WHEN (IFNULL(`user`.`userRole`,0)=10) THEN ('INFLUENCER') ELSE (CASE WHEN (IFNULL(`user`.`userRole`,0)=50) THEN ('BRAND') ELSE (CASE WHEN (IFNULL(`user`.`userRole`,0)=80) THEN ('ADMIN') ELSE ('NA') END) END) END) END) AS `role.name`, IFNULL(`user`.`userDOB`,'') AS `dob`, IFNULL(`user`.`userAvgRating`,0) AS `rating`, IFNULL(`user`.`userWalletBalance`,0) AS `wallet`, IFNULL(`user`.`userPicUrl`,0) AS `pic`, IFNULL(`user`.`userStatus`,0) AS `status.code`, (CASE WHEN (IFNULL(`user`.`userStatus`,0)=0) THEN ('NA') ELSE (CASE WHEN (IFNULL(`user`.`userStatus`,0)=1) THEN ('ACTIVE') ELSE (CASE WHEN (IFNULL(`user`.`userStatus`,0)=2) THEN ('INACTIVE') ELSE (CASE WHEN (IFNULL(`user`.`userStatus`,0)=3) THEN ('CAUTIONARY') ELSE (CASE WHEN (IFNULL(`user`.`userStatus`,0)=4) THEN ('BLACKLISTED') ELSE ('NA') END) END) END) END) END) AS `status.name`, (CASE WHEN (IFNULL(`user`.`userVerifiedAt`,0)=1) THEN ('VERIFIED') ELSE ('UNVERIFIED') END) AS `status.isVerified`, IFNULL(`user`.`userVerifiedAt`,'') AS `status.verifiedAt`, IFNULL(`user`.`createdAt`,'') AS `createdAt` FROM `user` LEFT JOIN `city` ON `user`.`cityId`=`city`.`id` LEFT JOIN `state` ON `city`.`stateId`=`state`.`id` LEFT JOIN `country` ON `state`.`countryId`=`country`.`id` LEFT JOIN `currency` ON `user`.`currencyId`=`currency`.`id` LEFT JOIN `user` AS `referrerUser` ON `user`.`referrerUserId`=`referrerUser`.`id` WHERE `user`.`id` = " . $userId . " GROUP BY `user`.`id` ORDER BY `user`.`id` DESC LIMIT 0,1");
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result[0]), true));
            } else {
                return null;
            }
        }
    }

    /**
     * Get the referrals of a user by their user ID.
     *
     * @param int $userId
     * @return array
     */
    public function getRefferralsByUserId($userId = 0)
    {
        if ($userId <= 0) {
            return [];
        } else {
            $query = $this->db->query("SELECT IFNULL(`user`.`id`,0) AS `id`, IFNULL(`city`.`id`,0) AS `city.id`, IFNULL(`city`.`cityCode`,'') AS `city.code`, IFNULL(`city`.`cityName`,'') AS `city.name`, IFNULL(`state`.`id`,0) AS `city.state.id`, IFNULL(`state`.`stateCode`,'') AS `city.state.code`, IFNULL(`state`.`stateName`,'') AS `city.state.name`, IFNULL(`country`.`id`,0) AS `city.state.country.id`, IFNULL(`country`.`countryCode`,'') AS `city.state.country.code`, IFNULL(`country`.`mobileISD`,'') AS `city.state.country.isd`, IFNULL(`country`.`countryName`,'') AS `city.state.country.name`, IFNULL(`user`.`brandId`,0) AS `brandId`, IFNULL(`user`.`brandId`,0) AS `brand.id`, IFNULL(`currency`.`id`,0) AS `currency.id`, IFNULL(`currency`.`currencyCode`,'') AS `currency.code`, IFNULL(`currency`.`currencyAsciiSymbol`,'') AS `currency.symbol`, IFNULL(`currency`.`currencyName`,'') AS `currency.name`, IFNULL(`currency`.`currencyRateInd`,0) AS `currency.rate`, IFNULL(`referrerUser`.`id`,0) AS `referrer.id`, IFNULL(`referrerUser`.`userName`,'') AS `referrer.userName`, IFNULL(`user`.`userName`,'') AS `userName`, IFNULL(`user`.`userKnownAs`,'') AS `knownAs`, IFNULL(`user`.`userEmail`,'') AS `email`, IFNULL(`user`.`userContact`,0) AS `contact`, IFNULL(`user`.`otpNo`,0) AS `otpNo`, IFNULL(`user`.`userFullPostalAddress`,'') AS `address`, IFNULL(`user`.`userWebUrl`,'') AS `website`, IFNULL(`user`.`deviceToken`,'') AS `deviceToken`, IFNULL(`user`.`userBioInfo`,'') AS `bio`, IFNULL(`user`.`personalHistory`,'') AS `personalHistory`, IFNULL(`user`.`careerHistory`,'') AS `careerHistory`, IFNULL(`user`.`externalLinks`,'') AS `externalLinks`, IFNULL(`user`.`userPayTmContact`,0) AS `paytm`, IFNULL(`user`.`userGender`,0) AS `gender.code`, (CASE WHEN (IFNULL(`user`.`userGender`,0)=0) THEN ('NA') ELSE (CASE WHEN (IFNULL(`user`.`userGender`,0)=1) THEN ('MALE') ELSE (CASE WHEN (IFNULL(`user`.`userGender`,0)=2) THEN ('FEMALE') ELSE (CASE WHEN (IFNULL(`user`.`userGender`,0)=3) THEN ('TRANSGENDER') ELSE ('NA') END) END) END) END) AS `gender.name`, IFNULL(`user`.`userRole`,0) AS `role.code`, (CASE WHEN (IFNULL(`user`.`userRole`,0)=0) THEN ('NA') ELSE (CASE WHEN (IFNULL(`user`.`userRole`,0)=10) THEN ('INFLUENCER') ELSE (CASE WHEN (IFNULL(`user`.`userRole`,0)=50) THEN ('BRAND') ELSE (CASE WHEN (IFNULL(`user`.`userRole`,0)=80) THEN ('ADMIN') ELSE ('NA') END) END) END) END) AS `role.name`, IFNULL(`user`.`userDOB`,'') AS `dob`, IFNULL(`user`.`userAvgRating`,0) AS `rating`, IFNULL(`user`.`userWalletBalance`,0) AS `wallet`, IFNULL(`user`.`userPicUrl`,0) AS `pic`, IFNULL(`user`.`userStatus`,0) AS `status.code`, (CASE WHEN (IFNULL(`user`.`userStatus`,0)=0) THEN ('NA') ELSE (CASE WHEN (IFNULL(`user`.`userStatus`,0)=1) THEN ('ACTIVE') ELSE (CASE WHEN (IFNULL(`user`.`userStatus`,0)=2) THEN ('INACTIVE') ELSE (CASE WHEN (IFNULL(`user`.`userStatus`,0)=3) THEN ('CAUTIONARY') ELSE (CASE WHEN (IFNULL(`user`.`userStatus`,0)=4) THEN ('BLACKLISTED') ELSE ('NA') END) END) END) END) END) AS `status.name`, (CASE WHEN (IFNULL(`user`.`userVerifiedAt`,0)=1) THEN ('VERIFIED') ELSE ('UNVERIFIED') END) AS `status.isVerified`, IFNULL(`user`.`userVerifiedAt`,'') AS `status.verifiedAt`, IFNULL(`user`.`createdAt`,'') AS `createdAt` FROM `user` LEFT JOIN `city` ON `user`.`cityId`=`city`.`id` LEFT JOIN `state` ON `city`.`stateId`=`state`.`id` LEFT JOIN `country` ON `state`.`countryId`=`country`.`id` LEFT JOIN `currency` ON `user`.`currencyId`=`currency`.`id` LEFT JOIN `user` AS `referrerUser` ON `user`.`referrerUserId`=`referrerUser`.`id` WHERE `user`.`referrerUserId` = " . $userId . " GROUP BY `user`.`id`,`user`.`referrerUserId` ORDER BY `user`.`id` DESC");
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result), true));
            } else {
                return [];
            }
        }
    }

    /**
     * Check if a user exists in the database based on the given search criteria.
     *
     * @param string $search
     * @return array|null
     */
    public function checkUserExists($search = "")
    {
        $query = $this->db->query("SELECT `user`.* FROM `user` WHERE `user`.`id` = '" . $search . "' OR `user`.`userName` = '" . $search . "' OR `user`.`userKnownAs` = '" . $search . "' OR `user`.`userEmail` = '" . $search . "' OR `user`.`userContact` = '" . $search . "' OR `user`.`userPayTmContact` = '" . $search . "' GROUP BY `user`.`id` ORDER BY `user`.`id` DESC LIMIT 0,1");
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result[0]), true));
        } else {
            return null;
        }
    }

    /**
     * Verifies if a user exists in the database based on their email.
     *
     * @param string $user
     * @return array|null
     */
    public function verifyUser($user = "")
    {
        $query = $this->db->query("SELECT `user`.`id`, `user`.`userName`, `user`.`userEmail`, `user`.`userContact`, `user`.`userPassword` FROM `user` WHERE `user`.`userEmail` = '" . $user . "' GROUP BY `user`.`id` ORDER BY `user`.`id` DESC LIMIT 0,1");
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result[0]), true));
        } else {
            return null;
        }
    }

    /**
     * Search for users based on the given criteria.
     *
     * @param array $data
     * @return array
     */
    public function searchUser($data = array())
    {
        $searchArg = [];
        $search = "";
        if ((!isset($data['id'])) || (is_null($data['id'])) || (empty($data['id']))) {
        } else {
            array_push($searchArg, ("`user`.`id` IN (" . ($data['id']) . ")"));
        }
        if ((!isset($data['city'])) || (is_null($data['city'])) || (empty($data['city']))) {
        } else {
            array_push($searchArg, ("`city`.`id` IN (" . ($data['city']) . ")"));
        }
        if ((!isset($data['brand'])) || (is_null($data['brand'])) || (empty($data['brand']))) {
        } else {
            array_push($searchArg, ("`brand`.`id` IN (" . ($data['brand']) . ")"));
        }
        if ((!isset($data['brandName'])) || (is_null($data['brandName'])) || (empty($data['brandName']))) {
        } else {
            array_push($searchArg, ("`brand`.`id` LINK %" . ($data['brandName']) . "%"));
        }
        if ((!isset($data['currency'])) || (is_null($data['currency'])) || (empty($data['currency']))) {
        } else {
            array_push($searchArg, ("`currency`.`id` IN (" . ($data['currency']) . ")"));
        }
        if ((!isset($data['category'])) || (is_null($data['category'])) || (empty($data['category']))) {
        } else {
            array_push($searchArg, ("`category`.`id` IN (" . ($data['category']) . ")"));
        }
        if ((!isset($data['language'])) || (is_null($data['language'])) || (empty($data['language']))) {
        } else {
            array_push($searchArg, ("`language`.`id` IN (" . ($data['language']) . ")"));
        }
        if ((!isset($data['platform'])) || (is_null($data['platform'])) || (empty($data['platform']))) {
        } else {
            array_push($searchArg, ("`platform`.`id` IN (" . ($data['platform']) . ")"));
        }
        if ((!isset($data['age'])) || (is_null($data['age'])) || (empty($data['age']))) {
        } else {
            array_push($searchArg, ("TIMESTAMPDIFF(YEAR, IFNULL(`user`.`userDOB`,CURRENT_DATE), CURRENT_TIMESTAMP) >= " . ($data['age'])));
        }
        if ((!isset($data['active'])) || (is_null($data['active'])) || (empty($data['active']))) {
        } else {
            array_push($searchArg, ("IFNULL(`user`.`userStatus`,0) = 1"));
        }
        if ((!isset($data['role'])) || (is_null($data['role'])) || (empty($data['role']))) {
        } else {
            array_push($searchArg, ("IFNULL(`user`.`userRole`,0) = " . ($data['role']) . ""));
        }
        if ((!isset($data['gender'])) || (is_null($data['gender'])) || (empty($data['gender']))) {
        } else {
            array_push($searchArg, ("IFNULL(`user`.`userGender`,0) = " . ($data['gender']) . ""));
        }
        if ((!isset($data['rating'])) || (is_null($data['rating'])) || (empty($data['rating']))) {
        } else {
            array_push($searchArg, ("IFNULL(`user`.`userAvgRating`,0) >= " . ($data['rating']) . ""));
        }
        if ((!isset($data['email'])) || (is_null($data['email'])) || (empty($data['email']))) {
        } else {
            array_push($searchArg, ("IFNULL(`user`.`userEmail`,0) = '" . ($data['email']) . "'"));
        }
        if ((!isset($data['search'])) || (is_null($data['search'])) || (empty($data['search']))) {
        } else {
            array_push($searchArg, ("CONCAT(IFNULL(`handle`.`handleName`,''),' ',IFNULL(`user`.`deviceModelName`,''),' ',IFNULL(`user`.`userPayTmContact`,''),' ',IFNULL(`user`.`userName`,''),' ',IFNULL(`user`.`userKnownAs`,''),' ',IFNULL(`user`.`userEmail`,''),' ',IFNULL(`user`.`userContact`,''),' ',IFNULL(`user`.`userFullPostalAddress`,'')) LIKE '%" . ($data['search']) . "%'"));
        }

        if ((is_null($searchArg)) || (empty($searchArg)) || (count($searchArg) <= 0)) {
            $search = "";
        } else {
            $search = " AND (" . implode(" AND ", $searchArg) . ")";
        }

        $q = "SELECT `user`.* FROM `user` LEFT JOIN `city` ON `user`.`cityId`=`city`.`id` LEFT JOIN `brand` ON `user`.`brandId`=`brand`.`id` LEFT JOIN `currency` ON `user`.`currencyId`=`currency`.`id` LEFT JOIN `category` ON FIND_IN_SET(IFNULL(`category`.`id`,0),IFNULL(`user`.`categories`,'')) LEFT JOIN `language` ON FIND_IN_SET(IFNULL(`language`.`id`,0),IFNULL(`user`.`languages`,'')) LEFT JOIN `handle` ON `user`.`id`=`handle`.`userId` LEFT JOIN `platform` ON `handle`.`platformId`=`platform`.`id` WHERE `user`.`deletedAt` IS NULL" . $search . " GROUP BY `user`.`id` ORDER BY `user`.`id` DESC LIMIT 0,99";
        $query = $this->db->query($q);

        $result = $query->getResult();


        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {

            return [];
        }
    }

    /**
     * Find a team from the database.
     *
     * This method executes a query to retrieve the team data from the "team" table in the database.
     * It only returns teams that have not been deleted (deletedAt IS NULL) and have a status of 1.
     *
     * @return array|null Returns an array of team data if a team is found, or null if no team is found.
     */
    public function findTeam()
    {
        $query = $this->db->query("SELECT * FROM team WHERE deletedAt IS NULL AND status = 1;");
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return null;
        }
    }

    /**
     * Add a new team to the database.
     *
     * @param array $data The data for the new team.
     * @return int The ID of the newly inserted team, or 0 if the insertion failed.
     */
    public function addOneTeam($data = array())
    {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('team');
            if ($builder->insert($data)) {
                return $this->db->insertID();
            } else {
                $error = $this->db->error();
                echo $error['message'];
                return 0;
            }
        }
    }

    /**
     * Logs in an admin user with the given username and password.
     *
     * @param string $userName
     * @param string $password
     * @return mixed Returns an array of user data if login is successful, 0 if either username or password is not set or null, or null if login fails.
     */
    public function adminLogin($userName, $password)
    {
        if (!isset($userName) || is_null($userName)  || !isset($password) || is_null($password)) {
            return 0;
        } else {
            $q = "SELECT * FROM user WHERE deletedAt IS NULL AND userRole = 80 AND userName = '" . $userName . "' AND userPassword = '" . $password . "';";
            $query = $this->db->query($q);
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result), true));
            } else {
                $error = $this->db->error();
                echo $error['message'];
                return null;
            }
        }
    }

    /**
     * Get the details of a team with the given ID.
     *
     * @param int $id The ID of the team. Default is 0.
     * @return array The details of the team as an associative array. If the team is not found or the ID is invalid, an empty array is returned.
     */
    public function getOneTeam($id = 0)
    {
        if ($id <= 0) {
            return [];
        } else {
            $query = $this->db->query("SELECT * FROM `team` WHERE status = 1 AND deletedAt IS NULL AND id = " . $id . ";");
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result), true));
            } else {
                return [];
            }
        }
    }

    /**
     * Delete a team from the database.
     *
     * @param int $id The ID of the team to delete.
     * @return array The deleted team's information, if deletion was successful. Otherwise, an empty array.
     */
    public function delOneTeam($id = 0)
    {
        if ($id <= 0) {
            return [];
        } else {
            $q = "UPDATE `team` SET `deletedAt` = CURRENT_TIMESTAMP , status = 0 WHERE `team`.`id` = " . $id . ";";
            $result = $this->db->query($q);
            if ($result && $this->db->affectedRows() > 0) {
                $q = "SELECT * FROM `team` WHERE `team`.`id` = " . $id . ";";
                $result1 = $this->db->query($q);
                $res = $result1->getResult();
                return $res;
            } else {
                return [];
            }
        }
    }

    /**
     * Edit a team in the database.
     *
     * @param array $data The data to update the team with.
     * @param int $id The ID of the team to edit.
     * @return array The updated team data if successful, an empty array otherwise.
     */
    public function editOneTeam($data = array(), $id = 0)
    {
        if ((!isset($data)) || (is_null($data)) || (count($data) <= 0) || (!isset($id)) || (is_null($id))) {
            return [];
        } else {
            $builder = $this->db->table('team');
            $res = $builder->update($data, (' id = ' . $id));
            if ($res) {
                $q = "SELECT * FROM `team` WHERE `team`.`id` = " . $id . ";";
                $result1 = $this->db->query($q);
                $res1 = $result1->getResult();
                // die($res1);
                return $res1;
            } else {
                return [];
            }
        }
    }

    /**
     * Retrieves all users from the database.
     *
     * @return array|null An array of user objects, or null if no users are found.
     */
    public function getUsers()
    {
        $query = $this->db->query("SELECT * FROM user;");
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return null;
        }
    }


    /**
     * Update the status of a user with the given ID.
     *
     * @param int $id
     * @param mixed $status
     * @return array
     */
    public function updateStauts($id = 0, $status)
    {
        if ($id <= 0) {
            return [];
        } elseif (!isset($status) || is_null($status)) {
            return [];
        } else {
            $q = "UPDATE `user` SET `userStatus` = " . $status . " WHERE `user`.`id` = " . $id . ";";
            $result = $this->db->query($q);
            if ($result && $this->db->affectedRows() > 0) {
                $q = "SELECT * FROM `user` WHERE `user`.`id` = " . $id . ";";
                $result1 = $this->db->query($q);
                $res = $result1->getResult();
                return $res;
            } else {
                return [];
            }
        }
    }

    /**
     * Check if a user with the given email exists in the database.
     *
     * @param string $email
     * @return bool
     */
    public function isUserExist($email=""){
        if($email == "" || !isset($email)){
            return false;
        }
        else{
            $q = "SELECT * FROM user WHERE userEmail = '".$email."';";
            $query = $this->db->query($q);
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return true;
            } else {
                $error = $this->db->error();
                echo $error['message'];
                return false;
            }
        }

    }
}
