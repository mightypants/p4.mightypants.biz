<?php
class Game {

    private $user;
    private $puzzle;
    private $time;
    private $difficulty;

    public function __construct($user, $difficulty = NULL) {
        $this->difficulty = $difficulty;
        $this->user = $user;
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

    public function new_game(){
        $this __set('user', 7);
        $this __set('puzzle', 1);
        $data = array(
            'puzzle_id' => $this->puzzle, 
            'user_id' => $this->user_id,
            'time' => 0
        );
        //$game_id = DB::instance(DB_NAME)->insert('games', data);
        print_r($data); 

    }


} # end of the class