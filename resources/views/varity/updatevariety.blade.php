@extends('layout.app')

@section('style')
<style>
    .custom-form {
        border: 2px solid #ddd;
        border-radius: 20px;
        padding: 15px;
        box-shadow: 5px 5px 2px 2px rgb(227, 227, 227);
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center">
        <p class="page-indicate">Varity/Add</p>
        
    </div>

    <form class="custom-form mt-5" action="{{ route('updatevarity', ['id' => $variety->id]) }}" method="post">
        @csrf
        @method('PUT') 

        <div class="row my-2">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Silk" name="name" value="{{ old('name', $variety->name) }}" readonly>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" step="any" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="10,000" name="price" value="{{ old('price', $variety->price) }}">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="row my-4">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="meter">Meter</label>
                    <input type="number" step="any" class="form-control @error('meter') is-invalid @enderror" id="meter" placeholder="100" name="meter"value="{{ old('meter', $variety->meter) }}">
                    @error('meter')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
            
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <button type="submit" class="btn main-color">Add new Varity</button>
            </div>
        </div>
    </form>

</div>
@endsection

@section('script')
    <script>
        $('#purchaser').select2({
        width: '100%', 
        containerCssClass: 'select2-custom-container', 
        });
    </script>
@endsection
