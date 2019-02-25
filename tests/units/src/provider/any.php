<?php namespace eastoriented\php\string\tests\units\provider;

require __DIR__ . '/../../runner.php';

use eastoriented\php\string\tests\units\provider;
use mock\eastoriented\php\string\recipient;

class any extends provider
{
	function testRecipientOfStringIs()
	{
		$this
			->given(
				$this->newTestedInstance($string = uniqid()),
				$recipient = new recipient
			)
			->if(
				$this->testedInstance->recipientOfStringIs($recipient)
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
}
