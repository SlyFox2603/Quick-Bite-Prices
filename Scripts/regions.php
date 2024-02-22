<?php

class Region {
    private $regionId;
    private $regionName;

    public function __construct($regionId, $regionName) {
        $this->regionId = $regionId;
        $this->regionName = $regionName;
    }

    public function getRegionId() {
        return $this->regionId;
    }

    public function getRegionName() {
        return $this->regionName;
    }
}

?>