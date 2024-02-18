<?php

namespace app\Models;

use CodeIgniter\Model;

class BrandModel extends Model
{

    /**
     * Create a new brand record in the database.
     *
     * @param array $data
     * @return int The ID of the newly created brand, or 0 if the creation fails or no data is provided.
     */
    public function createBrand($data = array())
    {
        if (!isset($data) || is_null($data) || count($data) <= 0) {
            return 0;
        } else {
            $builder = $this->db->table('brand');
            if ($builder->insert($data)) {
                return $this->db->insertID();
            } else {
                return 0;
            }
        }
    }

    /**
     * Update the brand with the given data and ID.
     *
     * @param array $data
     * @param int $id
     * @return int The number of affected rows
     */
    /**
     * Update the brand with the given data and ID.
     *
     * @param array $data
     * @param int $id
     * @return int The number of affected rows
     */
    public function updateBrand($data = array(), $id = 0)
    {
        if (!isset($data) || is_null($data)) {
            die("two");
            return 0;
        } else {
            $builder = $this->db->table('brand');
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
     * Find a brand by its ID.
     *
     * @param int $id
     * @return array
     */
    public function findOneBrand($id = 0)
    {
        if ($id <= 0) {
            return [];
        } else {
            $query = $this->db->query("SELECT IFNULL(`brand`.`id`,0) AS `id`, IFNULL(`city`.`id`,0) AS `city.id`, IFNULL(`city`.`cityCode`,'') AS `city.code`, IFNULL(`city`.`cityName`,'') AS `city.name`, IFNULL(`state`.`id`,0) AS `city.state.id`, IFNULL(`state`.`stateCode`,'') AS `city.state.code`, IFNULL(`state`.`stateName`,'') AS `city.state.name`, IFNULL(`country`.`id`,0) AS `city.state.country.id`, IFNULL(`country`.`countryCode`,'') AS `city.state.country.code`, IFNULL(`country`.`countryName`,'') AS `city.state.country.name`, IFNULL(`brand`.`brandCode`,'') AS `code`, IFNULL(`brand`.`brandName`,'') AS `name`, IFNULL(`brand`.`brandFullRegisteredAddress`,'') AS `address`,IFNULL(`brand`.`banner`,'') AS `banner`, IFNULL(`brand`.`brandSupportEmail`,'') AS `email`,IFNULL(`brand`.`comapnyBio`,'') AS `companyinfo`, IFNULL(`brand`.`brandSupportContact`,'') AS `contact`, IFNULL(`brand`.`brandWebUrl`,'') AS `webUrl`, IFNULL(`brand`.`brandBioInfo`,'') AS `info`, IFNULL(`brand`.`brandLogoUrl`,'') AS `logo`,IFNULL(`brand`.`banner`,'') AS `banner`, IFNULL(`brand`.`brandStatus`,0) AS `status.code`, (CASE WHEN (IFNULL(`brand`.`brandStatus`,0)=0) THEN ('NA') ELSE (CASE WHEN (IFNULL(`brand`.`brandStatus`,0)=1) THEN ('ACTIVE') ELSE (CASE WHEN (IFNULL(`brand`.`brandStatus`,0)=2) THEN ('INACTIVE') ELSE (CASE WHEN (IFNULL(`brand`.`brandStatus`,0)=3) THEN ('CAUTIONARY') ELSE (CASE WHEN (IFNULL(`brand`.`brandStatus`,0)=4) THEN ('BLACKLISTED') ELSE ('NA') END) END) END) END) END) AS `status.name`, (CASE WHEN (IFNULL(`brand`.`brandVerifiedAt`,CURRENT_TIMESTAMP)<CURRENT_TIMESTAMP) THEN ('VERIFIED') ELSE ('UNVERIFIED') END) AS `status.isVerified`, IFNULL(`brand`.`brandVerifiedAt`,'') AS `status.verifiedAt`, IFNULL(`brand`.`createdAt`,'') AS `createdAt` FROM `brand` LEFT JOIN `city` ON `brand`.`cityId`=`city`.`id` LEFT JOIN `state` ON `city`.`stateId`=`state`.`id` LEFT JOIN `country` ON `state`.`countryId`=`country`.`id` WHERE `brand`.`id` = " . $id . " GROUP BY `brand`.`id` ORDER BY `brand`.`brandPriority` ASC LIMIT 0,1");
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result[0]), true));
            } else {
                return [];
            }
        }
    }

    /**
     * Get the top brands from the database.
     *
     * @return array
     */
    public function getTopBrands()
    {
        $query = $this->db->query("SELECT IFNULL(`brand`.`id`,0) AS `id`, IFNULL(`city`.`id`,0) AS `city.id`, IFNULL(`city`.`cityCode`,'') AS `city.code`, IFNULL(`city`.`cityName`,'') AS `city.name`, IFNULL(`state`.`id`,0) AS `city.state.id`, IFNULL(`state`.`stateCode`,'') AS `city.state.code`, IFNULL(`state`.`stateName`,'') AS `city.state.name`, IFNULL(`country`.`id`,0) AS `city.state.country.id`, IFNULL(`country`.`countryCode`,'') AS `city.state.country.code`, IFNULL(`country`.`countryName`,'') AS `city.state.country.name`, IFNULL(`brand`.`brandCode`,'') AS `code`, IFNULL(`brand`.`brandName`,'') AS `name`, IFNULL(`brand`.`brandFullRegisteredAddress`,'') AS `address`, IFNULL(`brand`.`brandSupportEmail`,'') AS `email`, IFNULL(`brand`.`brandSupportContact`,'') AS `contact`, IFNULL(`brand`.`brandWebUrl`,'') AS `webUrl`, IFNULL(`brand`.`brandBioInfo`,'') AS `info`, IFNULL(`brand`.`brandLogoUrl`,'') AS `logo`, IFNULL(`brand`.`brandStatus`,0) AS `status.code`, (CASE WHEN (IFNULL(`brand`.`brandStatus`,0)=0) THEN ('NA') ELSE (CASE WHEN (IFNULL(`brand`.`brandStatus`,0)=1) THEN ('ACTIVE') ELSE (CASE WHEN (IFNULL(`brand`.`brandStatus`,0)=2) THEN ('INACTIVE') ELSE (CASE WHEN (IFNULL(`brand`.`brandStatus`,0)=3) THEN ('CAUTIONARY') ELSE (CASE WHEN (IFNULL(`brand`.`brandStatus`,0)=4) THEN ('BLACKLISTED') ELSE ('NA') END) END) END) END) END) AS `status.name`, (CASE WHEN (IFNULL(`brand`.`brandVerifiedAt`,CURRENT_TIMESTAMP)<CURRENT_TIMESTAMP) THEN ('VERIFIED') ELSE ('UNVERIFIED') END) AS `status.isVerified`, IFNULL(`brand`.`brandVerifiedAt`,'') AS `status.verifiedAt`, IFNULL(`brand`.`createdAt`,'') AS `createdAt` FROM `brand` LEFT JOIN `city` ON `brand`.`cityId`=`city`.`id` LEFT JOIN `state` ON `city`.`stateId`=`state`.`id` LEFT JOIN `country` ON `state`.`countryId`=`country`.`id` WHERE `brand`.`deletedAt` IS NULL AND IFNULL(`brand`.`brandStatus`,0)=1 AND IFNULL(`brand`.`brandVerifiedAt`,CURRENT_TIMESTAMP)<CURRENT_TIMESTAMP GROUP BY `brand`.`id` ORDER BY `brand`.`brandPriority` ASC LIMIT 0,9");
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }

    /**
     * Search for brands based on the given parameters.
     *
     * @param int $id
     * @param string $search
     * @param int $active
     * @param mixed $markets
     * @param mixed $categories
     * @return array
     */
    public function searchBrands($id = 0, $search = "", $active = 0, $markets, $categories)
    {
        $searchArg = [];
        if ($id != 0) {
            array_push($searchArg, ("IFNULL(`brand`.`id`,0) IN (" . $id . ")"));
        }

        if (!empty($search)) {
            array_push($searchArg, ("CONCAT(IFNULL(`city`.`cityCode`,''),' ',IFNULL(`city`.`cityName`,''),' ',IFNULL(`brand`.`brandCode`,''),' ',IFNULL(`brand`.`brandName`,''),' ',IFNULL(`brand`.`brandFullRegisteredAddress`,''),' ',IFNULL(`brand`.`brandSupportEmail`,''),' ',IFNULL(`brand`.`brandSupportContact`,'')) LIKE '%" . $search . "%'"));
        }
        if ($active == 1) {
            array_push($searchArg, ("IFNULL(`brand`.`brandStatus`,0)=1"));
        }
        if (!empty($markets)) {
            array_push($searchArg, ("`user`.`markets` LIKE '%" . $markets . "%'"));
        }
        if (!empty($categories)) {
            array_push($searchArg, ("`user`.`categories` LIKE '%" . $categories . "%'"));
        }
        if ((is_null($searchArg)) || (empty($searchArg)) || (count($searchArg) <= 0)) {
            $search = "";
        } else {
            $search = " AND (" . implode(" AND ", $searchArg) . ")";
        }

        $q = "SELECT IFNULL(`brand`.`id`,0) AS `id`, IFNULL(`city`.`id`,0) AS `city.id`, IFNULL(`city`.`cityCode`,'') AS `city.code`, IFNULL(`city`.`cityName`,'') AS `city.name`, IFNULL(`state`.`id`,0) AS `city.state.id`, IFNULL(`state`.`stateCode`,'') AS `city.state.code`, IFNULL(`state`.`stateName`,'') AS `city.state.name`, IFNULL(`country`.`id`,0) AS `city.state.country.id`, IFNULL(`country`.`countryCode`,'') AS `city.state.country.code`, IFNULL(`country`.`countryName`,'') AS `city.state.country.name`, IFNULL(`brand`.`brandCode`,'') AS `code`,IFNULL(`brand`.`comapnyBio`,'') AS `companyinfo`, IFNULL(`brand`.`brandName`,'') AS `name`, IFNULL(`brand`.`brandFullRegisteredAddress`,'') AS `address`, IFNULL(`brand`.`brandSupportEmail`,'') AS `email`, IFNULL(`brand`.`brandSupportContact`,'') AS `contact`, IFNULL(`brand`.`brandWebUrl`,'') AS `webUrl`, IFNULL(`brand`.`brandBioInfo`,'') AS `info`, IFNULL(`brand`.`brandLogoUrl`,'') AS `logo`,IFNULL(`brand`.`banner`,'') AS `banner`,  IFNULL(`brand`.`brandStatus`,0) AS `status.code`, (CASE WHEN (IFNULL(`brand`.`brandStatus`,0)=0) THEN ('NA') ELSE (CASE WHEN (IFNULL(`brand`.`brandStatus`,0)=1) THEN ('ACTIVE') ELSE (CASE WHEN (IFNULL(`brand`.`brandStatus`,0)=2) THEN ('INACTIVE') ELSE (CASE WHEN (IFNULL(`brand`.`brandStatus`,0)=3) THEN ('CAUTIONARY') ELSE (CASE WHEN (IFNULL(`brand`.`brandStatus`,0)=4) THEN ('BLACKLISTED') ELSE ('NA') END) END) END) END) END) AS `status.name`, IFNULL(`brand`.`brandStatus`,0) AS `status.active`, IFNULL(`brand`.`createdAt`,'') AS `createdAt`, `user`.* FROM `brand` LEFT JOIN `city` ON `brand`.`cityId`=`city`.`id` LEFT JOIN `user` ON `user`.`brandId`=`brand`.`id` LEFT JOIN `state` ON `city`.`stateId`=`state`.`id` LEFT JOIN `country` ON `state`.`countryId`=`country`.`id` WHERE `brand`.`deletedAt` IS NULL" . $search . " AND `user`.`userRole` = 50 GROUP BY `brand`.`id` ORDER BY `brand`.`brandPriority` ASC LIMIT 0,99";
        $query = $this->db->query($q);
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return [];
        }
    }

        
      
    /**
     * Retrieve all brands from the database.
     *
     * @return array|null Returns an array of brand objects if brands exist, otherwise returns null.
     */
    public function getBrands()
    {
        $query = $this->db->query("SELECT * FROM brand;");
        $result = $query->getResult();
        if (!empty($result) && count($result) > 0) {
            return (json_decode(json_encode($result), true));
        } else {
            return null;
        }
    }

    /**
     * Update the status of a brand with the given ID.
     *
     * @param int $id
     * @param mixed $status
     * @return array
     */
    public function updateStauts($id = 0, $status)
    {
        if ($id <= 0) {
            return [];
        } elseif (!isset($status) || is_null($status)) {
            return [];
        } else {
            $q = "UPDATE `brand` SET `brandStatus` = " . $status . " WHERE `brand`.`id` = " . $id . ";";
            $result = $this->db->query($q);
            if ($result && $this->db->affectedRows() > 0) {
                $q = "SELECT * FROM `brand` WHERE `brand`.`id` = " . $id . ";";
                $result1 = $this->db->query($q);
                $res = $result1->getResult();
                return $res;
            } else {
                return [];
            }
        }
    }
    /**
     * Get the brand connection information for a given brand ID.
     *
     * @param int $id The brand ID. Default is 0.
     * @return array The brand connection information.
     */
    public function getbrandConnection($id = 0)
    {
        if ($id <= 0) {
            return [];
        } else {
            $q = "SELECT COUNT(*) AS influencer_count FROM (SELECT DISTINCT campaigndraft.influencerId FROM campaigndraft JOIN campaign ON campaigndraft.campaignId = campaign.id WHERE campaign.brandId = " . $id . " GROUP BY campaigndraft.influencerId) AS subquery;";
            $query = $this->db->query($q);
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result[0]), true));
            } else {
                return [];
            }
        }
    }
    /**
     * Get the number of completed campaigns for a specific brand.
     *
     * @param int $id The ID of the brand.
     * @return array An array containing the count of completed campaigns.
     */
    public function getBrandComCam($id = 0)
    {
        if ($id <= 0) {
            return [];
        } else {
            $q = "SELECT COUNT(*) AS completed_campaign FROM ( SELECT DISTINCT campaigndraft.influencerId FROM campaigndraft JOIN campaign ON campaigndraft.campaignId = campaign.id WHERE campaign.brandId = " . $id . " AND campaigndraft.status =  3 ) AS subquery;";
            $query = $this->db->query($q);
            $result = $query->getResult();
            if (!empty($result) && count($result) > 0) {
                return (json_decode(json_encode($result[0]), true));
            } else {
                return [];
            }
        }
    }
}