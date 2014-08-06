<?php

class WelcomeTest extends \CIUnit_TestCase 
{
	public function setUp()
	{
		// Set the tested controller
		$this->CI = set_controller('welcome');
	}

	/**
	 * @test
	 */
    public function hogetest()
    {
		// Call the controllers method
		$this->CI->index();
		
		// Fetch the buffered output
		$out = output();
		
		// Check if the content is OK
		$this->assertSame(0, preg_match('/(error|notice)/i', $out));


	 	$this->assertEquals(0, 0);
	 	$this->assertEquals(0, 0);
	 	$this->assertEquals(0, 0);
	 	$this->assertEquals(0, 0);
	 	$this->assertEquals(0, 0);
	 	$this->assertEquals(0, 0);
	 	$this->assertEquals(0, 0);
	 	$this->assertEquals(0, 0);
	}
}
