<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'HTTP/Request2.php';

class Vine_api {

	const VINE_API_DOMAIN = 'https://api.vineapp.com/';

	//login
	public function exec_login($username='', $password='')
	{
		if(!$username || !$password) return FALSE;

		$request	= new HTTP_Request2();
		$api		= 'users/authenticate';
		$uri 		= self::VINE_API_DOMAIN . $api;

		$request->setUrl($uri);
		$request->setMethod(HTTP_Request2::METHOD_POST);
		$request->addPostParameter("username", $username);
		$request->addPostParameter("password", $password);
		$request->setConfig(array('ssl_verify_peer' => false));

		$response	= $request->send();
		$ret		= json_decode($response->getBody());

		return $ret; 
	}

	//logout
	public function exec_logout($key='')
	{
		if(!$key) return FALSE;

		$request	= new HTTP_Request2();
		$api		= 'users/authenticate';
		$uri 		= self::VINE_API_DOMAIN.$api;

		$request->setUrl($uri);
		$request->setMethod(HTTP_Request2::METHOD_DELETE);
		$request->setHeader('vine-session-id', $key);
		$request->setConfig(array('ssl_verify_peer' => false));

		$response	= $request->send();
		$ret		= json_decode($response->getBody());
		
		return $ret; 
	}

	//popular取得
	public function get_popular()
	{
		$request	= new HTTP_Request2();
		$api		= 'timelines/popular';
		$uri 		= self::VINE_API_DOMAIN.$api;

		$request->setUrl($uri);
		$request->setMethod(HTTP_Request2::METHOD_GET);
		$request->setConfig(array('ssl_verify_peer' => false));

		$response	= $request->send();
		$ret		= json_decode($response->getBody());
		return $ret; 
	}

	//対象ユーザデータ取得
	public function get_user_data($key='', $user_id='me')
	{
		if(!$key || !$user_id) return FALSE;

		$request	= new HTTP_Request2();
		$api		= 'users/';
		if(0 !== strcmp('me', $user_id))
		{
			$api .= 'profiles/';
		}
		$api		.= $user_id;
		$uri 		= self::VINE_API_DOMAIN.$api;

		$request->setUrl($uri);
		$request->setMethod(HTTP_Request2::METHOD_GET);
		$request->setHeader('vine-session-id', $key);
		$request->setConfig(array('ssl_verify_peer' => false));

		$response	= $request->send();
		$ret		= json_decode($response->getBody());
		return $ret; 
	}

	//対象ユーザのtimelineデータ取得
	public function get_user_timeline($user_id='')
	{
		if(!$user_id) return FALSE;

		$request	= new HTTP_Request2();
		$api		= 'timelines/users/' . $user_id;
		$uri 		= self::VINE_API_DOMAIN.$api;

		$request->setUrl($uri);
		$request->setMethod(HTTP_Request2::METHOD_GET);
		$request->setConfig(array('ssl_verify_peer' => false));

		$response	= $request->send();
		$ret		= json_decode($response->getBody());
		return $ret; 
	}

	//対象タグのリスト取得
	public function get_tag_timeline($tag='hawaii')
	{
		if(!$tag) return FALSE;

		$request	= new HTTP_Request2();
		$api		= 'timelines/tags/' . $tag;
		$uri 		= self::VINE_API_DOMAIN.$api;

		$request->setUrl($uri);
		$request->setMethod(HTTP_Request2::METHOD_GET);
		$request->setConfig(array('ssl_verify_peer' => false));

		$response	= $request->send();
		$ret		= json_decode($response->getBody());
		return $ret;
	}

	//対象ポスト情報取得
	public function get_post_info($post_id='')
	{
		if(!$post_id) return FALSE;

		$request	= new HTTP_Request2();
		$api		= 'timelines/posts/' . $post_id;
		$uri 		= self::VINE_API_DOMAIN . $api;

		$request->setUrl($uri);
		$request->setMethod(HTTP_Request2::METHOD_GET);
		$request->setConfig(array('ssl_verify_peer' => false));

		$response	= $request->send();
		$ret		= json_decode($response->getBody());
		return $ret; 
	}

	//対象postにlike
	//未対応疑惑
/*
	public function exec_like_post($key='', $post_id='')
	{
		if(!$key || !$post_id) return FALSE;

		$request	= new HTTP_Request2();
		$api		= 'posts/' . $post_id . '/likes';
		$uri 		= self::VINE_API_DOMAIN.$api;

		$request->setUrl($uri);
		$request->setMethod(HTTP_Request2::METHOD_GET);
		$request->setHeader('vine-session-id', $key);
		$request->setConfig(array('ssl_verify_peer' => false));

		$response	= $request->send();
		$ret		= json_decode($response->getBody());
		return $ret; 
	}
*/	
}