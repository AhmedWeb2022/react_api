<?php

// interface of products types

interface Types
{
  public function save($sku, $name, $type, $price, $measurement);
  public function checkInput($inputs);
}