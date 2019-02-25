<?php namespace eastoriented\php\string\tests\units\provider;

require __DIR__ . '/../../runner.php';

use eastoriented\php\string\tests\units\provider;
use mock\eastoriented\php\string\recipient;

class blank extends provider
{
	function testRecipientOfStringIs()
	{
		$this
			->given(
				$this->newTestedInstance,
				$recipient = new recipient
			)
			->if(
				$this->testedInstance->recipientOfStringIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('stringIs')
						->withArguments('')
							->once
		;
	}
}
