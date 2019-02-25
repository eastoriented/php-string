<?php namespace eastoriented\php\string;

use eastoriented\php\test\recipient;

interface regex
{
	function recipientOfRegexMatchingAgainstStringIs(string $string, recipient $recipient) :void;
}
