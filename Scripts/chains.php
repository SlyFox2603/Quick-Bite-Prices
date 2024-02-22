<?php

class Chains {
    private $chainId;
    private $chainName;
    private $regionId;

    public function __construct($chainName, $regionId, $chainId = null)
    {
        $this->chainName = $chainName;
        $this->regionID = $regionId;
        $this->chainID = $chainId;
        
    }

    public function getChainId() {
        return $this->chainId;
    }
    public function setChainId($value) {
        $this->chainId = $value;
    }

    public function getChainName() {
        return $this->chainName;
    }
    public function setChainName($value) {
        $this->chainName = $value;
    }

    public function getRegionId() {
        return $this->regionId;
    }
    public function setRegionId($value) {
        $this->regionId = $value;
    }
}

?>