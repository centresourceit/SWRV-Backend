<?php

namespace app\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    /**
     * Retrieves the home data from the database.
     *
     * @return array The home data as an associative array.
     */
    public function getHome()
    {

        $query = $this->db->query("SELECT * FROM `home` WHERE id = 1;");
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }

    /**
     * Update the home record in the database with the given data.
     *
     * @param array $data
     * @return array
     */
    public function updateHome($data = array())
    {
        $builder = $this->db->table('home');
        $res = $builder->update($data, (' id = 1'));
        if ($res) {
            $q = "SELECT * FROM `home` WHERE `home`.`id` = 1;";
            $result1 = $this->db->query($q);
            $res1 = $result1->getResult();
            return $res1;
        } else {
            return [];
        }
    }
}
