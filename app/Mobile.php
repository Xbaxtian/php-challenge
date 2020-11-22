<?php

namespace App;

use App\Interfaces\CarrierInterface;
use App\Services\ContactService;


class Mobile
{

	protected $provider;
	
	function __construct(CarrierInterface $provider)
	{
		$this->provider = $provider;
	}


	public function makeCallByName($name = '')
	{
		if( empty($name) ) return;

		$contact = ContactService::findByName($name);

		if(!$contact) {
			return;
		}

		$this->provider->dialContact($contact);

		return $this->provider->makeCall();
	}

	public function sendSMS($number, $body)
	{
		if( empty($number) || empty($body) ) return;

		if ( !ContactService::validateNumber($number) ) return;

		return $this->provider->sendSMS($number, $body);
	}
}
