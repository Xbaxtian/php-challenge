<?php

namespace App\Interfaces;

use App\Contact;
use App\Call;
use APP\SMS;

interface CarrierInterface
{
	
	public function dialContact(Contact $contact);

	public function makeCall(): Call;
	
	public function sendSMS($number, $body): SMS;
}