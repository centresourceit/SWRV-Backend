<?php

namespace app\Models;

use CodeIgniter\Model;

class InstaHandleModel extends Model
{


    /**
     * Create a new Instagram handle record in the database.
     *
     * @param array $data
     * @return int Returns the ID of the newly created record, or 0 if an error occurred.
     */
    public function createInstaHandle($data = array())
    {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('instahandleverify');
            if ($builder->insert($data)) {
                return $this->db->insertID();
            } else {
                $error = $this->db->error();
                error_log('MySQL Error: ' . $error['message']);
                return 0;
            }
        }
    }

    /**
     * Get the user by their ID and handle ID from the instahandleverify table.
     *
     * @param int $userId
     * @param int $handleId
     * @return array
     */
    public function getUserById($userId = 0, $handleId = 0)
    {
        if ($userId <= 0) return [];
        if ($handleId <= 0) return [];
        $q = "SELECT * FROM instahandleverify WHERE userId = " . $userId . " AND handleId = " .  $handleId . " ORDER BY createdAt DESC LIMIT 1;";
        $query = $this->db->query($q);
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }
}
