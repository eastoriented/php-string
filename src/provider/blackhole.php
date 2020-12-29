<?php namespace eastoriented\php\string\provider;

use eastoriented\php\string\provider;
use eastoriented\php\string\recipient;

class blackhole
	implements
		provider
{
	function recipientOfStringIs(recipient $recipient): void
	{

	}
}
