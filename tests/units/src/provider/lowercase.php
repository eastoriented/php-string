<?php namespace eastoriented\php\string\tests\units\provider;

require __DIR__ . '/../../runner.php';

use eastoriented\php\string\tests\units\provider;
use mock\eastoriented\php\string\recipient as mockOfRecipient;

class lowercase extends provider
{
	/**
	 * @dataProvider stringProvider
	 */
	function testRecipientOfStringIs_withString($string)
	{
		$this
			->given(
				$this->newTestedInstance($string),
				$recipient = new mockOfRecipient
			)
			->if(
				$this->testedInstance->recipientOfStringIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($string))
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
