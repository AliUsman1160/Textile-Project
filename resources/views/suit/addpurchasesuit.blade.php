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
        <p class="page-indicate">Suit/Purchase/Add</p>
        <div style="margin-top:10px;">
            <button id="filterButton" class="btn main-color"><a style="color: #ddd" href="/addnewvariety"><i class="px-1 fa-solid fa-plus"></i>Add new Article</a></button>
        </div>
    </div>

    <form class="custom-form mt-5" action="{{ route('addsuitpurachase') }}" method="post">
        @csrf

        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="variety">Article</label>
                    <select class="form-control @error('variety') is-invalid @enderror" id="variety" name="variety">
                        <option value="" selected disabled>Select article</option>
                        @foreach ($varities as $variety)
                            <option value="{{ $variety->name }}">{{ $variety->name }}</option>
                        @endforeach
                    </select>
                    @error('variety')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="meter">Meter</label>
                    <input type="number" class="form-control @error('meter') is-invalid @enderror" id="meter" placeholder="100" name="meter" value="{{ old('meter') }}">
                    @error('meter')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" step="any" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="10,000" name="price" value="{{ old('price') }}">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="pay_price">Pay price</label>
                    <input type="number" step="any" class="form-control @error('pay_price') is-invalid @enderror" id="pay_price" placeholder="10,000" name="pay_price" value="0">
                    @error('pay_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="row my-4">
            
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="supplier">Supplier</label>
                    <select class="form-control @error('supplier') is-invalid @enderror" id="supplier" name="supplier">
                        <option value="" selected disabled>Select Supplier</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->name }}" {{ old('supplier') == $supplier->name ? 'selected' : '' }}>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('supplier')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

        </div>
            
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <button type="submit" class="btn main-color">Add Purcahse Suit Record</button>
            </div>
        </div>
    </form>

</div>
@endsection


@section('script')
    <script>
        $('#supplier').select2({
        width: '100%', 
        containerCssClass: 'select2-custom-container', 
        });
        $('#variety').select2({
        width: '100%', 
        containerCssClass: 'select2-custom-container', 
        });
    </script>
@endsection