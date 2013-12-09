<?php
class Puzzle {

    private $difficulty;
    private $solution;
    private $hint;

    public function __construct($difficulty = NULL) {
        $this->difficulty = $difficulty;
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

    public function load_puzzle(){
        $q = 'SELECT * FROM puzzles where difficulty=' . $this->difficulty;
        $puzzle_info = DB::instance(DB_NAME)->select_rows($q); 

        $this->__set('hint',str_split($puzzle_info[0]['hint']));
        $this->__set('solution',str_split($puzzle_info[0]['solution']));
    }

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


} # end of the class