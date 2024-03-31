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
        <p class="page-indicate">Fabric/Purchase</p>
        <div style="margin-top:10px;">
        <button id="filterButton" class="btn main-color">Filter</button>
            <button class="btn main-color"><a href="/purchase_fabric" style="color: white; text-decoration:none;">Remove Filters</a></button>
            <button class="btn main-color"><i class="fa-solid fa-plus"></i><a href="/add_purchase_fabric" style="color:white"> Add Purchase Fabric Record</a></button>
        </div>
    </div>

    <div id="filterContainer" class="conatiner-fluid" style="display: none;">
        <div class="row">
            <form class="custom-form mt-3"  action="{{ route('fabricpurchasefilter') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="supplier">Supplier</label>
                            <select class="form-control" id="supplier" name="supplier">
                                <option value="" selected disabled>Select supplier</option>
                                @foreach ($suppliers as $supplier)
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
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date"
                                name="date" value="{{ old('date') }}">
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <label for="payment_status">Payment Status</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="payment_status" id="payRadio"
                                    value="payed" >
                                <label class="form-check-label" for="payRadio">Payed</label>
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
                </div>
                
                <div class="row">
                    <div class="col-12 text-end">
                        <button type="submit" class="btn main-color mt-3">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row my-4">
        <div class="col-md-12">
            @if(session('add'))
                <div id="successAlert" class="alert alert-success">
                    purchase Fabric Record has been added successfully!
                </div>
                <script>
                    setTimeout(function(){
                        document.getElementById('successAlert').style.display = 'none';
                    }, 3000);
                </script>
            @endif
            @if(session('delete'))
            <div id="deleteAlert" class="alert alert-success">
                purchase Fabric Record has been deleted!
            </div>
            <script>
                setTimeout(function(){
                    document.getElementById('deleteAlert').style.display = 'none';
                }, 3000);
            </script>
            @endif

            @if(session('Update'))
            <div id="updateAlert" class="alert alert-success">
                purchase Fabric Record has been Updated!
            </div>
            <script>
                setTimeout(function(){
                    document.getElementById('updateAlert').style.display = 'none';
                }, 3000);
            </script>
            @endif

            @if(session('error'))
            <div id="error" class="alert alert-danger">
                Some thing went wrong.
            </div>
            <script>
                setTimeout(function(){
                    document.getElementById('error').style.display = 'none';
                }, 3000);
            </script>
            @endif

            <div class="table-responsive ">
                <table class="table table-hover">
                    <thead class="main-color">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Quality</th>
                            <th scope="col">Meter</th>
                            <th scope="col">Weight</th>
                            <th scope="col">Price Meter</th>
                            <th scope="col">Supplier</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Payed Price</th>
                            <th scope="col">Pending Price</th>
                            <th scope="col">Paymen Status</th>
                            <th scope="col">Record Add By</th>
                            <th scope="col">Date</th>
                            <th scope="col">Print</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fabricpurchases as $index => $fabricpurchase)
                            <tr>
                                <th scope="row">{{ $fabricpurchases->firstItem() + $index }}</th>
                              
                                <td>{{ $fabricpurchase->quality }}</td>
                                <td>{{ $fabricpurchase->meter }}</td>
                                <td>{{ $fabricpurchase->weight }}</td>
                                <td>{{ $fabricpurchase->price_per_meter }}</td>
                                <td>{{ $fabricpurchase->supplier }}</td>
                                <td>{{ $fabricpurchase->total_price }}</td>
                                <td>{{ $fabricpurchase->pay_price }}</td>
                                <td>{{ $fabricpurchase->panding_price }}</td>
                                <td>
                                    @if($fabricpurchase->paymentStatus == "payed")
                                        <span class="badge bg-success">Payed</span>
                                    @else
                                        <span class="badge bg-danger">pending</span>
                                    @endif
                                </td>
                                
                                <td>{{$fabricpurchase->addby}}</td>
                                <td>{{ $fabricpurchase->updated_at->format('d-m-Y') }}</td>
                                <td><i style="cursor: pointer" class="fa-solid fa-print" onclick="printInvoice({{ $fabricpurchase->id }})"></i></td>

                                <td>
                                    <form action="{{ route('edit_fabricpuracse', ['id' => $fabricpurchase->id]) }}" method="get" style="display: inline;">
                                        <button style="padding:0px;" type="submit" class="btn btn-link text-primary">
                                            <i class="fa-solid fa-pencil"></i> <!-- Assuming you have Font Awesome included in your project -->
                                        </button>
                                    </form>
                                </td>
                                <td>
                                
                                    <form action="{{ route('delete_fabricpurchase', ['id' => $fabricpurchase->id]) }}" method="post" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button style="padding: 0px;" type="submit" class="btn btn-link text-danger" onclick="return confirm('Are you sure you want to delete this item?')">
                                            <i style="padding: 0px;" class="fa-solid fa-trash"></i> <!-- Assuming you have Font Awesome included in your project -->
                                        </button>
                                    </form>
                                </td>
                                
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                {{ $fabricpurchases->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
</div>
@endsection
@section('script')
<script>
     function printInvoice(id) {
            window.open('/fabricpurchaseinvoice/' + id, '_blank');
        }
    $(document).ready(function () {
        $('#filterButton').click(function () {
            $('#filterContainer').slideToggle('slow');
        });
        $('#supplier').select2({
            width: '100%', // Set the width to 100% or adjust as needed
            containerCssClass: 'select2-custom-container', // Add a custom container class
        });
    });
</script>
@endsection