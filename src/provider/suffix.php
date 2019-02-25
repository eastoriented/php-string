<?php namespace eastoriented\php\string\provider;

use eastoriented\php\string\provider;

class suffix extends suffix\provider
{
	function __construct(string $suffix, provider... $providers)
	{
		parent::__construct(new any($suffix), ... $providers);
	}
}
