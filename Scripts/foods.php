<?php

class Foods {
    private $foodId;
    private $itemName;
    private $itemPrice;
    private $chainId;

    public function __construct($itemName, $itemPrice, $foodId = null, $chainId = null)
    {
        $this->itemName = $itemName;
        $this->itemPrice = $itemPrice;
        $this->foodId = $foodId;
        $this->chainId = $chainId;
    }

    public function getItemName() {
        return $this->itemName;
    }
    public function setItemName($value) {
        $this->itemName = $value;
    }

    public function getItemPrice() {
        return $this->itemPrice;
    }
    public function setItemPrice($value) {
        $this->itemPrice = $value;
    }

    public function getFoodId() {
        return $this->foodId;
    }
    public function setFoodId($value) {
        $this->foodId = $value;
    }

    public function getChainId() {
        return $this->chainId;
    }
    public function setChainId($value) {
        $this->chainId = $value;
    }
}

?>