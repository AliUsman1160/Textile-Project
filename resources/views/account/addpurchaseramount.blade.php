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

    <form class="custom-form mt-5" action="{{ route('savepurchaseramout') }}" method="post">
        @csrf

        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="purchaser">Purchaser</label>
                    <select class="form-control @error('purchaser') is-invalid @enderror" id="purchaser" name="purchaser">
                        <option value="" selected disabled>Select Purchaser</option>
                        @foreach ($purchasers as $purchaser)
                            <option value="{{ $purchaser->name }}">{{ $purchaser->name }}</option>
                        @endforeach
                    </select>
                    @error('purchaser')
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
                    <label for="credit">Credit</label>
                    <input type="number" autocomplete="off" class="form-control @error('credit') is-invalid @enderror" id="credit" placeholder="1000" name="credit" value="{{ old('credit') }}">
                    @error('credit')
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
        $('#purchaser').select2({
        width: '100%', 
        containerCssClass: 'select2-custom-container', 
        });
        $('#purchaser').on('change', function () {
            var selectedPurchaser = $(this).val();

            var selectedPurchaserData = @json($purchasers->keyBy('name')->toArray());

            if (selectedPurchaser in selectedPurchaserData) {
                var pendingPrice = selectedPurchaserData[selectedPurchaser].panding_price;
                $('#debt').val(pendingPrice);
            } else {
                $('#debt').val('');
            }
        });
        $('#credit').on('input', function () {
            var credit= $('#credit').val();
            var debt = $('#debt').val();
            if(credit>0 && debt>0 && (debt-credit)>=0){
                $('#pending').val(debt-credit);
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