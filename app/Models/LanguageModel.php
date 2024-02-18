<?php

namespace app\Models;

use CodeIgniter\Model;

class LanguageModel extends Model
{

    /**
     * Create a new language record in the database.
     *
     * @param array $data
     * @return int The ID of the newly created language record, or 0 if the creation failed.
     */
    public function createLanguage($data = array())
    {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('language');
            if ($builder->insert($data)) {
                return $this->db->insertID();
            } else {
                return 0;
            }
        }
    }

    /**
     * Update the language record in the database with the given data.
     *
     * @param array $data
     * @param int $languageId
     * @return int The number of affected rows
     */
    public function updateLanguage($data = array(), $languageId = 0)
    {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('language');
            $res = $builder->update($data, (' id = ' . $languageId));
            if ($res) {
                $affectedRows = $this->db->affectedRows();
                return $affectedRows;
            } else {
                return 0;
            }
        }
    }

    /**
     * Find languages associated with a user.
     *
     * @param int $userId
     * @return array
     */
    public function findLanguagesByUser($userId = 0)
    {
        if ($userId <= 0) {
            return [];
        } else {
            $query = $this->db->query("SELECT IFNULL(`language`.`id`,0) AS `id`, IFNULL(`language`.`languageCode`,'') AS `code`, IFNULL(`language`.`languageAsciiSymbol`,'') AS `symbol`, IFNULL(`language`.`languageName`,'') AS `name` FROM `user` LEFT JOIN `language` ON FIND_IN_SET(`language`.`id`, IFNULL(`user`.`languages`,'')) WHERE `user`.`id`=" . $userId . " GROUP BY `language`.`id` ORDER BY `language`.`languageName` ASC");
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result), true));
            } else {
                return [];
            }
        }
    }
}
