<!-- resources/views/invoices/yarnsale.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suit Sale Invoice</title>
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
    </style>
</head>

<body>
    <div class="container">
        <div class="text-center mt-3">
            <h2>7 Star Textile</h2>
        </div>
        
        <div class="row my-4" >
            <h6>Purchaser: {{$purchaserName}}</h6>
            <h6>Date: {{$date->format('d-m-Y')}}</h6>
        </div>

        <div class="row">
            <table class="table ">
                <thead class="table-secondary">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Article</th>
                    <th scope="col">Meter</th>
                    <th scope="col">Thaan (Meter)</th>
                    <th scope="col">Total Thaan</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total Price</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($salesuits as $index=> $salesuit)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$salesuit->variety}}</td>
                            <td>{{$salesuit->meter}}</td>
                            <td>{{$salesuit->thaanMeter}}</td>
                            <td>{{$salesuit->totalThaan}}</td>
                            <td>{{$salesuit->price}}</td>
                            <td>{{$salesuit->totalPrice}}</td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
        </div>

        <div class="row text-end mt-5">
            <h6>Total Bill: {{$totalBill}}</h6>
            <h6>Previous Pending: {{$pending}}</h6>
            <h6>Total Pending: {{$totalpendingprice}}</h6>
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
