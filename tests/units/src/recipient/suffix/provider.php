<?php namespace eastoriented\php\string\tests\units\recipient\suffix;

require __DIR__ . '/../../../runner.php';

use eastoriented\tests\units;
use mock\eastoriented\php\string\provider as mockOfProvider;
use mock\eastoriented\php\string\recipient as mockOfRecipient;

class provider extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('eastoriented\php\string\recipient')
		;
	}

	function testStringIs()
	{
		$this
			->given(
				$this->newTestedInstance(
					$provider = new mockOfProvider,
					$recipient = new mockOfRecipient
				),
				$string = uniqid()
			)
			->if(
				$this->testedInstance->stringIs($string)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($provider, $recipient))
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
				$this->testedInstance->stringIs($string)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($provider, $recipient))
				->mock($recipient)
					->receive('stringIs')
						->withArguments($string . $providerAsString)
							->once
		;
	}
}
