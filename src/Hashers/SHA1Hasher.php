<?php


namespace HashDB2\Hashers;

class SHA1Hasher extends Hasher
{
  public function __construct()
  {
    parent::__construct('SHA1');
  }
}
