<?php namespace eastoriented\php\string\tests\units\provider\iterator;

require __DIR__ . '/../../../runner.php';

use eastoriented\tests\units;
use mock\eastoriented\php\string\provider as mockOfProvider;
use mock\eastoriented\php\string\recipient as mockOfRecipient;

class fifo extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('eastoriented\php\string\provider')
		;
	}

	function testRecipientOfStringIs()
	{
		$this
			->given(
				$this->newTestedInstance(
					$provider = new mockOfProvider
				),
				$recipient = new mockOfRecipient,
				$this->calling($recipient)->stringIs = function($aString) use (& $strings) {
					$strings[] = $aString;
				}
			)
			->if(
				$this->testedInstance->recipientOfStringIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($provider))
				->variable($strings)
					->isNull

			->given(
				$stringFromProvider = uniqid(),
				$this->calling($provider)->recipientOfStringIs = function($aRecipient) use ($stringFromProvider) {
					$aRecipient->stringIs($stringFromProvider);
				}
			)
			->if(
				$this->testedInstance->recipientOfStringIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($provider))
				->array($strings)
					->isEqualTo([ $stringFromProvider ])


			->given(
				$strings = null,

				$this->newTestedInstance(
					$provider,
					$otherProvider = new mockOfProvider
				),

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
					->isEqualTo($this->newTestedInstance($provider, $otherProvider))
				->array($strings)
					->isEqualTo([ $stringFromProvider, $stringFromOtherProvider ])
		;
	}
}
