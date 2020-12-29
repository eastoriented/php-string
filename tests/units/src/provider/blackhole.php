<?php namespace eastoriented\php\string\tests\units\provider;

require __DIR__ . '/../../runner.php';

use eastoriented\tests\units;
use mock\eastoriented\php\string\recipient as mockOfRecipient;

class blackhole extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('eastoriented\php\string\provider')
		;
	}

	function testRecipîentOfStringIs()
	{
		$this
			->given(
				$this->newTestedInstance,
				$recipient = new mockOfRecipient
			)
			->if(
				$this->testedInstance->recipientOfStringIs($recipient)
			)
			->then
				->object($this->testedInstance)->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('stringIs')
						->never
		;
	}
}
