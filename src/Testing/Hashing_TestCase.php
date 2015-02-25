<?php

namespace HashDB2\Testing;

/**
 * @codeCoverageIgnore
 *
 */
class Hashing_TestCase extends \PHPUnit_Framework_TestCase
{
  /**
   * @var MD5Hasher
   */
  protected $hasher;
  /**
   * @var string
   */
  protected $testFilename;
  /**
   * @var string
   */
  protected $testData;
  /**
   * @var string
   */
  protected $testDataHash;
  
  protected function init($hasherClass, $testData, $testDataHash, $emptyHash)
  {
    $this->hasher         = $hasherClass;
    $this->testDataHash   = $testDataHash;
    $this->testEmptyHash  = $emptyHash;
    
    $this->testFilename   = "TESTHASHFILE".mt_rand(999,999999).'.TEST';
    $this->testData       = $testData;
    
    file_put_contents($this->testFilename,$this->testData);
  }
  
  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown()
  {
    if ($this->testFilename != "" && file_exists($this->testFilename))
      unlink($this->testFilename);
  }

  /**
   * Get the classname of the $hasher. Optionally return just the classname without the namespace.
   * @param bool $noNamespace
   * @return string
   */
  protected function getHasherClassName($withNamespace=true)
  {
    $cn = get_class($this->hasher);
    if (!$withNamespace) {
      $parts = explode('\\', $cn);
      return $parts[count($parts)-1];
    }
    return $cn;
  }
  
  /**
   * @covers \HashDB2\Hashers\Hasher::hash
   * @covers \HashDB2\Hashers\Hasher::hashString
   */
  public function testHashString()
  {
    $hash = $this->hasher->hashString($this->testData);
    $this->assertEquals($hash, $this->testDataHash);
  }
  
  /**
   * @covers \HashDB2\Hashers\Hasher::hash
   * @covers \HashDB2\Hashers\Hasher::hashFile
   */
  public function testHashFile()
  {
    $hash = $this->hasher->hashFile($this->testFilename);
    $this->assertEquals($hash, $this->testDataHash);
    $hash = $this->hasher->hashFile($this->testFilename.".BADFILE");
    $this->assertEquals($hash, $this->testEmptyHash);
  }
  
}