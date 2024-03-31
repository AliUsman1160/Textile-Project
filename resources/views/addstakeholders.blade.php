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
            <p class="page-indicate">Add Stakeholders</p>
        </div>
        @if (session('success'))
            <div id="successAlert" class="alert alert-success">
                Record added successfully!
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('successAlert').style.display = 'none';
                }, 3000);
            </script>
        @endif
        @if (session('error'))
        <div id="erroralert" class="alert alert-danger">
            Record already exists! Please change the name.
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('erroralert').style.display = 'none';
            }, 5000);
        </script>
        @endif

        <div class="container">
            <form action="{{ route('supplierstore') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="supplierName" class="form-label">Add Supplier</label>
                    <div class="row">
                        <div class="col-md-10">
                            <input type="text"  class="form-control" id="supplier" value="{{ old('supplier') }}" placeholder="Ali Usman" name="supplier">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn main-color w-100">Add Supplier</button>
                        </div>
                    </div>
                </div>
            </form>

            <form class="mt-4" action="{{ route('purchaserstore') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="purchaserName" class="form-label">Add purchaser</label>
                    <div class="row">
                        <div class="col-md-10">
                            <input type="text"  class="form-control" id="purchaser" value="{{ old('purchaser') }}" placeholder="Ali Usman" name="purchaser">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn main-color w-100">Add purchaser</button>
                        </div>
                    </div>
                </div>
            </form>

            <form class="mt-4" action="{{ route('brokerstore') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="brokerName" class="form-label">Add broker</label>
                    <div class="row">
                        <div class="col-md-10">
                            <input type="text"  class="form-control" id="broker" value="{{ old('broker') }}" placeholder="Ali Usman" name="broker">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn main-color w-100">Add broker</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>


    </div>
@endsection
