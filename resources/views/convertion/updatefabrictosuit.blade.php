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
        <p class="page-indicate">Convertion/Fabric to Suit/Update</p>
    </div>

    <form class="custom-form mt-5" action="{{ route('updatefabrictosuit', $fabrictosuit->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="quality">Quality</label>
                    <select class="form-control" id="quality" name="quality">
                        <option value="" selected disabled>Select Quality</option>
                        @foreach ($Qualities as $quality)
                            <option value="{{ $quality->quality }}" {{ $fabrictosuit->quality == $quality->quality ? 'selected' : '' }}>
                                {{ $quality->quality }}
                            </option>
                        @endforeach
                    </select>
                    @error('quality')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="sendtodyeing">Total send to Dyeing</label>
                    <input type="number" class="form-control @error('sendtodyeing') is-invalid @enderror" id="sendtodyeing" placeholder="400" name="sendtodyeing" value="{{ old('sendtodyeing', $fabrictosuit->sendtodyeing) }}">
                    @error('sendtodyeing')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row my-4">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="cost">Dyeing Cost (meter)</label>
                    <input type="number" class="form-control @error('cost') is-invalid @enderror" id="cost" placeholder="100" name="cost" value="{{ old('cost', $fabrictosuit->cost) }}">
                    @error('cost')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="reject">Reject</label>
                    <input type="number" class="form-control @error('reject') is-invalid @enderror" id="reject" placeholder="50" name="reject" value="{{ old('reject', $fabrictosuit->reject) }}">
                    @error('reject')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row my-4">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="pass">Pass</label>
                    <input type="number" class="form-control @error('pass') is-invalid @enderror" id="pass" placeholder="50" name="pass" value="{{ old('pass', $fabrictosuit->pass) }}">
                    @error('pass')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="varity">Article</label>
                    <select class="form-control" id="varity" name="varity">
                        <option value="" selected disabled>Select article</option>
                        @foreach ($varities as $varity)
                            <option value="{{ $varity->name }}" {{ old('varity', $fabrictosuit->varity) == $varity->name ? 'selected' : '' }}>
                                {{ $varity->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('varity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 d-flex justify-content-center">
                <button type="submit" class="btn main-color">Update Fabric to Suit Record</button>
            </div>
        </div>
    </form>

</div>
@endsection

@section('script')
    <script>
        $('#quality').select2({
            width: '100%', 
            containerCssClass: 'select2-custom-container', 
        });

        $('#varity').select2({
            width: '100%', 
            containerCssClass: 'select2-custom-container', 
        });
    </script>
@endsection
