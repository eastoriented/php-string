<?php namespace eastoriented\php\string;

use eastoriented\php\string\recipient;

interface formater
{
	function stringsForRecipientOfFormatedStringAre(recipient $recipient, string... $strings) :void;
}
