<?php namespace eastoriented\php\string\tests\units\buffer;

require __DIR__ . '/../../runner.php';

use eastoriented\tests\units;

class join extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('eastoriented\php\string\buffer')
		;
	}

	function testStringForBufferIs()
	{
		$this
			->given(
				$this->newTestedInstance($glue = uniqid()),
				$string = uniqid()
			)
			->if(
				$this->testedInstance->stringForBufferIs($string)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($glue, $string))

			->if(
				$this->testedInstance->stringForBufferIs($string)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($glue, $string . $glue . $string))

			->given(
				$space = ''
			)
			->if(
				$this->testedInstance->stringForBufferIs($space)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($glue, $string . $glue . $string . $glue))
		;
	}
}
