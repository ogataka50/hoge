<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Mysql_test extends CI_Controller {

	/**
	 *
	 */
	public function index()
	{
		$this->server	= 'localhost';
		$this->user		= 'ogasawara';
		$this->password	= 'sumitomo';
		$this->database	= 'hoge';
		$this->port		= '3306';

		// MySQL Connet
		$mysqli = new mysqli($this->server, $this->user, $this->password, $this->database, $this->port);
		if ($mysqli->connect_error)
		{
			die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
		}

		$tmp_id = 33;
		$query = "SELECT * FROM test WHERE id=?";
		if ($stmt = $mysqli->prepare($query))
		{
			// bind_paramの第一引数はバインドする値の型を文字列で列挙
			// s は string, i は integer, d は double, b は blob
			$stmt->bind_param("i", $tmp_id);
			if (!$stmt->execute())
			{
				$stmt->close();
				$mysqli->close();
				return;
			}

			$result	= array();
			$params	= array();
			$row	= array();
			$meta	= $stmt->result_metadata();
			while ($field = $meta->fetch_field()) {
				$params[] = &$row[$field->name];
			}
			call_user_func_array(array($stmt, 'bind_result'), $params);
			while ($stmt->fetch())
			{
				$tmp_res = (object) array();
				foreach($row as $key => $val)
				{
					$tmp_res->$key = $val;
				}
				$result[] = $tmp_res;
			}

			var_dump($result);
		}
		$stmt->free_result();
		$stmt->close();
		$mysqli->close();


		$this->load->view('welcome_message');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */