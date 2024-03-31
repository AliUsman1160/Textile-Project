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
            <p class="page-indicate">Convertion / Yarn To Fabric </p>
            <div style="margin-top:10px;">
                <button class="btn main-color"><a href="/addnewqaulity" style="color:white"><i
                            class="px-1 fa-solid fa-plus"></i>Add new Quality</a></button>
            </div>
        </div>

        <form class="custom-form mt-5" action="{{ route('saveyarntofabric') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="deliverDate">Delivery Date</label>
                        <input type="date" class="form-control @error('deliverDate') is-invalid @enderror"
                            id="deliverDate" name="deliverDate">
                        @error('deliverDate')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="contractee">Contractee</label>
                        <input type="text" class="form-control @error('contractee') is-invalid @enderror" id="contractee"
                            placeholder="Mubeen Mqbool Industry" name="contractee" value="{{ old('contractee') }}">
                        @error('contractee')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="broker">Broker</label>
                        <select class="form-control @error('broker') is-invalid @enderror" id="broker" name="broker">
                            <option value="" selected disabled>Select Broker</option>
                            @foreach ($brokers as $broker)
                                <option value="{{ $broker->name }}" {{ old('broker') == $broker->name ? 'selected' : '' }}>
                                    {{ $broker->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('broker')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="quality">Quality</label>
                        <select class="form-control @error('quality') is-invalid @enderror" id="quality" name="quality">
                            <option value="" selected disabled>Select quality</option>
                            @foreach ($qualities as $q)
                                <option value="{{ $q->read . ',' . $q->pick . ',' . $q->width . ',' . $q->id }}">
                                    {{ $q->quality }}
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
                        <label for="ordermeter">Order in meter</label>
                        <input type="number" class="form-control @error('ordermeter') is-invalid @enderror" id="ordermeter"
                            placeholder="10,000" name="ordermeter" value="{{ old('ordermeter') }}">
                        @error('ordermeter')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="ratepermeter">Rate per meter</label>
                        <input type="number" class="form-control @error('ratepermeter') is-invalid @enderror"
                            id="ratepermeter" placeholder="350" step="any" name="ratepermeter"
                            value="{{ old('ratepermeter') }}">
                        @error('ratepermeter')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <label for="warpyarncount">Yarn Count (warp)</label>
                        <input type="number" class="form-control @error('warpyarncount') is-invalid @enderror"
                            id="warpyarncount" placeholder="30" step="any" name="warpyarncount"
                            value="{{ old('warpyarncount') }}">
                        @error('warpyarncount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <label for="weftyarncount">Weft Count (warp)</label>
                        <input type="number" class="form-control @error('weftyarncount') is-invalid @enderror"
                            id="weftyarncount" placeholder="30" step="any" name="weftyarncount"
                            value="{{ old('weftyarncount') }}">
                        @error('weftyarncount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg-3 col-sm-12">
                    <div class="form-group">
                        <label for="warprate">Warp Rate</label>
                        <input type="number" class="form-control @error('warprate') is-invalid @enderror" id="warprate"
                            placeholder="370" step="any" name="warprate" value="{{ old('warprate') }}">
                        @error('warprate')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-3 col-sm-12">
                    <div class="form-group">
                        <label for="weftrate">Weft Rate</label>
                        <input type="number" class="form-control @error('weftrate') is-invalid @enderror" id="weftrate"
                            placeholder="370" step="any" name="weftrate" value="{{ old('weftrate') }}">
                        @error('weftrate')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-3 col-sm-12">
                    <div class="form-group">
                        <label for="warpthread">Warp Thread</label>
                        <input type="text" class="form-control @error('warpthread') is-invalid @enderror"
                            id="warpthread" placeholder="thread" name="warpthread" value="{{ old('warpthread') }}">
                        @error('warpthread')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-3 col-sm-12">
                    <div class="form-group">
                        <label for="weftthread">Weft Thread</label>
                        <input type="text" class="form-control @error('weftthread') is-invalid @enderror"
                            id="weftthread" placeholder="thread" name="weftthread" value="{{ old('weftthread') }}">
                        @error('weftthread')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="row mt-3">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="convpick">Convertion/pick</label>
                        <input type="number" class="form-control @error('convpick') is-invalid @enderror"
                            id="convpick" placeholder="70" step="any" name="convpick"
                            value="{{ old('convpick') }}">
                        @error('convpick')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="convmeter">Convertion/Meter</label>
                        <input type="number" class="form-control @error('convmeter') is-invalid @enderror"
                            id="convmeter" placeholder="370" step="any" name="convmeter"
                            value="{{ old('convmeter') }}">
                        @error('convmeter')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="gst">GST</label>
                        <input type="number" class="form-control @error('gst') is-invalid @enderror" id="gst"
                            placeholder="5" step="any" name="gst" value="{{ old('gst') }}">
                        @error('gst')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-3 col-sm-12">
                    <button id="setValuesBtn" class="btn main-color mt-4">Set Values</button>
                </div>
            </div>


            <div class="row mt-3">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="warpweight">Warp Weight per meter</label>
                        <input type="number" class="form-control @error('warpweight') is-invalid @enderror"
                            id="warpweight" step="any" name="warpweight" readonly>
                        @error('warpweight')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="weftweight">Weft Weight per meter</label>
                        <input type="number" class="form-control @error('weftweight') is-invalid @enderror"
                            id="weftweight" step="any" name="weftweight" readonly>
                        @error('weftweight')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <label for="requiredwarpbag">Required Warp Bags</label>
                        <input type="number" class="form-control @error('requiredwarpbag') is-invalid @enderror"
                            id="requiredwarpbag" step="any" name="requiredwarpbag" readonly>
                        @error('requiredwarpbag')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <label for="requiredweftbag">Required weft Bags</label>
                        <input type="number" class="form-control @error('requiredweftbag') is-invalid @enderror"
                            id="requiredweftbag" step="any" name="requiredweftbag" readonly>
                        @error('requiredweftbag')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="totalrequiredbags">Total Bags</label>
                        <input type="number" class="form-control @error('totalrequiredbags') is-invalid @enderror"
                            id="totalrequiredbags" step="any" name="totalrequiredbags" readonly>
                        @error('totalrequiredbags')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="payment">Payment</label>
                        <input type="number" class="form-control @error('payment') is-invalid @enderror" id="payment"
                            step="any" name="payment" readonly>
                        @error('payment')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="paymentincludeGST">Payment + GST</label>
                        <input type="number" class="form-control @error('paymentincludeGST') is-invalid @enderror"
                            id="paymentincludeGST" step="any" name="paymentincludeGST" readonly>
                        @error('paymentincludeGST')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="sendbag">Send Bags</label>
                        <input type="number" class="form-control @error('sendbag') is-invalid @enderror" id="sendbag"
                            step="any" name="sendbag">
                        @error('sendbag')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="duebag">Due Bag</label>
                        <input type="number" class="form-control @error('duebag') is-invalid @enderror" id="duebag"
                            step="any" name="duebag" readonly>
                        @error('duebag')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row my-3">

                <div class="col-sm-3">
                    <label for="">Brand (For Yran Invontry)</label>
                    <select class="form-control" id="brandDropdown" name="brandDropdown">
                        <option value="">Select Brand</option>
                        @foreach (array_unique(array_column($yarn->toArray(), 'brand')) as $brand)
                        <option value="{{ $brand }}">{{ $brand }}</option>
                    @endforeach
                    
                    </select>
                    @error('brandDropdown')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-3">
                    <label for="">Cones (For Yran Invontry)</label>
                    <select id="conesDropdown" name="conesDropdown" class="form-control" class="form-control" disabled>
                        <option value="">Select Cones</option>
                    </select>
                    @error('conesDropdown')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-3">
                    <label for="">Count (For Yran Invontry)</label>
                    <select id="countDropdown" name="countDropdown" class="form-control" class="form-control" disabled>
                        <option value="">Select Count</option>
                    </select>
                    @error('countDropdown')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-3">
                    <label for="">Type (For Yran Invontry)</label>
                    <select id="typeDropdown" name="typeDropdown" class="form-control" class="form-control" disabled>
                        <option value="">Select Type</option>
                    </select>
                    @error('typeDropdown')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>





            <div class="row mt-3">
                <div class="clo-sm-12">
                    <div class="form-group">
                        <label for="deliverinst">Delivery Inst</label>
                        <input type="text" class="form-control @error('deliverinst') is-invalid @enderror"
                            id="deliverinst" name="deliverinst">
                        @error('deliverinst')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="clo-sm-12 mt-3">
                    <div class="form-group">
                        <label for="paymentinst">Payment Inst</label>
                        <input type="text" class="form-control @error('paymentinst') is-invalid @enderror"
                            id="paymentinst" name="paymentinst">
                        @error('paymentinst')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="clo-sm-12 mt-3">
                    <div class="form-group">
                        <label for="qualityinst">Quality Inst</label>
                        <input type="text" class="form-control @error('qualityinst') is-invalid @enderror"
                            id="qualityinst" name="qualityinst">
                        @error('qualityinst')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="clo-sm-12 mt-3">
                    <div class="form-group">
                        <label for="otherinst">Other Inst</label>
                        <input type="text" class="form-control @error('otherinst') is-invalid @enderror"
                            id="otherinst" name="otherinst">
                        @error('otherinst')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 d-flex justify-content-center">
                    <button type="submit" class="btn main-color">Create Convertion Contract</button>
                </div>
            </div>
        </form>

    </div>
@endsection



@section('script')
    <script>
        // Declare variables to store extracted values
        var read = 0;
        var pick = 0;
        var width = 0;

        var orderMeter = 0;
        var ratePerMeter = 0;
        var warpYarnCount = 0;
        var weftYarnCount = 0;
        var warpRate = 0;
        var weftRate = 0;
        var convPick = 0;
        var convMeter = 0;
        var gst = 0;

        $(document).ready(function() {
            $('#quality').select2({
                width: '100%',
                containerCssClass: 'select2-custom-container',
            });
            $('#broker').select2({
                width: '100%',
                containerCssClass: 'select2-custom-container',
            });
            $('#brandDropdown').select2({
                width: '100%',
                containerCssClass: 'select2-custom-container',
            });
            $('#conesDropdown').select2({
                width: '100%',
                containerCssClass: 'select2-custom-container',
            });
            $('#countDropdown').select2({
                width: '100%',
                containerCssClass: 'select2-custom-container',
            });
            $('#typeDropdown').select2({
                width: '100%',
                containerCssClass: 'select2-custom-container',
            });

            // $('#quality').on('change', function () {
            //     var selectedQuality = $(this).val();
            //     var matches = selectedQuality.match(/\((\d+)\s*x\s*(\d+)\)\s*\/\s*\((\d+)\s*x\s*(\d+)\)\s*=\s*(\d+)\s*\(([^\s]+)\)/);
            //     alert(matches.length);
            //     if (matches && matches.length === 7) {
            //         read = parseInt(matches[1], 10);
            //         pick = parseInt(matches[2], 10);
            //         // warpCount = parseInt(matches[3], 10);
            //         // weftCount = parseInt(matches[4], 10);
            //         width = parseInt(matches[5], 10);
            //         // nameOfYarn = matches[6];

            //         // var alertMessage = "Read: " + read +
            //         //     "\nPick: " + pick +
            //         //     "\nWidth: " + width ;

            //         // alert(alertMessage);
            //     }
            // });

            $('#quality').on('change', function() {
                var selectedQuality = $(this).val();
                var values = selectedQuality.split(',');
                read = parseFloat(values[0]);
                pick = parseFloat(values[1]);
                width = parseFloat(values[2]);
            });

            $('#setValuesBtn').on('click', function(e) {

                e.preventDefault();

                orderMeter = $('#ordermeter').val();
                ratePerMeter = $('#ratepermeter').val();
                warpYarnCount = $('#warpyarncount').val();
                weftYarnCount = $('#weftyarncount').val();
                warpRate = $('#warprate').val();
                weftRate = $('#weftrate').val();
                convPick = $('#convpick').val();
                convMeter = $('#convmeter').val();
                gst = $('#gst').val();

                var warpweight = (read * width / 20 / 40 / warpYarnCount / 0.9141).toFixed(2);
                $('#warpweight').val(warpweight);

                var weftweight = (pick * width / 20 / 40 / weftYarnCount / 0.9141).toFixed(2);
                $('#weftweight').val(weftweight);


                var requiredwarpbag = (orderMeter * parseFloat(warpweight) / 100).toFixed(2);
                $('#requiredwarpbag').val(requiredwarpbag);

                var requiredweftbag = (orderMeter * parseFloat(weftweight) / 100).toFixed(2);
                $('#requiredweftbag').val(requiredweftbag);

                var totalrequiredbags = (parseFloat(requiredwarpbag) + parseFloat(requiredweftbag)).toFixed(
                    2);
                $('#totalrequiredbags').val(totalrequiredbags);

                var payment = (parseFloat(convMeter) * parseFloat(orderMeter)).toFixed(2);
                $('#payment').val(payment);

                var paymentincludeGST = (parseFloat((payment / 100) * gst) + parseFloat(payment)).toFixed(
                    2);
                $('#paymentincludeGST').val(paymentincludeGST);
            });

            $('#sendbag').on('input', function() {
                var sendbag = $('#sendbag').val();
                var Totalbag = $('#totalrequiredbags').val();
                if (sendbag > 0) {
                    $('#duebag').val(Totalbag - sendbag);
                }
            });


        });
    </script>
    <script>
        $(document).ready(function() {

            var $yarn = @json($yarn);

            $('#brandDropdown').change(function() {
                var brand = $(this).val();

                // Reset and disable other dropdowns
                $('#conesDropdown, #countDropdown, #typeDropdown').html(
                    '<option value="">Select...</option>').prop('disabled', true);

                if (brand) {
                    // Enable cones dropdown
                    $('#conesDropdown').prop('disabled', false);
                    updateConesDropdown(brand);
                }
            });

            // Cones dropdown change event
            $('#conesDropdown').change(function() {
                var brand = $('#brandDropdown').val();
                var cones = $(this).val();

                // Reset and disable other dropdowns
                $('#countDropdown, #typeDropdown').html('<option value="">Select...</option>').prop(
                    'disabled', true);

                if (brand && cones) {
                    // Enable count dropdown
                    $('#countDropdown').prop('disabled', false);
                    updateCountDropdown(brand, cones);
                }
            });

            // Count dropdown change event
            $('#countDropdown').change(function() {
                var brand = $('#brandDropdown').val();
                var cones = $('#conesDropdown').val();
                var count = $(this).val();

                // Reset and disable type dropdown
                $('#typeDropdown').html('<option value="">Select...</option>').prop('disabled', true);

                if (brand && cones && count) {
                    // Enable type dropdown
                    $('#typeDropdown').prop('disabled', false);
                    updateTypeDropdown(brand, cones, count);
                }
            });


            function updateConesDropdown(brand) {
                console.log('updateConesDropdown called with brand:', brand);

                // Check if $yarn is defined and not empty
                if ($yarn && $yarn.length > 0) {
                    // Rest of your code here
                    var conesOptions = getUniqueValues($yarn.filter(function(item) {
                        return item.brand === brand;
                    }), 'cones');

                    console.log('conesOptions length:', conesOptions.length);
                    console.log('conesOptions content:', conesOptions);


                    $('#conesDropdown').empty();
                    $('#conesDropdown').append('<option value="">' + 'select cones' + '</option>');


                    $.each(conesOptions, function(index, value) {
                        console.log('Iterating conesOptions - Index:', index, 'Value:', value);
                        $('#conesDropdown').append('<option value="' + value + '">' + value + '</option>');
                    });
                } else {
                    console.error('$yarn is not defined or empty.');
                }
            }

            function updateCountDropdown(brand, cones) {
                console.log('updateCountDropdown called with brand:', brand, 'and cones:', cones);

                // Check if $yarn is defined and not empty
                if ($yarn && $yarn.length > 0) {
                    // Get unique count values based on the selected brand and cones
                    var countOptions = getUniqueValues($yarn.filter(function(item) {
                        return item.brand === brand && item.cones === cones;
                    }), 'count');

                    console.log('countOptions length:', countOptions.length);
                    console.log('countOptions content:', countOptions);

                    // Clear existing options in the dropdown

                    $('#countDropdown').empty();
                    $('#countDropdown').append('<option value="">' + 'select Count' + '</option>');

                    $.each(countOptions, function(index, value) {
                        console.log('Iterating countOptions - Index:', index, 'Value:', value);
                        $('#countDropdown').append('<option value="' + value + '">' + value + '</option>');
                    });
                } else {
                    console.error('$yarn is not defined or empty.');
                }
            }


            // Function to update type dropdown options
            function updateTypeDropdown(brand, cones, count) {
                console.log('updateTypeDropdown called with brand:', brand, 'cones:', cones, 'and count:', count);

                // Check if $yarn is defined and not empty
                if ($yarn && $yarn.length > 0) {
                    // Get unique type values based on the selected brand, cones, and count
                    var typeOptions = getUniqueValues($yarn.filter(function(item) {
                        return item.brand === brand && item.cones === cones && item.count === count;
                    }), 'type');

                    console.log('typeOptions length:', typeOptions.length);
                    console.log('typeOptions content:', typeOptions);

                    // Clear existing options in the dropdown
                    $('#typeDropdown').empty();
                    $('#typeDropdown').append('<option value="">' + 'select Type' + '</option>');


                    $.each(typeOptions, function(index, value) {
                        console.log('Iterating typeOptions - Index:', index, 'Value:', value);
                        $('#typeDropdown').append('<option value="' + value + '">' + value + '</option>');
                    });
                } else {
                    console.error('$yarn is not defined or empty.');
                }
            }


            // Function to get unique values from an array of objects
            function getUniqueValues(array, key) {
                if (key === 'brand') {
                    return Array.from(new Set(array.map(item => item[key]))).filter((value, index, self) => self.indexOf(value) === index);
                } else {
                    return Array.from(new Set(array.map(item => item[key])));
                }
            }

        });
    </script>
@endsection
