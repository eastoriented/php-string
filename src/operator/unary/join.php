<?php namespace eastoriented\php\string\operator\unary;

use eastoriented\php\string\recipient;

class join
{
	private
		$strings
	;

	function __construct(string... $strings)
	{
		$this->strings = $strings;
	}

	function recipientOfStringOperationWithStringIs(string $glue, recipient $recipient)
	{
		$recipient->stringIs(join($glue, $this->strings));
	}
}
