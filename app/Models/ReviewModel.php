<?php

namespace app\Models;

use CodeIgniter\Model;

class ReviewModel extends Model {

    /**
     * Add a new record to the 'review' table.
     *
     * @param array $data
     * @return int The ID of the inserted record, or 0 if the insertion fails or no data is provided.
     */
    public function addOne($data = array()) {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('review');
            if ($builder->insert($data)) {
                return $this->db->insertID();
            } else {
                return 0;
            }
        }
    }

    /**
     * Edit a record in the 'review' table with the given data and ID.
     *
     * @param array $data
     * @param int $id
     * @return int The number of affected rows
     */
    public function editOne($data = array(), $id = 0) {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('review');
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
     * Search for reviews based on the given arguments.
     *
     * @param array $args
     * @return array
     */
    public function searchAll($args = array()) {
        $whr = ["`review`.`deletedAt` IS NULL"];
        if ((!isset($args['id']) || is_null($args['id']) || empty($args['id']))) {} else { array_push($whr, "IFNULL(`review`.`id`,0) IN (" . ($args['id']) . ")"); }
        if ((!isset($args['type']) || is_null($args['type']) || empty($args['type']))) {} else { array_push($whr, "IFNULL(`review`.`reviewType`,0) IN (" . ($args['type']) . ")"); }
        if ((!isset($args['influencer']) || is_null($args['influencer']) || empty($args['influencer']))) {} else { array_push($whr, "IFNULL(`influencer`.`id`,0) IN (" . ($args['influencer']) . ")"); }
        if ((!isset($args['campaign']) || is_null($args['campaign']) || empty($args['campaign']))) {} else { array_push($whr, "IFNULL(`campaign`.`id`,0) IN (" . ($args['campaign']) . ")"); }
        if ((!isset($args['brand']) || is_null($args['brand']) || empty($args['brand']))) {} else { array_push($whr, "IFNULL(`brand`.`id`,0) IN (" . ($args['brand']) . ")"); }
        $search = implode(' AND ', $whr);
        $query = $this->db->query("SELECT IFNULL(`review`.`id`,0) AS `id`, IFNULL(`influencer`.`id`,0) AS `influencer.id`, IFNULL(`influencer`.`userName`,'') AS `influencer.name`, IFNULL(`influencer`.`userEmail`,'') AS `influencer.email`, IFNULL(`influencer`.`userPicUrl`,'') AS `influencer.pic`, IFNULL(`review`.`reviewType`,0) AS `type.code`, (CASE WHEN (IFNULL(`review`.`reviewType`,0)<=0) THEN ('NA') ELSE (CASE WHEN (IFNULL(`review`.`reviewType`,0)=1) THEN ('BRAND TO INFLUENCER') ELSE (CASE WHEN (IFNULL(`review`.`reviewType`,0)=2) THEN ('INFLUENCER TO BRAND') ELSE (CASE WHEN (IFNULL(`review`.`reviewType`,0)=3) THEN ('INFLUENCER TO CAMPAIGN') ELSE ('ERR') END) END) END) END) AS `type.name`, IFNULL(`campaign`.`id`,0) AS `campaign.id`, IFNULL(`campaign`.`campaignName`,'') AS `campaign.name`, IFNULL(`campaigntype`.`id`,0) AS `campaign.type.id`, IFNULL(`campaigntype`.`campaignTypeName`,'') AS `campaign.type.name`, IFNULL(`campaigntype`.`campaignTypePicUrl`,'') AS `campaign.type.logo`, IFNULL(`campaign`.`campaignPriority`,0) AS `campaign.priority`, IFNULL(`campaign`.`campaignStatus`,0) AS `campaign.status`, IFNULL(`brand`.`id`,0) AS `brand.id`, IFNULL(`brand`.`brandName`,'') AS `brand.name`, IFNULL(`brand`.`brandSupportEmail`,'') AS `brand.email`, IFNULL(`brand`.`brandLogoUrl`,'') AS `brand.logo`, IFNULL(`brandUser`.`id`,0) AS `brand.user.id`, IFNULL(`brandUser`.`userName`,'') AS `brand.user.name`, IFNULL(`brandUser`.`userEmail`,'') AS `brand.user.email`, IFNULL(`brandUser`.`userPicUrl`,'') AS `brand.user.pic`, IFNULL(`review`.`remark`,'') AS `remark`, IFNULL(`review`.`rating1`,0) AS `rating1`, IFNULL(`review`.`rating2`,0) AS `rating2`, IFNULL(`review`.`rating3`,0) AS `rating3`, IFNULL(`review`.`priority`,0) AS `priority`, IFNULL(`review`.`status`,0) AS `status.code`, (CASE WHEN (IFNULL(`review`.`status`,0)<=0) THEN ('NA') ELSE (CASE WHEN (IFNULL(`review`.`status`,0)=1) THEN ('ACTIVE') ELSE (CASE WHEN (IFNULL(`review`.`status`,0)>1) THEN ('INACTIVE') ELSE ('ERR') END) END) END) AS `status.name`, IFNULL(`review`.`updatedAt`,NULL) AS `updatedAt` FROM `review` LEFT JOIN `user` AS `influencer` ON `review`.`influencerId`=`influencer`.`id` LEFT JOIN `brand` ON `review`.`brandId`=`brand`.`id` LEFT JOIN `user` AS `brandUser` ON `brand`.`adminUserId`=`brandUser`.`id` LEFT JOIN `campaign` ON `review`.`campaignId`=`campaign`.`id` LEFT JOIN `campaigntype` ON `campaign`.`campaignTypeId`=`campaigntype`.`id` WHERE " . $search . " GROUP BY IFNULL(`review`.`id`,0) ORDER BY IFNULL(`review`.`priority`,9999) ASC, IFNULL(`review`.`id`,0) DESC");
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }

 /**
  * Get the user review for a given user ID.
  *
  * @param int $userId
  * @return array
  */
 public function getUserReview($userId = 0)
    {
        if ($userId <= 0) return [];
         $q = "SELECT review.brandId, brand.brandName, brand.brandLogoUrl, AVG(review.rating1) AS avg_rating1, AVG(review.rating2) AS avg_rating2, AVG(review.rating3) AS avg_rating3 FROM review JOIN brand ON review.brandId = brand.id AND reviewType = 1 where  influencerId = " . $userId . " GROUP BY review.brandId, brand.brandName, brand.brandLogoUrl;";
        $query = $this->db->query($q);
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }

}
