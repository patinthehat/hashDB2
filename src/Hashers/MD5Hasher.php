<?php

namespace HashDB2\Hashers;

class MD5Hasher extends Hasher
{
  public function __construct()
  {
    parent::__construct('MD5'); 
  }
}
