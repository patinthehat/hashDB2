<?php


namespace HashDB2\Storage;

class TestableHashStorage extends \HashDB2\Storage\HashStorage
{
  
  public function load($database, $loaded = true, $ret = 2)
  {
    if ($loaded) {
      $this->data = parse_ini_string("[db]\ntest1=000000\ntest2=123456\n");
      //@codeCoverageIgnoreStart
    } else {
      $this->data = array();
    }
    //@codeCoverageIgnoreEnd    
    $this->loaded = $loaded;
    return $ret;
  }
  
  /**
   * @codeCoverageIgnore
   * @see \HashDB2\Storage\HashStorage::save()
   */
  public function save($database)
  {
    return true;
  }
  
  /**
   * @codeCoverageIgnore
   * @see \HashDB2\Storage\HashStorage::createNewDatabase()
   */
  public function createNewDatabase($filename)
  {
    return true;
  }

  /*public function getHash($data)
  {
    return "ABC123";  
  }*/
  
  public function getFileHash($filename)
  {
    //return $this->getHasher()->hashFile($filename);
    $hash = "123456";
    return $hash;
  }
  
  public function getStoredHash($name)
  {
    if (isset($this->data[$name]))
      return $this->data[$name];
    return false;
  }
  
  public function setStoredHash($name, $data)
  {
    $this->data[$name] = $this->getHash($data);
  }
  
  public function setStoredDataHash($name, $hash)
  {
    $this->data[$name] = $hash;
  }
    
  public function setStoredFileHash($filename)
  {
    $this->setStoredHash($filename, $this->getFileHash($filename));
  }
  
}