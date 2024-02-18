<?php

namespace app\Models;
use CodeIgniter\Model;

class CountryModel extends Model {

    /**
     * Add a new record to the "country" table.
     *
     * @param array $data
     * @return int The ID of the newly inserted record, or 0 if the insertion fails or no data is provided.
     */
    public function addOne($data = array()) {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('country');
            if ($builder->insert($data)) {
                return $this->db->insertID();
            } else {
                return 0;
            }
        }
    }

    /**
     * Edit a single record in the 'country' table with the given data and ID.
     *
     * @param array $data
     * @param int $id
     * @return int The number of affected rows
     */
    public function editOne($data = array(), $id = 0) {
        if ((!isset($data)) || (is_null($data)) || (count($data) <= 0) || (!isset($id)) || (is_null($id)) || (intval($id) <= 0)) {
            return 0;
        } else {
            $builder = $this->db->table('country');
            $res = $builder->update($data, (' id = ' . $id));
            if ($res) {
                $affectedRows = $this->db->affectedRows();
                return $affectedRows;
            } else {
                return 0;
            }
        }
    }

    /**
     * Get the details of a country by its ID.
     *
     * @param int $id The ID of the country.
     * @return array The details of the country as an associative array, or an empty array if the ID is less than or equal to 0 or if no country is found with the given ID.
     */
    public function getOne($id = 0) {
        if ($id <= 0) {
            return [];
        } else {
            $query = $this->db->query("SELECT IFNULL(`country`.`id`,0) AS `id`, IFNULL(`country`.`countryCode`,'') AS `code`, IFNULL(`country`.`mobileISD`,0) AS `isd`, IFNULL(`country`.`countryName`,'') AS `name` FROM `country` WHERE `country`.`id`=" . $id . " GROUP BY `country`.`id`");
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result), true));
            } else {
                return [];
            }
        }
    }

    /**
     * Get the state and country information for a given state ID.
     *
     * @param int $id
     * @return array
     */
    public function getOneByState($id = 0) {
        if ($id <= 0) {
            return [];
        } else {
            $query = $this->db->query("SELECT IFNULL(`country`.`id`,0) AS `id`, IFNULL(`country`.`countryCode`,'') AS `code`, IFNULL(`country`.`mobileISD`,0) AS `isd`, IFNULL(`country`.`countryName`,'') AS `name`, IFNULL(`state`.`id`,0) AS `id`, IFNULL(`state`.`stateCode`,'') AS `code`, IFNULL(`state`.`stateName`,'') AS `name` FROM `state` LEFT JOIN `country` ON `state`.`countryId`=`country`.`id` WHERE `state`.`id`=" . $id . " GROUP BY `state`.`id`");
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result), true));
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
            $query = $this->db->query("SELECT IFNULL(`country`.`id`,0) AS `id`, IFNULL(`country`.`countryCode`,'') AS `code`, IFNULL(`country`.`mobileISD`,0) AS `isd`, IFNULL(`country`.`countryName`,'') AS `name`, IFNULL(`city`.`id`,0) AS `city.id`, IFNULL(`city`.`cityCode`,'') AS `city.code`, IFNULL(`city`.`cityName`,'') AS `city.name`, IFNULL(`state`.`id`,0) AS `state.id`, IFNULL(`state`.`cityCode`,'') AS `state.code`, IFNULL(`state`.`stateName`,'') AS `state.name` FROM `city` LEFT JOIN `state` ON `city`.`stateId`=`state`.`id` LEFT JOIN `country` ON `state`.`countryId`=`country`.`id` WHERE `city`.`id`=" . $id . " GROUP BY `city`.`id`");
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result), true));
            } else {
                return [];
            }
        }
    }

    /**
     * Get all the countries from the database.
     *
     * @return array
     */
    public function getAll() {
        $query = $this->db->query("SELECT IFNULL(`country`.`id`,0) AS `id`, IFNULL(`country`.`countryCode`,'') AS `code`, IFNULL(`country`.`mobileISD`,0) AS `isd`, IFNULL(`country`.`countryName`,'') AS `name` FROM `country` WHERE IFNULL(`country`.`countryStatus`,0)=1 AND `country`.`deletedAt` IS NULL ORDER BY IFNULL(`country`.`countryCode`,'') ASC");
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }

}