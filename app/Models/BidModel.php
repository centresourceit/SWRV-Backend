<?php

namespace app\Models;

use CodeIgniter\Model;

class BidModel extends Model
{
    /**
     * Add a new record to the 'bid' table.
     *
     * @param array $data
     * @return int The ID of the newly inserted record, or 0 if the insertion failed or no data was provided.
     */
    public function addOne($data = array())
    {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('bid');
            if ($builder->insert($data)) {
                return $this->db->insertID();
            } else {
                return 0;
            }
        }
    }
    /**
     * Get the last bid for a campaign.
     *
     * @param int $campaignId
     * @return array
     */
    public function getCampaignLastBid($champaignId)
    {
        if ($champaignId <= 0) return [];
        $q = "SELECT * FROM bid where campaignId = " . $champaignId . " ORDER BY createdAt DESC LIMIT 1;";
        $query = $this->db->query($q);
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }

    /**
     * Get the approved bid for a given campaign ID.
     *
     * @param int $campaignId
     * @return array
     */
    public function getCampaignApprovedBid($champaignId)
    {
        if ($champaignId <= 0) return [];
        $q =  "SELECT b.*, u.userPicUrl , u.userName , u.userEmail FROM `bid` b INNER JOIN ( SELECT userId, campaignId, MAX(createdAt) AS max_created_at FROM `bid` GROUP BY userId, campaignId ) latest_bid ON b.userId = latest_bid.userId AND b.campaignId = latest_bid.campaignId AND b.createdAt = latest_bid.max_created_at LEFT JOIN `user` u ON b.userId = u.id where `b`.`campaignId` = " . $champaignId . " AND `b`.approved = 1;";
        $query = $this->db->query($q);
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }

    /**
     * Get the campaign bid information for a given campaign ID.
     *
     * @param int $campaignId
     * @return array
     */
    public function getCampaignBid($champaignId)
    {
        if ($champaignId <= 0) return [];
        $q =  "SELECT b.*, u.userPicUrl , u.userName , u.userEmail FROM `bid` b INNER JOIN ( SELECT userId, campaignId, MAX(createdAt) AS max_created_at FROM `bid` GROUP BY userId, campaignId ) latest_bid ON b.userId = latest_bid.userId AND b.campaignId = latest_bid.campaignId AND b.createdAt = latest_bid.max_created_at LEFT JOIN `user` u ON b.userId = u.id where  `b`.`campaignId` = " . $champaignId . ";";
        $query = $this->db->query($q);
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }

    /**
     * Get the campaign bid snapshot for a given campaign ID.
     *
     * @param int $campaignId
     * @return array
     */
    public function getCampaignBidSnapshot($champaignId)
    {
        if ($champaignId <= 0) return [];
        $q =  "SELECT b.*, u.userPicUrl , u.userName , u.userEmail FROM `bid` b INNER JOIN ( SELECT userId, campaignId, MAX(createdAt) AS max_created_at FROM `bid` GROUP BY userId, campaignId ) latest_bid ON b.userId = latest_bid.userId AND b.campaignId = latest_bid.campaignId AND b.createdAt = latest_bid.max_created_at LEFT JOIN `user` u ON b.userId = u.id where `b`.`approved` = 1 AND `b`.`campaignId` = " . $champaignId . ";";
        $query = $this->db->query($q);
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }

    /**
     * Update the bid with the given ID and set the 'approved' field to 1.
     *
     * @param int $id The ID of the bid to update.
     * @return array The updated bid data, or an empty array if the bid was not found or the update failed.
     */
    public function updateBid($id = 0)
    {
        if ($id <= 0) {
            return [];
        } else {
            $q = "UPDATE `bid` SET `approved` = 1 WHERE `bid`.`id` = " . $id . ";";
            $result = $this->db->query($q);
            if ($result && $this->db->affectedRows() > 0) {
                $q = "SELECT * FROM `bid` WHERE `bid`.`id` = " . $id . ";";
                $result1 = $this->db->query($q);
                $res = $result1->getResult();
                return $res;
            } else {
                return [];
            }
        }
    }
}
