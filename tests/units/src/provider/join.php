<?php namespace eastoriented\php\string\tests\units\provider;

require __DIR__ . '/../../runner.php';

use eastoriented\php\string\tests\units\provider as test;
use mock\eastoriented\php\string\{
	recipient,
	provider
};

class join extends test
{
	function testRecipientOfStringIs()
	{
		$this
			->given(
				$this->newTestedInstance(
					$glue = new provider,
					$provider = new provider,
					$otherProvider = new provider
				),
				$recipient = new recipient
			)
			->if(
				$this->testedInstance->recipientOfStringIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($glue, $provider, $otherProvider))
				->mock($recipient)
					->receive('stringIs')
						->never

			->given(
				$stringFromGlue = uniqid(),
				$this->calling($glue)->recipientOfStringIs = function($aRecipient) use ($stringFromGlue) {
					$aRecipient->stringIs($stringFromGlue);
				},

				$stringFromProvider = uniqid(),
				$this->calling($provider)->recipientOfStringIs = function($aRecipient) use ($stringFromProvider) {
					$aRecipient->stringIs($stringFromProvider);
				},

				$stringFromOtherProvider = uniqid(),
				$this->calling($otherProvider)->recipientOfStringIs = function($aRecipient) use ($stringFromOtherProvider) {
					$aRecipient->stringIs($stringFromOtherProvider);
				}
			)
			->if(
				$this->testedInstance->recipientOfStringIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($glue, $provider, $otherProvider))
				->mock($recipient)
					->receive('stringIs')
						->withArguments($stringFromProvider . $stringFromGlue . $stringFromOtherProvider)
							->once

			->given(
				$this->newTestedInstance(
					$glue,
					$provider,
					$otherProvider ,
					$anotherProvider = new provider
				),

				$stringFromAnotherProvider = uniqid(),
				$this->calling($anotherProvider)->recipientOfStringIs = function($aRecipient) use ($stringFromAnotherProvider) {
					$aRecipient->stringIs($stringFromAnotherProvider);
				}
			)
			->if(
				$this->testedInstance->recipientOfStringIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($glue, $provider, $otherProvider, $anotherProvider))
				->mock($recipient)
					->receive('stringIs')
						->withArguments($stringFromProvider . $stringFromGlue . $stringFromOtherProvider . $stringFromGlue . $stringFromAnotherProvider)
							->once
		;
	}
}
