<?php

class CRC32HasherTest extends \HashDB2\Testing\Hashing_TestCase
{
  /**
   * Sets up the fixture
   * This method is called before a test is executed.
   */
  protected function setUp()
  {
    $this->init(
      new \HashDB2\Hashers\CRC32Hasher(),
      "test string",
      "29ebfe6b",
      "00000000"
    );
  }

  /**
   * @covers \HashDB2\Hashers\CRC32Hasher::__construct
   * @covers \HashDB2\Hashers\Hasher::__construct
   * @covers \HashDB2\Hashers\Hasher::getHashName
   */
  public function testSuccessfulInitializeAndGetHashName()
  {
    $this->assertEquals($this->getHasherClassName(false), 'CRC32Hasher');
    $this->assertEquals(strtolower($this->hasher->getHashName()), 'crc32');
  }
}
