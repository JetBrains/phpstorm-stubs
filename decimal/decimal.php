<?php

namespace Decimal {

    use ArithmeticError;
    use DivisionByZeroError;
    use Traversable;
    use TypeError;

    class Decimal {
        public const ROUND_UP = 101;
        public const ROUND_DOWN = 102;
        public const ROUND_CEILING = 103;
        public const ROUND_FLOOR = 104;
        public const ROUND_HALF_UP = 105;
        public const ROUND_HALF_DOWN = 106;
        public const ROUND_HALF_EVEN = 107;
        public const ROUND_HALF_ODD = 108;
        public const ROUND_TRUNCATE = 109;

        public const DEFAULT_PRECISION = 28;
        public const DEFAULT_ROUNDING = 107;

        public const MIN_PRECISION = 1;

        /**
         * 425000000 for 32 bits systems
         * 999999999999999999 for 64 bits systems
         */
        public const MAX_PRECISION = 999999999999999999;

        /**
         * @param string $value
         * @param int $precision
         */
        public function __construct(string $value, int $precision = self::DEFAULT_PRECISION) { }

        /**
         * This method is equivalent to the + operator
         *
         * @param Decimal|string|int $value
         *
         * @return Decimal
         *
         * @throws TypeError
         *
         * @link https://php-decimal.io/#add
         */
        public function add($value): Decimal { }

        /**
         * This method is equivalent to the - operator
         *
         * @param Decimal|string|int $value
         *
         * @return Decimal
         *
         * @throws TypeError
         *
         * @link https://php-decimal.io/#sub
         */
        public function sub($value): Decimal { }

        /**
         * This method is equivalent to the * operator
         *
         * @param Decimal|string|int $value
         *
         * @return Decimal
         *
         * @throws TypeError
         *
         * @link https://php-decimal.io/#mul
         */
        public function mul($value): Decimal { }

        /**
         * This method is equivalent to the / operator
         *
         * @param Decimal|string|int $value
         *
         * @return Decimal
         *
         * @throws TypeError
         *
         * @link https://php-decimal.io/#div
         */
        public function div($value): Decimal { }

        /**
         * This method is equivalent to the % operator
         *
         * @param Decimal|string|int $value
         *
         * @return Decimal
         *
         * @throws TypeError
         * @throws DivisionByZeroError
         * @throws ArithmeticError
         *
         * @link https://php-decimal.io/#mod
         */
        public function mod($value): Decimal { }

        /**
         * This method is equivalent to the ** operator
         *
         * @param Decimal|string|int $value
         *
         * @return Decimal
         *
         * @throws TypeError
         *
         * @link https://php-decimal.io/#pow
         */
        public function pow($value): Decimal { }

        /**
         * @param Decimal|string|int $value
         *
         * @return Decimal
         *
         * @throws TypeError
         * @throws DivisionByZeroError
         * @throws ArithmeticError
         *
         * @link https://php-decimal.io/#rem
         */
        public function rem($value): Decimal { }

        /**
         * This method is equivalent in function to PHP's log
         *
         * @return Decimal
         *
         * @link https://php-decimal.io/#ln
         */
        public function ln(): Decimal { }

        /**
         * @return Decimal
         *
         * @link https://php-decimal.io/#exp
         */
        public function exp(): Decimal { }

        /**
         * @return Decimal
         *
         * @link https://php-decimal.io/#log10
         */
        public function log10(): Decimal { }

        /**
         * @return Decimal
         *
         * @link https://php-decimal.io/#sqrt
         */
        public function sqrt(): Decimal { }

        /**
         * Returns the value of this decimal with the same precision
         *
         * Rounded according to the specified number of decimal places and rounding mode
         *
         * @param int $places
         * @param int $mode
         *
         * @return Decimal
         *
         * @link https://php-decimal.io/#round
         */
        public function round(int $places = 0, int $mode = Decimal::ROUND_HALF_EVEN): Decimal { }

        /**
         * Returns the closest integer towards negative infinity
         *
         * @return Decimal
         *
         * @link https://php-decimal.io/#floor
         */
        public function floor(): Decimal { }

        /**
         * Returns the closest integer towards positive infinity
         *
         * @return Decimal
         *
         * @link https://php-decimal.io/#ceil
         */
        public function ceil(): Decimal { }

        /**
         * Returns the result of discarding all digits behind the decimal point
         *
         * @return Decimal
         *
         * @link https://php-decimal.io/#truncate
         */
        public function truncate(): Decimal { }

        /**
         * Returns a copy of this decimal with its decimal place shifted
         *
         * @return Decimal
         *
         * @link https://php-decimal.io/#shift
         */
        public function shift(): Decimal { }

        /**
         * @since 1.1.0
         *
         * Returns a copy of this decimal without trailing zeroes
         *
         * @return Decimal
         *
         * @link https://php-decimal.io/#trim
         */
        public function trim(): Decimal { }

        /**
         * Returns the precision of this decimal
         *
         * @return int
         *
         * @link https://php-decimal.io/#precision
         */
        public function precision(): int { }

        /**
         * Returns  0 if zero, -1 if negative, or 1 if positive
         *
         * @return int
         *
         * @link https://php-decimal.io/#signum
         */
        public function signum(): int { }

        /**
         * Returns 0 if the integer value of this decimal is even, 1 if odd. Special numbers like NAN and INF will return 1
         *
         * @return int
         *
         * @link https://php-decimal.io/#parity
         */
        public function parity(): int { }

        /**
         * Returns the absolute (positive) value of this decimal
         *
         * @return Decimal
         *
         * @link https://php-decimal.io/#abs
         */
        public function abs(): Decimal { }

        /**
         * Returns the same value as this decimal, but the sign inverted
         *
         * @return Decimal
         *
         * @link https://php-decimal.io/#negate
         */
        public function negate(): Decimal { }

        /**
         * @return bool
         *
         * @link https://php-decimal.io/#isEven
         */
        public function isEven(): bool { }

        /**
         * @return bool
         *
         * @link https://php-decimal.io/#isOdd
         */
        public function isOdd(): bool { }

        /**
         * @return bool
         *
         * @link https://php-decimal.io/#isPositive
         */
        public function isPositive(): bool { }

        /**
         * @return bool
         *
         * @link https://php-decimal.io/#isNegative
         */
        public function isNegative(): bool { }

        /**
         * @return bool
         *
         * @link https://php-decimal.io/#isNan
         */
        public function isNaN(): bool { }

        /**
         * @return bool
         *
         * @link https://php-decimal.io/#isInf
         */
        public function isInf(): bool { }

        /**
         * @return bool
         *
         * @link https://php-decimal.io/#isInteger
         */
        public function isInteger(): bool { }

        /**
         * @return bool
         *
         * @link https://php-decimal.io/#isZero
         */
        public function isZero(): bool { }

        /**
         * Returns the value of this decimal formatted to a fixed number of decimal places, with thousands comma-separated, using a given rounding mode.
         *
         * @param int $places
         * @param bool $commas
         * @param int $mode
         *
         * @return Decimal
         *
         * @link https://php-decimal.io/#toFixed
         */
        public function toFixed(int $places = 0, bool $commas = false, int $mode = Decimal::ROUND_HALF_EVEN): Decimal { }

        /**
         * Returns the value of this decimal represented exactly, in either fixed or scientific form, depending on the value
         *
         * @return string
         */
        public function __toString(): string { }

        /**
         * This method is equivalent to a cast to string
         *
         * Returns the value of this decimal represented exactly, in either fixed or scientific form, depending on the value
         *
         * @return string
         */
        public function toString(): string { }

        /**
         * JSON conversions will automatically convert the decimal to string using all significant figures
         *
         * @return string
         */
        public function jsonSerialize(): string { }

        /**
         * @return int
         */
        public function toInt(): int { }

        /**
         * @return float
         */
        public function toFloat(): float { }

        /**
         * @return Decimal
         */
        public function copy(): Decimal { }

        /**
         * This method is equivalent to the == operator.
         *
         * @param mixed $value
         *
         * @return bool TRUE if this decimal is considered equal to the given value.
         *
         * @link https://php-decimal.io/#equals
         */
        public function equals($value): bool { }

        /**
         * This method is equivalent to the <=> operator.
         *
         * Returns 0 if this decimal is considered equal to $other,
         * -1 if this decimal should be placed before $other,
         * 1 if this decimal should be placed after $other.
         *
         * @param $value
         *
         * @return int
         *
         * @link https://php-decimal.io/#compareTo
         */
        public function compareTo($value): int { }

        /**
         * Returns TRUE if the value is between the two operands
         *
         * @param Decimam|string|int $value
         * @param Decimam|string|int $leftOp
         * @param Decimam|string|int $rightOp
         *
         * @return bool
         */
        public function between($value, $leftOp, $rightOp): bool { }

        /**
         * Returns the sum of all given values
         *
         * The precision of the result will be the max of all precisions that were encountered during the calculation.
         * The given precision should therefore be considered the minimum precision of the result.
         * This method is equivalent to adding each value individually
         *
         * @param array|Traversable $values
         *
         * @return Decimal
         *
         * @link https://php-decimal.io/#sum
         */
        public function sum(array $values): Decimal { }

        /**
         * Returns the average of all given values
         *
         * The precision of the result will be the max of all precisions that were encountered during the calculation.
         * The given precision should therefore be considered the minimum precision of the result.
         * This method is equivalent to adding each value individually, then dividing by the number of values
         * @param array $values
         *
         * @return Decimal
         *
         * @link https://php-decimal.io/#avg
         */
        public function avg(array $values): Decimal { }
    }
}
