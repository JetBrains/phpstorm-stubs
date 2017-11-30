<?php
/**
 * Stubs for code completion for php Google Protocol Buffers extension.
 *
 * @author Anton Vasetskiy <antoha.gw@gmail.com>
 * @version 3.5.0
 *
 * @see https://developers.google.com/protocol-buffers/
 * @see https://github.com/google/protobuf/tree/master/php
 */

namespace Google\Protobuf {

    /**
     * The syntax in which a protocol buffer element is defined.
     *
     * Protobuf enum <code>Google\Protobuf\Syntax</code>
     */
    class Syntax
    {
        /**
         * Syntax `proto2`.
         *
         * Generated from protobuf enum <code>SYNTAX_PROTO2 = 0;</code>
         */
        const SYNTAX_PROTO2 = 0;

        /**
         * Syntax `proto3`.
         *
         * Generated from protobuf enum <code>SYNTAX_PROTO3 = 1;</code>
         */
        const SYNTAX_PROTO3 = 1;
    }

    /**
     * Wrapper message for `string`.
     * The JSON representation for `StringValue` is JSON string.
     *
     * Generated from protobuf message <code>google.protobuf.StringValue</code>
     */
    class StringValue extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * The string value.
         *
         * Generated from protobuf field <code>string value = 1;</code>
         * @return string
         */
        public function getValue() {}

        /**
         * The string value.
         *
         * Generated from protobuf field <code>string value = 1;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setValue($var) {}
    }

    /**
     * Wrapper message for `bool`.
     * The JSON representation for `BoolValue` is JSON `true` and `false`.
     *
     * Generated from protobuf message <code>google.protobuf.BoolValue</code>
     */
    class BoolValue extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * The bool value.
         *
         * Generated from protobuf field <code>bool value = 1;</code>
         * @return bool
         */
        public function getValue() {}

        /**
         * The bool value.
         *
         * Generated from protobuf field <code>bool value = 1;</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setValue($var) {}
    }

    class EnumDescriptor
    {
        /**
         * @internal
         */
        public function __construct($internal_desc) {}

        /**
         * @return string Full protobuf message name
         */
        public function getFullName() {}

        /**
         * @return string PHP class name
         */
        public function getClass() {}

        /**
         * @param int $index Must be >= 0 and < getValueCount()
         *
         * @return EnumValueDescriptor
         */
        public function getValue($index) {}

        /**
         * @return int Number of values in enum
         */
        public function getValueCount() {}
    }

    class FieldDescriptor
    {
        use \Google\Protobuf\Internal\GetPublicDescriptorTrait;

        /**
         * @internal
         */
        public function __construct($internal_desc) {}

        /**
         * @return string Field name
         */
        public function getName() {}

        /**
         * @return int Protobuf field number
         */
        public function getNumber() {}

        /**
         * @return int
         */
        public function getLabel() {}

        /**
         * @return int
         */
        public function getType() {}

        /**
         * @return Descriptor Returns a descriptor for the field type if the field type is a message, otherwise throws
         *                    \Exception
         * @throws \Exception
         */
        public function getMessageType() {}

        /**
         * @return EnumDescriptor Returns an enum descriptor if the field type is an enum, otherwise throws \Exception
         * @throws \Exception
         */
        public function getEnumType() {}

        /**
         * @return boolean
         */
        public function isMap() {}
    }

    /**
     * A Timestamp represents a point in time independent of any time zone
     * or calendar, represented as seconds and fractions of seconds at
     * nanosecond resolution in UTC Epoch time. It is encoded using the
     * Proleptic Gregorian Calendar which extends the Gregorian calendar
     * backwards to year one. It is encoded assuming all minutes are 60
     * seconds long, i.e. leap seconds are "smeared" so that no leap second
     * table is needed for interpretation. Range is from
     * 0001-01-01T00:00:00Z to 9999-12-31T23:59:59.999999999Z.
     * By restricting to that range, we ensure that we can convert to
     * and from  RFC 3339 date strings.
     * See [https://www.ietf.org/rfc/rfc3339.txt](https://www.ietf.org/rfc/rfc3339.txt).
     * # Examples
     * Example 1: Compute Timestamp from POSIX `time()`.
     *     Timestamp timestamp;
     *     timestamp.set_seconds(time(NULL));
     *     timestamp.set_nanos(0);
     * Example 2: Compute Timestamp from POSIX `gettimeofday()`.
     *     struct timeval tv;
     *     gettimeofday(&tv, NULL);
     *     Timestamp timestamp;
     *     timestamp.set_seconds(tv.tv_sec);
     *     timestamp.set_nanos(tv.tv_usec * 1000);
     * Example 3: Compute Timestamp from Win32 `GetSystemTimeAsFileTime()`.
     *     FILETIME ft;
     *     GetSystemTimeAsFileTime(&ft);
     *     UINT64 ticks = (((UINT64)ft.dwHighDateTime) << 32) | ft.dwLowDateTime;
     *     // A Windows tick is 100 nanoseconds. Windows epoch 1601-01-01T00:00:00Z
     *     // is 11644473600 seconds before Unix epoch 1970-01-01T00:00:00Z.
     *     Timestamp timestamp;
     *     timestamp.set_seconds((INT64) ((ticks / 10000000) - 11644473600LL));
     *     timestamp.set_nanos((INT32) ((ticks % 10000000) * 100));
     * Example 4: Compute Timestamp from Java `System.currentTimeMillis()`.
     *     long millis = System.currentTimeMillis();
     *     Timestamp timestamp = Timestamp.newBuilder().setSeconds(millis / 1000)
     *         .setNanos((int) ((millis % 1000) * 1000000)).build();
     * Example 5: Compute Timestamp from current time in Python.
     *     timestamp = Timestamp()
     *     timestamp.GetCurrentTime()
     * # JSON Mapping
     * In JSON format, the Timestamp type is encoded as a string in the
     * [RFC 3339](https://www.ietf.org/rfc/rfc3339.txt) format. That is, the
     * format is "{year}-{month}-{day}T{hour}:{min}:{sec}[.{frac_sec}]Z"
     * where {year} is always expressed using four digits while {month}, {day},
     * {hour}, {min}, and {sec} are zero-padded to two digits each. The fractional
     * seconds, which can go up to 9 digits (i.e. up to 1 nanosecond resolution),
     * are optional. The "Z" suffix indicates the timezone ("UTC"); the timezone
     * is required, though only UTC (as indicated by "Z") is presently supported.
     * For example, "2017-01-15T01:30:15.01Z" encodes 15.01 seconds past
     * 01:30 UTC on January 15, 2017.
     * In JavaScript, one can convert a Date object to this format using the
     * standard
     * [toISOString()](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Date/toISOString]
     * method. In Python, a standard `datetime.datetime` object can be converted to this format using
     * [`strftime`](https://docs.python.org/2/library/time.html#time.strftime) with the time format spec
     * '%Y-%m-%dT%H:%M:%S.%fZ'. Likewise, in Java, one can use the Joda Time's [`ISODateTimeFormat.dateTime()`](
     * http://www.joda.org/joda-time/apidocs/org/joda/time/format/ISODateTimeFormat.html#dateTime--) to obtain a
     * formatter capable of generating timestamps in this format.
     *
     * Generated from protobuf message <code>google.protobuf.Timestamp</code>
     */
    class Timestamp extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * Represents seconds of UTC time since Unix epoch
         * 1970-01-01T00:00:00Z. Must be from 0001-01-01T00:00:00Z to
         * 9999-12-31T23:59:59Z inclusive.
         *
         * Generated from protobuf field <code>int64 seconds = 1;</code>
         * @return int|string
         */
        public function getSeconds() {}

        /**
         * Represents seconds of UTC time since Unix epoch
         * 1970-01-01T00:00:00Z. Must be from 0001-01-01T00:00:00Z to
         * 9999-12-31T23:59:59Z inclusive.
         *
         * Generated from protobuf field <code>int64 seconds = 1;</code>
         *
         * @param int|string $var
         *
         * @return $this
         */
        public function setSeconds($var) {}

        /**
         * Non-negative fractions of a second at nanosecond resolution. Negative
         * second values with fractions must still have non-negative nanos values
         * that count forward in time. Must be from 0 to 999,999,999
         * inclusive.
         *
         * Generated from protobuf field <code>int32 nanos = 2;</code>
         * @return int
         */
        public function getNanos() {}

        /**
         * Non-negative fractions of a second at nanosecond resolution. Negative
         * second values with fractions must still have non-negative nanos values
         * that count forward in time. Must be from 0 to 999,999,999
         * inclusive.
         *
         * Generated from protobuf field <code>int32 nanos = 2;</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setNanos($var) {}

        /**
         * Converts PHP DateTime to Timestamp.
         *
         * @param \DateTime $datetime
         */
        public function fromDateTime($datetime) {}

        /**
         * Converts Timestamp to PHP DateTime. Nano second is ignored.
         *
         * @return \DateTime $datetime
         */
        public function toDateTime() {}
    }

    /**
     * Wrapper message for `double`.
     * The JSON representation for `DoubleValue` is JSON number.
     *
     * Generated from protobuf message <code>google.protobuf.DoubleValue</code>
     */
    class DoubleValue extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * The double value.
         *
         * Generated from protobuf field <code>double value = 1;</code>
         * @return float
         */
        public function getValue() {}

        /**
         * The double value.
         *
         * Generated from protobuf field <code>double value = 1;</code>
         *
         * @param float $var
         *
         * @return $this
         */
        public function setValue($var) {}
    }

    /**
     * Basic field types.
     *
     * Protobuf enum <code>Google\Protobuf\Field\Kind</code>
     */
    class Field_Kind
    {
        /**
         * Field type unknown.
         *
         * Generated from protobuf enum <code>TYPE_UNKNOWN = 0;</code>
         */
        const TYPE_UNKNOWN = 0;

        /**
         * Field type double.
         *
         * Generated from protobuf enum <code>TYPE_DOUBLE = 1;</code>
         */
        const TYPE_DOUBLE = 1;

        /**
         * Field type float.
         *
         * Generated from protobuf enum <code>TYPE_FLOAT = 2;</code>
         */
        const TYPE_FLOAT = 2;

        /**
         * Field type int64.
         *
         * Generated from protobuf enum <code>TYPE_INT64 = 3;</code>
         */
        const TYPE_INT64 = 3;

        /**
         * Field type uint64.
         *
         * Generated from protobuf enum <code>TYPE_UINT64 = 4;</code>
         */
        const TYPE_UINT64 = 4;

        /**
         * Field type int32.
         *
         * Generated from protobuf enum <code>TYPE_INT32 = 5;</code>
         */
        const TYPE_INT32 = 5;

        /**
         * Field type fixed64.
         *
         * Generated from protobuf enum <code>TYPE_FIXED64 = 6;</code>
         */
        const TYPE_FIXED64 = 6;

        /**
         * Field type fixed32.
         *
         * Generated from protobuf enum <code>TYPE_FIXED32 = 7;</code>
         */
        const TYPE_FIXED32 = 7;

        /**
         * Field type bool.
         *
         * Generated from protobuf enum <code>TYPE_BOOL = 8;</code>
         */
        const TYPE_BOOL = 8;

        /**
         * Field type string.
         *
         * Generated from protobuf enum <code>TYPE_STRING = 9;</code>
         */
        const TYPE_STRING = 9;

        /**
         * Field type group. Proto2 syntax only, and deprecated.
         *
         * Generated from protobuf enum <code>TYPE_GROUP = 10;</code>
         */
        const TYPE_GROUP = 10;

        /**
         * Field type message.
         *
         * Generated from protobuf enum <code>TYPE_MESSAGE = 11;</code>
         */
        const TYPE_MESSAGE = 11;

        /**
         * Field type bytes.
         *
         * Generated from protobuf enum <code>TYPE_BYTES = 12;</code>
         */
        const TYPE_BYTES = 12;

        /**
         * Field type uint32.
         *
         * Generated from protobuf enum <code>TYPE_UINT32 = 13;</code>
         */
        const TYPE_UINT32 = 13;

        /**
         * Field type enum.
         *
         * Generated from protobuf enum <code>TYPE_ENUM = 14;</code>
         */
        const TYPE_ENUM = 14;

        /**
         * Field type sfixed32.
         *
         * Generated from protobuf enum <code>TYPE_SFIXED32 = 15;</code>
         */
        const TYPE_SFIXED32 = 15;

        /**
         * Field type sfixed64.
         *
         * Generated from protobuf enum <code>TYPE_SFIXED64 = 16;</code>
         */
        const TYPE_SFIXED64 = 16;

        /**
         * Field type sint32.
         *
         * Generated from protobuf enum <code>TYPE_SINT32 = 17;</code>
         */
        const TYPE_SINT32 = 17;

        /**
         * Field type sint64.
         *
         * Generated from protobuf enum <code>TYPE_SINT64 = 18;</code>
         */
        const TYPE_SINT64 = 18;
    }

    /**
     * A protocol buffer message type.
     *
     * Generated from protobuf message <code>google.protobuf.Type</code>
     */
    class Type extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * The fully qualified message name.
         *
         * Generated from protobuf field <code>string name = 1;</code>
         * @return string
         */
        public function getName() {}

        /**
         * The fully qualified message name.
         *
         * Generated from protobuf field <code>string name = 1;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setName($var) {}

        /**
         * The list of fields.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.Field fields = 2;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getFields() {}

        /**
         * The list of fields.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.Field fields = 2;</code>
         *
         * @param \Google\Protobuf\Field[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setFields($var) {}

        /**
         * The list of types appearing in `oneof` definitions in this type.
         *
         * Generated from protobuf field <code>repeated string oneofs = 3;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getOneofs() {}

        /**
         * The list of types appearing in `oneof` definitions in this type.
         *
         * Generated from protobuf field <code>repeated string oneofs = 3;</code>
         *
         * @param string[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setOneofs($var) {}

        /**
         * The protocol buffer options.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.Option options = 4;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getOptions() {}

        /**
         * The protocol buffer options.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.Option options = 4;</code>
         *
         * @param \Google\Protobuf\Option[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setOptions($var) {}

        /**
         * The source context.
         *
         * Generated from protobuf field <code>.google.protobuf.SourceContext source_context = 5;</code>
         * @return \Google\Protobuf\SourceContext
         */
        public function getSourceContext() {}

        /**
         * The source context.
         *
         * Generated from protobuf field <code>.google.protobuf.SourceContext source_context = 5;</code>
         *
         * @param \Google\Protobuf\SourceContext $var
         *
         * @return $this
         */
        public function setSourceContext($var) {}

        /**
         * The source syntax.
         *
         * Generated from protobuf field <code>.google.protobuf.Syntax syntax = 6;</code>
         * @return int
         */
        public function getSyntax() {}

        /**
         * The source syntax.
         *
         * Generated from protobuf field <code>.google.protobuf.Syntax syntax = 6;</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setSyntax($var) {}
    }

    /**
     * Enum type definition.
     *
     * Generated from protobuf message <code>google.protobuf.Enum</code>
     */
    class Enum extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * Enum type name.
         *
         * Generated from protobuf field <code>string name = 1;</code>
         * @return string
         */
        public function getName() {}

        /**
         * Enum type name.
         *
         * Generated from protobuf field <code>string name = 1;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setName($var) {}

        /**
         * Enum value definitions.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.EnumValue enumvalue = 2;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getEnumvalue() {}

        /**
         * Enum value definitions.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.EnumValue enumvalue = 2;</code>
         *
         * @param \Google\Protobuf\EnumValue[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setEnumvalue($var) {}

        /**
         * Protocol buffer options.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.Option options = 3;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getOptions() {}

        /**
         * Protocol buffer options.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.Option options = 3;</code>
         *
         * @param \Google\Protobuf\Option[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setOptions($var) {}

        /**
         * The source context.
         *
         * Generated from protobuf field <code>.google.protobuf.SourceContext source_context = 4;</code>
         * @return \Google\Protobuf\SourceContext
         */
        public function getSourceContext() {}

        /**
         * The source context.
         *
         * Generated from protobuf field <code>.google.protobuf.SourceContext source_context = 4;</code>
         *
         * @param \Google\Protobuf\SourceContext $var
         *
         * @return $this
         */
        public function setSourceContext($var) {}

        /**
         * The source syntax.
         *
         * Generated from protobuf field <code>.google.protobuf.Syntax syntax = 5;</code>
         * @return int
         */
        public function getSyntax() {}

        /**
         * The source syntax.
         *
         * Generated from protobuf field <code>.google.protobuf.Syntax syntax = 5;</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setSyntax($var) {}
    }

    /**
     * Declares an API Interface to be included in this interface. The including
     * interface must redeclare all the methods from the included interface, but
     * documentation and options are inherited as follows:
     * - If after comment and whitespace stripping, the documentation
     *   string of the redeclared method is empty, it will be inherited
     *   from the original method.
     * - Each annotation belonging to the service config (http,
     *   visibility) which is not set in the redeclared method will be
     *   inherited.
     * - If an http annotation is inherited, the path pattern will be
     *   modified as follows. Any version prefix will be replaced by the
     *   version of the including interface plus the [root][] path if
     *   specified.
     * Example of a simple mixin:
     *     package google.acl.v1;
     *     service AccessControl {
     *       // Get the underlying ACL object.
     *       rpc GetAcl(GetAclRequest) returns (Acl) {
     *         option (google.api.http).get = "/v1/{resource=**}:getAcl";
     *       }
     *     }
     *     package google.storage.v2;
     *     service Storage {
     *       rpc GetAcl(GetAclRequest) returns (Acl);
     *       // Get a data record.
     *       rpc GetData(GetDataRequest) returns (Data) {
     *         option (google.api.http).get = "/v2/{resource=**}";
     *       }
     *     }
     * Example of a mixin configuration:
     *     apis:
     *     - name: google.storage.v2.Storage
     *       mixins:
     *       - name: google.acl.v1.AccessControl
     * The mixin construct implies that all methods in `AccessControl` are
     * also declared with same name and request/response types in
     * `Storage`. A documentation generator or annotation processor will
     * see the effective `Storage.GetAcl` method after inherting
     * documentation and annotations as follows:
     *     service Storage {
     *       // Get the underlying ACL object.
     *       rpc GetAcl(GetAclRequest) returns (Acl) {
     *         option (google.api.http).get = "/v2/{resource=**}:getAcl";
     *       }
     *       ...
     *     }
     * Note how the version in the path pattern changed from `v1` to `v2`.
     * If the `root` field in the mixin is specified, it should be a
     * relative path under which inherited HTTP paths are placed. Example:
     *     apis:
     *     - name: google.storage.v2.Storage
     *       mixins:
     *       - name: google.acl.v1.AccessControl
     *         root: acls
     * This implies the following inherited HTTP annotation:
     *     service Storage {
     *       // Get the underlying ACL object.
     *       rpc GetAcl(GetAclRequest) returns (Acl) {
     *         option (google.api.http).get = "/v2/acls/{resource=**}:getAcl";
     *       }
     *       ...
     *     }
     *
     * Generated from protobuf message <code>google.protobuf.Mixin</code>
     */
    class Mixin extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * The fully qualified name of the interface which is included.
         *
         * Generated from protobuf field <code>string name = 1;</code>
         * @return string
         */
        public function getName() {}

        /**
         * The fully qualified name of the interface which is included.
         *
         * Generated from protobuf field <code>string name = 1;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setName($var) {}

        /**
         * If non-empty specifies a path under which inherited HTTP paths
         * are rooted.
         *
         * Generated from protobuf field <code>string root = 2;</code>
         * @return string
         */
        public function getRoot() {}

        /**
         * If non-empty specifies a path under which inherited HTTP paths
         * are rooted.
         *
         * Generated from protobuf field <code>string root = 2;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setRoot($var) {}
    }

    /**
     * A protocol buffer option, which can be attached to a message, field,
     * enumeration, etc.
     *
     * Generated from protobuf message <code>google.protobuf.Option</code>
     */
    class Option extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * The option's name. For protobuf built-in options (options defined in
         * descriptor.proto), this is the short name. For example, `"map_entry"`.
         * For custom options, it should be the fully-qualified name. For example,
         * `"google.api.http"`.
         *
         * Generated from protobuf field <code>string name = 1;</code>
         * @return string
         */
        public function getName() {}

        /**
         * The option's name. For protobuf built-in options (options defined in
         * descriptor.proto), this is the short name. For example, `"map_entry"`.
         * For custom options, it should be the fully-qualified name. For example,
         * `"google.api.http"`.
         *
         * Generated from protobuf field <code>string name = 1;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setName($var) {}

        /**
         * The option's value packed in an Any message. If the value is a primitive,
         * the corresponding wrapper type defined in google/protobuf/wrappers.proto
         * should be used. If the value is an enum, it should be stored as an int32
         * value using the google.protobuf.Int32Value type.
         *
         * Generated from protobuf field <code>.google.protobuf.Any value = 2;</code>
         * @return \Google\Protobuf\Any
         */
        public function getValue() {}

        /**
         * The option's value packed in an Any message. If the value is a primitive,
         * the corresponding wrapper type defined in google/protobuf/wrappers.proto
         * should be used. If the value is an enum, it should be stored as an int32
         * value using the google.protobuf.Int32Value type.
         *
         * Generated from protobuf field <code>.google.protobuf.Any value = 2;</code>
         *
         * @param \Google\Protobuf\Any $var
         *
         * @return $this
         */
        public function setValue($var) {}
    }

    /**
     * Whether a field is optional, required, or repeated.
     *
     * Protobuf enum <code>Google\Protobuf\Field\Cardinality</code>
     */
    class Field_Cardinality
    {
        /**
         * For fields with unknown cardinality.
         *
         * Generated from protobuf enum <code>CARDINALITY_UNKNOWN = 0;</code>
         */
        const CARDINALITY_UNKNOWN = 0;

        /**
         * For optional fields.
         *
         * Generated from protobuf enum <code>CARDINALITY_OPTIONAL = 1;</code>
         */
        const CARDINALITY_OPTIONAL = 1;

        /**
         * For required fields. Proto2 syntax only.
         *
         * Generated from protobuf enum <code>CARDINALITY_REQUIRED = 2;</code>
         */
        const CARDINALITY_REQUIRED = 2;

        /**
         * For repeated fields.
         *
         * Generated from protobuf enum <code>CARDINALITY_REPEATED = 3;</code>
         */
        const CARDINALITY_REPEATED = 3;
    }

    /**
     * Wrapper message for `int32`.
     * The JSON representation for `Int32Value` is JSON number.
     *
     * Generated from protobuf message <code>google.protobuf.Int32Value</code>
     */
    class Int32Value extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * The int32 value.
         *
         * Generated from protobuf field <code>int32 value = 1;</code>
         * @return int
         */
        public function getValue() {}

        /**
         * The int32 value.
         *
         * Generated from protobuf field <code>int32 value = 1;</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setValue($var) {}
    }

    /**
     * Method represents a method of an API interface.
     *
     * Generated from protobuf message <code>google.protobuf.Method</code>
     */
    class Method extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * The simple name of this method.
         *
         * Generated from protobuf field <code>string name = 1;</code>
         * @return string
         */
        public function getName() {}

        /**
         * The simple name of this method.
         *
         * Generated from protobuf field <code>string name = 1;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setName($var) {}

        /**
         * A URL of the input message type.
         *
         * Generated from protobuf field <code>string request_type_url = 2;</code>
         * @return string
         */
        public function getRequestTypeUrl() {}

        /**
         * A URL of the input message type.
         *
         * Generated from protobuf field <code>string request_type_url = 2;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setRequestTypeUrl($var) {}

        /**
         * If true, the request is streamed.
         *
         * Generated from protobuf field <code>bool request_streaming = 3;</code>
         * @return bool
         */
        public function getRequestStreaming() {}

        /**
         * If true, the request is streamed.
         *
         * Generated from protobuf field <code>bool request_streaming = 3;</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setRequestStreaming($var) {}

        /**
         * The URL of the output message type.
         *
         * Generated from protobuf field <code>string response_type_url = 4;</code>
         * @return string
         */
        public function getResponseTypeUrl() {}

        /**
         * The URL of the output message type.
         *
         * Generated from protobuf field <code>string response_type_url = 4;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setResponseTypeUrl($var) {}

        /**
         * If true, the response is streamed.
         *
         * Generated from protobuf field <code>bool response_streaming = 5;</code>
         * @return bool
         */
        public function getResponseStreaming() {}

        /**
         * If true, the response is streamed.
         *
         * Generated from protobuf field <code>bool response_streaming = 5;</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setResponseStreaming($var) {}

        /**
         * Any metadata attached to the method.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.Option options = 6;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getOptions() {}

        /**
         * Any metadata attached to the method.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.Option options = 6;</code>
         *
         * @param \Google\Protobuf\Option[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setOptions($var) {}

        /**
         * The source syntax of this method.
         *
         * Generated from protobuf field <code>.google.protobuf.Syntax syntax = 7;</code>
         * @return int
         */
        public function getSyntax() {}

        /**
         * The source syntax of this method.
         *
         * Generated from protobuf field <code>.google.protobuf.Syntax syntax = 7;</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setSyntax($var) {}
    }

    /**
     * A single field of a message type.
     *
     * Generated from protobuf message <code>google.protobuf.Field</code>
     */
    class Field extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * The field type.
         *
         * Generated from protobuf field <code>.google.protobuf.Field.Kind kind = 1;</code>
         * @return int
         */
        public function getKind() {}

        /**
         * The field type.
         *
         * Generated from protobuf field <code>.google.protobuf.Field.Kind kind = 1;</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setKind($var) {}

        /**
         * The field cardinality.
         *
         * Generated from protobuf field <code>.google.protobuf.Field.Cardinality cardinality = 2;</code>
         * @return int
         */
        public function getCardinality() {}

        /**
         * The field cardinality.
         *
         * Generated from protobuf field <code>.google.protobuf.Field.Cardinality cardinality = 2;</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setCardinality($var) {}

        /**
         * The field number.
         *
         * Generated from protobuf field <code>int32 number = 3;</code>
         * @return int
         */
        public function getNumber() {}

        /**
         * The field number.
         *
         * Generated from protobuf field <code>int32 number = 3;</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setNumber($var) {}

        /**
         * The field name.
         *
         * Generated from protobuf field <code>string name = 4;</code>
         * @return string
         */
        public function getName() {}

        /**
         * The field name.
         *
         * Generated from protobuf field <code>string name = 4;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setName($var) {}

        /**
         * The field type URL, without the scheme, for message or enumeration
         * types. Example: `"type.googleapis.com/google.protobuf.Timestamp"`.
         *
         * Generated from protobuf field <code>string type_url = 6;</code>
         * @return string
         */
        public function getTypeUrl() {}

        /**
         * The field type URL, without the scheme, for message or enumeration
         * types. Example: `"type.googleapis.com/google.protobuf.Timestamp"`.
         *
         * Generated from protobuf field <code>string type_url = 6;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setTypeUrl($var) {}

        /**
         * The index of the field type in `Type.oneofs`, for message or enumeration
         * types. The first type has index 1; zero means the type is not in the list.
         *
         * Generated from protobuf field <code>int32 oneof_index = 7;</code>
         * @return int
         */
        public function getOneofIndex() {}

        /**
         * The index of the field type in `Type.oneofs`, for message or enumeration
         * types. The first type has index 1; zero means the type is not in the list.
         *
         * Generated from protobuf field <code>int32 oneof_index = 7;</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setOneofIndex($var) {}

        /**
         * Whether to use alternative packed wire representation.
         *
         * Generated from protobuf field <code>bool packed = 8;</code>
         * @return bool
         */
        public function getPacked() {}

        /**
         * Whether to use alternative packed wire representation.
         *
         * Generated from protobuf field <code>bool packed = 8;</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setPacked($var) {}

        /**
         * The protocol buffer options.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.Option options = 9;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getOptions() {}

        /**
         * The protocol buffer options.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.Option options = 9;</code>
         *
         * @param \Google\Protobuf\Option[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setOptions($var) {}

        /**
         * The field JSON name.
         *
         * Generated from protobuf field <code>string json_name = 10;</code>
         * @return string
         */
        public function getJsonName() {}

        /**
         * The field JSON name.
         *
         * Generated from protobuf field <code>string json_name = 10;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setJsonName($var) {}

        /**
         * The string value of the default value of this field. Proto2 syntax only.
         *
         * Generated from protobuf field <code>string default_value = 11;</code>
         * @return string
         */
        public function getDefaultValue() {}

        /**
         * The string value of the default value of this field. Proto2 syntax only.
         *
         * Generated from protobuf field <code>string default_value = 11;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setDefaultValue($var) {}
    }

    /**
     * Wrapper message for `uint64`.
     * The JSON representation for `UInt64Value` is JSON string.
     *
     * Generated from protobuf message <code>google.protobuf.UInt64Value</code>
     */
    class UInt64Value extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * The uint64 value.
         *
         * Generated from protobuf field <code>uint64 value = 1;</code>
         * @return int|string
         */
        public function getValue() {}

        /**
         * The uint64 value.
         *
         * Generated from protobuf field <code>uint64 value = 1;</code>
         *
         * @param int|string $var
         *
         * @return $this
         */
        public function setValue($var) {}
    }

    /**
     * `Value` represents a dynamically typed value which can be either
     * null, a number, a string, a boolean, a recursive struct value, or a
     * list of values. A producer of value is expected to set one of that
     * variants, absence of any variant indicates an error.
     * The JSON representation for `Value` is JSON value.
     *
     * Generated from protobuf message <code>google.protobuf.Value</code>
     */
    class Value extends \Google\Protobuf\Internal\Message
    {
        protected $kind;

        public function __construct() {}

        /**
         * Represents a null value.
         *
         * Generated from protobuf field <code>.google.protobuf.NullValue null_value = 1;</code>
         * @return int
         */
        public function getNullValue() {}

        /**
         * Represents a null value.
         *
         * Generated from protobuf field <code>.google.protobuf.NullValue null_value = 1;</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setNullValue($var) {}

        /**
         * Represents a double value.
         *
         * Generated from protobuf field <code>double number_value = 2;</code>
         * @return float
         */
        public function getNumberValue() {}

        /**
         * Represents a double value.
         *
         * Generated from protobuf field <code>double number_value = 2;</code>
         *
         * @param float $var
         *
         * @return $this
         */
        public function setNumberValue($var) {}

        /**
         * Represents a string value.
         *
         * Generated from protobuf field <code>string string_value = 3;</code>
         * @return string
         */
        public function getStringValue() {}

        /**
         * Represents a string value.
         *
         * Generated from protobuf field <code>string string_value = 3;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setStringValue($var) {}

        /**
         * Represents a boolean value.
         *
         * Generated from protobuf field <code>bool bool_value = 4;</code>
         * @return bool
         */
        public function getBoolValue() {}

        /**
         * Represents a boolean value.
         *
         * Generated from protobuf field <code>bool bool_value = 4;</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setBoolValue($var) {}

        /**
         * Represents a structured value.
         *
         * Generated from protobuf field <code>.google.protobuf.Struct struct_value = 5;</code>
         * @return \Google\Protobuf\Struct
         */
        public function getStructValue() {}

        /**
         * Represents a structured value.
         *
         * Generated from protobuf field <code>.google.protobuf.Struct struct_value = 5;</code>
         *
         * @param \Google\Protobuf\Struct $var
         *
         * @return $this
         */
        public function setStructValue($var) {}

        /**
         * Represents a repeated `Value`.
         *
         * Generated from protobuf field <code>.google.protobuf.ListValue list_value = 6;</code>
         * @return \Google\Protobuf\ListValue
         */
        public function getListValue() {}

        /**
         * Represents a repeated `Value`.
         *
         * Generated from protobuf field <code>.google.protobuf.ListValue list_value = 6;</code>
         *
         * @param \Google\Protobuf\ListValue $var
         *
         * @return $this
         */
        public function setListValue($var) {}

        /**
         * @return string
         */
        public function getKind() {}
    }

    /**
     * `NullValue` is a singleton enumeration to represent the null value for the
     * `Value` type union.
     *  The JSON representation for `NullValue` is JSON `null`.
     *
     * Protobuf enum <code>Google\Protobuf\NullValue</code>
     */
    class NullValue
    {
        /**
         * Null value.
         *
         * Generated from protobuf enum <code>NULL_VALUE = 0;</code>
         */
        const NULL_VALUE = 0;
    }

    /**
     * Wrapper message for `float`.
     * The JSON representation for `FloatValue` is JSON number.
     *
     * Generated from protobuf message <code>google.protobuf.FloatValue</code>
     */
    class FloatValue extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * The float value.
         *
         * Generated from protobuf field <code>float value = 1;</code>
         * @return float
         */
        public function getValue() {}

        /**
         * The float value.
         *
         * Generated from protobuf field <code>float value = 1;</code>
         *
         * @param float $var
         *
         * @return $this
         */
        public function setValue($var) {}
    }

    /**
     * `Any` contains an arbitrary serialized protocol buffer message along with a
     * URL that describes the type of the serialized message.
     * Protobuf library provides support to pack/unpack Any values in the form
     * of utility functions or additional generated methods of the Any type.
     * Example 1: Pack and unpack a message in C++.
     *     Foo foo = ...;
     *     Any any;
     *     any.PackFrom(foo);
     *     ...
     *     if (any.UnpackTo(&foo)) {
     *       ...
     *     }
     * Example 2: Pack and unpack a message in Java.
     *     Foo foo = ...;
     *     Any any = Any.pack(foo);
     *     ...
     *     if (any.is(Foo.class)) {
     *       foo = any.unpack(Foo.class);
     *     }
     *  Example 3: Pack and unpack a message in Python.
     *     foo = Foo(...)
     *     any = Any()
     *     any.Pack(foo)
     *     ...
     *     if any.Is(Foo.DESCRIPTOR):
     *       any.Unpack(foo)
     *       ...
     * The pack methods provided by protobuf library will by default use
     * 'type.googleapis.com/full.type.name' as the type URL and the unpack
     * methods only use the fully qualified type name after the last '/'
     * in the type URL, for example "foo.bar.com/x/y.z" will yield type
     * name "y.z".
     * JSON
     * ====
     * The JSON representation of an `Any` value uses the regular
     * representation of the deserialized, embedded message, with an
     * additional field `&#64;type` which contains the type URL. Example:
     *     package google.profile;
     *     message Person {
     *       string first_name = 1;
     *       string last_name = 2;
     *     }
     *     {
     *       "&#64;type": "type.googleapis.com/google.profile.Person",
     *       "firstName": <string>,
     *       "lastName": <string>
     *     }
     * If the embedded message type is well-known and has a custom JSON
     * representation, that representation will be embedded adding a field
     * `value` which holds the custom JSON in addition to the `&#64;type`
     * field. Example (for message [google.protobuf.Duration][]):
     *     {
     *       "&#64;type": "type.googleapis.com/google.protobuf.Duration",
     *       "value": "1.212s"
     *     }
     *
     * Generated from protobuf message <code>google.protobuf.Any</code>
     */
    class Any extends \Google\Protobuf\Internal\Message
    {
        const TYPE_URL_PREFIX = 'type.googleapis.com/';

        public function __construct() {}

        /**
         * A URL/resource name whose content describes the type of the
         * serialized protocol buffer message.
         * For URLs which use the scheme `http`, `https`, or no scheme, the
         * following restrictions and interpretations apply:
         * * If no scheme is provided, `https` is assumed.
         * * The last segment of the URL's path must represent the fully
         *   qualified name of the type (as in `path/google.protobuf.Duration`).
         *   The name should be in a canonical form (e.g., leading "." is
         *   not accepted).
         * * An HTTP GET on the URL must yield a [google.protobuf.Type][]
         *   value in binary format, or produce an error.
         * * Applications are allowed to cache lookup results based on the
         *   URL, or have them precompiled into a binary to avoid any
         *   lookup. Therefore, binary compatibility needs to be preserved
         *   on changes to types. (Use versioned type names to manage
         *   breaking changes.)
         * Schemes other than `http`, `https` (or the empty scheme) might be
         * used with implementation specific semantics.
         *
         * Generated from protobuf field <code>string type_url = 1;</code>
         * @return string
         */
        public function getTypeUrl() {}

        /**
         * A URL/resource name whose content describes the type of the
         * serialized protocol buffer message.
         * For URLs which use the scheme `http`, `https`, or no scheme, the
         * following restrictions and interpretations apply:
         * * If no scheme is provided, `https` is assumed.
         * * The last segment of the URL's path must represent the fully
         *   qualified name of the type (as in `path/google.protobuf.Duration`).
         *   The name should be in a canonical form (e.g., leading "." is
         *   not accepted).
         * * An HTTP GET on the URL must yield a [google.protobuf.Type][]
         *   value in binary format, or produce an error.
         * * Applications are allowed to cache lookup results based on the
         *   URL, or have them precompiled into a binary to avoid any
         *   lookup. Therefore, binary compatibility needs to be preserved
         *   on changes to types. (Use versioned type names to manage
         *   breaking changes.)
         * Schemes other than `http`, `https` (or the empty scheme) might be
         * used with implementation specific semantics.
         *
         * Generated from protobuf field <code>string type_url = 1;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setTypeUrl($var) {}

        /**
         * Must be a valid serialized protocol buffer of the above specified type.
         *
         * Generated from protobuf field <code>bytes value = 2;</code>
         * @return string
         */
        public function getValue() {}

        /**
         * Must be a valid serialized protocol buffer of the above specified type.
         *
         * Generated from protobuf field <code>bytes value = 2;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setValue($var) {}

        /**
         * This method will try to resolve the type_url in Any message to get the
         * targeted message type. If failed, an error will be thrown. Otherwise,
         * the method will create a message of the targeted type and fill it with
         * the decoded value in Any.
         * @return string unpacked message
         * @throws \Exception Type url needs to be type.googleapis.com/fully-qulified.
         * @throws \Exception Class hasn't been added to descriptor pool.
         * @throws \Exception cannot decode data in value field.
         */
        public function unpack() {}

        /**
         * The type_url will be created according to the given message’s type and
         * the value is encoded data from the given message..
         *
         * @param $msg : A proto message.
         */
        public function pack($msg) {}

        /**
         * This method returns whether the type_url in any_message is corresponded
         * to the given class.
         *
         * @param string $klass : The fully qualified PHP class name of a proto message type.
         */
        public function is($klass) {}
    }

    /**
     * A generic empty message that you can re-use to avoid defining duplicated
     * empty messages in your APIs. A typical example is to use it as the request
     * or the response type of an API method. For instance:
     *     service Foo {
     *       rpc Bar(google.protobuf.Empty) returns (google.protobuf.Empty);
     *     }
     * The JSON representation for `Empty` is empty JSON object `{}`.
     *
     * Generated from protobuf message <code>google.protobuf.Empty</code>
     */
    class GPBEmpty extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}
    }

    class OneofDescriptor
    {
        use \Google\Protobuf\Internal\GetPublicDescriptorTrait;

        /**
         * @internal
         */
        public function __construct($internal_desc) {}

        /**
         * @return string The name of the oneof
         */
        public function getName() {}

        /**
         * @param int $index Must be >= 0 and < getFieldCount()
         *
         * @return FieldDescriptor
         */
        public function getField($index) {}

        /**
         * @return int Number of fields in the oneof
         */
        public function getFieldCount() {}
    }

    class EnumValueDescriptor
    {
        /**
         * @internal
         */
        public function __construct($name, $number) {}

        /**
         * @return string
         */
        public function getName() {}

        /**
         * @return int
         */
        public function getNumber() {}
    }

    /**
     * `FieldMask` represents a set of symbolic field paths, for example:
     *     paths: "f.a"
     *     paths: "f.b.d"
     * Here `f` represents a field in some root message, `a` and `b`
     * fields in the message found in `f`, and `d` a field found in the
     * message in `f.b`.
     * Field masks are used to specify a subset of fields that should be
     * returned by a get operation or modified by an update operation.
     * Field masks also have a custom JSON encoding (see below).
     * # Field Masks in Projections
     * When used in the context of a projection, a response message or
     * sub-message is filtered by the API to only contain those fields as
     * specified in the mask. For example, if the mask in the previous
     * example is applied to a response message as follows:
     *     f {
     *       a : 22
     *       b {
     *         d : 1
     *         x : 2
     *       }
     *       y : 13
     *     }
     *     z: 8
     * The result will not contain specific values for fields x,y and z
     * (their value will be set to the default, and omitted in proto text
     * output):
     *     f {
     *       a : 22
     *       b {
     *         d : 1
     *       }
     *     }
     * A repeated field is not allowed except at the last position of a
     * paths string.
     * If a FieldMask object is not present in a get operation, the
     * operation applies to all fields (as if a FieldMask of all fields
     * had been specified).
     * Note that a field mask does not necessarily apply to the
     * top-level response message. In case of a REST get operation, the
     * field mask applies directly to the response, but in case of a REST
     * list operation, the mask instead applies to each individual message
     * in the returned resource list. In case of a REST custom method,
     * other definitions may be used. Where the mask applies will be
     * clearly documented together with its declaration in the API.  In
     * any case, the effect on the returned resource/resources is required
     * behavior for APIs.
     * # Field Masks in Update Operations
     * A field mask in update operations specifies which fields of the
     * targeted resource are going to be updated. The API is required
     * to only change the values of the fields as specified in the mask
     * and leave the others untouched. If a resource is passed in to
     * describe the updated values, the API ignores the values of all
     * fields not covered by the mask.
     * If a repeated field is specified for an update operation, the existing
     * repeated values in the target resource will be overwritten by the new values.
     * Note that a repeated field is only allowed in the last position of a `paths`
     * string.
     * If a sub-message is specified in the last position of the field mask for an
     * update operation, then the existing sub-message in the target resource is
     * overwritten. Given the target message:
     *     f {
     *       b {
     *         d : 1
     *         x : 2
     *       }
     *       c : 1
     *     }
     * And an update message:
     *     f {
     *       b {
     *         d : 10
     *       }
     *     }
     * then if the field mask is:
     *  paths: "f.b"
     * then the result will be:
     *     f {
     *       b {
     *         d : 10
     *       }
     *       c : 1
     *     }
     * However, if the update mask was:
     *  paths: "f.b.d"
     * then the result would be:
     *     f {
     *       b {
     *         d : 10
     *         x : 2
     *       }
     *       c : 1
     *     }
     * In order to reset a field's value to the default, the field must
     * be in the mask and set to the default value in the provided resource.
     * Hence, in order to reset all fields of a resource, provide a default
     * instance of the resource and set all fields in the mask, or do
     * not provide a mask as described below.
     * If a field mask is not present on update, the operation applies to
     * all fields (as if a field mask of all fields has been specified).
     * Note that in the presence of schema evolution, this may mean that
     * fields the client does not know and has therefore not filled into
     * the request will be reset to their default. If this is unwanted
     * behavior, a specific service may require a client to always specify
     * a field mask, producing an error if not.
     * As with get operations, the location of the resource which
     * describes the updated values in the request message depends on the
     * operation kind. In any case, the effect of the field mask is
     * required to be honored by the API.
     * ## Considerations for HTTP REST
     * The HTTP kind of an update operation which uses a field mask must
     * be set to PATCH instead of PUT in order to satisfy HTTP semantics
     * (PUT must only be used for full updates).
     * # JSON Encoding of Field Masks
     * In JSON, a field mask is encoded as a single string where paths are
     * separated by a comma. Fields name in each path are converted
     * to/from lower-camel naming conventions.
     * As an example, consider the following message declarations:
     *     message Profile {
     *       User user = 1;
     *       Photo photo = 2;
     *     }
     *     message User {
     *       string display_name = 1;
     *       string address = 2;
     *     }
     * In proto a field mask for `Profile` may look as such:
     *     mask {
     *       paths: "user.display_name"
     *       paths: "photo"
     *     }
     * In JSON, the same mask is represented as below:
     *     {
     *       mask: "user.displayName,photo"
     *     }
     * # Field Masks and Oneof Fields
     * Field masks treat fields in oneofs just as regular fields. Consider the
     * following message:
     *     message SampleMessage {
     *       oneof test_oneof {
     *         string name = 4;
     *         SubMessage sub_message = 9;
     *       }
     *     }
     * The field mask can be:
     *     mask {
     *       paths: "name"
     *     }
     * Or:
     *     mask {
     *       paths: "sub_message"
     *     }
     * Note that oneof type names ("test_oneof" in this case) cannot be used in
     * paths.
     *
     * Generated from protobuf message <code>google.protobuf.FieldMask</code>
     */
    class FieldMask extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * The set of field mask paths.
         *
         * Generated from protobuf field <code>repeated string paths = 1;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getPaths() {}

        /**
         * The set of field mask paths.
         *
         * Generated from protobuf field <code>repeated string paths = 1;</code>
         *
         * @param string[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setPaths($var) {}
    }

    /**
     * `SourceContext` represents information about the source of a
     * protobuf element, like the file in which it is defined.
     *
     * Generated from protobuf message <code>google.protobuf.SourceContext</code>
     */
    class SourceContext extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * The path-qualified name of the .proto file that contained the associated
         * protobuf element.  For example: `"google/protobuf/source_context.proto"`.
         *
         * Generated from protobuf field <code>string file_name = 1;</code>
         * @return string
         */
        public function getFileName() {}

        /**
         * The path-qualified name of the .proto file that contained the associated
         * protobuf element.  For example: `"google/protobuf/source_context.proto"`.
         *
         * Generated from protobuf field <code>string file_name = 1;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setFileName($var) {}
    }

    class DescriptorPool
    {
        /**
         * @return DescriptorPool
         */
        public static function getGeneratedPool() {}

        /**
         * @param string $className A fully qualified protobuf class name
         *
         * @return Descriptor
         */
        public function getDescriptorByClassName($className) {}

        /**
         * @param string $className A fully qualified protobuf class name
         *
         * @return EnumDescriptor
         */
        public function getEnumDescriptorByClassName($className) {}
    }

    /**
     * Wrapper message for `bytes`.
     * The JSON representation for `BytesValue` is JSON string.
     *
     * Generated from protobuf message <code>google.protobuf.BytesValue</code>
     */
    class BytesValue extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * The bytes value.
         *
         * Generated from protobuf field <code>bytes value = 1;</code>
         * @return string
         */
        public function getValue() {}

        /**
         * The bytes value.
         *
         * Generated from protobuf field <code>bytes value = 1;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setValue($var) {}
    }

    /**
     * Api is a light-weight descriptor for an API Interface.
     * Interfaces are also described as "protocol buffer services" in some contexts,
     * such as by the "service" keyword in a .proto file, but they are different
     * from API Services, which represent a concrete implementation of an interface
     * as opposed to simply a description of methods and bindings. They are also
     * sometimes simply referred to as "APIs" in other contexts, such as the name of
     * this message itself. See https://cloud.google.com/apis/design/glossary for
     * detailed terminology.
     *
     * Generated from protobuf message <code>google.protobuf.Api</code>
     */
    class Api extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * The fully qualified name of this interface, including package name
         * followed by the interface's simple name.
         *
         * Generated from protobuf field <code>string name = 1;</code>
         * @return string
         */
        public function getName() {}

        /**
         * The fully qualified name of this interface, including package name
         * followed by the interface's simple name.
         *
         * Generated from protobuf field <code>string name = 1;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setName($var) {}

        /**
         * The methods of this interface, in unspecified order.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.Method methods = 2;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getMethods() {}

        /**
         * The methods of this interface, in unspecified order.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.Method methods = 2;</code>
         *
         * @param \Google\Protobuf\Method[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setMethods($var) {}

        /**
         * Any metadata attached to the interface.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.Option options = 3;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getOptions() {}

        /**
         * Any metadata attached to the interface.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.Option options = 3;</code>
         *
         * @param \Google\Protobuf\Option[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setOptions($var) {}

        /**
         * A version string for this interface. If specified, must have the form
         * `major-version.minor-version`, as in `1.10`. If the minor version is
         * omitted, it defaults to zero. If the entire version field is empty, the
         * major version is derived from the package name, as outlined below. If the
         * field is not empty, the version in the package name will be verified to be
         * consistent with what is provided here.
         * The versioning schema uses [semantic
         * versioning](http://semver.org) where the major version number
         * indicates a breaking change and the minor version an additive,
         * non-breaking change. Both version numbers are signals to users
         * what to expect from different versions, and should be carefully
         * chosen based on the product plan.
         * The major version is also reflected in the package name of the
         * interface, which must end in `v<major-version>`, as in
         * `google.feature.v1`. For major versions 0 and 1, the suffix can
         * be omitted. Zero major versions must only be used for
         * experimental, non-GA interfaces.
         *
         * Generated from protobuf field <code>string version = 4;</code>
         * @return string
         */
        public function getVersion() {}

        /**
         * A version string for this interface. If specified, must have the form
         * `major-version.minor-version`, as in `1.10`. If the minor version is
         * omitted, it defaults to zero. If the entire version field is empty, the
         * major version is derived from the package name, as outlined below. If the
         * field is not empty, the version in the package name will be verified to be
         * consistent with what is provided here.
         * The versioning schema uses [semantic
         * versioning](http://semver.org) where the major version number
         * indicates a breaking change and the minor version an additive,
         * non-breaking change. Both version numbers are signals to users
         * what to expect from different versions, and should be carefully
         * chosen based on the product plan.
         * The major version is also reflected in the package name of the
         * interface, which must end in `v<major-version>`, as in
         * `google.feature.v1`. For major versions 0 and 1, the suffix can
         * be omitted. Zero major versions must only be used for
         * experimental, non-GA interfaces.
         *
         * Generated from protobuf field <code>string version = 4;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setVersion($var) {}

        /**
         * Source context for the protocol buffer service represented by this
         * message.
         *
         * Generated from protobuf field <code>.google.protobuf.SourceContext source_context = 5;</code>
         * @return \Google\Protobuf\SourceContext
         */
        public function getSourceContext() {}

        /**
         * Source context for the protocol buffer service represented by this
         * message.
         *
         * Generated from protobuf field <code>.google.protobuf.SourceContext source_context = 5;</code>
         *
         * @param \Google\Protobuf\SourceContext $var
         *
         * @return $this
         */
        public function setSourceContext($var) {}

        /**
         * Included interfaces. See [Mixin][].
         *
         * Generated from protobuf field <code>repeated .google.protobuf.Mixin mixins = 6;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getMixins() {}

        /**
         * Included interfaces. See [Mixin][].
         *
         * Generated from protobuf field <code>repeated .google.protobuf.Mixin mixins = 6;</code>
         *
         * @param \Google\Protobuf\Mixin[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setMixins($var) {}

        /**
         * The source syntax of the service.
         *
         * Generated from protobuf field <code>.google.protobuf.Syntax syntax = 7;</code>
         * @return int
         */
        public function getSyntax() {}

        /**
         * The source syntax of the service.
         *
         * Generated from protobuf field <code>.google.protobuf.Syntax syntax = 7;</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setSyntax($var) {}
    }

    /**
     * Enum value definition.
     *
     * Generated from protobuf message <code>google.protobuf.EnumValue</code>
     */
    class EnumValue extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * Enum value name.
         *
         * Generated from protobuf field <code>string name = 1;</code>
         * @return string
         */
        public function getName() {}

        /**
         * Enum value name.
         *
         * Generated from protobuf field <code>string name = 1;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setName($var) {}

        /**
         * Enum value number.
         *
         * Generated from protobuf field <code>int32 number = 2;</code>
         * @return int
         */
        public function getNumber() {}

        /**
         * Enum value number.
         *
         * Generated from protobuf field <code>int32 number = 2;</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setNumber($var) {}

        /**
         * Protocol buffer options.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.Option options = 3;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getOptions() {}

        /**
         * Protocol buffer options.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.Option options = 3;</code>
         *
         * @param \Google\Protobuf\Option[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setOptions($var) {}
    }

    /**
     * `Struct` represents a structured data value, consisting of fields
     * which map to dynamically typed values. In some languages, `Struct`
     * might be supported by a native representation. For example, in
     * scripting languages like JS a struct is represented as an
     * object. The details of that representation are described together
     * with the proto support for the language.
     * The JSON representation for `Struct` is JSON object.
     *
     * Generated from protobuf message <code>google.protobuf.Struct</code>
     */
    class Struct extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * Unordered map of dynamically typed values.
         *
         * Generated from protobuf field <code>map<string, .google.protobuf.Value> fields = 1;</code>
         * @return \Google\Protobuf\Internal\MapField
         */
        public function getFields() {}

        /**
         * Unordered map of dynamically typed values.
         *
         * Generated from protobuf field <code>map<string, .google.protobuf.Value> fields = 1;</code>
         *
         * @param array|\Google\Protobuf\Internal\MapField $var
         *
         * @return $this
         */
        public function setFields($var) {}
    }

    /**
     * `ListValue` is a wrapper around a repeated field of values.
     * The JSON representation for `ListValue` is JSON array.
     *
     * Generated from protobuf message <code>google.protobuf.ListValue</code>
     */
    class ListValue extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * Repeated field of dynamically typed values.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.Value values = 1;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getValues() {}

        /**
         * Repeated field of dynamically typed values.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.Value values = 1;</code>
         *
         * @param \Google\Protobuf\Value[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setValues($var) {}
    }

    class Descriptor
    {
        use \Google\Protobuf\Internal\GetPublicDescriptorTrait;

        /**
         * @internal
         */
        public function __construct($internal_desc) {}

        /**
         * @return string Full protobuf message name
         */
        public function getFullName() {}

        /**
         * @return string PHP class name
         */
        public function getClass() {}

        /**
         * @param int $index Must be >= 0 and < getFieldCount()
         *
         * @return FieldDescriptor
         */
        public function getField($index) {}

        /**
         * @return int Number of fields in message
         */
        public function getFieldCount() {}

        /**
         * @param int $index Must be >= 0 and < getOneofDeclCount()
         *
         * @return OneofDescriptor
         */
        public function getOneofDecl($index) {}

        /**
         * @return int Number of oneofs in message
         */
        public function getOneofDeclCount() {}
    }

    /**
     * Wrapper message for `int64`.
     * The JSON representation for `Int64Value` is JSON string.
     *
     * Generated from protobuf message <code>google.protobuf.Int64Value</code>
     */
    class Int64Value extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * The int64 value.
         *
         * Generated from protobuf field <code>int64 value = 1;</code>
         * @return int|string
         */
        public function getValue() {}

        /**
         * The int64 value.
         *
         * Generated from protobuf field <code>int64 value = 1;</code>
         *
         * @param int|string $var
         *
         * @return $this
         */
        public function setValue($var) {}
    }

    /**
     * Wrapper message for `uint32`.
     * The JSON representation for `UInt32Value` is JSON number.
     *
     * Generated from protobuf message <code>google.protobuf.UInt32Value</code>
     */
    class UInt32Value extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * The uint32 value.
         *
         * Generated from protobuf field <code>uint32 value = 1;</code>
         * @return int
         */
        public function getValue() {}

        /**
         * The uint32 value.
         *
         * Generated from protobuf field <code>uint32 value = 1;</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setValue($var) {}
    }

    /**
     * A Duration represents a signed, fixed-length span of time represented
     * as a count of seconds and fractions of seconds at nanosecond
     * resolution. It is independent of any calendar and concepts like "day"
     * or "month". It is related to Timestamp in that the difference between
     * two Timestamp values is a Duration and it can be added or subtracted
     * from a Timestamp. Range is approximately +-10,000 years.
     * # Examples
     * Example 1: Compute Duration from two Timestamps in pseudo code.
     *     Timestamp start = ...;
     *     Timestamp end = ...;
     *     Duration duration = ...;
     *     duration.seconds = end.seconds - start.seconds;
     *     duration.nanos = end.nanos - start.nanos;
     *     if (duration.seconds < 0 && duration.nanos > 0) {
     *       duration.seconds += 1;
     *       duration.nanos -= 1000000000;
     *     } else if (durations.seconds > 0 && duration.nanos < 0) {
     *       duration.seconds -= 1;
     *       duration.nanos += 1000000000;
     *     }
     * Example 2: Compute Timestamp from Timestamp + Duration in pseudo code.
     *     Timestamp start = ...;
     *     Duration duration = ...;
     *     Timestamp end = ...;
     *     end.seconds = start.seconds + duration.seconds;
     *     end.nanos = start.nanos + duration.nanos;
     *     if (end.nanos < 0) {
     *       end.seconds -= 1;
     *       end.nanos += 1000000000;
     *     } else if (end.nanos >= 1000000000) {
     *       end.seconds += 1;
     *       end.nanos -= 1000000000;
     *     }
     * Example 3: Compute Duration from datetime.timedelta in Python.
     *     td = datetime.timedelta(days=3, minutes=10)
     *     duration = Duration()
     *     duration.FromTimedelta(td)
     * # JSON Mapping
     * In JSON format, the Duration type is encoded as a string rather than an
     * object, where the string ends in the suffix "s" (indicating seconds) and
     * is preceded by the number of seconds, with nanoseconds expressed as
     * fractional seconds. For example, 3 seconds with 0 nanoseconds should be
     * encoded in JSON format as "3s", while 3 seconds and 1 nanosecond should
     * be expressed in JSON format as "3.000000001s", and 3 seconds and 1
     * microsecond should be expressed in JSON format as "3.000001s".
     *
     * Generated from protobuf message <code>google.protobuf.Duration</code>
     */
    class Duration extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * Signed seconds of the span of time. Must be from -315,576,000,000
         * to +315,576,000,000 inclusive. Note: these bounds are computed from:
         * 60 sec/min * 60 min/hr * 24 hr/day * 365.25 days/year * 10000 years
         *
         * Generated from protobuf field <code>int64 seconds = 1;</code>
         * @return int|string
         */
        public function getSeconds() {}

        /**
         * Signed seconds of the span of time. Must be from -315,576,000,000
         * to +315,576,000,000 inclusive. Note: these bounds are computed from:
         * 60 sec/min * 60 min/hr * 24 hr/day * 365.25 days/year * 10000 years
         *
         * Generated from protobuf field <code>int64 seconds = 1;</code>
         *
         * @param int|string $var
         *
         * @return $this
         */
        public function setSeconds($var) {}

        /**
         * Signed fractions of a second at nanosecond resolution of the span
         * of time. Durations less than one second are represented with a 0
         * `seconds` field and a positive or negative `nanos` field. For durations
         * of one second or more, a non-zero value for the `nanos` field must be
         * of the same sign as the `seconds` field. Must be from -999,999,999
         * to +999,999,999 inclusive.
         *
         * Generated from protobuf field <code>int32 nanos = 2;</code>
         * @return int
         */
        public function getNanos() {}

        /**
         * Signed fractions of a second at nanosecond resolution of the span
         * of time. Durations less than one second are represented with a 0
         * `seconds` field and a positive or negative `nanos` field. For durations
         * of one second or more, a non-zero value for the `nanos` field must be
         * of the same sign as the `seconds` field. Must be from -999,999,999
         * to +999,999,999 inclusive.
         *
         * Generated from protobuf field <code>int32 nanos = 2;</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setNanos($var) {}
    }
}

namespace Google\Protobuf\Internal {

    class EnumDescriptor
    {
        use HasPublicDescriptorTrait;

        public function __construct() {}

        public function setFullName($full_name) {}

        public function getFullName() {}

        public function addValue($number, $value) {}

        public function getValueByNumber($number) {}

        public function getValueByName($name) {}

        public function getValueDescriptorByIndex($index) {}

        public function getValueCount() {}

        public function setClass($klass) {}

        public function getClass() {}

        public static function buildFromProto($proto, $file_proto, $containing) {}
    }

    class OneofField
    {
        public function __construct($desc) {}

        public function setValue($value) {}

        public function getValue() {}

        public function setFieldName($field_name) {}

        public function getFieldName() {}

        public function setNumber($number) {}

        public function getNumber() {}
    }

    class MessageBuilderContext
    {

        public function __construct($full_name, $klass, $pool) {}

        public function optional($name, $type, $number, $type_name = null) {}

        public function repeated($name, $type, $number, $type_name = null) {}

        public function required($name, $type, $number, $type_name = null) {}

        public function finalizeToPool() {}
    }

    class FieldDescriptor
    {
        use HasPublicDescriptorTrait;

        public function __construct() {}

        public function setOneofIndex($index) {}

        public function getOneofIndex() {}

        public function setName($name) {}

        public function getName() {}

        public function setJsonName($json_name) {}

        public function getJsonName() {}

        public function setSetter($setter) {}

        public function getSetter() {}

        public function setGetter($getter) {}

        public function getGetter() {}

        public function setNumber($number) {}

        public function getNumber() {}

        public function setLabel($label) {}

        public function getLabel() {}

        public function isRepeated() {}

        public function setType($type) {}

        public function getType() {}

        public function setMessageType($message_type) {}

        public function getMessageType() {}

        public function setEnumType($enum_type) {}

        public function getEnumType() {}

        public function setPacked($packed) {}

        public function getPacked() {}

        public function isPackable() {}

        public function isMap() {}

        public function isTimestamp() {}

        public static function getFieldDescriptor($proto) {}

        public static function buildFromProto($proto) {}
    }

    /**
     * Generated from protobuf message <code>google.protobuf.ServiceOptions</code>
     */
    class ServiceOptions extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * Is this service deprecated?
         * Depending on the target platform, this can emit Deprecated annotations
         * for the service, or it will be completely ignored; in the very least,
         * this is a formalization for deprecating services.
         *
         * Generated from protobuf field <code>optional bool deprecated = 33 [default = false];</code>
         * @return bool
         */
        public function getDeprecated() {}

        /**
         * Is this service deprecated?
         * Depending on the target platform, this can emit Deprecated annotations
         * for the service, or it will be completely ignored; in the very least,
         * this is a formalization for deprecating services.
         *
         * Generated from protobuf field <code>optional bool deprecated = 33 [default = false];</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setDeprecated($var) {}

        public function hasDeprecated() {}

        /**
         * The parser stores options it doesn't recognize here. See above.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.UninterpretedOption uninterpreted_option =
         * 999;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getUninterpretedOption() {}

        /**
         * The parser stores options it doesn't recognize here. See above.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.UninterpretedOption uninterpreted_option =
         * 999;</code>
         *
         * @param \Google\Protobuf\Internal\UninterpretedOption[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setUninterpretedOption($var) {}

        public function hasUninterpretedOption() {}

    }

    class RawInputStream
    {
        public function __construct($buffer) {}

        public function getData() {}

    }

    /**
     * Describes a oneof.
     *
     * Generated from protobuf message <code>google.protobuf.OneofDescriptorProto</code>
     */
    class OneofDescriptorProto extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * Generated from protobuf field <code>optional string name = 1;</code>
         * @return string
         */
        public function getName() {}

        /**
         * Generated from protobuf field <code>optional string name = 1;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setName($var) {}

        public function hasName() {}

        /**
         * Generated from protobuf field <code>optional .google.protobuf.OneofOptions options = 2;</code>
         * @return \Google\Protobuf\Internal\OneofOptions
         */
        public function getOptions() {}

        /**
         * Generated from protobuf field <code>optional .google.protobuf.OneofOptions options = 2;</code>
         *
         * @param \Google\Protobuf\Internal\OneofOptions $var
         *
         * @return $this
         */
        public function setOptions($var) {}

        public function hasOptions() {}

    }

    /**
     * RepeatedFieldIter is used to iterate RepeatedField. It is also need for the
     * foreach syntax.
     */
    class RepeatedFieldIter implements \Iterator
    {
        /**
         * Create iterator instance for RepeatedField.
         *
         * @param RepeatedField The RepeatedField instance for which this iterator
         *                      is created.
         *
         * @ignore
         */
        public function __construct($container) {}

        /**
         * Reset the status of the iterator
         *
         * @return void
         */
        public function rewind() {}

        /**
         * Return the element at the current position.
         *
         * @return object The element at the current position.
         */
        public function current() {}

        /**
         * Return the current position.
         *
         * @return integer The current position.
         */
        public function key() {}

        /**
         * Move to the next position.
         *
         * @return void
         */
        public function next() {}

        /**
         * Check whether there are more elements to iterate.
         *
         * @return bool True if there are more elements to iterate.
         */
        public function valid() {}
    }

    class GPBType
    {
        const DOUBLE = 1;
        const FLOAT = 2;
        const INT64 = 3;
        const UINT64 = 4;
        const INT32 = 5;
        const FIXED64 = 6;
        const FIXED32 = 7;
        const BOOL = 8;
        const STRING = 9;
        const GROUP = 10;
        const MESSAGE = 11;
        const BYTES = 12;
        const UINT32 = 13;
        const ENUM = 14;
        const SFIXED32 = 15;
        const SFIXED64 = 16;
        const SINT32 = 17;
        const SINT64 = 18;
    }

    class CodedInputStream
    {
        const MAX_VARINT_BYTES = 10;
        const DEFAULT_RECURSION_LIMIT = 100;
        const DEFAULT_TOTAL_BYTES_LIMIT = 33554432; // 32 << 20, 32MB

        public function __construct($buffer) {}

        public function bufferSize() {}

        public function current() {}

        public function substr($start, $end) {}

        /**
         * Read uint32 into $var. Advance buffer with consumed bytes. If the
         * contained varint is larger than 32 bits, discard the high order bits.
         *
         * @param $var .
         */
        public function readVarint32(&$var) {}

        /**
         * Read Uint64 into $var. Advance buffer with consumed bytes.
         *
         * @param $var .
         */
        public function readVarint64(&$var) {}

        /**
         * Read int into $var. If the result is larger than the largest integer, $var
         * will be -1. Advance buffer with consumed bytes.
         *
         * @param $var .
         */
        public function readVarintSizeAsInt(&$var) {}

        /**
         * Read 32-bit unsiged integer to $var. If the buffer has less than 4 bytes,
         * return false. Advance buffer with consumed bytes.
         *
         * @param $var .
         */
        public function readLittleEndian32(&$var) {}

        /**
         * Read 64-bit unsiged integer to $var. If the buffer has less than 8 bytes,
         * return false. Advance buffer with consumed bytes.
         *
         * @param $var .
         */
        public function readLittleEndian64(&$var) {}

        /**
         * Read tag into $var. Advance buffer with consumed bytes.
         *
         * @param $var .
         */
        public function readTag() {}

        public function readRaw(
            $size,
            &$buffer
        ) {
        }

        /* Places a limit on the number of bytes that the stream may read, starting
         * from the current position.  Once the stream hits this limit, it will act
         * like the end of the input has been reached until popLimit() is called.
         *
         * As the names imply, the stream conceptually has a stack of limits.  The
         * shortest limit on the stack is always enforced, even if it is not the top
         * limit.
         *
         * The value returned by pushLimit() is opaque to the caller, and must be
         * passed unchanged to the corresponding call to popLimit().
         *
         * @param integer $byte_limit
         * @throws Exception Fail to push limit.
         */
        public function pushLimit($byte_limit) {}

        /* The limit passed in is actually the *old* limit, which we returned from
         * PushLimit().
         *
         * @param integer $byte_limit
         */
        public function popLimit($byte_limit) {}

        public function incrementRecursionDepthAndPushLimit($byte_limit, &$old_limit, &$recursion_budget) {}

        public function decrementRecursionDepthAndPopLimit($byte_limit) {}

        public function bytesUntilLimit() {}
    }

    /**
     * Range of reserved tag numbers. Reserved tag numbers may not be used by
     * fields or extension ranges in the same message. Reserved ranges may
     * not overlap.
     *
     * Generated from protobuf message <code>google.protobuf.DescriptorProto.ReservedRange</code>
     */
    class DescriptorProto_ReservedRange extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * Inclusive.
         *
         * Generated from protobuf field <code>optional int32 start = 1;</code>
         * @return int
         */
        public function getStart() {}

        /**
         * Inclusive.
         *
         * Generated from protobuf field <code>optional int32 start = 1;</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setStart($var) {}

        public function hasStart() {}

        /**
         * Exclusive.
         *
         * Generated from protobuf field <code>optional int32 end = 2;</code>
         * @return int
         */
        public function getEnd() {}

        /**
         * Exclusive.
         *
         * Generated from protobuf field <code>optional int32 end = 2;</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setEnd($var) {}

        public function hasEnd() {}

    }

    /**
     * Describes an enum type.
     *
     * Generated from protobuf message <code>google.protobuf.EnumDescriptorProto</code>
     */
    class EnumDescriptorProto extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * Generated from protobuf field <code>optional string name = 1;</code>
         * @return string
         */
        public function getName() {}

        /**
         * Generated from protobuf field <code>optional string name = 1;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setName($var) {}

        public function hasName() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.EnumValueDescriptorProto value = 2;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getValue() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.EnumValueDescriptorProto value = 2;</code>
         *
         * @param \Google\Protobuf\Internal\EnumValueDescriptorProto[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setValue($var) {}

        public function hasValue() {}

        /**
         * Generated from protobuf field <code>optional .google.protobuf.EnumOptions options = 3;</code>
         * @return \Google\Protobuf\Internal\EnumOptions
         */
        public function getOptions() {}

        /**
         * Generated from protobuf field <code>optional .google.protobuf.EnumOptions options = 3;</code>
         *
         * @param \Google\Protobuf\Internal\EnumOptions $var
         *
         * @return $this
         */
        public function setOptions($var) {}

        public function hasOptions() {}

        /**
         * Range of reserved numeric values. Reserved numeric values may not be used
         * by enum values in the same enum declaration. Reserved ranges may not
         * overlap.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.EnumDescriptorProto.EnumReservedRange
         * reserved_range = 4;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getReservedRange() {}

        /**
         * Range of reserved numeric values. Reserved numeric values may not be used
         * by enum values in the same enum declaration. Reserved ranges may not
         * overlap.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.EnumDescriptorProto.EnumReservedRange
         * reserved_range = 4;</code>
         *
         * @param \Google\Protobuf\Internal\EnumDescriptorProto_EnumReservedRange[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setReservedRange($var) {}

        public function hasReservedRange() {}

        /**
         * Reserved enum value names, which may not be reused. A given name may only
         * be reserved once.
         *
         * Generated from protobuf field <code>repeated string reserved_name = 5;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getReservedName() {}

        /**
         * Reserved enum value names, which may not be reused. A given name may only
         * be reserved once.
         *
         * Generated from protobuf field <code>repeated string reserved_name = 5;</code>
         *
         * @param string[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setReservedName($var) {}

        public function hasReservedName() {}

    }

    /**
     * Describes a field within a message.
     *
     * Generated from protobuf message <code>google.protobuf.FieldDescriptorProto</code>
     */
    class FieldDescriptorProto extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * Generated from protobuf field <code>optional string name = 1;</code>
         * @return string
         */
        public function getName() {}

        /**
         * Generated from protobuf field <code>optional string name = 1;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setName($var) {}

        public function hasName() {}

        /**
         * Generated from protobuf field <code>optional int32 number = 3;</code>
         * @return int
         */
        public function getNumber() {}

        /**
         * Generated from protobuf field <code>optional int32 number = 3;</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setNumber($var) {}

        public function hasNumber() {}

        /**
         * Generated from protobuf field <code>optional .google.protobuf.FieldDescriptorProto.Label label = 4;</code>
         * @return int
         */
        public function getLabel() {}

        /**
         * Generated from protobuf field <code>optional .google.protobuf.FieldDescriptorProto.Label label = 4;</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setLabel($var) {}

        public function hasLabel() {}

        /**
         * If type_name is set, this need not be set.  If both this and type_name
         * are set, this must be one of TYPE_ENUM, TYPE_MESSAGE or TYPE_GROUP.
         *
         * Generated from protobuf field <code>optional .google.protobuf.FieldDescriptorProto.Type type = 5;</code>
         * @return int
         */
        public function getType() {}

        /**
         * If type_name is set, this need not be set.  If both this and type_name
         * are set, this must be one of TYPE_ENUM, TYPE_MESSAGE or TYPE_GROUP.
         *
         * Generated from protobuf field <code>optional .google.protobuf.FieldDescriptorProto.Type type = 5;</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setType($var) {}

        public function hasType() {}

        /**
         * For message and enum types, this is the name of the type.  If the name
         * starts with a '.', it is fully-qualified.  Otherwise, C++-like scoping
         * rules are used to find the type (i.e. first the nested types within this
         * message are searched, then within the parent, on up to the root
         * namespace).
         *
         * Generated from protobuf field <code>optional string type_name = 6;</code>
         * @return string
         */
        public function getTypeName() {}

        /**
         * For message and enum types, this is the name of the type.  If the name
         * starts with a '.', it is fully-qualified.  Otherwise, C++-like scoping
         * rules are used to find the type (i.e. first the nested types within this
         * message are searched, then within the parent, on up to the root
         * namespace).
         *
         * Generated from protobuf field <code>optional string type_name = 6;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setTypeName($var) {}

        public function hasTypeName() {}

        /**
         * For extensions, this is the name of the type being extended.  It is
         * resolved in the same manner as type_name.
         *
         * Generated from protobuf field <code>optional string extendee = 2;</code>
         * @return string
         */
        public function getExtendee() {}

        /**
         * For extensions, this is the name of the type being extended.  It is
         * resolved in the same manner as type_name.
         *
         * Generated from protobuf field <code>optional string extendee = 2;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setExtendee($var) {}

        public function hasExtendee() {}

        /**
         * For numeric types, contains the original text representation of the value.
         * For booleans, "true" or "false".
         * For strings, contains the default text contents (not escaped in any way).
         * For bytes, contains the C escaped value.  All bytes >= 128 are escaped.
         * TODO(kenton):  Base-64 encode?
         *
         * Generated from protobuf field <code>optional string default_value = 7;</code>
         * @return string
         */
        public function getDefaultValue() {}

        /**
         * For numeric types, contains the original text representation of the value.
         * For booleans, "true" or "false".
         * For strings, contains the default text contents (not escaped in any way).
         * For bytes, contains the C escaped value.  All bytes >= 128 are escaped.
         * TODO(kenton):  Base-64 encode?
         *
         * Generated from protobuf field <code>optional string default_value = 7;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setDefaultValue($var) {}

        public function hasDefaultValue() {}

        /**
         * If set, gives the index of a oneof in the containing type's oneof_decl
         * list.  This field is a member of that oneof.
         *
         * Generated from protobuf field <code>optional int32 oneof_index = 9;</code>
         * @return int
         */
        public function getOneofIndex() {}

        /**
         * If set, gives the index of a oneof in the containing type's oneof_decl
         * list.  This field is a member of that oneof.
         *
         * Generated from protobuf field <code>optional int32 oneof_index = 9;</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setOneofIndex($var) {}

        public function hasOneofIndex() {}

        /**
         * JSON name of this field. The value is set by protocol compiler. If the
         * user has set a "json_name" option on this field, that option's value
         * will be used. Otherwise, it's deduced from the field's name by converting
         * it to camelCase.
         *
         * Generated from protobuf field <code>optional string json_name = 10;</code>
         * @return string
         */
        public function getJsonName() {}

        /**
         * JSON name of this field. The value is set by protocol compiler. If the
         * user has set a "json_name" option on this field, that option's value
         * will be used. Otherwise, it's deduced from the field's name by converting
         * it to camelCase.
         *
         * Generated from protobuf field <code>optional string json_name = 10;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setJsonName($var) {}

        public function hasJsonName() {}

        /**
         * Generated from protobuf field <code>optional .google.protobuf.FieldOptions options = 8;</code>
         * @return \Google\Protobuf\Internal\FieldOptions
         */
        public function getOptions() {}

        /**
         * Generated from protobuf field <code>optional .google.protobuf.FieldOptions options = 8;</code>
         *
         * @param \Google\Protobuf\Internal\FieldOptions $var
         *
         * @return $this
         */
        public function setOptions($var) {}

        public function hasOptions() {}

    }

    /**
     * MapFieldIter is used to iterate MapField. It is also need for the foreach
     * syntax.
     */
    class MapFieldIter implements \Iterator
    {
        /**
         * Create iterator instance for MapField.
         *
         * @param MapField The MapField instance for which this iterator is
         *                 created.
         * @param GPBType  Map key type.
         *
         * @ignore
         */
        public function __construct($container, $key_type) {}

        /**
         * Reset the status of the iterator
         *
         * @return void
         */
        public function rewind() {}

        /**
         * Return the element at the current position.
         *
         * @return object The element at the current position.
         */
        public function current() {}

        /**
         * Return the current key.
         *
         * @return object The current key.
         */
        public function key() {}

        /**
         * Move to the next position.
         *
         * @return void
         */
        public function next() {}

        /**
         * Check whether there are more elements to iterate.
         *
         * @return bool True if there are more elements to iterate.
         */
        public function valid() {}
    }

    class GPBJsonWire
    {

        public static function serializeFieldToStream($value, $field, &$output, $has_field_name = true) {}

        public static function serializeFieldValueToStream($values, $field, &$output, $is_well_known = false) {}

        public static function escapedJson($value) {}

    }

    /**
     * MapField is used by generated protocol message classes to manipulate map
     * fields. It can be used like native PHP array.
     */
    class MapField implements \ArrayAccess, \IteratorAggregate, \Countable
    {
        /**
         * Constructs an instance of MapField.
         *
         * @param int    $key_type   Type of the stored key element.
         * @param int    $value_type Type of the stored value element.
         * @param string $klass      Message/Enum class name of value instance
         *                           (message/enum fields only).
         *
         * @ignore
         */
        public function __construct($key_type, $value_type, $klass = null) {}

        /**
         * @ignore
         */
        public function getKeyType() {}

        /**
         * @ignore
         */
        public function getValueType() {}

        /**
         * @ignore
         */
        public function getValueClass() {}

        /**
         * Return the element at the given key.
         *
         * This will also be called for: $ele = $arr[$key]
         *
         * @param object $key The key of the element to be fetched.
         *
         * @return object The stored element at given key.
         * @throws \ErrorException Invalid type for index.
         * @throws \ErrorException Non-existing index.
         */
        public function offsetGet($key) {}

        /**
         * Assign the element at the given key.
         *
         * This will also be called for: $arr[$key] = $value
         *
         * @param object $key   The key of the element to be fetched.
         * @param object $value The element to be assigned.
         *
         * @return void
         * @throws \ErrorException Invalid type for key.
         * @throws \ErrorException Invalid type for value.
         * @throws \ErrorException Non-existing key.
         */
        public function offsetSet($key, $value) {}

        /**
         * Remove the element at the given key.
         *
         * This will also be called for: unset($arr)
         *
         * @param object $key The key of the element to be removed.
         *
         * @return void
         * @throws \ErrorException Invalid type for key.
         */
        public function offsetUnset($key) {}

        /**
         * Check the existence of the element at the given key.
         *
         * This will also be called for: isset($arr)
         *
         * @param object $key The key of the element to be removed.
         *
         * @return bool True if the element at the given key exists.
         * @throws \ErrorException Invalid type for key.
         */
        public function offsetExists($key) {}

        /**
         * @ignore
         */
        public function getIterator() {}

        /**
         * Return the number of stored elements.
         *
         * This will also be called for: count($arr)
         *
         * @return integer The number of stored elements.
         */
        public function count() {}
    }

    /**
     * Describes a complete .proto file.
     *
     * Generated from protobuf message <code>google.protobuf.FileDescriptorProto</code>
     */
    class FileDescriptorProto extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * file name, relative to root of source tree
         *
         * Generated from protobuf field <code>optional string name = 1;</code>
         * @return string
         */
        public function getName() {}

        /**
         * file name, relative to root of source tree
         *
         * Generated from protobuf field <code>optional string name = 1;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setName($var) {}

        public function hasName() {}

        /**
         * e.g. "foo", "foo.bar", etc.
         *
         * Generated from protobuf field <code>optional string package = 2;</code>
         * @return string
         */
        public function getPackage() {}

        /**
         * e.g. "foo", "foo.bar", etc.
         *
         * Generated from protobuf field <code>optional string package = 2;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setPackage($var) {}

        public function hasPackage() {}

        /**
         * Names of files imported by this file.
         *
         * Generated from protobuf field <code>repeated string dependency = 3;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getDependency() {}

        /**
         * Names of files imported by this file.
         *
         * Generated from protobuf field <code>repeated string dependency = 3;</code>
         *
         * @param string[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setDependency($var) {}

        public function hasDependency() {}

        /**
         * Indexes of the public imported files in the dependency list above.
         *
         * Generated from protobuf field <code>repeated int32 public_dependency = 10;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getPublicDependency() {}

        /**
         * Indexes of the public imported files in the dependency list above.
         *
         * Generated from protobuf field <code>repeated int32 public_dependency = 10;</code>
         *
         * @param int[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setPublicDependency($var) {}

        public function hasPublicDependency() {}

        /**
         * Indexes of the weak imported files in the dependency list.
         * For Google-internal migration only. Do not use.
         *
         * Generated from protobuf field <code>repeated int32 weak_dependency = 11;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getWeakDependency() {}

        /**
         * Indexes of the weak imported files in the dependency list.
         * For Google-internal migration only. Do not use.
         *
         * Generated from protobuf field <code>repeated int32 weak_dependency = 11;</code>
         *
         * @param int[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setWeakDependency($var) {}

        public function hasWeakDependency() {}

        /**
         * All top-level definitions in this file.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.DescriptorProto message_type = 4;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getMessageType() {}

        /**
         * All top-level definitions in this file.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.DescriptorProto message_type = 4;</code>
         *
         * @param \Google\Protobuf\Internal\DescriptorProto[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setMessageType($var) {}

        public function hasMessageType() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.EnumDescriptorProto enum_type = 5;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getEnumType() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.EnumDescriptorProto enum_type = 5;</code>
         *
         * @param \Google\Protobuf\Internal\EnumDescriptorProto[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setEnumType($var) {}

        public function hasEnumType() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.ServiceDescriptorProto service = 6;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getService() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.ServiceDescriptorProto service = 6;</code>
         *
         * @param \Google\Protobuf\Internal\ServiceDescriptorProto[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setService($var) {}

        public function hasService() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.FieldDescriptorProto extension = 7;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getExtension() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.FieldDescriptorProto extension = 7;</code>
         *
         * @param \Google\Protobuf\Internal\FieldDescriptorProto[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setExtension($var) {}

        public function hasExtension() {}

        /**
         * Generated from protobuf field <code>optional .google.protobuf.FileOptions options = 8;</code>
         * @return \Google\Protobuf\Internal\FileOptions
         */
        public function getOptions() {}

        /**
         * Generated from protobuf field <code>optional .google.protobuf.FileOptions options = 8;</code>
         *
         * @param \Google\Protobuf\Internal\FileOptions $var
         *
         * @return $this
         */
        public function setOptions($var) {}

        public function hasOptions() {}

        /**
         * This field contains optional information about the original source code.
         * You may safely remove this entire field without harming runtime
         * functionality of the descriptors -- the information is needed only by
         * development tools.
         *
         * Generated from protobuf field <code>optional .google.protobuf.SourceCodeInfo source_code_info = 9;</code>
         * @return \Google\Protobuf\Internal\SourceCodeInfo
         */
        public function getSourceCodeInfo() {}

        /**
         * This field contains optional information about the original source code.
         * You may safely remove this entire field without harming runtime
         * functionality of the descriptors -- the information is needed only by
         * development tools.
         *
         * Generated from protobuf field <code>optional .google.protobuf.SourceCodeInfo source_code_info = 9;</code>
         *
         * @param \Google\Protobuf\Internal\SourceCodeInfo $var
         *
         * @return $this
         */
        public function setSourceCodeInfo($var) {}

        public function hasSourceCodeInfo() {}

        /**
         * The syntax of the proto file.
         * The supported values are "proto2" and "proto3".
         *
         * Generated from protobuf field <code>optional string syntax = 12;</code>
         * @return string
         */
        public function getSyntax() {}

        /**
         * The syntax of the proto file.
         * The supported values are "proto2" and "proto3".
         *
         * Generated from protobuf field <code>optional string syntax = 12;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setSyntax($var) {}

        public function hasSyntax() {}

    }

    class CodedOutputStream
    {
        const MAX_VARINT64_BYTES = 10;

        public function __construct($size) {}

        public function getData() {}

        public function writeVarint32($value, $trim) {}

        public function writeVarint64($value) {}

        public function writeLittleEndian32($value) {}

        public function writeLittleEndian64($value) {}

        public function writeTag($tag) {}

        public function writeRaw($data, $size) {}

        public static function writeVarintToArray($value, &$buffer, $trim = false) {}
    }

    /**
     * Generated from protobuf message <code>google.protobuf.DescriptorProto.ExtensionRange</code>
     */
    class DescriptorProto_ExtensionRange extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * Generated from protobuf field <code>optional int32 start = 1;</code>
         * @return int
         */
        public function getStart() {}

        /**
         * Generated from protobuf field <code>optional int32 start = 1;</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setStart($var) {}

        public function hasStart() {}

        /**
         * Generated from protobuf field <code>optional int32 end = 2;</code>
         * @return int
         */
        public function getEnd() {}

        /**
         * Generated from protobuf field <code>optional int32 end = 2;</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setEnd($var) {}

        public function hasEnd() {}

        /**
         * Generated from protobuf field <code>optional .google.protobuf.ExtensionRangeOptions options = 3;</code>
         * @return \Google\Protobuf\Internal\ExtensionRangeOptions
         */
        public function getOptions() {}

        /**
         * Generated from protobuf field <code>optional .google.protobuf.ExtensionRangeOptions options = 3;</code>
         *
         * @param \Google\Protobuf\Internal\ExtensionRangeOptions $var
         *
         * @return $this
         */
        public function setOptions($var) {}

        public function hasOptions() {}

    }

    /**
     * Describes a value within an enum.
     *
     * Generated from protobuf message <code>google.protobuf.EnumValueDescriptorProto</code>
     */
    class EnumValueDescriptorProto extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * Generated from protobuf field <code>optional string name = 1;</code>
         * @return string
         */
        public function getName() {}

        /**
         * Generated from protobuf field <code>optional string name = 1;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setName($var) {}

        public function hasName() {}

        /**
         * Generated from protobuf field <code>optional int32 number = 2;</code>
         * @return int
         */
        public function getNumber() {}

        /**
         * Generated from protobuf field <code>optional int32 number = 2;</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setNumber($var) {}

        public function hasNumber() {}

        /**
         * Generated from protobuf field <code>optional .google.protobuf.EnumValueOptions options = 3;</code>
         * @return \Google\Protobuf\Internal\EnumValueOptions
         */
        public function getOptions() {}

        /**
         * Generated from protobuf field <code>optional .google.protobuf.EnumValueOptions options = 3;</code>
         *
         * @param \Google\Protobuf\Internal\EnumValueOptions $var
         *
         * @return $this
         */
        public function setOptions($var) {}

        public function hasOptions() {}

    }

    /**
     * Range of reserved numeric values. Reserved values may not be used by
     * entries in the same enum. Reserved ranges may not overlap.
     * Note that this is distinct from DescriptorProto.ReservedRange in that it
     * is inclusive such that it can appropriately represent the entire int32
     * domain.
     *
     * Generated from protobuf message <code>google.protobuf.EnumDescriptorProto.EnumReservedRange</code>
     */
    class EnumDescriptorProto_EnumReservedRange extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * Inclusive.
         *
         * Generated from protobuf field <code>optional int32 start = 1;</code>
         * @return int
         */
        public function getStart() {}

        /**
         * Inclusive.
         *
         * Generated from protobuf field <code>optional int32 start = 1;</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setStart($var) {}

        public function hasStart() {}

        /**
         * Inclusive.
         *
         * Generated from protobuf field <code>optional int32 end = 2;</code>
         * @return int
         */
        public function getEnd() {}

        /**
         * Inclusive.
         *
         * Generated from protobuf field <code>optional int32 end = 2;</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setEnd($var) {}

        public function hasEnd() {}

    }

    /**
     * Protobuf enum <code>Google\Protobuf\Internal</code>
     */
    class FieldDescriptorProto_Label
    {
        /**
         * 0 is reserved for errors
         *
         * Generated from protobuf enum <code>LABEL_OPTIONAL = 1;</code>
         */
        const LABEL_OPTIONAL = 1;

        /**
         * Generated from protobuf enum <code>LABEL_REQUIRED = 2;</code>
         */
        const LABEL_REQUIRED = 2;

        /**
         * Generated from protobuf enum <code>LABEL_REPEATED = 3;</code>
         */
        const LABEL_REPEATED = 3;
    }

    /**
     * Protobuf enum <code>Google\Protobuf\Internal</code>
     */
    class FieldDescriptorProto_Type
    {
        /**
         * 0 is reserved for errors.
         * Order is weird for historical reasons.
         *
         * Generated from protobuf enum <code>TYPE_DOUBLE = 1;</code>
         */
        const TYPE_DOUBLE = 1;

        /**
         * Generated from protobuf enum <code>TYPE_FLOAT = 2;</code>
         */
        const TYPE_FLOAT = 2;

        /**
         * Not ZigZag encoded.  Negative numbers take 10 bytes.  Use TYPE_SINT64 if
         * negative values are likely.
         *
         * Generated from protobuf enum <code>TYPE_INT64 = 3;</code>
         */
        const TYPE_INT64 = 3;

        /**
         * Generated from protobuf enum <code>TYPE_UINT64 = 4;</code>
         */
        const TYPE_UINT64 = 4;

        /**
         * Not ZigZag encoded.  Negative numbers take 10 bytes.  Use TYPE_SINT32 if
         * negative values are likely.
         *
         * Generated from protobuf enum <code>TYPE_INT32 = 5;</code>
         */
        const TYPE_INT32 = 5;

        /**
         * Generated from protobuf enum <code>TYPE_FIXED64 = 6;</code>
         */
        const TYPE_FIXED64 = 6;

        /**
         * Generated from protobuf enum <code>TYPE_FIXED32 = 7;</code>
         */
        const TYPE_FIXED32 = 7;

        /**
         * Generated from protobuf enum <code>TYPE_BOOL = 8;</code>
         */
        const TYPE_BOOL = 8;

        /**
         * Generated from protobuf enum <code>TYPE_STRING = 9;</code>
         */
        const TYPE_STRING = 9;
        /**

         * Tag-delimited aggregate.
         * Group type is deprecated and not supported in proto3. However, Proto3
         * implementations should still be able to parse the group wire format and
         * treat group fields as unknown fields.
         *
         * Generated from protobuf enum <code>TYPE_GROUP = 10;</code>
         */
        const TYPE_GROUP = 10;

        /**
         * Length-delimited aggregate.
         *
         * Generated from protobuf enum <code>TYPE_MESSAGE = 11;</code>
         */
        const TYPE_MESSAGE = 11;

        /**
         * New in version 2.
         *
         * Generated from protobuf enum <code>TYPE_BYTES = 12;</code>
         */
        const TYPE_BYTES = 12;

        /**
         * Generated from protobuf enum <code>TYPE_UINT32 = 13;</code>
         */
        const TYPE_UINT32 = 13;

        /**
         * Generated from protobuf enum <code>TYPE_ENUM = 14;</code>
         */
        const TYPE_ENUM = 14;

        /**
         * Generated from protobuf enum <code>TYPE_SFIXED32 = 15;</code>
         */
        const TYPE_SFIXED32 = 15;

        /**
         * Generated from protobuf enum <code>TYPE_SFIXED64 = 16;</code>
         */
        const TYPE_SFIXED64 = 16;

        /**
         * Uses ZigZag encoding.
         *
         * Generated from protobuf enum <code>TYPE_SINT32 = 17;</code>
         */
        const TYPE_SINT32 = 17;

        /**
         * Uses ZigZag encoding.
         *
         * Generated from protobuf enum <code>TYPE_SINT64 = 18;</code>
         */
        const TYPE_SINT64 = 18;
    }

    /**
     * A message representing a option the parser does not recognize. This only
     * appears in options protos created by the compiler::Parser class.
     * DescriptorPool resolves these when building Descriptor objects. Therefore,
     * options protos in descriptor objects (e.g. returned by Descriptor::options(),
     * or produced by Descriptor::CopyTo()) will never have UninterpretedOptions
     * in them.
     *
     * Generated from protobuf message <code>google.protobuf.UninterpretedOption</code>
     */
    class UninterpretedOption extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.UninterpretedOption.NamePart name = 2;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getName() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.UninterpretedOption.NamePart name = 2;</code>
         *
         * @param \Google\Protobuf\Internal\UninterpretedOption_NamePart[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setName($var) {}

        public function hasName() {}

        /**
         * The value of the uninterpreted option, in whatever type the tokenizer
         * identified it as during parsing. Exactly one of these should be set.
         *
         * Generated from protobuf field <code>optional string identifier_value = 3;</code>
         * @return string
         */
        public function getIdentifierValue() {}

        /**
         * The value of the uninterpreted option, in whatever type the tokenizer
         * identified it as during parsing. Exactly one of these should be set.
         *
         * Generated from protobuf field <code>optional string identifier_value = 3;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setIdentifierValue($var) {}

        public function hasIdentifierValue() {}

        /**
         * Generated from protobuf field <code>optional uint64 positive_int_value = 4;</code>
         * @return int|string
         */
        public function getPositiveIntValue() {}

        /**
         * Generated from protobuf field <code>optional uint64 positive_int_value = 4;</code>
         *
         * @param int|string $var
         *
         * @return $this
         */
        public function setPositiveIntValue($var) {}

        public function hasPositiveIntValue() {}

        /**
         * Generated from protobuf field <code>optional int64 negative_int_value = 5;</code>
         * @return int|string
         */
        public function getNegativeIntValue() {}

        /**
         * Generated from protobuf field <code>optional int64 negative_int_value = 5;</code>
         *
         * @param int|string $var
         *
         * @return $this
         */
        public function setNegativeIntValue($var) {}

        public function hasNegativeIntValue() {}

        /**
         * Generated from protobuf field <code>optional double double_value = 6;</code>
         * @return float
         */
        public function getDoubleValue() {}

        /**
         * Generated from protobuf field <code>optional double double_value = 6;</code>
         *
         * @param float $var
         *
         * @return $this
         */
        public function setDoubleValue($var) {}

        public function hasDoubleValue() {}

        /**
         * Generated from protobuf field <code>optional bytes string_value = 7;</code>
         * @return string
         */
        public function getStringValue() {}

        /**
         * Generated from protobuf field <code>optional bytes string_value = 7;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setStringValue($var) {}

        public function hasStringValue() {}

        /**
         * Generated from protobuf field <code>optional string aggregate_value = 8;</code>
         * @return string
         */
        public function getAggregateValue() {}

        /**
         * Generated from protobuf field <code>optional string aggregate_value = 8;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setAggregateValue($var) {}

        public function hasAggregateValue() {}

    }

    class GPBWireType
    {
        const VARINT = 0;
        const FIXED64 = 1;
        const LENGTH_DELIMITED = 2;
        const START_GROUP = 3;
        const END_GROUP = 4;
        const FIXED32 = 5;
    }

    /**
     * Generated from protobuf message <code>google.protobuf.EnumValueOptions</code>
     */
    class EnumValueOptions extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * Is this enum value deprecated?
         * Depending on the target platform, this can emit Deprecated annotations
         * for the enum value, or it will be completely ignored; in the very least,
         * this is a formalization for deprecating enum values.
         *
         * Generated from protobuf field <code>optional bool deprecated = 1 [default = false];</code>
         * @return bool
         */
        public function getDeprecated() {}

        /**
         * Is this enum value deprecated?
         * Depending on the target platform, this can emit Deprecated annotations
         * for the enum value, or it will be completely ignored; in the very least,
         * this is a formalization for deprecating enum values.
         *
         * Generated from protobuf field <code>optional bool deprecated = 1 [default = false];</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setDeprecated($var) {}

        public function hasDeprecated() {}

        /**
         * The parser stores options it doesn't recognize here. See above.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.UninterpretedOption uninterpreted_option =
         * 999;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getUninterpretedOption() {}

        /**
         * The parser stores options it doesn't recognize here. See above.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.UninterpretedOption uninterpreted_option =
         * 999;</code>
         *
         * @param \Google\Protobuf\Internal\UninterpretedOption[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setUninterpretedOption($var) {}

        public function hasUninterpretedOption() {}

    }

    /**
     * Generated from protobuf message <code>google.protobuf.ExtensionRangeOptions</code>
     */
    class ExtensionRangeOptions extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * The parser stores options it doesn't recognize here. See above.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.UninterpretedOption uninterpreted_option =
         * 999;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getUninterpretedOption() {}

        /**
         * The parser stores options it doesn't recognize here. See above.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.UninterpretedOption uninterpreted_option =
         * 999;</code>
         *
         * @param \Google\Protobuf\Internal\UninterpretedOption[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setUninterpretedOption($var) {}

        public function hasUninterpretedOption() {}

    }

    /**
     * Generated from protobuf message <code>google.protobuf.GeneratedCodeInfo.Annotation</code>
     */
    class GeneratedCodeInfo_Annotation extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * Identifies the element in the original source .proto file. This field
         * is formatted the same as SourceCodeInfo.Location.path.
         *
         * Generated from protobuf field <code>repeated int32 path = 1 [packed = true];</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getPath() {}

        /**
         * Identifies the element in the original source .proto file. This field
         * is formatted the same as SourceCodeInfo.Location.path.
         *
         * Generated from protobuf field <code>repeated int32 path = 1 [packed = true];</code>
         *
         * @param int[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setPath($var) {}

        public function hasPath() {}

        /**
         * Identifies the filesystem path to the original source .proto.
         *
         * Generated from protobuf field <code>optional string source_file = 2;</code>
         * @return string
         */
        public function getSourceFile() {}

        /**
         * Identifies the filesystem path to the original source .proto.
         *
         * Generated from protobuf field <code>optional string source_file = 2;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setSourceFile($var) {}

        public function hasSourceFile() {}

        /**
         * Identifies the starting offset in bytes in the generated code
         * that relates to the identified object.
         *
         * Generated from protobuf field <code>optional int32 begin = 3;</code>
         * @return int
         */
        public function getBegin() {}

        /**
         * Identifies the starting offset in bytes in the generated code
         * that relates to the identified object.
         *
         * Generated from protobuf field <code>optional int32 begin = 3;</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setBegin($var) {}

        public function hasBegin() {}

        /**
         * Identifies the ending offset in bytes in the generated code that
         * relates to the identified offset. The end offset should be one past
         * the last relevant byte (so the length of the text = end - begin).
         *
         * Generated from protobuf field <code>optional int32 end = 4;</code>
         * @return int
         */
        public function getEnd() {}

        /**
         * Identifies the ending offset in bytes in the generated code that
         * relates to the identified offset. The end offset should be one past
         * the last relevant byte (so the length of the text = end - begin).
         *
         * Generated from protobuf field <code>optional int32 end = 4;</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setEnd($var) {}

        public function hasEnd() {}

    }

    trait GetPublicDescriptorTrait
    {
        public function getPublicDescriptor($desc) {}
    }

    trait HasPublicDescriptorTrait
    {
        public function getPublicDescriptor() {}
    }

    /**
     * Protobuf enum <code>Google\Protobuf\Internal</code>
     */
    class FieldOptions_JSType
    {
        /**
         * Use the default type.
         *
         * Generated from protobuf enum <code>JS_NORMAL = 0;</code>
         */
        const JS_NORMAL = 0;

        /**
         * Use JavaScript strings.
         *
         * Generated from protobuf enum <code>JS_STRING = 1;</code>
         */
        const JS_STRING = 1;

        /**
         * Use JavaScript numbers.
         *
         * Generated from protobuf enum <code>JS_NUMBER = 2;</code>
         */
        const JS_NUMBER = 2;
    }

    /**
     * Describes the relationship between generated code and its original source
     * file. A GeneratedCodeInfo message is associated with only one generated
     * source file, but may contain references to different source .proto files.
     *
     * Generated from protobuf message <code>google.protobuf.GeneratedCodeInfo</code>
     */
    class GeneratedCodeInfo extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * An Annotation connects some span of text in generated code to an element
         * of its generating .proto file.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.GeneratedCodeInfo.Annotation annotation =
         * 1;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getAnnotation() {}

        /**
         * An Annotation connects some span of text in generated code to an element
         * of its generating .proto file.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.GeneratedCodeInfo.Annotation annotation =
         * 1;</code>
         *
         * @param \Google\Protobuf\Internal\GeneratedCodeInfo_Annotation[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setAnnotation($var) {}

        public function hasAnnotation() {}

    }

    /**
     * Generated from protobuf message <code>google.protobuf.MessageOptions</code>
     */
    class MessageOptions extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * Set true to use the old proto1 MessageSet wire format for extensions.
         * This is provided for backwards-compatibility with the MessageSet wire
         * format.  You should not use this for any other reason:  It's less
         * efficient, has fewer features, and is more complicated.
         * The message must be defined exactly as follows:
         *   message Foo {
         *     option message_set_wire_format = true;
         *     extensions 4 to max;
         *   }
         * Note that the message cannot have any defined fields; MessageSets only
         * have extensions.
         * All extensions of your type must be singular messages; e.g. they cannot
         * be int32s, enums, or repeated messages.
         * Because this is an option, the above two restrictions are not enforced by
         * the protocol compiler.
         *
         * Generated from protobuf field <code>optional bool message_set_wire_format = 1 [default = false];</code>
         * @return bool
         */
        public function getMessageSetWireFormat() {}

        /**
         * Set true to use the old proto1 MessageSet wire format for extensions.
         * This is provided for backwards-compatibility with the MessageSet wire
         * format.  You should not use this for any other reason:  It's less
         * efficient, has fewer features, and is more complicated.
         * The message must be defined exactly as follows:
         *   message Foo {
         *     option message_set_wire_format = true;
         *     extensions 4 to max;
         *   }
         * Note that the message cannot have any defined fields; MessageSets only
         * have extensions.
         * All extensions of your type must be singular messages; e.g. they cannot
         * be int32s, enums, or repeated messages.
         * Because this is an option, the above two restrictions are not enforced by
         * the protocol compiler.
         *
         * Generated from protobuf field <code>optional bool message_set_wire_format = 1 [default = false];</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setMessageSetWireFormat($var) {}

        public function hasMessageSetWireFormat() {}

        /**
         * Disables the generation of the standard "descriptor()" accessor, which can
         * conflict with a field of the same name.  This is meant to make migration
         * from proto1 easier; new code should avoid fields named "descriptor".
         *
         * Generated from protobuf field <code>optional bool no_standard_descriptor_accessor = 2 [default =
         * false];</code>
         * @return bool
         */
        public function getNoStandardDescriptorAccessor() {}

        /**
         * Disables the generation of the standard "descriptor()" accessor, which can
         * conflict with a field of the same name.  This is meant to make migration
         * from proto1 easier; new code should avoid fields named "descriptor".
         *
         * Generated from protobuf field <code>optional bool no_standard_descriptor_accessor = 2 [default =
         * false];</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setNoStandardDescriptorAccessor($var) {}

        public function hasNoStandardDescriptorAccessor() {}

        /**
         * Is this message deprecated?
         * Depending on the target platform, this can emit Deprecated annotations
         * for the message, or it will be completely ignored; in the very least,
         * this is a formalization for deprecating messages.
         *
         * Generated from protobuf field <code>optional bool deprecated = 3 [default = false];</code>
         * @return bool
         */
        public function getDeprecated() {}

        /**
         * Is this message deprecated?
         * Depending on the target platform, this can emit Deprecated annotations
         * for the message, or it will be completely ignored; in the very least,
         * this is a formalization for deprecating messages.
         *
         * Generated from protobuf field <code>optional bool deprecated = 3 [default = false];</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setDeprecated($var) {}

        public function hasDeprecated() {}

        /**
         * Whether the message is an automatically generated map entry type for the
         * maps field.
         * For maps fields:
         *     map<KeyType, ValueType> map_field = 1;
         * The parsed descriptor looks like:
         *     message MapFieldEntry {
         *         option map_entry = true;
         *         optional KeyType key = 1;
         *         optional ValueType value = 2;
         *     }
         *     repeated MapFieldEntry map_field = 1;
         * Implementations may choose not to generate the map_entry=true message, but
         * use a native map in the target language to hold the keys and values.
         * The reflection APIs in such implementions still need to work as
         * if the field is a repeated message field.
         * NOTE: Do not set the option in .proto files. Always use the maps syntax
         * instead. The option should only be implicitly set by the proto compiler
         * parser.
         *
         * Generated from protobuf field <code>optional bool map_entry = 7;</code>
         * @return bool
         */
        public function getMapEntry() {}

        /**
         * Whether the message is an automatically generated map entry type for the
         * maps field.
         * For maps fields:
         *     map<KeyType, ValueType> map_field = 1;
         * The parsed descriptor looks like:
         *     message MapFieldEntry {
         *         option map_entry = true;
         *         optional KeyType key = 1;
         *         optional ValueType value = 2;
         *     }
         *     repeated MapFieldEntry map_field = 1;
         * Implementations may choose not to generate the map_entry=true message, but
         * use a native map in the target language to hold the keys and values.
         * The reflection APIs in such implementions still need to work as
         * if the field is a repeated message field.
         * NOTE: Do not set the option in .proto files. Always use the maps syntax
         * instead. The option should only be implicitly set by the proto compiler
         * parser.
         *
         * Generated from protobuf field <code>optional bool map_entry = 7;</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setMapEntry($var) {}

        public function hasMapEntry() {}

        /**
         * The parser stores options it doesn't recognize here. See above.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.UninterpretedOption uninterpreted_option =
         * 999;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getUninterpretedOption() {}

        /**
         * The parser stores options it doesn't recognize here. See above.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.UninterpretedOption uninterpreted_option =
         * 999;</code>
         *
         * @param \Google\Protobuf\Internal\UninterpretedOption[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setUninterpretedOption($var) {}

        public function hasUninterpretedOption() {}

    }

    /**
     * Generated from protobuf message <code>google.protobuf.OneofOptions</code>
     */
    class OneofOptions extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * The parser stores options it doesn't recognize here. See above.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.UninterpretedOption uninterpreted_option =
         * 999;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getUninterpretedOption() {}

        /**
         * The parser stores options it doesn't recognize here. See above.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.UninterpretedOption uninterpreted_option =
         * 999;</code>
         *
         * @param \Google\Protobuf\Internal\UninterpretedOption[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setUninterpretedOption($var) {}

        public function hasUninterpretedOption() {}

    }

    class GPBLabel
    {
        const OPTIONAL = 1;
        const REQUIRED = 2;
        const REPEATED = 3;
    }

    class OneofDescriptor
    {
        use HasPublicDescriptorTrait;

        public function __construct() {}

        public function setName($name) {}

        public function getName() {}

        public function addField(FieldDescriptor $field) {}

        public function getFields() {}

        public static function buildFromProto($oneof_proto, $desc, $index) {}
    }

    /**
     * Describes a service.
     *
     * Generated from protobuf message <code>google.protobuf.ServiceDescriptorProto</code>
     */
    class ServiceDescriptorProto extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * Generated from protobuf field <code>optional string name = 1;</code>
         * @return string
         */
        public function getName() {}

        /**
         * Generated from protobuf field <code>optional string name = 1;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setName($var) {}

        public function hasName() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.MethodDescriptorProto method = 2;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getMethod() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.MethodDescriptorProto method = 2;</code>
         *
         * @param \Google\Protobuf\Internal\MethodDescriptorProto[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setMethod($var) {}

        public function hasMethod() {}

        /**
         * Generated from protobuf field <code>optional .google.protobuf.ServiceOptions options = 3;</code>
         * @return \Google\Protobuf\Internal\ServiceOptions
         */
        public function getOptions() {}

        /**
         * Generated from protobuf field <code>optional .google.protobuf.ServiceOptions options = 3;</code>
         *
         * @param \Google\Protobuf\Internal\ServiceOptions $var
         *
         * @return $this
         */
        public function setOptions($var) {}

        public function hasOptions() {}

    }

    /**
     * Generated from protobuf message <code>google.protobuf.FileOptions</code>
     */
    class FileOptions extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * Sets the Java package where classes generated from this .proto will be
         * placed.  By default, the proto package is used, but this is often
         * inappropriate because proto packages do not normally start with backwards
         * domain names.
         *
         * Generated from protobuf field <code>optional string java_package = 1;</code>
         * @return string
         */
        public function getJavaPackage() {}

        /**
         * Sets the Java package where classes generated from this .proto will be
         * placed.  By default, the proto package is used, but this is often
         * inappropriate because proto packages do not normally start with backwards
         * domain names.
         *
         * Generated from protobuf field <code>optional string java_package = 1;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setJavaPackage($var) {}

        public function hasJavaPackage() {}

        /**
         * If set, all the classes from the .proto file are wrapped in a single
         * outer class with the given name.  This applies to both Proto1
         * (equivalent to the old "--one_java_file" option) and Proto2 (where
         * a .proto always translates to a single class, but you may want to
         * explicitly choose the class name).
         *
         * Generated from protobuf field <code>optional string java_outer_classname = 8;</code>
         * @return string
         */
        public function getJavaOuterClassname() {}

        /**
         * If set, all the classes from the .proto file are wrapped in a single
         * outer class with the given name.  This applies to both Proto1
         * (equivalent to the old "--one_java_file" option) and Proto2 (where
         * a .proto always translates to a single class, but you may want to
         * explicitly choose the class name).
         *
         * Generated from protobuf field <code>optional string java_outer_classname = 8;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setJavaOuterClassname($var) {}

        public function hasJavaOuterClassname() {}

        /**
         * If set true, then the Java code generator will generate a separate .java
         * file for each top-level message, enum, and service defined in the .proto
         * file.  Thus, these types will *not* be nested inside the outer class
         * named by java_outer_classname.  However, the outer class will still be
         * generated to contain the file's getDescriptor() method as well as any
         * top-level extensions defined in the file.
         *
         * Generated from protobuf field <code>optional bool java_multiple_files = 10 [default = false];</code>
         * @return bool
         */
        public function getJavaMultipleFiles() {}

        /**
         * If set true, then the Java code generator will generate a separate .java
         * file for each top-level message, enum, and service defined in the .proto
         * file.  Thus, these types will *not* be nested inside the outer class
         * named by java_outer_classname.  However, the outer class will still be
         * generated to contain the file's getDescriptor() method as well as any
         * top-level extensions defined in the file.
         *
         * Generated from protobuf field <code>optional bool java_multiple_files = 10 [default = false];</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setJavaMultipleFiles($var) {}

        public function hasJavaMultipleFiles() {}

        /**
         * This option does nothing.
         *
         * Generated from protobuf field <code>optional bool java_generate_equals_and_hash = 20 [deprecated =
         * true];</code>
         * @return bool
         */
        public function getJavaGenerateEqualsAndHash() {}

        /**
         * This option does nothing.
         *
         * Generated from protobuf field <code>optional bool java_generate_equals_and_hash = 20 [deprecated =
         * true];</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setJavaGenerateEqualsAndHash($var) {}

        public function hasJavaGenerateEqualsAndHash() {}

        /**
         * If set true, then the Java2 code generator will generate code that
         * throws an exception whenever an attempt is made to assign a non-UTF-8
         * byte sequence to a string field.
         * Message reflection will do the same.
         * However, an extension field still accepts non-UTF-8 byte sequences.
         * This option has no effect on when used with the lite runtime.
         *
         * Generated from protobuf field <code>optional bool java_string_check_utf8 = 27 [default = false];</code>
         * @return bool
         */
        public function getJavaStringCheckUtf8() {}

        /**
         * If set true, then the Java2 code generator will generate code that
         * throws an exception whenever an attempt is made to assign a non-UTF-8
         * byte sequence to a string field.
         * Message reflection will do the same.
         * However, an extension field still accepts non-UTF-8 byte sequences.
         * This option has no effect on when used with the lite runtime.
         *
         * Generated from protobuf field <code>optional bool java_string_check_utf8 = 27 [default = false];</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setJavaStringCheckUtf8($var) {}

        public function hasJavaStringCheckUtf8() {}

        /**
         * Generated from protobuf field <code>optional .google.protobuf.FileOptions.OptimizeMode optimize_for = 9
         * [default
         * = SPEED];</code>
         * @return int
         */
        public function getOptimizeFor() {}

        /**
         * Generated from protobuf field <code>optional .google.protobuf.FileOptions.OptimizeMode optimize_for = 9
         * [default
         * = SPEED];</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setOptimizeFor($var) {}

        public function hasOptimizeFor() {}

        /**
         * Sets the Go package where structs generated from this .proto will be
         * placed. If omitted, the Go package will be derived from the following:
         *   - The basename of the package import path, if provided.
         *   - Otherwise, the package statement in the .proto file, if present.
         *   - Otherwise, the basename of the .proto file, without extension.
         *
         * Generated from protobuf field <code>optional string go_package = 11;</code>
         * @return string
         */
        public function getGoPackage() {}

        /**
         * Sets the Go package where structs generated from this .proto will be
         * placed. If omitted, the Go package will be derived from the following:
         *   - The basename of the package import path, if provided.
         *   - Otherwise, the package statement in the .proto file, if present.
         *   - Otherwise, the basename of the .proto file, without extension.
         *
         * Generated from protobuf field <code>optional string go_package = 11;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setGoPackage($var) {}

        public function hasGoPackage() {}

        /**
         * Should generic services be generated in each language?  "Generic" services
         * are not specific to any particular RPC system.  They are generated by the
         * main code generators in each language (without additional plugins).
         * Generic services were the only kind of service generation supported by
         * early versions of google.protobuf.
         * Generic services are now considered deprecated in favor of using plugins
         * that generate code specific to your particular RPC system.  Therefore,
         * these default to false.  Old code which depends on generic services should
         * explicitly set them to true.
         *
         * Generated from protobuf field <code>optional bool cc_generic_services = 16 [default = false];</code>
         * @return bool
         */
        public function getCcGenericServices() {}

        /**
         * Should generic services be generated in each language?  "Generic" services
         * are not specific to any particular RPC system.  They are generated by the
         * main code generators in each language (without additional plugins).
         * Generic services were the only kind of service generation supported by
         * early versions of google.protobuf.
         * Generic services are now considered deprecated in favor of using plugins
         * that generate code specific to your particular RPC system.  Therefore,
         * these default to false.  Old code which depends on generic services should
         * explicitly set them to true.
         *
         * Generated from protobuf field <code>optional bool cc_generic_services = 16 [default = false];</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setCcGenericServices($var) {}

        public function hasCcGenericServices() {}

        /**
         * Generated from protobuf field <code>optional bool java_generic_services = 17 [default = false];</code>
         * @return bool
         */
        public function getJavaGenericServices() {}

        /**
         * Generated from protobuf field <code>optional bool java_generic_services = 17 [default = false];</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setJavaGenericServices($var) {}

        public function hasJavaGenericServices() {}

        /**
         * Generated from protobuf field <code>optional bool py_generic_services = 18 [default = false];</code>
         * @return bool
         */
        public function getPyGenericServices() {}

        /**
         * Generated from protobuf field <code>optional bool py_generic_services = 18 [default = false];</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setPyGenericServices($var) {}

        public function hasPyGenericServices() {}

        /**
         * Generated from protobuf field <code>optional bool php_generic_services = 42 [default = false];</code>
         * @return bool
         */
        public function getPhpGenericServices() {}

        /**
         * Generated from protobuf field <code>optional bool php_generic_services = 42 [default = false];</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setPhpGenericServices($var) {}

        public function hasPhpGenericServices() {}

        /**
         * Is this file deprecated?
         * Depending on the target platform, this can emit Deprecated annotations
         * for everything in the file, or it will be completely ignored; in the very
         * least, this is a formalization for deprecating files.
         *
         * Generated from protobuf field <code>optional bool deprecated = 23 [default = false];</code>
         * @return bool
         */
        public function getDeprecated() {}

        /**
         * Is this file deprecated?
         * Depending on the target platform, this can emit Deprecated annotations
         * for everything in the file, or it will be completely ignored; in the very
         * least, this is a formalization for deprecating files.
         *
         * Generated from protobuf field <code>optional bool deprecated = 23 [default = false];</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setDeprecated($var) {}

        public function hasDeprecated() {}

        /**
         * Enables the use of arenas for the proto messages in this file. This applies
         * only to generated classes for C++.
         *
         * Generated from protobuf field <code>optional bool cc_enable_arenas = 31 [default = false];</code>
         * @return bool
         */
        public function getCcEnableArenas() {}

        /**
         * Enables the use of arenas for the proto messages in this file. This applies
         * only to generated classes for C++.
         *
         * Generated from protobuf field <code>optional bool cc_enable_arenas = 31 [default = false];</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setCcEnableArenas($var) {}

        public function hasCcEnableArenas() {}

        /**
         * Sets the objective c class prefix which is prepended to all objective c
         * generated classes from this .proto. There is no default.
         *
         * Generated from protobuf field <code>optional string objc_class_prefix = 36;</code>
         * @return string
         */
        public function getObjcClassPrefix() {}

        /**
         * Sets the objective c class prefix which is prepended to all objective c
         * generated classes from this .proto. There is no default.
         *
         * Generated from protobuf field <code>optional string objc_class_prefix = 36;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setObjcClassPrefix($var) {}

        public function hasObjcClassPrefix() {}

        /**
         * Namespace for generated classes; defaults to the package.
         *
         * Generated from protobuf field <code>optional string csharp_namespace = 37;</code>
         * @return string
         */
        public function getCsharpNamespace() {}

        /**
         * Namespace for generated classes; defaults to the package.
         *
         * Generated from protobuf field <code>optional string csharp_namespace = 37;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setCsharpNamespace($var) {}

        public function hasCsharpNamespace() {}

        /**
         * By default Swift generators will take the proto package and CamelCase it
         * replacing '.' with underscore and use that to prefix the types/symbols
         * defined. When this options is provided, they will use this value instead
         * to prefix the types/symbols defined.
         *
         * Generated from protobuf field <code>optional string swift_prefix = 39;</code>
         * @return string
         */
        public function getSwiftPrefix() {}

        /**
         * By default Swift generators will take the proto package and CamelCase it
         * replacing '.' with underscore and use that to prefix the types/symbols
         * defined. When this options is provided, they will use this value instead
         * to prefix the types/symbols defined.
         *
         * Generated from protobuf field <code>optional string swift_prefix = 39;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setSwiftPrefix($var) {}

        public function hasSwiftPrefix() {}

        /**
         * Sets the php class prefix which is prepended to all php generated classes
         * from this .proto. Default is empty.
         *
         * Generated from protobuf field <code>optional string php_class_prefix = 40;</code>
         * @return string
         */
        public function getPhpClassPrefix() {}

        /**
         * Sets the php class prefix which is prepended to all php generated classes
         * from this .proto. Default is empty.
         *
         * Generated from protobuf field <code>optional string php_class_prefix = 40;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setPhpClassPrefix($var) {}

        public function hasPhpClassPrefix() {}

        /**
         * Use this option to change the namespace of php generated classes. Default
         * is empty. When this option is empty, the package name will be used for
         * determining the namespace.
         *
         * Generated from protobuf field <code>optional string php_namespace = 41;</code>
         * @return string
         */
        public function getPhpNamespace() {}

        /**
         * Use this option to change the namespace of php generated classes. Default
         * is empty. When this option is empty, the package name will be used for
         * determining the namespace.
         *
         * Generated from protobuf field <code>optional string php_namespace = 41;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setPhpNamespace($var) {}

        public function hasPhpNamespace() {}

        /**
         * The parser stores options it doesn't recognize here.
         * See the documentation for the "Options" section above.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.UninterpretedOption uninterpreted_option =
         * 999;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getUninterpretedOption() {}

        /**
         * The parser stores options it doesn't recognize here.
         * See the documentation for the "Options" section above.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.UninterpretedOption uninterpreted_option =
         * 999;</code>
         *
         * @param \Google\Protobuf\Internal\UninterpretedOption[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setUninterpretedOption($var) {}

        public function hasUninterpretedOption() {}

    }

    /**
     * RepeatedField is used by generated protocol message classes to manipulate
     * repeated fields. It can be used like native PHP array.
     */
    class RepeatedField implements \ArrayAccess, \IteratorAggregate, \Countable
    {
        /**
         * Constructs an instance of RepeatedField.
         *
         * @param int    $type  Type of the stored element.
         * @param string $klass Message/Enum class name (message/enum fields only).
         *
         * @ignore
         */
        public function __construct($type, $klass = null) {}

        /**
         * @ignore
         */
        public function getType() {}

        /**
         * @ignore
         */
        public function getClass() {}

        /**
         * Return the element at the given index.
         *
         * This will also be called for: $ele = $arr[0]
         *
         * @param int  $offset The index of the element to be fetched.
         *
         * @return object The stored element at given index.
         * @throws \ErrorException Invalid type for index.
         * @throws \ErrorException Non-existing index.
         */
        public function offsetGet($offset) {}

        /**
         * Assign the element at the given index.
         *
         * This will also be called for: $arr []= $ele and $arr[0] = ele
         *
         * @param int    $offset The index of the element to be assigned.
         * @param object $value  The element to be assigned.
         *
         * @return void
         * @throws \ErrorException Invalid type for index.
         * @throws \ErrorException Non-existing index.
         * @throws \ErrorException Incorrect type of the element.
         */
        public function offsetSet($offset, $value) {}

        /**
         * Remove the element at the given index.
         *
         * This will also be called for: unset($arr)
         *
         * @param int  $offset The index of the element to be removed.
         *
         * @return void
         * @throws \ErrorException Invalid type for index.
         * @throws \ErrorException The element to be removed is not at the end of the
         * RepeatedField.
         */
        public function offsetUnset($offset) {}

        /**
         * Check the existence of the element at the given index.
         *
         * This will also be called for: isset($arr)
         *
         * @param int  $offset The index of the element to be removed.
         *
         * @return bool True if the element at the given offset exists.
         * @throws \ErrorException Invalid type for index.
         */
        public function offsetExists($offset) {}

        /**
         * @ignore
         */
        public function getIterator() {}

        /**
         * Return the number of stored elements.
         *
         * This will also be called for: count($arr)
         *
         * @return integer The number of stored elements.
         */
        public function count() {}
    }

    /**
     * Generated from protobuf message <code>google.protobuf.FieldOptions</code>
     */
    class FieldOptions extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * The ctype option instructs the C++ code generator to use a different
         * representation of the field than it normally would.  See the specific
         * options below.  This option is not yet implemented in the open source
         * release -- sorry, we'll try to include it in a future version!
         *
         * Generated from protobuf field <code>optional .google.protobuf.FieldOptions.CType ctype = 1 [default =
         * STRING];</code>
         * @return int
         */
        public function getCtype() {}

        /**
         * The ctype option instructs the C++ code generator to use a different
         * representation of the field than it normally would.  See the specific
         * options below.  This option is not yet implemented in the open source
         * release -- sorry, we'll try to include it in a future version!
         *
         * Generated from protobuf field <code>optional .google.protobuf.FieldOptions.CType ctype = 1 [default =
         * STRING];</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setCtype($var) {}

        public function hasCtype() {}

        /**
         * The packed option can be enabled for repeated primitive fields to enable
         * a more efficient representation on the wire. Rather than repeatedly
         * writing the tag and type for each element, the entire array is encoded as
         * a single length-delimited blob. In proto3, only explicit setting it to
         * false will avoid using packed encoding.
         *
         * Generated from protobuf field <code>optional bool packed = 2;</code>
         * @return bool
         */
        public function getPacked() {}

        /**
         * The packed option can be enabled for repeated primitive fields to enable
         * a more efficient representation on the wire. Rather than repeatedly
         * writing the tag and type for each element, the entire array is encoded as
         * a single length-delimited blob. In proto3, only explicit setting it to
         * false will avoid using packed encoding.
         *
         * Generated from protobuf field <code>optional bool packed = 2;</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setPacked($var) {}

        public function hasPacked() {}

        /**
         * The jstype option determines the JavaScript type used for values of the
         * field.  The option is permitted only for 64 bit integral and fixed types
         * (int64, uint64, sint64, fixed64, sfixed64).  A field with jstype JS_STRING
         * is represented as JavaScript string, which avoids loss of precision that
         * can happen when a large value is converted to a floating point JavaScript.
         * Specifying JS_NUMBER for the jstype causes the generated JavaScript code to
         * use the JavaScript "number" type.  The behavior of the default option
         * JS_NORMAL is implementation dependent.
         * This option is an enum to permit additional types to be added, e.g.
         * goog.math.Integer.
         *
         * Generated from protobuf field <code>optional .google.protobuf.FieldOptions.JSType jstype = 6 [default =
         * JS_NORMAL];</code>
         * @return int
         */
        public function getJstype() {}

        /**
         * The jstype option determines the JavaScript type used for values of the
         * field.  The option is permitted only for 64 bit integral and fixed types
         * (int64, uint64, sint64, fixed64, sfixed64).  A field with jstype JS_STRING
         * is represented as JavaScript string, which avoids loss of precision that
         * can happen when a large value is converted to a floating point JavaScript.
         * Specifying JS_NUMBER for the jstype causes the generated JavaScript code to
         * use the JavaScript "number" type.  The behavior of the default option
         * JS_NORMAL is implementation dependent.
         * This option is an enum to permit additional types to be added, e.g.
         * goog.math.Integer.
         *
         * Generated from protobuf field <code>optional .google.protobuf.FieldOptions.JSType jstype = 6 [default =
         * JS_NORMAL];</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setJstype($var) {}

        public function hasJstype() {}

        /**
         * Should this field be parsed lazily?  Lazy applies only to message-type
         * fields.  It means that when the outer message is initially parsed, the
         * inner message's contents will not be parsed but instead stored in encoded
         * form.  The inner message will actually be parsed when it is first accessed.
         * This is only a hint.  Implementations are free to choose whether to use
         * eager or lazy parsing regardless of the value of this option.  However,
         * setting this option true suggests that the protocol author believes that
         * using lazy parsing on this field is worth the additional bookkeeping
         * overhead typically needed to implement it.
         * This option does not affect the public interface of any generated code;
         * all method signatures remain the same.  Furthermore, thread-safety of the
         * interface is not affected by this option; const methods remain safe to
         * call from multiple threads concurrently, while non-const methods continue
         * to require exclusive access.
         * Note that implementations may choose not to check required fields within
         * a lazy sub-message.  That is, calling IsInitialized() on the outer message
         * may return true even if the inner message has missing required fields.
         * This is necessary because otherwise the inner message would have to be
         * parsed in order to perform the check, defeating the purpose of lazy
         * parsing.  An implementation which chooses not to check required fields
         * must be consistent about it.  That is, for any particular sub-message, the
         * implementation must either *always* check its required fields, or *never*
         * check its required fields, regardless of whether or not the message has
         * been parsed.
         *
         * Generated from protobuf field <code>optional bool lazy = 5 [default = false];</code>
         * @return bool
         */
        public function getLazy() {}

        /**
         * Should this field be parsed lazily?  Lazy applies only to message-type
         * fields.  It means that when the outer message is initially parsed, the
         * inner message's contents will not be parsed but instead stored in encoded
         * form.  The inner message will actually be parsed when it is first accessed.
         * This is only a hint.  Implementations are free to choose whether to use
         * eager or lazy parsing regardless of the value of this option.  However,
         * setting this option true suggests that the protocol author believes that
         * using lazy parsing on this field is worth the additional bookkeeping
         * overhead typically needed to implement it.
         * This option does not affect the public interface of any generated code;
         * all method signatures remain the same.  Furthermore, thread-safety of the
         * interface is not affected by this option; const methods remain safe to
         * call from multiple threads concurrently, while non-const methods continue
         * to require exclusive access.
         * Note that implementations may choose not to check required fields within
         * a lazy sub-message.  That is, calling IsInitialized() on the outer message
         * may return true even if the inner message has missing required fields.
         * This is necessary because otherwise the inner message would have to be
         * parsed in order to perform the check, defeating the purpose of lazy
         * parsing.  An implementation which chooses not to check required fields
         * must be consistent about it.  That is, for any particular sub-message, the
         * implementation must either *always* check its required fields, or *never*
         * check its required fields, regardless of whether or not the message has
         * been parsed.
         *
         * Generated from protobuf field <code>optional bool lazy = 5 [default = false];</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setLazy($var) {}

        public function hasLazy() {}

        /**
         * Is this field deprecated?
         * Depending on the target platform, this can emit Deprecated annotations
         * for accessors, or it will be completely ignored; in the very least, this
         * is a formalization for deprecating fields.
         *
         * Generated from protobuf field <code>optional bool deprecated = 3 [default = false];</code>
         * @return bool
         */
        public function getDeprecated() {}

        /**
         * Is this field deprecated?
         * Depending on the target platform, this can emit Deprecated annotations
         * for accessors, or it will be completely ignored; in the very least, this
         * is a formalization for deprecating fields.
         *
         * Generated from protobuf field <code>optional bool deprecated = 3 [default = false];</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setDeprecated($var) {}

        public function hasDeprecated() {}

        /**
         * For Google-internal migration only. Do not use.
         *
         * Generated from protobuf field <code>optional bool weak = 10 [default = false];</code>
         * @return bool
         */
        public function getWeak() {}

        /**
         * For Google-internal migration only. Do not use.
         *
         * Generated from protobuf field <code>optional bool weak = 10 [default = false];</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setWeak($var) {}

        public function hasWeak() {}

        /**
         * The parser stores options it doesn't recognize here. See above.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.UninterpretedOption uninterpreted_option =
         * 999;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getUninterpretedOption() {}

        /**
         * The parser stores options it doesn't recognize here. See above.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.UninterpretedOption uninterpreted_option =
         * 999;</code>
         *
         * @param \Google\Protobuf\Internal\UninterpretedOption[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setUninterpretedOption($var) {}

        public function hasUninterpretedOption() {}

    }

    class DescriptorPool
    {
        public static function getGeneratedPool() {}

        public function internalAddGeneratedFile($data) {}

        public function addMessage($name, $klass) {}

        public function addEnum($name, $klass) {}

        public function addDescriptor($descriptor) {}

        public function addEnumDescriptor($descriptor) {}

        public function getDescriptorByClassName($klass) {}

        public function getEnumDescriptorByClassName($klass) {}

        public function getDescriptorByProtoName($proto) {}

        public function getEnumDescriptorByProtoName($proto) {}

        public function finish() {}
    }

    /**
     * Protobuf enum <code>Google\Protobuf\Internal</code>
     */
    class FieldOptions_CType
    {
        /**
         * Default mode.
         *
         * Generated from protobuf enum <code>STRING = 0;</code>
         */
        const STRING = 0;

        /**
         * Generated from protobuf enum <code>CORD = 1;</code>
         */
        const CORD = 1;

        /**
         * Generated from protobuf enum <code>STRING_PIECE = 2;</code>
         */
        const STRING_PIECE = 2;
    }

    /**
     * The name of the uninterpreted option.  Each string represents a segment in
     * a dot-separated name.  is_extension is true iff a segment represents an
     * extension (denoted with parentheses in options specs in .proto files).
     * E.g.,{ ["foo", false], ["bar.baz", true], ["qux", false] } represents
     * "foo.(bar.baz).qux".
     *
     * Generated from protobuf message <code>google.protobuf.UninterpretedOption.NamePart</code>
     */
    class UninterpretedOption_NamePart extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * Generated from protobuf field <code>required string name_part = 1;</code>
         * @return string
         */
        public function getNamePart() {}

        /**
         * Generated from protobuf field <code>required string name_part = 1;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setNamePart($var) {}

        public function hasNamePart() {}

        /**
         * Generated from protobuf field <code>required bool is_extension = 2;</code>
         * @return bool
         */
        public function getIsExtension() {}

        /**
         * Generated from protobuf field <code>required bool is_extension = 2;</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setIsExtension($var) {}

        public function hasIsExtension() {}

    }

    class EnumBuilderContext
    {
        public function __construct($full_name, $klass, $pool) {}

        public function value($name, $number) {}

        public function finalizeToPool() {}
    }

    class MapEntry extends Message
    {
        public $key;
        public $value;

        public function setKey($key) {}

        public function getKey() {}

        public function setValue($value) {}

        public function getValue() {}
    }

    function camel2underscore($input)
    {
    }

    class GPBUtil
    {
        const NANOS_PER_MILLISECOND = 1000000;
        const NANOS_PER_MICROSECOND = 1000;
        const TYPE_URL_PREFIX = 'type.googleapis.com/';

        public static function divideInt64ToInt32($value, &$high, &$low, $trim = false) {}

        public static function checkString(&$var, $check_utf8) {}

        public static function checkEnum(&$var) {}

        public static function checkInt32(&$var) {}

        public static function checkUint32(&$var) {}

        public static function checkInt64(&$var) {}

        public static function checkUint64(&$var) {}

        public static function checkFloat(&$var) {}

        public static function checkDouble(&$var) {}

        public static function checkBool(&$var) {}

        public static function checkMessage(&$var, $klass) {}

        public static function checkRepeatedField(&$var, $type, $klass = null) {}

        public static function checkMapField(&$var, $key_type, $value_type, $klass = null) {}

        public static function Int64($value) {}

        public static function Uint64($value) {}

        public static function getClassNamePrefix($classname, $file_proto) {}

        public static function getClassNameWithoutPackage($name, $file_proto) {}

        public static function getFullClassName($proto, $containing, $file_proto, &$message_name_without_package, &$classname, &$fullname) {}

        public static function combineInt32ToInt64($high, $low) {}

        public static function parseTimestamp($timestamp) {}

        public static function formatTimestamp($value) {}

        public static function parseDuration($value) {}

        public static function formatDuration($value) {}


        public static function parseFieldMask($paths_string) {}

        public static function formatFieldMask($field_mask) {}

        public static function getNanosecondsForTimestamp($nanoseconds) {}

        public static function hasSpecialJsonMapping($msg) {}

        public static function hasJsonValue($msg) {}
    }

    class GPBDecodeException extends \Exception
    {
        public function __construct($message, $code = 0, \Exception $previous = null) {}
    }

    class GPBWire
    {

        const TAG_TYPE_BITS = 3;

        const WIRETYPE_VARINT = 0;
        const WIRETYPE_FIXED64 = 1;
        const WIRETYPE_LENGTH_DELIMITED = 2;
        const WIRETYPE_START_GROUP = 3;
        const WIRETYPE_END_GROUP = 4;
        const WIRETYPE_FIXED32 = 5;

        const UNKNOWN = 0;
        const NORMAL_FORMAT = 1;
        const PACKED_FORMAT = 2;

        public static function getTagFieldNumber($tag) {}

        public static function getTagWireType($tag) {}

        public static function getWireType($type) {}

        // ZigZag Transform:  Encodes signed integers so that they can be effectively
        // used with varint encoding.
        //
        // varint operates on unsigned integers, encoding smaller numbers into fewer
        // bytes.  If you try to use it on a signed integer, it will treat this
        // number as a very large unsigned integer, which means that even small
        // signed numbers like -1 will take the maximum number of bytes (10) to
        // encode.  zigZagEncode() maps signed integers to unsigned in such a way
        // that those with a small absolute value will have smaller encoded values,
        // making them appropriate for encoding using varint.
        //
        // int32 ->     uint32
        // -------------------------
        //           0 ->          0
        //          -1 ->          1
        //           1 ->          2
        //          -2 ->          3
        //         ... ->        ...
        //  2147483647 -> 4294967294
        // -2147483648 -> 4294967295
        //
        //        >> encode >>
        //        << decode <<
        public static function zigZagEncode32($int32) {}

        public static function zigZagDecode32($uint32) {}

        public static function zigZagEncode64($int64) {}

        public static function zigZagDecode64($uint64) {}

        public static function readInt32(&$input, &$value) {}

        public static function readInt64(&$input, &$value) {}

        public static function readUint32(&$input, &$value) {}

        public static function readUint64(&$input, &$value) {}

        public static function readSint32(&$input, &$value) {}

        public static function readSint64(&$input, &$value) {}

        public static function readFixed32(&$input, &$value) {}

        public static function readFixed64(&$input, &$value) {}

        public static function readSfixed32(&$input, &$value) {}

        public static function readSfixed64(&$input, &$value) {}

        public static function readFloat(&$input, &$value) {}

        public static function readDouble(&$input, &$value) {}

        public static function readBool(&$input, &$value) {}

        public static function readString(&$input, &$value) {}

        public static function readMessage(&$input, &$message) {}

        public static function writeTag(&$output, $tag) {}

        public static function writeInt32(&$output, $value) {}

        public static function writeInt64(&$output, $value) {}

        public static function writeUint32(&$output, $value) {}

        public static function writeUint64(&$output, $value) {}

        public static function writeSint32(&$output, $value) {}

        public static function writeSint64(&$output, $value) {}

        public static function writeFixed32(&$output, $value) {}

        public static function writeFixed64(&$output, $value) {}

        public static function writeSfixed32(&$output, $value) {}

        public static function writeSfixed64(&$output, $value) {}

        public static function writeBool(&$output, $value) {}

        public static function writeFloat(&$output, $value) {}

        public static function writeDouble(&$output, $value) {}

        public static function writeString(&$output, $value) {}

        public static function writeBytes(&$output, $value) {}

        public static function writeMessage(&$output, $value) {}

        public static function makeTag($number, $type) {}

        public static function tagSize($field) {}

        public static function varint32Size($value, $sign_extended = false) {}

        public static function sint32Size($value) {}

        public static function sint64Size($value) {}

        public static function varint64Size($value) {}

        public static function serializeFieldToStream($value, $field, $need_tag, &$output) {}
    }

    /**
     * Generated from protobuf message <code>google.protobuf.SourceCodeInfo.Location</code>
     */
    class SourceCodeInfo_Location extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * Identifies which part of the FileDescriptorProto was defined at this
         * location.
         * Each element is a field number or an index.  They form a path from
         * the root FileDescriptorProto to the place where the definition.  For
         * example, this path:
         *   [ 4, 3, 2, 7, 1 ]
         * refers to:
         *   file.message_type(3)  // 4, 3
         *       .field(7)         // 2, 7
         *       .name()           // 1
         * This is because FileDescriptorProto.message_type has field number 4:
         *   repeated DescriptorProto message_type = 4;
         * and DescriptorProto.field has field number 2:
         *   repeated FieldDescriptorProto field = 2;
         * and FieldDescriptorProto.name has field number 1:
         *   optional string name = 1;
         * Thus, the above path gives the location of a field name.  If we removed
         * the last element:
         *   [ 4, 3, 2, 7 ]
         * this path refers to the whole field declaration (from the beginning
         * of the label to the terminating semicolon).
         *
         * Generated from protobuf field <code>repeated int32 path = 1 [packed = true];</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getPath() {}

        /**
         * Identifies which part of the FileDescriptorProto was defined at this
         * location.
         * Each element is a field number or an index.  They form a path from
         * the root FileDescriptorProto to the place where the definition.  For
         * example, this path:
         *   [ 4, 3, 2, 7, 1 ]
         * refers to:
         *   file.message_type(3)  // 4, 3
         *       .field(7)         // 2, 7
         *       .name()           // 1
         * This is because FileDescriptorProto.message_type has field number 4:
         *   repeated DescriptorProto message_type = 4;
         * and DescriptorProto.field has field number 2:
         *   repeated FieldDescriptorProto field = 2;
         * and FieldDescriptorProto.name has field number 1:
         *   optional string name = 1;
         * Thus, the above path gives the location of a field name.  If we removed
         * the last element:
         *   [ 4, 3, 2, 7 ]
         * this path refers to the whole field declaration (from the beginning
         * of the label to the terminating semicolon).
         *
         * Generated from protobuf field <code>repeated int32 path = 1 [packed = true];</code>
         *
         * @param int[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setPath($var) {}

        public function hasPath() {}

        /**
         * Always has exactly three or four elements: start line, start column,
         * end line (optional, otherwise assumed same as start line), end column.
         * These are packed into a single field for efficiency.  Note that line
         * and column numbers are zero-based -- typically you will want to add
         * 1 to each before displaying to a user.
         *
         * Generated from protobuf field <code>repeated int32 span = 2 [packed = true];</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getSpan() {}

        /**
         * Always has exactly three or four elements: start line, start column,
         * end line (optional, otherwise assumed same as start line), end column.
         * These are packed into a single field for efficiency.  Note that line
         * and column numbers are zero-based -- typically you will want to add
         * 1 to each before displaying to a user.
         *
         * Generated from protobuf field <code>repeated int32 span = 2 [packed = true];</code>
         *
         * @param int[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setSpan($var) {}

        public function hasSpan() {}

        /**
         * If this SourceCodeInfo represents a complete declaration, these are any
         * comments appearing before and after the declaration which appear to be
         * attached to the declaration.
         * A series of line comments appearing on consecutive lines, with no other
         * tokens appearing on those lines, will be treated as a single comment.
         * leading_detached_comments will keep paragraphs of comments that appear
         * before (but not connected to) the current element. Each paragraph,
         * separated by empty lines, will be one comment element in the repeated
         * field.
         * Only the comment content is provided; comment markers (e.g. //) are
         * stripped out.  For block comments, leading whitespace and an asterisk
         * will be stripped from the beginning of each line other than the first.
         * Newlines are included in the output.
         * Examples:
         *   optional int32 foo = 1;  // Comment attached to foo.
         *   // Comment attached to bar.
         *   optional int32 bar = 2;
         *   optional string baz = 3;
         *   // Comment attached to baz.
         *   // Another line attached to baz.
         *   // Comment attached to qux.
         *   //
         *   // Another line attached to qux.
         *   optional double qux = 4;
         *   // Detached comment for corge. This is not leading or trailing comments
         *   // to qux or corge because there are blank lines separating it from
         *   // both.
         *   // Detached comment for corge paragraph 2.
         *   optional string corge = 5;
         *   /&#42; Block comment attached
         *    * to corge.  Leading asterisks
         *    * will be removed. *&#47;
         *   /&#42; Block comment attached to
         *    * grault. *&#47;
         *   optional int32 grault = 6;
         *   // ignored detached comments.
         *
         * Generated from protobuf field <code>optional string leading_comments = 3;</code>
         * @return string
         */
        public function getLeadingComments() {}

        /**
         * If this SourceCodeInfo represents a complete declaration, these are any
         * comments appearing before and after the declaration which appear to be
         * attached to the declaration.
         * A series of line comments appearing on consecutive lines, with no other
         * tokens appearing on those lines, will be treated as a single comment.
         * leading_detached_comments will keep paragraphs of comments that appear
         * before (but not connected to) the current element. Each paragraph,
         * separated by empty lines, will be one comment element in the repeated
         * field.
         * Only the comment content is provided; comment markers (e.g. //) are
         * stripped out.  For block comments, leading whitespace and an asterisk
         * will be stripped from the beginning of each line other than the first.
         * Newlines are included in the output.
         * Examples:
         *   optional int32 foo = 1;  // Comment attached to foo.
         *   // Comment attached to bar.
         *   optional int32 bar = 2;
         *   optional string baz = 3;
         *   // Comment attached to baz.
         *   // Another line attached to baz.
         *   // Comment attached to qux.
         *   //
         *   // Another line attached to qux.
         *   optional double qux = 4;
         *   // Detached comment for corge. This is not leading or trailing comments
         *   // to qux or corge because there are blank lines separating it from
         *   // both.
         *   // Detached comment for corge paragraph 2.
         *   optional string corge = 5;
         *   /&#42; Block comment attached
         *    * to corge.  Leading asterisks
         *    * will be removed. *&#47;
         *   /&#42; Block comment attached to
         *    * grault. *&#47;
         *   optional int32 grault = 6;
         *   // ignored detached comments.
         *
         * Generated from protobuf field <code>optional string leading_comments = 3;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setLeadingComments($var) {}

        public function hasLeadingComments() {}

        /**
         * Generated from protobuf field <code>optional string trailing_comments = 4;</code>
         * @return string
         */
        public function getTrailingComments() {}

        /**
         * Generated from protobuf field <code>optional string trailing_comments = 4;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setTrailingComments($var) {}

        public function hasTrailingComments() {}

        /**
         * Generated from protobuf field <code>repeated string leading_detached_comments = 6;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getLeadingDetachedComments() {}

        /**
         * Generated from protobuf field <code>repeated string leading_detached_comments = 6;</code>
         *
         * @param string[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setLeadingDetachedComments($var) {}

        public function hasLeadingDetachedComments() {}

    }

    class Descriptor
    {
        use HasPublicDescriptorTrait;

        public function __construct() {}

        public function addOneofDecl($oneof) {}

        public function getOneofDecl() {}

        public function setFullName($full_name) {}

        public function getFullName() {}

        public function addField($field) {}

        public function getField() {}

        public function addNestedType($desc) {}

        public function getNestedType() {}

        public function addEnumType($desc) {}

        public function getEnumType() {}

        public function getFieldByNumber($number) {}

        public function getFieldByJsonName($json_name) {}

        public function getFieldByName($name) {}

        public function getFieldByIndex($index) {}

        public function setClass($klass) {}

        public function getClass() {}

        public function setOptions($options) {}

        public function getOptions() {}

        public static function buildFromProto($proto, $file_proto, $containing) {}
    }

    /**
     * Describes a message type.
     *
     * Generated from protobuf message <code>google.protobuf.DescriptorProto</code>
     */
    class DescriptorProto extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * Generated from protobuf field <code>optional string name = 1;</code>
         * @return string
         */
        public function getName() {}

        /**
         * Generated from protobuf field <code>optional string name = 1;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setName($var) {}

        public function hasName() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.FieldDescriptorProto field = 2;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getField() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.FieldDescriptorProto field = 2;</code>
         *
         * @param \Google\Protobuf\Internal\FieldDescriptorProto[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setField($var) {}

        public function hasField() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.FieldDescriptorProto extension = 6;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getExtension() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.FieldDescriptorProto extension = 6;</code>
         *
         * @param \Google\Protobuf\Internal\FieldDescriptorProto[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setExtension($var) {}

        public function hasExtension() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.DescriptorProto nested_type = 3;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getNestedType() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.DescriptorProto nested_type = 3;</code>
         *
         * @param \Google\Protobuf\Internal\DescriptorProto[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setNestedType($var) {}

        public function hasNestedType() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.EnumDescriptorProto enum_type = 4;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getEnumType() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.EnumDescriptorProto enum_type = 4;</code>
         *
         * @param \Google\Protobuf\Internal\EnumDescriptorProto[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setEnumType($var) {}

        public function hasEnumType() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.DescriptorProto.ExtensionRange extension_range
         * =
         * 5;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getExtensionRange() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.DescriptorProto.ExtensionRange extension_range
         * =
         * 5;</code>
         *
         * @param \Google\Protobuf\Internal\DescriptorProto_ExtensionRange[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setExtensionRange($var) {}

        public function hasExtensionRange() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.OneofDescriptorProto oneof_decl = 8;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getOneofDecl() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.OneofDescriptorProto oneof_decl = 8;</code>
         *
         * @param \Google\Protobuf\Internal\OneofDescriptorProto[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setOneofDecl($var) {}

        public function hasOneofDecl() {}

        /**
         * Generated from protobuf field <code>optional .google.protobuf.MessageOptions options = 7;</code>
         * @return \Google\Protobuf\Internal\MessageOptions
         */
        public function getOptions() {}

        /**
         * Generated from protobuf field <code>optional .google.protobuf.MessageOptions options = 7;</code>
         *
         * @param \Google\Protobuf\Internal\MessageOptions $var
         *
         * @return $this
         */
        public function setOptions($var) {}

        public function hasOptions() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.DescriptorProto.ReservedRange reserved_range =
         * 9;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getReservedRange() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.DescriptorProto.ReservedRange reserved_range =
         * 9;</code>
         *
         * @param \Google\Protobuf\Internal\DescriptorProto_ReservedRange[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setReservedRange($var) {}

        public function hasReservedRange() {}

        /**
         * Reserved field names, which may not be used by fields in the same message.
         * A given name may only be reserved once.
         *
         * Generated from protobuf field <code>repeated string reserved_name = 10;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getReservedName() {}

        /**
         * Reserved field names, which may not be used by fields in the same message.
         * A given name may only be reserved once.
         *
         * Generated from protobuf field <code>repeated string reserved_name = 10;</code>
         *
         * @param string[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setReservedName($var) {}

        public function hasReservedName() {}

    }

    /**
     * Generated classes can be optimized for speed or code size.
     *
     * Protobuf enum <code>Google\Protobuf\Internal</code>
     */
    class FileOptions_OptimizeMode
    {
        /**
         * Generate complete code for parsing, serialization,
         *
         * Generated from protobuf enum <code>SPEED = 1;</code>
         */
        const SPEED = 1;

        /**
         * etc.
         *
         * Generated from protobuf enum <code>CODE_SIZE = 2;</code>
         */
        const CODE_SIZE = 2;

        /**
         * Generate code using MessageLite and the lite runtime.
         *
         * Generated from protobuf enum <code>LITE_RUNTIME = 3;</code>
         */
        const LITE_RUNTIME = 3;
    }

    class FileDescriptor
    {
        public function setPackage($package) {}

        public function getPackage() {}

        public function getMessageType() {}

        public function addMessageType($desc) {}

        public function getEnumType() {}

        public function addEnumType($desc) {}

        public static function buildFromProto($proto) {}
    }


    /**
     * Encapsulates information about the original source file from which a
     * FileDescriptorProto was generated.
     *
     * Generated from protobuf message <code>google.protobuf.SourceCodeInfo</code>
     */
    class SourceCodeInfo extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * A Location identifies a piece of source code in a .proto file which
         * corresponds to a particular definition.  This information is intended
         * to be useful to IDEs, code indexers, documentation generators, and similar
         * tools.
         * For example, say we have a file like:
         *   message Foo {
         *     optional string foo = 1;
         *   }
         * Let's look at just the field definition:
         *   optional string foo = 1;
         *   ^       ^^     ^^  ^  ^^^
         *   a       bc     de  f  ghi
         * We have the following locations:
         *   span   path               represents
         *   [a,i)  [ 4, 0, 2, 0 ]     The whole field definition.
         *   [a,b)  [ 4, 0, 2, 0, 4 ]  The label (optional).
         *   [c,d)  [ 4, 0, 2, 0, 5 ]  The type (string).
         *   [e,f)  [ 4, 0, 2, 0, 1 ]  The name (foo).
         *   [g,h)  [ 4, 0, 2, 0, 3 ]  The number (1).
         * Notes:
         * - A location may refer to a repeated field itself (i.e. not to any
         *   particular index within it).  This is used whenever a set of elements are
         *   logically enclosed in a single code segment.  For example, an entire
         *   extend block (possibly containing multiple extension definitions) will
         *   have an outer location whose path refers to the "extensions" repeated
         *   field without an index.
         * - Multiple locations may have the same path.  This happens when a single
         *   logical declaration is spread out across multiple places.  The most
         *   obvious example is the "extend" block again -- there may be multiple
         *   extend blocks in the same scope, each of which will have the same path.
         * - A location's span is not always a subset of its parent's span.  For
         *   example, the "extendee" of an extension declaration appears at the
         *   beginning of the "extend" block and is shared by all extensions within
         *   the block.
         * - Just because a location's span is a subset of some other location's span
         *   does not mean that it is a descendent.  For example, a "group" defines
         *   both a type and a field in a single declaration.  Thus, the locations
         *   corresponding to the type and field and their components will overlap.
         * - Code which tries to interpret locations should probably be designed to
         *   ignore those that it doesn't understand, as more types of locations could
         *   be recorded in the future.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.SourceCodeInfo.Location location = 1;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getLocation() {}

        /**
         * A Location identifies a piece of source code in a .proto file which
         * corresponds to a particular definition.  This information is intended
         * to be useful to IDEs, code indexers, documentation generators, and similar
         * tools.
         * For example, say we have a file like:
         *   message Foo {
         *     optional string foo = 1;
         *   }
         * Let's look at just the field definition:
         *   optional string foo = 1;
         *   ^       ^^     ^^  ^  ^^^
         *   a       bc     de  f  ghi
         * We have the following locations:
         *   span   path               represents
         *   [a,i)  [ 4, 0, 2, 0 ]     The whole field definition.
         *   [a,b)  [ 4, 0, 2, 0, 4 ]  The label (optional).
         *   [c,d)  [ 4, 0, 2, 0, 5 ]  The type (string).
         *   [e,f)  [ 4, 0, 2, 0, 1 ]  The name (foo).
         *   [g,h)  [ 4, 0, 2, 0, 3 ]  The number (1).
         * Notes:
         * - A location may refer to a repeated field itself (i.e. not to any
         *   particular index within it).  This is used whenever a set of elements are
         *   logically enclosed in a single code segment.  For example, an entire
         *   extend block (possibly containing multiple extension definitions) will
         *   have an outer location whose path refers to the "extensions" repeated
         *   field without an index.
         * - Multiple locations may have the same path.  This happens when a single
         *   logical declaration is spread out across multiple places.  The most
         *   obvious example is the "extend" block again -- there may be multiple
         *   extend blocks in the same scope, each of which will have the same path.
         * - A location's span is not always a subset of its parent's span.  For
         *   example, the "extendee" of an extension declaration appears at the
         *   beginning of the "extend" block and is shared by all extensions within
         *   the block.
         * - Just because a location's span is a subset of some other location's span
         *   does not mean that it is a descendent.  For example, a "group" defines
         *   both a type and a field in a single declaration.  Thus, the locations
         *   corresponding to the type and field and their components will overlap.
         * - Code which tries to interpret locations should probably be designed to
         *   ignore those that it doesn't understand, as more types of locations could
         *   be recorded in the future.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.SourceCodeInfo.Location location = 1;</code>
         *
         * @param \Google\Protobuf\Internal\SourceCodeInfo_Location[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setLocation($var) {}

        public function hasLocation() {}

    }

    /**
     * Parent class of all proto messages. Users should not instantiate this class
     * or extend this class or its child classes by their own.  See the comment of
     * specific functions for more details.
     */
    class Message
    {
        /**
         * @ignore
         */
        public function __construct($desc = null) {}

        protected function readOneof($number) {}

        protected function writeOneof($number, $value) {}

        protected function whichOneof($oneof_name) {}

        /**
         * Clear all containing fields.
         * @return null.
         */
        public function clear() {}

        /**
         * Merges the contents of the specified message into current message.
         *
         * This method merges the contents of the specified message into the
         * current message. Singular fields that are set in the specified message
         * overwrite the corresponding fields in the current message.  Repeated
         * fields are appended. Map fields key-value pairs are overritten.
         * Singular/Oneof sub-messages are recursively merged. All overritten
         * sub-messages are deep-copied.
         *
         * @param object $msg Protobuf message to be merged from.
         *
         * @return null.
         */
        public function mergeFrom($msg) {}

        /**
         * Parses a protocol buffer contained in a string.
         *
         * This function takes a string in the (non-human-readable) binary wire
         * format, matching the encoding output by serializeToString().
         * See mergeFrom() for merging behavior, if the field is already set in the
         * specified message.
         *
         * @param string $data Binary protobuf data.
         *
         * @return null.
         * @throws \Exception Invalid data.
         */
        public function mergeFromString($data) {}

        /**
         * Parses a json string to protobuf message.
         *
         * This function takes a string in the json wire format, matching the
         * encoding output by serializeToJsonString().
         * See mergeFrom() for merging behavior, if the field is already set in the
         * specified message.
         *
         * @param string $data Json protobuf data.
         *
         * @return null.
         * @throws \Exception Invalid data.
         */
        public function mergeFromJsonString($data) {}

        /**
         * @ignore
         */
        public function parseFromStream($input) {}

        protected function mergeFromJsonArray($array) {}

        /**
         * @ignore
         */
        public function parseFromJsonStream($input) {}

        /**
         * @ignore
         */
        public function serializeToStream(&$output) {}

        /**
         * @ignore
         */
        public function serializeToJsonStream(&$output) {}

        /**
         * Serialize the message to string.
         * @return string Serialized binary protobuf data.
         */
        public function serializeToString() {}

        /**
         * Serialize the message to json string.
         * @return string Serialized json protobuf data.
         */
        public function serializeToJsonString() {}

        /**
         * @ignore
         */
        public function byteSize() {}

        /**
         * @ignore
         */
        public function jsonByteSize() {}
    }

    /**
     * Is this method side-effect-free (or safe in HTTP parlance), or idempotent,
     * or neither? HTTP based RPC implementation may choose GET verb for safe
     * methods, and PUT verb for idempotent methods instead of the default POST.
     *
     * Protobuf enum <code>Google\Protobuf\Internal</code>
     */
    class MethodOptions_IdempotencyLevel
    {
        /**
         * Generated from protobuf enum <code>IDEMPOTENCY_UNKNOWN = 0;</code>
         */
        const IDEMPOTENCY_UNKNOWN = 0;

        /**
         * implies idempotent
         *
         * Generated from protobuf enum <code>NO_SIDE_EFFECTS = 1;</code>
         */
        const NO_SIDE_EFFECTS = 1;

        /**
         * idempotent, but may have side effects
         *
         * Generated from protobuf enum <code>IDEMPOTENT = 2;</code>
         */
        const IDEMPOTENT = 2;
    }

    /**
     * Generated from protobuf message <code>google.protobuf.MethodOptions</code>
     */
    class MethodOptions extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * Is this method deprecated?
         * Depending on the target platform, this can emit Deprecated annotations
         * for the method, or it will be completely ignored; in the very least,
         * this is a formalization for deprecating methods.
         *
         * Generated from protobuf field <code>optional bool deprecated = 33 [default = false];</code>
         * @return bool
         */
        public function getDeprecated() {}

        /**
         * Is this method deprecated?
         * Depending on the target platform, this can emit Deprecated annotations
         * for the method, or it will be completely ignored; in the very least,
         * this is a formalization for deprecating methods.
         *
         * Generated from protobuf field <code>optional bool deprecated = 33 [default = false];</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setDeprecated($var) {}

        public function hasDeprecated() {}

        /**
         * Generated from protobuf field <code>optional .google.protobuf.MethodOptions.IdempotencyLevel
         * idempotency_level =
         * 34 [default = IDEMPOTENCY_UNKNOWN];</code>
         * @return int
         */
        public function getIdempotencyLevel() {}

        /**
         * Generated from protobuf field <code>optional .google.protobuf.MethodOptions.IdempotencyLevel
         * idempotency_level =
         * 34 [default = IDEMPOTENCY_UNKNOWN];</code>
         *
         * @param int $var
         *
         * @return $this
         */
        public function setIdempotencyLevel($var) {}

        public function hasIdempotencyLevel() {}

        /**
         * The parser stores options it doesn't recognize here. See above.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.UninterpretedOption uninterpreted_option =
         * 999;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getUninterpretedOption() {}

        /**
         * The parser stores options it doesn't recognize here. See above.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.UninterpretedOption uninterpreted_option =
         * 999;</code>
         *
         * @param \Google\Protobuf\Internal\UninterpretedOption[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setUninterpretedOption($var) {}

        public function hasUninterpretedOption() {}

    }

    /**
     * Describes a method of a service.
     *
     * Generated from protobuf message <code>google.protobuf.MethodDescriptorProto</code>
     */
    class MethodDescriptorProto extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * Generated from protobuf field <code>optional string name = 1;</code>
         * @return string
         */
        public function getName() {}

        /**
         * Generated from protobuf field <code>optional string name = 1;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setName($var) {}

        public function hasName() {}

        /**
         * Input and output type names.  These are resolved in the same way as
         * FieldDescriptorProto.type_name, but must refer to a message type.
         *
         * Generated from protobuf field <code>optional string input_type = 2;</code>
         * @return string
         */
        public function getInputType() {}

        /**
         * Input and output type names.  These are resolved in the same way as
         * FieldDescriptorProto.type_name, but must refer to a message type.
         *
         * Generated from protobuf field <code>optional string input_type = 2;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setInputType($var) {}

        public function hasInputType() {}

        /**
         * Generated from protobuf field <code>optional string output_type = 3;</code>
         * @return string
         */
        public function getOutputType() {}

        /**
         * Generated from protobuf field <code>optional string output_type = 3;</code>
         *
         * @param string $var
         *
         * @return $this
         */
        public function setOutputType($var) {}

        public function hasOutputType() {}

        /**
         * Generated from protobuf field <code>optional .google.protobuf.MethodOptions options = 4;</code>
         * @return \Google\Protobuf\Internal\MethodOptions
         */
        public function getOptions() {}

        /**
         * Generated from protobuf field <code>optional .google.protobuf.MethodOptions options = 4;</code>
         *
         * @param \Google\Protobuf\Internal\MethodOptions $var
         *
         * @return $this
         */
        public function setOptions($var) {}

        public function hasOptions() {}

        /**
         * Identifies if client streams multiple client messages
         *
         * Generated from protobuf field <code>optional bool client_streaming = 5 [default = false];</code>
         * @return bool
         */
        public function getClientStreaming() {}

        /**
         * Identifies if client streams multiple client messages
         *
         * Generated from protobuf field <code>optional bool client_streaming = 5 [default = false];</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setClientStreaming($var) {}

        public function hasClientStreaming() {}

        /**
         * Identifies if server streams multiple server messages
         *
         * Generated from protobuf field <code>optional bool server_streaming = 6 [default = false];</code>
         * @return bool
         */
        public function getServerStreaming() {}

        /**
         * Identifies if server streams multiple server messages
         *
         * Generated from protobuf field <code>optional bool server_streaming = 6 [default = false];</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setServerStreaming($var) {}

        public function hasServerStreaming() {}

    }

    /**
     * Generated from protobuf message <code>google.protobuf.EnumOptions</code>
     */
    class EnumOptions extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * Set this option to true to allow mapping different tag names to the same
         * value.
         *
         * Generated from protobuf field <code>optional bool allow_alias = 2;</code>
         * @return bool
         */
        public function getAllowAlias() {}

        /**
         * Set this option to true to allow mapping different tag names to the same
         * value.
         *
         * Generated from protobuf field <code>optional bool allow_alias = 2;</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setAllowAlias($var) {}

        public function hasAllowAlias() {}

        /**
         * Is this enum deprecated?
         * Depending on the target platform, this can emit Deprecated annotations
         * for the enum, or it will be completely ignored; in the very least, this
         * is a formalization for deprecating enums.
         *
         * Generated from protobuf field <code>optional bool deprecated = 3 [default = false];</code>
         * @return bool
         */
        public function getDeprecated() {}

        /**
         * Is this enum deprecated?
         * Depending on the target platform, this can emit Deprecated annotations
         * for the enum, or it will be completely ignored; in the very least, this
         * is a formalization for deprecating enums.
         *
         * Generated from protobuf field <code>optional bool deprecated = 3 [default = false];</code>
         *
         * @param bool $var
         *
         * @return $this
         */
        public function setDeprecated($var) {}

        public function hasDeprecated() {}

        /**
         * The parser stores options it doesn't recognize here. See above.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.UninterpretedOption uninterpreted_option =
         * 999;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getUninterpretedOption() {}

        /**
         * The parser stores options it doesn't recognize here. See above.
         *
         * Generated from protobuf field <code>repeated .google.protobuf.UninterpretedOption uninterpreted_option =
         * 999;</code>
         *
         * @param \Google\Protobuf\Internal\UninterpretedOption[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setUninterpretedOption($var) {}

        public function hasUninterpretedOption() {}

    }

    /**
     * The protocol compiler can output a FileDescriptorSet containing the .proto
     * files it parses.
     *
     * Generated from protobuf message <code>google.protobuf.FileDescriptorSet</code>
     */
    class FileDescriptorSet extends \Google\Protobuf\Internal\Message
    {
        public function __construct() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.FileDescriptorProto file = 1;</code>
         * @return \Google\Protobuf\Internal\RepeatedField
         */
        public function getFile() {}

        /**
         * Generated from protobuf field <code>repeated .google.protobuf.FileDescriptorProto file = 1;</code>
         *
         * @param \Google\Protobuf\Internal\FileDescriptorProto[]|\Google\Protobuf\Internal\RepeatedField $var
         *
         * @return $this
         */
        public function setFile($var) {}

        public function hasFile() {}

    }
}

namespace GPBMetadata\Google\Protobuf {

    class Timestamp
    {
        public static $is_initialized = false;

        public static function initOnce() {}
    }

    class Type
    {
        public static $is_initialized = false;

        public static function initOnce() {}
    }

    class Any
    {
        public static $is_initialized = false;

        public static function initOnce() {}
    }

    class GPBEmpty
    {
        public static $is_initialized = false;

        public static function initOnce() {}
    }

    class FieldMask
    {
        public static $is_initialized = false;

        public static function initOnce() {}
    }

    class SourceContext
    {
        public static $is_initialized = false;

        public static function initOnce() {}
    }

    class Api
    {
        public static $is_initialized = false;

        public static function initOnce() {}
    }

    class Wrappers
    {
        public static $is_initialized = false;

        public static function initOnce() {}
    }

    class Struct
    {
        public static $is_initialized = false;

        public static function initOnce() {}
    }

    class Duration
    {
        public static $is_initialized = false;

        public static function initOnce() {}
    }
}

namespace GPBMetadata\Google\Protobuf\Internal {

    class Descriptor
    {
        public static $is_initialized = false;

        public static function initOnce() {}
    }
}