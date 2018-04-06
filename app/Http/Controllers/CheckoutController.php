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
        $this->middleware('auth', ['except' => ['notificacoes','confirmacao']]);
    }

    public function place()
    {
        if(!Session::has('cart'))
        {
            return false;
        }

        $cart = Session::get('cart');

        if($cart->getTotal() > 0){
            /*$checkout = $checkoutService->createCheckoutBuilder();
            //criando ordem de serviço, será retorna um obj
            $order = $orderModel->create(['user_id'=> Auth::user()->id, 'total'=> $cart->getTotal(),'status_id'=> 1]);

            foreach($cart->all() as $k=>$item):
                $checkout->addItem(new Item($k, $item['name'], number_format($item['price'],2,'.',""), $item['qtd']));
                $order->items()->create(['product_id'=>$k, 'price'=>$item['price'], 'qtd'=> $item['qtd']]);
                //$cart->remove($k);
            endforeach;

            $cart->limpar(); //Limpando Carrinho

            event( new CheckoutEvent(Auth::user(), $order));

            Session::put('order_id', $order->id);

            $response = $checkoutService->checkout($checkout->getCheckout());

            //return view('store.checkout', compact('order','cart'));
            return redirect($response->getRedirectionUrl());*/

            dd($cart->all());

        }

        //$categories = Category::all();

        //return view('store.checkout', ['cart'=>'empty', 'categories'=>$categories]);
    }

    /*public function teste(CheckoutService $checkoutService)
    {

        $checkout = $checkoutService->createCheckoutBuilder()
            ->addItem(new Item(1, 'Televisão LED 500', 8999.99))
            ->addItem(new Item(2, 'Video-game mega ultra blaster', 799.99))
            ->getCheckout();

        $response = $checkoutService->checkout($checkout);

       return redirect($response->getRedirectionUrl());

    }*/

    public function notificacoes(Order $orderModel){
        /*$credentials = new Credentials('josueprg@hotmail.com', '3ECC5791294B4F6E9154C3782421693C');

        try {
            / *$service = $_POST['notificationType'] == 'preApproval'
                ? new SubscriptionLocator($credentials)
                : new TransactionLocator($credentials); // Cria instância do serviço de acordo com o tipo da notificação * /
            $service = new TransactionLocator($credentials);
            //$purchase = $service->getByNotification($_POST['notificationCode']);
            $purchase = $service->getByNotification('06FB34DF2094209474FEE4326FB8FBE0729E');
           dd($purchase); // Exibe na tela a transação ou assinatura atualizada
        } catch (Exception $error) { // Caso ocorreu algum erro
            echo $error->getMessage(); // Exibe na tela a mensagem de erro
        }*/

        /*$url = "https://ws.pagseguro.uol.com.br/v2/transactions/notifications/06FB34DF2094209474FEE4326FB8FBE0729E?email=josueprg@hotmail.com&token=3ECC5791294B4F6E9154C3782421693C";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        $http = curl_getinfo($curl);

        if($response == 'Unauthorized'){
            print_r($response);
            exit;
        }
        curl_close($curl);
        $response= simplexml_load_string($response);

        if(count($response -> error) > 0){
            print_r($response);
            exit;
        }
        exit;*/

        $notificacao = $_POST['notificationCode'];

        $url = "https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/".$notificacao;
        $url.= "?email=josueprg@hotmail.com&token=3ECC5791294B4F6E9154C3782421693C";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        $http = curl_getinfo($curl);

        if($response == 'Unauthorized'){
            print_r($response);
            exit;
        }
        curl_close($curl);

        $response = simplexml_load_string($response);
        $responseArr = @json_decode(@json_encode($response),1);
        //dd($this->statusPagSeguro[$responseArr['status']]['pt-br']);*/
        //dd($responseArr['code']);//transação
        //dd($responseArr['status']); //status
        $transacao = str_replace('-', '', $responseArr['code']);
        //Order::where('transacao_id', $transacao )->update(['status_id' => $responseArr['status']]);
       //dd($responseArr);
       $orderModel->where(['transacao_id' => $transacao])->update(['status_id' => $responseArr['status']]);
    }

    public function confirmacao(Order $orderModel){
        /*
        $order_id = Session::get('order_id');

        $transacao = str_replace('-','', Input::get('codpagseguro'));
        Order::find($order_id)->update(['transacao_id' => $transacao]);

        Session::forget('order_id');
        //return view('store.checkout', compact('order','cart','transacao'));
        //$order = Order::find($order_id)->get();
        */

        //teste local
        /*$order_id = 16;
        $transacao = '12345678910';*/
        $order_id = Session::get('order_id');
        $transacao = str_replace('-','', Input::get('codpagseguro'));

        $order = $orderModel->find($order_id);//->update(['transacao_id' => $transacao]);
        $order->update(['transacao_id' => $transacao]);

        Session::forget('order_id');
        dd($order);

    }
}
