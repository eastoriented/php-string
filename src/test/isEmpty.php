<?php namespace eastoriented\php\string\test;

use eastoriented\php\test;

class isEmpty extends test\variable\any
{
	function __construct(string $string)
	{
		parent::__construct($string, new test\equal\strictly(''));
	}
}
