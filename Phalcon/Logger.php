<?php 

namespace Phalcon {

	abstract class Logger {

		const SPECIAL = 9;

		const CUSTOM = 8;

		const DEBUG = 7;

		const INFO = 6;

		const NOTICE = 5;

		const WARNING = 4;

		const ERROR = 3;

		const ALERT = 2;

		const CRITICAL = 1;

		const EMERGENCE = 0;

		const EMERGENCY = 0;
	}
}
