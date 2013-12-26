<?php
class posts_controller extends base_controller {
	
	public function __construct() {
		parent::__construct();

		if(!$this->user) {
			die("Members only. <a href='/users/login'>Login</a>");
		}
	}

	public function add() {

		$this->template->content = View::instance('v_posts_add');
		$this->template->title = "New Post";

		echo $this->template;
	}

	public function p_add() {

		$_POST['user_id'] = $this->user->user_id;

		$_POST['created'] = Time::now();
		$_POST['modified'] = Time::now();


		DB::instance(DB_NAME)->insert('posts', $_POST);

		//echo "Your recipe has been added to the list. <a href='/posts/add'>Add another</a>";
		Router::redirect("/posts");
	}

	public function index() {

		$this->template->content = View::instance('v_posts_index');
		$this->template->title   = "Posts";

		$q = "SELECT
				posts .* ,
				users.first_name,
				users.last_name
			FROM posts
			INNER JOIN users
				ON posts.user_id = users.user_id";

		$posts = DB::instance(DB_NAME)->select_rows($q);

		$this->template->content->posts = $posts;

		echo $this->template;
	}
}
