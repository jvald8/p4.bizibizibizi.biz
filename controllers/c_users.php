<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        //echo "users_controller construct called<br><br>";
    } 

    public function index() {
        echo "This is the index page";
    }

    public function signup() {
        //echo "This is the signup page";
        $this->template->content = View::instance('v_users_signup');

        echo $this->template;
    }

    public function p_signup() {

        /*echo '<pre>';
        print_r($_POST);
        echo '<pre>';*/
        $_POST['created'] = Time::now();
        $_POST['modified'] = Time::now();

        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());

        $user_id = DB::instance(DB_NAME)->insert('users', $_POST);

        echo 'You\'re signed up';
    }

    public function login($error = NULL) {
        //echo "This is the login page";
        $this->template->content = View::instance('v_users_login');
        //$this->template->title = "Login";
        $this->template->content->error = $error;

        echo $this->template;
    }

    public function p_login() {

        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        $q = "SELECT token
            FROM users
            WHERE email = '".$_POST['email']."'
            AND password = '".$_POST['password']."'";

        $token = DB::instance(DB_NAME)->select_field($q);

        if(!token) {

            Router::redirect("/users/login/error");
        } else {
            setcookie("token", $token, strtotime('+2 weeks'), '/');

            Router::redirect("/");
        }
    }

    public function logout() {
        //echo "This is the logout page";
        $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

        $data = Array("token" => $new_token);

        DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

        setcookie("token", "", strtotime('-1 year'), '/');

        Router::redirect("/");
    }

    public function profile($user_name = NULL) {

        # Create a new View instance
        # Do *not* include .php with the view name
        //$view = View::instance('v_users_profile');
        if(!$this->user) {
            Router::redirect('/users/login');
        }
        $this->template->content = View::instance('v_users_profile');

        # Pass information to the view instance
        //$view->user_name = $user_name;
        //$view->set('user_name', $user_name);
        $this->template->title = "Profile".$this->user->first_name;

        //$this->template->content->user_name = $user_name;

        # Render View
        echo $this->template;
    }

} # end of the class