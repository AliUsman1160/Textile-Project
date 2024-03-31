<!-- resources/views/invoices/yarnsale.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suit to Fabric Contract</title>
    <link rel="icon" href="{{ asset('icon/logo.png') }}">
    <!-- Add necessary styles and Bootstrap CDN link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        /* Add your custom styles here */
        body {
            background-color: #f8f9fa;
            /* Bootstrap background color */
        }

        .logo-text{
            font-size: 28px;
            font-weight: 600;
        }


        .btn-print,
        .btn-download {
            margin-right: 10px;
        }

        @media print {
            .button-container {
                display: none;
            }
        }
        .boder{
            border-bottom: 1px solid black;
            color: rgb(77, 77, 77);
        }
        .underlined {
            border-bottom: 1px solid; /* You can adjust the color as needed */
            width: 400px;
            display: inline-block; /* Ensures that the border only covers the width of the content */
        }
        .underlined-full {
            border-bottom: 1px solid; /* You can adjust the color as needed */
            width: 600px;
            display: inline-block; /* Ensures that the border only covers the width of the content */
        }
        .underlined-inst{
            border-bottom: 1px solid; /* You can adjust the color as needed */
            width: 400px;
            display: inline-block; 
        }
        .light-gray-color{
            color: rgb(77, 77, 77);
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="text-center mt-3">
            <h2>7 Star Textile</h2>
        </div>
        
        <div class="row my-4" >
            <h6>Contract Date:  <span class="boder px-3">{{$contract->created_at->format("Y-m-d")}}</span></h6>
            <h6 class="mt-2">Delivery Date:  <span class="boder px-3"> {{$contract->delivery_date}}</span></h6>
        </div>

        <div class="row mt-5">
            <h6>Contractee:  <span class="light-gray-color underlined px-3" style="margin-left:20px;">{{$contract->contractee}}</span></h6>
        </div>
        <div class="row mt-1">
            <h6>Broker:  <span class="light-gray-color underlined px-3" style="margin-left:50px;">{{$contract->broker}}</span></h6>
        </div>

        <div class="row mt-1">
            <h6>Quality:  <span class="light-gray-color underlined-full px-3" style="margin-left:46px;">{{$contract->quality}}</span></h6>
        </div>

        <div class="row mt-1">
            <div class="col-md-2 col-sm-4">
                <h6>Order Meter:  <span class="boder px-3" style="margin-left:8px;">{{$contract->order_meter}}</span></h6>
            </div>
            <div class="col-md-2 col-sm-4">
                <h6>Rate Meter:  <span class="boder px-3" style="margin-left:15px;">{{$contract->rate_per_meter}}</span></h6>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-2 col-sm-4">
                <h6>Warp Count:  <span class="boder px-3" style="margin-left:12px;">{{$contract->warp_yarn_count}}</span></h6>
            </div>
            <div class="col-md-2 col-sm-4">
                <h6>Weft Count:  <span class="boder px-3" style="margin-left:12px;">{{$contract->weft_yarn_count}}</span></h6>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-2 col-sm-4">
                <h6>Warp Weight:  <span class="boder px-3" style="margin-left:3px;">{{$contract->warp_weight_per_meter	}}</span></h6>
            </div>
            <div class="col-md-2 col-sm-4">
                <h6>Weft Weight:  <span class="boder px-3" style="margin-left:5px;">{{$contract->weft_weight_per_meter}}</span></h6>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-2 col-sm-4">
                <h6>Warp Rate:  <span class="boder px-3" style="margin-left:23px;">{{$contract->warp_rate	}}</span></h6>
            </div>
            <div class="col-md-2 col-sm-4">
                <h6>Weft Rate:  <span class="boder px-3" style="margin-left:25px;">{{$contract->weft_rate}}</span></h6>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-2 col-sm-4">
                <h6>Warp Bags:  <span class="boder px-3" style="margin-left:20px;">{{$contract->required_warp_bags	}}</span></h6>
            </div>
            <div class="col-md-2 col-sm-4">
                <h6>Weft Bags:  <span class="boder px-3" style="margin-left:23px;">{{$contract->required_weft_bags}}</span></h6>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-2 col-sm-4">
                <h6>Conv/Pick:  <span class="boder px-3" style="margin-left:23px;">{{$contract->conv_pick	}}</span></h6>
            </div>
            <div class="col-md-2 col-sm-4">
                <h6>Conv/Meter:  <span class="boder px-3" style="margin-left:10px;">{{$contract->conv_meter}}</span></h6>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-2 col-sm-4">
                <h6>Send Bags:  <span class="boder px-3" style="margin-left:23px;">{{$contract->send_bags	}}</span></h6>
            </div>
            <div class="col-md-2 col-sm-4">
                <h6>Due Bags:  <span class="boder px-3" style="margin-left:31px;">{{$contract->due_bags}}</span></h6>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-2 col-sm-4">
                <h6>GST:  <span class="boder px-3" style="margin-left:70px;">{{$contract->gst	}}</span></h6>
            </div>
            <div class="col-md-2 col-sm-4">
                <h6>Payment:  <span class="boder px-3" style="margin-left:35px;">{{$contract->payment}}</span></h6>
            </div>
            <div class="col-md-3 col-sm-4">
                <h6>Payment+GST:  <span class="boder px-3" style="margin-left:15px;">{{$contract->payment_include_gst}}</span></h6>
            </div>
        </div>

        <div class="row mt-1">
            <div class="row mt-4">
                <h6>Deliver Inst:  <span class="light-gray-color underlined-inst px-3" style="margin-left:18px;">{{$contract->delivery_instruction}}</span></h6>
            </div>
            <div class="row mt-1">
                <h6>Payment Inst:  <span class="light-gray-color underlined-inst px-3" style="margin-left:5px;">{{$contract->payment_instruction}}</span></h6>
            </div>
            <div class="row mt-1">
                <h6>Qulaity Inst:  <span class="light-gray-color underlined-inst px-3" style="margin-left:18px;">{{$contract->quality_instruction}}</span></h6>
            </div>
            <div class="row mt-1">
                <h6>Other Inst:  <span class="light-gray-color underlined-inst px-3" style="margin-left:28px;">{{$contract->other_instruction}}</span></h6>
            </div>
        </div>

    
        <div class="row" style="margin-top: 70px;">
            <div style="margin-left: 40px;" class="col-md-2 col-sm-3">
                <div class="text-center">
                    <h6 style="border-top: 2px solid black;">{{$contract->contractee}}</h6>
                    <span>(Contractee)</span>
                </div>
            </div>
            <div style="margin-left: 40px;" class="col-md-2 col-sm-3">
                <div class="text-center">
                    <h6 style="border-top: 2px solid black;">{{$contract->broker}}</h6>
                    <span>(Broker)</span>
                </div>
            </div>
        </div>
        
       
     

        <div class="button-container">
            <button class="btn btn-primary btn-print" onclick="printInvoice()">Print</button>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js CDN links -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script>
        function printInvoice() {
            window.print();
        }
    </script>
</body>

</html>
