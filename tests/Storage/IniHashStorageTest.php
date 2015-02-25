<?php


class IniHashStorageTest extends \PHPUnit_Framework_TestCase
{
  
  /**
   * 
   * @var \HashDB2\Storage\IniHashStorage
   */
  protected $storage;
  /**
   * 
   * @var \HashDB2\Hashers\CRC32Hasher
   */
  protected $hasher;
  protected $filename;
  protected $testData = "[db]\ntest1=000000\ntest2=123456\ntest3=ABCDEF\n";
  
  protected function setUp()
  { 
    $this->filename = 'TESTFILE'.mt_rand(999,999999).'.TEST.INI';
    
    $this->hasher = new \HashDB2\Hashers\CRC32Hasher();
    $this->storage = new \HashDB2\Storage\IniHashStorage($this->filename, $this->hasher);
  }
  
  protected function tearDown()
  {
    if (file_exists($this->filename))
      unlink($this->filename);
  }
  
  protected function resetTestFile()
  {
    file_put_contents($this->filename, $this->testData, LOCK_EX);
  }
  
  protected function emptyTestFile()
  {
    file_put_contents($this->filename, "", LOCK_EX);
  }  
  
  protected function getFilename()
  {
    return $this->filename;
  }
  
  public function testLoadedTestData()
  {
    $this->resetTestFile();
    $this->storage->load($this->filename);
    $this->assertEquals(3, $this->storage->load($this->filename));
  }
  
  public function testEmptyThenLoad()
  {
    if (file_exists($this->filename))
      unlink($this->filename);
    $this->emptyTestFile();    
    $this->storage->resetData();
    $this->storage->load($this->filename);
    $this->assertEquals('00000000', $this->storage->getFileHash($this->filename));
  }  
  
  public function testCreateNewDatabase()
  {
    if (file_exists($this->filename))
      unlink($this->filename);    
    $ret = $this->storage->createNewDatabase($this->filename);
    $this->assertTrue($ret);
    $this->assertEquals('811661cd', $this->storage->getHasher()->hashFile($this->filename));
  }
  
  public function testSave()
  {
    $this->resetTestFile();    
    $this->storage->load($this->filename);
    $h1 = $this->storage->getHasher()->hashFile($this->filename);
    if (file_exists($this->filename))
      unlink($this->filename);
    $this->storage->save($this->filename);
    $h2 = $this->storage->getHasher()->hashFile($this->filename);
    $this->assertEquals($h1, $h2);
  }
    
  public function testSetAndGetStoredHashes()
  {
    $this->resetTestFile();
    $this->storage->setStoredHash("ONETWO", "12");
    $this->storage->setStoredDataHash("ONETWOTHREE", "123");
    $this->storage->setStoredFileHash(__FILE__);
    $h1 = hash('crc32', file_get_contents(__FILE__));
    $h2 = $this->storage->getStoredHash(__FILE__);
    $this->assertEquals($h1, $h2);
    $this->assertEquals("12", $this->storage->getStoredHash('ONETWO'));    
    $this->assertEquals(hash('crc32', '123'), $this->storage->getStoredHash('ONETWOTHREE'));
    $this->assertNotEquals($h1, $this->storage->getStoredHash('badfilename'.mt_rand(999, 999999)));
  }
  
}
