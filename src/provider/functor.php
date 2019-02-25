<?php namespace eastoriented\php\string\provider;

use eastoriented\php;

class functor extends block
{
	function __construct(callable $callable)
	{
		parent::__construct(new php\block\functor($callable));
	}
}
