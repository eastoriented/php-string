<?php namespace eastoriented\php\string\recipient;

use eastoriented\php;

class suffix extends suffix\provider
{
	function __construct(string $suffix, php\string\recipient $recipient)
	{
		parent::__construct(new php\string\provider\any($suffix), $recipient);
	}
}
