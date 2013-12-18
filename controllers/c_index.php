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
		
		if ($this->user) {
			Router::redirect("/users/dashboard");
		}
		
		$output = $this->template;
		$output->contentRight = View::instance('v_index_index') ;
		$output->contentRight->message = $message;
		$output->contentLeft = View::instance('v_users_login') ;
		
		if (!$this->user) {
			$output->banner_right = View::instance('v_users_login') ;
		}

		//TODO: add redirect

		# Now set the <title> tag
		$output->title = "jDoku";
	      					     		
		# Render the view
		echo $output;

	} # End of method	
} # End of class
