<?php namespace eastoriented\php\string\tests\units\recipient;

require __DIR__ . '/../../runner.php';

use eastoriented\tests\units;
use mock\eastoriented\php\string\recipient as mockOfRecipient;

class utf8 extends units\test
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
					$recipient = new mockOfRecipient
				),
				$string = uniqid()
			)
			->if(
				$this->testedInstance->stringIs($string)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($recipient))
				->mock($recipient)
					->receive('stringIs')
						->withArguments($string)
							->once

			->given(
				$string = chr(33)
			)
			->if(
				$this->testedInstance->stringIs($string)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($recipient))
				->mock($recipient)
					->receive('stringIs')
						->withArguments("\u{0021}")
							->once

			->given(
				$string = "\u{00e9}"
			)
			->if(
				$this->testedInstance->stringIs($string)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($recipient))
				->mock($recipient)
					->receive('stringIs')
						->withArguments("\u{00e9}")
							->once
		;
	}
}
