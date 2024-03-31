@extends('layout.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center">
        <p class="page-indicate">Yarn/Sale/Payments</p>
    </div>

    <div class="row my-4">
        <div class="col-md-12">
            <div class="table-responsive ">
                <table class="table table-hover">
                    <thead class="main-color">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Purchaser</th>
                            <th scope="col">No. of Payments</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Status</th>
                    
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($salepayments as $index => $salepayment)
                            <tr>
                                <th scope="row">{{ $index+1 }}</th>
                                <td>{{ $salepayment->purchaser }}</td>
                                <td>{{ $salepayment->num_records }}</td>
                                <td>{{ $salepayment->total_price }}</td>
                                <td><span class="badge bg-danger">Not Received</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>
@endsection
