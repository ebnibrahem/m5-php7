<?php

namespace M5\MVC;

/**
 * Every thing that shared with all Application Controller
 *
 */
class Shared
{


	public function __construct()
	{

		/* List of things thats nedd in every view */
		$this->boot();
	}

	/**
	 * Shared data between Views.
	 *
	 * @return mixed
	 */
	private function boot()
	{
	}
}
