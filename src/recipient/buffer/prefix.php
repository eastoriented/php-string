<?php namespace eastoriented\php\string\recipient\buffer;

use eastoriented\php;

class prefix extends prefix\provider
{
	function __construct(string $prefix, string $buffer = null)
	{
		parent::__construct(new php\string\provider\any($prefix), $buffer);
	}
}
