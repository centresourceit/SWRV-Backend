<?php

namespace app\Models;

use CodeIgniter\Model;

class CampaignModel extends Model
{

    /**
     * Create a new campaign with the given data.
     *
     * @param array $data
     * @return int The ID of the newly created campaign, or 0 if the data is empty or insertion fails.
     */
    public function createCampaign($data = array())
    {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('campaign');
            if ($builder->insert($data)) {
                return $this->db->insertID();
            } else {
                return 0;
            }
        }
    }

    /**
     * Create a new campaign attachment with the given data.
     *
     * @param array $data
     * @return int The ID of the newly created campaign attachment, or 0 if the data is not set or is null.
     */
    public function createCampaignAttachment($data = array())
    {
        if (!isset($data) || is_null($data)) {
            return 0;
        } else {
            $builder = $this->db->table('campaignattachment');
            if ($builder->insert($data)) {
                return $this->db->insertID();
            } else {
                return 0;
            }
        }
    }

    /**
     * Create an invite using the given data.
     *
     * @param array $data
     * @return int The ID of the created invite, or 0 if the data is empty or insertion fails.
     */
    public function createInvite($data = array())
    {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('campaignleaderboard');
            if ($builder->insert($data)) {
                return $this->db->insertID();
            } else {
                return 0;
            }
        }
    }

    /**
     * Update a campaign with the given data and ID.
     *
     * @param array $data
     * @param int $id
     * @return int The number of affected rows
     */
    public function updateCampaign($data = array(), $id = 0)
    {
        if (!isset($data) || is_null($data)) {
            return 0;
        } else {
            $builder = $this->db->table('campaign');
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
     * Find a campaign by its ID.
     *
     * @param int $id
     * @return array
     */
    public function findOneCampaign($id = 0)
    {
        if ($id <= 0) {
            return [];
        } else {
            $query = $this->db->query("SELECT IFNULL(`campaign`.`id`,0) AS `id`, IFNULL(`city`.`id`,0) AS `city.id`, IFNULL(`city`.`cityCode`,'') AS `city.code`, IFNULL(`city`.`cityName`,'') AS `city.name`, IFNULL(`state`.`id`,0) AS `city.state.id`, IFNULL(`state`.`stateCode`,'') AS `city.state.code`, IFNULL(`state`.`stateName`,'') AS `city.state.name`, IFNULL(`country`.`id`,0) AS `city.state.country.id`, IFNULL(`country`.`countryCode`,'') AS `city.state.country.code`, IFNULL(`country`.`countryName`,'') AS `city.state.country.name`, IFNULL(`campaign`.`brandId`,0) AS `brandId`, IFNULL(`campaign`.`campaignTypeId`,0) AS `campaignTypeId`, IFNULL(`campaigntype`.`campaignTypeCode`,'') AS `type.code`, IFNULL(`campaigntype`.`campaignTypeName`,'') AS `type.name`, IFNULL(`campaigntype`.`campaignTypeStatus`,0) AS `type.status`, IFNULL(`campaign`.`brandUserId`,0) AS `brandUserId`, IFNULL(`currency`.`id`,0) AS `currency.id`, IFNULL(`currency`.`currencyCode`,'') AS `currency.code`, IFNULL(`currency`.`currencyAsciiSymbol`,'') AS `currency.symbol`, IFNULL(`currency`.`currencyName`,'') AS `currency.name`, IFNULL(`currency`.`currencyRateInd`,0) AS `currency.rate`, IFNULL(`campaign`.`campaignName`,'') AS `name`,IFNULL(`campaign`.`plannedBudget`,'') AS `plannedBudget`,IFNULL(`campaign`.`totalTarget`,'') AS `totalTarget`,IFNULL(`campaign`.`minTarget`,'') AS `minTarget`, IFNULL(`campaign`.`campaignInfo`,'') AS `info`, IFNULL(`campaign`.`minEligibleRating`,0) AS `minEligibleRating`, IFNULL(`campaign`.`minReach`,0) AS `minReach`, IFNULL(`campaign`.`maxReach`,0) AS `maxReach`, IFNULL(`campaign`.`costPerPost`,0) AS `costPerPost`, IFNULL(`campaign`.`totalBudget`,0) AS `totalBudget`, IFNULL(`campaign`.`startAt`,'') AS `startAt`, IFNULL(`campaign`.`endAt`,'') AS `endAt`, IFNULL(`campaign`.`dos`,'') AS `dos`, IFNULL(`campaign`.`donts`,'') AS `donts`, IFNULL(`campaign`.`hashtags`,'') AS `hashtags`, IFNULL(`campaign`.`mentions`,'') AS `mentions`, IFNULL(`campaign`.`createdAt`,'') AS `createdAt` FROM `campaign` LEFT JOIN `city` ON `campaign`.`cityId`=`city`.`id` LEFT JOIN `state` ON `city`.`stateId`=`state`.`id` LEFT JOIN `country` ON `state`.`countryId`=`country`.`id` LEFT JOIN `currency` ON `campaign`.`currencyId`=`currency`.`id` LEFT JOIN `campaigntype` ON `campaign`.`campaignTypeId`=`campaigntype`.`id` WHERE `campaign`.`id` = " . $id . " GROUP BY `campaign`.`id` ORDER BY `campaign`.`id` DESC LIMIT 0,1");
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result[0]), true));
            } else {
                return [];
            }
        }
    }

    /**
     * Find campaigns by user ID.
     *
     * @param int $id
     * @return array
     */
    public function findCampaignsByUser($id = 0)
    {
        if ($id <= 0) {
            return [];
        } else {
            $query = $this->db->query("SELECT IFNULL(`campaign`.`id`,0) AS `id`, IFNULL(`city`.`id`,0) AS `city.id`, IFNULL(`city`.`cityCode`,'') AS `city.code`, IFNULL(`city`.`cityName`,'') AS `city.name`, IFNULL(`state`.`id`,0) AS `city.state.id`, IFNULL(`state`.`stateCode`,'') AS `city.state.code`, IFNULL(`state`.`stateName`,'') AS `city.state.name`, IFNULL(`country`.`id`,0) AS `city.state.country.id`, IFNULL(`country`.`countryCode`,'') AS `city.state.country.code`, IFNULL(`country`.`countryName`,'') AS `city.state.country.name`, IFNULL(`campaign`.`brandId`,0) AS `brandId`, IFNULL(`campaign`.`campaignTypeId`,0) AS `campaignTypeId`, IFNULL(`campaigntype`.`campaignTypeCode`,'') AS `type.code`, IFNULL(`campaigntype`.`campaignTypeName`,'') AS `type.name`, IFNULL(`campaigntype`.`campaignTypeStatus`,0) AS `type.status`, IFNULL(`campaign`.`brandUserId`,0) AS `brandUserId`, IFNULL(`currency`.`id`,0) AS `currency.id`, IFNULL(`currency`.`currencyCode`,'') AS `currency.code`, IFNULL(`currency`.`currencyAsciiSymbol`,'') AS `currency.symbol`, IFNULL(`currency`.`currencyName`,'') AS `currency.name`, IFNULL(`currency`.`currencyRateInd`,0) AS `currency.rate`, IFNULL(`campaign`.`campaignName`,'') AS `name`, IFNULL(`campaign`.`campaignInfo`,'') AS `info`, IFNULL(`campaign`.`minEligibleRating`,0) AS `minEligibleRating`, IFNULL(`campaign`.`minReach`,0) AS `minReach`, IFNULL(`campaign`.`maxReach`,0) AS `maxReach`, IFNULL(`campaign`.`costPerPost`,0) AS `costPerPost`, IFNULL(`campaign`.`totalBudget`,0) AS `totalBudget`, IFNULL(`campaign`.`startAt`,'') AS `startAt`, IFNULL(`campaign`.`endAt`,'') AS `endAt`, IFNULL(`campaign`.`dos`,'') AS `dos`, IFNULL(`campaign`.`donts`,'') AS `donts`, IFNULL(`campaign`.`hashtags`,'') AS `hashtags`, IFNULL(`campaign`.`mentions`,'') AS `mentions`, IFNULL(`campaign`.`createdAt`,'') AS `createdAt` FROM `campaign` LEFT JOIN `city` ON `campaign`.`cityId`=`city`.`id` LEFT JOIN `state` ON `city`.`stateId`=`state`.`id` LEFT JOIN `country` ON `state`.`countryId`=`country`.`id` LEFT JOIN `currency` ON `campaign`.`currencyId`=`currency`.`id` LEFT JOIN `campaigntype` ON `campaign`.`campaignTypeId`=`campaigntype`.`id` WHERE `campaign`.`brandUserId` = " . $id . " GROUP BY `campaign`.`id` ORDER BY `campaign`.`id` DESC");
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result), true));
            } else {
                return [];
            }
        }
    }
    /**
     * Get the top campaigns from the database.
     *
     * @return array
     */
    public function getTopCampaigns()
    {


        $query = $this->db->query("SELECT IFNULL(`campaign`.`id`,0) AS `id`, IFNULL(`city`.`id`,0) AS `city.id`, IFNULL(`city`.`cityCode`,'') AS `city.code`, IFNULL(`city`.`cityName`,'') AS `city.name`, IFNULL(`state`.`id`,0) AS `city.state.id`, IFNULL(`state`.`stateCode`,'') AS `city.state.code`, IFNULL(`state`.`stateName`,'') AS `city.state.name`, IFNULL(`country`.`id`,0) AS `city.state.country.id`, IFNULL(`country`.`countryCode`,'') AS `city.state.country.code`, IFNULL(`country`.`countryName`,'') AS `city.state.country.name`, IFNULL(`campaign`.`brandId`,0) AS `brandId`, IFNULL(`campaign`.`brandId`,0) AS `brand.id`, IFNULL(`brand`.`brandCode`,'') AS `code`, IFNULL(`brand`.`brandName`,'') AS `name`, IFNULL(`brand`.`brandFullRegisteredAddress`,'') AS `address`, IFNULL(`brand`.`brandSupportEmail`,'') AS `email`, IFNULL(`brand`.`brandSupportContact`,'') AS `contact`, IFNULL(`campaign`.`campaignTypeId`,0) AS `campaignTypeId`, IFNULL(`campaigntype`.`campaignTypeCode`,'') AS `type.code`, IFNULL(`campaigntype`.`campaignTypeName`,'') AS `type.name`, IFNULL(`campaigntype`.`campaignTypeStatus`,0) AS `type.status`, IFNULL(`campaign`.`brandUserId`,0) AS `brandUserId`, IFNULL(`currency`.`id`,0) AS `currency.id`, IFNULL(`currency`.`currencyCode`,'') AS `currency.code`, IFNULL(`currency`.`currencyAsciiSymbol`,'') AS `currency.symbol`, IFNULL(`currency`.`currencyName`,'') AS `currency.name`, IFNULL(`currency`.`currencyRateInd`,0) AS `currency.rate`, IFNULL(`campaign`.`campaignName`,'') AS `name`, IFNULL(`campaign`.`campaignInfo`,'') AS `info`, IFNULL(`campaign`.`minEligibleRating`,0) AS `minEligibleRating`, IFNULL(`campaign`.`minReach`,0) AS `minReach`, IFNULL(`campaign`.`maxReach`,0) AS `maxReach`, IFNULL(`campaign`.`costPerPost`,0) AS `costPerPost`, IFNULL(`campaign`.`totalBudget`,0) AS `totalBudget`, IFNULL(`campaign`.`startAt`,'') AS `startAt`, IFNULL(`campaign`.`endAt`,'') AS `endAt`, IFNULL(`campaign`.`dos`,'') AS `dos`, IFNULL(`campaign`.`donts`,'') AS `donts`, IFNULL(`campaign`.`hashtags`,'') AS `hashtags`, IFNULL(`campaign`.`mentions`,'') AS `mentions`, IFNULL(`campaign`.`createdAt`,'') AS `createdAt` FROM `campaign` LEFT JOIN `city` ON `campaign`.`cityId`=`city`.`id` LEFT JOIN `state` ON `city`.`stateId`=`state`.`id` LEFT JOIN `country` ON `state`.`countryId`=`country`.`id` LEFT JOIN `currency` ON `campaign`.`currencyId`=`currency`.`id` LEFT JOIN `campaigntype` ON `campaign`.`campaignTypeId`=`campaigntype`.`id` LEFT JOIN `brand` ON `campaign`.`brandId`=`brand`.`id` AND IFNULL(`brand`.`brandStatus`,0)=1 AND `brand`.`deletedAt` IS NULL WHERE `campaign`.`campaignPriority` = 99;");
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }


    /**
     * Find campaign attachments based on the given campaign ID and attachment type.
     *
     * @param int $id The campaign ID.
     * @param int $type The attachment type.
     * @return array The array of campaign attachments.
     */
    public function findCampaignAttachments($id = 0, $type = 0)
    {
        if ($id <= 0) {
            return [];
        } else {
            $query = $this->db->query("SELECT IFNULL(`campaignattachment`.`id`,0) AS `id`, IFNULL(`campaignattachment`.`campaignAttachmentType`,0) AS `type.id`, (CASE WHEN (IFNULL(`campaignattachment`.`campaignAttachmentType`,0)=3) THEN ('MOOD BOARD') ELSE ('ATTACHMENT') END) AS `type.name`, IFNULL(`campaignattachment`.`campaignAttachmentName`,'') AS `title`, IFNULL(`campaignattachment`.`campaignAttachmentUrl`,'') AS `url` FROM `campaignattachment` WHERE `campaignattachment`.`deletedAt` IS NULL AND `campaignattachment`.`campaignId` = " . $id . " AND `campaignattachment`.`campaignAttachmentType` = " . $type . " GROUP BY `campaignattachment`.`id` ORDER BY `campaignattachment`.`campaignAttachmentPriority` ASC, `campaignattachment`.`id` DESC");
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result), true));
            } else {
                return [];
            }
        }
    }

    /**
     * Search campaigns based on various parameters.
     *
     * @param int $id
     * @param string $name
     * @param int $platform
     * @param int $category
     * @param int $city
     * @param int $brand
     * @param int $type
     * @param int $user
     * @param int $currency
     * @param int $active
     * @param int $minReach
     * @param int $maxReach
     * @param int $costPerPost
     * @param int $minTarget
     * @param int $totalTarget
     * @param int $minRating
     * @param int $endDate
     * @param int $complete
     * @param int $isPublic
     */
    public function searchCampaigns($id = 0, $name = "", $platform = 0, $category = 0, $city = 0, $brand = 0, $type = 0, $user = 0, $currency = 0, $active = 0, $minReach = 0, $maxReach = 0, $costPerPost = 0, $minTarget = 0, $totalTarget = 0, $minRating, $endDate, $complete, $isPublic)
    {
        $searchArg = [];
        $search = "";
        if ($id != 0) {
            array_push($searchArg, ("`campaign`.`id` IN (" . $id . ")"));
        }
        if (!empty($name)) {
            array_push($searchArg, ("`campaign`.`campaignName` LIKE '%" . $name . "%'"));
        }
        if ($platform != 0) {
            array_push($searchArg, ("`platform`.`id` IN (" . $platform . ")"));
        }
        if ($minReach != 0) {
            array_push($searchArg, ("`campaign`.`minReach` IN (" . $minReach . ")"));
        }
        if ($maxReach != 0) {
            array_push($searchArg, ("`campaign`.`maxReach` IN (" . $maxReach . ")"));
        }
        if ($costPerPost != 0) {
            array_push($searchArg, ("`campaign`.`costPerPost` IN (" . $costPerPost . ")"));
        }
        if ($minTarget != 0) {
            array_push($searchArg, ("`campaign`.`minTarget` IN (" . $minTarget . ")"));
        }
        if ($totalTarget != 0) {
            array_push($searchArg, ("`campaign`.`totalTarget` IN (" . $totalTarget . ")"));
        }
        if ($category != 0) {
            array_push($searchArg, ("`category`.`id` IN (" . $category . ")"));
        }
        if ($city != 0) {
            array_push($searchArg, ("`city`.`id` IN (" . $city . ")"));
        }
        if ($brand != 0) {
            array_push($searchArg, ("`brand`.`id` IN (" . $brand . ")"));
        }
        if ($type != 0) {
            array_push($searchArg, ("`campaigntype`.`id` IN (" . $type . ")"));
        }
        if ($user != 0) {
            array_push($searchArg, ("`user`.`id` IN (" . $user . ")"));
        }
        if ($currency != 0) {
            array_push($searchArg, ("`currency`.`id` IN (" . $currency . ")"));
        }
        if ($currency != 0) {
            array_push($searchArg, ("`currency`.`id` IN (" . $currency . ")"));
        }
        if ($currency != 0) {
            array_push($minRating, ("`campaign`.`minEligibleRating` IN (" . $minRating . ")"));
        }
        if ($endDate != 0) {
            array_push($minRating, ("`campaign`.`endAt` IN (" . $endDate . ")"));
        }
        if ($active != 0) {
            array_push($searchArg, ("(CASE WHEN (IFNULL(`campaign`.`startAt`,CURRENT_TIMESTAMP)<CURRENT_TIMESTAMP AND IFNULL(`campaign`.`endAt`,CURRENT_TIMESTAMP)>CURRENT_TIMESTAMP) THEN (1) ELSE (0) END)=1"));
        }
        if ((is_null($searchArg)) || (empty($searchArg)) || (count($searchArg) <= 0)) {
            $search = "";
        } else {
            $search = " AND (" . implode(" AND ", $searchArg) . ")";
        }



        if ($complete) {
            $search .= " AND IFNULL(`campaign`.`endAt`, CURRENT_TIMESTAMP) > CURRENT_TIMESTAMP";
        }
        if (!empty($isPublic)) {
            array_push($searchArg, ("`campaign`.`isPublic` = '" . $isPublic . "'"));
        }
        $query = $this->db->query("SELECT `campaign`.*, IFNULL(`currency`.`currencyCode`,'') AS `currency.code`, IFNULL(`currency`.`currencyName`,'') AS `currency.name`, (CASE WHEN (IFNULL(`campaign`.`startAt`,CURRENT_TIMESTAMP)<CURRENT_TIMESTAMP AND IFNULL(`campaign`.`endAt`,CURRENT_TIMESTAMP)>CURRENT_TIMESTAMP) THEN (1) ELSE (0) END) AS `isActive` FROM `campaign` LEFT JOIN `city` ON `campaign`.`cityId`=`city`.`id` LEFT JOIN `brand` ON `campaign`.`brandId`=`brand`.`id` LEFT JOIN `campaigntype` ON `campaign`.`campaignTypeId`=`campaigntype`.`id` LEFT JOIN `user` ON `campaign`.`brandUserId`=`user`.`id` LEFT JOIN `currency` ON `campaign`.`currencyId`=`currency`.`id` LEFT JOIN `category` ON FIND_IN_SET(IFNULL(`category`.`id`,0),IFNULL(`campaign`.`categories`,'')) LEFT JOIN `platform` ON FIND_IN_SET(IFNULL(`platform`.`id`,0),IFNULL(`campaign`.`platforms`,'')) WHERE `campaign`.`deletedAt` IS NULL " . $search . " GROUP BY `campaign`.`id` ORDER BY `campaign`.`id` DESC LIMIT 0,19");
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }

    /**
     * Retrieve all campaigns from the database.
     *
     * @return array|null Returns an array of campaigns if there are any, otherwise returns null.
     */
    public function getCampaigns()
    {
        $query = $this->db->query("SELECT * FROM campaign;");
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return null;
        }
    }
    /**
     * Update the status of a campaign with the given ID.
     *
     * @param int $id The ID of the campaign to update.
     * @param mixed $status The new status to set for the campaign.
     * @return array The updated campaign data, or an empty array if the update was unsuccessful.
     */
    public function updateStauts($id = 0, $status)
    {
        if ($id <= 0) {
            return [];
        } elseif (!isset($status) || is_null($status)) {
            return [];
        } else {
            $q = "UPDATE `campaign` SET `campaignStatus` = " . $status . " WHERE `campaign`.`id` = " . $id . ";";
            $result = $this->db->query($q);
            if ($result && $this->db->affectedRows() > 0) {
                $q = "SELECT * FROM `campaign` WHERE `campaign`.`id` = " . $id . ";";
                $result1 = $this->db->query($q);
                $res = $result1->getResult();
                return $res;
            } else {
                return [];
            }
        }
    }

    /**
     * Retrieves geofencing campaigns based on the given latitude and longitude.
     *
     * @param float $lat The latitude value.
     * @param float $long The longitude value.
     * @return array An array of geofencing campaigns that match the given latitude and longitude.
     */
    public function geofencingCampaign($lat = 0, $long = 0)
    {
        if ($lat <= 0)
            return [];
        if ($long <= 0)
            return [];

        $q = "SELECT c.*, b.brandName, b.brandLogoUrl
        FROM campaign c JOIN brand b ON c.brandId = b.id WHERE (6371 * ACOS(COS(RADIANS(" . $lat . ")) * COS(RADIANS(c.geoLat)) * COS(RADIANS(c.geoLng) - RADIANS(" . $long . ")) + SIN(RADIANS(" . $lat . ")) * SIN(RADIANS(c.geoLat)))) <= c.geoRadiusKm;";

        $query = $this->db->query($q);
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }
}
