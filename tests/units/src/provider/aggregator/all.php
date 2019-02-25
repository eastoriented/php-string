<?php namespace eastoriented\php\string\tests\units\provider\aggregator;

require __DIR__ . '/../../../runner.php';

use eastoriented\tests\units;
use mock\eastoriented\php\{
	block as mockOfBlock,
	string\provider as mockOfProvider
};

class all extends units\test
{
	function testBlockIs()
	{
		$this
			->given(
				$this->newTestedInstance(
					$stringProvider = new mockOfProvider
				),
				$block = new mockOfBlock
			)
			->if(
				$this->testedInstance->blockIs($block)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($stringProvider))
				->mock($block)
					->receive('blockArgumentsAre')
						->never

			->given(
				$string = uniqid(),
				$this->calling($stringProvider)->recipientOfStringIs = function($aRecipient) use ($string) {
					$aRecipient->stringIs($string);
				}
			)
			->if(
				$this->testedInstance->blockIs($block)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($stringProvider))
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments($string)
							->once

			->given(
				$this->newTestedInstance(
					$stringProvider,
					$otherStringProvider = new mockOfScore\php\string\provider
				),

				$otherString = uniqid(),
				$this->calling($otherStringProvider)->recipientOfStringIs = function($aRecipient) use ($otherString) {
					$aRecipient->stringIs($otherString);
				}
			)
			->if(
				$this->testedInstance->blockIs($block)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($stringProvider, $otherStringProvider))
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments($string, $otherString)
							->once
		;
	}
}
