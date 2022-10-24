@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Order') }}</div>
                <div class="card-body">
                    {{-- flasher notif --}}
                    @if (Session::has('success'))
                        <div class="alert alert-info">{{ Session::get('success') }}</div>
                    @endif
                    {{-- input start --}}
                    <form action="{{ route('orders-create') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="select-product" class="col-md-4 form-label col-form-label text-md-end">{{ __('Order') }}</label>
                            <select class="form-select" name="product_id" id="select-product">
                                <option disabled selected>Select One</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="row mb-3">
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                    <div class="table-responsive-sm">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td scope="row">{{ $order->id }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->details }}</td>
                                    <td>{{ $order->stock }}</td>
                                    <td>{{ $order->price }}</td>
                                    <td>
                                        <a href="{{ route('orders-edit', ['id' => $order->id]) }}" class="btn btn-sm btn-success">Edit</a>
                                        <form action="{{ route('orders-delete') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $order->id }}">
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
