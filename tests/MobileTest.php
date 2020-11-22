<?php

namespace Tests;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use App\Interfaces\CarrierInterface;
use App\Call;
use App\Contact;
use App\Mobile;

class MobileTest extends TestCase
{
	
	/** @test */
	public function it_returns_null_when_name_empty()
	{
		$provider = m::mock(CarrierInterface::class);
		
		$mobile = new Mobile($provider);

		$this->assertNull($mobile->makeCallByName(''));
	}

	public function test_valid_contact()
	{
		$contactName = 'Sebastian';
		$contact = new Contact($contactName);

		$provider = m::mock(CarrierInterface::class);

		$provider->shouldIgnoreMissing()
			->shouldReceive('dialContact')
			->andReturn($contact);

		$provider->allows()
			->makeCall()
			->andReturns(new Call());
		
		$mobile = new Mobile($provider);

		$this->assertInstanceOf(Call::class, $mobile->makeCallByName($contactName));
	}

	public function test_invalid_contact()
	{
		$this->expectException(\InvalidArgumentException::class);

		$contactName = 'Error';

		$provider = m::mock(CarrierInterface::class);
		
		$mobile = new Mobile($provider);

		$mobile->makeCallByName($contactName);
	}

}
