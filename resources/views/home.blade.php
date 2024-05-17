@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('order.create') }}" class="btn btn-primary mt-2">Add Order</a>
                @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table mt-5">
                    <thead>
                        <tr>
                            <th scope="col">Order Id</th>
                            <th scope="col">User Id</th>
                            <th scope="col">User Name</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($orders as $order)
                            <tr>
                                <th scope="row">{{ $order->id }}</th>
                                <td>{{ $order->user_id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td> <a href="{{ route('order.view', ['id' => $order->id]) }}"
                                        class="btn btn-primary mt-2">view</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $orders->links('pagination::bootstrap-4') }}
                </div>
            </div>

        </div>
    </div>
@endsection
