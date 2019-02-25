<?php namespace eastoriented\php\string\buffer;

use eastoriented\php\string\{
	buffer,
	recipient
};

class join extends buffer\infinite
{
	private
		$glue
	;

	function __construct(string $glue, string $contents = null)
	{
		parent::__construct($contents);

		$this->glue = $glue;
	}

	function stringForBufferIs(string $string) :void
	{
		parent::recipientOfStringFromBufferIs(
			new recipient\functor(
				function()
				{
					parent::stringForBufferIs($this->glue);
				}
			)
		);

		parent::stringForBufferIs($string);
	}
}
