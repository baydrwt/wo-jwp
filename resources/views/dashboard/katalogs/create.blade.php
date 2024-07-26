@extends('dashboard.layouts.main')

@section('content')

<div class="col-lg-8 ms-4 mt-5">
    <form action="/dashboard/katalogs" method="post" class="mb-4" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name Product</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required autofocus value="{{ old('name') }}">
            @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
            @enderror
        </div>
        <div class="mb-3">
            @error('description')
                   <p class="text-danger">{{ $message }}</p> 
             @enderror
            <label for="description" class="form-label">descriptionription Product</label>
            <input id="description" type="hidden" name="description" value="{{ old('description') }}">
            <trix-editor input="description"></trix-editor>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price Product</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" required autofocus value="{{ old('price') }}">
            @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image Product</label>
            <img class="img-preview img-fluid col-sm-5 mb-3">
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mt-3">Create Product</button>
    </form>
</div>

<script>
      document.addEventListener('trix-file-accept', function(e){
            e.preventDefault();
        });

        function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFRevent){
            imgPreview.src = oFRevent.target.result;
        }}
</script>
@endsection