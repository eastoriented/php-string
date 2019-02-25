<?php namespace eastoriented\php\string\recipient\prefix;

use eastoriented\php\string\{
	recipient,
	recipient\prefix
};

class dot extends prefix
{
	function __construct(recipient $recipient)
	{
		parent::__construct('.', $recipient);
	}
}
