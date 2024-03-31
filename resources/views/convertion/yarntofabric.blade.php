@extends('layout.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center">
        <p class="page-indicate">Convertion/Yarn to Fabric</p>
        <div style="margin-top:10px;">
            <button class="btn main-color"><a href="/addyarntofabric" style="color:white"><i class="px-1 fa-solid fa-plus"></i>Create Convertion Contract</a></button>
        </div>
    </div>

    <div class="row my-4">
        <div class="col-md-12">
            @if(session('success'))
                <div id="successAlert" class="alert alert-success">
                   Yarn to Fabric Contract added successfully!
                </div>
                <script>
                    setTimeout(function(){
                        document.getElementById('successAlert').style.display = 'none';
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
            <div class="table-responsive ">
                <table class="table table-hover">
                    <thead class="main-color">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Contractee</th>
                            <th scope="col">Broker</th>
                            <th scope="col">Order in Meter</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Contract Date</th>
                            <th scope="col">Delivery Date</th>
                            <th scope="col">Record Add By</th>
                            <th scope="col">Print</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contracts as $index => $contract)
                            <tr>
                                <th scope="row">{{ $index+1 }}</th>
                                <td>{{ $contract->contractee }}</td>
                                <td>{{ $contract->broker }}</td>
                                <td>{{ $contract->order_meter }}</td>
                                <td>{{ $contract->payment_include_gst }}</td>
                                <td>{{ $contract->created_at->format('d-m-Y') }}</td>
                                <td>{{ $contract->delivery_date }}</td>
                                <td>{{ $contract->addby}}</td>
                                <td><i style="cursor: pointer" class="fa-solid fa-print" onclick="printInvoice({{ $contract->id }})"></i></td>
                                <td>
                                    <form action="{{ route('delete_yarntofabric', ['id' => $contract->id]) }}" method="post" style="display: inline;">
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
           
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
    function printInvoice(id) {
        window.open('/fabricetoYarninvoice/' + id, '_blank');
    }
    </script>
@endsection
