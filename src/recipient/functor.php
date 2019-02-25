<?php namespace eastoriented\php\string\recipient;

use eastoriented\php\{
	block,
	string\recipient
};

class functor extends block\functor
	implements
		recipient
{
	function stringIs(string $string) :void
	{
		parent::blockArgumentsAre($string);
	}
}
