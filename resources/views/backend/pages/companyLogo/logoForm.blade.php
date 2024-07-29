@extends('backend.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="mx-auto mt-4 mb-4">
                <h4 class="text-success text-center">Logo</h4>
                <form action="{{ route('logo.store') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                    @csrf

                    @if(session('success'))
                        <p class="alert alert-success">{{ session('success') }}</p>
                    @endif

                    @if(session('error'))
                        <p class="alert alert-danger">{{ session('error') }}</p>
                    @endif

                    <div class="mb-3">
                        <label for="title" class="form-label">Logo Title (Optional)</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder=" Face wash..">
                        @error('title')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Upload Image <strong class="text-danger">*(MAX 1000kb)*</strong></label>
                        <input type="file" class="form-control dropify" id="dropify" name="image" value="{{ old('image') }}">
                        @error('image')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-info">+ Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('.dropify').dropify({
    messages: {
        'default': 'Logo',
        'replace': 'Drag and drop or click to replace',
        'remove':  'Remove',
        'error':   'Ooops, something wrong happended.'
    }
    });
    </script>
@endsection
