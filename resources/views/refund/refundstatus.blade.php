@extends('layouts.app')

@section('content')

    <div class='flex justify-center'> 
        <div class='w-6/12 bg-white p-6 rounded-lg max-w-lg'>
            <h1 class='text-lg font-bold text-center'>Refund Status</h1> 
            
            <!-- displayy appropriate result to user  with code and status-->
            <?php 
                if(Session::get('refundResponse')['result']['code'] == "000.100.110"){ ?>
                    <div>
                        <h2 class='font-semibold text-green-600 text-center m-2.5'>Refund Succesful</h2>
                        
                    </div>
            <?php }else{ ?>
                        <h2 class='font-semibold text-red-600 text-center m-2.5'>Refund Unsuccesful</h2>
                        
            <?php } ?>
            
            <p class='text-center'>Description: <?php  echo Session::get('refundResponse')['result']['description'] ?> </p>

            <p class='text-center'>Code: <?php  echo Session::get('refundResponse')['result']['code'] ?></p>
   
        </div>
    </div>
@endsection
