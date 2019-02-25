<?php namespace eastoriented\php\string\recipient;

use eastoriented\php\{
	string\recipient,
	container\adt,
	container\iterator\block
};

class fifo
	implements
		recipient
{
	private
		$recipients
	;

	function __construct(recipient... $recipients)
	{
		$this->recipients = new adt\fifo(... $recipients);
	}

	function stringIs(string $string) :void
	{
		$this->recipients
			->blockForEachValueIs(
				new block\functor(
					function($iterator, $recipient) use ($string)
					{
						$recipient->stringIs($string);
					}
				)
			)
		;
	}
}
