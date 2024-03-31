@extends('layout.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center">
        <p class="page-indicate">Convertion/Fabric to Suit</p>
        <div style="margin-top:10px;">
            <button class="btn main-color"><a href="/addfabrictosuit" style="color:white"><i class="px-1 fa-solid fa-plus"></i>Add Fabric to Suit</a></button>
        </div>
    </div>

    <div class="row my-4">
        <div class="col-md-12">
            @if(session('success'))
                <div id="successAlert" class="alert alert-success">
                   Fabric to suit Contract added successfully!
                </div>
                <script>
                    setTimeout(function(){
                        document.getElementById('successAlert').style.display = 'none';
                    }, 3000);
                </script>
            @endif

            @if(session('Update'))
                <div id="UpdateAlert" class="alert alert-success">
                Fabric to suit update successfully!
                </div>
                <script>
                    setTimeout(function(){
                        document.getElementById('UpdateAlert').style.display = 'none';
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

            @if(session('delete'))
                <div id="deleteAlert" class="alert alert-success">
                Fabric to suit delete successfully!
                </div>
                <script>
                    setTimeout(function(){
                        document.getElementById('deleteAlert').style.display = 'none';
                    }, 3000);
                </script>
            @endif

            @if(session('error'))
                <div id="errorAlert" class="alert alert-danger">
                    Something went wrong.
                </div>
                <script>
                    setTimeout(function(){
                        document.getElementById('errorAlert').style.display = 'none';
                    }, 3000);
                </script>
            @endif

            <div class="table-responsive ">
                <table class="table table-hover">
                    <thead class="main-color">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Quality</th>
                            <th scope="col">Send to Dyeing</th>
                            <th scope="col">Dyeing cost (meter)</th>
                            <th scope="col">Reject</th>
                            <th scope="col">Pass</th>
                            <th scope="col">Article</th>
                            <th scope="col">Record Add By</th>
                            <th scope="col">Date</th>
                            <th scope="col">Print</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $index => $record)
                            <tr>
                                <th scope="row">{{ $index+1 }}</th>
                                <td>{{ $record->quality }}</td>
                                <td>{{ $record->sendtodyeing }}</td>
                                <td>{{ $record->cost }}</td>
                                <td>{{ $record->reject }}</td>
                                <td>{{ $record->pass }}</td>
                                <td>{{ $record->varity }}</td>
                                <td>{{ $record->addby}}</td>
                                <td>{{ $record->created_at->format('d-m-Y') }}</td>
                                <td><i style="cursor: pointer" class="fa-solid fa-print" onclick="printInvoice({{ $record->id }})"></i></td>
                                <td>
                                    <form action="{{ route('editfarictosuit', ['id' => $record->id]) }}" method="get" style="display: inline;">
                                        <button style="margin-top: -5px;" type="submit" class="btn btn-link text-primary">
                                            <i class="fa-solid fa-pencil"></i> <!-- Assuming you have Font Awesome included in your project -->
                                        </button>
                                    </form>
                                </td>
                                <td>
                                
                                    <form action="{{ route('deletefabrictosuit', ['id' => $record->id]) }}" method="post" style="display: inline;">
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
        window.open('/fabrictosuitinvoice/' + id, '_blank');
    }
    </script>
@endsection
