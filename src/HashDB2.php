<?php

namespace HashDB2;

use HashDB2\Hashers\Hasher;
use HashDB2\Storage\HashStorage;

class HashDB2 {

  protected $hasher;
  protected $storage;
  
  function __construct(Hasher $hasher, HashStorage $storage) 
  {
    $this->init($hasher, $storage);
  }
  
  public function init(Hasher $hasher, HashStorage $storage)
  {
    $this->hasher = $hasher;  
    $this->storage = $storage;
  }
  
  public function getHasher()
  {
    return $this->hasher;
  }
  
  public function getStorage()
  {
    return $this->storage;
  }
  
  

}