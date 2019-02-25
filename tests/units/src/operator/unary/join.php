<?php namespace eastoriented\php\string\tests\units\operator\unary;

require __DIR__ . '/../../../runner.php';

use eastoriented\tests\units;
use mock\eastoriented\php\string\recipient as mockOfRecipient;

class join extends units\test
{
	function testRecipientOfStringOperationWithStringIs()
	{
		$this
			->given(
				$this->newTestedInstance(
					$string = uniqid(),
					$otherString = uniqid()
				),
				$glue = uniqid(),
				$recipient = new mockOfRecipient
			)
			->if(
				$this->testedInstance->recipientOfStringOperationWithStringIs($glue, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($string, $otherString))
				->mock($recipient)
					->receive('stringIs')
						->withArguments($string . $glue . $otherString)
							->once
		;
	}
}
