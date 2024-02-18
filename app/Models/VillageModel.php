<?php

namespace app\Models;
use CodeIgniter\Model;

class VillageModel extends Model {
    
    /**
     * Get all villages from the database.
     *
     * @return array
     */
    public function getAllVillages() {
        $query = $this->db->query("SELECT `village`.`id`, `village`.`cityId`, `village`.`villageName`, `city`.`cityName` FROM `village` LEFT JOIN `city` ON `village`.`cityId`=`city`.`id` WHERE `village`.`deletedAt` IS NULL AND `city`.`deletedAt` IS NULL ORDER BY `village`.`villageName` ASC");
        $result = $query->getResult();
        return json_decode(json_encode($result), true);
    }
    
}
