@extends('backend.master')

@section('content')
<div class="container">
        <div class="container">
            <div class="container">
<br>
<h4 class="text-success text-center">Order List</h4>
<br>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Serial</th>
            <th scope="col">Name</th>
            <th scope="col">Total</th>
            <th scope="col">Full Name</th>
            <th scope="col">Address</th>
            <th scope="col">Phone</th>
            <th scope="col">Email</th>
            
            <th scope="col">Discount</th>
            <th scope="col">Invoice</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
        $id = 1;
        @endphp

        @foreach ($orders as $item)
        <tr>
            <th scope="row">{{ $id++ }}</th>
            <td>{{ $item->name }}</td>
            <td>{{ $item->total_price }} Tk.</td>
           
            <td>{{ $item->full_name }}</td>
            <td>{{ $item->address }}</td>
            <td>{{ $item->phone }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->product->discounted_price }} Tk</td>
           
            <td>
                <a href="{{route('order.invoice' ,$item->id)}}" class="btn btn-info"><i class="fas fa-file-invoice"></i></a>
            </td>
            <td>
                <a href="{{route('confirm' ,$item->id)}}"><b>Confirm</b></a>
            </td>
            <td>
                <a href="{{route('reject' ,$item->id)}}"><b>Reject</b></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
</div>

</div>

@endsection
