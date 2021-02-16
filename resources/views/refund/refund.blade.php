@extends('layouts.app')

@section('content')
    <div class='flex justify-center'>
        <div class='w-6/12 bg-white p-6 rounded-lg'>
            
            <form   action="{{ route('processrefund') }}" method='post'>
                @csrf
                <h1 class='mb-4 font-bold text-center text-xl'>New Refund</h1>
                <div class='mb-4'>
                <!-- if error with entry displa to user -->
                @if (session('status'))
                    <div class ="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                        {{session('status')}}
                    </div>
                @endif
                    <label for='refundamount' class='sr-only'>Amount</label>
                    <input type='number' name='refundamount' id='refundamount' placeholder='Refund Amount'
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('refundamount') border-red-500 @enderror" value="{{ old('refund-amount') }}">
                    <!--display validation error -->
                    @error('refundamount')
                        <div class='text-red-500 mt-2 text-sm'>
                            {{$message}}
                        </div>
                    @enderror
                </div> 

                <div>
                    <button type='submit' class='bg-blue-500 text-white px-4 py-3 rounded
                    font-medium w-full'>Process Refund</button>
                </div>

            </form>
        </div>
    </div>
@endsection