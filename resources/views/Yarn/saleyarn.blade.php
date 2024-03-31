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
        <p class="page-indicate">Yarn/Sale</p>
        <div style="margin-top:10px;">
            <button id="filterButton" class="btn main-color">Filter</button>
            <button class="btn main-color"><a href="/slae_yarn" style="color: white; text-decoration:none;">Remove Filters</a></button>
            {{-- <button class="btn main-color"><i  class="fa-solid fa-chart-simple"></i><a href="/sale_yarn_payments" style="padding-left:5px;color:white">Payments Not Received</a></button> --}}
            <button class="btn main-color"><i class="fa-solid fa-plus"></i><a href="/add_slae_yarn" style="padding-left:5px; color:white">Add Sale Yarn</a></button>
        </div>
    </div>

   
    

    <div id="filterContainer" class="conatiner-fluid" style="display: none;">
        <div class="row">
            <form class="custom-form mt-3"  action="{{ route('yarnsalefilter') }}" method="post">
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
                    Sale Yarn Record has been added successfully!
                </div>
                <script>
                    setTimeout(function(){
                        document.getElementById('successAlert').style.display = 'none';
                    }, 3000);
                </script>
            @endif
            @if(session('delete'))
            <div id="deleteAlert" class="alert alert-success">
                Sale Yarn Record has been deleted!
            </div>
            <script>
                setTimeout(function(){
                    document.getElementById('deleteAlert').style.display = 'none';
                }, 3000);
            </script>
            @endif

            @if(session('Update'))
            <div id="updateAlert" class="alert alert-success">
                Sale Yarn Record has been Updated!
            </div>
            <script>
                setTimeout(function(){
                    document.getElementById('updateAlert').style.display = 'none';
                }, 3000);
            </script>
            @endif

            
            @if(session('invontry_error'))
            <div id="invontry_errorAlert" class="alert alert-danger">
                You are trying to sell more bags than exist in your inventory.!
            </div>
            <script>
                setTimeout(function(){
                    document.getElementById('invontry_errorAlert').style.display = 'none';
                }, 5000);
            </script>
            @endif

            

            <div class="table-responsive ">
                <table class="table table-hover">
                    <thead class="main-color">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Bag</th>
                            <th scope="col">Cones</th>
                            <th scope="col">Count</th>
                            <th scope="col">Type</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Purchaser</th>
                            <th scope="col">price</th>
                            <th scope="col">Broker</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Received Price</th>
                            <th scope="col">Pending Price</th>
                            <th scope="col">Payment</th>
                            <th scope="col">Record Add By</th>
                            <th scope="col">Date</th>
                            <th scope="col">Print</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($yarnsales as $index => $yarnsale)
                            <tr>
                                <th scope="row">{{ $yarnsales->firstItem() + $index }}</th>
                                <td>{{ $yarnsale->bag }}</td>
                                <td>{{ $yarnsale->cones }}</td>
                                <td>{{ $yarnsale->count }}</td>
                                <td>{{ $yarnsale->type }}</td>
                                <td>{{ $yarnsale->brand }}</td>
                                <td>{{ $yarnsale->purchaser }}</td>
                                <td>{{ $yarnsale->price_bag }}</td>
                                <td>{{ $yarnsale->broker }}</td>
                                <td>{{ $yarnsale->total_price }}</td>
                                <td>{{ $yarnsale->received_price }}</td>
                                <td>{{ $yarnsale->panding_price }}</td>
                                <td>
                                    @if($yarnsale->payment_status == "received")
                                        <span class="badge bg-success">Received</span>
                                    @else
                                        <span class="badge bg-danger">pending</span>
                                    @endif
                                </td>
                                <td>{{$yarnsale->addby}}</td>
                                <td>{{ $yarnsale->updated_at->format('d-m-Y') }}</td>
                                <td><i style="cursor: pointer" class="fa-solid fa-print" onclick="printInvoice({{ $yarnsale->id }})"></i></td>
                                <td>
                                    <form action="{{ route('edit_yarnsale', ['id' => $yarnsale->id]) }}" method="get" style="display: inline;">
                                        <button style="padding: 0px;" type="submit" class="btn btn-link text-primary">
                                            <i class="fa-solid fa-pencil"></i> <!-- Assuming you have Font Awesome included in your project -->
                                        </button>
                                    </form>
                                </td>
                                <td>
                                
                                    <form action="{{ route('delete_yarnsale', ['id' => $yarnsale->id]) }}" method="post" style="display: inline;">
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
                {{ $yarnsales->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        function printInvoice(id) {
            window.open('/print-invoice/' + id, '_blank');
        }
    </script>
    <script>
        $(document).ready(function () {
            $('#filterButton').click(function () {
                $('#filterContainer').slideToggle('slow');
            });
        });
    </script>
     <script>
        $('#purchaser').select2({
            width: '100%', // Set the width to 100% or adjust as needed
            containerCssClass: 'select2-custom-container', // Add a custom container class
        });
</script>
@endsection