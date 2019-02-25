<?php namespace eastoriented\php\string\recipient;

use eastoriented\php\string\recipient;

class prefix
	implements
		recipient
{
	private
		$prefix,
		$recipient
	;

	function __construct(string $prefix, recipient $recipient)
	{
		$this->prefix = $prefix;
		$this->recipient = $recipient;
	}

	function stringIs(string $string) :void
	{
		$this->recipient->stringIs($this->prefix . $string);
	}
}
