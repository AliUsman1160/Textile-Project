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
            <h4 class="mt-3 text-secondary font-weight-bold">Purchaser: {{ $name }}</h4>
            <div class="col-md-12 ">
                <div class="table-responsive">
                    <table class="table table-hover mt-2">
                        <thead class="main-color">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Note</th>
                                <th scope="col">Debt</th>
                                <th scope="col">Credit</th>
                                <th scope="col">Pending</th>
                                <th scope="col">Date</th>
                                <th scope="col">Record Add By</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $index=> $transaction)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $transaction->note }}</td>
                                    <td>{{ number_format($transaction->debt, 0, '.', '') }}</td>
                                    <td>{{ number_format($transaction->credit, 0, '.', '') }}</td>
                                    <td>{{ number_format($transaction->pending, 0, '.', '') }}</td>
                                    <td>{{ $transaction->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $transaction->addby }}</td>
                                    
                                    <td>
                                        <form action="{{ route('deletepurchaserdetail', ['id' => $transaction->id]) }}" method="post" style="display: inline;">
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
</div>
@endsection

