<?php
class puzzles_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 

    public function start_puzzle(){
    	$puzzle = new Puzzle(0);
    	$puzzle->load_puzzle();
		$output = View::instance('v_puzzles_puzzle');    	
    	$output->puzzle_cells = $puzzle->generate_puzzle_html();
    	echo $output;
    }


} # end of the class