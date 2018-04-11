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
        <div class="row">
            <div class="col-md-4">

                <div class="groupData" id="buyerData">

                    <div>
                        <h1>Dados do comprador</h1>
                        <div style="margin-top:-20px; text-align:right;">
                            <font color="red">* Campos de preenchimento obrigatório</font>
                        </div>
                    </div>

                    <div class="field" style="margin-top:-5px;">
                        <label for="senderEmail">E-mail <font color="red">*</font></label>
                        <input type="text" name="senderEmail" id="senderEmail" required="required" />
                    </div>

                    <div class="field" style="margin-top:-5px">
                        <label for="senderName">Nome completo <font color="red">*</font></label>
                        <input type="text" name="senderName" id="senderName" required="required"/>
                    </div>

                    <div class="field" style="margin-top:-5px">
                        <label for="senderCPF">CPF (somente números) <font color="red">*</font></label>
                        <input type="text" name="senderCPF" id="senderCPF" maxlength="14" required="required"/>
                    </div>

                    <div class="field" style="margin-top:-5px">
                        <label for="senderAreaCode">Telefone <font color="red">*</font></label>
                        <input type="text" name="senderAreaCode" id="senderAreaCode" class="areaCode" maxlength="2" required="required"/>
                        <input type="text" name="senderPhone" id="senderPhone" class="phone" maxlength="9" required="required" />
                    </div>

                    <h2>Endereço Residencial</h2>

                    <div class="field" style="margin-top: -10px;">
                        <label for="shippingAddressPostalCode">CEP (somente números) <font color="red">*</font></label>
                        <input type="text" name="shippingAddressPostalCode" id="shippingAddressPostalCode" maxlength="9" required="required"/>
                    </div>

                    <div style="margin-top:-10px;">

                        <div class="field">
                            <label for="shippingAddressStreet">Endereço <font color="red">*</font></label>
                            <input type="text" name="shippingAddressStreet" id="shippingAddressStreet" required="required"/>
                        </div>

                        <div class="field">
                            <label for="shippingAddressNumber">Número <font color="red">*</font></label>
                            <input type="text" name="shippingAddressNumber" id="shippingAddressNumber" size="5" required="required"/>
                        </div>

                    </div>

                    <div class="field" style="margin-top: 0px;">
                        <label for="shippingAddressComplement">Complemento</label>
                        <input type="text" name="shippingAddressComplement" id="shippingAddressComplement" />
                    </div>

                    <div class="field" style="margin-top:-5px;">
                        <label for="shippingAddressDistrict">Bairro <font color="red">*</font></label>
                        <input type="text" name="shippingAddressDistrict" id="shippingAddressDistrict" required="required"/>
                    </div>

                    <div class="field" style="margin-top:-5px;">
                        <label for="shippingAddressCity">Cidade <font color="red">*</font></label>
                        <input type="text" name="shippingAddressCity" id="shippingAddressCity" required="required"/>
                    </div>

                    <div class="field" style="margin-top:-5px;">
                        <label for="shippingAddressState">Estado <font color="red">*</font></label>
                        <input type="text" name="shippingAddressState" id="shippingAddressState" class="addressState" maxlength="2" style="text-transform: uppercase;" onBlur="this.value=this.value.toUpperCase()" required="required"/>
                    </div>

                    <div class="field" style="display: none">
                        <label for="shippingAddressCountry">País</label>
                        <input type="text" name="shippingAddressCountry" id="shippingAddressCountry" value="Brasil" readonly="readonly" />
                    </div>

                    {{--<p style="float: left"><b>Esta compra está sendo feita no Brasil</b> <img src="images/Brasil.png" alt="Bandeira do Brasil" title="Bandeira do Brasil" style="width: 64px;"/> </p>--}}

                    {{--<p style="clear: both"></p>--}}

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="groupData" id="paymentMethods">

                    <h1>Meios de Pagamento</h1>

                    <div id="paymentMethodsOptions">

                        <div class="field radio">
                            <input id="creditCardRadio" type="radio" name="changePaymentMethod" value="creditCard" >Cartão de Crédito</input>
                        </div>

                        <div class="field radio">
                            <input id="boletoRadio" type="radio" name="changePaymentMethod" value="boleto">Boleto</input>
                        </div>

                    </div>


                    <div id="creditCardData" class="paymentMethodGroup" dataMethod="creditCard">

                        <div id="cardData" style="margin-top:-20px">

                            <h2>Dados do Cartão </h2>

                            <div class="field" id="cardBrand" style="margin-top:-10px">
                                <label for="cardNumber">Número <font color="red">*</font></label>
                                <input type="text" name="cardNumber" id="cardNumber" class="cardDatainput" onblur="brandCard();" />
                                <span>
        <img class="bandeiraCartao" id="bandeiraCartao" />
      </span>
                            </div>

                            <div class="field" style="margin-top: -5px;" id="expiraCartao">
                                <label for="cardExpirationMonth">Data de Vencimento (99/9999) <font color="red">*</font></label>
                                <input type="text" name="cardExpirationMonth" id="cardExpirationMonth" class="cardDatainput month" maxlength="2" /> /
                                <input type="text" name="cardExpirationYear" id="cardExpirationYear" class="cardDatainput year" maxlength="4" />
                            </div>

                            <div class="field" style="margin-top: -5px;" id="cvvCartao">
                                <label for="cardCvv">Código de Segurança <font color="red">*</font></label>
                                <input type="text" name="cardCvv" id="cardCvv" maxlength="5" class="cardDatainput" />
                            </div>

                            <div class="field" id="installmentsWrapper">
                                <label for="installmentQuantity">Parcelamento</label>
                                <select name="installmentQuantity" id="installmentQuantity"></select>
                                <input type="hidden" name="installmentValue" id="installmentValue" />
                            </div>

                            <h2 style="margin-top: -5px">Dados do Titular do Cartão</h2>

                            <div id="holderDataChoice">

                                <div class="field radio">
                                    <input type="radio" name="holderType" id="sameHolder" value="sameHolder">mesmo que o comprador</input>
                                </div>

                                <div class="field radio">
                                    <input type="radio" name="holderType" id="otherHolder" value="otherHolder">outro</input>
                                </div>

                            </div>



                            <div class="field" style="margin-top: -5px">
                                <label for="creditCardHolderBirthDate">Data de Nascimento do Titular do Cartão <font color="red">*</font></label>
                                <input type="text" name="creditCardHolderBirthDate" id="creditCardHolderBirthDate" maxlength="10" />
                            </div>

                            <div id="dadosOtherPagador" class="dadosOtherPagador">

                                <div id="holderData">

                                    <div class="field" style="margin-top: -5px">
                                        <label for="creditCardHolderName">Nome (Como está impresso no cartão) <font color="red">*</font></label>
                                        <input type="text" name="creditCardHolderName" id="creditCardHolderName" />
                                    </div>

                                    <div class="field" style="margin-top: -5px" id="CPFP">
                                        <label for="creditCardHolderCPF">CPF (somente n&uacute;meros) <font color="red">*</font></label>
                                        <input type="text" name="creditCardHolderCPF" id="creditCardHolderCPF" maxlength="14" />
                                    </div>

                                    <div class="field" style="margin-top: -5px" id="TelP">
                                        <label for="creditCardHolderAreaCode">Telefone <font color="red">*</font></label>
                                        <input type="text" name="creditCardHolderAreaCode" id="creditCardHolderAreaCode" class="areaCode" maxlength="2" />
                                        <input type="text" name="creditCardHolderPhone" id="creditCardHolderPhone" class="phone" maxlength="9" />
                                    </div>

                                    <h2>Endereço de Cobrança</h2>

                                    <div class="field" style="margin-top: -5px" id="CEPP">
                                        <label for="billingAddressPostalCode">CEP <font color="red">*</font></label>
                                        <input type="text" name="billingAddressPostalCode" id="billingAddressPostalCode" maxlength="9"/>
                                    </div>


                                    <div class="field" style="margin-top: -5px" id="EndP">
                                        <label for="billingAddressStreet">Endereço <font color="red">*</font></label>
                                        <input type="text" name="billingAddressStreet" id="billingAddressStreet" />
                                    </div>

                                    <div class="field" style="margin-top: -5px" id="NumP">
                                        <label for="billingAddressNumber">Número <font color="red">*</font></label>
                                        <input type="text" name="billingAddressNumber" id="billingAddressNumber" size="5"/>
                                    </div>

                                    <div class="field" style="margin-top: -5px" id="ComP">
                                        <label for="billingAddressComplement">Complemento</label>
                                        <input type="text" name="billingAddressComplement" id="billingAddressComplement" />
                                    </div>

                                    <div class="field" style="margin-top: -5px" id="BairP">
                                        <label for="billingAddressDistrict">Bairro <font color="red">*</font></label>
                                        <input type="text" name="billingAddressDistrict" id="billingAddressDistrict" />
                                    </div>

                                    <div class="field" style="margin-top: -5px" id="CidP">
                                        <label for="billingAddressCity">Cidade <font color="red">*</font></label>
                                        <input type="text" name="billingAddressCity" id="billingAddressCity" />
                                    </div>

                                    <div class="field" style="margin-top: -5px" id="EstP">
                                        <label for="billingAddressState">Estado <font color="red">*</font></label>
                                        <input type="text" name="billingAddressState" id="billingAddressState" class="addressState" maxlength="2" style="text-transform: uppercase;" onBlur="this.value=this.value.toUpperCase()"/>
                                    </div>

                                    <div class="field" style="display: none">
                                        <label for="billingAddressCountry">País</label>
                                        <input type="text" name="billingAddressCountry" id="billingAddressCountry" value="Brasil" readonly="readonly" />
                                    </div>

                                </div>
                            </div>


                            <input type="hidden" name="creditCardToken" id="creditCardToken"  />
                            <input type="hidden" name="creditCardBrand" id="creditCardBrand"  />
                            <center>
                                <input type="button" id="creditCardPaymentButton" class="btn btn-default btn-block" onclick="pagarCartao(PagSeguroDirectPayment.getSenderHash());" value="Finalizar compra" />
                            </center>

                        </div>
                    </div>

                    <center>
                        <div id="boletoData" name="boletoData" class="paymentMethodGroup" dataMethod="boleto">
                            <input type="button" id="boletoButton" value="Gerar Boleto" class="btn btn-default btn-block" onclick="pagarBoleto(PagSeguroDirectPayment.getSenderHash());" />
                        </div>

                        <br />

                        <img src="images/banner-pagseguro.png" style="float:left"/>
                    </center>

                </div>
            </div>
        </div>
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
                }
            });
        });


    </script>
@endsection