<?php namespace eastoriented\php\string\tests\units\recipient;

require __DIR__ . '/../../runner.php';

use eastoriented\tests\units;
use mock\eastoriented\php\string\buffer as mockOfBuffer;
use mock\eastoriented\php\string\recipient as mockOfRecipient;

class buffer extends units\test
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
					$buffer = new mockOfBuffer
				),
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

	function testRecipientOfStringIs()
	{
		$this
			->given(
				$this->newTestedInstance(
					$buffer = new mockOfBuffer
				),
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
}
