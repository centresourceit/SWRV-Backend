<?php

namespace app\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{

    /**
     * Create a new category with the given data.
     *
     * @param array $data
     * @return int The ID of the newly created category, or 0 if an error occurred.
     */
    public function createCategory($data = array())
    {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('category');
            if ($builder->insert($data)) {
                return $this->db->insertID();
            } else {
                $error = $this->db->error();
                echo $error['message'];
                return 0;
            }
        }
    }


    /**
     * Get a single category by its ID.
     *
     * @param int $id The ID of the category to retrieve. Defaults to 0.
     * @return array An array representing the category, or an empty array if the ID is less than or equal to 0 or if no category is found.
     */
    public function getOne($id = 0)
    {
        if ($id <= 0) {
            return [];
        } else {
            $query = $this->db->query("SELECT * FROM `category`  WHERE `category`.`categoryStatus` = 1 AND `category`.`deletedAt` IS NULL  AND `category`.`id`=" . $id . ";");
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result), true));
            } else {
                return [];
            }
        }
    }

    /**
     * Update the category with the given data and category ID.
     *
     * @param array $data
     * @param int $categoryId
     * @return int The number of affected rows
     */
    public function updateCategory($data = array(), $categoryId = 0)
    {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('category');
            $res = $builder->update($data, (' id = ' . $categoryId));
            if ($res) {
                $affectedRows = $this->db->affectedRows();
                return $affectedRows;
            } else {
                return 0;
            }
        }
    }

    /**
     * Find categories associated with a user.
     *
     * @param int $userId
     * @return array
     */
    public function findCategoriesByUser($userId = 0)
    {
        if ($userId <= 0) {
            return [];
        } else {
            $query = $this->db->query("SELECT IFNULL(`category`.`id`,0) AS `id`, IFNULL(`category`.`categoryCode`,'') AS `code`, IFNULL(`category`.`categoryName`,'') AS `name` FROM `user` LEFT JOIN `category` ON FIND_IN_SET(`category`.`id`, IFNULL(`user`.`categories`,'')) WHERE `user`.`id`=" . $userId . " GROUP BY `category`.`id` ORDER BY `category`.`categoryName` ASC");
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result), true));
            } else {
                return [];
            }
        }
    }


    /**
     * Edit a single record in the "category" table.
     *
     * @param array $data The data to update the record with.
     * @param int $id The ID of the record to edit.
     * @return array The updated record, or an empty array if the update was unsuccessful or invalid parameters were provided.
     */
    public function editOne($data = array(), $id = 0)
    {
        if ((!isset($data)) || (is_null($data)) || (count($data) <= 0) || (!isset($id)) || (is_null($id)) || (intval($id) <= 0)) {
            return [];
        } else {
            $builder = $this->db->table('category');
            $res = $builder->update($data, (' id = ' . $id));
            if ($res) {
                $q = "SELECT * FROM `category` WHERE `category`.`id` = " . $id . ";";
                $result1 = $this->db->query($q);
                $res = $result1->getResult();
                return $res;
            } else {
                return [];
            }
        }
    }

    /**
     * Delete a category by its ID.
     *
     * @param int $id The ID of the category to delete.
     * @return array The deleted category, if successful. Otherwise, an empty array.
     */
    public function delOne($id = 0)
    {
        if ($id <= 0) {
            return [];
        } else {
            $q = "UPDATE `category` SET `deletedAt` = CURRENT_TIMESTAMP WHERE `category`.`id` = " . $id . ";";
            $result = $this->db->query($q);
            if ($result && $this->db->affectedRows() > 0) {
                $q = "SELECT * FROM `category` WHERE `category`.`id` = " . $id . ";";
                $result1 = $this->db->query($q);
                $res = $result1->getResult();
                return $res;
            } else {
                return [];
            }
        }
    }
}
