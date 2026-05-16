<?php

// Start of FFI v.0.1.0

namespace {
    use FFI\CData;
    use FFI\CType;
    use FFI\ParserException;

    /**
     * FFI class provides access to a simple way to call native functions,
     * access native variables and create/access data structures defined
     * in the C language.
     *
     * @since 7.4
     */
    final class FFI
    {
        public const int __BIGGEST_ALIGNMENT__ = 8;

        /**
         * The method creates a binding on the existing C function.
         *
         * All variables and functions defined by first arguments are bound
         * to corresponding native symbols in a DSO library and then may be
         * accessed as FFI object methods and properties. C types of argument,
         * return value, and variables are automatically converted to/from PHP
         * types (if possible). Otherwise, they are wrapped in a special CData
         * proxy object and may be accessed by elements.
         *
         * @link https://www.php.net/manual/en/ffi.cdef.php
         *
         * @param string $code A string containing a sequence of declarations
         *        in regular C language (types, structures, functions, variables,
         *        etc). Actually, this string may be copy-pasted from C header files.
         *
         *        Note: C preprocessor directives are not supported, i.e.
         *              `#include`, `#define` and CPP macros do not work.
         * @param string|null $lib The name of a shared library file, to be
         *        loaded and linked with the definitions.
         *
         *        Note: If lib is omitted or {@see null}, platforms supporting
         *              RTLD_DEFAULT attempt to lookup symbols declared in code
         *              in the normal global scope. Other systems will fail to
         *              resolve these symbols.
         *
         * @return FFI Returns the freshly created FFI object.
         * @throws ParserException
         */
        public static function cdef(string $code = '', ?string $lib = null): FFI {}

        /**
         * Instead of embedding of a long C definition into a PHP string
         * and creating FFI through {@see FFI::cdef()}, it's possible to
         * separate it into a C header file. Note that C preprocessor
         * directives (e.g., `#define` or `#ifdef`) are not supported. And
         * only a couple of special macros may be used, especially for FFI.
         *
         * ```c
         * #define FFI_LIB "libc.so.6"
         *
         * int printf(const char *format, ...);
         * ```
         *
         * Here, `FFI_LIB` specifies that the given library should be loaded.
         *
         * ```php
         * $ffi = FFI::load(__DIR__ . "/printf.h");
         * $ffi->printf("Hello world!\n");
         * ```
         *
         * @link https://www.php.net/manual/en/ffi.load.php
         *
         * @param string $filename The name of a C header file. C preprocessor
         *        directives are not supported, i.e. `#include`, `#define` and
         *        CPP macros do not work, except for special cases listed below.
         *        The header file should contain a #define statement for the
         *        `FFI_SCOPE` variable, e.g.: `#define FFI_SCOPE "MYLIB"`. Refer
         *        to the class introduction for details. The header file may
         *        contain a `#define` statement for the `FFI_LIB` variable to
         *        specify the library it exposes. If it is a system library only
         *        the file name is required, e.g.: `#define FFI_LIB "libc.so.6"`.
         *        If it is a custom library, a relative path is required,
         *        e.g.: `#define FFI_LIB "./mylib.so"`.
         *
         * @return FFI|null Returns the freshly created {@see FFI} object,
         *         or {@see null} on failure.
         */
        public static function load(string $filename): ?FFI {}

        /**
         * FFI definition parsing and shared library loading may take
         * significant time. It's not useful to do it on each HTTP request in
         * the WEB environment. However, it's possible to preload FFI
         * definitions and libraries at php startup, and instantiate FFI objects
         * when necessary. Header files may be extended with `FFI_SCOPE` define
         * (default preloading scope is "C"). This name is going to be
         * used as {@see FFI::scope()} argument. It's possible to preload a few
         * files into a single scope.
         *
         * ```c
         * #define FFI_LIB "libc.so.6"
         * #define FFI_SCOPE "libc"
         *
         * int printf(const char *format, ...);
         * ```
         *
         * These files are loaded through the same FFI::load() load function,
         * executed from a file loaded by `opcache.preload` in the `php.ini`
         * directive.
         *
         * ```c
         * ffi.preload=/etc/php/ffi/printf.h
         * ```
         *
         * Finally, FFI::scope() instantiates an FFI object that implements
         * all C definitions from the given scope.
         *
         * ```php
         * $ffi = FFI::scope("libc");
         * $ffi->printf("Hello world!\n");
         * ```
         *
         * @link https://www.php.net/manual/en/ffi.scope.php
         *
         * @param string $name The scope name defined by a special `FFI_SCOPE` define.
         *
         * @return FFI Returns the freshly created {@see FFI} object.
         */
        public static function scope(string $name): FFI {}

        /**
         * Method that creates an arbitrary C structure.
         *
         * Creates a native data structure of the given C type. Any type
         * declared for the instance is allowed.
         *
         * Note: Calling {@see FFI::new()} statically is deprecated since PHP 8.3.
         *
         * @link https://www.php.net/manual/en/ffi.new.php
         *
         * @param string|CType $type is a valid C declaration as {@see string},
         *        or an instance of {@see FFI\CType} which has already been created.
         * @param bool $owned Whether to create owned (i.e. managed) or unmanaged
         *        data. Managed data lives together with the returned
         *        {@see FFI\CData} object, and is released when the last
         *        reference to that object is released by regular PHP
         *        reference counting or GC. Unmanaged data should be released
         *        by calling {@see FFI::free()}, when no longer needed.
         * @param bool $persistent Whether to allocate the C data structure
         *        permanently on the system heap (using `malloc()`), or on
         *        the PHP request heap (using `emalloc()`).
         *
         * @return CData|null Returns the freshly created {@see FFI\CData}
         *         object, or {@see null} on failure.
         * @throws ParserException
         */
        public function new(CType|string $type, bool $owned = true, bool $persistent = false): ?CData {}

        /**
         * Manually removes previously created "not-owned" data structure.
         *
         * @link https://www.php.net/manual/en/ffi.free.php
         *
         * @param CData $ptr The handle of the unmanaged pointer to a C data structure.
         */
        public static function free(CData $ptr): void {}

        /**
         * Creates a new {@see FFI\CData} object, that references the same
         * C data structure, but is associated with a different type. The
         * resulting object does not own the C data, and the source ptr must
         * survive the result. The C type may be specified as a {@see string}
         * with any valid C type declaration or as {@see FFI\CType} object,
         * created before. Any type declared for the instance is allowed.
         *
         * Note: Calling {@see FFI::cast()} statically is deprecated since PHP 8.3.
         *
         * ```php
         * $ffi = FFI::cdef();
         *
         * $int32Value = $ffi->new('int32_t');
         * $int16Array = $ffi->cast('int16_t[2]', $int32Value);
         * ```
         *
         * @link https://www.php.net/manual/en/ffi.free.php
         *
         * @param CType|string $type A valid C declaration as {@see string}, or
         *       an instance of {@see FFI\CType} which has already been created.
         * @param CData|int|float|bool|null $ptr The handle of the pointer
         *        to a C data structure.
         *
         * @return CData|null Returns the freshly created {@see FFI\CData} object.
         */
        public function cast(CType|string $type, $ptr): ?CData {}

        /**
         * This function creates and returns a {@see FFI\CType} object for
         * the given string containing a C type declaration. Any type
         * declared for the instance is allowed.
         *
         * ```php
         * $ffi = FFI::cdef();
         *
         * $type = $ffi->type('int[2][3]');
         * ```
         *
         * @link https://www.php.net/manual/en/ffi.type.php
         *
         * @param string $type A valid C declaration as {@see string}.
         * @return CType|null Returns the freshly created {@see FFI\CType}
         *         object, or {@see null} on failure.
         */
        public function type(string $type): ?CType {}

        /**
         * This function returns the FFI\CType object, representing the type of
         * the given {@see FFI\CData} object.
         *
         * @link https://www.php.net/manual/en/ffi.typeof.php
         *
         * @param CData $ptr The handle of the pointer to a C data structure.
         * @return CType Returns the {@see FFI\CType} object representing the
         *         type of the given {@see FFI\CData} object.
         */
        public static function typeof(CData $ptr): CType {}

        /**
         * Constructs a new C array type with elements of $type and
         * dimensions specified by `$dimensions`.
         *
         * ```php
         * $ffi = FFI::cdef();
         *
         * $t1 = $ffi->type('int[2][3]');
         * $t2 = FFI::arrayType($ffi->type('int'), [2, 3]);
         * ```
         *
         * @link https://www.php.net/manual/en/ffi.arraytype.php
         *
         * @param CType $type A valid C declaration as string, or an instance
         *        of {@see FFI\CType} which has already been created.
         * @param array<array-key, int<0, max>> $dimensions The dimensions of
         *        the type as {@see array}.
         *
         * @return CType Returns the freshly created {@see FFI\CType} object.
         */
        public static function arrayType(CType $type, array $dimensions): CType {}

        /**
         * Returns a C pointer to the given C data structure. The pointer is
         * not "owned" and won't be free. Anyway, this is a potentially
         * unsafe operation, because the life-time of the returned pointer
         * may be longer than the life-time of the source object, and this may
         * cause dangling pointer dereference (like in regular C).
         *
         * @link https://www.php.net/manual/en/ffi.addr.php
         *
         * @param CData $ptr The handle of the pointer to a C data structure.
         *
         * @return CData Returns the freshly created {@see FFI\CData} object.
         */
        public static function addr(CData $ptr): CData {}

        /**
         * Returns the size of a C data type of the given {@see FFI\CData}
         * or {@see FFI\CType}.
         *
         * @link https://www.php.net/manual/en/ffi.sizeof.php
         *
         * @param CData|CType $ptr The handle of the C data or type.
         *
         * @return int<0, max> The size of the memory area pointed at by ptr.
         */
        public static function sizeof(CData|CType $ptr): int {}

        /**
         * Returns the size of a C data type of the given {@see FFI\CData} or
         * {@see FFI\CType}.
         *
         * @link https://www.php.net/manual/en/ffi.alignof.php
         *
         * @param CData|CType $ptr The handle of the C data or type.
         *
         * @return int<0, max> Returns the alignment of the given
         *         {@see FFI\CData} or {@see FFI\CType} object.
         */
        public static function alignof(CData|CType $ptr): int {}

        /**
         * Copies `$size` bytes from the memory area `$from` to the memory area `$to`.
         *
         * @link https://www.php.net/manual/en/ffi.memcpy.php
         *
         * @param CData $to The start of the memory area to copy to.
         * @param CData|string $from The start of the memory area to copy from.
         * @param int<0, max> $size The number of bytes to copy.
         */
        public static function memcpy(CData $to, $from, int $size): void {}

        /**
         * Compares `$size` bytes from the memory areas `$ptr1` and `$ptr2`.
         * Both `$ptr1` and `$ptr2` can be any native data structures
         * ({@see FFI\CData}) or PHP strings.
         *
         * @link https://www.php.net/manual/en/ffi.memcmp.php
         *
         * @param CData|string $ptr1 The start of one memory area.
         * @param CData|string $ptr2 The start of another memory area.
         * @param int<0, max> $size The number of bytes to compare.
         *
         * @return int<-1, 1> Returns a value less than 0 if the contents of the
         *         memory area starting at `$ptr1` are considered less than the
         *         contents of the memory area starting at `$ptr2`, a value
         *         greater than 0 if the contents of the first memory area are
         *         considered greater than the second, and 0 if they are equal.
         */
        public static function memcmp($ptr1, $ptr2, int $size): int {}

        /**
         * Fills `$size` bytes of the memory area pointed to by `$ptr` with the
         * given byte `$value`.
         *
         * @link https://www.php.net/manual/en/ffi.memset.php
         *
         * @param CData $ptr The start of the memory area to fill.
         * @param int $value The byte to fill with.
         * @param int<0, max> $size The number of bytes to fill.
         */
        public static function memset(CData $ptr, int $value, int $size): void {}

        /**
         * Creates a PHP string from `$size` bytes of the memory area pointed
         * by `$ptr`. If size is omitted, `$ptr` must be a zero-terminated
         * array of C chars.
         *
         * @link https://www.php.net/manual/en/ffi.string.php
         *
         * @param CData $ptr The start of the memory area from which to
         *        create a PHP {@see string}.
         * @param int<0, max>|null $size The number of bytes to copy to the
         *        PHP {@see string}. If `$size` is omitted or {@see null},
         *        `$ptr` must be a zero-terminated ("\0") array of C char.
         *
         * @return string The freshly created PHP {@see string}.
         */
        public static function string(CData $ptr, ?int $size = null): string {}

        /**
         * Checks whether the FFI\CData is a null pointer.
         *
         * @link https://www.php.net/manual/en/ffi.isnull.php
         *
         * @param CData $ptr The handle of the pointer to a C data structure.
         *
         * @return bool Returns whether a {@see FFI\CData} is a null pointer.
         */
        public static function isNull(CData $ptr): bool {}
    }
}

namespace FFI {
    /**
     * General FFI exception.
     *
     * @since 7.4
     */
    class Exception extends \Error {}

    /**
     * An exception that occurs when parsing invalid header files.
     *
     * @since 7.4
     */
    class ParserException extends Exception {}

    /**
     * Proxy object that provides access to compiled structures.
     *
     * - In the case that {@see CData} is a wrapper over raw C data, it
     *   contains an additional {@see CData::$cdata} property.
     *
     * - In the case that the CData is a wrapper over an arbitrary C structure,
     *   then it allows reading and writing to the fields defined by
     *   this structure.
     *
     * - In the case that CData is a wrapper over an array, it is an
     *   implementation of the {@see \Traversable}, {@see \Countable},
     *   and {@see \ArrayAccess}
     *
     * - In the case when CData is a wrapper over a function pointer, it can
     *   be called.
     *
     * @link https://www.php.net/manual/en/class.ffi-cdata.php
     *
     * @template T of int|float|bool|null|string|CData = null
     *
     * @mixin \Countable
     * @mixin \Traversable<int<0, max>, T>
     * @mixin \ArrayAccess<int<0, max>, T>
     *
     * @property T $cdata
     *
     * @method mixed __get(string $name)
     * @method mixed __set(string $name, mixed $value)
     * @method mixed __invoke(mixed ...$args)
     *
     * @since 7.4
     */
    final class CData
    {
        /**
         * Note that this method does not physically exist and is only required
         * for correct type inference.
         *
         * @param int<0, max> $offset
         */
        private function offsetExists(int $offset) {}

        /**
         * Note that this method does not physically exist and is only required
         * for correct type inference.
         *
         * @param int<0, max> $offset
         * @return T
         */
        private function offsetGet(int $offset): mixed {}

        /**
         * Note that this method does not physically exist and is only required
         * for correct type inference.
         *
         * @param int<0, max> $offset
         * @param T $value
         */
        private function offsetSet(int $offset, mixed $value): void {}

        /**
         * Note that this method does not physically exist and is only required
         * for correct type inference.
         *
         * @param int<0, max> $offset
         */
        private function offsetUnset(int $offset): void {}

        /**
         * Note that this method does not physically exist and is only required
         * for correct type inference.
         *
         * @return int<0, max>
         */
        private function count(): int {}
    }

    /**
     * Class containing C type information.
     *
     * @link https://www.php.net/manual/en/class.ffi-ctype.php
     *
     * @since 7.4
     */
    class CType
    {
        /**
         * @since 8.1
         */
        public const TYPE_VOID = 0;

        /**
         * @since 8.1
         */
        public const TYPE_FLOAT = 1;

        /**
         * @since 8.1
         */
        public const TYPE_DOUBLE = 2;

        /**
         * Please note that this constant may NOT EXIST if there is
         * no long double support on the current platform.
         *
         * @since 8.1
         */
        public const TYPE_LONGDOUBLE = 3;

        /**
         * @since 8.1
         */
        public const TYPE_UINT8 = 4;

        /**
         * @since 8.1
         */
        public const TYPE_SINT8 = 5;

        /**
         * @since 8.1
         */
        public const TYPE_UINT16 = 6;

        /**
         * @since 8.1
         */
        public const TYPE_SINT16 = 7;

        /**
         * @since 8.1
         */
        public const TYPE_UINT32 = 8;

        /**
         * @since 8.1
         */
        public const TYPE_SINT32 = 9;

        /**
         * @since 8.1
         */
        public const TYPE_UINT64 = 10;

        /**
         * @since 8.1
         */
        public const TYPE_SINT64 = 11;

        /**
         * @since 8.1
         */
        public const TYPE_ENUM = 12;

        /**
         * @since 8.1
         */
        public const TYPE_BOOL = 13;

        /**
         * @since 8.1
         */
        public const TYPE_CHAR = 14;

        /**
         * @since 8.1
         */
        public const TYPE_POINTER = 15;

        /**
         * @since 8.1
         */
        public const TYPE_FUNC = 16;

        /**
         * @since 8.1
         */
        public const TYPE_ARRAY = 17;

        /**
         * @since 8.1
         */
        public const TYPE_STRUCT = 18;

        /**
         * @since 8.1
         */
        public const ATTR_CONST = 1;

        /**
         * @since 8.1
         */
        public const ATTR_INCOMPLETE_TAG = 2;

        /**
         * @since 8.1
         */
        public const ATTR_VARIADIC = 4;

        /**
         * @since 8.1
         */
        public const ATTR_INCOMPLETE_ARRAY = 8;

        /**
         * @since 8.1
         */
        public const ATTR_VLA = 16;

        /**
         * @since 8.1
         */
        public const ATTR_UNION = 32;

        /**
         * @since 8.1
         */
        public const ATTR_PACKED = 64;

        /**
         * @since 8.1
         */
        public const ATTR_MS_STRUCT = 128;

        /**
         * @since 8.1
         */
        public const ATTR_GCC_STRUCT = 256;

        /**
         * @since 8.1
         */
        public const ABI_DEFAULT = 0;

        /**
         * @since 8.1
         */
        public const ABI_CDECL = 1;

        /**
         * @since 8.1
         */
        public const ABI_FASTCALL = 2;

        /**
         * @since 8.1
         */
        public const ABI_THISCALL = 3;

        /**
         * @since 8.1
         */
        public const ABI_STDCALL = 4;

        /**
         * @since 8.1
         */
        public const ABI_PASCAL = 5;

        /**
         * @since 8.1
         */
        public const ABI_REGISTER = 6;

        /**
         * @since 8.1
         */
        public const ABI_MS = 7;

        /**
         * @since 8.1
         */
        public const ABI_SYSV = 8;

        /**
         * @since 8.1
         */
        public const ABI_VECTORCALL = 9;

        /**
         * Returns the name of the type.
         *
         * @since 8.0
         * @return non-empty-string
         */
        public function getName(): string {}

        /**
         * Returns the identifier of the root type.
         *
         * Value may be one of:
         *  - {@see CType::TYPE_VOID}
         *  - {@see CType::TYPE_FLOAT}
         *  - {@see CType::TYPE_DOUBLE}
         *  - {@see CType::TYPE_LONGDOUBLE}
         *  - {@see CType::TYPE_UINT8}
         *  - {@see CType::TYPE_SINT8}
         *  - {@see CType::TYPE_UINT16}
         *  - {@see CType::TYPE_SINT16}
         *  - {@see CType::TYPE_UINT32}
         *  - {@see CType::TYPE_SINT32}
         *  - {@see CType::TYPE_UINT64}
         *  - {@see CType::TYPE_SINT64}
         *  - {@see CType::TYPE_ENUM}
         *  - {@see CType::TYPE_BOOL}
         *  - {@see CType::TYPE_CHAR}
         *  - {@see CType::TYPE_POINTER}
         *  - {@see CType::TYPE_FUNC}
         *  - {@see CType::TYPE_ARRAY}
         *  - {@see CType::TYPE_STRUCT}
         *
         * @since 8.1
         * @return (CType::TYPE_*)
         */
        public function getKind(): int {}

        /**
         * Returns the size of the type in bytes.
         *
         * @since 8.1
         * @return int<0, max>
         */
        public function getSize(): int {}

        /**
         * Returns the alignment of the type in bytes.
         *
         * @since 8.1
         * @return int<0, max>
         */
        public function getAlignment(): int {}

        /**
         * Returns the bit-mask of type attributes.
         *
         * @since 8.1
         * @return int-mask-of<CType::ATTR_*>
         */
        public function getAttributes(): int {}

        /**
         * Returns the identifier of the enum value type.
         *
         * Value may be one of:
         *  - {@see CType::TYPE_UINT32}
         *  - {@see CType::TYPE_UINT64}
         *
         * @since 8.1
         * @return (CType::TYPE_*)
         * @throws Exception In the case that the type is not an enumeration.
         */
        public function getEnumKind(): int {}

        /**
         * Returns the type of array elements.
         *
         * @since 8.1
         * @return CType
         * @throws Exception In the case that the type is not an array.
         */
        public function getArrayElementType(): CType {}

        /**
         * Returns the size of an array.
         *
         * @since 8.1
         * @return int<0, max>
         * @throws Exception In the case that the type is not an array.
         */
        public function getArrayLength(): int {}

        /**
         * Returns the original type of the pointer.
         *
         * @since 8.1
         * @return CType
         * @throws Exception In the case that the type is not a pointer.
         */
        public function getPointerType(): CType {}

        /**
         * Returns the field string names of a structure or union.
         *
         * @since 8.1
         * @return array<string>
         * @throws Exception In the case that the type is not a struct or union.
         */
        public function getStructFieldNames(): array {}

        /**
         * Returns the offset of the structure by the name of this field. In
         * the case that the type is a union, then for each field of this type
         * the offset will be equal to 0.
         *
         * @since 8.1
         * @param string $name
         * @return int<0, max>
         * @throws Exception In the case that the type is not a struct or union.
         */
        public function getStructFieldOffset(string $name): int {}

        /**
         * Returns the field type of structure or union.
         *
         * @since 8.1
         * @param string $name
         * @return CType
         * @throws Exception In the case that the type is not a struct or union.
         */
        public function getStructFieldType(string $name): CType {}

        /**
         * Returns the application binary interface (ABI) identifier with which
         * you can call the function.
         *
         * Value may be one of:
         *  - {@see CType::ABI_DEFAULT}
         *  - {@see CType::ABI_CDECL}
         *  - {@see CType::ABI_FASTCALL}
         *  - {@see CType::ABI_THISCALL}
         *  - {@see CType::ABI_STDCALL}
         *  - {@see CType::ABI_PASCAL}
         *  - {@see CType::ABI_REGISTER}
         *  - {@see CType::ABI_MS}
         *  - {@see CType::ABI_SYSV}
         *  - {@see CType::ABI_VECTORCALL}
         *
         * @since 8.1
         * @return (CType::ABI_*)
         * @throws Exception In the case that the type is not a function.
         */
        public function getFuncABI(): int {}

        /**
         * Returns the return type of the function.
         *
         * @since 8.1
         * @return CType
         * @throws Exception In the case that the type is not a function.
         */
        public function getFuncReturnType(): CType {}

        /**
         * Returns the number of arguments to the function.
         *
         * @since 8.1
         * @return int<0, max>
         * @throws Exception In the case that the type is not a function.
         */
        public function getFuncParameterCount(): int {}

        /**
         * Returns the type of the function argument by its numeric index.
         *
         * @since 8.1
         * @param int<0, max> $index
         * @return CType
         * @throws Exception In the case that the type is not a function.
         */
        public function getFuncParameterType(int $index): CType {}
    }
}
