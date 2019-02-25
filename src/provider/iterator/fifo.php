<?php namespace eastoriented\php\string\provider\iterator;

use eastoriented\php\container;
use eastoriented\php\container\iterator;
use eastoriented\php\string\{
	provider,
	recipient
};

class fifo extends container\adt\fifo
	implements
		provider
{
	function recipientOfStringis(recipient $recipient) :void
	{
		$this
			->blockForEachValueIs(
				new iterator\block\functor(
					function($iterator, $provider) use ($recipient)
					{
						$provider->recipientOfStringis($recipient);
					}
				)
			)
		;
	}
}
