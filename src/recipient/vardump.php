<?php namespace eastoriented\php\string\recipient;

use eastoriented\php\string\recipient;

class vardump
	implements
		recipient
{
	function stringIs(string $string) :void
	{
		var_dump($string);
	}
}
