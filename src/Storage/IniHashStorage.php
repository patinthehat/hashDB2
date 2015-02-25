<?php


namespace HashDB2\Storage;

class IniHashStorage extends \HashDB2\Storage\HashStorage
{
  
  public function load($database)
  {
    $ret = file_exists($database);
    if ($ret) {
      $this->data = parse_ini_file($database);
      $ret = count($this->data);
    }
    $this->loaded = ($ret !== false);
    return $ret;
  }
  
  public function save($database)
  {
    $data = "[db]\n";
    
    foreach($this->getData() as $n=>$v) {
      $data .= "$n=$v\n";
    }
        
    return file_put_contents($database, $data);
  }
  
  public function createNewDatabase($filename)
  {
    $data = "[db]\n";
    file_put_contents($filename, $data);
    return file_exists($filename);
  }
  
  public function getStoredHash($name)
  {
    if (isset($this->data[$name]))
      return $this->data[$name];
    return false;
  }
  
  public function setStoredHash($name, $hash)
  {
    $this->data[$name] = $hash;
  }
  
  public function setStoredFileHash($filename)
  {
    $this->setStoredHash($filename, $this->getFileHash($filename));
  }
  
  public function setStoredDataHash($name, $data)
  {
    $this->setStoredHash($name, $this->getHash($data));
  }  
  
}