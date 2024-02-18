<?php

namespace app\Models;

use CodeIgniter\Model;

class MarketModel extends Model
{

    /**
     * Add a new record to the 'market' table.
     *
     * @param array $data
     * @return int The ID of the newly inserted record, or 0 if the insertion failed.
     */
    public function addOne($data = array())
    {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            // die("working");
            $builder = $this->db->table('market');
            if ($builder->insert($data)) {
                return $this->db->insertID();
            } else {
                $error = $this->db->error();
    /**
     * Edit a single record in the "market" table.
     *
     * @param array $data
     * @param int $id
     * @return array
     */
                echo $error['message'];
                return 0;
            }
        }
    }

    /**
     * Edit a single record in the "market" table.
     *
     * @param array $data
     * @param int $id
     * @return array
     */
    public function editOne($data = array(), $id = 0)
    {
        if ((!isset($data)) || (is_null($data)) || (count($data) <= 0) || (!isset($id)) || (is_null($id)) || (intval($id) <= 0)) {
            return [];
        } else {
            $builder = $this->db->table('market');
            $res = $builder->update($data, (' id = ' . $id));
            if ($res) {
                $q = "SELECT * FROM `market` WHERE `market`.`id` = " . $id . ";";
                $result1 = $this->db->query($q);
                $res = $result1->getResult();
    /**
     * Get the details of a market by its ID.
     *
     * @param int $id The ID of the market.
     * @return array The details of the market as an associative array, or an empty array if the ID is less than or equal to 0 or if no market is found with the given ID.
     */
                return $res;
            } else {
                return [];
            }
        }
    }

    public function getOne($id = 0)
    {
        if ($id <= 0) {
            return [];
        } else {
            $query = $this->db->query("SELECT IFNULL(`market`.`id`,0) AS `id`, IFNULL(`market`.`marketCode`,'') AS `code`, IFNULL(`market`.`marketName`,'') AS `name`, IFNULL(`market`.`marketDescription`,'') AS `description`, IFNULL(`market`.`marketPicUrl`,'') AS `picUrl`, IFNULL(`market`.`marketStatus`,0) AS `status.code`, (CASE WHEN (IFNULL(`market`.`marketStatus`,0)=1) THEN ('ACTIVE') ELSE ('INACTIVE') END) AS `status.name` FROM `market` WHERE `market`.`id`=" . $id . " GROUP BY `market`.`id`");
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result), true));
            } else {
                return [];
            }
        }
    }

    /**
     * Get all the markets from the database.
     *
     * @return array
     */
    public function getAll()
    {
        $query = $this->db->query("SELECT IFNULL(`market`.`id`,0) AS `id`, IFNULL(`market`.`marketCode`,'') AS `code`, IFNULL(`market`.`marketName`,'') AS `name`, IFNULL(`market`.`marketDescription`,'') AS `description`, IFNULL(`market`.`marketPicUrl`,'') AS `picUrl`, IFNULL(`market`.`marketStatus`,0) AS `status.code`, (CASE WHEN (IFNULL(`market`.`marketStatus`,0)=1) THEN ('ACTIVE') ELSE ('INACTIVE') END) AS `status.name` FROM `market` WHERE IFNULL(`market`.`marketStatus`,0)=1 AND `market`.`deletedAt` IS NULL ORDER BY IFNULL(`market`.`marketCode`,'') ASC");
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }

    /**
     * Get all markets associated with a user.
     *
     * @param int $userId
     * @return array
     */
    public function getAllByUser($userId = 0)
    {
        if ($userId <= 0) {
            return [];
        } else {
            $query = $this->db->query("SELECT IFNULL(`market`.`id`,0) AS `id`, (CASE WHEN (IFNULL(`um`.`id`,0)>0) THEN (1) ELSE (0) END) AS `isMainMarket`, IFNULL(`market`.`marketCode`,'') AS `code`, IFNULL(`market`.`marketName`,'') AS `name`, IFNULL(`market`.`marketDescription`,'') AS `description`, IFNULL(`market`.`marketPicUrl`,'') AS `picUrl`, IFNULL(`market`.`marketStatus`,0) AS `status.code`, (CASE WHEN (IFNULL(`market`.`marketStatus`,0)=1) THEN ('ACTIVE') ELSE ('INACTIVE') END) AS `status.name` FROM `market` LEFT JOIN `user` AS `uo` ON FIND_IN_SET(IFNULL(`market`.`id`,0),IFNULL(`uo`.`markets`,'')) LEFT JOIN `user` AS `um` ON `market`.`id`=`um`.`marketId` WHERE IFNULL(`market`.`marketStatus`,0)=1 AND `market`.`deletedAt` IS NULL AND (`uo`.`id`=" . $userId . " OR `um`.`id`=" . $userId . ") GROUP BY `market`.`id` ORDER BY IFNULL(`market`.`marketCode`,'') ASC");
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result), true));
            } else {
                return [];
            }
        }
    }

    /**
     * Delete a record from the `market` table based on the given ID.
     *
     * @param int $id
     * @return array
     */
    public function delOne($id = 0)
    {
        if ($id <= 0) {
            return [];
        } else {
            $q = "UPDATE `market` SET `deletedAt` = CURRENT_TIMESTAMP WHERE `market`.`id` = " . $id . ";";
            $result = $this->db->query($q);
            if ($result && $this->db->affectedRows() > 0) {
                $q = "SELECT * FROM `market` WHERE `market`.`id` = " . $id . ";";
                $result1 = $this->db->query($q);
                $res = $result1->getResult();
                return $res;
            } else {
                return [];
            }
        }
    }
}
