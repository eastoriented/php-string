<?php namespace eastoriented\php\string\tests\units\recipient\buffer;

require __DIR__ . '/../../../runner.php';

use eastoriented\tests\units;

class join extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('eastoriented\php\string\recipient')
			->implements('eastoriented\php\string\provider')
		;
	}

	function testStringIs()
	{
		$this
			->given(
				$this->newTestedInstance($glue = uniqid()),
				$string = uniqid()
			)
			->if(
				$this->testedInstance->stringIs($string)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($glue, $string))

			->if(
				$this->testedInstance->stringIs($string)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($glue, $string . $glue . $string))

			->given(
				$space = ''
			)
			->if(
				$this->testedInstance->stringIs($space)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($glue, $string . $glue . $string . $glue . $space))
		;
	}
}
