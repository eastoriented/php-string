<?php namespace eastoriented\php\string\tests\units\buffer;

require __DIR__ . '/../../runner.php';

use eastoriented\tests\units;
use mock\eastoriented\php\string\provider as mockOfProvider;
use mock\eastoriented\php\string\recipient as mockOfRecipient;

class infinite extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('eastoriented\php\string\buffer')
		;
	}

	function testStringForBufferIs()
	{
		$this
			->given(
				$this->newTestedInstance,
				$string = uniqid()
			)
			->if(
				$this->testedInstance->stringForBufferIs($string)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($string))

			->given(
				$this->newTestedInstance($stringInBuffer = uniqid()),
				$string = uniqid()
			)
			->if(
				$this->testedInstance->stringForBufferIs($string)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($stringInBuffer . $string))
		;
	}

	function testRecipientOfStringFromBufferIs()
	{
		$this
			->given(
				$this->newTestedInstance,
				$recipient = new mockOfRecipient
			)
			->if(
				$this->testedInstance->recipientOfStringFromBufferIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('stringIs')
						->never

			->given(
				$this->newTestedInstance($string = uniqid())
			)
			->if(
				$this->testedInstance->recipientOfStringFromBufferIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($string))
				->mock($recipient)
					->receive('stringIs')
						->withArguments($string)
							->once
		;
	}

	function testRecipientOfStringFromProviderIs()
	{
		$this
			->given(
				$this->newTestedInstance,
				$provider = new mockOfProvider,
				$recipient = new mockOfRecipient
			)
			->if(
				$this->testedInstance->recipientOfStringFromProviderIs($provider, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('stringIs')
						->never

			->given(
				$string = uniqid(),
				$this->calling($provider)->recipientOfStringIs = function($aRecipient) use ($string) {
					$aRecipient->stringIs($string);
				}
			)
			->if(
				$this->testedInstance->recipientOfStringFromProviderIs($provider, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('stringIs')
						->withArguments($string)
							->once
		;
	}
}
