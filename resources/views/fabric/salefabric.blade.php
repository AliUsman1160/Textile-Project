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
        <p class="page-indicate">Fabric/Sale</p>
        <div style="margin-top:10px;">
            <button id="filterButton" class="btn main-color">Filter</button>
            <button class="btn main-color"><a href="/slae_fabric" style="color: white; text-decoration:none;">Remove Filters</a></button>
            <button class="btn main-color"><i class="fa-solid fa-plus"></i><a href="/add_slae_fabric" style="color:white"> Add Sale Fabric Record</a></button>
        </div>
    </div>

    <div id="filterContainer" class="conatiner-fluid" style="display: none;">
        <div class="row">
            <form class="custom-form mt-3"  action="{{ route('fabricsalefilter') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="purchaser">Purchaser</label>
                            <select class="form-control" id="purchaser" name="purchaser">
                                <option value="" selected disabled>Select Purchaser</option>
                                @foreach ($purchasers as $purchaser)
                                    <option value="{{ $purchaser->name }}" >
                                        {{ $purchaser->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('purchaser')
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
                        <div class="mb-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="payment_status" id="receivedRadio"
                                    value="received">
                                <label class="form-check-label" for="receivedRadio">Received</label>
                            </div>
                
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="payment_status" id="notReceivedRadio"
                                    value="pending">
                                <label class="form-check-label" for="notReceivedRadio">Pending</label>
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
                    Sale Fabric Record has been added successfully!
                </div>
                <script>
                    setTimeout(function(){
                        document.getElementById('successAlert').style.display = 'none';
                    }, 3000);
                </script>
            @endif
            @if(session('delete'))
            <div id="deleteAlert" class="alert alert-success">
                Sale Fabric Record has been deleted!
            </div>
            <script>
                setTimeout(function(){
                    document.getElementById('deleteAlert').style.display = 'none';
                }, 3000);
            </script>
            @endif
            @if(session('invontry_error'))
            <div id="invontry_errorAlert" class="alert alert-danger">
                You are trying to sell more bags than exist in your inventory. check invontry!
            </div>
            <script>
                setTimeout(function(){
                    document.getElementById('invontry_errorAlert').style.display = 'none';
                }, 5000);
            </script>
            @endif

            @if(session('Update'))
            <div id="updateAlert" class="alert alert-success">
                Sale Fabric Record has been Updated!
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
                            <th scope="col">Quallity</th>
                            <th scope="col">Meter</th>
                            <th scope="col">Weight</th>
                            <th scope="col">Price</th>
                            <th scope="col">Purchaser</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Received Price</th>
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
                        @foreach($fabricsales as $index => $fabricsale)
                            <tr>
                                <th scope="row">{{ $fabricsales->firstItem() + $index }}</th>
                                <td>{{ $fabricsale->quality }}</td>
                                <td>{{ $fabricsale->meter }}</td>
                                <td>{{ $fabricsale->weight }}</td>
                                <td>{{ $fabricsale->price_per_meter }}</td>
                                <td>{{ $fabricsale->purchaser }}</td>
                                <td>{{ $fabricsale->total_price }}</td>
                                <td>{{ $fabricsale->received_price }}</td>
                                <td>{{ $fabricsale->panding_price }}</td>
                                <td>
                                    @if($fabricsale->paymentStatus == "received")
                                        <span class="badge bg-success">Received</span>
                                    @else
                                        <span class="badge bg-danger">pending</span>
                                    @endif
                                </td>
                                
                                <td>{{$fabricsale->addby}}</td>
                                <td>{{ $fabricsale->updated_at->format('d-m-Y') }}</td>
                                <td><i style="cursor: pointer" class="fa-solid fa-print" onclick="printInvoice({{ $fabricsale->id }})"></i></td>
                                <td>
                                    <form action="{{ route('edit_fabricsale', ['id' => $fabricsale->id]) }}" method="get" style="display: inline;">
                                        <button style="padding-right: 20px;" type="submit" class="btn btn-link text-primary">
                                            <i class="fa-solid fa-pencil"></i> <!-- Assuming you have Font Awesome included in your project -->
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('delete_fabricsale', ['id' => $fabricsale->id]) }}" method="post" style="display: inline;">
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
                {{ $fabricsales->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
</div>
@endsection

@section('script')
<script>
   
    function printInvoice(id) {
        window.open('/Salefabricinvoice/' + id, '_blank');
    }
    $(document).ready(function () {
        $('#filterButton').click(function () {
            $('#filterContainer').slideToggle('slow');
        });
    });
    $('#purchaser').select2({
        width: '100%', // Set the width to 100% or adjust as needed
        containerCssClass: 'select2-custom-container', // Add a custom container class
    });
</script>
@endsection
