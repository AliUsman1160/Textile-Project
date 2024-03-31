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
        <p class="page-indicate">Convertion / Add new Quality </p>
        
    </div>

    <form id="qualityForm" class="custom-form mt-5"  action="{{ route('storequality') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="read">Read</label>
                    <input type="number" step="any" class="form-control @error('read') is-invalid @enderror" id="read" placeholder="70" name="read" value="{{ old('read') }}">
                    @error('read')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="pick">Pick</label>
                    <input type="number" step="any" class="form-control @error('pick') is-invalid @enderror" id="pick" placeholder="80" name="pick" value="{{ old('pick') }}">
                    @error('pick')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="warpcount">Warp Count</label>
                    <input type="number" step="any" class="form-control @error('warpcount') is-invalid @enderror" id="warpcount" placeholder="30" name="warpcount" value="{{ old('warpcount') }}">
                    @error('warpcount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="weftcount">Weft Count</label>
                    <input type="number" step="any" class="form-control @error('weftcount') is-invalid @enderror" id="weftcount" placeholder="30" name="weftcount" value="{{ old('weftcount') }}">
                    @error('weftcount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="width">Width</label>
                    <input type="number" step="any" class="form-control @error('width') is-invalid @enderror" id="width" placeholder="114" name="width" value="{{ old('width') }}">
                    @error('width')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="nameofyarn">Name of Yarn</label>
                    <input type="text"  class="form-control @error('nameofyarn') is-invalid @enderror" id="nameofyarn" placeholder="CTN" name="nameofyarn" value="{{ old('nameofyarn') }}">
                    @error('nameofyarn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="warpthread">Warp Thread (optional)</label>
                    <input type="text"  class="form-control @error('warpthread') is-invalid @enderror" id="warpthread" placeholder="thread" name="warpthread" value="{{ old('warpthread') }}">
                    @error('warpthread')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="weftthread">Weft Thread (optional)</label>
                    <input type="text"  class="form-control @error('weftthread') is-invalid @enderror" id="weftthread" placeholder="thread" name="weftthread" value="{{ old('weftthread') }}">
                    @error('weftthread')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="warpmill">Warp Mill (optional)</label>
                    <input type="text" class="form-control @error('warpmill') is-invalid @enderror" id="warpmill" placeholder="XYZ mill" name="warpmill" value="{{ old('warpmill') }}">
                    @error('warpmill')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="weftmill">Weft Mill (optional)</label>
                    <input type="text"  class="form-control @error('weftmill') is-invalid @enderror" id="weftmill" placeholder="XYZ mill" name="weftmill" value="{{ old('weftmill') }}">
                    @error('weftmill')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

       
        
        <div class="row mt-3">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="quality">Quality</label>
                    <input type="text"  class="form-control @error('quality') is-invalid @enderror" id="quality" name="quality" value="{{ old('quality') }}" readonly>
                    @error('quality')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        
        <div class="row mt-3">
            <div class="col-12 d-flex justify-content-center">
                <button type="submit" class="btn main-color">Add Quality</button>
            </div>
        </div>
    </form>

</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('qualityForm').addEventListener('submit', function (event) {
            event.preventDefault();

            var read = parseFloat(document.getElementById('read').value) || 0;
            var pick = parseFloat(document.getElementById('pick').value) || 0;
            var warpcount = parseFloat(document.getElementById('warpcount').value) || 0;
            var weftcount = parseFloat(document.getElementById('weftcount').value) || 0;
            var width = parseFloat(document.getElementById('width').value) || 0;
            var nameofyarn = document.getElementById('nameofyarn').value;

            var warpthread = document.getElementById('warpthread').value;
            var weftthread = document.getElementById('weftthread').value;
            var warpmill = document.getElementById('warpmill').value;
            var weftmill = document.getElementById('weftmill').value;


            if (read && pick && warpcount && weftcount && width && nameofyarn) {
                var quality = '(' + read + ' x ' + pick + ') / (' + warpcount + '(' + (warpthread ? warpthread + ',' : '') + (warpmill ? warpmill : '') + ')' + ' x ' + weftcount + '(' + (weftthread ? weftthread + ',' : '') + (weftmill ? weftmill : '') + ')' + ') = ' + width + ' (' + nameofyarn + ')';
                document.getElementById('quality').value = quality;
                setTimeout(function () {
                    document.getElementById('qualityForm').submit();
                }, 1500);
            } else {
                alert('Please fill in all required fields.');
            }

        });
    });
</script>
@endsection



