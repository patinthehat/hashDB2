<?php

namespace HashDB2\Hashers;

class CRC32Hasher extends Hasher
{
  public function __construct()
  {
    parent::__construct('crc32');
  }
}