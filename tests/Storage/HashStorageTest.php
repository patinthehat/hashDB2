<?php


use \HashDB2\Storage\HashStorage;

class HashStorageTest extends \PHPUnit_Framework_TestCase
{
  /**
   * 
   * @var \HashDB2\Storage\TestableHashStorage
   */
  protected $storage;
  
  
  /**
   * @var HashDB2\Hashers\MD5Hasher
   */
  protected $hasher;
  
  protected function setUp()
  { 
    $this->hasher = new \HashDB2\Hashers\MD5Hasher();
    $this->storage = new \HashDB2\Storage\TestableHashStorage('test.dat', $this->hasher);
    $this->storage->load('test.dat', true, 2);
  }
  
  protected function tearDown()
  {
    
  }
  
  public function testGetFilename()
  {
    $this->assertEquals('test.dat', $this->storage->getFilename());
  }
  
  public function testGetHasher()
  {
    $this->assertEquals('HashDB2\Hashers\MD5Hasher', get_class($this->storage->getHasher()));
  }
    
  public function testLoaded()
  {
    $this->assertTrue($this->storage->loaded());
  }
    
  public function testCompareStoredHashToFileHash()
  {
    $this->assertTrue($this->storage->compareStoredHashToFileHash('test2'));
  }
  
  public function testSetAndGetStoredDataash()
  {
    $this->storage->setStoredDataHash("test2", "123456");
    $this->storage->setStoredDataHash("test3", "123456");
    $this->assertEquals("123456", $this->storage->getStoredHash("test2"));
    $this->assertEquals("123456", $this->storage->getStoredHash("test3"));
    $this->assertEquals("", $this->storage->getStoredHash("badtest"));
  }
  
  public function testSetStoredFileHash()
  {  
    $this->storage->setStoredFileHash(__FILE__);
  }
  
  /**
   * @todo write proper test for getHsh()
   * @covers \HashDB2\Storage\HashStorage::getHash
   * @covers \HashDB2\Storage\TestableHashStorage::getHash
   */
  function testGetHash()
  {    
    $this->assertEquals("033bd94b1168d7e4f0d644c3c95e35bf", $this->storage->getHash("TEST"));
  }
  
}
