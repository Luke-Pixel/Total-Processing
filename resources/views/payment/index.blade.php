@extends('layouts.app')

@section('content')
    <div class='flex justify-center'>
        <div class='w-6/12 bg-white p-6 rounded-lg max-w-md'>
            <!--display errors from user input -->
            @if (session('status'))
                <div class ="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                    {{session('status')}}
                </div>
            @endif
            
            <form   action="{{ route('payment') }}" method='post'>
                @csrf
                <h1 class='mb-4 font-bold text-center text-xl'>New Payment</h1>

                <div class='mb-4'>
                    <label for='amount' class='sr-only'>Amount</label>
                    <input type='number' name='amount' id='amount' placeholder='Amount (€)'
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg 
                    @error('amount') border-red-500 @enderror" value="{{ old('amount') }}">
                    <!--display validation error -->
                    @error('amount')
                        <div class='text-red-500 mt-2 text-sm'>
                            {{$message}}
                        </div>
                    @enderror
                </div> 

                <div class='mb-4'>
                    <label for='refrence' class='sr-only'>Refrence</label>
                    <input type='text' name='refrence' id='refrence' placeholder='Payment Refrence'
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('refrence') border-red-500 @enderror">
                    <!--display validation error -->
                    @error('refrence')
                        <div class='text-red-500 mt-2 text-sm'>
                            {{$message}}
                        </div>
                    @enderror
                </div> 


                <div>
                    <button type='submit' class='bg-blue-500 text-white px-4 py-3 rounded
                    font-medium w-full'>Continue</button>
                </div>

            </form>
        </div>
    </div>
@endsection