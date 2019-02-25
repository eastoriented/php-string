<?php namespace eastoriented\php\string\tests\units\recipient\stdout;

require __DIR__ . '/../../../runner.php';

use eastoriented\tests\units;

class eol extends units\test
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
					->isEqualTo($string . PHP_EOL)
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance)
		;
	}
}
