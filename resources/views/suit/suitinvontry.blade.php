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
        <p class="page-indicate">Suit/Invontry</p>
        <button class="btn main-color"><i class="fa-solid fa-plus"></i><a href="/addnewvariety" style="color:white"> Add Article in Invontry</a></button>
    </div>
    
    
    <div class="row my-4">
        <div class="col-md-12">
            @if(session('add'))
                <div id="successAlert" class="alert alert-success">
                   Article Record has been added successfully!
                </div>
                <script>
                    setTimeout(function(){
                        document.getElementById('successAlert').style.display = 'none';
                    }, 3000);
                </script>
            @endif
            @if(session('delete'))
            <div id="deleteAlert" class="alert alert-success">
                Article Record has been deleted!
            </div>
            <script>
                setTimeout(function(){
                    document.getElementById('deleteAlert').style.display = 'none';
                }, 3000);
            </script>
            @endif

            @if(session('update'))
            <div id="updateAlert" class="alert alert-success">
                Article Record has been Updated!
            </div>
            <script>
                setTimeout(function(){
                    document.getElementById('updateAlert').style.display = 'none';
                }, 3000);
            </script>
            @endif

            <div class="table-responsive ">
                <table class="table table-hover">
                    <thead class="main-color">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Article</th>
                            <th scope="col">Price</th>
                            <th scope="col">meter</th>
                            <th scope="col">Date</th>
                           
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($varieties as $index => $variety)
                            <tr>
                                <th scope="row">{{ $index+1 }}</th>
                                <td>{{ $variety->name }}</td>
                                <td>{{ $variety->price }}</td>
                                <td>{{ $variety->meter }}</td>
                                <td>{{ $variety->created_at->format('d-m-Y') }}</td>

                                
                                <td>
                                    <form action="{{ route('editsuitinvontry', ['id' => $variety->id]) }}" method="get" style="display: inline;">
                                        <button style="padding-right: 20px;" type="submit" class="btn btn-link text-primary">
                                            <i class="fa-solid fa-pencil"></i> <!-- Assuming you have Font Awesome included in your project -->
                                        </button>
                                    </form>
                                </td>
                                <td>
                                
                                    <form action="{{ route('deletesuitinvontory', ['id' => $variety->id]) }}" method="post" style="display: inline;">
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
                {{ $varieties->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
</div>
@endsection

@section('script')
   
   
@endsection
