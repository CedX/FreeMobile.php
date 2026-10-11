<?php declare(strict_types=1);
namespace Belin\FreeMobile;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\{Test, TestDox};

/**
 * Tests the features of the {@see Client} class.
 */
#[TestDox("Client")]
class ClientTests extends TestCase {

	#[Test, TestDox("sendMessage(): should throw a `RuntimeException` if a network error occurred.")]
	public function networkError(): void {
		$client = new Client("anonymous", "secret", baseUrl: "http://localhost:10000/");
		(fn() => $client->sendMessage("Hello World!")) |> Should::throw(\RuntimeException::class);
	}

	#[Test, TestDox("sendMessage(): should throw a `RuntimeException` if the credentials are invalid.")]
	public function invalidCredentials(): void {
		$client = new Client("anonymous", "secret");
		(fn() => $client->sendMessage("Hello World!")) |> Should::throw(\RuntimeException::class);
	}

	#[Test, TestDox("sendMessage(): should send SMS messages if the credentials are valid.")]
	public function validCredentials(): void {
		$client = new Client(getenv("FREEMOBILE_ACCOUNT") ?: "", getenv("FREEMOBILE_API_KEY") ?: "");
		(fn() => $client->sendMessage("Hello Cédric, from PHP!")) |> Should::notThrow(\RuntimeException::class);
	}
}
