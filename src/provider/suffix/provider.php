<?php namespace eastoriented\php\string\provider\suffix;

use eastoriented\php;
use eastoriented\php\string\{ recipient, recipient\buffer };
use eastoriented\php\container\iterator\{ fifo, block };

class provider
	implements
		php\string\provider
{
	private
		$suffix,
		$providers
	;

	function __construct(php\string\provider $suffix, php\string\provider... $providers)
	{
		$this->suffix = $suffix;
		$this->providers = $providers;
	}

	function recipientOfStringIs(recipient $recipient) :void
	{
		$buffer = new php\string\buffer\infinite;

		(
			new fifo
		)
			->variablesForIteratorBlockAre(
				new block\functor(
					function($iterator, $provider) use ($buffer)
					{
						$provider
							->recipientOfStringIs(
								new recipient\suffix\provider(
									$this->suffix,
									new recipient\buffer($buffer)
								)
							)
						;

					}
				),
				... $this->providers
			)
		;

		$buffer->recipientOfStringFromBufferIs($recipient);
	}
}
