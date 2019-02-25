<?php namespace eastoriented\php\string\tests\units;

require __DIR__ . '/../runner.php';

use eastoriented\tests\units;

abstract class provider extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('eastoriented\php\string\provider')
		;
	}
}
