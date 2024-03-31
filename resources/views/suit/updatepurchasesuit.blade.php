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
    <div>
        <p class="page-indicate">Suit/Purchase/Update</p>
    </div>

    <form class="custom-form mt-5" action="{{ route('updatesuitpurchase', $suitpurchase->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="row">
           <div class="col-lg-6 col-sm-6">
            <div class="form-group">
                <label for="variety">Article</label>
                <select class="form-control @error('variety') is-invalid @enderror" id="variety" name="variety">
                    <option value="" selected disabled>Select variety</option>
                    @foreach ($varities as $variety)
                        <option value="{{ $variety->name }}" {{ old('variety', $suitpurchase->variety) == $variety->name ? 'selected' : '' }}>
                            {{ $variety->name }}
                        </option>
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
                    <input type="text" class="form-control @error('meter') is-invalid @enderror" id="meter" placeholder="Cotton" name="meter" value="{{ old('meter', $suitpurchase->meter) }}">
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
                    <input type="number" step="any" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="10,000" name="price" value="{{ old('price', $suitpurchase->price) }}">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="pay_price">Pay Price</label>
                    <input type="number" step="any" class="form-control @error('pay_price') is-invalid @enderror" id="pay_price" placeholder="10,000" name="pay_price" value="{{ old('pay_price', $suitpurchase->pay_price) }}">
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
                            <option value="{{ $supplier->name }}" {{ old('supplier', $suitpurchase->supplier) == $supplier->name ? 'selected' : '' }}>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('supplier')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- <div class="col-lg-6 col-sm-12 mt-3">
                <label for="paymentStatus">Payment Status</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="paymentStatus" id="payRadio" value="pay" {{ old('paymentStatus', $suitpurchase->payment_status) == 'pay' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="payRadio">Pay</label>
                    </div>
                    
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="paymentStatus" id="notpayRadio" value="notpay" {{ old('paymentStatus', $suitpurchase->payment_status) == 'notpay' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="notpayRadio">Not pay</label>
                    </div>
                </div>
            </div> --}}
        </div>
            
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <button type="submit" class="btn main-color">Update Purchase Suit Record</button>
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
    </script>
@endsection
