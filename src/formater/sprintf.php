<?php namespace eastoriented\php\string\formater;

use eastoriented\php\{
	test\variable\isNotFalse,
	test\recipient\ifTrue\functor as ifTrue,
	string\formater,
	string\recipient
};

class sprintf
	implements
		formater
{
	private
		$format
	;

	function __construct(string $format)
	{
		$this->format = $format;
	}

	function stringsForRecipientOfFormatedStringAre(recipient $recipient, string... $strings) :void
	{
		(
			new isNotFalse\strictly(
				$formatedString = @sprintf($this->format, ...$strings)
			)
		)
			->recipientOfTestIs(
				new ifTrue(
					function() use ($recipient, $formatedString)
					{
						$recipient->stringIs($formatedString);
					}
				)
			)
		;
	}
}
