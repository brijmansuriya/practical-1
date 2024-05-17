@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p for="amount" class="form-label">Order Id : {{ $order->id }} </p>   
                <p for="amount" class="form-label">User Id :  {{ $order->user->id }}</p> 
                <p for="amount" class="form-label">User Name : {{ $order->user->name }}</p>  
             
                <table class="table mt-5">
                    <thead>
                        <tr>
                            <th scope="col">Product Id</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Product Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        @foreach ($order->products as $product)
                            <tr>
                                <th scope="row">{{ $product->id }}</th>
                                <td>{{ $product->name}}</td>
                                <td>{{ $product->amount }}</td>
                              
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
