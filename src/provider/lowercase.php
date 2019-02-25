<?php namespace eastoriented\php\string\provider;

use eastoriented\php\string\{
	provider\any,
	recipient
};

class lowercase extends any
{
	function recipientOfStringIs(recipient $recipient) :void
	{
		parent::recipientOfStringIs(
			new recipient\decorator\lowercase(
				$recipient
			)
		);
	}
}
