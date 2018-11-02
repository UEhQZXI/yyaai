<?php
namespace App\Common;

class Res{
	private $code = 200;
	private $msg = 'success';
	private $data = [];

	public function __construct($status, $code, $msg, $data)
	{
		$this->code = $code;
		$this->msg = $msg;
		$this->data = $data;

		switch ($status) {
			case 'success':
				Self::successResponse();
				break;
			
			case 'error':
				Self::errorResponse();
				break;
		}
	}

	private function successResponse()
	{
		return array(
			'code' => $this->code,
			'msg' => $this->msg,
			'data' => $this->data
		);
	}

	private function errorResponse()
	{
		return array(
			'code' => $this->code,
			'msg' => $this->msg,
			'data' => $this->data
		);
	}
}
