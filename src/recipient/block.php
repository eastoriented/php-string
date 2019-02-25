<?php namespace eastoriented\php\string\recipient;

use eastoriented\{ php, php\string\recipient };

class block
	implements
		recipient
{
	private
		$block
	;

	function __construct(php\block $block)
	{
		$this->block = $block;
	}

	function stringIs(string $string) :void
	{
		$this->block->blockArgumentsAre($string);
	}
}
