<?php namespace eastoriented\php\string\buffer;

use eastoriented\php\block;
use eastoriented\php\string\{
	recipient,
	provider,
	buffer
};

class aggregator
	implements
		provider,
		recipient,
		buffer
{
	private
		$buffer
	;

	function __construct(buffer $buffer)
	{
		$this->buffer = $buffer;
	}

	function recipientOfStringIs(recipient $recipient) :void
	{
		$this->buffer->recipientOfStringFromBufferIs($recipient);
	}

	function stringIs(string $string) :void
	{
		$this->buffer->stringForBufferIs($string);
	}

	function recipientOfStringFromBufferIs(recipient $recipient) :void
	{
		$this->recipientOfStringIs($recipient);
	}

	function stringForBufferIs(string $string) :void
	{
		$this->stringIs($string);
	}

	function recipientOfStringFromProviderIs(provider $provider, recipient $recipient) :void
	{
		$this->buffer->recipientOfStringFromProviderIs($provider, $recipient);
	}
}
