@extends('layout.app')

@section('style')
<style>
    .custom-form {
        border: 2px solid #ddd;
        border-radius: 20px;
        padding: 15px;
        box-shadow: 5px 5px 2px 2px rgb(227, 227, 227);
    }
    .custom-form2 {
        background-color: rgb(255, 255, 255);
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
        <p class="page-indicate">Suit/Sale/Add</p>
        <div style="margin-top:10px;">
            <button id="filterButton" class="btn main-color"><a style="color: #ddd" href="/addnewvariety"><i class="px-1 fa-solid fa-plus"></i>Add new Article</a></button>
        </div>
    </div>

    <form class=" mt-5" action="{{ route('addsuitsale') }}" method="post">
        @csrf
        <div class="row custom-form">
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
                    <label for="total_bill">Total Bill</label>
                    <input type="number" step="any" class="form-control @error('total_bill') is-invalid @enderror" id="total_bill"  name="total_bill" readonly>
                    @error('total_bill')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

        </div>

        <div class="varityfields custom-form2 mt-4">

        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="variety">Article</label>
                    <select class="form-control @error('variety') is-invalid @enderror" id="variety" name="variety">
                        <option value="" selected disabled>Select article</option>
                        @foreach ($varieties as $variety)
                            <option value="{{ $variety->name }}">{{ $variety->name }}</option>
                        @endforeach
                    </select>
                    @error('variety')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
           
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" step="any" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="10,000" name="price" value="{{ old('price') }}">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
        </div>
        <div class="row my-4">
           
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="meter">Meter</label>
                    <input type="text" class="form-control @error('meter') is-invalid @enderror" id="meter" placeholder="500" name="meter" value="{{ old('meter') }}">
                    @error('meter')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="thaan_meter">Thaan (meter)</label>
                    <input type="number" step="any" class="form-control @error('thaan_meter') is-invalid @enderror" id="thaan_meter" placeholder="100" name="thaan_meter" value="{{ old('thaan_meter') }}">
                    @error('thaan_meter')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="row my-4">
             <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="total_thaan">Total Thaan</label>
                    <input type="number" step="any" class="form-control @error('total_thaan') is-invalid @enderror" id="total_thaan" placeholder="10" name="total_thaan" readonly>
                    @error('total_thaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="total_price">Total price</label>
                    <input type="number" step="any" class="form-control @error('total_price') is-invalid @enderror" id="total_price" placeholder="10,000" name="total_price"  readonly>
                    @error('total_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row ">
          
            <div class="col-lg-6 col-sm-12 mt-2">
                <button type="button" id="addVarietyButton" class="btn main-color">Add New Variety to Bill</button>
            </div>
        </div>
    </div>
       
        <div class="addedvariteies mt-3">

        </div>
        <input type="hidden" name="added_varieties" id="added_varieties" value="">
        <input type="hidden" name="purchaser" id="purchaser_input" value="">

            
        <div class="row mt-3">
            <div class="col-12 d-flex justify-content-center">
                <button type="submit" class="btn main-color">Save Sale Suit Record</button>
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

        $('#variety').select2({
        width: '100%', 
        containerCssClass: 'select2-custom-container', 
        });
    </script>

    <script>
        $(document).ready(function() {
            var varietiesData = {!! $varieties->map(function ($variety) {
                return [$variety->name, $variety->price, $variety->meter];
            }) !!};
            var originalmeter = 0;
            var meteradd = 0;
            var addedVarieties = [];

            $('#variety').on('change', function() {
                var selectedVariety = $(this).val();
                var selectedData = varietiesData.find(function(variety) {
                    return variety[0] === selectedVariety;
                });
                if (selectedData) {
                    originalmeter = selectedData[2];
                    $('#price').val(selectedData[1]);
                    $('#meter').val(selectedData[2]);
                    $('#total_price').val(selectedData[1] * selectedData[2]);
                } 
            });

            $('#thaan_meter').on('input', function() {
                var thaanmeter = $(this).val(); 
                var meter = $('#meter').val();
                if (thaanmeter > 0) {
                    $('#total_thaan').val(meter / thaanmeter);
                }
            });

            $('#price, #meter').on('input', function() {
                var price = $('#price').val(); 
                var meter = $('#meter').val();
                if (meter > 0 && price > 0) {
                    $('#total_price').val(price * meter);
                }
            });

            $('#addVarietyButton').on('click', function(e) {
                var variety = $('#variety').val();
                var price = $('#price').val();
                var meter = $('#meter').val();
                var totalPrice = $('#total_price').val();
                
                var thaanMeter = $('#thaan_meter').val();
                var totalThaan = $('#total_thaan').val();

                if (variety && price && meter) {
                    if(meter<=originalmeter){
                        var varietyData = {
                            variety: variety,
                            price: price,
                            meter: meter,
                            totalPrice:totalPrice,
                            // receivedPrice: receivedPrice,
                            thaanMeter:thaanMeter>0?thaanMeter:0,
                            totalThaan: totalThaan>0?totalThaan:0,
                        };
                        addedVarieties.push(varietyData);
                        originalmeter = 0;
                    }else{
                        alert("Only "+originalmeter+" meter is available. so enter less than or equal to "+originalmeter+" meter.");
                    }

                    $('#variety, #price, #meter, #total_thaan').val('');
                    $('#received_price').val(0);
                    updateAddedVarietiesTable();
                } else {
                    // Handle the case where not all fields are filled
                    alert('Please fill in all the fields before adding a new variety.');
                }
                $('#added_varieties').val(JSON.stringify(addedVarieties));
            });

            // Function to delete a specific variety from the array
            $(document).on('click', '.delete-variety', function() {
                var index = $(this).data('index');
                addedVarieties.splice(index, 1);
                updateAddedVarietiesTable();
            });
            $('form').submit(function() {
                $('#purchaser_input').val($('#purchaser').val());
            });

            function updateAddedVarietiesTable() {
                // Clear the existing table
                $('.addedvariteies').empty();

                // Create a new table
                var table = $('<table class="table"></table>');
                var header = '<thead class="main-color"><tr><th>Variety</th><th>Price</th><th>Meter</th><th>Total Price</th><th>Thaan Meter</th><th>Total Thaan</th><th>Action</th></tr></thead>';
                table.append(header);

                var totalbill =0;
                for (var i = 0; i < addedVarieties.length; i++) {
                    var row = '<tr>';
                    row += '<td>' + addedVarieties[i].variety + '</td>';
                    row += '<td>' + addedVarieties[i].price + '</td>';
                    row += '<td>' + addedVarieties[i].meter + '</td>';
                    row += '<td>' + addedVarieties[i].totalPrice + '</td>';
                    // row += '<td>' + addedVarieties[i].receivedPrice + '</td>';
                    row += '<td>' + addedVarieties[i].thaanMeter + '</td>';
                    row += '<td>' + addedVarieties[i].totalThaan + '</td>';
                    row += '<td><button class="btn btn-link text-danger delete-variety" data-index="' + i + '" style="display: inline-block;"><i class="fa-solid fa-trash"></i></button></td>';
                    row += '</tr>';
                    table.append(row);
                    totalbill += Number(addedVarieties[i].totalPrice);
                }

                $('.addedvariteies').append(table);
                $("#total_bill").val(totalbill);
            }
        });

    </script>
        
@endsection



