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
		
		# Any method that loads a view will commonly start with this
		# First, set the content of the template with a view file
			$this->template->contentRight = View::instance('v_index_index');
			$this->template->contentRight = $this->template->contentRight . View::instance('v_users_login');
			$this->template->contentLeft = View::instance('v_users_stats');
			
		# Now set the <title> tag
			$this->template->title = "jDoku";
	      					     		
		# Render the view
			echo $this->template;

	} # End of method


	
	
} # End of class
