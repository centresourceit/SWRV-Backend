<?php

namespace app\Models;

use CodeIgniter\Model;

class InboxMsgModel extends Model {

    /**
     * Add a new record to the 'inbox_msg' table.
     *
     * @param array $data
     * @return int The ID of the inserted record, or 0 if the insertion fails or no data is provided.
     */
    public function addOne($data = array()) {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('inbox_msg');
            if ($builder->insert($data)) {
                return $this->db->insertID();
            } else {
                return 0;
            }
        }
    }

    /**
     * Edit a record in the 'inbox_msg' table with the given data and ID.
     *
     * @param array $data
     * @param int $id
     * @return int The number of affected rows
     */
    public function editOne($data = array(), $id = 0) {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('inbox_msg');
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
     * Get a single item from the database based on the given ID.
     *
     * @param int $id
     * @return array
     */
    public function getOne($id = 0) {
        if ($id <= 0) {
            return [];
        } else {
            $query = $this->db->query("SELECT `inbox_msg`.* FROM `inbox_msg` WHERE `inbox_msg`.`id` = " . $id . " GROUP BY `inbox_msg`.`id` ORDER BY `inbox_msg`.`id` DESC LIMIT 0,1");
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result[0]), true));
            } else {
                return [];
            }
        }
    }

    /**
     * Get all the inbox messages with their associated data.
     *
     * @return array
     */
    public function getAll() {
        $query = $this->db->query("SELECT IFNULL(`inbox_msg`.`id`,0) AS `id`, IFNULL(`fromUser`.`id`,0) AS `fromUser.id`, IFNULL(`fromUser`.`userName`,'') AS `fromUser.name`, IFNULL(`fromUser`.`userEmail`,'') AS `fromUser.email`, IFNULL(`fromUser`.`userPicUrl`,'') AS `fromUser.pic`, IFNULL(`toUser`.`id`,0) AS `toUser.id`, IFNULL(`toUser`.`userName`,'') AS `toUser.name`, IFNULL(`toUser`.`userEmail`,'') AS `toUser.email`, IFNULL(`toUser`.`userPicUrl`,'') AS `toUser.pic`, IFNULL(`influencer`.`id`,0) AS `influencer.id`, IFNULL(`influencer`.`userName`,'') AS `influencer.name`, IFNULL(`influencer`.`userEmail`,'') AS `influencer.email`, IFNULL(`influencer`.`userPicUrl`,'') AS `influencer.pic`, IFNULL(`campaign`.`id`,0) AS `campaign.id`, IFNULL(`campaign`.`campaignName`,'') AS `campaign.name`, IFNULL(`campaigntype`.`id`,0) AS `campaign.type.id`, IFNULL(`campaigntype`.`campaignTypeName`,'') AS `campaign.type.name`, IFNULL(`campaigntype`.`campaignTypePicUrl`,'') AS `campaign.type.logo`, IFNULL(`campaign`.`campaignPriority`,0) AS `campaign.priority`, IFNULL(`campaign`.`campaignStatus`,0) AS `campaign.status`, IFNULL(`brand`.`id`,0) AS `brand.id`, IFNULL(`brand`.`brandName`,'') AS `brand.name`, IFNULL(`brand`.`brandSupportEmail`,'') AS `brand.email`, IFNULL(`brand`.`brandLogoUrl`,'') AS `brand.logo`, IFNULL(`adminUser`.`id`,0) AS `adminUser.id`, IFNULL(`adminUser`.`userName`,'') AS `adminUser.name`, IFNULL(`adminUser`.`userEmail`,'') AS `adminUser.email`, IFNULL(`adminUser`.`userPicUrl`,'') AS `adminUser.pic`, IFNULL(`handle`.`id`,0) AS `handle.id`, IFNULL(`platform`.`id`,0) AS `handle.platform.id`, IFNULL(`platform`.`platformCode`,'') AS `handle.platform.code`, IFNULL(`platform`.`platformName`,'') AS `handle.platform.name`, IFNULL(`platform`.`platformPriority`,0) AS `handle.platform.priority`, IFNULL(`platform`.`platformStatus`,0) AS `handle.platform.status.code`, (CASE WHEN (IFNULL(`platform`.`platformStatus`,0)=1) THEN ('ACTIVE') ELSE ('INACTIVE') END) AS `handle.platform.status.name`, IFNULL(`platform`.`platformLogoUrl`,'') AS `handle.platform.logo`, IFNULL(`handle`.`handleName`,'') AS `handle.name`, IFNULL(`handle`.`handleStatus`,0) AS `handle.status.code`, (CASE WHEN (IFNULL(`handle`.`handleStatus`,0)=1) THEN ('ACTIVE') ELSE ('INACTIVE') END) AS `handle.status.name`, IFNULL(`handle`.`verifiedAt`,NULL) AS `handle.status.verifiedAt`, IFNULL(`inbox_msg`.`comment`,NULL) AS `comment`, IFNULL(`inbox_msg`.`attach01`,NULL) AS `attach01`, IFNULL(`inbox_msg`.`attach02`,NULL) AS `attach02`, IFNULL(`inbox_msg`.`attach03`,NULL) AS `attach03`, IFNULL(`inbox_msg`.`attach04`,NULL) AS `attach04`, IFNULL(`inbox_msg`.`attach05`,NULL) AS `attach05`, IFNULL(`inbox_msg`.`status`,0) AS `status.code`, (CASE WHEN (IFNULL(`inbox_msg`.`status`,0)=0) THEN ('NA') ELSE (CASE WHEN (IFNULL(`inbox_msg`.`status`,0)=1) THEN ('SENT') ELSE (CASE WHEN (IFNULL(`inbox_msg`.`status`,0)=3) THEN ('DELIVERED') ELSE (CASE WHEN (IFNULL(`inbox_msg`.`status`,0)=5) THEN ('READ') ELSE ('NA') END) END) END) END) AS `status.name`, IFNULL(`inbox_msg`.`updatedAt`,NULL) AS `updatedAt` FROM `inbox_msg` LEFT JOIN `user` AS `fromUser` ON `inbox_msg`.`fromUserId`=`fromUser`.`id` LEFT JOIN `user` AS `toUser` ON `inbox_msg`.`toUserId`=`toUser`.`id` LEFT JOIN `campaigndraft` ON `inbox_msg`.`campaignDraftId`=`campaigndraft`.`id` LEFT JOIN `user` AS `influencer` ON `campaigndraft`.`influencerId`=`influencer`.`id` LEFT JOIN `campaign` ON `campaigndraft`.`campaignId`=`campaign`.`id` LEFT JOIN `campaigntype` ON `campaign`.`campaignTypeId`=`campaigntype`.`id` LEFT JOIN `brand` ON `campaign`.`brandId`=`brand`.`id` LEFT JOIN `user` AS `adminUser` ON `brand`.`adminUserId`=`adminUser`.`id` LEFT JOIN `handle` ON `campaigndraft`.`handleId`=`handle`.`id` LEFT JOIN `platform` ON `handle`.`platformId`=`platform`.`id` WHERE `inbox_msg`.`deletedAt` IS NULL GROUP BY `inbox_msg`.`id` ORDER BY `inbox_msg`.`status` ASC, `inbox_msg`.`id` DESC");
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }

    /**
     * Search for inbox messages based on the given arguments.
     *
     * @param array $args
     * @return array
     */
    public function searchAll($args = array()) {
        $whr = ["`inbox_msg`.`deletedAt` IS NULL"];
        if ((!isset($args['id']) || is_null($args['id']) || empty($args['id']))) {} else { array_push($whr, "IFNULL(`inbox_msg`.`id`,0) IN (" . ($args['id']) . ")"); }
        if ((!isset($args['campaignDraft']) || is_null($args['campaignDraft']) || empty($args['campaignDraft']))) {} else { array_push($whr, "IFNULL(`campaigndraft`.`id`,0) IN (" . ($args['campaignDraft']) . ")"); }
        if ((!isset($args['influencer']) || is_null($args['influencer']) || empty($args['influencer']))) {} else { array_push($whr, "IFNULL(`influencer`.`id`,0) IN (" . ($args['influencer']) . ")"); }
        if ((!isset($args['campaign']) || is_null($args['campaign']) || empty($args['campaign']))) {} else { array_push($whr, "IFNULL(`campaign`.`id`,0) IN (" . ($args['campaign']) . ")"); }
        if ((!isset($args['brand']) || is_null($args['brand']) || empty($args['brand']))) {} else { array_push($whr, "(IFNULL(`brand`.`id`,0) IN (" . ($args['brand']) . ") OR IFNULL(`fromUserBrand`.`id`,'') IN (" . ($args['brand']) . ") OR IFNULL(`toUserBrand`.`id`,'') IN (" . ($args['brand']) . "))"); }
        if ((!isset($args['adminUser']) || is_null($args['adminUser']) || empty($args['adminUser']))) {} else { array_push($whr, "(IFNULL(`adminUser`.`id`,0) IN (" . ($args['adminUser']) . ") OR IFNULL(`fromUserBrand`.`adminUserId`,'') IN (" . ($args['adminUser']) . ") OR IFNULL(`toUserBrand`.`adminUserId`,'') IN (" . ($args['adminUser']) . "))"); }
        if ((!isset($args['platform']) || is_null($args['platform']) || empty($args['platform']))) {} else { array_push($whr, "IFNULL(`platform`.`id`,0) IN (" . ($args['platform']) . ")"); }
        if ((!isset($args['handle']) || is_null($args['handle']) || empty($args['handle']))) {} else { array_push($whr, "IFNULL(`handle`.`id`,0) IN (" . ($args['handle']) . ")"); }
        if ((!isset($args['fromUser']) || is_null($args['fromUser']) || empty($args['fromUser']))) {} else { array_push($whr, "IFNULL(`fromUser`.`id`,0) IN (" . ($args['fromUser']) . ")"); }
        if ((!isset($args['toUser']) || is_null($args['toUser']) || empty($args['toUser']))) {} else { array_push($whr, "IFNULL(`toUser`.`id`,0) IN (" . ($args['toUser']) . ")"); }
        if ((!isset($args['fromToUser']) || is_null($args['fromToUser']) || empty($args['fromToUser']))) {} else { array_push($whr, "(IFNULL(`toUser`.`id`,0) IN (" . ($args['fromToUser']) . ") OR IFNULL(`fromUser`.`id`,0) IN (" . ($args['fromToUser']) . "))"); }
        if ((!isset($args['status']) || is_null($args['status']) || empty($args['status']))) {} else { array_push($whr, "IFNULL(`inbox_msg`.`status`,0) IN (" . ($args['status']) . ")"); }
        $search = implode(' AND ', $whr);
        $query = $this->db->query("SELECT IFNULL(`inbox_msg`.`id`,0) AS `id`, IFNULL(`fromUser`.`id`,0) AS `fromUser.id`, IFNULL(`fromUser`.`userName`,'') AS `fromUser.name`, IFNULL(`fromUser`.`userEmail`,'') AS `fromUser.email`, IFNULL(`fromUser`.`userPicUrl`,'') AS `fromUser.pic`, IFNULL(`fromUserBrand`.`id`,'') AS `fromUser.brand.id`, IFNULL(`fromUserBrand`.`brandCode`,'') AS `fromUser.brand.code`, IFNULL(`fromUserBrand`.`brandLogoUrl`,'') AS `fromUser.brand.logo`, IFNULL(`fromUserBrand`.`brandName`,'') AS `fromUser.brand.name`, IFNULL(`fromUser`.`userRole`,0) AS `fromUser.role.code`, (CASE WHEN (IFNULL(`fromUser`.`userRole`,0)=50) THEN ('BRAND') ELSE (CASE WHEN (IFNULL(`fromUser`.`userRole`,0)=10) THEN ('INFLUENCER') ELSE ('NA') END) END) AS `fromUser.role.name`, IFNULL(`toUser`.`id`,0) AS `toUser.id`, IFNULL(`toUser`.`userName`,'') AS `toUser.name`, IFNULL(`toUser`.`userEmail`,'') AS `toUser.email`, IFNULL(`toUser`.`userPicUrl`,'') AS `toUser.pic`, IFNULL(`toUserBrand`.`id`,'') AS `toUser.brand.id`, IFNULL(`toUserBrand`.`brandCode`,'') AS `toUser.brand.code`, IFNULL(`toUserBrand`.`brandLogoUrl`,'') AS `toUser.brand.logo`, IFNULL(`toUserBrand`.`brandName`,'') AS `toUser.brand.name`, IFNULL(`toUser`.`userRole`,0) AS `toUser.role.code`, (CASE WHEN (IFNULL(`toUser`.`userRole`,0)=50) THEN ('BRAND') ELSE (CASE WHEN (IFNULL(`toUser`.`userRole`,0)=10) THEN ('INFLUENCER') ELSE ('NA') END) END) AS `toUser.role.name`, IFNULL(`influencer`.`id`,0) AS `influencer.id`, IFNULL(`influencer`.`userName`,'') AS `influencer.name`, IFNULL(`influencer`.`userEmail`,'') AS `influencer.email`, IFNULL(`influencer`.`userPicUrl`,'') AS `influencer.pic`, IFNULL(`campaign`.`id`,0) AS `campaign.id`, IFNULL(`campaign`.`campaignName`,'') AS `campaign.name`, IFNULL(`campaigntype`.`id`,0) AS `campaign.type.id`, IFNULL(`campaigntype`.`campaignTypeName`,'') AS `campaign.type.name`, IFNULL(`campaigntype`.`campaignTypePicUrl`,'') AS `campaign.type.logo`, IFNULL(`campaign`.`campaignPriority`,0) AS `campaign.priority`, IFNULL(`campaign`.`campaignStatus`,0) AS `campaign.status`, IFNULL(`brand`.`id`,0) AS `brand.id`, IFNULL(`brand`.`brandName`,'') AS `brand.name`, IFNULL(`brand`.`brandSupportEmail`,'') AS `brand.email`, IFNULL(`brand`.`brandLogoUrl`,'') AS `brand.logo`, IFNULL(`adminUser`.`id`,0) AS `adminUser.id`, IFNULL(`adminUser`.`userName`,'') AS `adminUser.name`, IFNULL(`adminUser`.`userEmail`,'') AS `adminUser.email`, IFNULL(`adminUser`.`userPicUrl`,'') AS `adminUser.pic`, IFNULL(`handle`.`id`,0) AS `handle.id`, IFNULL(`platform`.`id`,0) AS `handle.platform.id`, IFNULL(`platform`.`platformCode`,'') AS `handle.platform.code`, IFNULL(`platform`.`platformName`,'') AS `handle.platform.name`, IFNULL(`platform`.`platformPriority`,0) AS `handle.platform.priority`, IFNULL(`platform`.`platformStatus`,0) AS `handle.platform.status.code`, (CASE WHEN (IFNULL(`platform`.`platformStatus`,0)=1) THEN ('ACTIVE') ELSE ('INACTIVE') END) AS `handle.platform.status.name`, IFNULL(`platform`.`platformLogoUrl`,'') AS `handle.platform.logo`, IFNULL(`handle`.`handleName`,'') AS `handle.name`, IFNULL(`handle`.`handleStatus`,0) AS `handle.status.code`, (CASE WHEN (IFNULL(`handle`.`handleStatus`,0)=1) THEN ('ACTIVE') ELSE ('INACTIVE') END) AS `handle.status.name`, IFNULL(`handle`.`verifiedAt`,NULL) AS `handle.status.verifiedAt`, IFNULL(`inbox_msg`.`comment`,NULL) AS `comment`, IFNULL(`inbox_msg`.`attach01`,NULL) AS `attach01`, IFNULL(`inbox_msg`.`attach02`,NULL) AS `attach02`, IFNULL(`inbox_msg`.`attach03`,NULL) AS `attach03`, IFNULL(`inbox_msg`.`attach04`,NULL) AS `attach04`, IFNULL(`inbox_msg`.`attach05`,NULL) AS `attach05`, IFNULL(`inbox_msg`.`status`,0) AS `status.code`, (CASE WHEN (IFNULL(`inbox_msg`.`status`,0)=0) THEN ('NA') ELSE (CASE WHEN (IFNULL(`inbox_msg`.`status`,0)=1) THEN ('SENT') ELSE (CASE WHEN (IFNULL(`inbox_msg`.`status`,0)=3) THEN ('DELIVERED') ELSE (CASE WHEN (IFNULL(`inbox_msg`.`status`,0)=5) THEN ('READ') ELSE ('NA') END) END) END) END) AS `status.name`, IFNULL(`inbox_msg`.`updatedAt`,NULL) AS `updatedAt` FROM `inbox_msg` LEFT JOIN `user` AS `fromUser` ON `inbox_msg`.`fromUserId`=`fromUser`.`id` LEFT JOIN `brand` AS `fromUserBrand` ON `fromUser`.`brandId`=`fromUserBrand`.`id` LEFT JOIN `user` AS `toUser` ON `inbox_msg`.`toUserId`=`toUser`.`id` LEFT JOIN `brand` AS `toUserBrand` ON `toUser`.`brandId`=`toUserBrand`.`id` LEFT JOIN `campaigndraft` ON `inbox_msg`.`campaignDraftId`=`campaigndraft`.`id` LEFT JOIN `user` AS `influencer` ON `campaigndraft`.`influencerId`=`influencer`.`id` LEFT JOIN `campaign` ON `campaigndraft`.`campaignId`=`campaign`.`id` LEFT JOIN `campaigntype` ON `campaign`.`campaignTypeId`=`campaigntype`.`id` LEFT JOIN `brand` ON `campaign`.`brandId`=`brand`.`id` LEFT JOIN `user` AS `adminUser` ON `brand`.`adminUserId`=`adminUser`.`id` LEFT JOIN `handle` ON `campaigndraft`.`handleId`=`handle`.`id` LEFT JOIN `platform` ON `handle`.`platformId`=`platform`.`id` WHERE " . $search . " GROUP BY `inbox_msg`.`id` ORDER BY `inbox_msg`.`status` ASC, `inbox_msg`.`updatedAt` DESC");
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }

}
