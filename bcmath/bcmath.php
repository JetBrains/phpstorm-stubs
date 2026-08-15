<?php

namespace {
    use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;
    use JetBrains\PhpStorm\Internal\PhpStormStubsElementAvailable;
    use JetBrains\PhpStorm\Pure;

    /**
     * Add two arbitrary precision numbers
     * @link https://php.net/manual/en/function.bcadd.php
     * @param string $num1 <p>
     * The left operand, as a string.
     * </p>
     * @param string $num2 <p>
     * The right operand, as a string.
     * </p>
     * @param int|null $scale <p>
     * This optional parameter is used to set the number of digits after the
     * decimal place in the result. If omitted, it will default to the scale
     * set globally with the {@link bcscale()} function, or fallback to 0 if
     * this has not been set.
     * </p>
     * @return string The sum of the two operands, as a string.
     * @throws \ValueError This function throws a ValueError in the following cases: num1 or num2 is
     * not a well-formed BCMath numeric string. scale is outside the valid range.
     */
    #[Pure]
    function bcadd(string $num1, string $num2, ?int $scale = null): string {}

    /**
     * Subtract one arbitrary precision number from another
     * @link https://php.net/manual/en/function.bcsub.php
     * @param string $num1 <p>
     * The left operand, as a string.
     * </p>
     * @param string $num2 <p>
     * The right operand, as a string.
     * </p>
     * @param int|null $scale <p>
     * This optional parameter is used to set the number of digits after the
     * decimal place in the result. If omitted, it will default to the scale
     * set globally with the {@link bcscale()} function, or fallback to 0 if
     * this has not been set.
     * </p>
     * @return string The result of the subtraction, as a string.
     */
    #[Pure]
    function bcsub(string $num1, string $num2, ?int $scale = null): string {}

    /**
     * Multiply two arbitrary precision numbers
     * @link https://php.net/manual/en/function.bcmul.php
     * @param string $num1 <p>
     * The left operand, as a string.
     * </p>
     * @param string $num2 <p>
     * The right operand, as a string.
     * </p>
     * @param int|null $scale <p>
     * This optional parameter is used to set the number of digits after the
     * decimal place in the result. If omitted, it will default to the scale
     * set globally with the {@link bcscale()} function, or fallback to 0 if
     * this has not been set.
     * </p>
     * @return string the result as a string.
     */
    #[Pure]
    function bcmul(string $num1, string $num2, ?int $scale = null): string {}

    /**
     * Divide two arbitrary precision numbers
     * @link https://php.net/manual/en/function.bcdiv.php
     * @param string $num1 <p>
     * The dividend, as a string.
     * </p>
     * @param string $num2 <p>
     * The divisor, as a string.
     * </p>
     * @param int|null $scale [optional] <p>
     * This optional parameter is used to set the number of digits after the
     * decimal place in the result. If omitted, it will default to the scale
     * set globally with the {@link bcscale()} function, or fallback to 0 if
     * this has not been set.
     * </p>
     * @return string|null the result of the division as a string, or <b>NULL</b> if
     * <i>divisor</i> is 0.
     */
    #[Pure]
    #[PhpStormStubsElementAvailable(to: '7.4')]
    function bcdiv(string $num1, string $num2, ?int $scale = 0): ?string {}

    /**
     * Divide two arbitrary precision numbers
     * @link https://php.net/manual/en/function.bcdiv.php
     * @param string $num1 <p>
     * The dividend, as a string.
     * </p>
     * @param string $num2 <p>
     * The divisor, as a string.
     * </p>
     * @param int|null $scale [optional] <p>
     * This optional parameter is used to set the number of digits after the
     * decimal place in the result. If omitted, it will default to the scale
     * set globally with the {@link bcscale()} function, or fallback to 0 if
     * this has not been set.
     * </p>
     * @return string the result of the division as a string.
     * @throws \DivisionByZeroError if <i>divisor</i> is 0. Available since PHP 8.0.
     */
    #[Pure]
    #[PhpStormStubsElementAvailable('8.0')]
    function bcdiv(string $num1, string $num2, ?int $scale = null): string {}

    /**
     * Get modulus of an arbitrary precision number
     * @link https://php.net/manual/en/function.bcmod.php
     * @param string $num1 <p>
     * The dividend, as a string. Since PHP 7.2, the divided is no longer truncated to an integer.
     * </p>
     * @param string $num2 <p>
     * The divisor, as a string. Since PHP 7.2, the divisor is no longer truncated to an integer.
     * </p>
     * @param int|null $scale [optional] <p>
     * This optional parameter is used to set the number of digits after the
     * decimal place in the result. If omitted, it will default to the scale
     * set globally with the {@link bcscale()} function, or fallback to 0 if
     * this has not been set. Available since PHP 7.2.
     * </p>
     * @return string|null the modulus as a string, or <b>NULL</b> if
     * <i>divisor</i> is 0.
     */
    #[Pure]
    #[PhpStormStubsElementAvailable(to: '7.4')]
    function bcmod(string $num1, string $num2, #[PhpStormStubsElementAvailable(from: '7.2')] int $scale = 0): ?string {}

    /**
     * Get modulus of an arbitrary precision number
     * @link https://php.net/manual/en/function.bcmod.php
     * @param string $num1 <p>
     * The dividend, as a string. Since PHP 7.2, the divided is no longer truncated to an integer.
     * </p>
     * @param string $num2 <p>
     * The divisor, as a string. Since PHP 7.2, the divisor is no longer truncated to an integer.
     * </p>
     * @param int|null $scale [optional] <p>
     * This optional parameter is used to set the number of digits after the
     * decimal place in the result. If omitted, it will default to the scale
     * set globally with the {@link bcscale()} function, or fallback to 0 if
     * this has not been set. Available since PHP 7.2.
     * </p>
     * @return string the modulus as a string.
     * @throws \DivisionByZeroError if <i>divisor</i> is 0. Available since PHP 8.0.
     */
    #[Pure]
    #[PhpStormStubsElementAvailable('8.0')]
    function bcmod(string $num1, string $num2, ?int $scale = null): string {}

    /**
     * Raise an arbitrary precision number to another
     * @link https://php.net/manual/en/function.bcpow.php
     * @param string $num <p>
     * The base, as a string.
     * </p>
     * @param string $exponent <p>
     * The exponent, as a string. If the exponent is non-integral, it is truncated.
     * The valid range of the exponent is platform specific, but is at least
     * -2147483648 to 2147483647.
     * </p>
     * @param int|null $scale <p>
     * This optional parameter is used to set the number of digits after the
     * decimal place in the result. If omitted, it will default to the scale
     * set globally with the {@link bcscale()} function, or fallback to 0 if
     * this has not been set.
     * </p>
     * @return string the result as a string.
     * @throws \ValueError This function throws a ValueError in the following cases: num or exponent
     * is not a well-formed BCMath numeric string; exponent has a fractional part; exponent or scale
     * is outside the valid range
     * @throws \DivisionByZeroError This function throws a DivisionByZeroError exception if num is 0
     * and exponent is a negative value.
     */
    #[Pure]
    function bcpow(string $num, string $exponent, ?int $scale = null): string {}

    /**
     * Get the square root of an arbitrary precision number
     * @link https://php.net/manual/en/function.bcsqrt.php
     * @param string $num <p>
     * The operand, as a string.
     * </p>
     * @param int|null $scale [optional]
     * @return string|null the square root as a string, or <b>NULL</b> if
     * <i>operand</i> is negative.
     * @throws \ValueError This function throws a ValueError in the following cases: num is not a
     * well-formed BCMath numeric string; num is less than 0; scale is outside the valid range
     */
    #[Pure]
    #[LanguageLevelTypeAware(["8.0" => "string"], default: "string|null")]
    function bcsqrt(string $num, ?int $scale = null) {}

    /**
     * Set default scale parameter for all bc math functions
     * @link https://php.net/manual/en/function.bcscale.php
     * @param int $scale The scale factor.
     * @return int|bool Returns the old scale when used as setter. Otherwise the current scale is
     * returned.
     * @throws \ValueError This function throws a ValueError if scale is outside the valid range.
     */
    #[LanguageLevelTypeAware(['7.3' => 'int'], default: 'bool')]
    function bcscale(
        #[PhpStormStubsElementAvailable(from: '5.3', to: '7.2')] int                                                   $scale,
        #[PhpStormStubsElementAvailable(from: '7.3')] #[LanguageLevelTypeAware(['8.0' => 'int|null'], default: 'int')] $scale = null
    ) {}

    /**
     * Compare two arbitrary precision numbers
     * @link https://php.net/manual/en/function.bccomp.php
     * @param string $num1 <p>
     * The left operand, as a string.
     * </p>
     * @param string $num2 <p>
     * The right operand, as a string.
     * </p>
     * @param int|null $scale <p>
     * The optional <i>scale</i> parameter is used to set the
     * number of digits after the decimal place which will be used in the
     * comparison.
     * </p>
     * @return int 0 if the two operands are equal, 1 if the
     * <i>left_operand</i> is larger than the
     * <i>right_operand</i>, -1 otherwise.
     */
    #[Pure]
    function bccomp(string $num1, string $num2, ?int $scale = null): int {}

    /**
     * Raise an arbitrary precision number to another, reduced by a specified modulus
     * @link https://php.net/manual/en/function.bcpowmod.php
     * @param string $num <p>
     * The base, as an integral string (i.e. the scale has to be zero).
     * </p>
     * @param string $exponent <p>
     * The exponent, as an non-negative, integral string (i.e. the scale has to be
     * zero).
     * </p>
     * @param string $modulus <p>
     * The modulus, as an integral string (i.e. the scale has to be zero).
     * </p>
     * @param int|null $scale <p>
     * This optional parameter is used to set the number of digits after the
     * decimal place in the result. If omitted, it will default to the scale
     * set globally with the {@link bcscale()} function, or fallback to 0 if
     * this has not been set.
     * </p>
     * @return string|null the result as a string, or <b>NULL</b> if <i>modulus</i>
     * is 0 or <i>exponent</i> is negative.
     * @throws \ValueError This function throws a ValueError in the following cases: num, exponent
     * or modulus is not a well-formed BCMath numeric string; num, exponent or modulus has a
     * fractional part; exponent is a negative value; scale is outside the valid range
     * @throws \DivisionByZeroError This function throws a DivisionByZeroError exception if modulus
     * is 0.
     */
    #[Pure]
    #[LanguageLevelTypeAware(["8.0" => "string"], default: "string|null")]
    function bcpowmod(string $num, string $exponent, string $modulus, ?int $scale = null) {}

    /**
     * Round down arbitrary precision number
     *
     * Returns the next lowest integer value by rounding down num if necessary.
     *
     * @link https://php.net/manual/en/function.bcfloor.php
     * @since 8.4
     */
    function bcfloor(string $num): string {}

    /**
     * Round up arbitrary precision number
     *
     * Returns the next highest integer value by rounding up num if necessary.
     *
     * @link https://php.net/manual/en/function.bcceil.php
     * @since 8.4
     * @throws \ValueError This function throws a ValueError if num is not a well-formed BCMath
     * numeric string.
     */
    function bcceil(string $num): string {}

    /**
     * Round arbitrary precision number
     *
     * Returns the rounded value of num to specified precision (number of digits after the decimal
     * point). precision can also be negative or zero (default).
     *
     * @link https://php.net/manual/en/function.bcround.php
     * @since 8.4
     * @throws \ValueError This function throws a ValueError in the following cases: num is not a
     * well-formed BCMath numeric string. An invalid mode is specified.
     */
    function bcround(string $num, int $precision = 0, RoundingMode $mode = RoundingMode::HalfAwayFromZero): string {}

    /**
     * Get the quotient and modulus of an arbitrary precision number
     *
     * Get the quotient and remainder of dividing num1 by num2.
     *
     * @link https://php.net/manual/en/function.bcdivmod.php
     * @return string[] Returns an indexed array where the first element is the quotient as a string
     * and the second element is the remainder as a string.
     */
    function bcdivmod(string $num1, string $num2, ?int $scale = null): array {}
}

namespace BcMath {
    /**
     * A class for an arbitrary precision number. These objects support overloaded arithmetic and
     * comparison operators.
     * @link https://php.net/manual/en/class.bcmath-number.php
     * @since 8.4
     */
    final readonly class Number implements \Stringable
    {
        /** @var numeric-string */
        public readonly string $value;
        public readonly int $scale;

        /**
         * Creates a BcMath\Number object
         *
         * Creates a BcMath\Number object from an int or string value.
         *
         * @link https://php.net/manual/en/bcmath-number.construct.php
         * @param int|numeric-string $num An int or string value. If num is a int, the
         * BcMath\Number::scale is always set to 0. If num is a string, it must be a valid number,
         * and the BcMath\Number::scale is automatically set by parsing the string.
         * @throws \ValueError
         */
        public function __construct(string|int $num) {}

        /**
         * Adds an arbitrary precision number
         *
         * Adds $this and num.
         *
         * @link https://php.net/manual/en/bcmath-number.add.php
         * @param Number|int|numeric-string $num The value to add.
         * @param int|null $scale BcMath\Number::scale explicitly specified for calculation results.
         * If null, the BcMath\Number::scale of the calculation result will be set automatically.
         * @throws \ValueError
         */
        public function add(Number|string|int $num, ?int $scale = null): Number {}

        /**
         * Subtracts an arbitrary precision number
         *
         * Subtracts num from $this.
         *
         * @link https://php.net/manual/en/bcmath-number.sub.php
         * @param Number|int|numeric-string $num The value to subtract.
         * @param int|null $scale BcMath\Number::scale explicitly specified for calculation results.
         * If null, the BcMath\Number::scale of the calculation result will be set automatically.
         * @throws \ValueError
         */
        public function sub(Number|string|int $num, ?int $scale = null): Number {}

        /**
         * Multiplies an arbitrary precision number
         *
         * Multiplies $this by num.
         *
         * @link https://php.net/manual/en/bcmath-number.mul.php
         * @param Number|int|numeric-string $num The multiplier.
         * @param int|null $scale BcMath\Number::scale explicitly specified for calculation results.
         * If null, the BcMath\Number::scale of the calculation result will be set automatically.
         * @throws \ValueError
         */
        public function mul(Number|string|int $num, ?int $scale = null): Number {}

        /**
         * Divides by an arbitrary precision number
         *
         * Divides $this by num.
         *
         * @link https://php.net/manual/en/bcmath-number.div.php
         * @param Number|int|numeric-string $num The divisor.
         * @param int|null $scale BcMath\Number::scale explicitly specified for calculation results.
         * If null, the BcMath\Number::scale of the calculation result will be set automatically.
         * @throws \DivisionByZeroError
         * @throws \ValueError
         */
        public function div(Number|string|int $num, ?int $scale = null): Number {}

        /**
         * Gets the modulus of an arbitrary precision number
         *
         * Gets the remainder of dividing $this by num. Unless num is 0, the result has the same
         * sign as $this.
         *
         * @link https://php.net/manual/en/bcmath-number.mod.php
         * @param Number|int|numeric-string $num The divisor.
         * @param int|null $scale
         * @throws \DivisionByZeroError
         * @throws \ValueError
         */
        public function mod(Number|string|int $num, ?int $scale = null): Number {}

        /**
         * Gets the quotient and modulus of an arbitrary precision number
         *
         * Gets the quotient and remainder of dividing $this by num.
         *
         * @link https://php.net/manual/en/bcmath-number.divmod.php
         * @param Number|int|numeric-string $num The divisor.
         * @param int|null $scale
         * @return array{Number, Number} Returns an indexed array where the first element is the
         * quotient as a new BcMath\Number object and the second element is the remainder as a new
         * BcMath\Number object. The quotient is always an integer value, so BcMath\Number::scale of
         * the quotient will always be 0, regardless of whether explicitly specify scale. If scale
         * is explicitly specified, BcMath\Number::scale of the remainder will be the specified
         * value. When the BcMath\Number::scale of the result's remainder object is automatically
         * set, the greater BcMath\Number::scale of the two numbers used for modulus operation is
         * used. That is, if the BcMath\Number::scales of two values are 2 and 5 respectively, the
         * BcMath\Number::scale of the remainder will be 5.
         * @throws \DivisionByZeroError
         * @throws \ValueError
         */
        public function divmod(Number|string|int $num, ?int $scale = null): array {}

        /**
         * Raises an arbitrary precision number, reduced by a specified modulus
         *
         * Use the fast-exponentiation method to raise $this to the power exponent with respect to
         * the modulus modulus.
         *
         * @link https://php.net/manual/en/bcmath-number.powmod.php
         * @param Number|int|numeric-string $exponent The exponent, as an non-negative and integral
         * (i.e. the scale has to be zero).
         * @param Number|int|numeric-string $modulus The modulus, as an integral (i.e. the scale has
         * to be zero).
         * @param int|null $scale BcMath\Number::scale explicitly specified for calculation results.
         * If null, the BcMath\Number::scale of the calculation result will be set automatically.
         * @throws \DivisionByZeroError
         * @throws \ValueError
         */
        public function powmod(Number|string|int $exponent, Number|string|int $modulus, ?int $scale = null): Number {}

        /**
         * Raises an arbitrary precision number
         *
         * Raises $this to the exponent power.
         *
         * @link https://php.net/manual/en/bcmath-number.pow.php
         * @param Number|int|numeric-string $exponent The exponent. Must be a value with no
         * fractional part. The valid range of the exponent is platform specific, but it is at least
         * -2147483648 to 2147483647.
         * @param int|null $scale BcMath\Number::scale explicitly specified for calculation results.
         * If null, the BcMath\Number::scale of the calculation result will be set automatically.
         * @throws \DivisionByZeroError
         * @throws \ValueError
         */
        public function pow(Number|string|int $exponent, ?int $scale = null): Number {}

        /**
         * Gets the square root of an arbitrary precision number
         *
         * Return the square root of $this.
         *
         * @link https://php.net/manual/en/bcmath-number.sqrt.php
         * @throws \ValueError
         */
        public function sqrt(?int $scale = null): Number {}

        /**
         * Rounds down an arbitrary precision number
         *
         * Returns the next highest integer value by rounding down $this if necessary.
         *
         * @link https://php.net/manual/en/bcmath-number.floor.php
         * @return Number Returns the result as a new BcMath\Number object. The BcMath\Number::scale
         * of the result is always 0.
         */
        public function floor(): Number {}

        /**
         * Rounds up an arbitrary precision number
         *
         * Returns the next highest integer value by rounding up $this if necessary.
         *
         * @link https://php.net/manual/en/bcmath-number.ceil.php
         * @return Number Returns the result as a new BcMath\Number object. The BcMath\Number::scale
         * of the result is always 0.
         */
        public function ceil(): Number {}

        /**
         * Rounds an arbitrary precision number
         *
         * Returns the rounded value of $this to specified precision (number of digits after the
         * decimal point). precision can also be negative or zero (default).
         *
         * @link https://php.net/manual/en/bcmath-number.round.php
         * @throws \ValueError
         */
        public function round(int $precision = 0, \RoundingMode $mode = \RoundingMode::HalfAwayFromZero): Number {}

        /**
         * Compares two arbitrary precision numbers
         *
         * Compare two arbitrary precision numbers. This method behaves similar to the spaceship
         * operator.
         *
         * @link https://php.net/manual/en/bcmath-number.compare.php
         * @param Number|int|numeric-string $num The value to be compared to.
         * @param int|null $scale Specify the scale to use for comparison. If null, all digits are
         * used in the comparison.
         * @return int Returns -1, 0, or 1
         * @throws \ValueError
         */
        public function compare(Number|string|int $num, ?int $scale = null): int {}

        /**
         * Converts BcMath\Number to string
         * @link https://php.net/manual/en/bcmath-number.tostring.php
         * @return string Returns BcMath\Number::value as a string.
         */
        public function __toString(): string {}

        /**
         * Serializes a BcMath\Number object
         *
         * Serializes $this.
         *
         * @link https://php.net/manual/en/bcmath-number.serialize.php
         * @return array{value:numeric-string}
         */
        public function __serialize(): array {}

        /**
         * Deserializes a data parameter into a BcMath\Number object
         * @link https://php.net/manual/en/bcmath-number.unserialize.php
         * @param array{value:numeric-string} $data The serialized data parameter as an associative
         * array
         * @throws \ValueError This method throws a ValueError if invalid serialized data is passed.
         */
        public function __unserialize(array $data): void {}
    }
}
