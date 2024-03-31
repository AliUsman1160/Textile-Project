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
        <p class="page-indicate">Account/Purachase/Add Amount</p>
    </div>

    <form class="custom-form mt-5" action="{{ route('savesupplieramout') }}" method="post">
        @csrf

        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="supplier">supplier</label>
                    <select class="form-control @error('supplier') is-invalid @enderror" id="supplier" name="supplier">
                        <option value="" selected disabled>Select supplier</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->name }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                    @error('supplier')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="debt">Debt</label>
                    <input type="number" class="form-control @error('debt') is-invalid @enderror" id="debt" name="debt" value="{{ old('debt') }}" readonly>
                    @error('debt')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="pay">Pay</label>
                    <input type="number" autocomplete="off" class="form-control @error('pay') is-invalid @enderror" id="pay" placeholder="1000" name="pay" value="{{ old('pay') }}">
                    @error('pay')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="pending">Pending</label>
                    <input type="number" step="any" class="form-control @error('pending') is-invalid @enderror" id="pending" name="pending" value="{{ old('pending') }}" readonly>
                    @error('pending')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="note">Note</label>
                <input type="text" autocomplete="off" class="form-control @error('note') is-invalid @enderror" id="note" name="note" placeholder="Add some note here." value="{{ old('note') }}">
                @error('note')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
            
        <div class="row">
            <div class="col-12 d-flex justify-content-center mt-3">
                <button type="submit" class="btn main-color">Add Amount</button>
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
        $('#supplier').on('change', function () {
            var selectedsupplier = $(this).val();

            var selectedsupplierData = @json($suppliers->keyBy('name')->toArray());

            if (selectedsupplier in selectedsupplierData) {
                var pendingPrice = selectedsupplierData[selectedsupplier].panding_price;
                $('#debt').val(pendingPrice);
            } else {
                $('#debt').val('');
            }
        });
        $('#pay').on('input', function () {
            var pay= $('#pay').val();
            var debt = $('#debt').val();
            if(pay>0 && debt>0){
                $('#pending').val(debt-pay);
            }else{
                $('#pending').val(debt);
            }
        });
        function showConfirmation() {
            return window.confirm("Please verify the amount; it is not editable. Are you sure you want to proceed?");
        }

        $('form').submit(function () {
            if (showConfirmation()) {
                return true; 
            } else {
                return false; 
            }
        });
        
    </script>
    
@endsection