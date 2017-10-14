<?php 

namespace Phalcon\Events {

	interface EventsAwareInterface {

		public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager);


		public function getEventsManager();

	}
}
