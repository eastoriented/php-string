<?php namespace eastoriented\php\string\tests\units\recipient;

require __DIR__ . '/../../runner.php';

use eastoriented\tests\units;

class stdout extends units\test
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
				$this->newTestedInstance
			)
			->if(
				$string = uniqid()
			)
			->then
				->output(function() use ($string) { $this->testedInstance->stringIs($string); })
					->isEqualTo($string)
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance)
		;
	}
}
