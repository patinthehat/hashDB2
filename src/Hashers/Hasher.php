<?php

namespace HashDB2\Hashers;

abstract class Hasher implements IHasher
{
  
  protected $hashName;
  
  public function getHashName()
  {
    return $this->hashName;
  }
  
  public function hash($data)
  {
    return hash(strtolower($this->getHashName()), $data);
  }
  
  public function hashString($str)
  {
    return $this->hash($str);
  }
  
  public function hashFile($filename)
  {
    $data = "";
    if (file_exists($filename))
      $data = file_get_contents($filename);
    return $this->hash($data);
    
  }
  
  public function __construct($hashName) 
  {
    $this->hashName = $hashName;
  }
  
}