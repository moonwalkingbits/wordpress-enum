<?php

namespace Moonwalking_Bits\Enum;

use BadMethodCallException;
use InvalidArgumentException;
use Moonwalking_Bits\Enum\Fixtures\Test_Enum;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Moonwalking_Bits\Enum\Abstract_Enum
 */
class Abstract_Enum_Test extends TestCase {
	/**
	 * @test
	 */
	public function should_create_from_valid_values(): void {
		$this->assertInstanceOf( Test_Enum::class, Test_Enum::from( Test_Enum::CONST_1 ) );
		$this->assertInstanceOf( Test_Enum::class, Test_Enum::from( Test_Enum::CONST_2 ) );
		$this->assertInstanceOf( Test_Enum::class, Test_Enum::from( Test_Enum::CONST_3 ) );
	}

	/**
	 * @test
	 */
	public function should_throw_if_invalid_value(): void {
		$this->expectException( InvalidArgumentException::class );

		Test_Enum::from( 9 );
	}

	/**
	 * @test
	 */
	public function should_throw_if_creating_abstract_enum(): void {
		$this->expectException( BadMethodCallException::class );

		Abstract_Enum::from( 9 );
	}

	/**
	 * @test
	 */
	public function should_return_constant_value(): void {
		$this->assertEquals( 0, Test_Enum::from( Test_Enum::CONST_1 )->value() );
		$this->assertEquals( 'Const 3', Test_Enum::from( Test_Enum::CONST_3 )->value() );
	}

	/**
	 * @test
	 */
	public function should_return_all_constants(): void {
		$this->assertEquals( array( 'CONST_1', 'CONST_2', 'CONST_3' ), Test_Enum::enum() );
	}

	/**
	 * @test
	 */
	public function should_return_all_values(): void {
		$this->assertEquals( array( 0, 1, 'Const 3' ), Test_Enum::values() );
	}

	/**
	 * @test
	 */
	public function should_return_constant_name_when_cast_to_string(): void {
		$this->assertEquals( 'CONST_2', (string) Test_Enum::from( Test_Enum::CONST_2 ) );
	}

	/**
	 * @test
	 */
	public function should_return_string_value_if_present_when_cast_to_string(): void {
		$this->assertEquals( 'Const 1', (string) Test_Enum::from( Test_Enum::CONST_1 ) );
	}
}
