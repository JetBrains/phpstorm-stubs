<?php

namespace {
    use JetBrains\PhpStorm\Deprecated as Deprecated;
    use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;
    use JetBrains\PhpStorm\Internal\PhpStormStubsElementAvailable;
    use JetBrains\PhpStorm\Pure;

    /**
     * Combined linear congruential generator
     * @link https://php.net/manual/en/function.lcg-value.php
     * @return float A pseudo random float value in the range of (0, 1)
     */
    #[Deprecated("The function is deprecated", since: "8.4")]
    function lcg_value(): float {}

    /**
     * Seeds the Mersenne Twister Random Number Generator
     * @link https://php.net/manual/en/function.mt-srand.php
     * @param int|null $seed <p>
     * An optional seed value
     * </p>
     * @param int $mode [optional] <p>
     * Use one of the following constants to specify the implementation of the algorithm to use.
     * </p>
     * @return void No value is returned.
     */
    function mt_srand(
        #[LanguageLevelTypeAware(['8.3' => 'int|null'], default: 'int')] $seed = null,
        #[PhpStormStubsElementAvailable(from: '7.1')] int $mode = MT_RAND_MT19937
    ): void {}

    /**
     * Seed the random number generator
     * <p><strong>Note</strong>: As of PHP 7.1.0, {@see srand()} has been made
     * an alias of {@see mt_srand()}.
     * </p>
     * @link https://php.net/manual/en/function.srand.php
     * @param int|null $seed <p>
     * Optional seed value
     * </p>
     * @param int $mode [optional] <p>
     * Use one of the following constants to specify the implementation of the algorithm to use.
     * </p>
     * @return void No value is returned.
     */
    function srand(
        #[LanguageLevelTypeAware(['8.3' => 'int|null'], default: 'int')] $seed = null,
        #[PhpStormStubsElementAvailable(from: '7.1')] int $mode = MT_RAND_MT19937
    ): void {}

    /**
     * Generate a random integer
     * @link https://php.net/manual/en/function.rand.php
     * @param int $min [optional]
     * @param int $max [optional]
     * @return int A pseudo random value between min
     * (or 0) and max (or getrandmax, inclusive).
     */
    function rand(int $min, int $max): int {}

    /**
     * Generate a random value via the Mersenne Twister Random Number Generator
     * @link https://php.net/manual/en/function.mt-rand.php
     * @param int $min [optional] <p>
     * Optional lowest value to be returned (default: 0)
     * </p>
     * @param int $max [optional] <p>
     * Optional highest value to be returned (default: mt_getrandmax())
     * </p>
     * @return int A random integer value between min (or 0)
     * and max (or mt_getrandmax, inclusive)
     * @throws \ValueError If max is less than min, a ValueError will be thrown.
     */
    function mt_rand(int $min, int $max): int {}

    /**
     * Show largest possible random value
     * @link https://php.net/manual/en/function.mt-getrandmax.php
     * @return int the maximum random value returned by mt_rand
     */
    #[Pure]
    function mt_getrandmax(): int {}

    /**
     * Show largest possible random value
     * @link https://php.net/manual/en/function.getrandmax.php
     * @return int The largest possible random value returned by rand
     */
    #[Pure]
    function getrandmax(): int {}

    /**
     * Generates cryptographically secure pseudo-random bytes
     * @link https://php.net/manual/en/function.random-bytes.php
     * @param int $length The length of the random string that should be returned in bytes.
     * @return string Returns a string containing the requested number of cryptographically secure random bytes.
     * @since 7.0
     * @throws Random\RandomException if an appropriate source of randomness cannot be found.
     */
    function random_bytes(int $length): string {}

    /**
     * Generates cryptographically secure pseudo-random integers
     * @link https://php.net/manual/en/function.random-int.php
     * @param int $min The lowest value to be returned, which must be PHP_INT_MIN or higher.
     * @param int $max The highest value to be returned, which must be less than or equal to PHP_INT_MAX.
     * @return int Returns a cryptographically secure random integer in the range min to max, inclusive.
     * @since 7.0
     * @throws Random\RandomException if an appropriate source of randomness cannot be found.
     */
    function random_int(int $min, int $max): int {}
}

namespace Random\Engine
{
    use const MT_RAND_MT19937;

    /**
     * Implements the Mt19937 (“Mersenne Twister”) algorithm.
     * @link https://php.net/manual/en/class.random-engine-mt19937.php
     * @since 8.2
     */
    final class Mt19937 implements \Random\Engine
    {
        /**
         * Constructs a new Mt19937 engine
         * @link https://php.net/manual/en/random-engine-mt19937.construct.php
         * @param int|null $seed Fills the state with values generated with a linear congruential
         * generator that was seeded with seed interpreted as an unsigned 32 bit integer. If seed is
         * omitted or null, a random unsigned 32 bit integer will be used.
         * @param int $mode Use one of the following constants to specify the implementation of the
         * algorithm to use. MT_RAND_MT19937: The correct Mt19937 implementation. MT_RAND_PHP: An
         * incorrect implementation for backwards compatibility with mt_srand prior to PHP 7.1.0.
         * This feature has been DEPRECATED as of PHP 8.3.0. Relying on this feature is highly
         * discouraged.
         */
        public function __construct(int|null $seed = null, int $mode = MT_RAND_MT19937) {}

        /**
         * Generate 32 bits of randomness
         * @link https://php.net/manual/en/random-engine-mt19937.generate.php
         * @return string A string representing an unsigned 32 bit integer in little-endian order.
         */
        public function generate(): string {}

        /**
         * Serializes the Mt19937 object
         * @link https://php.net/manual/en/random-engine-mt19937.serialize.php
         * @return array
         */
        public function __serialize(): array {}

        /**
         * Deserializes the data parameter into a Mt19937 object
         * @link https://php.net/manual/en/random-engine-mt19937.unserialize.php
         * @param array $data
         * @return void No value is returned.
         */
        public function __unserialize(array $data): void {}

        /**
         * Returns the internal state of the engine
         * @link https://php.net/manual/en/random-engine-mt19937.debuginfo.php
         * @return array
         */
        public function __debugInfo(): array {}
    }

    /**
     * Implements a Permuted congruential generator (PCG) with 128 bits of state, XSL and RR output
     * transformations, and 64 bits of output.
     * @link https://php.net/manual/en/class.random-engine-pcgoneseq128xslrr64.php
     * @since 8.2
     */
    final class PcgOneseq128XslRr64 implements \Random\Engine
    {
        /**
         * Constructs a new PCG Oneseq 128 XSL RR 64 engine
         * @link https://php.net/manual/en/random-engine-pcgoneseq128xslrr64.construct.php
         * @param string|int|null $seed How the internal 128 bit (16 byte) state consisting of one
         * unsigned 128 bit integer is seeded depends on the type used as the seed. Type Description
         * null Fills the state with 16 random bytes generated using the CSPRNG. int Fills the state
         * by setting the state to 0, advancing the engine one step, adding the value of seed
         * interpreted as an unsigned 64 bit integer, and advancing the engine another step. string
         * Fills the state by interpreting a 16 byte string as a little-endian unsigned 128 bit
         * integer.
         * @throws \ValueError If the length of a string seed is not 16 bytes, a ValueError will be
         * thrown.
         */
        public function __construct(string|int|null $seed = null) {}

        /**
         * Generate 64 bits of randomness
         * @link https://php.net/manual/en/random-engine-pcgoneseq128xslrr64.generate.php
         * @return string A string representing an unsigned 64 bit integer in little-endian order.
         */
        public function generate(): string {}

        /**
         * Efficiently move the engine ahead multiple steps
         *
         * Moves the algorithm’s state ahead by the number of steps given by advance, as if
         * Random\Engine\PcgOneseq128XslRr64::generate was called that many times.
         *
         * @link https://php.net/manual/en/random-engine-pcgoneseq128xslrr64.jump.php
         * @param int $advance The number of steps to move ahead; must be 0 or greater.
         * @return void No value is returned.
         * @throws \ValueError If advance is less than 0, a ValueError will be thrown.
         */
        public function jump(int $advance): void {}

        /**
         * Serializes the PcgOneseq128XslRr64 object
         * @link https://php.net/manual/en/random-engine-pcgoneseq128xslrr64.serialize.php
         * @return array
         */
        public function __serialize(): array {}

        /**
         * Deserializes the data parameter into a PcgOneseq128XslRr64 object
         * @link https://php.net/manual/en/random-engine-pcgoneseq128xslrr64.unserialize.php
         * @param array $data
         * @return void No value is returned.
         */
        public function __unserialize(array $data): void {}

        /**
         * Returns the internal state of the engine
         * @link https://php.net/manual/en/random-engine-pcgoneseq128xslrr64.debuginfo.php
         * @return array
         */
        public function __debugInfo(): array {}
    }

    /**
     * Implements the xoshiro256** algorithm.
     * @link https://php.net/manual/en/class.random-engine-xoshiro256starstar.php
     * @since 8.2
     */
    final class Xoshiro256StarStar implements \Random\Engine
    {
        /**
         * Constructs a new xoshiro256** engine
         * @link https://php.net/manual/en/random-engine-xoshiro256starstar.construct.php
         * @param string|int|null $seed How the internal 256 bit (32 byte) state consisting of four
         * unsigned 64 bit integers is seeded depends on the type used as the seed. Type Description
         * null Fills the state with 32 random bytes generated using the CSPRNG. int Fills the state
         * with four consecutive values generated with the SplitMix64 algorithm that was seeded with
         * seed interpreted as an unsigned 64 bit integer. string Fills the state by interpreting a
         * 32 byte string as four little-endian unsigned 64 bit integers.
         * @throws \ValueError If the length of a string seed is not 32 bytes, a ValueError will be
         * thrown. If a string seed consists of 32 NUL bytes ("\x00"), a ValueError will be thrown.
         */
        public function __construct(string|int|null $seed = null) {}

        /**
         * Generate 64 bits of randomness
         * @link https://php.net/manual/en/random-engine-xoshiro256starstar.generate.php
         * @return string A string representing an unsigned 64 bit integer in little-endian order.
         */
        public function generate(): string {}

        /**
         * Efficiently move the engine ahead by 2^128 steps
         *
         * Moves the algorithm’s state ahead by 2128 steps, as if
         * Random\Engine\Xoshiro256StarStar::generate was called 2128 times.
         *
         * @link https://php.net/manual/en/random-engine-xoshiro256starstar.jump.php
         * @return void No value is returned.
         */
        public function jump(): void {}

        /**
         * Efficiently move the engine ahead by 2^192 steps
         *
         * Moves the algorithm’s state ahead by 2192 steps, as if
         * Random\Engine\Xoshiro256StarStar::generate was called 2192 times.
         *
         * @link https://php.net/manual/en/random-engine-xoshiro256starstar.jumplong.php
         * @return void No value is returned.
         */
        public function jumpLong(): void {}

        /**
         * Serializes the Xoshiro256StarStar object
         * @link https://php.net/manual/en/random-engine-xoshiro256starstar.serialize.php
         * @return array
         */
        public function __serialize(): array {}

        /**
         * Deserializes the data parameter into a Xoshiro256StarStar object
         * @link https://php.net/manual/en/random-engine-xoshiro256starstar.unserialize.php
         * @param array $data
         * @return void No value is returned.
         */
        public function __unserialize(array $data): void {}

        /**
         * Returns the internal state of the engine
         * @link https://php.net/manual/en/random-engine-xoshiro256starstar.debuginfo.php
         * @return array
         */
        public function __debugInfo(): array {}
    }

    /**
     * Generates cryptographically secure randomness using the operating system’s CSPRNG.
     *
     * The randomness generated by this Random\Engine is suitable for all applications, including
     * the generation of long-term secrets, such as encryption keys. The Random\Engine\Secure engine
     * is the recommended safe default choice, unless the application requires either reproducible
     * sequences or very high performance.
     *
     * @link https://php.net/manual/en/class.random-engine-secure.php
     * @since 8.2
     */
    final class Secure implements \Random\CryptoSafeEngine
    {
        /**
         * Generate cryptographically secure randomness
         *
         * Returns cryptographically secure randomness.
         *
         * @link https://php.net/manual/en/random-engine-secure.generate.php
         * @return string A string containing PHP_INT_SIZE cryptographically secure random bytes.
         * @throws \Random\RandomException If an appropriate source of randomness cannot be found, a
         * Random\RandomException will be thrown.
         */
        public function generate(): string {}
    }
}

namespace Random
{
    use Error;
    use Exception;

    /**
     * A Random\Engine provides a low-level source of randomness by returning random bytes that are
     * consumed by high-level APIs to perform their operations. The Random\Engine interface allows
     * swapping out the algorithm used to generate randomness, because each algorithm makes
     * different tradeoffs to fit specific use-cases. Some algorithms are very fast, but generate
     * lower-quality randomness, whereas other algorithms are slower, but generate better
     * randomness, up to cryptographically secure randomness as provided by the Random\Engine\Secure
     * engine.
     *
     * PHP provides several Random\Engines out of the box to accommodate different use-cases. The
     * Random\Engine\Secure engine that is backed by a CSPRNG is the recommended safe default
     * choice, unless the application requires either reproducible sequences or very high
     * performance.
     *
     * @link https://php.net/manual/en/class.random-engine.php
     * @since 8.2
     */
    interface Engine
    {
        /**
         * Generates randomness
         *
         * Returns randomness and advances the algorithm’s state by one step.
         *
         * @link https://php.net/manual/en/random-engine.generate.php
         * @return string A non-empty string containing random bytes. The Random\Randomizer works
         * with unsigned 64 bit integers internally. If the returned string contains more than 64
         * bit (8 byte) of randomness the exceeding bytes will be ignored. Other applications may be
         * able to process more than 64 bit at once.
         * @throws \Random\RandomException If generating randomness fails, a Random\RandomException
         * should be thrown. Any other Exception thrown during generation should be caught and
         * wrapped into a Random\RandomException.
         * @throws \Random\BrokenRandomEngineError If generating randomness fails, a
         * Random\RandomException should be thrown. Any other Exception thrown during generation
         * should be caught and wrapped into a Random\RandomException. If the returned string is
         * empty, a Random\BrokenRandomEngineError will be thrown by the Random\Randomizer. If the
         * implemented algorithm is severely biased, a Random\BrokenRandomEngineError may be thrown
         * by the Random\Randomizer to prevent infinite loops if rejection sampling is required to
         * return unbiased results.
         */
        public function generate(): string;
    }
    /**
     * A marker interface indicating that the Random\Engine returns cryptographically secure
     * randomness.
     * @link https://php.net/manual/en/class.random-cryptosafeengine.php
     * @since 8.2
     */
    interface CryptoSafeEngine extends Engine {}

    /**
     * Provides a high-level API to the randomness provided by an Random\Engine.
     * @link https://php.net/manual/en/class.random-randomizer.php
     * @since 8.2
     */
    final class Randomizer
    {
        public readonly Engine $engine;

        /**
         * Constructs a new Randomizer
         * @link https://php.net/manual/en/random-randomizer.construct.php
         * @param Engine|null $engine The Random\Engine to use to generate randomness. If engine is
         * omitted or null, a new Random\Engine\Secure object will be used.
         */
        public function __construct(?Engine $engine = null) {}

        /**
         * Get a positive integer
         * @link https://php.net/manual/en/random-randomizer.nextint.php
         * @return int A positive integer between 0 and a maximum value depending on the number of
         * bytes returned from Random\Engine::generate. The exact maximum can be calculated as
         * 2$engine_bytes * 8 - 1 - 1.
         * @throws \Random\RandomException To avoid inconsistencies, 32 bit PHP will throw
         * Random\RandomException if the output size of Random\Engine::generate exceeds 32 bits, as
         * the selected integer cannot be returned losslessly. This affects the native 64 bit
         * engines Random\Engine\PcgOneseq128XslRr64 and Random\Engine\Xoshiro256StarStar. Any
         * userland engine returning more than 4 bytes of randomness is also affected. Any
         * Throwables thrown by the Random\Engine::generate method of the underlying
         * Random\Randomizer::$engine.
         */
        public function nextInt(): int {}

        /**
         * Get a uniformly selected integer
         * @link https://php.net/manual/en/random-randomizer.getint.php
         * @param int $min The lowest value to be returned.
         * @param int $max The highest value to be returned.
         * @return int A uniformly selected integer from the closed interval [min, max]. Both min
         * and max are possible return values.
         * @throws \ValueError If max is less than min, a ValueError will be thrown. Any Throwables
         * thrown by the Random\Engine::generate method of the underlying
         * Random\Randomizer::$engine.
         */
        public function getInt(int $min, int $max): int {}

        /**
         * Get random bytes
         *
         * Generates a string containing uniformly selected random bytes with the requested length.
         *
         * @link https://php.net/manual/en/random-randomizer.getbytes.php
         * @param int $length The length of the random string that should be returned in bytes; must
         * be 1 or greater.
         * @return string A string containing the requested number of random bytes.
         * @throws \ValueError If the value of length is less than 1, a ValueError will be thrown.
         * Any Throwables thrown by the Random\Engine::generate method of the underlying
         * Random\Randomizer::$engine.
         */
        public function getBytes(int $length): string {}

        /**
         * Get a permutation of an array
         *
         * Returns a uniformly selected permutation of the input array.
         *
         * @link https://php.net/manual/en/random-randomizer.shufflearray.php
         * @param array $array The array whose values are shuffled. The input array will not be
         * modified.
         * @return array A permutation of the values of array. Array keys of the input array will
         * not be preserved; the returned array will be a list (array_is_list).
         */
        public function shuffleArray(array $array): array {}

        /**
         * Get a byte-wise permutation of a string
         *
         * Returns a uniformly selected permutation of the input bytes.
         *
         * @link https://php.net/manual/en/random-randomizer.shufflebytes.php
         * @param string $bytes The string whose bytes are shuffled. The input string will not be
         * modified.
         * @return string A permutation of the bytes of bytes.
         */
        public function shuffleBytes(string $bytes): string {}

        /**
         * Select random array keys
         *
         * Uniformly selects num distinct array keys of the input array.
         *
         * @link https://php.net/manual/en/random-randomizer.pickarraykeys.php
         * @param array $array The array whose array keys are selected.
         * @param int $num The number of array keys to return; must be between 1 and the number of
         * elements in array.
         * @return array An array containing num distinct array keys of array. The returned array
         * will be a list (array_is_list). It will be a subset of the array returned by array_keys.
         * @throws \ValueError If num is less than 1 or greater than the number of elements in
         * array, a ValueError will be thrown. Any Throwables thrown by the Random\Engine::generate
         * method of the underlying Random\Randomizer::$engine.
         */
        public function pickArrayKeys(array $array, int $num): array {}

        /**
         * Serializes the Randomizer object
         * @link https://php.net/manual/en/random-randomizer.serialize.php
         * @return array
         */
        public function __serialize(): array {}

        /**
         * Deserializes the data parameter into a Randomizer object
         * @link https://php.net/manual/en/random-randomizer.unserialize.php
         * @param array $data
         * @return void No value is returned.
         */
        public function __unserialize(array $data): void {}

        /**
         * Get a float from the right-open interval [0.0, 1.0)
         *
         * Returns a uniformly selected, equidistributed float from the right-open interval from 0.0
         * until, but not including, 1.0.
         *
         * @link https://php.net/manual/en/random-randomizer.nextfloat.php
         * @since 8.3
         */
        public function nextFloat(): float {}

        /**
         * Get a uniformly selected float
         *
         * Returns a uniformly selected, equidistributed float from a requested interval.
         *
         * @link https://php.net/manual/en/random-randomizer.getfloat.php
         * @since 8.3
         * @throws \ValueError If the value of min is not finite (is_finite), a ValueError will be
         * thrown. If the value of max is not finite (is_finite), a ValueError will be thrown. If
         * the requested interval does not contain any values, a ValueError will be thrown. Any
         * Throwables thrown by the Random\Engine::generate method of the underlying
         * Random\Randomizer::$engine.
         */
        public function getFloat(float $min, float $max, IntervalBoundary $boundary = IntervalBoundary::ClosedOpen): float {}

        /**
         * Get random bytes from a source string
         *
         * Generates a string containing uniformly selected random bytes from the input string with
         * the requested length.
         *
         * @link https://php.net/manual/en/random-randomizer.getbytesfromstring.php
         * @since 8.3
         * @throws \ValueError If string is empty, a ValueError will be thrown. If the value of
         * length is less than 1, a ValueError will be thrown. Any Throwables thrown by the
         * Random\Engine::generate method of the underlying Random\Randomizer::$engine.
         */
        public function getBytesFromString(string $string, int $length): string {}
    }

    /**
     * The base class for Errors that occur during generation or use of randomness.
     * @link https://php.net/manual/en/class.random-randomerror.php
     * @since 8.2
     */
    class RandomError extends Error {}

    /**
     * Indicates that the used Random\Engine is broken, e.g. because it is severely biased.
     * @link https://php.net/manual/en/class.random-brokenrandomengineerror.php
     * @since 8.2
     */
    class BrokenRandomEngineError extends RandomError {}

    /**
     * The base class for Exceptions that occur during generation or use of randomness.
     * @link https://php.net/manual/en/class.random-randomexception.php
     * @since 8.2
     */
    class RandomException extends Exception {}

    /**
     * @since 8.3
     */
    enum IntervalBoundary implements \UnitEnum
    {
        public string $name;

        case ClosedOpen;
        case ClosedClosed;
        case OpenClosed;
        case OpenOpen;

        public static function cases(): array {}
    }
}
