<?php

namespace app\Models;

use CodeIgniter\Model;

class DashboardModel extends Model {

    /**
     * Get the birth forms for a given hierarchy ID.
     *
     * @param int $hierarchyId
     * @return array|null
     */
    public function getBirthForms($hierarchyId = 0) {
        if ($hierarchyId <= 0) {
            return null;
        } else {
            $query = $this->db->query("SELECT `birth`.*, IFNULL(`actionStatus`.`statusName`,'PENDING') AS `actionStatusName`, `stageHierarchyActionMap`.`id` AS `currentShamId`, `stageHierarchyActionMap`.`stageId`, `stageHierarchyActionMap`.`hierarchyId`, `stageHierarchyActionMap`.`actionIds`, `stageHierarchyActionMap`.`statusTitle` AS `shamStatusTitle`, `stageHierarchyActionMap`.`seniorEscalationAt`, (`birth`.`createdAt` + INTERVAL `stageHierarchyActionMap`.`seniorEscalationAt` DAY) AS `seniorEscalationDate`, `stageHierarchyActionMap`.`totalDuration`, (`birth`.`createdAt` + INTERVAL `stageHierarchyActionMap`.`totalDuration` DAY) AS `totalDurationDate`, `stageHierarchyActionMap`.`priority` AS `currentShamPriority`, IFNULL((SELECT `stageHierarchyActionMapNext`.`id` FROM `stageHierarchyActionMap` AS `stageHierarchyActionMapNext` WHERE `stageHierarchyActionMapNext`.`stageId`=`stageHierarchyActionMap`.`stageId` AND IFNULL(`stageHierarchyActionMapNext`.`priority`,0)>IFNULL(`stageHierarchyActionMap`.`priority`,0) AND IFNULL(`stageHierarchyActionMapNext`.`shaMapStatus`,0)=1 AND `stageHierarchyActionMapNext`.`deletedAt` IS NULL GROUP BY `stageHierarchyActionMapNext`.`id` ORDER BY `stageHierarchyActionMapNext`.`id` ASC LIMIT 0,1),0) AS `nextShamId`, `stage`.`projectId`, `stage`.`stageName`, `stage`.`stagePriority`, `stage`.`stageCode`, `project`.`projectName`, `project`.`projectCode`, `hierarchy`.`departmentId`, `hierarchy`.`seniorId`, `hierarchy`.`positionTitle`, `department`.`cityId`, `city`.`cityName`, `department`.`villageId`, `village`.`villageName`, `department`.`departmentName` FROM `birth` LEFT JOIN `action` AS `actionStatus` ON `birth`.`status`=`actionStatus`.`id` LEFT JOIN `stageHierarchyActionMap` ON `birth`.`shamId`=`stageHierarchyActionMap`.`id` LEFT JOIN `stageHierarchyActionMap` AS `soughtStageHierarchyActionMap` ON (IFNULL(`birth`.`soughtReport`,0)=1 AND FIND_IN_SET(IFNULL(`soughtStageHierarchyActionMap`.`id`,'0'),IFNULL(`stageHierarchyActionMap`.`soughtShamIds`,'1'))) LEFT JOIN `stage` ON `stageHierarchyActionMap`.`stageId`=`stage`.`id` LEFT JOIN `project` ON `stage`.`projectId`=`project`.`id` LEFT JOIN `hierarchy` ON `stageHierarchyActionMap`.`hierarchyId`=`hierarchy`.`id` LEFT JOIN `department` ON `hierarchy`.`departmentId`=`department`.`id` LEFT JOIN `village` ON `birth`.`villageId`=`village`.`id` LEFT JOIN `city` ON `department`.`cityId`=`city`.`id` WHERE (`stageHierarchyActionMap`.`hierarchyId` = " . $hierarchyId . " OR `soughtStageHierarchyActionMap`.`hierarchyId` = " . $hierarchyId . ") GROUP BY `birth`.`id` ORDER BY `birth`.`createdAt` ASC");
            $result = $query->getResult();
            if (!empty($result)) {
                return json_decode(json_encode($result), true);
            } else {
                return null;
            }
        }
    }

    /**
     * Get the first sham ID for a given stage ID.
     *
     * @param int $stageId
     * @return int
     */
    public function getFirstShamId($stageId = 0) {
        if ($stageId <= 0) {
            return 0;
        } else {
            $query = $this->db->query("SELECT IFNULL(`stageHierarchyActionMap`.`id`,0) AS `shamId` FROM `stageHierarchyActionMap` WHERE `stageHierarchyActionMap`.`deletedAt` IS NULL AND `stageHierarchyActionMap`.`stageId`=" . $stageId . " AND `stageHierarchyActionMap`.`shaMapStatus`=1 ORDER BY `stageHierarchyActionMap`.`priority` ASC LIMIT 0,1");
            $result = $query->getResult();
            if (!empty($result)) {
                return (((json_decode(json_encode($result), true))[0])['shamId']);
            } else {
                return 0;
            }
        }
    }

    /**
     * Get the birth forms for a specific user and stage.
     *
     * @param int $userId
     * @param int $stageId
     * @return array|null
     */
    public function getUserBirthForms($userId = 0, $stageId = 0) {
        $query;
        if ($userId <= 0) {
            return null;
        } else {
            if ($stageId <= 0) {
                $query = $this->db->query("SELECT `birth`.*, IFNULL(`actionStatus`.`statusName`,'PENDING') AS `actionStatusName`, `stageHierarchyActionMap`.`id` AS `currentShamId`, `stageHierarchyActionMap`.`stageId`, `stageHierarchyActionMap`.`hierarchyId`, `stageHierarchyActionMap`.`actionIds`, `stageHierarchyActionMap`.`statusTitle` AS `shamStatusTitle`, `stageHierarchyActionMap`.`seniorEscalationAt`, (`birth`.`createdAt` + INTERVAL `stageHierarchyActionMap`.`seniorEscalationAt` DAY) AS `seniorEscalationDate`, `stageHierarchyActionMap`.`totalDuration`, (`birth`.`createdAt` + INTERVAL `stageHierarchyActionMap`.`totalDuration` DAY) AS `totalDurationDate`, `stageHierarchyActionMap`.`priority` AS `currentShamPriority`, IFNULL((SELECT `stageHierarchyActionMapNext`.`id` FROM `stageHierarchyActionMap` AS `stageHierarchyActionMapNext` WHERE `stageHierarchyActionMapNext`.`stageId`=`stageHierarchyActionMap`.`stageId` AND IFNULL(`stageHierarchyActionMapNext`.`priority`,0)>IFNULL(`stageHierarchyActionMap`.`priority`,0) AND IFNULL(`stageHierarchyActionMapNext`.`shaMapStatus`,0)=1 AND `stageHierarchyActionMapNext`.`deletedAt` IS NULL GROUP BY `stageHierarchyActionMapNext`.`id` ORDER BY `stageHierarchyActionMapNext`.`id` ASC LIMIT 0,1),0) AS `nextShamId`, `stage`.`projectId`, `stage`.`stageName`, `stage`.`stagePriority`, `stage`.`stageCode`, `project`.`projectName`, `project`.`projectCode`, `hierarchy`.`departmentId`, `hierarchy`.`seniorId`, `hierarchy`.`positionTitle`, `department`.`cityId`, `city`.`cityName`, `department`.`villageId`, `village`.`villageName`, `department`.`departmentName` FROM `birth` LEFT JOIN `action` AS `actionStatus` ON `birth`.`status`=`actionStatus`.`id` LEFT JOIN `stageHierarchyActionMap` ON `birth`.`shamId`=`stageHierarchyActionMap`.`id` LEFT JOIN `stage` ON `stageHierarchyActionMap`.`stageId`=`stage`.`id` LEFT JOIN `project` ON `stage`.`projectId`=`project`.`id` LEFT JOIN `hierarchy` ON `stageHierarchyActionMap`.`hierarchyId`=`hierarchy`.`id` LEFT JOIN `department` ON `hierarchy`.`departmentId`=`department`.`id` LEFT JOIN `village` ON `birth`.`villageId`=`village`.`id` LEFT JOIN `city` ON `department`.`cityId`=`city`.`id` WHERE `birth`.`applicantUserId` = " . $userId . " GROUP BY `birth`.`id` ORDER BY `birth`.`createdAt` ASC");
            } else {
                $query = $this->db->query("SELECT `birth`.*, IFNULL(`actionStatus`.`statusName`,'PENDING') AS `actionStatusName`, `stageHierarchyActionMap`.`id` AS `currentShamId`, `stageHierarchyActionMap`.`stageId`, `stageHierarchyActionMap`.`hierarchyId`, `stageHierarchyActionMap`.`actionIds`, `stageHierarchyActionMap`.`statusTitle` AS `shamStatusTitle`, `stageHierarchyActionMap`.`seniorEscalationAt`, (`birth`.`createdAt` + INTERVAL `stageHierarchyActionMap`.`seniorEscalationAt` DAY) AS `seniorEscalationDate`, `stageHierarchyActionMap`.`totalDuration`, (`birth`.`createdAt` + INTERVAL `stageHierarchyActionMap`.`totalDuration` DAY) AS `totalDurationDate`, `stageHierarchyActionMap`.`priority` AS `currentShamPriority`, IFNULL((SELECT `stageHierarchyActionMapNext`.`id` FROM `stageHierarchyActionMap` AS `stageHierarchyActionMapNext` WHERE `stageHierarchyActionMapNext`.`stageId`=`stageHierarchyActionMap`.`stageId` AND IFNULL(`stageHierarchyActionMapNext`.`priority`,0)>IFNULL(`stageHierarchyActionMap`.`priority`,0) AND IFNULL(`stageHierarchyActionMapNext`.`shaMapStatus`,0)=1 AND `stageHierarchyActionMapNext`.`deletedAt` IS NULL GROUP BY `stageHierarchyActionMapNext`.`id` ORDER BY `stageHierarchyActionMapNext`.`id` ASC LIMIT 0,1),0) AS `nextShamId`, `stage`.`projectId`, `stage`.`stageName`, `stage`.`stagePriority`, `stage`.`stageCode`, `project`.`projectName`, `project`.`projectCode`, `hierarchy`.`departmentId`, `hierarchy`.`seniorId`, `hierarchy`.`positionTitle`, `department`.`cityId`, `city`.`cityName`, `department`.`villageId`, `village`.`villageName`, `department`.`departmentName` FROM `birth` LEFT JOIN `action` AS `actionStatus` ON `birth`.`status`=`actionStatus`.`id` LEFT JOIN `stageHierarchyActionMap` ON `birth`.`shamId`=`stageHierarchyActionMap`.`id` LEFT JOIN `stage` ON `stageHierarchyActionMap`.`stageId`=`stage`.`id` LEFT JOIN `project` ON `stage`.`projectId`=`project`.`id` LEFT JOIN `hierarchy` ON `stageHierarchyActionMap`.`hierarchyId`=`hierarchy`.`id` LEFT JOIN `department` ON `hierarchy`.`departmentId`=`department`.`id` LEFT JOIN `village` ON `birth`.`villageId`=`village`.`id` LEFT JOIN `city` ON `department`.`cityId`=`city`.`id` WHERE `birth`.`applicantUserId` = " . $userId . " AND `birth`.`stageId` = " . $stageId . " GROUP BY `birth`.`id` ORDER BY `birth`.`createdAt` ASC");
            }
            $result = $query->getResult();
            if (!empty($result)) {
                return json_decode(json_encode($result), true);
            } else {
                return null;
            }
        }
    }

    /**
     * Get the birth customer chat open for a given birth ID.
     *
     * @param int $birthId
     * @return array|null
     */
    public function getBirthCustomerChatOpen($birthId = 0) {
        if ($birthId <= 0) {
            return [];
        } else {
            $query = $this->db->query("SELECT IFNULL(`query`.`id`,0) AS `id`, `birth`.`id` AS `birthId`, `birth`.`shamId` AS `birthShamId`, `birth`.`applicantUserId` AS `birthApplicantUserId`, `stage`.`projectId`, `project`.`projectCode`, `project`.`projectName`, IFNULL(`query`.`stageId`,4) AS `stageId`, `stage`.`stageCode`, `stage`.`stageName`, `query`.`fromUserId`, `fromUser`.`name` AS `fromUserName`, `fromUser`.`role` AS `fromUserRole`, IFNULL(`fromUser`.`hierarchyId`,0) AS `fromUserHierarchyId`, `fromUserHierarchy`.`positionTitle` AS `fromUserPositionTitle`, `fromUserHierarchy`.`departmentId` AS `fromUserDepartmentId`, `fromUserDepartment`.`departmentName` AS `fromUserDepartmentName`, IFNULL(`query`.`toUserId`,`birth`.`applicantUserId`) AS `toUserId`, `toUser`.`name` AS `toUserName`, `toUser`.`role` AS `toUserRole`, `toUser`.`hierarchyId` AS `toUserHierarchyId`, `toUserHierarchy`.`positionTitle` AS `toUserPositionTitle`, `toUserHierarchy`.`departmentId` AS `toUserDepartmentId`, `toUserDepartment`.`departmentName` AS `toUserDepartmentName`, `query`.`remarkComment`, IFNULL(`query`.`documentUrl`,'') AS `documentUrl`, IFNULL(`query`.`queryStatus`,0) AS `queryStatus`, DATE_FORMAT(`query`.`createdAt`, '%a %D %M %Y %h:%i:%s %p') AS `dateTime` FROM `birth` LEFT JOIN `query` ON (`birth`.`id`=`query`.`formRefId` AND IFNULL(`query`.`queryType`,0)=20 AND `query`.`stageId`=4 AND `query`.`deletedAt` IS NULL) LEFT JOIN `user` AS `fromUser` ON `query`.`fromUserId`=`fromUser`.`id` LEFT JOIN `hierarchy` AS `fromUserHierarchy` ON `fromUser`.`hierarchyId`=`fromUserHierarchy`.`id` LEFT JOIN `department` AS `fromUserDepartment` ON `fromUserHierarchy`.`departmentId`=`fromUserDepartment`.`id` LEFT JOIN `user` AS `toUser` ON `query`.`toUserId`=`toUser`.`id` LEFT JOIN `hierarchy` AS `toUserHierarchy` ON `toUser`.`hierarchyId`=`toUserHierarchy`.`id` LEFT JOIN `department` AS `toUserDepartment` ON `toUserHierarchy`.`departmentId`=`toUserDepartment`.`id` LEFT JOIN `stage` ON `query`.`stageId`=`stage`.`id` LEFT JOIN `project` ON `stage`.`projectId`=`project`.`id` WHERE `birth`.`id`=" . $birthId . " GROUP BY `query`.`id` ORDER BY `query`.`id` DESC LIMIT 0,99");
            $result = $query->getResult();
            if (!empty($result)) {
                return json_decode(json_encode(array_reverse($result)), true);
            } else {
                return null;
            }
        }
    }

    /**
     * Get the payment heads for a given stage ID.
     *
     * @param int $stageId
     * @return array|null
     */
    public function getPaymentHeads($stageId = 0) {
        if ($stageId <= 0) {
            return [];
        } else {
            $query = $this->db->query("SELECT `paymentHead`.* FROM `paymentHead` WHERE `paymentHead`.`stageId`=" . $stageId . " GROUP BY `paymentHead`.`id` ORDER BY `paymentHead`.`id` DESC");
            $result = $query->getResult();
            if (!empty($result)) {
                return json_decode(json_encode(array_reverse($result)), true);
            } else {
                return null;
            }
        }
    }

    /**
     * Get the open chat for a given stage, birth, user, and query type.
     *
     * @param int $stageId
     * @param int $birthId
     * @param int $myUserId
     * @param int $queryType
     * @return array|null
     */
    public function getChatOpen($stageId = 0, $birthId = 0, $myUserId = 0, $queryType = 0) {
        if ($stageId <= 0 || $birthId <= 0 || $myUserId <= 0 || $queryType <= 0) {
            return [];
        } else {
            $query = $this->db->query("SELECT IFNULL(`query`.`id`,0) AS `id`, `birth`.`id` AS `birthId`, `birth`.`shamId` AS `birthShamId`, `birth`.`applicantUserId` AS `birthApplicantUserId`, `stage`.`projectId`, `project`.`projectCode`, `project`.`projectName`, IFNULL(`query`.`stageId`," . $stageId . ") AS `stageId`, `stage`.`stageCode`, `stage`.`stageName`, `query`.`fromUserId`, `fromUser`.`name` AS `fromUserName`, `fromUser`.`role` AS `fromUserRole`, IFNULL(`fromUser`.`hierarchyId`,0) AS `fromUserHierarchyId`, `fromUserHierarchy`.`positionTitle` AS `fromUserPositionTitle`, `fromUserHierarchy`.`departmentId` AS `fromUserDepartmentId`, `fromUserDepartment`.`departmentName` AS `fromUserDepartmentName`, IFNULL(`query`.`toUserId`,`birth`.`applicantUserId`) AS `toUserId`, `toUser`.`name` AS `toUserName`, IFNULL(`toUser`.`role`,0) AS `toUserRole`, `toUser`.`hierarchyId` AS `toUserHierarchyId`, `toUserHierarchy`.`positionTitle` AS `toUserPositionTitle`, `toUserHierarchy`.`departmentId` AS `toUserDepartmentId`, `toUserDepartment`.`departmentName` AS `toUserDepartmentName`, `query`.`remarkComment`, IFNULL(`query`.`documentUrl`,'') AS `documentUrl`, IFNULL(`query`.`queryStatus`,0) AS `queryStatus`, DATE_FORMAT(`query`.`createdAt`, '%d %b %h:%i %p') AS `dateTime` FROM `birth` LEFT JOIN `query` ON (`birth`.`id`=`query`.`formRefId` AND IFNULL(`query`.`queryType`,0)=" . $queryType . " AND `query`.`stageId`=" . $stageId . " AND `query`.`deletedAt` IS NULL) LEFT JOIN `user` AS `fromUser` ON `query`.`fromUserId`=`fromUser`.`id` LEFT JOIN `hierarchy` AS `fromUserHierarchy` ON `fromUser`.`hierarchyId`=`fromUserHierarchy`.`id` LEFT JOIN `department` AS `fromUserDepartment` ON `fromUserHierarchy`.`departmentId`=`fromUserDepartment`.`id` LEFT JOIN `user` AS `toUser` ON `query`.`toUserId`=`toUser`.`id` LEFT JOIN `hierarchy` AS `toUserHierarchy` ON `toUser`.`hierarchyId`=`toUserHierarchy`.`id` LEFT JOIN `department` AS `toUserDepartment` ON `toUserHierarchy`.`departmentId`=`toUserDepartment`.`id` LEFT JOIN `stage` ON `query`.`stageId`=`stage`.`id` LEFT JOIN `project` ON `stage`.`projectId`=`project`.`id` WHERE `birth`.`id`=" . $birthId . " GROUP BY `query`.`id` ORDER BY `query`.`id` DESC");
            $result = $query->getResult();
            if (!empty($result)) {
                return json_decode(json_encode(array_reverse($result)), true);
            } else {
                return null;
            }
        }
    }

    /**
     * Add a new query to the database.
     *
     * @param array $data
     * @return int The ID of the inserted query, or 0 if the insertion failed or no data was provided.
     */
    public function addQuery($data = array()) {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('query');
            if ($builder->insert($data)) {
                return $this->db->insertID();
            } else {
                return 0;
            }
        }
    }

    /**
     * Add payments to the database.
     *
     * @param array $data
     * @return int The ID of the inserted payment or 0 if no data is provided or insertion fails.
     */
    public function addPayments($data = array()) {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('payment');
            if ($builder->insert($data)) {
                return $this->db->insertID();
            } else {
                return 0;
            }
        }
    }

    /**
     * Get the birth form actions based on the given birth ID and next sham ID.
     *
     * @param int $birthId
     * @param int $nextShamId
     * @return array|null
     */
    public function getBirthFormActions($birthId = 0, $nextShamId = 0) {
        if ($birthId <= 0 && $nextShamId <= 0) {
            return [];
        } else {
            $query = $this->db->query("SELECT '" . $nextShamId . "' AS `nextShamId`, '" . $birthId . "' AS `birthId`, IFNULL(`birth`.`shamId`,0) AS `currentShamId`, IFNULL(`stageHierarchyActionMapSenior`.`id`,0) AS `seniorShamId`, IFNULL(`stageHierarchyActionMapJunior`.`id`,0) AS `juniorShamId`, `action`.`id`, `action`.`actionName`, `senior`.`id` AS `seniorId`, `seniorDepartment`.`departmentName` AS `seniorDepartmentName`, IFNULL(`senior`.`positionTitle`,'Senior') AS `seniorPositionTitle`, `hierarchy`.`id` AS `hierarchyId`, `department`.`departmentName`, `hierarchy`.`positionTitle`, IFNULL(`junior`.`id`,0) AS `juniorId`, `juniorDepartment`.`departmentName` AS `juniorDepartmentName`, IFNULL(`junior`.`positionTitle`,'Junior') AS `juniorPositionTitle` FROM `stageHierarchyActionMap` LEFT JOIN `hierarchy` ON `stageHierarchyActionMap`.`hierarchyId`=`hierarchy`.`id` LEFT JOIN `department` ON `hierarchy`.`departmentId`=`department`.`id` LEFT JOIN `hierarchy` AS `senior` ON (`hierarchy`.`seniorId`=`senior`.`id` AND IFNULL(`senior`.`hierarchyStatus`,0)=1 AND `senior`.`deletedAt` IS NULL) LEFT JOIN `department` AS `seniorDepartment` ON `senior`.`departmentId`=`seniorDepartment`.`id` LEFT JOIN `stageHierarchyActionMap` AS `stageHierarchyActionMapSenior` ON (`senior`.`id`=`stageHierarchyActionMapSenior`.`hierarchyId` AND `stageHierarchyActionMap`.`stageId`=`stageHierarchyActionMapSenior`.`stageId` AND `stageHierarchyActionMapSenior`.`priority`>=`stageHierarchyActionMap`.`priority` AND `stageHierarchyActionMapSenior`.`deletedAt` IS NULL AND IFNULL(`stageHierarchyActionMapSenior`.`shaMapStatus`,0)=1) LEFT JOIN `hierarchy` AS `junior` ON (`hierarchy`.`id`=`junior`.`seniorId` AND IFNULL(`junior`.`hierarchyStatus`,0)=1 AND `junior`.`deletedAt` IS NULL) LEFT JOIN `department` AS `juniorDepartment` ON `junior`.`departmentId`=`juniorDepartment`.`id` LEFT JOIN `stageHierarchyActionMap` AS `stageHierarchyActionMapJunior` ON (`junior`.`id`=`stageHierarchyActionMapJunior`.`hierarchyId` AND `stageHierarchyActionMapJunior`.`priority`<=`stageHierarchyActionMap`.`priority` AND `stageHierarchyActionMapJunior`.`stageId`=`stageHierarchyActionMap`.`stageId` AND IFNULL(`stageHierarchyActionMapJunior`.`shaMapStatus`,0)=1 AND `stageHierarchyActionMapJunior`.`deletedAt` IS NULL) LEFT JOIN `action` ON FIND_IN_SET(`action`.`id`,`stageHierarchyActionMap`.`actionIds`) LEFT JOIN `birth` ON `stageHierarchyActionMap`.`id`=`birth`.`shamId` WHERE `birth`.`id` = " . $birthId . " GROUP BY `action`.`id` ORDER BY `action`.`id` ASC");
            $result = $query->getResult();
            if (!empty($result)) {
                return json_decode(json_encode($result), true);
            } else {
                return null;
            }
        }
    }

    /**
     * Add a new birth record to the database.
     *
     * @param array $data The data for the birth record.
     * @return int The ID of the newly inserted birth record, or 0 if the insertion failed.
     */
    public function addBirth($data = array()) {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('birth');
            if ($builder->insert($data)) {
                return $this->db->insertID();
            } else {
                return 0;
            }
        }
    }

    /**
     * Get the birth information for the given birth ID.
     *
     * @param int $birthId
     * @return array|null
     */
    public function getBirth($birthId = 0) {
        if ($birthId <= 0) {
            return null;
        } else {
            $query = $this->db->query("SELECT `birth`.*, IFNULL(`village`.`cityId`,0) AS `cityId`, IFNULL(`city`.`cityName`,'') AS `cityName`, IFNULL(`village`.`villageName`,'') AS `villageName` FROM `birth` LEFT JOIN `village` ON `birth`.`villageId`=`village`.`id` LEFT JOIN `city` ON `village`.`cityId`=`city`.`id` WHERE `birth`.`id` = " . $birthId . " GROUP BY `birth`.`id` ORDER BY `birth`.`id` DESC LIMIT 0,1");
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result[0]), true));
            } else {
                return null;
            }
        }
    }

    /**
     * Update the birth record with the given birth ID and data.
     *
     * @param int $birthId
     * @param array $data
     * @return int The number of affected rows
     */
    public function updateBirth($birthId = 0, $data = array()) {
        if ($birthId <= 0 || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('birth');
            $res = $builder->update($data, (' id = ' . $birthId));
            if ($res) {
                $affectedRows = $this->db->affectedRows();
                return $affectedRows;
            } else {
                return 0;
            }
        }
    }

}
