<?php namespace eastoriented\php\string\provider\aggregator;

use eastoriented\php\{ block, string\provider, string\recipient\functor, test\variable\defined, test\recipient\ifTrue\functor as ifTrue };
use eastoriented\container\iterator\{ fifo, block\functor as iteratorBlock };

class all
{
	private
		$providers
	;

	function __construct(provider... $providers)
	{
		$this->providers = $providers;
	}

	function blockIs(block $block) :void
	{
		(new fifo)
			->variablesForIteratorBlockAre(
				new iteratorBlock(
					function($iterator, $provider) use (& $arguments)
					{
						$provider
							->recipientOfStringIs(
								new functor(
									function($string) use (& $arguments)
									{
										$arguments[] = $string;
									}
								)
							)
						;
					}
				),
				...$this->providers
			)
		;

		(new defined($arguments))
			->recipientOfTestIs(
				new ifTrue(
					function() use ($block, $arguments) {
						$block->blockArgumentsAre(... $arguments);
					}
				)
			)
		;
	}
}
