<?php
class puzzles_controller extends base_controller {

    public $puzzle;

    public function __construct() {
        parent::__construct();
        $this->puzzle = new Puzzle($this->user);
    } 

    public function start_puzzle($difficulty = 0){
        if ($this->user) {
            $this->puzzle->create_game($difficulty);
        }
        else {
            $this->puzzle->load_puzzle($difficulty);
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

        echo '<p class="success">Your progress has been saved.';
    }

    public function load_game($game_token){
        $this->puzzle->load_game($game_token);
        $output = View::instance('v_puzzles_puzzle');       
        $output->puzzle_cells = $this->puzzle->load_puzzle_html();
        $output->time = $this->puzzle->time;
        echo $output;
    }

    public function check_answers(){
         $this->puzzle->check_answers($_POST['answers'], $_COOKIE['game_token']);
    }

    public function get_time() {
        if ($_COOKIE['game_token']) {
            $q = "SELECT time FROM games WHERE game_token='" . $_COOKIE['game_token'] . "'";
            echo DB::instance(DB_NAME)->select_field($q); 
        }
    }


} # end of the class