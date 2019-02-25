<?php namespace eastoriented\php\string\tests\units\recipient\buffer\prefix;

require __DIR__ . '/../../../../runner.php';

use eastoriented\tests\units;
use mock\eastoriented\php\string\provider as mockOfProvider;
use mock\eastoriented\php\string\recipient as mockOfRecipient;

class provider extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('eastoriented\php\string\recipient')
			->implements('eastoriented\php\string\provider')
		;
	}

	function testStringIs()
	{
		$this
			->given(
				$this->newTestedInstance(
					$provider = new mockOfProvider
				),
				$string = uniqid()
			)
			->if(
				$this->testedInstance->stringIs($string)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($provider))

			->given(
				$providerAsString = uniqid(),
				$this->calling($provider)->recipientOfStringIs = function($aRecipient) use ($providerAsString) {
					$aRecipient->stringIs($providerAsString);
				},

				$this->newTestedInstance(
					$provider
				)
			)
			->if(
				$this->testedInstance->stringIs($string)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($provider, $providerAsString . $string))
		;
	}

	function testRecipientOfStringIs()
	{
		$this
			->given(
				$this->newTestedInstance(
					$provider = new mockOfProvider
				),
				$recipient = new mockOfRecipient
			)
			->if(
				$this->testedInstance->recipientOfStringIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($provider))
				->mock($recipient)
					->receive('stringIs')
						->never

			->given(
				$this->newTestedInstance($provider, $string = uniqid())
			)
			->if(
				$this->testedInstance->recipientOfStringIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($provider, $string))
				->mock($recipient)
					->receive('stringIs')
						->withArguments($string)
							->once
		;
	}
}
