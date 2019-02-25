<?php namespace eastoriented\php\string\tests\units\provider;

require __DIR__ . '/../../runner.php';

use eastoriented\php\string\tests\units\provider;
use mock\eastoriented\php\{
	block as mockOfBlock,
	string\recipient as mockOfRecipient
};

class block extends provider
{
	function testRecipientOfStringIs()
	{
		$this
			->given(
				$this->newTestedInstance(
					$block = new mockOfBlock
				),
				$recipient = new mockOfRecipient
			)
			->if(
				$this->testedInstance->recipientOfStringis($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($block))
				->mock($recipient)
					->receive('stringIs')
						->never

			->given(
				$string = uniqid(),
				$this->calling($block)->blockArgumentsAre = function($aRecipient) use ($recipient, $string) {
					if ($aRecipient == $recipient)
					{
						$aRecipient->stringIs($string);
					}
				}
			)
			->if(
				$this->testedInstance->recipientOfStringis($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($block))
				->mock($recipient)
					->receive('stringIs')
						->withArguments($string)
							->once
		;
	}
}
