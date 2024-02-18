<?php

namespace app\Models;
use CodeIgniter\Model;

class StateModel extends Model {

    /**
     * Add a new record to the "state" table.
     *
     * @param array $data
     * @return int The ID of the newly inserted record, or 0 if the insertion fails or no data is provided.
     */
    public function addOne($data = array()) {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('state');
            if ($builder->insert($data)) {
                return $this->db->insertID();
    /**
     * Edit a single record in the 'state' table with the given data and ID.
     *
     * @param array $data The data to update the record with.
     * @param int $id The ID of the record to be updated.
     * @return int The number of affected rows after the update operation.
     *             Returns 0 if the data or ID is not valid or if the update operation fails.
     */
            } else {
                return 0;
            }
        }
    }

    public function editOne($data = array(), $id = 0) {
        if ((!isset($data)) || (is_null($data)) || (count($data) <= 0) || (!isset($id)) || (is_null($id)) || (intval($id) <= 0)) {
            return 0;
        } else {
            $builder = $this->db->table('state');
            $res = $builder->update($data, (' id = ' . $id));
            if ($res) {
    /**
     * Get the details of a state by its ID.
     *
     * @param int $id The ID of the state. Default is 0.
     * @return array The details of the state as an associative array. If the ID is invalid or no state is found, an empty array is returned.
     */
                $affectedRows = $this->db->affectedRows();
                return $affectedRows;
            } else {
                return 0;
            }
        }
    }

    public function getOne($id = 0) {
        if ($id <= 0) {
            return [];
        } else {
            $query = $this->db->query("SELECT IFNULL(`state`.`id`,0) AS `id`, IFNULL(`state`.`stateCode`,'') AS `code`, IFNULL(`state`.`stateName`,'') AS `name`, IFNULL(`country`.`id`,0) AS `country.id`, IFNULL(`country`.`countryCode`,'') AS `country.code`, IFNULL(`country`.`mobileISD`,0) AS `country.isd`, IFNULL(`country`.`countryName`,'') AS `country.name` FROM `state` LEFT JOIN `country` ON `state`.`countryId`=`country`.`id` WHERE `state`.`id`=" . $id . " GROUP BY `state`.`id`");
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result), true));
    /**
     * Get the details of a city by its ID.
     *
     * @param int $id
     * @return array
     */
            } else {
                return [];
            }
        }
    }

    /**
     * Get the details of a city by its ID.
     *
     * @param int $id
     * @return array
     */
    public function getOneByCity($id = 0) {
        if ($id <= 0) {
            return [];
        } else {
            $query = $this->db->query("SELECT IFNULL(`state`.`id`,0) AS `id`, IFNULL(`state`.`cityCode`,'') AS `code`, IFNULL(`state`.`stateName`,'') AS `name`, IFNULL(`city`.`id`,0) AS `city.id`, IFNULL(`city`.`cityCode`,'') AS `city.code`, IFNULL(`city`.`cityName`,'') AS `city.name`, IFNULL(`country`.`id`,0) AS `country.id`, IFNULL(`country`.`countryCode`,'') AS `country.code`, IFNULL(`country`.`mobileISD`,0) AS `country.isd`, IFNULL(`country`.`countryName`,'') AS `country.name` FROM `city` LEFT JOIN `state` ON `city`.`stateId`=`state`.`id` LEFT JOIN `country` ON `state`.`countryId`=`country`.`id` WHERE `city`.`id`=" . $id . " GROUP BY `city`.`id`");
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result), true));
            } else {
                return [];
            }
        }
    }

    /**
     * Get all the states and their corresponding country details from the database.
     *
     * @return array
     */
    public function getAll() {
        $query = $this->db->query("SELECT IFNULL(`state`.`id`,0) AS `id`, IFNULL(`state`.`stateCode`,'') AS `code`, IFNULL(`state`.`stateName`,'') AS `name`, IFNULL(`country`.`id`,0) AS `country.id`, IFNULL(`country`.`countryCode`,'') AS `country.code`, IFNULL(`country`.`mobileISD`,0) AS `country.isd`, IFNULL(`country`.`countryName`,'') AS `country.name` FROM `state` LEFT JOIN `country` ON `state`.`countryId`=`country`.`id` WHERE IFNULL(`state`.`stateStatus`,0)=1 AND `state`.`deletedAt` IS NULL AND IFNULL(`country`.`countryStatus`,0)=1 AND `country`.`deletedAt` IS NULL ORDER BY IFNULL(`state`.`stateCode`,'') ASC");
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }

    /**
     * Get all states by country ID.
     *
     * @param int $countryId
     * @return array
     */
    public function getAllByCountry($countryId = 0) {
        $query = $this->db->query("SELECT IFNULL(`state`.`id`,0) AS `id`, IFNULL(`state`.`stateCode`,'') AS `code`, IFNULL(`state`.`stateName`,'') AS `name`, IFNULL(`country`.`id`,0) AS `country.id`, IFNULL(`country`.`countryCode`,'') AS `country.code`, IFNULL(`country`.`mobileISD`,0) AS `country.isd`, IFNULL(`country`.`countryName`,'') AS `country.name` FROM `state` LEFT JOIN `country` ON `state`.`countryId`=`country`.`id` WHERE IFNULL(`state`.`stateStatus`,0)=1 AND `state`.`deletedAt` IS NULL AND IFNULL(`country`.`countryStatus`,0)=1 AND `country`.`deletedAt` IS NULL AND IFNULL(`country`.`id`,0)=" . $countryId . " ORDER BY IFNULL(`state`.`stateCode`,'') ASC");
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }

}