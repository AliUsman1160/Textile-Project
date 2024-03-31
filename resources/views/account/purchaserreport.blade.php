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
        <div class="row ">
            <h6 class="mt-3 text-secondary font-weight-bold">Purchaser: {{ $name }}</h6>
            <h6 class="mt-1 text-secondary font-weight-bold">Report Month: {{ $currentMonth }}</h6>
            <div class="col-md-12 mt-3">
                <h6 class="main-color p-2" style="display: inline-block">Yarn Record</h6>
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
                                
                                
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($yarnsales->count() > 0)
                                  
                                        @foreach($yarnsales as $index => $yarnsale)
                                        <tr>
                                            <th scope="row">{{  $index+1 }}</th>
                                            <td>{{ $yarnsale->bag }}</td>
                                            <td>{{ $yarnsale->cones }}</td>
                                            <td>{{ $yarnsale->count }}</td>
                                            <td>{{ $yarnsale->type }}</td>
                                            <td>{{ $yarnsale->brand }}</td>
                                            <td>{{ $yarnsale->purchaser }}</td>
                                            <td>{{ $yarnsale->price_bag }}</td>
                                            <td>{{ $yarnsale->broker }}</td>
                                            <td>{{ $yarnsale->total_price }}</td>
                                           
                                            <td>{{ $yarnsale->updated_at->format('d-m-Y') }}</td>
                                            
                                        </tr>
                                    @endforeach
                                   
                               
                            @else
                                <tr>
                                    <td colspan="15" class="text-center">No Record</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12 mt-3">
                <h6 class="main-color p-2" style="display: inline-block">Fabric Record</h6>
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
                                
                               
                                <th scope="col">Date</th>
                             
                            </tr>
                        </thead>
                        <tbody>
                            @if($fabricsales->count() > 0)
                              
                                        @foreach($fabricsales as $index => $fabricsale)
                                        <tr>
                                            <th scope="row">{{ 1 + $index }}</th>
                                            <td>{{ $fabricsale->quality }}</td>
                                            <td>{{ $fabricsale->meter }}</td>
                                            <td>{{ $fabricsale->weight }}</td>
                                            <td>{{ $fabricsale->price_per_meter }}</td>
                                            <td>{{ $fabricsale->purchaser }}</td>
                                            <td>{{ $fabricsale->total_price }}</td>
                                            
                                            
                                            <td>{{ $fabricsale->updated_at->format('d-m-Y') }}</td>
                                            
                                        </tr>
                                    @endforeach
                                  
                            @else
                                <tr>
                                    <td colspan="15" class="text-center">No Record</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="col-md-12 mt-3">
                <h6 class="main-color p-2" style="display: inline-block">Suit Record</h6>
                <div class="table-responsive ">
                    <table class="table table-hover">
                        <thead class="main-color">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Article</th>
                                <th scope="col">Meter</th>
                                <th scope="col">Thaan (Meter)</th>
                                <th scope="col">Total Thaan</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($salesuits->count() > 0)
                                
                                        @foreach ($salesuits as $index=> $salesuit)
                                            <tr>
                                                <td>{{$index+1}}</td>
                                                <td>{{$salesuit->variety}}</td>
                                                <td>{{$salesuit->meter}}</td>
                                                <td>{{$salesuit->thaanMeter}}</td>
                                                <td>{{$salesuit->totalThaan}}</td>
                                                <td>{{$salesuit->price}}</td>
                                                <td>{{$salesuit->totalPrice}}</td>
                                            <td>{{ $salesuit->updated_at->format('d-m-Y') }}</td>

                                            </tr>
                                        @endforeach
                                    
                            @else
                                <tr>
                                    <td colspan="15" class="text-center">No Record</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
