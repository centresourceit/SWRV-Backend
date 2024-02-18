<?php

namespace app\Models;

use CodeIgniter\Model;

class ContactDisputeModel extends Model
{
    /**
     * Add a new record to the "contact_dispute" table.
     *
     * @param array $data
     * @return int The ID of the newly inserted record, or 0 if the insertion fails or no data is provided.
     */
    public function addOne($data = array())
    {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('contact_dispute');
            if ($builder->insert($data)) {
                return $this->db->insertID();
            } else {
                return 0;
            }
        }
    }

    /**
     * Retrieves contact information from the `contact_dispute` table where the name is not null.
     *
     * @return array An array containing the contact information as associative arrays.
     */
    public function getContact()
    {
        $q =  "SELECT * FROM `contact_dispute` WHERE name IS NOT NULL;";
        $query = $this->db->query($q);
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }
    /**
     * Get the disputes from the database.
     *
     * This method retrieves the disputes from the "contact_dispute" table in the database.
     * It joins the "brand" and "user" tables to retrieve additional information about the brand and user associated with each dispute.
     * If a dispute is associated with a campaign, it also joins the "campaign" table to retrieve the campaign name.
     * The method returns an array of disputes, where each dispute is represented as an associative array with the following keys:
     * - id: The ID of the dispute.
     * - brandId: The ID of the brand associated with the dispute.
     * - brandName: The name of the brand associated with the dispute.
     * - brandWebUrl: The website URL
     */
    public function getDispute()
    {

        $q = "SELECT cd.*, b.brandName, b.brandWebUrl, b.brandSupportEmail, b.brandLogoUrl, u.userName, u.userEmail, u.userContact, u.userPicUrl, COALESCE(c.campaignName, 'Unknown Campaign') AS campaignName FROM contact_dispute cd JOIN brand b ON cd.brandId = b.id JOIN user u ON cd.userId = u.id LEFT JOIN campaign c ON cd.campaignId = c.id WHERE cd.name IS NULL;";
        $query = $this->db->query($q);
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }
}
