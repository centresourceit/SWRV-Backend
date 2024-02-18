<?php

namespace app\Models;

use CodeIgniter\Model;

class CampaignInviteModel extends Model
{
    /**
     * Add a new record to the "campaigninvite" table.
     *
     * @param array $data
     * @return int The ID of the newly inserted record, or 0 if the insertion fails or no data is provided.
     */
    public function addOne($data = array())
    {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('campaigninvite');
            if ($builder->insert($data)) {
                return $this->db->insertID();
            } else {
                return 0;
            }
        }
    }

    /**
     * Edit a record in the database table 'campaigninvite' with the given data and ID.
     *
     * @param array $data
     * @param int $id
     * @return int The number of affected rows in the database table.
     */
    public function editOne($data = array(), $id = 0)
    {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('campaigninvite');
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
     * Get the record with the specified ID from the "campaigninvite" table.
     *
     * @param int $id
     * @return array
     */
    public function getOne($id = 0)
    {
        if ($id <= 0) {
            return [];
        } else {
            $query = $this->db->query("SELECT `campaigninvite`.* FROM `campaigninvite` WHERE `campaigninvite`.`id` = " . $id . " GROUP BY `campaigninvite`.`id` ORDER BY `campaigninvite`.`id` DESC LIMIT 0,1");
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result[0]), true));
            } else {
                return [];
            }
        }
    }

    /**
     * Get all campaign invites with related information from the database.
     *
     * @return array
     */
    public function getAll()
    {
        $query = $this->db->query("SELECT IFNULL(`campaigninvite`.`id`,0) AS `id`, IFNULL(`campaigninvite`.`influencerId`,0) AS `influencerId`, IFNULL(`influencer`.`id`,0) AS `influencer.id`, IFNULL(`influencer`.`userName`,'') AS `influencer.name`, IFNULL(`influencer`.`userEmail`,'') AS `influencer.email`, IFNULL(`influencer`.`userPicUrl`,'') AS `influencer.pic`, IFNULL(`campaigninvite`.`campaignId`,0) AS `campaignId`, IFNULL(`campaign`.`id`,0) AS `campaign.id`, IFNULL(`campaign`.`campaignName`,'') AS `campaign.name`, IFNULL(`campaigntype`.`id`,0) AS `campaign.type.id`, IFNULL(`campaigntype`.`campaignTypeName`,'') AS `campaign.type.name`, IFNULL(`campaigntype`.`campaignTypePicUrl`,'') AS `campaign.type.logo`, IFNULL(`campaign`.`campaignPriority`,0) AS `campaign.priority`, IFNULL(`campaign`.`campaignStatus`,0) AS `campaign.status`, IFNULL(`brand`.`id`,0) AS `brand.id`, IFNULL(`brand`.`brandName`,'') AS `brand.name`, IFNULL(`brand`.`brandSupportEmail`,'') AS `brand.email`, IFNULL(`brand`.`brandLogoUrl`,'') AS `brand.logo`, IFNULL(`adminUser`.`id`,0) AS `adminUser.id`, IFNULL(`adminUser`.`userName`,'') AS `adminUser.name`, IFNULL(`adminUser`.`userEmail`,'') AS `adminUser.email`, IFNULL(`adminUser`.`userPicUrl`,'') AS `adminUser.pic`, IFNULL(`campaigninvite`.`fromUserId`,0) AS `fromUserId`, IFNULL(`fromUser`.`id`,0) AS `fromUser.id`, IFNULL(`fromUser`.`userName`,'') AS `fromUser.name`, IFNULL(`campaigninvite`.`toUserId`,0) AS `toUserId`, IFNULL(`toUser`.`id`,0) AS `toUser.id`, IFNULL(`toUser`.`userName`,'') AS `toUser.name`, IFNULL(`campaigninvite`.`inviteMessage`,NULL) AS `inviteMessage`, IFNULL(`campaigninvite`.`rejectReason`,NULL) AS `rejectReason`, IFNULL(`campaigninvite`.`status`,0) AS `status.code`, IFNULL(`campaigninvite`.`rejectReason`,IFNULL(`campaigninvite`.`inviteMessage`,NULL)) AS `status.message`, (CASE WHEN (IFNULL(`campaigninvite`.`status`,0)=0) THEN ('NA') ELSE (CASE WHEN (IFNULL(`campaigninvite`.`status`,0)=1) THEN ('PENDING') ELSE (CASE WHEN (IFNULL(`campaigninvite`.`status`,0)=3) THEN ('ACCEPTED') ELSE (CASE WHEN (IFNULL(`campaigninvite`.`status`,0)=5) THEN ('REJECTED') ELSE ('NA') END) END) END) END) AS `status.name`, IFNULL(`campaigninvite`.`acceptedAt`,NULL) AS `status.acceptedAt`, IFNULL(`campaigninvite`.`rejectedAt`,NULL) AS `status.rejectedAt`, IFNULL(`campaigninvite`.`createdAt`,NULL) AS `status.invitedAt`, IFNULL(`campaigninvite`.`updatedAt`,NULL) AS `updatedAt` FROM `campaigninvite` LEFT JOIN `user` AS `influencer` ON `campaigninvite`.`influencerId`=`influencer`.`id` LEFT JOIN `campaign` ON `campaigninvite`.`campaignId`=`campaign`.`id` LEFT JOIN `campaigntype` ON `campaign`.`campaignTypeId`=`campaigntype`.`id` LEFT JOIN `brand` ON `campaign`.`brandId`=`brand`.`id` LEFT JOIN `user` AS `adminUser` ON `brand`.`adminUserId`=`adminUser`.`id` LEFT JOIN `user` AS `fromUser` ON `campaigninvite`.`fromUserId`=`fromUser`.`id` LEFT JOIN `user` AS `toUser` ON `campaigninvite`.`toUserId`=`toUser`.`id` WHERE `campaigninvite`.`deletedAt` IS NULL GROUP BY `campaigninvite`.`id` ORDER BY `campaigninvite`.`status` ASC, `campaigninvite`.`id` DESC");
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }

    /**
     * Search for campaign invites based on the given arguments.
     *
     * @param array $args
     * @return array
     */
    public function searchAll($args = array())
    {
        $whr = ["`campaigninvite`.`deletedAt` IS NULL"];
        if ((!isset($args['id']) || is_null($args['id']) || empty($args['id']))) {
        } else {
            array_push($whr, "IFNULL(`campaigninvite`.`id`,0) IN (" . ($args['id']) . ")");
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
        if ((!isset($args['fromUser']) || is_null($args['fromUser']) || empty($args['fromUser']))) {
        } else {
            array_push($whr, "IFNULL(`fromUser`.`id`,0) IN (" . ($args['fromUser']) . ")");
        }
        if ((!isset($args['toUser']) || is_null($args['toUser']) || empty($args['toUser']))) {
        } else {
            array_push($whr, "IFNULL(`toUser`.`id`,0) IN (" . ($args['toUser']) . ")");
        }
        if ((!isset($args['status']) || is_null($args['status']) || empty($args['status']))) {
        } else {
            array_push($whr, "IFNULL(`campaigninvite`.`status`,0) IN (" . ($args['status']) . ")");
        }
        $search = implode(' AND ', $whr);
        $query = $this->db->query("SELECT IFNULL(`campaigninvite`.`id`,0) AS `id`, IFNULL(`campaigninvite`.`influencerId`,0) AS `influencerId`, IFNULL(`influencer`.`id`,0) AS `influencer.id`, IFNULL(`influencer`.`userName`,'') AS `influencer.name`, IFNULL(`influencer`.`userEmail`,'') AS `influencer.email`, IFNULL(`influencer`.`userPicUrl`,'') AS `influencer.pic`, IFNULL(`campaigninvite`.`campaignId`,0) AS `campaignId`, IFNULL(`campaign`.`id`,0) AS `campaign.id`, IFNULL(`campaign`.`campaignName`,'') AS `campaign.name`, IFNULL(`campaigntype`.`id`,0) AS `campaign.type.id`, IFNULL(`campaigntype`.`campaignTypeName`,'') AS `campaign.type.name`, IFNULL(`campaigntype`.`campaignTypePicUrl`,'') AS `campaign.type.logo`, IFNULL(`campaign`.`campaignPriority`,0) AS `campaign.priority`, IFNULL(`campaign`.`campaignStatus`,0) AS `campaign.status`, IFNULL(`campaign`.`endAt`,0) AS `campaign.endAt`, IFNULL(`brand`.`id`,0) AS `brand.id`, IFNULL(`brand`.`brandName`,'') AS `brand.name`, IFNULL(`brand`.`brandSupportEmail`,'') AS `brand.email`, IFNULL(`brand`.`brandLogoUrl`,'') AS `brand.logo`, IFNULL(`adminUser`.`id`,0) AS `adminUser.id`, IFNULL(`adminUser`.`userName`,'') AS `adminUser.name`, IFNULL(`adminUser`.`userEmail`,'') AS `adminUser.email`, IFNULL(`adminUser`.`userPicUrl`,'') AS `adminUser.pic`, IFNULL(`campaigninvite`.`fromUserId`,0) AS `fromUserId`, IFNULL(`fromUser`.`id`,0) AS `fromUser.id`, IFNULL(`fromUser`.`userName`,'') AS `fromUser.name`, IFNULL(`campaigninvite`.`toUserId`,0) AS `toUserId`, IFNULL(`toUser`.`id`,0) AS `toUser.id`, IFNULL(`toUser`.`userName`,'') AS `toUser.name`, IFNULL(`campaigninvite`.`inviteMessage`,NULL) AS `inviteMessage`, IFNULL(`campaigninvite`.`rejectReason`,NULL) AS `rejectReason`, IFNULL(`campaigninvite`.`status`,0) AS `status.code`, IFNULL(`campaigninvite`.`rejectReason`,IFNULL(`campaigninvite`.`inviteMessage`,NULL)) AS `status.message`, (CASE WHEN (IFNULL(`campaigninvite`.`status`,0)=0) THEN ('NA') ELSE (CASE WHEN (IFNULL(`campaigninvite`.`status`,0)=1) THEN ('PENDING') ELSE (CASE WHEN (IFNULL(`campaigninvite`.`status`,0)=3) THEN ('ACCEPTED') ELSE (CASE WHEN (IFNULL(`campaigninvite`.`status`,0)=5) THEN ('REJECTED') ELSE ('NA') END) END) END) END) AS `status.name`, IFNULL(`campaigninvite`.`acceptedAt`,NULL) AS `status.acceptedAt`, IFNULL(`campaigninvite`.`rejectedAt`,NULL) AS `status.rejectedAt`, IFNULL(`campaigninvite`.`createdAt`,NULL) AS `status.invitedAt`, IFNULL(`campaigninvite`.`updatedAt`,NULL) AS `updatedAt` FROM `campaigninvite` LEFT JOIN `user` AS `influencer` ON `campaigninvite`.`influencerId`=`influencer`.`id` LEFT JOIN `campaign` ON `campaigninvite`.`campaignId`=`campaign`.`id` LEFT JOIN `campaigntype` ON `campaign`.`campaignTypeId`=`campaigntype`.`id` LEFT JOIN `brand` ON `campaign`.`brandId`=`brand`.`id` LEFT JOIN `user` AS `adminUser` ON `brand`.`adminUserId`=`adminUser`.`id` LEFT JOIN `user` AS `fromUser` ON `campaigninvite`.`fromUserId`=`fromUser`.`id` LEFT JOIN `user` AS `toUser` ON `campaigninvite`.`toUserId`=`toUser`.`id` WHERE " . $search . " GROUP BY `campaigninvite`.`id` ORDER BY `campaigninvite`.`status` ASC, `campaigninvite`.`id` DESC");
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }
}
