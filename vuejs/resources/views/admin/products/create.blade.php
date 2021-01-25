@extends('admin.layouts.app')
@section('title', 'Tao san pham moi')
@section('content')
    <h1 style="text-align: center">Create Products</h1>
    <h1>{{ (session('message') ? session('message') : " ") }}</h1>
    <div class="error">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>


    <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" value="{{ old('name') }}" name="name" class="form-control"  aria-describedby="emailHelp" placeholder="ENTER NAME">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Desc</label>
            <input type="text" value="{{ old('description') }}" name="description" class="form-control"  placeholder="Description">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Price</label>
            <input type="text" value="{{ old('price') }}" name="price" class="form-control"   placeholder="Price">
        </div>
        <div class="form-group">
            <label for="exampleFormControlFile1">Image</label>
            <input type="file" name="image" class="form-control-file">
        </div>

        <div class="form-group">
            <label for="exampleFormControlFile1">Model Machine</label>
            <select name="manufacturer_id" class="form-control">
                @forelse($manufacturers as $m)
                <option value="{{ $m->id }}">{{ $m->name }}</option>
                @empty
                    <option>No data</option>
                @endforelse
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlFile1">Category id</label>
            <select name="category_id" class="form-control">
                @forelse($categories as $ca)
                    <option value="{{ $ca->id }}">{{ $ca->name }}</option>
                @empty
                    <option>No data</option>
                @endforelse
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@stop
@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/22.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                console.log( editor );
            })
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
