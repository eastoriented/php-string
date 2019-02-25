<?php namespace eastoriented\php\string\recipient;

use eastoriented\php;
use eastoriented\php\string\{
	provider,
	recipient
};

class buffer
	implements
		recipient,
		provider
{
	private
		$buffer
	;

	function __construct(php\string\buffer $buffer)
	{
		$this->buffer = $buffer;
	}

	function stringIs(string $string) :void
	{
		$this->buffer->stringForBufferIs($string);
	}

	function recipientOfStringIs(recipient $recipient) :void
	{
		$this->buffer->recipientOfStringFromBufferIs($recipient);
	}
}
