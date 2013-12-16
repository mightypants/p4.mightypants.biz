<?php
class puzzles_controller extends base_controller {

    public $puzzle;

    public function __construct() {
        parent::__construct();
        $this->puzzle = new Puzzle(0, $this->user);
    } 

    public function start_puzzle(){
        if ($this->user) {
            $this->puzzle->create_game();
        }
        else {
            $this->puzzle->load_puzzle();
        }

		$output = View::instance('v_puzzles_puzzle');    	
    	$output->puzzle_cells = $this->puzzle->generate_puzzle_html();
    	echo $output;
    }

    public function save_game(){
        $time = $_POST['time'];
        $answers = $_POST['answers'];
        $complete = $_POST['complete'];

        $game_token = $_COOKIE['game_token'];

        $this->puzzle->save_game($time, $answers, $complete, $game_token);
    }

    public function check_answers(){
         $this->puzzle->check_answers($_POST['answers'], $_COOKIE['game_token']);
    }


} # end of the class