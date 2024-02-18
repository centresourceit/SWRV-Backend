<?php

namespace app\Models;

use CodeIgniter\Model;

class FilterModel extends Model
{
    /**
     * Create a new filter record in the database.
     *
     * @param array $data
     * @return int The ID of the newly created filter record, or 0 if the creation failed.
     */
    public function createFilter($data = array())
    {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('filter');
            if ($builder->insert($data)) {
                return $this->db->insertID();
            } else {
                return 0;
            }
        }
    }

    /**
     * Get the filter data for a specific user and type.
     *
     * @param int $userId
     * @param int $type
     * @return array|null
     */
    public function getFilter($userId = 0, $type = 0)
    {
        $query = $this->db->query("SELECT * FROM filter WHERE userid =  " . $userId . " AND type = " . $type . " AND deletedAt IS NULL;");
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return null;
        }
    }


    /**
     * Get the filter from the database by its ID.
     *
     * @param int $id The ID of the filter to retrieve. Default is 0.
     * @return array|null The filter data as an associative array, or null if the filter is not found.
     */
    public function getFilterById($id = 0)
    {
        $query = $this->db->query("SELECT * FROM filter WHERE id = " . $id . " AND deletedAt IS NULL;");
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return null;
        }
    }


}