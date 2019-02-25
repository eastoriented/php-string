<?php namespace eastoriented\php\string\provider;

use eastoriented\php\string\{
	provider,
	recipient
};

class any
	implements
		provider
{
	private
		$string
	;

	function __construct(string $string)
	{
		$this->string = $string;
	}

	function recipientOfStringIs(recipient $recipient) :void
	{
		$recipient->stringIs($this->string);
	}
}
