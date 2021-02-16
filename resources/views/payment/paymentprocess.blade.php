@extends('layouts.app')

@section('content')

<!-- setup options for payyment-->
<script>
    var wpwlOptions = {
        style: "plain",
      billingAddress: {
        country: "",
        state: "",
        city: "",
        street1: "",
        street2: "",
        postcode: ""
      },customerinformation:{
          name:""
      }
        
    }
</script>
<script type="text/javascript" src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId=<?php  echo Session::get('response')['id']; ?>"></script>

    <!-- display paymant form -->
    <div class='flex justify-center'> 
        <div class='w-6/12 bg-white p-6 rounded-lg'>
            
            <h1 class='mb-11 font-bold text-center text-xl'>Checkout</h1>
            <form method='post' action="{{ route('paymentstatus') }}" class="paymentWidgets w-full" data-brands="VISA MASTER AMEX">
                @csrf
            </form>   

        </div>
    </div>
@endsection

@section('script')

@endsection

