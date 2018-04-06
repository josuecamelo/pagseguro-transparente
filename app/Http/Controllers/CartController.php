<?php namespace App\Http\Controllers;

use App\Cart;
use App\Produto;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class CartController extends Controller {

    private $carrinho;

    public function __construct(Cart $cart){
        $this->carrinho = $cart;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if(!Session::has('cart')){
            Session::put('cart', $this->carrinho);
        }

        return view('loja.cart', ['cart'=>Session::get('cart')]);
    }

    /**
     * @param $id
     */
    public function add($id)
    {
        $cart = $this->getCart();
        $product = Produto::find($id);
        $cart->add($id, $product->nome, $product->valor);
        Session::put('cart', $cart);

        return redirect()->route('cart');
    }

    public function update($id, $qtd)
    {
        $cart = $this->getCart();
        $cart->updateQtd($id, $qtd);
        Session::put('cart', $cart);
    }

    public function getCart()
    {
        if (Session::has('cart')) {
            $cart = Session::get('cart');
        } else {
            $cart = $this->carrinho;
        }

        return $cart;
    }

    public function destroy($id)
    {
        $cart = $this->getCart();

        $cart->remove($id);

        Session::put('cart', $cart);
        return redirect()->route('cart');
    }
}
