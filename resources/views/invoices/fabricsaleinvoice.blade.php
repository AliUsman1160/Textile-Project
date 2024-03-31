<!-- resources/views/invoices/yarnsale.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fabric Sale Invoice</title>
    <link rel="icon" href="{{ asset('icon/logo.png') }}">
    <!-- Add necessary styles and Bootstrap CDN link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        /* Add your custom styles here */
        body {
            background-color: #f8f9fa;
            /* Bootstrap background color */
        }

        .invoice-container {
            max-width: 600px;
            margin: auto;
            text-align: left;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            font-family: 'Arial', sans-serif;
        }

        .invoice-header {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            text-align: center;
        }

        .invoice-details {
            margin-top: 20px;
            font-size: 16px;
            color: #555;
        }

        .invoice-details p {
            margin-bottom: 10px;
        }

        .invoice-total {
            margin-top: 30px;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }


        .button-container {
            text-align: center;
            margin-top: 20px;
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
    </style>
</head>

<body>
    <div class="container">
        <div class="invoice-header mt-3"><img style="width: 70px;" src="{{ asset('icon/logo2.png') }}" alt="">7 Star Textile</div>
        <div class="invoice-details">
            <p>Invoice for Fabric Sale #{{ $fabricsale->id }}</p>
            <p><b>Date:</b> {{ $fabricsale->updated_at->format('d-m-Y') }}</p>
            <hr>

            <div class="row">
                <p> <b>Quality: </b>{{ $fabricsale->quality }}</p>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p> <b>Meter:</b> {{ $fabricsale->meter }}</p>
                </div>
                <div class="col-sm-6">
                    <p> <b>weight:</b> {{ $fabricsale->weight }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p> <b>Price (meter):</b> {{ $fabricsale->price_per_meter }}</p>
                </div>
                <div class="col-sm-6">
                    <p> <b>Purchaser:</b> {{ $fabricsale->purchaser }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p> <b>Total Price:</b> {{ $fabricsale->total_price }}</p>
                </div>
                <div class="col-sm-6">
                    <p> <b>Received Price:</b> {{ $fabricsale->received_price }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p> <b>Pending Price:</b> {{ $fabricsale->panding_price }}</p>
                </div>
            </div>


            <hr>

            <p> <b>Payment:</b>
                
                @if ($fabricsale->paymentStatus == 'received')
                    <span class="badge bg-success">Received</span>
                @else
                    <span class="badge bg-danger">Pending</span>
                @endif
            </p>

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
