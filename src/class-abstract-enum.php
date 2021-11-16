<?php
/**
 * Enum: Enum class
 *
 * @package Moonwalking_Bits\Enum
 * @author Martin Pettersson
 * @license GPL-2.0
 * @since 0.1.0
 */

namespace Moonwalking_Bits\Enum;

use BadMethodCallException;
use InvalidArgumentException;
use ReflectionClass;

/**
 * Abstract class representing an enum.
 *
 * @since 0.1.0
 */
abstract class Abstract_Enum {

	/**
	 * The enum value.
	 *
	 * @since 0.1.0
	 * @var string
	 */
	protected $value;

	/**
	 * List of strings used when representing the enum as a string.
	 *
	 * @since 0.1.0
	 * @var string[]
	 */
	protected array $strings = array();

	/**
	 * Creates a new enum instance.
	 *
	 * @since 0.1.0
	 * @param mixed $value The enum value.
	 * @throws \InvalidArgumentException When value is not part of the enum.
	 */
	final protected function __construct( $value ) {
		$this->value = self::constant_from( $value );
	}

	/**
	 * Returns a new enum instance from the given value.
	 *
	 * @suppress PhanTypeInstantiateAbstractStatic
	 * @since 0.1.0
	 * @param mixed $value The enum value.
	 * @return static Enum instance.
	 * @throws \BadMethodCallException When invoked directly on Abstract_Enum.
	 * @throws \InvalidArgumentException When value is not part of the enum.
	 */
	final public static function from( $value ) {
		if ( static::class === self::class ) {
			throw new BadMethodCallException( 'Cannot instantiate an abstract class' );
		}

		return new static( $value );
	}

	/**
	 * Returns the enum constant for the given value.
	 *
	 * @since 0.1.0
	 * @param mixed $value The value to get the constant for.
	 * @return string The constant for the given value.
	 * @throws \InvalidArgumentException When value is not part of the enum.
	 */
	final public static function constant_from( $value ): string {
		if ( ! in_array( $value, static::values(), true ) ) {
			throw new InvalidArgumentException( 'Invalid value for enum ' . static::class );
		}

		return (string) array_flip( ( new ReflectionClass( static::class ) )->getConstants() )[ $value ];
	}

	/**
	 * Returns the enum values.
	 *
	 * @since 0.1.0
	 * @return array The enum values.
	 */
	final public static function values(): array {
		return array_values( ( new ReflectionClass( static::class ) )->getConstants() );
	}

	/**
	 * Returns the enum constants.
	 *
	 * @since 0.1.0
	 * @return string[] The enum constants.
	 */
	final public static function enum(): array {
		return array_keys( ( new ReflectionClass( static::class ) )->getConstants() );
	}

	/**
	 * Returns the enum value.
	 *
	 * @since 0.1.0
	 * @return mixed The enum value.
	 */
	final public function value() {
		return constant( "static::{$this->value}" );
	}

	/**
	 * Returns a string representation of the enum value.
	 *
	 * @since 0.1.0
	 * @return string The enum value represented as a string.
	 */
	final public function __toString(): string {
		return array_key_exists( $this->value(), $this->strings ) ?
			(string) $this->strings[ $this->value() ] :
			(string) $this->value;
	}
}
