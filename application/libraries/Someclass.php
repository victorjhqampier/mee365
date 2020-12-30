<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Someclass {
	protected $ci;
        function __construct()
		{
			$this->ci =& get_instance();
		}
        public function some_method()
        {
        	echo "dessme";
        }
}