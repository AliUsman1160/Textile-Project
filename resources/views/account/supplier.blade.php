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
        <p class="page-indicate">Account/Supplier</p>
        <div style="margin-top:10px;">
        <button id="filterButton" class="btn main-color">Filter</button>
        <button class="btn main-color"><a href="/supplieraccounts" style="color: white; text-decoration:none;">Remove Filters</a></button>
        <button class="btn main-color"><i class="px-1 fa-solid fa-plus"></i><a href="/addsupplieramount" style="color: white; text-decoration:none;">Add Amount</a></button>
    </div>
    </div>
    <div class="row my-2">
        @if(session('success'))
                <div id="successAlert" class="alert alert-success">
                    Amount saved successfully!
                </div>
                <script>
                    setTimeout(function(){
                        document.getElementById('successAlert').style.display = 'none';
                    }, 3000);
                </script>
            @endif
    </div>
    <div id="filterContainer" class="conatiner-fluid" style="display: none;">
        <div class="row">
            <form class="custom-form mt-3"  action="{{ route('supplieraccountfilter') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="supplier">Supplier</label>
                            <select class="form-control" id="supplier" name="supplier">
                                <option value="" selected disabled>Select supplier</option>
                                @foreach ($suppliersfilters as $supplier)
                                    <option value="{{ $supplier->name }}" >
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('supplier')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <label for="payment_status">Payment Status</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="payment_status" id="payRadio"
                                    value="clear" >
                                <label class="form-check-label" for="payRadio">Clear</label>
                            </div>
    
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="payment_status" id="notpayRadio"
                                    value="Pending" >
                                <label class="form-check-label" for="notpayRadio">Pending</label>
                            </div>
                        </div>
                        @error('payment_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <button type="submit" class="btn main-color mt-3">Submit</button>
                    </div>                  
                </div>
            </form>
        </div>
    </div>
</div>

    

    <div class="row my-4">
        <div class="col-md-12">
            <div class="table-responsive ">
                <table class="table table-hover">
                    <thead class="main-color">
                        <tr>
                            <th scope="col">Supplier id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Pending Price to Pay</th>
                            <th scope="col">Payment Status</th>
                            <th scope="col">Current Month Report</th>
                            <th scope="col">Last Month Report</th>
                            <th scope="col">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suppliers as $index => $supplier)
                            <tr>
                                <td>{{ $supplier->id }}</td>
                                <td>{{ $supplier->name }}</td>
                                <td>{{ $supplier->panding_price }}</td>
                                <td>
                                    @if($supplier->panding_price == 0)
                                        <span class="badge bg-success">Clear</span>
                                    @else
                                        <span class="badge bg-danger">pending</span>
                                    @endif
                                </td>
                                <td><a href="/supplierreport/{{ $supplier->name }}"><span style="background-color: #212529" class="badge">Current Month</span></i></a></td>
                                <td><a href="/supplierlastreport/{{ $supplier->name }}"><span style="background-color: #212529" class="badge">Last Month</span></i></a></td>
                                <td><a href="/supplierdetail/{{ $supplier->name }}"><span class="badge bg-primary">Detail</span></a></td>

                            </tr>
                        @endforeach
                       
                    </tbody>
                </table>
            </div>
            <div>
                {{ $suppliers->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#filterButton').click(function () {
                $('#filterContainer').slideToggle('slow');
            });
            $('#supplier').select2({
                width: '100%',
                containerCssClass: 'select2-custom-container',
            });
        });
    </script>
@endsection