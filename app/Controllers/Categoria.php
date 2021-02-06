<?php namespace App\Controllers;

use App\Models\CategoriaModel;
class Categoria extends BaseController
{
	public function index()
	{
		$data = [];
		$data['vista'] = 'categoria-lista';
		helper(['form']);
		$categoriaModel = new CategoriaModel();
		$data['categorias'] = $categoriaModel->findAll();

		return view('Categoria/categoria', $data);
	}

	//--------------------------------------------------------------------

}
