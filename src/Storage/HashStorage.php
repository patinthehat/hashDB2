<?php


namespace HashDB2\Storage;

use HashDB2\Hashers\Hasher;

abstract class HashStorage
{
  protected $filename;
  protected $data;
  protected $loaded = false;

  /**
   * 
   * @var Hasher
   */
  protected $hasher;
  
  public function __construct($filename, $hasher)
  {
    $this->filename = $filename;
    $this->hasher = $hasher;
  }
  
  public function getFilename()
  {
    return $this->filename;
  }
  
  public function loaded()
  {
    return $this->loaded;
  }
  
  public function resetData()
  {
    unset($this->data);
  }
  
  public function getData()
  {
    return $this->data;
  }
  
  /**
   * 
   * @return \HashDB2\Hashers\Hasher
   */
  public function getHasher()
  {
    return $this->hasher;
  }  

  public function getFileHash($filename)
  {
    return $this->getHasher()->hashFile($filename);
  }

  public function getHash($data)
  {
    return $this->getHasher()->hash($data);
  }  
  
  public function compareStoredHashToFileHash($filename) 
  {
    $storedhash = $this->getStoredHash($filename);
    $filehash   = $this->getFileHash($filename);
    //echo "\$storedhash = $storedhash \n";
    //echo "\$filehash = $filehash \n";
    
    return ($storedhash == $filehash);
  }
  
  abstract public function load($database);
  abstract public function save($database);
  abstract public function createNewDatabase($filename);  
  abstract public function getStoredHash($name);
  abstract public function setStoredHash($name, $hash);
  abstract public function setStoredDataHash($name, $data);
  abstract public function setStoredFileHash($filename);
}