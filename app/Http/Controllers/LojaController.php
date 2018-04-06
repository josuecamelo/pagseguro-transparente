<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;

class LojaController extends Controller
{
    public function index(Produto $produtoModel)
    {
        $produtosList = $produtoModel::paginate(8);

        return view('loja.home', compact('produtosList'));
    }

    public function carrinho(){

    }
}
