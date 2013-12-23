<?php
class Puzzle {

    private $difficulty;
    private $solution;
    private $hint;
    private $user;
    private $puzzle_id;
    private $user_answers;
    private $time;


    public function __construct($user = NULL) {
        $this->__set('user', $user);
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }

        return $this;
    } 

    //loads data for a single puzzle from the database
    public function load_puzzle($difficulty){
        $q = 'SELECT * FROM puzzles where difficulty=' . $difficulty;
        $puzzle_info = DB::instance(DB_NAME)->select_rows($q); 
        $puzzle_num = rand(0, count($puzzle_info) - 1) ;

        $this->__set('puzzle_id',$puzzle_info[$puzzle_num]['puzzle_id']);
        $this->__set('hint',str_split($puzzle_info[$puzzle_num]['hint']));
        $this->__set('solution',str_split($puzzle_info[$puzzle_num]['solution']));

    }

    //creates divs and their values to be writting to the puzzle area
    public function generate_puzzle_html(){
        $cellHTML = '';

        for ($i = 0; $i < count($this->hint); $i++) {
            
            $cellClass = 'cell';
            $cellValue = '';
            

            if ( ($i > 17 && $i < 27) || ($i > 44 && $i < 54) ) {
                $cellClass = $cellClass . ' botThick';
            }

            if ( ($i % 9 == 2) || ($i % 9 == 5) ) {
                $cellClass = $cellClass . ' rightThick';
            } 

            if ($this->hint[$i] != 0) {
                $cellClass = $cellClass . ' hintCell';
                $cellValue = $this->hint[$i];
            }
            else {
                $cellClass = $cellClass . ' userCell';
            }

            $cellHTML .= '<div id=cell' . $i . ' class="' . $cellClass . '">' . $cellValue . '</div>'; 

        }
        return $cellHTML;
    }

    //a game is an instance of a puzzle being solved by a user
    public function create_game($difficulty){
        $this->load_puzzle($difficulty);

        $unique_token = false;
        $game_token;

        while (!$unique_token) {
            $rand_str = Utils::generate_random_string();
            $token_exists = DB::instance(DB_NAME)->select_field("SELECT game_token FROM games WHERE game_token = '" . $rand_str . "'");

            if (!$token_exists) {
                $unique_token = true;
                $game_token = $rand_str;
            }
        }  

        $data = array(
            'puzzle_id' => $this->puzzle_id,
            'game_token' => $game_token
        );

        if ($this->user) {
            $data['user_id'] = $this->user->user_id ; 
        }

        setcookie("game_token", $game_token, strtotime('+1 year'), '/');
        $created_game = DB::instance(DB_NAME)->insert('games', $data);

    }

    public function save_game($time, $answers, $complete, $game_token){

        $data = array(
            'time' => $time,
            'answers' => $answers,
            'game_token' => $game_token,
            'complete' => $complete
        );

        
        DB::instance(DB_NAME)->update("games", $data, "WHERE game_token = '".$game_token."'");      
    }

    public function check_answers($user_answers, $g_token){
        $check_results = array();

        $q = "SELECT solution FROM games g 
                LEFT JOIN puzzles p ON g.puzzle_id=p.puzzle_id 
                WHERE game_token=" . "'" . $g_token . "'";

        $puzzle_solution = DB::instance(DB_NAME)->select_field($q);

        $arr_user_answers = str_split($user_answers);
        $arr_solution = str_split($puzzle_solution);

        for ($i = 0; $i < 81; $i++) {
            if (($arr_user_answers[$i] == $arr_solution[$i]) ||
                ($arr_user_answers[$i] == 0) ) {
                array_push($check_results, 1);
            }
            else {
                array_push($check_results, 0);
            }
        }

        echo json_encode($check_results);
    }

    //loads an existing saved game
    public function load_game($token) {
        $q = "SELECT * FROM games g JOIN puzzles p ON g.puzzle_id=p.puzzle_id 
        WHERE game_token='" . $token . "'";
        
        $puzzle_info = DB::instance(DB_NAME)->select_rows($q); 
        setcookie("game_token", $token, strtotime('+1 year'), '/');

        $this->__set('hint',str_split($puzzle_info[0]['hint']));
        $this->__set('user_answers',str_split($puzzle_info[0]['answers']));
    }

    //generates HTML for existing games, includes user's answers
    public function load_puzzle_html(){
        $cellHTML = '';

        for ($i = 0; $i < count($this->hint); $i++) {
            
            $cellClass = 'cell';
            $cellValue = '';
            

            if ( ($i > 17 && $i < 27) || ($i > 44 && $i < 54) ) {
                $cellClass = $cellClass . ' botThick';
            }

            if ( ($i % 9 == 2) || ($i % 9 == 5) ) {
                $cellClass = $cellClass . ' rightThick';
            } 

            if ($this->hint[$i] != 0) {
                $cellClass = $cellClass . ' hintCell';
                $cellValue = $this->hint[$i];
            }
            else {
                $cellClass = $cellClass . ' userCell';

                if ($this->user_answers[$i] != 0) {
                    $cellValue = $this->user_answers[$i];
                }
            }
            
            $cellHTML .= '<div id=cell' . $i . ' class="' . $cellClass . '">' . $cellValue . '</div>'; 
        }
        return $cellHTML;
    }
} # end of the class
