<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data['vista'] = 'home';
		return view('home', $data);
	}

	//--------------------------------------------------------------------

}
