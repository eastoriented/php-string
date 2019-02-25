<?php namespace eastoriented\php\string\tests\units\regex;

require __DIR__ . '/../../runner.php';

use eastoriented\tests\units;
use mock\eastoriented\php as mockOfScore;

class pcre extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('eastoriented\php\string\regex')
		;
	}

	function testConstructorWithSyntaxErrorInRegex()
	{
		$this
			->exception(function() { $this->newTestedInstance('^.*$/'); })
				->isInstanceOf('invalidArgumentException')
				->hasMessage('Syntax error in regular expression')
		;
	}

	function testRecipientOfRegexMatchingAgainstStringIs()
	{
		$this
			->given(
				$this->newTestedInstance($regex = '/^.*$/'),
				$string = uniqid(),
				$recipient = new mockOfScore\php\test\recipient
			)
			->if(
				$this->testedInstance->recipientOfRegexMatchingAgainstStringIs($string, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($regex))
				->mock($recipient)
					->receive('booleanIs')
						->withArguments(true)
							->once

			->given(
				$this->newTestedInstance($regex = '/^fo{1,2}bar$/')
			)

			->if(
				$this->testedInstance->recipientOfRegexMatchingAgainstStringIs($string, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($regex))
				->mock($recipient)
					->receive('booleanIs')
						->withArguments(false)
							->once

			->if(
				$this->testedInstance->recipientOfRegexMatchingAgainstStringIs('fobar', $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($regex))
				->mock($recipient)
					->receive('booleanIs')
						->withArguments(true)
							->twice

			->if(
				$this->testedInstance->recipientOfRegexMatchingAgainstStringIs('foobar', $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($regex))
				->mock($recipient)
					->receive('booleanIs')
						->withArguments(true)
							->thrice
		;
	}
}
