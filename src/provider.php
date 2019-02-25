<?php namespace eastoriented\php\string;

use eastoriented\php\string\recipient;

interface provider
{
	function recipientOfStringIs(recipient $recipient) :void;
}
