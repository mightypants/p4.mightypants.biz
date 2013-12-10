<?php

class index_controller extends base_controller {
	
	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();
	} 
		
	/*-------------------------------------------------------------------------------------------------
	Accessed via http://localhost/index/index/
	-------------------------------------------------------------------------------------------------*/
	public function index($message = NULL) {
		
		$output = $this->template;
		$output->contentRight = View::instance('v_index_index') . View::instance('v_users_login');
		$output->contentLeft = View::instance('v_users_stats');
			
		# Now set the <title> tag
		$output->title = "jDoku";
	      					     		
		# Render the view
		echo $output;

	} # End of method	
} # End of class
