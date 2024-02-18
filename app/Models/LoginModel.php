<?php

namespace app\Models;

use CodeIgniter\Model;

class LoginModel extends Model {

    /**
     * Retrieves the logged-in user information from the session.
     *
     * @return array|null The logged-in user information as an associative array, or null if no user is logged in.
     */
    public function getLoggedInUser() {
        if (session()->has('isLoggedIn')) {
            $id = session()->get('userId');
            $query = $this->db->query("SELECT IFNULL(`user`.`id`,0) AS `id`, IFNULL(`user`.`hierarchyId`,0) AS `hierarchyId`, IFNULL(`hierarchy`.`positionTitle`,'') AS `hierarchyPositionTitle`, IFNULL(`hierarchy`.`seniorId`,0) AS `hierarchySeniorId`, IFNULL(`senior`.`positionTitle`,'') AS `seniorPositionTitle`, IFNULL(`hierarchy`.`departmentId`,0) AS `departmentId`, IFNULL(`department`.`departmentName`,'') AS `departmentName`, IFNULL(`village`.`id`,'') AS `villageId`, IFNULL(`village`.`villageName`,'') AS `villageName`, IFNULL(`city`.`id`,'') AS `cityId`, IFNULL(`city`.`cityName`,'') AS `cityName`, IFNULL(`user`.`name`,'') AS `userName`, IFNULL(`user`.`password`,'') AS `userPassword`, IFNULL(`user`.`contact`,0) AS `userContact`, IFNULL(`user`.`email`,'') AS `userEmail`, IFNULL(`user`.`gender`,0) AS `userGender`, (CASE WHEN (IFNULL(`user`.`gender`,0)=0) THEN ('NA') ELSE (CASE WHEN (IFNULL(`user`.`gender`,0)=1) THEN ('MALE') ELSE (CASE WHEN (IFNULL(`user`.`gender`,0)=2) THEN ('FEMALE') ELSE (CASE WHEN (IFNULL(`user`.`gender`,0)=0) THEN ('TRANSGENDER') ELSE ('NA') END) END) END) END) AS `userGenderName`, IFNULL(`user`.`dob`,CURRENT_DATE) AS `userDOB`, TIMESTAMPDIFF(YEAR,IFNULL(`user`.`dob`,CURRENT_DATE),CURRENT_DATE) AS `userAge`, CONCAT(TIMESTAMPDIFF(YEAR,IFNULL(`user`.`dob`,CURRENT_DATE),CURRENT_DATE),' y ',CEILING(TIMESTAMPDIFF(YEAR,IFNULL(`user`.`dob`,CURRENT_DATE),CURRENT_DATE)%12),' m ',CEILING(TIMESTAMPDIFF(YEAR,IFNULL(`user`.`dob`,CURRENT_DATE),CURRENT_DATE)%30.4375),' d') AS `exactUserFullAge`, IFNULL(`user`.`role`,0) AS `userRole`, (CASE WHEN (IFNULL(`user`.`role`,0)=0) THEN ('NA') ELSE (CASE WHEN (IFNULL(`user`.`role`,0)=10) THEN ('CUSTOMER') ELSE (CASE WHEN (IFNULL(`user`.`role`,0)=50) THEN ('OFFICER') ELSE (CASE WHEN (IFNULL(`user`.`role`,0)=80) THEN ('SUPER-ADMIN') ELSE ('NA') END) END) END) END) AS `userRoleName`, IFNULL(`user`.`picUrl`,'') AS `userPicUrl`, IFNULL(`user`.`createdAt`,CURRENT_TIMESTAMP) AS `userCreatedAt`, IFNULL(`user`.`suspendedAt`,NULL) AS `userSuspendedAt` FROM `user` LEFT JOIN `hierarchy` ON (`user`.`hierarchyId`=`hierarchy`.`id` AND IFNULL(`hierarchy`.`hierarchyStatus`,0)=1 AND `hierarchy`.`deletedAt` IS NULL) LEFT JOIN `hierarchy` AS `senior` ON (`hierarchy`.`seniorId`=`senior`.`id` AND IFNULL(`senior`.`hierarchyStatus`,0)=1 AND `senior`.`deletedAt` IS NULL) LEFT JOIN `department` ON (`hierarchy`.`departmentId`=`department`.`id` AND IFNULL(`department`.`departmentStatus`,0)=1 AND `department`.`deletedAt` IS NULL) LEFT JOIN `village` ON (`department`.`villageId`=`village`.`id` AND IFNULL(`village`.`villageStatus`,0)=1 AND `village`.`deletedAt` IS NULL) LEFT JOIN `city` ON ((`village`.`cityId`=`city`.`id` OR `department`.`cityId`=`city`.`id`) AND IFNULL(`city`.`cityStatus`,0)=1 AND `city`.`deletedAt` IS NULL) WHERE `user`.`id` = " . $id);
            $result = $query->getResult();
            if (!empty($result)) {
                $result = json_decode(json_encode($result), true);
                return $result[0];
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    /**
     * Checks if a user exists in the database based on the given username.
     *
     * @param string|null $userName
     * @return array|null
     */
    public function checkUserExists($userName = null) {
        if (is_null($userName)) {
            return null;
        } else {
            $query = $this->db->query("SELECT IFNULL(`user`.`id`,0) AS `id`, IFNULL(`user`.`hierarchyId`,0) AS `hierarchyId`, IFNULL(`hierarchy`.`positionTitle`,'') AS `hierarchyPositionTitle`, IFNULL(`hierarchy`.`seniorId`,0) AS `hierarchySeniorId`, IFNULL(`senior`.`positionTitle`,'') AS `seniorPositionTitle`, IFNULL(`hierarchy`.`departmentId`,0) AS `departmentId`, IFNULL(`department`.`departmentName`,'') AS `departmentName`, IFNULL(`village`.`id`,'') AS `villageId`, IFNULL(`village`.`villageName`,'') AS `villageName`, IFNULL(`city`.`id`,'') AS `cityId`, IFNULL(`city`.`cityName`,'') AS `cityName`, IFNULL(`user`.`name`,'') AS `userName`, IFNULL(`user`.`password`,'') AS `userPassword`, IFNULL(`user`.`contact`,0) AS `userContact`, IFNULL(`user`.`email`,'') AS `userEmail`, IFNULL(`user`.`gender`,0) AS `userGender`, (CASE WHEN (IFNULL(`user`.`gender`,0)=0) THEN ('NA') ELSE (CASE WHEN (IFNULL(`user`.`gender`,0)=1) THEN ('MALE') ELSE (CASE WHEN (IFNULL(`user`.`gender`,0)=2) THEN ('FEMALE') ELSE (CASE WHEN (IFNULL(`user`.`gender`,0)=0) THEN ('TRANSGENDER') ELSE ('NA') END) END) END) END) AS `userGenderName`, IFNULL(`user`.`dob`,CURRENT_DATE) AS `userDOB`, TIMESTAMPDIFF(YEAR,IFNULL(`user`.`dob`,CURRENT_DATE),CURRENT_DATE) AS `userAge`, CONCAT(TIMESTAMPDIFF(YEAR,IFNULL(`user`.`dob`,CURRENT_DATE),CURRENT_DATE),' y ',CEILING(TIMESTAMPDIFF(YEAR,IFNULL(`user`.`dob`,CURRENT_DATE),CURRENT_DATE)%12),' m ',CEILING(TIMESTAMPDIFF(YEAR,IFNULL(`user`.`dob`,CURRENT_DATE),CURRENT_DATE)%30.4375),' d') AS `exactUserFullAge`, IFNULL(`user`.`role`,0) AS `userRole`, (CASE WHEN (IFNULL(`user`.`role`,0)=0) THEN ('NA') ELSE (CASE WHEN (IFNULL(`user`.`role`,0)=10) THEN ('CUSTOMER') ELSE (CASE WHEN (IFNULL(`user`.`role`,0)=50) THEN ('OFFICER') ELSE (CASE WHEN (IFNULL(`user`.`role`,0)=80) THEN ('SUPER-ADMIN') ELSE ('NA') END) END) END) END) AS `userRoleName`, IFNULL(`user`.`picUrl`,'') AS `userPicUrl`, IFNULL(`user`.`createdAt`,CURRENT_TIMESTAMP) AS `userCreatedAt`, IFNULL(`user`.`suspendedAt`,NULL) AS `userSuspendedAt` FROM `user` LEFT JOIN `hierarchy` ON (`user`.`hierarchyId`=`hierarchy`.`id` AND IFNULL(`hierarchy`.`hierarchyStatus`,0)=1 AND `hierarchy`.`deletedAt` IS NULL) LEFT JOIN `hierarchy` AS `senior` ON (`hierarchy`.`seniorId`=`senior`.`id` AND IFNULL(`senior`.`hierarchyStatus`,0)=1 AND `senior`.`deletedAt` IS NULL) LEFT JOIN `department` ON (`hierarchy`.`departmentId`=`department`.`id` AND IFNULL(`department`.`departmentStatus`,0)=1 AND `department`.`deletedAt` IS NULL) LEFT JOIN `village` ON (`department`.`villageId`=`village`.`id` AND IFNULL(`village`.`villageStatus`,0)=1 AND `village`.`deletedAt` IS NULL) LEFT JOIN `city` ON ((`village`.`cityId`=`city`.`id` OR `department`.`cityId`=`city`.`id`) AND IFNULL(`city`.`cityStatus`,0)=1 AND `city`.`deletedAt` IS NULL) WHERE `user`.`name` = '" . $userName . "' OR `user`.`contact` = '" . $userName . "' OR `user`.`email` = '" . $userName . "' ORDER BY `user`.`id` DESC LIMIT 0,1");
            $result = $query->getResult();
            if (!empty($result)) {
                $result = json_decode(json_encode($result), true);
                return $result[0];
            } else {
                return null;
            }
        }
    }

    /**
     * Validates the login credentials for a user.
     *
     * @param string|null $userName
     * @param string|null $password
     * @return array|null
     */
    public function validateLogin($userName = null, $password = null) {
        if (is_null($userName)) {
            return null;
        } else {
            $query = $this->db->query("SELECT IFNULL(`user`.`id`,0) AS `id`, IFNULL(`user`.`hierarchyId`,0) AS `hierarchyId`, IFNULL(`hierarchy`.`positionTitle`,'') AS `hierarchyPositionTitle`, IFNULL(`hierarchy`.`seniorId`,0) AS `hierarchySeniorId`, IFNULL(`senior`.`positionTitle`,'') AS `seniorPositionTitle`, IFNULL(`hierarchy`.`departmentId`,0) AS `departmentId`, IFNULL(`department`.`departmentName`,'') AS `departmentName`, IFNULL(`village`.`id`,'') AS `villageId`, IFNULL(`village`.`villageName`,'') AS `villageName`, IFNULL(`city`.`id`,'') AS `cityId`, IFNULL(`city`.`cityName`,'') AS `cityName`, IFNULL(`user`.`name`,'') AS `userName`, IFNULL(`user`.`password`,'') AS `userPassword`, IFNULL(`user`.`contact`,0) AS `userContact`, IFNULL(`user`.`email`,'') AS `userEmail`, IFNULL(`user`.`gender`,0) AS `userGender`, (CASE WHEN (IFNULL(`user`.`gender`,0)=0) THEN ('NA') ELSE (CASE WHEN (IFNULL(`user`.`gender`,0)=1) THEN ('MALE') ELSE (CASE WHEN (IFNULL(`user`.`gender`,0)=2) THEN ('FEMALE') ELSE (CASE WHEN (IFNULL(`user`.`gender`,0)=0) THEN ('TRANSGENDER') ELSE ('NA') END) END) END) END) AS `userGenderName`, IFNULL(`user`.`dob`,CURRENT_DATE) AS `userDOB`, TIMESTAMPDIFF(YEAR,IFNULL(`user`.`dob`,CURRENT_DATE),CURRENT_DATE) AS `userAge`, CONCAT(TIMESTAMPDIFF(YEAR,IFNULL(`user`.`dob`,CURRENT_DATE),CURRENT_DATE),' y ',CEILING(TIMESTAMPDIFF(YEAR,IFNULL(`user`.`dob`,CURRENT_DATE),CURRENT_DATE)%12),' m ',CEILING(TIMESTAMPDIFF(YEAR,IFNULL(`user`.`dob`,CURRENT_DATE),CURRENT_DATE)%30.4375),' d') AS `exactUserFullAge`, IFNULL(`user`.`role`,0) AS `userRole`, (CASE WHEN (IFNULL(`user`.`role`,0)=0) THEN ('NA') ELSE (CASE WHEN (IFNULL(`user`.`role`,0)=10) THEN ('CUSTOMER') ELSE (CASE WHEN (IFNULL(`user`.`role`,0)=50) THEN ('OFFICER') ELSE (CASE WHEN (IFNULL(`user`.`role`,0)=80) THEN ('SUPER-ADMIN') ELSE ('NA') END) END) END) END) AS `userRoleName`, IFNULL(`user`.`picUrl`,'') AS `userPicUrl`, IFNULL(`user`.`createdAt`,CURRENT_TIMESTAMP) AS `userCreatedAt`, IFNULL(`user`.`suspendedAt`,NULL) AS `userSuspendedAt` FROM `user` LEFT JOIN `hierarchy` ON (`user`.`hierarchyId`=`hierarchy`.`id` AND IFNULL(`hierarchy`.`hierarchyStatus`,0)=1 AND `hierarchy`.`deletedAt` IS NULL) LEFT JOIN `hierarchy` AS `senior` ON (`hierarchy`.`seniorId`=`senior`.`id` AND IFNULL(`senior`.`hierarchyStatus`,0)=1 AND `senior`.`deletedAt` IS NULL) LEFT JOIN `department` ON (`hierarchy`.`departmentId`=`department`.`id` AND IFNULL(`department`.`departmentStatus`,0)=1 AND `department`.`deletedAt` IS NULL) LEFT JOIN `village` ON (`department`.`villageId`=`village`.`id` AND IFNULL(`village`.`villageStatus`,0)=1 AND `village`.`deletedAt` IS NULL) LEFT JOIN `city` ON ((`village`.`cityId`=`city`.`id` OR `department`.`cityId`=`city`.`id`) AND IFNULL(`city`.`cityStatus`,0)=1 AND `city`.`deletedAt` IS NULL) WHERE `user`.`name` = '" . $userName . "' OR `user`.`contact` = '" . $userName . "' OR `user`.`email` = '" . $userName . "' ORDER BY `user`.`id` DESC LIMIT 0,1");
            $result = $query->getResult();
            if (!empty($result)) {
                $result = json_decode(json_encode($result), true);
                return ($result[0]['userPassword'] == $password) ? $result[0] : null;
            } else {
                return null;
            }
        }
    }

    /**
     * Get the value of a specific field from an object.
     *
     * @param mixed|null $object The object to retrieve the field from.
     * @param string|null $field The name of the field to retrieve.
     * @return mixed|null The value of the field, or null if the field is not found or empty.
     */
    public function getObjectField($object = null, $field = null) {
        if (is_null($object)) {
            return null;
        } else if (!isset($object[$field])) {
            return null;
        } else if (is_null($object[$field])) {
            return null;
        } else if (strlen(trim($object[$field])) <= 0) {
            return null;
        } else {
            return $object[$field];
        }
    }

}
