<?php namespace eastoriented\php\string\recipient\decorator;

use eastoriented\php\string\recipient;

class lowercase
	implements
		recipient
{
	private
		$recipient
	;

	function __construct(recipient $recipient)
	{
		$this->recipient = $recipient;
	}

	function stringIs(string $string) :void
	{
		$this->recipient
			->stringIs(strtolower($string))
		;
	}
}
