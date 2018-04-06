@extends('layouts.app')

@section('ocss')
    <style>
    @import url("https://fonts.googleapis.com/css?family=Montserrat");

    .pricing-table{
        background-color: #eee;
        font-family: 'Montserrat', sans-serif;
    }

    .pricing-table .block-heading {
        padding-top: 50px;
        margin-bottom: 40px;
        text-align: center;
    }

    .pricing-table .block-heading h2 {
        color: #3b99e0;
    }

    .pricing-table .block-heading p {
        text-align: center;
        max-width: 420px;
        margin: auto;
        opacity: 0.7;
    }

    .pricing-table .heading {
        text-align: center;
        padding-bottom: 10px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .pricing-table .item {
        background-color: #ffffff;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
        border-top: 2px solid #5ea4f3;
        padding: 30px;
        overflow: hidden;
        position: relative;
    }

    .pricing-table .col-md-5:not(:last-child) .item {
        margin-bottom: 30px;
    }

    .pricing-table .item button {
        font-weight: 600;
    }

    .pricing-table .ribbon {
        width: 160px;
        height: 32px;
        font-size: 12px;
        text-align: center;
        color: #fff;
        font-weight: bold;
        box-shadow: 0px 2px 3px rgba(136, 136, 136, 0.25);
        background: #4dbe3b;
        transform: rotate(45deg);
        position: absolute;
        right: -42px;
        top: 20px;
        padding-top: 7px;
    }

    .pricing-table .item p {
        text-align: center;
        margin-top: 20px;
        opacity: 0.7;
    }

    .pricing-table .features .feature{
        font-weight: 600;
    }

    .pricing-table .features h4 {
        text-align: center;
        font-size: 18px;
        padding: 5px;
    }

    .pricing-table .price h4 {
        margin: 15px 0;
        font-size: 45px;
        text-align: center;
        color: #2288f9;
    }

    .pricing-table .buy-now button {
        text-align: center;
        margin: auto;
        font-weight: 600;
        padding: 9px 0;
    }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Produtos</div>

        <div class="row">
            @foreach($produtosList as $produto)
                <div class="col-md-3" style="padding-bottom: 25px !important;">
                    <div class="item">
                        <div class="heading">
                            <h3 class="text-center">{{ $produto->nome }}</h3>
                        </div>

                        <div class="price text-center">
                            <h4>R$ {{ $produto->valor  }}</h4>
                        </div>
                        <a href="{{  route('cart.add', ['id'=> $produto->id]) }}" class="btn btn-block btn-warning">Adicionar no Carrinho</a>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $produtosList->render()  }}
    </div>
</div>
@endsection
