@extends('layouts.app')

@section('ocss')
    <style>

    </style>
@endsection


@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="table-responsive">
                <table id="carrinhoTbl" class="table table-condensed">
                    <thead>
                    <tr>
                        <td class="image">Item</td>
                        <td class="description">Description</td>
                        <td class="price">Price</td>
                        <td class="price">Qtd</td>
                        <td class="price">Total</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($cart->all() as $k=>$item)
                        <tr>
                            <td>
                                <a href="#">
                                    Imagem
                                </a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="#">{{ $item['name']  }}</a></h4>
                                <p>Código: {{ $k  }}</p>
                            </td>
                            <td class="cart_price">
                                R$ {{ $item['price']  }}
                            </td>
                            <td data-product="{{ $k }}" class="cart_qtd">
                                <div style="float:left;width:200px;height:100px;display: inline-block;">
                                    <input style="width:100px;" class="form-control" type="number" value="{{ $item['qtd']  }}" name="quantity" min="1" />
                                    {{--<div class="inc button">+</div><div class="dec button">-</div>--}}
                                </div>
                            </td>

                            <td class="cart_total">
                                <p class="cart_total_price">R$ {{ $item['price'] * $item['qtd'] }}</p>
                            </td>

                            <td class="cart_delete">
                                <a href="{{ route('cart.destroy',['id'=> $k])  }}" class="cart_quantity_delete">Delete Item</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                               <p>Nenhum item encontrado.</p>
                            </td>
                        </tr>
                    @endforelse

                    <tr>
                        <td colspan="6">
                            <div class="pull-right">
                                <span style="margin-right: 90%;">
                                    TOTAL: R$ {{ $cart->getTotal()  }}
                                </span>
                                <a class="btn btn-success" href="{{ route('checkout.place') }}">Fechar Conta</a>
                            </div>
                        </td>
                    </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </section>
@stop
