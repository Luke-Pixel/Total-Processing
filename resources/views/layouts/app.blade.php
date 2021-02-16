<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Processing</title>
    
    <link rel='stylesheet' href="{{asset('css/app.css')}}" >
</head>
<body class='bg-gray-100'>
<nav class='p-6 bg-white flex justify-between mb-6'>
        <!--navigation displayed at top of every page -->
        <ul class="flex items-center">
        @auth
            <li>
                <a class ='p-3' href="{{ route('paymentview') }}">Payment History</a>
            </li>
            <li>
                <a class ='p-3' href="{{ route('payment') }}">New Payment</a>
            </li>
            @endauth
        </ul>

        <ul class="flex items-center">
            @auth
            <li>
                <a class ='p-3'href="">{{ auth()->user()->name }}</a>
            </li>
            <li>
                <form action=" {{ route('logout') }} " method='post' class="inline">
                    @csrf
                    <button type='submit' >Logout</button>
                </form>
            </li>
            
            @endauth

            @guest
            <li>
                <a class ='p-3' href="{{ route('login') }}">Login</a>
            </li>
            <li>
                <a class ='p-3' href="{{ route('register') }}">Register</a>
            </li>
            @endguest
            
        </ul>

    </nav>

    @yield('content') 
    @yield('script')
</body>
</html>