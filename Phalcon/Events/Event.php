<?php 

namespace Phalcon\Events {

	/**
	 * Phalcon\Events\Event
	 *
	 * This class offers contextual information of a fired event in the EventsManager
	 */
	
	class Event implements \Phalcon\Events\EventInterface {

		protected $_type;

		protected $_source;

		protected $_data;

		protected $_stopped;

		protected $_cancelable;

		/**
		 * Event type
		 */
		public function getType(){ }


		/**
		 * Event source
		 */
		public function getSource(){ }


		/**
		 * Event data
		 */
		public function getData(){ }


		/**
		 * \Phalcon\Events\Event constructor
		 *
		 * @param string type
		 * @param object source
		 * @param mixed data
		 * @param boolean cancelable
		 */
		public function __construct($type, $source, $data=null, $cancelable=null){ }


		/**
		 * Sets event data.
		 * @param mixed data
		 */
		public function setData($data=null){ }


		/**
		 * Sets event type.
		 */
		public function setType($type){ }


		/**
		 * Stops the event preventing propagation.
		 *
		 * <code>
		 * if ($event->isCancelable()) {
		 *     $event->stop();
		 * }
		 * </code>
		 */
		public function stop(){ }


		/**
		 * Check whether the event is currently stopped.
		 */
		public function isStopped(){ }


		/**
		 * Check whether the event is cancelable.
		 *
		 * <code>
		 * if ($event->isCancelable()) {
		 *     $event->stop();
		 * }
		 * </code>
		 */
		public function isCancelable(){ }

	}
}
