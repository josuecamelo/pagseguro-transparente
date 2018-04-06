<?php

namespace App\Http\Controllers;

//use CodeCommerce\Events\CheckoutEvent;
use App\Http\Requests;
use App\Http\Controllers\Controller;

//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
//use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
//use PHPSC\PagSeguro\Credentials;
//use PHPSC\PagSeguro\Items\Item;
//use PHPSC\PagSeguro\Requests\Checkout\CheckoutService;

//notificações
//use PHPSC\PagSeguro\Purchases\Subscriptions\Locator as SubscriptionLocator;
//use PHPSC\PagSeguro\Purchases\Transactions\Locator as TransactionLocator;

class CheckoutController extends Controller {
    private $statusPagSeguro = array(
        0 => array('pt-br' => 'Iniciada', 'en' => 'Pending'),
        1 => array('pt-br' => 'Aguardando pagamento', 'en' => 'Awaiting payment'),
        2 => array('pt-br' => 'Em análise', 'en' => 'Processing'),
        3 => array('pt-br' => 'Paga', 'en' => 'Paid'),
        4 => array('pt-br' => 'Disponível', 'en' => 'Complete'),
        5 => array('pt-br' => 'Em disputa', 'en' => 'Dispute'),
        6 => array('pt-br' => 'Devolvida', 'en' => 'Refunded'),
        7 => array('pt-br' => 'Cancelada', 'en' => 'Canceled')
    );

	public function __construct()
    {
        //$this->middleware('auth'); //obrigando estar logado
        //s$this->middleware('auth', ['except' => ['notificacoes','confirmacao']]);
    }

    public function place()
    {
        if(!Session::has('cart'))
        {
            return false;
        }

        $cart = Session::get('cart');

        if($cart->getTotal() > 0){
            dd($cart->all());
            // $cart->limpar(); //Limpando Carrinho
        }
    }

    public function getSession(){
        $emailPagseguro = "";
        $tokenPagseguro = "";
        $urlNotificacao = "http://loja.exemplo.com/compra/notificacao.php";
        $scriptPagseguro = "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js";
        $urlPagseguro = "https://ws.sandbox.pagseguro.uol.com.br/v2/";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlPagseguro . 'sessions?email=' . $emailPagseguro . '&token=' . $tokenPagseguro);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, true);

        $data = curl_exec($ch);
        $xml = simplexml_load_string($data);
        curl_close($ch);

        return $xml->id;
    }


}
