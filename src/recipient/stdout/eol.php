<?php namespace eastoriented\php\string\recipient\stdout;

use eastoriented\php\string\recipient\{
	stdout,
	suffix,
	functor
};

class eol extends stdout
{
	function stringIs(string $string) :void
	{
		(
			new suffix(
				PHP_EOL,
				new functor(
					function($string) {
						parent::stringIs($string);
					}
				)
			)
		)
			->stringIs($string)
		;
	}
}
