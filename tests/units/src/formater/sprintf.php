<?php namespace eastoriented\php\string\tests\units\formater;

require __DIR__ . '/../../runner.php';

use eastoriented\tests\units;
use mock\eastoriented\php\string\recipient as mockOfRecipient;

class sprintf extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('eastoriented\php\string\formater')
		;
	}

	function testSttringsForRecipientOfFormatedStringAre()
	{
		$this
			->given(
				$this->newTestedInstance($format = '%s'),
				$recipient = new mockOfRecipient
			)
			->if(
				$this->testedInstance->stringsForRecipientOfFormatedStringAre($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($format))
				->mock($recipient)
					->receive('stringis')
						->never

			->given(
				$this->newTestedInstance($format = ''),
				$string = uniqid()
			)
			->if(
				$this->testedInstance->stringsForRecipientOfFormatedStringAre($recipient, $string)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance(''))
				->mock($recipient)
					->receive('stringis')
						->withArguments($format)
							->once

			->given(
				$this->newTestedInstance($format = '%s %s'),
				$string = uniqid()
			)
			->if(
				$this->testedInstance->stringsForRecipientOfFormatedStringAre($recipient, $string)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($format))
				->mock($recipient)
					->receive('stringis')
						->withArguments('')
							->once

			->given(
				$this->newTestedInstance($format = '%s' . ($spacer = uniqid()) . '%s')
			)
			->if(
				$this->testedInstance->stringsForRecipientOfFormatedStringAre($recipient, $string)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($format))
				->mock($recipient)
					->receive('stringis')
						->withArguments($string)
							->never

			->given(
				$otherString = uniqid()
			)
			->if(
				$this->testedInstance->stringsForRecipientOfFormatedStringAre($recipient, $string, $otherString)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($format))
				->mock($recipient)
					->receive('stringis')
						->withArguments($string . $spacer . $otherString)
							->once
		;
	}
}
