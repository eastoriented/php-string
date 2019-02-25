<?php namespace eastoriented\php\string\provider\not;

use eastoriented\php\{
	string\provider\any,
	string\test\isEmpty,
	test\recipient\ifTrue,
	block
};

class blank extends any
{
	function __construct(string $string, \exception $exception = null)
	{
		(
			new isEmpty($string)
		)
			->recipientOfTestIs(
				new ifTrue\exception\fallback(
					new \invalidArgumentException('Argument must be a not empty string'),
					$exception
				)
			)
		;

		parent::__construct($string);
	}
}
