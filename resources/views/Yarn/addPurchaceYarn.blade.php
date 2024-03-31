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
            <p class="page-indicate">Yarn/Purchase/Add</p>
        </div>

        <form class="custom-form mt-5" action="{{ route('addyarnpurchace') }}" method="post">
            @csrf

            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="bag">Bag</label>
                        <input type="number" class="form-control @error('bag') is-invalid @enderror" id="bag"
                            placeholder="10" name="bag" value="{{ old('bag') }}">
                        @error('bag')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="cones">Cones</label>
                        <input type="number" class="form-control @error('cones') is-invalid @enderror" id="cones"
                            placeholder="15" name="cones" value="{{ old('cones') }}">
                        @error('cones')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="count">Count</label>
                        <input type="number" class="form-control @error('count') is-invalid @enderror" id="count"
                            placeholder="30" name="count" value="{{ old('count') }}">
                        @error('count')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="type">Type</label>
                        <input type="text" class="form-control @error('type') is-invalid @enderror" id="type"
                            placeholder="cotton" name="type" value="{{ old('type') }}">
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="brand">Brand</label>
                        <input type="text" class="form-control @error('brand') is-invalid @enderror" id="brand"
                            placeholder="Brand Name" name="brand" value="{{ old('brand') }}">
                        @error('brand')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Add this code inside the form in addPurchaceYarn.blade.php -->
                
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="supplier">Supplier</label>
                            <select class="form-control @error('supplier') is-invalid @enderror" id="supplier"
                                name="supplier">
                                <option value="" selected disabled>Select Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->name }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                            @error('supplier')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
            
            </div>
            
            <div class="row my-4">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="price_bag">Price per Bag</label>
                        <input type="number" class="form-control @error('price_bag') is-invalid @enderror" id="price_bag"
                            placeholder="10,000" name="price_bag" value="{{ old('price_bag') }}">
                        @error('price_bag')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="broker">Broker</label>
                        <select class="form-control @error('broker') is-invalid @enderror" id="broker" name="broker">
                            <option value="" selected disabled>Select Broker</option>
                            @foreach ($brokers as $broker)
                                <option value="{{ $broker->name }}">{{ $broker->name }}</option>
                            @endforeach
                        </select>
                        @error('broker')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="total_price">Total Price</label>
                        <input type="number" class="form-control @error('total_price') is-invalid @enderror"
                            id="total_price" placeholder="100,000" name="total_price" value="{{ old('total_price') }}">
                        @error('total_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="pay_price">Pay Price</label>
                        <input type="number" class="form-control @error('pay_price') is-invalid @enderror"
                            id="pay_price" placeholder="100,000" name="pay_price" value="0">
                        @error('pay_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                {{-- <div class="col-lg-6 col-sm-12 mt-3">
                    <label for="payment_status">Payment Status</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="payment_status" id="payRadio"
                                value="pay" required>
                            <label class="form-check-label" for="payRadio">Pay</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="payment_status" id="notpayRadio"
                                value="notpay" required>
                            <label class="form-check-label" for="notpayRadio">Not Pay</label>
                        </div>
                    </div>
                    @error('payment_status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}
            </div>
            <div class="col-12 d-flex justify-content-center">
                <button type="submit" class="btn main-color">Add Purchase Yarn Record</button>
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

        $('#broker').select2({
        width: '100%', 
        containerCssClass: 'select2-custom-container', 
        });
    </script>
@endsection
