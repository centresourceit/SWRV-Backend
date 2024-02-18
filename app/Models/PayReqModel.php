<?php

namespace app\Models;

use CodeIgniter\Model;

class PayReqModel extends Model {

    /**
     * Add a new record to the "pay_req" table.
     *
     * @param array $data
     * @return int The ID of the newly inserted record, or 0 if the insertion fails or no data is provided.
     */
    public function addOne($data = array()) {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('pay_req');
            if ($builder->insert($data)) {
                return $this->db->insertID();
            } else {
                return 0;
            }
        }
    }

    /**
     * Edit a record in the 'pay_req' table with the given data and ID.
     *
     * @param array $data
     * @param int $id
     * @return int The number of affected rows
     */
    public function editOne($data = array(), $id = 0) {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('pay_req');
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
     * Search for pay requests based on the given arguments.
     *
     * @param array $args
     * @return array
     */
    public function searchAll($args = array()) {
        $whr = ["`pay_req`.`deletedAt` IS NULL"];
        if ((!isset($args['id']) || is_null($args['id']) || empty($args['id']))) {} else { array_push($whr, "IFNULL(`pay_req`.`id`,0) IN (" . ($args['id']) . ")"); }
        if ((!isset($args['influencer']) || is_null($args['influencer']) || empty($args['influencer']))) {} else { array_push($whr, "IFNULL(`influencer`.`id`,0) IN (" . ($args['influencer']) . ")"); }
        if ((!isset($args['campaign']) || is_null($args['campaign']) || empty($args['campaign']))) {} else { array_push($whr, "IFNULL(`campaign`.`id`,0) IN (" . ($args['campaign']) . ")"); }
        if ((!isset($args['brandUser']) || is_null($args['brandUser']) || empty($args['brandUser']))) {} else { array_push($whr, "IFNULL(`brandUser`.`id`,0) IN (" . ($args['brandUser']) . ")"); }
        if ((!isset($args['campaigndraft']) || is_null($args['campaigndraft']) || empty($args['campaigndraft']))) {} else { array_push($whr, "IFNULL(`campaigndraft`.`id`,0) IN (" . ($args['campaigndraft']) . ")"); }
        $search = implode(' AND ', $whr);
        $query = $this->db->query("SELECT IFNULL(`pay_req`.`id`,0) AS `id`, IFNULL(`influencer`.`id`,0) AS `influencer.id`, IFNULL(`influencer`.`userName`,'') AS `influencer.name`, IFNULL(`influencer`.`userEmail`,'') AS `influencer.email`, IFNULL(`influencer`.`userPicUrl`,'') AS `influencer.pic`, IFNULL(`pay_req`.`amtReq`,0) AS `amount`, IFNULL(`pay_req`.`paidAt`,'') AS `paidAt`, IFNULL(`pay_req`.`refNo`,'') AS `refNo`, IFNULL(`campaign`.`id`,0) AS `campaign.id`, IFNULL(`campaign`.`campaignName`,'') AS `campaign.name`, IFNULL(`campaigntype`.`id`,0) AS `campaign.type.id`, IFNULL(`campaigntype`.`campaignTypeName`,'') AS `campaign.type.name`, IFNULL(`campaigntype`.`campaignTypePicUrl`,'') AS `campaign.type.logo`, IFNULL(`campaign`.`campaignPriority`,0) AS `campaign.priority`, IFNULL(`campaign`.`campaignStatus`,0) AS `campaign.status`, IFNULL(`brand`.`id`,0) AS `brand.id`, IFNULL(`brand`.`brandName`,'') AS `brand.name`, IFNULL(`brand`.`brandSupportEmail`,'') AS `brand.email`, IFNULL(`brand`.`brandLogoUrl`,'') AS `brand.logo`, IFNULL(`brandUser`.`id`,0) AS `brand.user.id`, IFNULL(`brandUser`.`userName`,'') AS `brand.user.name`, IFNULL(`brandUser`.`userEmail`,'') AS `brand.user.email`, IFNULL(`brandUser`.`userPicUrl`,'') AS `brand.user.pic`, IFNULL(`pay_req`.`status`,0) AS `status.code`, (CASE WHEN (IFNULL(`pay_req`.`status`,0)<=0) THEN ('NA') ELSE (CASE WHEN (IFNULL(`pay_req`.`status`,0)=1) THEN ('ACTIVE') ELSE (CASE WHEN (IFNULL(`pay_req`.`status`,0)>1) THEN ('INACTIVE') ELSE ('ERR') END) END) END) AS `status.name`, IFNULL(`pay_req`.`updatedAt`,NULL) AS `updatedAt` FROM `pay_req` LEFT JOIN `user` AS `influencer` ON `pay_req`.`userId`=`influencer`.`id` LEFT JOIN `campaign` ON `pay_req`.`campaignId`=`campaign`.`id` LEFT JOIN `campaigntype` ON `campaign`.`campaignTypeId`=`campaigntype`.`id` LEFT JOIN `brand` ON `campaign`.`brandId`=`brand`.`id` LEFT JOIN `user` AS `brandUser` ON `brand`.`adminUserId`=`brandUser`.`id` WHERE " . $search . " GROUP BY IFNULL(`pay_req`.`id`,0) ORDER BY IFNULL(`pay_req`.`status`,0) DESC, IFNULL(`pay_req`.`id`,0) DESC");
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }

    /**
     * Get the received payment details for a specific user and draft.
     *
     * @param int $userId
     * @param int $draftId
     * @return array
     */
    public function getRecived($userId = 0, $draftId = 0)
    {
        if ($userId <= 0) return [];
        if ($draftId <= 0) return [];
        $q = "SELECT draftId, userId, SUM(amtReq) as totalAmtReq FROM pay_req where draftId = " . $draftId . " AND userId = " . $userId . " AND paidAt IS NOT NUll GROUP BY draftId, userId;";
        $query = $this->db->query($q);
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result[0]), true));
        } else {
            return [];
        }
    }
 /**
  * Get the pending payment request for a specific user and draft.
  *
  * @param int $userId
  * @param int $draftId
  * @return array
  */
 public function getPending($userId = 0, $draftId = 0)
    {
        if ($userId <= 0) return [];
        if ($draftId <= 0) return [];
        $q = "SELECT draftId, userId, SUM(amtReq) as totalAmtReq FROM pay_req where draftId = " . $draftId . " AND userId = " . $userId . " AND status = 1 GROUP BY draftId, userId;";
        $query = $this->db->query($q);
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result[0]), true));
        } else {
            return [];
        }
    }

    /**
     * Get the payment status for a user.
     *
     * @param int $userId
     * @return array
     */
    public function getPaymentStatus($userId = 0)
    {
        if ($userId <= 0) return [];
        $q = "SELECT b.id AS brand_id ,c.campaignName AS campaign_name ,b.brandName, b.brandLogoUrl,SUM(p.amtReq) AS total_amount_requested, DATEDIFF(NOW(), MAX(p.createdAt)) AS days_since_payment_made FROM pay_req p JOIN brand b ON b.id = p.brandId JOIN campaign c ON c.id = p.campaignId where  userId = " . $userId . " GROUP BY p.campaignId";
        $query = $this->db->query($q);
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }
    /**
     * Get the payment graph data for a specific user.
     *
     * @param int $userId The ID of the user. Default is 0.
     * @return array The payment graph data in the form of an array.
     */
    public function getPaymentGraph($userId = 0)
    {
        if ($userId <= 0) return [];
    	$q = "SELECT userId, EXTRACT(year FROM createdAt) AS year, EXTRACT(month FROM createdAt) AS month, SUM(amtReq) AS total_earning FROM pay_req WHERE userId = " . $userId . " GROUP BY userId, year, month ORDER BY userId, year, month;";    
    $query = $this->db->query($q);
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }

}
