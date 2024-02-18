<?php

namespace app\Models;

use CodeIgniter\Model;

class HandleModel extends Model
{

    /**
     * Create a new handle in the database.
     *
     * @param array $data
     * @return int The ID of the newly created handle, or 0 if creation failed.
     */
    public function createHandle($data = array())
    {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('handle');
            if ($builder->insert($data)) {
                return $this->db->insertID();
            } else {
                return 0;
            }
        }
    }

    /**
     * Update the handle with the given data and handle ID.
     *
     * @param array $data
     * @param int $handleId
     * @return int The number of affected rows
     */
    public function updateHandle($data = array(), $handleId = 0)
    {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('handle');
            $res = $builder->update($data, (' id = ' . $handleId));
            if ($res) {
                $affectedRows = $this->db->affectedRows();
                return $affectedRows;
            } else {
                return 0;
            }
        }
    }

    /**
     * Get all the handles from the database.
     *
     * @return array
     */
    public function getAll()
    {
        $query = $this->db->query("SELECT IFNULL(`handle`.`id`,0) AS `id`, IFNULL(`handle`.`handleName`,'') AS `name`, (CASE WHEN (IFNULL(`handle`.`verifiedAt`,CURRENT_TIMESTAMP)<CURRENT_TIMESTAMP) THEN (0) ELSE (1) END) AS `isVerified.code`, (CASE WHEN (IFNULL(`handle`.`verifiedAt`,CURRENT_TIMESTAMP)<CURRENT_TIMESTAMP) THEN ('VERIFIED') ELSE ('UNVERIFIED') END) AS `isVerified.name`, IFNULL(`handle`.`verifiedAt`,'')  AS `isVerified.dateTime`, IFNULL(`handle`.`handleStatus`,0) AS `status.code`, (CASE WHEN (IFNULL(`handle`.`handleStatus`,0)=0) THEN ('INACTIVE') ELSE ('ACTIVE') END) AS `status.name`, IFNULL(`platform`.`id`,0) AS `platform.id`, IFNULL(`platform`.`platformCode`,'') AS `platform.code`, IFNULL(`platform`.`platformName`,'') AS `platform.name`, IFNULL(`platform`.`platformLogoUrl`,0) AS `platform.logo`, IFNULL(`platform`.`platformPriority`,0) AS `platform.priority`, IFNULL(`user`.`id`,0) AS `user.id`, IFNULL(`user`.`userName`,'') AS `user.name` FROM `handle` LEFT JOIN `platform` ON `handle`.`platformId`=`platform`.`id` LEFT JOIN `user` ON `handle`.`userId`=`user`.`id` WHERE `handle`.`deletedAt` IS NULL AND `platform`.`deletedAt` IS NULL AND `user`.`deletedAt` IS NULL GROUP BY `handle`.`id` ORDER BY `handle`.`id` DESC");
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }

    /**
     * Get the handle information for the given ID.
     *
     * @param int $id
     * @return array
     */
    public function getOne($id = 0)
    {
        if ($id <= 0) {
            return [];
        } else {
            $query = $this->db->query("SELECT IFNULL(`handle`.`id`,0) AS `id`, IFNULL(`handle`.`handleName`,'') AS `name`, (CASE WHEN (IFNULL(`handle`.`verifiedAt`,CURRENT_TIMESTAMP)<CURRENT_TIMESTAMP) THEN (0) ELSE (1) END) AS `isVerified.code`, (CASE WHEN (IFNULL(`handle`.`verifiedAt`,CURRENT_TIMESTAMP)<CURRENT_TIMESTAMP) THEN ('VERIFIED') ELSE ('UNVERIFIED') END) AS `isVerified.name`, IFNULL(`handle`.`verifiedAt`,'')  AS `isVerified.dateTime`, IFNULL(`handle`.`handleStatus`,0) AS `status.code`, (CASE WHEN (IFNULL(`handle`.`handleStatus`,0)=0) THEN ('INACTIVE') ELSE ('ACTIVE') END) AS `status.name`, IFNULL(`platform`.`id`,0) AS `platform.id`, IFNULL(`platform`.`platformCode`,'') AS `platform.code`, IFNULL(`platform`.`platformName`,'') AS `platform.name`, IFNULL(`platform`.`platformLogoUrl`,0) AS `platform.logo`, IFNULL(`platform`.`platformPriority`,0) AS `platform.priority`, IFNULL(`user`.`id`,0) AS `user.id`, IFNULL(`user`.`userName`,'') AS `user.name` FROM `handle` LEFT JOIN `platform` ON `handle`.`platformId`=`platform`.`id` LEFT JOIN `user` ON `handle`.`userId`=`user`.`id` WHERE `handle`.`deletedAt` IS NULL AND `platform`.`deletedAt` IS NULL AND `user`.`deletedAt` IS NULL AND `handle`.`id`=" . $id . " GROUP BY `handle`.`id`");
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result), true));
            } else {
                return [];
            }
        }
    }

    /**
     * Get all handles by user ID.
     *
     * @param int $userId
     * @return array
     */
    public function getAllByUser($userId = 0)
    {
        if ($userId <= 0) {
            return [];
        } else {
            $query = $this->db->query("SELECT IFNULL(`handle`.`id`,0) AS `id`, IFNULL(`handle`.`handleName`,'') AS `name`, (CASE WHEN (IFNULL(`handle`.`verifiedAt`,CURRENT_TIMESTAMP)<CURRENT_TIMESTAMP) THEN (0) ELSE (1) END) AS `isVerified.code`, (CASE WHEN (IFNULL(`handle`.`verifiedAt`,CURRENT_TIMESTAMP)<CURRENT_TIMESTAMP) THEN ('VERIFIED') ELSE ('UNVERIFIED') END) AS `isVerified.name`, IFNULL(`handle`.`verifiedAt`,'')  AS `isVerified.dateTime`, IFNULL(`handle`.`handleStatus`,0) AS `status.code`, (CASE WHEN (IFNULL(`handle`.`handleStatus`,0)=0) THEN ('INACTIVE') ELSE ('ACTIVE') END) AS `status.name`, IFNULL(`platform`.`id`,0) AS `platform.id`, IFNULL(`platform`.`platformCode`,'') AS `platform.code`, IFNULL(`platform`.`platformName`,'') AS `platform.name`, IFNULL(`platform`.`platformLogoUrl`,0) AS `platform.logo`, IFNULL(`platform`.`platformPriority`,0) AS `platform.priority`, IFNULL(`user`.`id`,0) AS `user.id`, IFNULL(`user`.`userName`,'') AS `user.name` FROM `handle` LEFT JOIN `platform` ON `handle`.`platformId`=`platform`.`id` LEFT JOIN `user` ON `handle`.`userId`=`user`.`id` WHERE `handle`.`deletedAt` IS NULL AND `platform`.`deletedAt` IS NULL AND `user`.`deletedAt` IS NULL AND `user`.`id`=" . $userId . " GROUP BY `handle`.`id` ORDER BY `handle`.`id` DESC");
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result), true));
            } else {
                return [];
            }
        }
    }

    /**
     * Get all handles by user ID and platform ID.
     *
     * @param int $userId
     * @param int $platformId
     * @return array
     */
    public function getAllByUserAndPlatform($userId = 0, $platformId = 0)
    {
        if ($userId <= 0 || $platformId <= 0) {
            return [];
        } else {
            $query = $this->db->query("SELECT IFNULL(`handle`.`id`,0) AS `id`, IFNULL(`handle`.`handleName`,'') AS `name`, (CASE WHEN (IFNULL(`handle`.`verifiedAt`,CURRENT_TIMESTAMP)<CURRENT_TIMESTAMP) THEN (0) ELSE (1) END) AS `isVerified.code`, (CASE WHEN (IFNULL(`handle`.`verifiedAt`,CURRENT_TIMESTAMP)<CURRENT_TIMESTAMP) THEN ('VERIFIED') ELSE ('UNVERIFIED') END) AS `isVerified.name`, IFNULL(`handle`.`verifiedAt`,'')  AS `isVerified.dateTime`, IFNULL(`handle`.`handleStatus`,0) AS `status.code`, (CASE WHEN (IFNULL(`handle`.`handleStatus`,0)=0) THEN ('INACTIVE') ELSE ('ACTIVE') END) AS `status.name`, IFNULL(`platform`.`id`,0) AS `platform.id`, IFNULL(`platform`.`platformCode`,'') AS `platform.code`, IFNULL(`platform`.`platformName`,'') AS `platform.name`, IFNULL(`platform`.`platformLogoUrl`,0) AS `platform.logo`, IFNULL(`platform`.`platformPriority`,0) AS `platform.priority`, IFNULL(`user`.`id`,0) AS `user.id`, IFNULL(`user`.`userName`,'') AS `user.name` FROM `handle` LEFT JOIN `platform` ON `handle`.`platformId`=`platform`.`id` LEFT JOIN `user` ON `handle`.`userId`=`user`.`id` WHERE `handle`.`deletedAt` IS NULL AND `platform`.`deletedAt` IS NULL AND `platform`.`id`=" . $platformId . " AND `user`.`deletedAt` IS NULL AND `user`.`id`=" . $userId . " GROUP BY `handle`.`id` ORDER BY `handle`.`id` DESC");
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result), true));
            } else {
                return [];
            }
        }
    }

    /**
     * Find handles by user ID.
     *
     * @param int $userId
     * @return array
     */
    public function findHandlesByUser($userId = 0)
    {
        if ($userId <= 0) {
            return [];
        } else {
            $query = $this->db->query("SELECT IFNULL(`handle`.`id`,0) AS `id`, IFNULL(`handle`.`handleName`,'') AS `handleName`, (CASE WHEN (IFNULL(`handle`.`verifiedAt`,CURRENT_TIMESTAMP)<CURRENT_TIMESTAMP) THEN (0) ELSE (1) END) AS `isVerified.code`, (CASE WHEN (IFNULL(`handle`.`verifiedAt`,CURRENT_TIMESTAMP)<CURRENT_TIMESTAMP) THEN ('VERIFIED') ELSE ('UNVERIFIED') END) AS `isVerified.name`, IFNULL(`handle`.`verifiedAt`,'')  AS `isVerified.dateTime`, IFNULL(`handle`.`handleStatus`,0) AS `status.code`, (CASE WHEN (IFNULL(`handle`.`handleStatus`,0)=0) THEN ('INACTIVE') ELSE ('ACTIVE') END) AS `status.name`, IFNULL(`platform`.`id`,0) AS `platform.id`, IFNULL(`platform`.`platformCode`,'') AS `platform.code`, IFNULL(`platform`.`platformName`,'') AS `platform.name`, IFNULL(`platform`.`platformLogoUrl`,0) AS `platform.logo`, IFNULL(`platform`.`platformPriority`,0) AS `platform.priority`, IFNULL(`user`.`id`,0) AS `user.id`, IFNULL(`user`.`userName`,'') AS `user.name` FROM `handle` LEFT JOIN `platform` ON `handle`.`platformId`=`platform`.`id` LEFT JOIN `user` ON `handle`.`userId`=`user`.`id` WHERE `handle`.`deletedAt` IS NULL AND `handle`.`userId`=" . $userId . " GROUP BY `handle`.`id` ORDER BY `handle`.`id` DESC");
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result), true));
            } else {
                return [];
            }
        }
    }

    /**
     * Get the platforms associated with a campaign.
     *
     * @param int $id The ID of the campaign.
     * @return array An array of platforms associated with the campaign.
     */
    public function getPlatformsByCampaign($id = 0)
    {
        if ($id <= 0) {
            return [];
        } else {
            $query = $this->db->query("SELECT `platform`.* FROM `platform` LEFT JOIN `campaign` ON FIND_IN_SET(`platform`.`id`,`campaign`.`platforms`) WHERE `campaign`.`id`=" . $id . " GROUP BY `platform`.`id` ORDER BY `platform`.`id` DESC");
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result), true));
            } else {
                return [];
            }
        }
    }

    /**
     * Retrieve all the handles from the platform table that are not marked as deleted.
     *
     * @return array|null
     */
    public function getAllhandles()
    {
        $query = $this->db->query("SELECT * FROM platform WHERE deletedAt IS NULL");
        $result = $query->getResult();

        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return null;
        }
    }

    /**
     * Retrieve all currency records from the database.
     *
     * @return array|null An array of currency records, or null if no records are found.
     */
    public function getAllcurrency()
    {
        $query = $this->db->query("SELECT * FROM currency WHERE deletedAt IS NULL");
        $result = $query->getResult();

        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return null;
        }
    }

    /**
     * Get all categories from the database.
     *
     * @return array|null Returns an array of category objects if categories exist, otherwise returns null.
     */
    public function getAllcategory()
    {
        $query = $this->db->query("SELECT * FROM category WHERE deletedAt IS NULL");
        $result = $query->getResult();

        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return null;
        }
    }

    /**
     * Get all campaign types from the database.
     *
     * @return array|null Returns an array of campaign types if found, or null if no campaign types are found.
     */
    public function getAllCampaignType()
    {
        $query = $this->db->query("SELECT IFNULL(`campaigntype`.`id`,0) AS `id`, IFNULL(`campaigntype`.`campaignTypeCode`,'') AS `categoryCode`, IFNULL(`campaigntype`.`campaignTypeName`,'') AS `categoryName`, IFNULL(`campaigntype`.`campaignTypePicUrl`,'') AS `categoryPicUrl`, IFNULL(`campaigntype`.`campaignTypeDescription`,'') AS `categoryDescription` FROM `campaigntype` WHERE `campaigntype`.`id` IS NOT NULL AND `campaigntype`.`deletedAt` IS NULL");
        $result = $query->getResult();

        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return null;
        }
    }

    /**
     * Get all languages from the database.
     *
     * @return array|null Returns an array of language objects if there are any languages in the database, otherwise returns null.
     */
    public function getAlllanguage()
    {
        $query = $this->db->query("SELECT * FROM language WHERE deletedAt IS NULL");
        $result = $query->getResult();

        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return null;
        }
    }

    /**
     * Get all the cities from the database.
     *
     * @return array|null An array of city objects if there are cities in the database, otherwise null.
     */
    public function getAllcity()
    {
        $query = $this->db->query("SELECT * FROM city WHERE deletedAt IS NULL");
        $result = $query->getResult();

        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return null;
        }
    }

    /**
     * Get all the countries from the database.
     *
     * @return array|null An array of country objects, or null if no countries are found.
     */
    public function getAllcountry()
    {
        $query = $this->db->query("SELECT * FROM country WHERE deletedAt IS NULL");
        $result = $query->getResult();

        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return null;
        }
    }

    /**
     * Create a new campaign with the given data.
     *
     * @param array $data
     * @return int The ID of the newly created campaign, or 0 if the data is empty or insertion fails.
     */
    public function createChampaign($data = array())
    {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('campaign');
            if ($builder->insert($data)) {
                return $this->db->insertID();
            } else {
                return 0;
            }
        }
    }

    /**
     * Get the user handles for a given user ID.
     *
     * @param int $userId The ID of the user. Default is 0.
     * @return array An array of user handles.
     */
    public function getUserHandles($userId = 0)
    {
        if ($userId <= 0) return [];
        $q = "SELECT handle.id AS handle_id, user.id AS user_id, platform.id AS platform_id, user.userName, platform.platformName, platform.platformLogoUrl, handle.handleName, handle.follower, handle.following, handle.avgLast5PostLike, handle.avgLast5ReelLike, handle.lastUpdatedAt FROM handle JOIN user ON handle.userId = user.id JOIN platform ON handle.platformId = platform.id  where  userId = " . $userId . ";";
        $query = $this->db->query($q);
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }

    /**
     * Get user media based on the given platform ID.
     *
     * @param int $platformId
     * @return array
     */
    public function getUserMedia($platformId = 0)
    {
        if ($platformId <= 0) return [];
        $q = "SELECT h.handleName, h.follower, h.avgLast5PostLike, p.platformName, h.lastUpdatedAt, u.userName ,u.userPicUrl FROM handle h JOIN platform p ON h.platformId = p.id JOIN user u ON h.userId = u.id WHERE h.platformId = " . $platformId . " AND u.userRole = 10 ORDER BY h.follower DESC LIMIT 12;";
        $query = $this->db->query($q);
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }

    /**
     * Retrieves the top influencers from the database.
     *
     * This function executes a SQL query to retrieve the top influencers based on their follower count.
     * The query joins the `handle`, `platform`, and `user` tables to retrieve additional information about the influencers.
     * The influencers are sorted in descending order based on their follower count.
     * The function returns an array of the top influencers, including their handle name, follower count, average last 5 post likes,
     * platform name, username, and user profile picture URL.
     *
     * @return array An array of the top influencers. If no influencers are found, an empty array is returned.
     */
    public function topInfluencer()
    {
        $q = "SELECT h.handleName, h.follower, h.avgLast5PostLike, p.platformName, u.userName ,u.userPicUrl FROM handle h JOIN platform p ON h.platformId = p.id JOIN user u ON h.userId = u.id ORDER BY h.follower DESC LIMIT 12;";
        $query = $this->db->query($q);
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }
}
