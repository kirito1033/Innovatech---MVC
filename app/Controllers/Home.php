<?php

namespace App\Controllers;

use App\Models\CategoriaModel;
use App\Models\ProductosModel;
use App\Models\OfertasModel;

class Home extends BaseController
{
    public function index()
    {
        $categoriaModel = new CategoriaModel();
        $productoModel = new ProductosModel();
        $ofertasModel = new OfertasModel();
    
        $data['categorias'] = $categoriaModel->findAll();
        $data['productos'] = $productoModel->findAll();
        $data['ofertas'] = $ofertasModel
            ->where('estado', 1)
            ->findAll();
    
        return view('home', $data);
    }
}
