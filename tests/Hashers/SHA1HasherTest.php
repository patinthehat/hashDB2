<?php

class SHA1HasherTest extends \HashDB2\Testing\Hashing_TestCase
{
  /**
   * Sets up the fixture
   * This method is called before a test is executed.
   */
  protected function setUp()
  {
    $this->init(
      new \HashDB2\Hashers\SHA1Hasher(),
      "test string",
      "661295c9cbf9d6b2f6428414504a8deed3020641",
      "da39a3ee5e6b4b0d3255bfef95601890afd80709"
    );
  }

  /**
   * @covers \HashDB2\Hashers\SHA1Hasher::__construct
   * @covers \HashDB2\Hashers\Hasher::__construct
   * @covers \HashDB2\Hashers\Hasher::getHashName
   */
  public function testSuccessfulInitializeAndGetHashName()
  {

    $this->assertEquals($this->getHasherClassName(false), 'SHA1Hasher');
    $this->assertEquals(strtolower($this->hasher->getHashName()), 'sha1');
  }
}
