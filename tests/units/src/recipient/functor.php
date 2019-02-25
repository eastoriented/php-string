<?php namespace eastoriented\php\string\tests\units\recipient;

require __DIR__ . '/../../runner.php';

use eastoriented\tests\units;

class functor extends units\test
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
				$this->newTestedInstance($callable = function() use (& $arguments) { $arguments = func_get_args(); }),
				$string = uniqid()
			)
			->if(
				$this->testedInstance->stringIs($string)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $string ])
		;
	}
}
