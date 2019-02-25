<?php namespace eastoriented\php\string\recipient;

use eastoriented\php\string\recipient;

class stdout
	implements
		recipient
{
	function stringIs(string $string) :void
	{
		echo $string;
	}
}
