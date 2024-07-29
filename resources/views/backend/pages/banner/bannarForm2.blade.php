@extends('backend.master')

@section('content')
<div class="container">
<div class="container">
<div class="container">

<br><h4 class=" text-success text-center">Banner</h4>

<form action="{{route('banner.store.two')}}" method="POST" enctype="multipart/form-data">
    @csrf

        @if(session('success'))
        <p class="alert alert-success"> {{session('success')}}</p>

        @endif
           @if(session('error'))
        <p class="alert alert-danger"> {{ session('error') }}
            @endif



            <div class="mb-3 mx-sm-2">
            <label for="exampleInputName1" class="form-label">Title</label>
            <input type="text" class="form-control" value="{{ old('tittle') }}" id="title" name="tittle" placeholder="Face wash">
            @error('tittle')
            <strong class="text-danger">{{$message}}</strong>
            @enderror
            </div>



            <div class="mb-3 mx-sm-2">
            <label for="exampleInputName2" class="form-label">Upload Image <strong>(MAX 1000kb)*</strong></label>
            <input type="file" class="form-control dropify" value="{{ old('image') }}"  name="image">
            @error('image')

            <strong class="text-danger">{{$message}}</strong>

            @enderror
            </div>


      <div class="text-center">
        <button type="submit" class="btn btn-info"><i class="fas fa-upload"></i> Upload Banner</button>
      </div>

  </form>

  </div>
  </div>
  </div>
  <script>
    $('.dropify').dropify({
    messages: {
        'default': 'Drag and drop a file here or click',
        'replace': 'Drag and drop or click to replace',
        'remove':  'Remove',
        'error':   'Ooops, something wrong happended.'
    }
    });
    </script>

@endsection


