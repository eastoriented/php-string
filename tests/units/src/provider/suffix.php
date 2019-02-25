<?php namespace eastoriented\php\string\tests\units\provider;

require __DIR__ . '/../../runner.php';

use eastoriented\tests\units;
use mock\eastoriented\php\string\provider as mockOfProvider;
use mock\eastoriented\php\string\recipient as mockOfRecipient;

class suffix extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('eastoriented\php\string\provider')
		;
	}

	function testRecipientOfStringIs()
	{
		$this
			->given(
				$this->newTestedInstance(
					$suffix = uniqid(),
					$provider = new mockOfProvider
				),
				$recipient = new mockOfRecipient
			)
			->if(
				$this->testedInstance->recipientOfStringIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($suffix, $provider))
				->mock($recipient)
					->receive('stringIs')
						->never

			->given(
				$providerAsString = uniqid(),
				$this->calling($provider)->recipientOfStringIs = function($aRecipient) use ($providerAsString) {
					$aRecipient->stringIs($providerAsString);
				}
			)
			->if(
				$this->testedInstance->recipientOfStringIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($suffix, $provider))
				->mock($recipient)
					->receive('stringIs')
						->withArguments($providerAsString . $suffix)
							->once
		;
	}
}
