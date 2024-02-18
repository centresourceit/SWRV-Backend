<?php

namespace app\Models;

use CodeIgniter\Model;

class CampaignDraftModel extends Model
{

    /**
     * Add a new record to the "campaigndraft" table.
     *
     * @param array $data
     * @return int The ID of the newly inserted record, or 0 if the insertion fails or no data is provided.
     */
    public function addOne($data = array())
    {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('campaigndraft');
            if ($builder->insert($data)) {
                return $this->db->insertID();
            } else {
                return 0;
            }
        }
    }

    /**
     * Edit a single record in the database table.
     *
     * @param array $data
     * @param int $id
     * @return int The number of affected rows
     */
    public function editOne($data = array(), $id = 0)
    {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('campaigndraft');
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
     * Get a single record from the database based on the given ID.
     *
     * @param int $id
     * @return array
     */
    public function getOne($id = 0)
    {
        if ($id <= 0) {
            return [];
        } else {
            $query = $this->db->query("SELECT `campaigndraft`.* FROM `campaigndraft` WHERE `campaigndraft`.`id` = " . $id . " GROUP BY `campaigndraft`.`id` ORDER BY `campaigndraft`.`id` DESC LIMIT 0,1");
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result[0]), true));
            } else {
                return [];
            }
        }
    }

    /**
     * Get all the campaign drafts from the database.
     *
     * @return array
     */
    public function getAll()
    {
        $query = $this->db->query("SELECT IFNULL(`campaigndraft`.`id`,0) AS `id`, IFNULL(`campaigndraft`.`influencerId`,0) AS `influencerId`, IFNULL(`influencer`.`id`,0) AS `influencer.id`, IFNULL(`influencer`.`userName`,'') AS `influencer.name`, IFNULL(`influencer`.`userEmail`,'') AS `influencer.email`, IFNULL(`influencer`.`userPicUrl`,'') AS `influencer.pic`, IFNULL(`campaigndraft`.`campaignId`,0) AS `campaignId`, IFNULL(`campaign`.`id`,0) AS `campaign.id`, IFNULL(`campaign`.`campaignName`,'') AS `campaign.name`, IFNULL(`campaigntype`.`id`,0) AS `campaign.type.id`, IFNULL(`campaigntype`.`campaignTypeName`,'') AS `campaign.type.name`, IFNULL(`campaigntype`.`campaignTypePicUrl`,'') AS `campaign.type.logo`, IFNULL(`campaign`.`campaignPriority`,0) AS `campaign.priority`, IFNULL(`campaign`.`campaignStatus`,0) AS `campaign.status`, IFNULL(`brand`.`id`,0) AS `brand.id`, IFNULL(`brand`.`brandName`,'') AS `brand.name`, IFNULL(`brand`.`brandSupportEmail`,'') AS `brand.email`, IFNULL(`brand`.`brandLogoUrl`,'') AS `brand.logo`, IFNULL(`adminUser`.`id`,0) AS `adminUser.id`, IFNULL(`adminUser`.`userName`,'') AS `adminUser.name`, IFNULL(`adminUser`.`userEmail`,'') AS `adminUser.email`, IFNULL(`adminUser`.`userPicUrl`,'') AS `adminUser.pic`, IFNULL(`campaigndraft`.`handleId`,0) AS `handleId`, IFNULL(`handle`.`id`,0) AS `handle.id`, IFNULL(`platform`.`id`,0) AS `handle.platform.id`, IFNULL(`platform`.`platformCode`,'') AS `handle.platform.code`, IFNULL(`platform`.`platformName`,'') AS `handle.platform.name`, IFNULL(`platform`.`platformPriority`,0) AS `handle.platform.priority`, IFNULL(`platform`.`platformStatus`,0) AS `handle.platform.status.code`, (CASE WHEN (IFNULL(`platform`.`platformStatus`,0)=1) THEN ('ACTIVE') ELSE ('INACTIVE') END) AS `handle.platform.status.name`, IFNULL(`platform`.`platformLogoUrl`,'') AS `handle.platform.logo`, IFNULL(`handle`.`handleName`,'') AS `handle.name`, IFNULL(`handle`.`handleStatus`,0) AS `handle.status.code`, (CASE WHEN (IFNULL(`handle`.`handleStatus`,0)=1) THEN ('ACTIVE') ELSE ('INACTIVE') END) AS `handle.status.name`, IFNULL(`handle`.`verifiedAt`,NULL) AS `handle.status.verifiedAt`, IFNULL(`campaigndraft`.`description`,NULL) AS `description`, IFNULL(`campaigndraft`.`rejectReason`,NULL) AS `rejectReason`, IFNULL(`campaigndraft`.`publishAt`,NULL) AS `publishAt`, IFNULL(`campaigndraft`.`attach01`,NULL) AS `attach01`, IFNULL(`campaigndraft`.`attach02`,NULL) AS `attach02`, IFNULL(`campaigndraft`.`attach03`,NULL) AS `attach03`, IFNULL(`campaigndraft`.`attach04`,NULL) AS `attach04`, IFNULL(`campaigndraft`.`attach05`,NULL) AS `attach05`, IFNULL(`campaigndraft`.`status`,0) AS `status.code`, IFNULL(`campaigndraft`.`rejectReason`,IFNULL(`campaigndraft`.`description`,NULL)) AS `status.message`, (CASE WHEN (IFNULL(`campaigndraft`.`status`,0)=0) THEN ('NA') ELSE (CASE WHEN (IFNULL(`campaigndraft`.`status`,0)=1) THEN ('PENDING') ELSE (CASE WHEN (IFNULL(`campaigndraft`.`status`,0)=3) THEN ('ACCEPTED') ELSE (CASE WHEN (IFNULL(`campaigndraft`.`status`,0)=5) THEN ('REJECTED') ELSE ('NA') END) END) END) END) AS `status.name`, IFNULL(`campaigndraft`.`acceptedAt`,NULL) AS `status.acceptedAt`, IFNULL(`campaigndraft`.`rejectedAt`,NULL) AS `status.rejectedAt`, IFNULL(`campaigndraft`.`createdAt`,NULL) AS `status.invitedAt`, IFNULL(`campaigndraft`.`updatedAt`,NULL) AS `updatedAt` FROM `campaigndraft` LEFT JOIN `user` AS `influencer` ON `campaigndraft`.`influencerId`=`influencer`.`id` LEFT JOIN `campaign` ON `campaigndraft`.`campaignId`=`campaign`.`id` LEFT JOIN `campaigntype` ON `campaign`.`campaignTypeId`=`campaigntype`.`id` LEFT JOIN `brand` ON `campaign`.`brandId`=`brand`.`id` LEFT JOIN `user` AS `adminUser` ON `brand`.`adminUserId`=`adminUser`.`id` LEFT JOIN `handle` ON `campaigndraft`.`handleId`=`handle`.`id` LEFT JOIN `platform` ON `handle`.`platformId`=`platform`.`id` WHERE `campaigndraft`.`deletedAt` IS NULL GROUP BY `campaigndraft`.`id` ORDER BY `campaigndraft`.`status` ASC, `campaigndraft`.`id` DESC");
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }

    /**
     * Search for campaign drafts based on the provided arguments.
     *
     * @param array $args
     * @return array
     */
    public function searchAll($args = array())
    {
        $whr = ["`campaigndraft`.`deletedAt` IS NULL"];
        if ((!isset($args['id']) || is_null($args['id']) || empty($args['id']))) {
        } else {
            array_push($whr, "IFNULL(`campaigndraft`.`id`,0) IN (" . ($args['id']) . ")");
        }
        if ((!isset($args['influencer']) || is_null($args['influencer']) || empty($args['influencer']))) {
        } else {
            array_push($whr, "IFNULL(`influencer`.`id`,0) IN (" . ($args['influencer']) . ")");
        }
        if ((!isset($args['campaign']) || is_null($args['campaign']) || empty($args['campaign']))) {
        } else {
            array_push($whr, "IFNULL(`campaign`.`id`,0) IN (" . ($args['campaign']) . ")");
        }
        if ((!isset($args['brand']) || is_null($args['brand']) || empty($args['brand']))) {
        } else {
            array_push($whr, "IFNULL(`brand`.`id`,0) IN (" . ($args['brand']) . ")");
        }
        if ((!isset($args['adminUser']) || is_null($args['adminUser']) || empty($args['adminUser']))) {
        } else {
            array_push($whr, "IFNULL(`adminUser`.`id`,0) IN (" . ($args['adminUser']) . ")");
        }
        if ((!isset($args['platform']) || is_null($args['platform']) || empty($args['platform']))) {
        } else {
            array_push($whr, "IFNULL(`platform`.`id`,0) IN (" . ($args['platform']) . ")");
        }
        if ((!isset($args['handle']) || is_null($args['handle']) || empty($args['handle']))) {
        } else {
            array_push($whr, "IFNULL(`handle`.`id`,0) IN (" . ($args['handle']) . ")");
        }
        if ((!isset($args['status']) || is_null($args['status']) || empty($args['status']))) {
        } else {
            array_push($whr, "IFNULL(`campaigndraft`.`status`,0) IN (" . ($args['status']) . ")");
        }
        $search = implode(' AND ', $whr);
        $query = $this->db->query("SELECT IFNULL(`campaigndraft`.`id`,0) AS `id`, IFNULL(`campaigndraft`.`influencerId`,0) AS `influencerId`, IFNULL(`influencer`.`id`,0) AS `influencer.id`, IFNULL(`influencer`.`userName`,'') AS `influencer.name`, IFNULL(`influencer`.`userEmail`,'') AS `influencer.email`, IFNULL(`influencer`.`userPicUrl`,'') AS `influencer.pic`, IFNULL(`campaigndraft`.`influencerRating`,0) AS `influencer.rating`, IFNULL(`campaigndraft`.`influencerReviewMessage`,'') AS `influencer.review`, IFNULL(`campaigndraft`.`campaignId`,0) AS `campaignId`, IFNULL(`campaign`.`id`,0) AS `campaign.id`, IFNULL(`campaign`.`campaignName`,'') AS `campaign.name`, IFNULL(`campaigntype`.`id`,0) AS `campaign.type.id`, IFNULL(`campaigntype`.`campaignTypeName`,'') AS `campaign.type.name`, IFNULL(`campaigntype`.`campaignTypePicUrl`,'') AS `campaign.type.logo`, IFNULL(`campaign`.`campaignPriority`,0) AS `campaign.priority`, IFNULL(`campaign`.`campaignStatus`,0) AS `campaign.status`, IFNULL(`brand`.`id`,0) AS `brand.id`, IFNULL(`brand`.`brandName`,'') AS `brand.name`, IFNULL(`brand`.`brandSupportEmail`,'') AS `brand.email`, IFNULL(`brand`.`brandLogoUrl`,'') AS `brand.logo`, IFNULL(`campaigndraft`.`brandRating`,0) AS `brand.rating`, IFNULL(`campaigndraft`.`brandReviewMessage`,'') AS `brand.review`, IFNULL(`adminUser`.`id`,0) AS `adminUser.id`, IFNULL(`adminUser`.`userName`,'') AS `adminUser.name`, IFNULL(`adminUser`.`userEmail`,'') AS `adminUser.email`, IFNULL(`adminUser`.`userPicUrl`,'') AS `adminUser.pic`, IFNULL(`campaigndraft`.`handleId`,0) AS `handleId`, IFNULL(`handle`.`id`,0) AS `handle.id`, IFNULL(`platform`.`id`,0) AS `handle.platform.id`, IFNULL(`platform`.`platformCode`,'') AS `handle.platform.code`, IFNULL(`platform`.`platformName`,'') AS `handle.platform.name`, IFNULL(`platform`.`platformPriority`,0) AS `handle.platform.priority`, IFNULL(`platform`.`platformStatus`,0) AS `handle.platform.status.code`, (CASE WHEN (IFNULL(`platform`.`platformStatus`,0)=1) THEN ('ACTIVE') ELSE ('INACTIVE') END) AS `handle.platform.status.name`, IFNULL(`platform`.`platformLogoUrl`,'') AS `handle.platform.logo`, IFNULL(`handle`.`handleName`,'') AS `handle.name`, IFNULL(`handle`.`handleStatus`,0) AS `handle.status.code`, (CASE WHEN (IFNULL(`handle`.`handleStatus`,0)=1) THEN ('ACTIVE') ELSE ('INACTIVE') END) AS `handle.status.name`, IFNULL(`handle`.`verifiedAt`,NULL) AS `handle.status.verifiedAt`, IFNULL(`campaigndraft`.`description`,NULL) AS `description`, IFNULL(`campaigndraft`.`rejectReason`,NULL) AS `rejectReason`, IFNULL(`campaigndraft`.`linkCampaign`,NULL) AS `linkCampaign`, IFNULL(`campaigndraft`.`draft_approval`,NULL) AS `draft_approval`,IFNULL(`campaigndraft`.`publication_time`,NULL) AS `publication_time`,IFNULL(`campaigndraft`.`target_react`,NULL) AS `target_react`,IFNULL(`campaigndraft`.`reachStatus`,NULL) AS `reachStatus`,IFNULL(`campaigndraft`.`publication_type`,NULL) AS `publication_type`, IFNULL(`campaigndraft`.`publishAt`,NULL) AS `publishAt`, IFNULL(`campaigndraft`.`attach01`,NULL) AS `attach01`, IFNULL(`campaigndraft`.`attach02`,NULL) AS `attach02`, IFNULL(`campaigndraft`.`attach03`,NULL) AS `attach03`, IFNULL(`campaigndraft`.`attach04`,NULL) AS `attach04`, IFNULL(`campaigndraft`.`attach05`,NULL) AS `attach05`, IFNULL(`campaigndraft`.`status`,0) AS `status.code`, IFNULL(`campaigndraft`.`rejectReason`,IFNULL(`campaigndraft`.`description`,NULL)) AS `status.message`, (CASE WHEN (IFNULL(`campaigndraft`.`status`,0)=0) THEN ('NA') ELSE (CASE WHEN (IFNULL(`campaigndraft`.`status`,0)=1) THEN ('PENDING') ELSE (CASE WHEN (IFNULL(`campaigndraft`.`status`,0)=3) THEN ('ACCEPTED') ELSE (CASE WHEN (IFNULL(`campaigndraft`.`status`,0)=5) THEN ('REJECTED') ELSE ('NA') END) END) END) END) AS `status.name`, IFNULL(`campaigndraft`.`acceptedAt`,NULL) AS `status.acceptedAt`, IFNULL(`campaigndraft`.`rejectedAt`,NULL) AS `status.rejectedAt`, IFNULL(`campaigndraft`.`createdAt`,NULL) AS `status.invitedAt`, IFNULL(`campaigndraft`.`updatedAt`,NULL) AS `updatedAt`, IFNULL(`campaigndraft`.`draft_approval`,NULL) AS `draft_approval` FROM `campaigndraft` LEFT JOIN `user` AS `influencer` ON `campaigndraft`.`influencerId`=`influencer`.`id` LEFT JOIN `campaign` ON `campaigndraft`.`campaignId`=`campaign`.`id` LEFT JOIN `campaigntype` ON `campaign`.`campaignTypeId`=`campaigntype`.`id` LEFT JOIN `brand` ON `campaign`.`brandId`=`brand`.`id` LEFT JOIN `user` AS `adminUser` ON `brand`.`adminUserId`=`adminUser`.`id` LEFT JOIN `handle` ON `campaigndraft`.`handleId`=`handle`.`id` LEFT JOIN `platform` ON `handle`.`platformId`=`platform`.`id` WHERE " . $search . " GROUP BY `campaigndraft`.`id` ORDER BY `campaigndraft`.`status` ASC, `campaigndraft`.`id` DESC");
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }
}
