<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'HTTP/Request2.php';

class Redis_test extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$redis = new Redis();

		$redis->connect("127.0.0.1",6379);
		$tmp = "redis!";
		$redis->set("test_key",$tmp);
		$res = $redis->get("test_key");


		var_dump($res);

		require_once dirname(__FILE__) . '/vine_api.php';
		//var_dump(Vine_api::exec_login('ogataka50@gmail.com', 'sumitomo1225'));
		$res = Vine_api::exec_login('ogataka50@gmail.com', 'sumitomo1225');
//var_dump($res);
		$key = $res->data->key;
		//var_dump(Vine_api::get_tag_timeline());
		$res = Vine_api::get_popular();
		$post_info = $res->data->records[6];
var_dump($res->data->records[5]);
		//var_dump(Vine_api::exec_like_post($key, $post_info->postId));


		$this->load->view('welcome_message');
	}

	//データ取得
	public function vine_get($key=0,$api='timelines/popular')
	{
		$requesta	= new HTTP_Request2();
		$uri = 'https://api.vineapp.com/users/authenticate';

		@$requesta->setUrl($uri);
		$requesta->setMethod(HTTP_Request2::METHOD_POST);
		$requesta->addPostParameter("username", "ogataka50@gmail.com");
		$requesta->addPostParameter("password", "sumitomo1225");
		$requesta->setConfig(array('ssl_verify_peer' => false));

		$response	= $requesta->send();
		$ret		= json_decode($response->getBody());
//var_dump($ret);

		$key = $ret->data->key;

		$request	= new HTTP_Request2();
		$uri = 'https://api.vineapp.com/'.$api;

		@$request->setUrl($uri);
		$request->setMethod(HTTP_Request2::METHOD_GET);
		$request->setHeader('Content-Type', 'application/json; charset=utf8');
		//$request->setHeader('vine-session-id', $key);
		$request->setConfig(array('ssl_verify_peer' => false));

		$response	= $request->send();
		$ret		= json_decode($response->getBody());
//var_dump($ret->data->records[0]);
		$this->load->view('welcome_message');

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */