<?php namespace eastoriented\php\string\tests\units\buffer;

require __DIR__ . '/../../runner.php';

use eastoriented\tests\units;
use mock\eastoriented\php\string\buffer as mockOfBuffer;
use mock\eastoriented\php\string\provider as mockOfProvider;
use mock\eastoriented\php\string\recipient as mockOfRecipient;

class aggregator extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('eastoriented\php\string\provider')
			->implements('eastoriented\php\string\recipient')
			->implements('eastoriented\php\string\buffer')
		;
	}

	function testRecipientOfStringIs()
	{
		$this
			->given(
				$this->newTestedInstance($buffer = new mockOfBuffer),
				$recipient = new mockOfRecipient
			)
			->if(
				$this->testedInstance->recipientOfStringIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($buffer))
				->mock($buffer)
					->receive('recipientOfStringFromBufferIs')
						->withArguments($recipient)
							->once
		;
	}

	function testRecipientOfStringFromBufferIs()
	{
		$this
			->given(
				$this->newTestedInstance($buffer = new mockOfBuffer),
				$recipient = new mockOfRecipient
			)
			->if(
				$this->testedInstance->recipientOfStringFromBufferIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($buffer))
				->mock($buffer)
					->receive('recipientOfStringFromBufferIs')
						->withArguments($recipient)
							->once
		;
	}

	function testStringIs()
	{
		$this
			->given(
				$this->newTestedInstance($buffer = new mockOfBuffer),
				$string = uniqid()
			)
			->if(
				$this->testedInstance->stringIs($string)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($buffer))
				->mock($buffer)
					->receive('stringForBufferIs')
						->withArguments($string)
							->once
		;
	}

	function testStringForBufferIs()
	{
		$this
			->given(
				$this->newTestedInstance($buffer = new mockOfBuffer),
				$string = uniqid()
			)
			->if(
				$this->testedInstance->stringForBufferIs($string)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($buffer))
				->mock($buffer)
					->receive('stringForBufferIs')
						->withArguments($string)
							->once
		;
	}

	function testRecipientOfStringFromProviderIs()
	{
		$this
			->given(
				$this->newTestedInstance($buffer = new mockOfBuffer),
				$provider = new mockOfProvider,
				$recipient = new mockOfRecipient
			)
			->if(
				$this->testedInstance->recipientOfStringFromProviderIs($provider, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($buffer))
				->mock($buffer)
					->receive('recipientOfStringFromProviderIs')
						->withArguments($provider, $recipient)
							->once
		;
	}
}
