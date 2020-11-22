<?php

namespace App\Services;

use App\Contact;


class ContactService
{
	private static $contactList = ['Abel', 'Sebastian', 'Test'];
	
	public static function findByName($name): Contact
	{
		// queries to the db
		if(!in_array($name, self::$contactList)) {
			throw new \InvalidArgumentException("Contact not found");
		}

		return new Contact($name);
	}

	public static function validateNumber(string $number): bool
	{
		// logic to validate numbers
	}
}