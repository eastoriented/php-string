<?php namespace eastoriented\php\string\provider;

use eastoriented\php;
use eastoriented\php\string\{
	provider,
	recipient
};

class block
	implements
		provider
{
	private
		$block
	;

	function __construct(php\block $block)
	{
		$this->block = $block;
	}

	function recipientOfStringIs(recipient $recipient) :void
	{
		$this->block->blockArgumentsAre($recipient);
	}
}
