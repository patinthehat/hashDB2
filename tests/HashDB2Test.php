<?php


use \HashDB2\HashDB2;
class HashDB2Test extends \PHPUnit_Framework_TestCase
{
  
  /**
   *
   * @var \HashDB2\HashDB2
   */
  protected $hdb;
  /**
   *
   * @var \HashDB2\Hashers\MD5Hasher
   */  
  protected $hasher;
  protected $storage;

  protected function setUp()
  {
    $this->hasher = new \HashDB2\Hashers\MD5Hasher();
    $this->storage = new \HashDB2\Storage\TestableHashStorage('testable.test', $this->hasher);
    $this->hdb = new \HashDB2\HashDB2($this->hasher, $this->storage);
  }
  
  protected function tearDown()
  {
    
  }

  public function testInit() 
  {
    $this->hdb->init(new \HashDB2\Hashers\CRC32Hasher(), $this->storage);
    $this->assertEquals(get_class($this->hdb->getHasher()), 'HashDB2\Hashers\CRC32Hasher');
  }
  
  public function testGetStorage()
  {
    $this->assertEquals(get_class($this->storage), get_class($this->hdb->getStorage()));
  }
  
}
