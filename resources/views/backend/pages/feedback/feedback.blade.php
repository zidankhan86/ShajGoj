@extends('backend.master')

@section('content')

<div class="container">
<div class="container">

<div class="container">



 <br><h4 class="text-success text-center">Contact Us</h4><br>



<table class="table">
    <thead>
      <tr>
        <th scope="col">serial</th>
        <th scope="col"> Name</th>
        <th scope="col">Email</th>
        <th scope="col"> Message</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @php
            $serial =1;
        @endphp

        @foreach ($feedback as $item)
      <tr>


        <th scope="row">{{ $serial++}}</th>
        <td>{{ $item->name}}</td>
        <td>{{ $item->email}}</td>


        <td>
            <a href="{{route('contact.view' ,$item->id)}}" class="btn btn-info"><i class="fas fa-envelope"> </i> OPEN</a>


        </td>
        <td>
            <a href="" class="btn btn-success"> <i class="fas fa-check"></i></a>
        </td>

      </tr>
      @endforeach

    </tbody>
  </table>

  </div>
</div>
</div>

@endsection


