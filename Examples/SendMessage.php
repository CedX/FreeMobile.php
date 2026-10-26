<?php declare(strict_types=1);
use Belin\FreeMobile\Client;

// Sends an SMS notification.
try {
	$client = new Client(account: "your account identifier", apiKey: "your API key");
	$client->sendMessage("Hello World from PHP!");
	echo "The message was sent successfully.";
}
catch (RuntimeException $e) {
	echo "An error occurred: ", $e->getMessage();
}
