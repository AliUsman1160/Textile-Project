@extends('layout.app')

@section('content')
    <p class="page-indicate">Users Page</p>
    
    <div class="row my-4">
        <div class="col-md-12">
            @if(session('active'))
            <div id="active" class="alert alert-success">
                Activate status updated successfully
            </div>
            <script>
                setTimeout(function(){
                    document.getElementById('active').style.display = 'none';
                }, 3000);
            </script>
            @endif

            @if(session('super'))
            <div id="super" class="alert alert-success">
                Super user status updated successfully.
            </div>
            <script>
                setTimeout(function(){
                    document.getElementById('super').style.display = 'none';
                }, 3000);
            </script>
            @endif

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="main-color">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Request Date</th>
                            <th scope="col">Super User</th>
                            <th scope="col">Active</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                            <tr>
                                <th scope="row">{{  $index+1 }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <form action="{{ route('changsuperstatus', ['id' => $user->id]) }}" method="post" style="display: inline;">
                                            @csrf
                                            @method('PUT') <!-- Use PUT method for updating -->
                                
                                            <input class="form-check-input" type="checkbox" id="superUserSwitch{{ $user->id }}" 
                                                {{ $user->super_user ? 'checked' : '' }}
                                                onchange="this.form.submit()">
                                        </form>
                                    </div>
                                </td>
                                                               
                                <td>
                                    <div class="form-check form-switch">
                                        <form action="{{ route('changactivatestatus', ['id' => $user->id]) }}" method="post" style="display: inline;">
                                            @csrf
                                            @method('PUT') <!-- Use PUT method for updating -->
                                
                                            <input class="form-check-input" type="checkbox" id="activateSwitch{{ $user->id }}" 
                                                {{ $user->activate ? 'checked' : '' }}
                                                onchange="this.form.submit()">
                                        </form>
                                    </div>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
