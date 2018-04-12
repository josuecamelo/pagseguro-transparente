@extends('layouts.app2')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="groupData" id="cartData">

                    <div id="carWrapper">
                        <table id="cartTable table table-responsive table-striped" style="margin: 0 0 -1em 0; ">
                            <thead>
                            <tr>
                                <th class="tableProduto">Descrição</th>
                                <th class="tableProduto">Valor</th>
                            </tr>
                            </thead>
                            @foreach($cart->all() as $itemCart)
                            <tbody>
                                <td>{{ $itemCart['name'] }}</th>
                                <td>R$ {{ $itemCart['price'] }}</th>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4"><div style="text-align: right"><h3 id="cartTotal"> Valor Total: R$ <span id="totalValue">{{ number_format($cart->getTotal(),2)  }}</span> </h3></div></div>
        </div>

        <hr />


    </div>
@stop


@section('ojs')
    <script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: 'http://localhost:8000/checkout/obter/sessao',
                cache: false,
                success: function(data) {
                    PagSeguroDirectPayment.setSessionId(data);

                    //Valor da Compra
                    console.log($("#totalValue").html());

                    PagSeguroDirectPayment.getPaymentMethods({
                        amount: $("#totalValue").html(),
                        maxInstallmentNoInterest: 10,
                        success: function(response) {
                            //meios de pagamento disponíveis
                            console.log(response);
                        },
                        error: function(response) {
                            //tratamento do erro
                        },
                        complete: function(response) {
                            //tratamento comum para todas chamadas
                        }
                    });



                }
            });
        });
    </script>
@endsection