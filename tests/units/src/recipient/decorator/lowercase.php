<?php namespace eastoriented\php\string\tests\units\recipient\decorator;

require __DIR__ . '/../../../runner.php';

use eastoriented\tests\units;
use mock\eastoriented\php\string\recipient as mockOfRecipient;

class lowercase extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('eastoriented\php\string\recipient')
		;
	}

	/**
	 * @dataProvider stringProvider
	 */
	function testStringIs($string)
	{
		$this
			->given(
				$this->newTestedInstance(
					$recipient = new mockOfRecipient
				)
			)
			->if(
				$this->testedInstance->stringIs($string)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($recipient))
				->mock($recipient)
					->receive('stringIs')
						->withArguments('foo')
							->once
		;
	}

	protected function stringProvider()
	{
		return [
			'foo',
			'Foo',
			'fOo',
			'foO',
			'FOo',
			'fOO',
			'FoO',
			'FOO'
		];
	}
}
