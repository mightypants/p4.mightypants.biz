<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 

    public function signup($message = NULL) {
        # Setup view
        $output = View::instance('v_users_signup');
        echo $output;
    }

    public function p_signup() {
        //check to see if username or e-mail are already taken
        $user_exists = DB::instance(DB_NAME)->select_field("SELECT user_name FROM users WHERE user_name = '" . $_POST['user_name'] . "'");
        $email_exists = DB::instance(DB_NAME)->select_field("SELECT email FROM users WHERE email = '" . $_POST['email'] . "'");

        //check that all form fields are valid
        $formErrors = array();
        foreach($_POST as $k=>$v) {
            if(!$this->validateFields($k, $v)){
                array_push($formErrors, $k);
            }          
        }

        if ($user_exists || $email_exists) {
            echo 'The e-mail or username you have selected is already in use.';
        }
        elseif (!empty($formErrors)) {
            echo 'There were errors with some of your entries.';
        }
        else {
            # More data we want stored with the user
            $_POST['created']  = Time::now();
            $_POST['modified'] = Time::now();

            # Encrypt the password  
            $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);            

            # Create an encrypted token for user's sessions
            $_POST['token'] = sha1(TOKEN_SALT.$_POST['user_name'].Utils::generate_random_string()); 

            # Insert this user into the database
            //$user_id = DB::instance(DB_NAME)->insert('users', $_POST); 
            Router::redirect("/users/login/success");
            
        }
    }

    public function login($message = NULL) {
        $output = View::instance('v_users_login');
        $output->message = "message";
        echo $output;
    }

    public function p_login() {
        # Sanitize the user entered data
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        # Hash submitted password so we can compare it against one in the db
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        # Search the db for this username and password, retrieve token
        $q = "SELECT token 
            FROM users 
            WHERE user_name = '".$_POST['user_name']."' 
            AND password = '".$_POST['password']."'";

        $token = DB::instance(DB_NAME)->select_field($q);

        #redirect with error if token failed, otherwise redirect to user profile
        if(!$token) {
            echo 'bad';             
        } else {
            setcookie("token", $token, strtotime('+1 year'), '/');
            Router::redirect('/users/dashboard');
        }
    }

    public function dashboard($msg = NULL){
        $output = $this->template;
        $output->contentRight = View::instance('v_users_dashboard') ;
        $output->contentLeft = View::instance('v_users_stats');
        $output->contentRight->message = $msg;

        $recent_games = $this->get_recent_games(); 

        if ($this->user) {
            $banner_right = $this->user->user_name;
        }
        else {
            $banner_right = View::instance('v_users_login') ;
        }

        $output->banner_right = $banner_right;
        $output->contentRight->recent_games = $recent_games;

        echo $output;
        //echo $msg;
    }

    public function logout() {
        # Generate and save a new token for next login
        $new_token = sha1(TOKEN_SALT.$this->user->user_name.Utils::generate_random_string());
        $data = Array("token" => $new_token);
        DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

        # Delete token cookie
        setcookie("token", "", strtotime('-1 year'), '/');

        # Send them back to the main index.
        Router::redirect("/");
    }

    public function get_recent_games(){
        $recent_games = array();

        for ($i = 0; $i < 5; $i++) { 
            $q = 'SELECT *  FROM games g JOIN users u ON g.user_id=u.user_id 
            JOIN puzzles p ON g.puzzle_id=p.puzzle_id 
            WHERE u.user_id=' . $this->user->user_id . ' 
            AND p.difficulty=' . $i . ' 
            ORDER BY game_id DESC' ; 

            $games = DB::instance(DB_NAME)->select_rows($q);

            if ($games) {
                array_push($recent_games, $games[0]); 
            }
        }
        return $recent_games;
    }

    public function validateLength($fieldValue, $min, $max) {
        return strlen($fieldValue) > $min && strlen($fieldValue) < $max;
    }

    public function validateEmailFormat($fieldValue) { 
        return preg_match('/.+@.+\..{2,}/', $fieldValue);
    }

    public function validateAlphaNum($fieldValue) {
        return !preg_match('/.*[^\w].*/', $fieldValue);
    }

    public function validatePWChars($fieldValue) {
        return preg_match('/[0-9]/', $fieldValue) && preg_match('/[A-Za-z]/', $fieldValue);
    }

    public function validateNumOnly($fieldValue) {
        return !preg_match('/.*[^0-9].*/', $fieldValue);
    }

    public function validateFields($field,$value) {
        if($field == 'user_name') {
            return  $this->validateLength($value, 5, 16) && 
                    $this->validateAlphaNum($value);
        }
        if($field == 'email') {
            return  $this->validateEmailFormat($value);     
        }
        elseif($field == 'first_name') {
            return  $this->validateLength($value, 0, 25);     
        }
        elseif($field == 'last_name') {
            return  $this->validateLength($value, 0, 25);     
        }
        elseif($field == 'age') {
            return  $this->validateLength($value, 0, 4); //&&
                    //$this->validateNumOnly($value);     
        }
        elseif($field == 'hometown') {
            return  $this->validateLength($value, 1, 25);     
        }
        elseif($field == 'about') {
            return  $this->validateLength($value, 0, 900);     
        }
        elseif($field == 'password') {
            return  $this->validateLength($value, 5, 16) &&
                    $this->validatePWChars($value) &&
                    $this->validateAlphaNum($value); 
        }
        else {
            return false;
        }
    }

} # end of the class