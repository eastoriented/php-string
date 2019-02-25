<?php namespace eastoriented\php\string\tests\units\recipient;

require __DIR__ . '/../../runner.php';

use eastoriented\tests\units;
use mock\eastoriented\php\string\recipient as mockOfRecipient;

class fifo extends units\test
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
					$recipient = new mockOfRecipient,
					$otherRecipient = new mockOfRecipient
				),
				$string = uniqid(),

				$this->calling($recipient)->stringIs = function($aString) use (& $recipients, $recipient, $string) {
					if ($aString == $string)
					{
						$recipients[] = $recipient;
					}
				},

				$this->calling($otherRecipient)->stringIs = function($aString) use (& $recipients, $otherRecipient, $string) {
					if ($aString == $string)
					{
						$recipients[] = $otherRecipient;
					}
				}
			)
			->if(
				$this->testedInstance->stringIs($string)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($recipient, $otherRecipient))
				->array($recipients)
					->isEqualTo([ $recipient, $otherRecipient ])
		;
	}
}
