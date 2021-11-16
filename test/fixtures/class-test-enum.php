<?php

namespace Moonwalking_Bits\Enum\Fixtures;

use Moonwalking_Bits\Enum\Abstract_Enum;

class Test_Enum extends Abstract_Enum {
	const CONST_1 = 0;
	const CONST_2 = 1;
	const CONST_3 = 'Const 3';

	protected array $strings = array(
		self::CONST_1 => 'Const 1',
	);
}
