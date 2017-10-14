<?php 

namespace Phalcon\Queue {

	/**
	 * Phalcon\Queue\Beanstalk
	 *
	 * Class to access the beanstalk queue service.
	 * Partially implements the protocol version 1.2
	 *
	 * <code>
	 * use Phalcon\Queue\Beanstalk;
	 *
	 * $queue = new Beanstalk(
	 *     [
	 *         "host"       => "127.0.0.1",
	 *         "port"       => 11300,
	 *         "persistent" => true,
	 *     ]
	 * );
	 * </code>
	 *
	 * @link http://www.igvita.com/2010/05/20/scalable-work-queues-with-beanstalk/
	 */
	
	class Beanstalk {

		const DEFAULT_DELAY = 0;

		const DEFAULT_PRIORITY = 100;

		const DEFAULT_TTR = 86400;

		const DEFAULT_TUBE = default;

		const DEFAULT_HOST = 127.0.0.1;

		const DEFAULT_PORT = 11300;

		protected $_connection;

		protected $_parameters;

		/**
		 * \Phalcon\Queue\Beanstalk
		 */
		public function __construct($parameters=null){ }


		/**
		 * Makes a connection to the Beanstalkd server
		 */
		public function connect(){ }


		/**
		 * Puts a job on the queue using specified tube.
		 */
		public function put($data, $options=null){ }


		/**
		 * Reserves/locks a ready job from the specified tube.
		 */
		public function reserve($timeout=null){ }


		/**
		 * Change the active tube. By default the tube is "default".
		 */
		public function choose($tube){ }


		/**
		 * The watch command adds the named tube to the watch list for the current connection.
		 */
		public function watch($tube){ }


		/**
		 * It removes the named tube from the watch list for the current connection.
		 */
		public function ignore($tube){ }


		/**
		 * Can delay any new job being reserved for a given time.
		 */
		public function pauseTube($tube, $delay){ }


		/**
		 * The kick command applies only to the currently used tube.
		 */
		public function kick($bound){ }


		/**
		 * Gives statistical information about the system as a whole.
		 */
		public function stats(){ }


		/**
		 * Gives statistical information about the specified tube if it exists.
		 */
		public function statsTube($tube){ }


		/**
		 * Returns a list of all existing tubes.
		 */
		public function listTubes(){ }


		/**
		 * Returns the tube currently being used by the client.
		 */
		public function listTubeUsed(){ }


		/**
		 * Returns a list tubes currently being watched by the client.
		 */
		public function listTubesWatched(){ }


		/**
		 * Inspect the next ready job.
		 */
		public function peekReady(){ }


		/**
		 * Return the next job in the list of buried jobs.
		 */
		public function peekBuried(){ }


		/**
		 * Return the next job in the list of buried jobs.
		 */
		public function peekDelayed(){ }


		/**
		 * The peek commands let the client inspect a job in the system.
		 */
		public function jobPeek($id){ }


		/**
		 * Reads the latest status from the Beanstalkd server
		 */
		final public function readStatus(){ }


		/**
		 * Fetch a YAML payload from the Beanstalkd server
		 */
		final public function readYaml(){ }


		/**
		 * Reads a packet from the socket. Prior to reading from the socket will
		 * check for availability of the connection.
		 */
		public function read($length=null){ }


		/**
		 * Writes data to the socket. Performs a connection if none is available
		 */
		public function write($data){ }


		/**
		 * Closes the connection to the beanstalk server.
		 */
		public function disconnect(){ }


		/**
		 * Simply closes the connection.
		 */
		public function quit(){ }

	}
}
