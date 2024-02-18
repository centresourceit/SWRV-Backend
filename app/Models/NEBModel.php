<?php

namespace app\Models;

use CodeIgniter\Model;

class NEBModel extends Model
{

    /**
     * Find and return all non-deleted and active blog news entries from the database.
     *
     * @return array|null An array of blog news entries if found, or null if no entries are found.
     */
    public function findNEB()
    {
        $query = $this->db->query("SELECT * FROM blognews WHERE deletedAt IS NULL AND status = 1;");
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return null;
        }
    }

    /**
     * Find and return a single record from the "blognews" table based on the given "nebId".
     *
     * @param int $nebId
     * @return array|null
     */
    public function findOneNEB($nebId = 0)
    {
        if ($nebId <= 0) {
            return null;
        } else {
            $q = "SELECT * FROM blognews WHERE id =  " . $nebId . ";";
            $query = $this->db->query($q);
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result[0]), true));
            } else {
                return null;
            }
        }
    }
    /**
     * Find blog news entries by type.
     *
     * @param int $nebType
     * @return array|null
     */
    public function findNEBByType($nebType = 0)
    {
        if ($nebType <= 0) {
            return null;
        } else {
            $q = "SELECT * FROM blognews WHERE type =  " . $nebType . ";";
            $query = $this->db->query($q);
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result), true));
            } else {
                return null;
            }
        }
    }
    /**
     * Search for blog news entries in the database based on the given NEB type and search keyword.
     *
     * @param int $nebType The NEB type to filter the search results. If less than or equal to 0, returns null.
     * @param string $search The keyword to search for in the blog news titles. If empty, returns null.
     * @return array|null Returns an array of blog news entries in JSON format if found, otherwise returns null.
     */
    public function searchNEB($nebType = 0, $search = "")
    {
        if ($nebType <= 0) {
            return null;
        } elseif ($search == "") {
            return null;
        } else {
            $q = "SELECT * FROM blognews WHERE title LIKE '%" . $search . "%'  AND type =  " . $nebType . ";";
            $query = $this->db->query($q);
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result), true));
            } else {
                return null;
            }
        }
    }


    /**
     * Deletes a single blog news entry by setting its `deletedAt` field to the current timestamp and `status` field to 0.
     * 
     * @param int $id The ID of the blog news entry to delete.
     * @return array An array containing the deleted blog news entry if it exists, otherwise an empty array.
     */
    public function delOneNEB($id = 0)
    {
        if ($id <= 0) {
            return [];
        } else {
            $q = "UPDATE `blognews` SET `deletedAt` = CURRENT_TIMESTAMP , status = 0 WHERE `blognews`.`id` = " . $id . ";";
            $result = $this->db->query($q);
            if ($result && $this->db->affectedRows() > 0) {
                $q = "SELECT * FROM `blognews` WHERE `blognews`.`id` = " . $id . ";";
                $result1 = $this->db->query($q);
                $res = $result1->getResult();
                return $res;
            } else {
                return [];
            }
        }
    }

    /**
     * Edit a single record in the "blognews" table using the given data and ID.
     *
     * @param array $data
     * @param int $id
     * @return array
     */
    public function editOneNEB($data = array(), $id = 0)
    {
        if ((!isset($data)) || (is_null($data)) || (count($data) <= 0) || (!isset($id)) || (is_null($id))) {
            return [];
        } else {

            $builder = $this->db->table('blognews');
            $res = $builder->update($data, (' id = ' . $id));
            if ($res) {
                $q = "SELECT * FROM `blognews` WHERE `blognews`.`id` = " . $id . ";";
                $result1 = $this->db->query($q);
                $res1 = $result1->getResult();
                return $res1;
            } else {
                return [];
            }
        }
    }

    /**
     * Add a new record to the 'blognews' table with the given data.
     *
     * @param array $data
     * @return int Returns the ID of the newly inserted record, or 0 if the insertion fails.
     */
    public function addOneNEB($data = array())
    {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('blognews');
            if ($builder->insert($data)) {
                return $this->db->insertID();
            } else {
                $error = $this->db->error();
                echo $error['message'];
                return 0;
            }
        }
    }
}