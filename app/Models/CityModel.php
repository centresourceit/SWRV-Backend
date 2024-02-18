<?php

namespace app\Models;

use CodeIgniter\Model;

class CityModel extends Model
{

    /**
     * Add a new record to the "city" table.
     *
     * @param array $data
     * @return int The ID of the newly inserted record, or 0 if the insertion fails or no data is provided.
     */
    public function addOne($data = array())
    {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('city');
            if ($builder->insert($data)) {
                return $this->db->insertID();
            } else {
                return 0;
            }
        }
    }

    /**
     * Edit a record in the "city" table with the given data and ID.
     *
     * @param array $data
     * @param int $id
     * @return int The number of affected rows
     */
    public function editOne($data = array(), $id = 0)
    {
        if ((!isset($data)) || (is_null($data)) || (count($data) <= 0) || (!isset($id)) || (is_null($id)) || (intval($id) <= 0)) {
            return 0;
        } else {
            $builder = $this->db->table('city');
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
     * Get the data for a specific item based on its ID and optional search criteria.
     *
     * @param int $id
     * @param string $search
     * @return array
     */
    public function getOne($id = 0, $search = "")
    {
        $query = null;
        if ($id <= 0) {
            return [];
        } else {
            if ((!isset($search)) || (is_null($search)) || (empty($search))) {
                $query = $this->db->query("SELECT IFNULL(`city`.`id`,0) AS `id`, IFNULL(`city`.`cityCode`,'') AS `code`, IFNULL(`city`.`cityName`,'') AS `name`, IFNULL(`state`.`id`,0) AS `state.id`, IFNULL(`state`.`stateCode`,'') AS `state.code`, IFNULL(`state`.`stateName`,'') AS `state.name`, IFNULL(`country`.`id`,0) AS `country.id`, IFNULL(`country`.`countryCode`,'') AS `country.code`, IFNULL(`country`.`mobileISD`,0) AS `country.isd`, IFNULL(`country`.`countryName`,'') AS `country.name` FROM `city` LEFT JOIN `state` ON `city`.`stateId`=`state`.`id` LEFT JOIN `country` ON `state`.`countryId`=`country`.`id` WHERE `city`.`id`=" . $id . " GROUP BY `city`.`id`");
            } else {
                $search = ("%" . trim(str_replace(array('a', 'e', 'i', 'o', 'u', ' ', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), '%', strtolower(trim(str_replace(array('~', '`', '!', '@', '#', '$', '%', '^', '₹', '%', '^', '&', '*', '(', ')', '_', '-', '=', '+', '{', '}', '[', ']', '|', '\\', ';', '\'', ':', '"', '<', '>', '?', ',', '.', '/',), ' ', $search))))) . "%");
                $query = $this->db->query("SELECT IFNULL(`city`.`id`,0) AS `id`, IFNULL(`city`.`cityCode`,'') AS `code`, IFNULL(`city`.`cityName`,'') AS `name`, IFNULL(`state`.`id`,0) AS `state.id`, IFNULL(`state`.`stateCode`,'') AS `state.code`, IFNULL(`state`.`stateName`,'') AS `state.name`, IFNULL(`country`.`id`,0) AS `country.id`, IFNULL(`country`.`countryCode`,'') AS `country.code`, IFNULL(`country`.`mobileISD`,0) AS `country.isd`, IFNULL(`country`.`countryName`,'') AS `country.name` FROM `city` LEFT JOIN `state` ON `city`.`stateId`=`state`.`id` LEFT JOIN `country` ON `state`.`countryId`=`country`.`id` WHERE `city`.`id`=" . $id . " OR IFNULL(`city`.`cityName`,'') LIKE '" . $search . "' GROUP BY `city`.`id`"); // CONCAT(IFNULL(`city`.`cityCode`,''),' ',IFNULL(`city`.`cityName`,''))
            }
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result), true));
            } else {
                return [];
            }
        }
    }

    /**
     * Get all the cities with their corresponding states and countries.
     *
     * @param string $search (optional) A search string to filter the cities by name.
     * @return array An array of cities, each containing the city details, state details, and country details.
     */
    public function getAll($search = "")
    {
        $query = null;
        if ((!isset($search)) || (is_null($search)) || (empty($search))) {
            $query = $this->db->query("SELECT IFNULL(`city`.`id`,0) AS `id`, IFNULL(`city`.`cityCode`,'') AS `code`, IFNULL(`city`.`cityName`,'') AS `name`, IFNULL(`state`.`id`,0) AS `state.id`, IFNULL(`state`.`stateCode`,'') AS `state.code`, IFNULL(`state`.`stateName`,'') AS `state.name`, IFNULL(`country`.`id`,0) AS `country.id`, IFNULL(`country`.`countryCode`,'') AS `country.code`, IFNULL(`country`.`mobileISD`,0) AS `country.isd`, IFNULL(`country`.`countryName`,'') AS `country.name` FROM `city` LEFT JOIN `state` ON `city`.`stateId`=`state`.`id` LEFT JOIN `country` ON `state`.`countryId`=`country`.`id` WHERE IFNULL(`city`.`cityStatus`,0)=1 AND `city`.`deletedAt` IS NULL AND IFNULL(`state`.`stateStatus`,0)=1 AND `state`.`deletedAt` IS NULL AND IFNULL(`country`.`countryStatus`,0)=1 AND `country`.`deletedAt` IS NULL ORDER BY IFNULL(`city`.`cityCode`,'') ASC");
        } else {
            // $search = ("%" . trim(str_replace(array('a', 'e', 'i', 'o', 'u', ' ', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), '%', strtolower(trim(str_replace(array('~', '`', '!', '@', '#', '$', '%', '^', '₹', '%', '^', '&', '*', '(', ')', '_', '-', '=', '+', '{', '}', '[', ']', '|', '\\', ';', '\'', ':', '"', '<', '>', '?', ',', '.', '/',), ' ', $search))))) . "%");
            $search = ("%" . $search . "%");
            $query = $this->db->query("SELECT IFNULL(`city`.`id`,0) AS `id`, IFNULL(`city`.`cityCode`,'') AS `code`, IFNULL(`city`.`cityName`,'') AS `name`, IFNULL(`state`.`id`,0) AS `state.id`, IFNULL(`state`.`stateCode`,'') AS `state.code`, IFNULL(`state`.`stateName`,'') AS `state.name`, IFNULL(`country`.`id`,0) AS `country.id`, IFNULL(`country`.`countryCode`,'') AS `country.code`, IFNULL(`country`.`mobileISD`,0) AS `country.isd`, IFNULL(`country`.`countryName`,'') AS `country.name` FROM `city` LEFT JOIN `state` ON `city`.`stateId`=`state`.`id` LEFT JOIN `country` ON `state`.`countryId`=`country`.`id` WHERE IFNULL(`city`.`cityStatus`,0)=1 AND `city`.`deletedAt` IS NULL AND IFNULL(`state`.`stateStatus`,0)=1 AND `state`.`deletedAt` IS NULL AND IFNULL(`country`.`countryStatus`,0)=1 AND `country`.`deletedAt` IS NULL AND IFNULL(`city`.`cityName`,'') LIKE '" . $search . "' ORDER BY IFNULL(`city`.`cityCode`,'') ASC");
        }
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }

    /**
     * Get all cities by state ID and search keyword.
     *
     * @param int $stateId
     * @param string $search
     * @return array
     */
    public function getAllByState($stateId = 0, $search = "")
    {
        $query = null;
        if ((!isset($search)) || (is_null($search)) || (empty($search))) {
            $query = $this->db->query("SELECT IFNULL(`city`.`id`,0) AS `id`, IFNULL(`city`.`cityCode`,'') AS `code`, IFNULL(`city`.`cityName`,'') AS `name`, IFNULL(`state`.`id`,0) AS `state.id`, IFNULL(`state`.`stateCode`,'') AS `state.code`, IFNULL(`state`.`stateName`,'') AS `state.name`, IFNULL(`country`.`id`,0) AS `country.id`, IFNULL(`country`.`countryCode`,'') AS `country.code`, IFNULL(`country`.`mobileISD`,0) AS `country.isd`, IFNULL(`country`.`countryName`,'') AS `country.name` FROM `city` LEFT JOIN `state` ON `city`.`stateId`=`state`.`id` LEFT JOIN `country` ON `state`.`countryId`=`country`.`id` WHERE IFNULL(`city`.`cityStatus`,0)=1 AND `city`.`deletedAt` IS NULL AND IFNULL(`state`.`stateStatus`,0)=1 AND `state`.`deletedAt` IS NULL AND IFNULL(`country`.`countryStatus`,0)=1 AND `country`.`deletedAt` IS NULL AND IFNULL(`state`.`id`,0)=" . $stateId . " ORDER BY IFNULL(`city`.`cityCode`,'') ASC");
        } else {
            $search = ("%" . trim(str_replace(array('a', 'e', 'i', 'o', 'u', ' ', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), '%', strtolower(trim(str_replace(array('~', '`', '!', '@', '#', '$', '%', '^', '₹', '%', '^', '&', '*', '(', ')', '_', '-', '=', '+', '{', '}', '[', ']', '|', '\\', ';', '\'', ':', '"', '<', '>', '?', ',', '.', '/',), ' ', $search))))) . "%");
            $query = $this->db->query("SELECT IFNULL(`city`.`id`,0) AS `id`, IFNULL(`city`.`cityCode`,'') AS `code`, IFNULL(`city`.`cityName`,'') AS `name`, IFNULL(`state`.`id`,0) AS `state.id`, IFNULL(`state`.`stateCode`,'') AS `state.code`, IFNULL(`state`.`stateName`,'') AS `state.name`, IFNULL(`country`.`id`,0) AS `country.id`, IFNULL(`country`.`countryCode`,'') AS `country.code`, IFNULL(`country`.`mobileISD`,0) AS `country.isd`, IFNULL(`country`.`countryName`,'') AS `country.name` FROM `city` LEFT JOIN `state` ON `city`.`stateId`=`state`.`id` LEFT JOIN `country` ON `state`.`countryId`=`country`.`id` WHERE IFNULL(`city`.`cityStatus`,0)=1 AND `city`.`deletedAt` IS NULL AND IFNULL(`state`.`stateStatus`,0)=1 AND `state`.`deletedAt` IS NULL AND IFNULL(`country`.`countryStatus`,0)=1 AND `country`.`deletedAt` IS NULL AND IFNULL(`state`.`id`,0)=" . $stateId . " AND IFNULL(`city`.`cityName`,'') LIKE '" . $search . "' ORDER BY IFNULL(`city`.`cityCode`,'') ASC");
        }
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }

    /**
     * Get all cities by country ID and search keyword.
     *
     * @param int $countryId
     * @param string $search
     * @return array
     */
    public function getAllByCountry($countryId = 0, $search = "")
    {
        $query = null;
        if ((!isset($search)) || (is_null($search)) || (empty($search))) {
            $query = $this->db->query("SELECT IFNULL(`city`.`id`,0) AS `id`, IFNULL(`city`.`cityCode`,'') AS `code`, IFNULL(`city`.`cityName`,'') AS `name`, IFNULL(`state`.`id`,0) AS `state.id`, IFNULL(`state`.`stateCode`,'') AS `state.code`, IFNULL(`state`.`stateName`,'') AS `state.name`, IFNULL(`country`.`id`,0) AS `country.id`, IFNULL(`country`.`countryCode`,'') AS `country.code`, IFNULL(`country`.`mobileISD`,0) AS `country.isd`, IFNULL(`country`.`countryName`,'') AS `country.name` FROM `city` LEFT JOIN `state` ON `city`.`stateId`=`state`.`id` LEFT JOIN `country` ON `state`.`countryId`=`country`.`id` WHERE IFNULL(`city`.`cityStatus`,0)=1 AND `city`.`deletedAt` IS NULL AND IFNULL(`state`.`stateStatus`,0)=1 AND `state`.`deletedAt` IS NULL AND IFNULL(`country`.`countryStatus`,0)=1 AND `country`.`deletedAt` IS NULL AND IFNULL(`country`.`id`,0)=" . $countryId . " ORDER BY IFNULL(`city`.`cityCode`,'') ASC");
        } else {
            $search = ("%" . trim(str_replace(array('a', 'e', 'i', 'o', 'u', ' ', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), '%', strtolower(trim(str_replace(array('~', '`', '!', '@', '#', '$', '%', '^', '₹', '%', '^', '&', '*', '(', ')', '_', '-', '=', '+', '{', '}', '[', ']', '|', '\\', ';', '\'', ':', '"', '<', '>', '?', ',', '.', '/',), ' ', $search))))) . "%");
            $query = $this->db->query("SELECT IFNULL(`city`.`id`,0) AS `id`, IFNULL(`city`.`cityCode`,'') AS `code`, IFNULL(`city`.`cityName`,'') AS `name`, IFNULL(`state`.`id`,0) AS `state.id`, IFNULL(`state`.`stateCode`,'') AS `state.code`, IFNULL(`state`.`stateName`,'') AS `state.name`, IFNULL(`country`.`id`,0) AS `country.id`, IFNULL(`country`.`countryCode`,'') AS `country.code`, IFNULL(`country`.`mobileISD`,0) AS `country.isd`, IFNULL(`country`.`countryName`,'') AS `country.name` FROM `city` LEFT JOIN `state` ON `city`.`stateId`=`state`.`id` LEFT JOIN `country` ON `state`.`countryId`=`country`.`id` WHERE IFNULL(`city`.`cityStatus`,0)=1 AND `city`.`deletedAt` IS NULL AND IFNULL(`state`.`stateStatus`,0)=1 AND `state`.`deletedAt` IS NULL AND IFNULL(`country`.`countryStatus`,0)=1 AND `country`.`deletedAt` IS NULL AND IFNULL(`country`.`id`,0)=" . $countryId . " AND IFNULL(`city`.`cityName`,'') LIKE '" . $search . "' ORDER BY IFNULL(`city`.`cityCode`,'') ASC");
        }
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }

    /**
     * Retrieve all cities from the database.
     *
     * @return array
     */
    public function getAllCities()
    {
        $query = $this->db->query("SELECT `city`.`id`, `city`.`cityName` FROM `city` WHERE `city`.`deletedAt` IS NULL");
        $result = $query->getResult();
        return json_decode(json_encode($result), true);
    }

    /**
     * Get the city by its ID.
     *
     * @param int|null $id The ID of the city. If null, returns null.
     * @return array|null The city information as an associative array, or null if the city is not found.
     */
    public function getCityById($id = null)
    {
        if (!empty($id)) {
            $query = $this->db->query("SELECT `city`.`id`, `city`.`cityName`, `city`.`cityStatus` FROM `city` WHERE `city`.`id` = " . $id);
            $result = $query->getResult();
            if (!empty($result)) {
                return json_decode(json_encode($result), true);
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    /**
     * Add a new city to the database.
     *
     * @param string|null $city The name of the city to add.
     * @return array|null Returns an array representing the inserted row if successful, or null if $city is empty.
     */
    public function addNewCity($city = null)
    {
        if (!empty($city)) {
            $query = $this->db->query("INSERT INTO `city` (`cityName`,`cityStatus`) VALUES ('" . $city . "',1)");
            $result = $query->getLastRow();
            return json_decode(json_encode($result), true);
        } else {
            return null;
        }
    }
}
