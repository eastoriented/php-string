<?php namespace eastoriented\php\string\provider;

use eastoriented\php\string\{ provider, recipient, recipient\functor, operator };
use eastoriented\php\test\{ defined, recipient\ifTrue\functor as ifTrue };
use eastoriented\php\container\iterator\{ fifo, block\functor as iteratorBlock };

class join
	implements
		provider
{
	private
		$glue,
		$providers
	;

	function __construct(provider $glue, provider... $providers)
	{
		$this->glue = $glue;
		$this->providers = $providers;
	}

	function recipientOfStringIs(recipient $recipient) :void
	{
		$this->glue
			->recipientOfStringIs(
				new functor(
					function($glue) use ($recipient)
					{
						$buffer = new recipient\buffer\join($glue);

						(
							new fifo
						)
							->variablesForIteratorBlockAre(
								new iteratorBlock(
									function($iterator, $provider) use ($buffer)
									{
										$provider
											->recipientOfStringIs(
												$buffer
											)
										;
									}
								),
								... $this->providers
							)
						;

						$buffer->recipientOfStringIs($recipient);
					}
				)
			)
		;
	}
}
