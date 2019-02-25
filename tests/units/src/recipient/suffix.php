<?php namespace eastoriented\php\string\tests\units\recipient;

require __DIR__ . '/../../runner.php';

use eastoriented\tests\units;
use mock\eastoriented\php\string\recipient as mockOfRecipient;

class suffix extends units\test
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
				$this->newTestedInstance($suffix = uniqid(), $recipient = new mockOfRecipient),
				$string = uniqid()
			)
			->if(
				$this->testedInstance->stringIs($string)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($suffix, $recipient))
				->mock($recipient)
					->receive('stringIs')
						->withArguments($string . $suffix)
							->once
		;
	}
}
