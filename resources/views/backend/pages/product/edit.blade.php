@extends('backend.master')

@section('content')
<div class="container">
<div class="row">
<br><h4 class="text-success text-center">Edit Product</h4>
<form action="{{route('product.update',$edit->id)}}" method="POST" enctype="multipart/form-data">
    @csrf

        @if(session('success'))
        <p class="alert alert-success"> {{session('success')}}</p>
         @endif

         <div class="row">

            <div class="col-md-6 mb-3">
                <label for="exampleInputName1" class="form-label">Product Name</label>
                <input type="text" class="form-control" value="{{$edit->name}}" id="exampleInputName1" name="name" placeholder="Product Name..">
                  @error('name')
                  <strong class="text-danger">{{$message}}</strong>
                  @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="exampleInputName1" class="form-label">Select Category</label>
                <select name="category_id" id="" class="form-control js-example-basic-single">
                    @foreach ($categories as $item)
                    <option value="{{$item->id}}">{{$item->type}}</option>
                    @endforeach
                </select>
            </div>

         </div>

         <div class="col-md-12 mb-3">
            <label for="exampleInputName1" class="form-label">Product Image</label>
            <input type="file" class="form-control dropify" value="{{$edit->image}}" name="image" placeholder="Product Image..">
                @error('image')
                <strong class="text-danger">{{$message}}</strong>
                @enderror
          </div>
          <div class="row">
            <div class="col-md-4 mb-3">
                <label for="exampleInputNumber" class="form-label">Stock</label>
                <input type="number" class="form-control" id="exampleInputNumber"  value="{{$edit->stock}}" name="stock" placeholder="500..">
                @error('stock')
                  <strong class="text-danger">{{$message}}</strong>
                @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="exampleInputNumber" class="form-label">Weight</label>
                    <input type="number" class="form-control" step="0.01"  value="{{$edit->weight}}" id="exampleInputName1" name="weight" placeholder="0.5kg..">
                    @error('weight')
                    <strong class="text-danger">{{$message}}</strong>
                    @enderror
            </div>
            <div class="col-md-4 mb-3" >
                <label for="exampleInputNumber3" class="form-label">Status</label>

                <select name="status" id="" class="form-control">
                    <option value="0">Inactive</option>
                    <option value="1">Active</option>
                </select>

                  @error('time')
                    <strong class="text-danger">{{$message}}</strong>
                   @enderror
            </div>
        </div>
        <div class="row">
        <div class="col-md-6 mb-3">
            <label for="exampleInputNumber" class="form-label">Price</label>
            <input type="number" class="form-control" id="exampleInputNumber"  value="{{$edit->price}}" name="price" placeholder="500..">
            @error('price')
            <strong class="text-danger">{{$message}}</strong>
            @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="exampleInputNumber" class="form-label">Dicount Price</label>
                <input type="number" class="form-control" id="exampleInputNumber"  value="{{$edit->discount}}" name="discount" placeholder="25%..">
                @error('discount')
                <strong class="text-danger">{{$message}}</strong>
                @enderror
        </div>

            
        </div>
              <div class="col-md-12 mb-3">
                <label for="exampleInputName1" class="form-label">Product Description</label>
                <textarea type="text" class="form-control" id="editor"  name="description" value="{{$edit->description}}" placeholder="Write product description here.." style="height: 100px;">{{$edit->description}}</textarea>
                @error('description')

                <strong class="text-danger">{{$message}}</strong>

                @enderror

              </div>

              <div class="col-md-12 mb-3">
                <label for="exampleInputName1" class="form-label">Product Information</label>
                <textarea class="form-control" id="editor2" name="product_information"  placeholder="Write more details about your product  here.." style="height: 150px;"> {{$edit->product_information}}</textarea>
                @error('product_information')
                <strong class="text-danger">{{$message}}</strong>
                @enderror
              </div>

              <br> <br>
      <div class="text-center">
        <button type="submit" class="btn btn-info">Edit Product</button>
      </div>
          </form>
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
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('#editor2'))
        .catch(error => {
            console.error(error);
        });
</script>

<style>
    #container {
        width: 1000px;
        margin: 20px auto;
    }

    .ck-editor__editable[role="textbox"] {
        /* editing area */
        min-height: 200px;
        width: 100%; /* Set width to 100% */
    }

    .ck-content .image {
        /* block images */
        max-width: 80%;
        margin: 20px auto;
    }
</style>
<script>
    $(document).ready(function() {
  $('.js-example-basic-single').select2();
});
              </script>
@endsection




