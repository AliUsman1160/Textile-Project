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
        <p class="page-indicate">Yarn/Sale/Update</p>
    </div>

    <form class="custom-form mt-5" action="{{ route('updatesuitsale', ['id' => $suitsale->id]) }}" method="post">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" placeholder="10" name="quantity" value="{{ old('quantity', $suitsale->quantity) }}">
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="type">Type</label>
                    <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" placeholder="Cotton" name="type" value="{{ old('type', $suitsale->type) }}">
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="color">Color</label>
                    <input type="text" class="form-control @error('color') is-invalid @enderror" id="color" placeholder="black" name="color" value="{{ old('color', $suitsale->color) }}">
                    @error('color')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" step="any" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="10,000" name="price" value="{{ old('price', $suitsale->price) }}">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="row my-4">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="received_price">Received price</label>
                    <input type="number" step="any" class="form-control @error('received_price') is-invalid @enderror" id="received_price" placeholder="10,000" name="received_price" value="{{ old('received_price', $suitsale->received_price) }}">
                    @error('received_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="purchaser">Purchaser</label>
                    <select class="form-control @error('purchaser') is-invalid @enderror" id="purchaser" name="purchaser">
                        <option value="" selected disabled>Select Purchaser</option>
                        @foreach ($purchasers as $purchaser)
                            <option value="{{ $purchaser->name }}" {{ old('purchaser', $suitsale->purchaser) == $purchaser->name ? 'selected' : '' }}>
                                {{ $purchaser->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('purchaser')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- <div class="col-lg-6 col-sm-12 mt-3">
                <label for="paymentStatus">Payment Status</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="paymentStatus" id="receivedRadio" value="received" {{ old('paymentStatus', $suitsale->payment_status) == 'received' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="receivedRadio">Received</label>
                    </div>
                    
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="paymentStatus" id="notReceivedRadio" value="notReceived" {{ old('paymentStatus', $suitsale->payment_status) == 'notReceived' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="notReceivedRadio">Not Received</label>
                    </div>
                </div>
            </div> --}}
        </div>
            
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <button type="submit" class="btn main-color">Update Sale Yarn Record</button>
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