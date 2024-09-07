@extends('backend.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <br>
                
                <br>
                <h4 class="text-success text-center">Users</h4>
                <br>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Serial</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $serial = 1;
                    @endphp

                    @foreach ($users as $item)
                    <tr>
                        <th scope="row">{{ $serial++ }}</th>
                        <td>{{ $item->name }}</td>
                        <td>
                            {{ $item->email }}
                        </td>
                        <td>
                            {{ $item->address }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
