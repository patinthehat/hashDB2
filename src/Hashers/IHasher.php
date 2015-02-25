<?php

namespace HashDB2\Hashers;

interface IHasher {
  public function getHashName();

  public function hash($data);
  public function hashString($str);
  public function hashFile($filename);
}