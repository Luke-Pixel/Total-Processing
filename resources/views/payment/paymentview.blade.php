@extends('layouts.app')

@section('content')

<script type="text/javascript" src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId=<?php  echo Session::get('response')['id']; ?>"></script>
<form action="{{ route('refund') }}" method='get'> 
    <div class='flex justify-center ' > 
        <div class='w-6/12 bg-white p-6 rounded-lg max-w-lg'>
            <h1 class='mb-4 font-bold text-center text-xl'>Payment History</h1>

            <!-- if payments exist, iterate through payments and displayy on screen -->
            @if($payments->count())
                @foreach ($payments as $payment)
             <hr>  

            <div class=' flex justify-between max-w-7xl'>    
                <div name='paymentrecord' class='m-4'>
                    <a href="" class='font-bold'>Refrence: {{$payment->refrence}}</a> <span class='text-gray-600 text-sm'>{{$payment->created_at}}</span>
                    <p class='text-lg'> {{$payment->amount}}€</p>
                    <!-- if payment has associated refund, display it on page -->
                    @if($payment->refunded > 0)
                        <p class='text-green-600 '>{{$payment->refunded}}€ Refunded</p>
                    @endif
                </div>
                        
                <button name='refund_btn' value='{{$payment->payment_id}}' href="{{ route('refund') }}" class=' bg-blue-500 text-white px-4 py-4 rounded
                    font-medium m-4' type='submit' >Refund</button>
            </div>             
                @endforeach

            <hr>
            <!-- if no payments exist for user display no payments -->
            @else
                <h1 class='text-center'>No Payment History</h1>
            @endif
            
        </div>
    </div>
</form>
@endsection


