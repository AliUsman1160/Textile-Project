<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>7 Star Textile</title>
    <link rel="icon" href="{{ asset('icon/logo.png') }}"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body{
            background-color: #deeefd;
        }
        .bd {
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #deeefd;
        }
        

        .login-box {
            max-width: 600px;
            width: 100%;
            /* padding: 20px; */
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            border-radius: 20px;
        }

        .login-box img {
            max-width: 250px;
            height: 400px;
            margin-right: 30px;
            border-radius: 20px 0px 0px 20px
        }

        @media (max-width: 576px) {
            .login-box {
                flex-direction: column;
                /* Reverse the order for small screens */
            }

            .login-box img {
                max-width: 80%;
                height: 250px;
                margin-left: 20px;
                margin-top: 20px;
                margin-bottom: 10px;
                border-radius: 20px;
            }

            form {
                margin-right: 30px;
                margin-bottom: 10px;
            }

        }
    </style>
</head>

<body>
    @if (session('request_send'))
        <div id="successAlert" class="alert alert-success">
            Your Request has been send successfully!
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('successAlert').style.display = 'none';
            }, 3000);
        </script>
    @endif
    <div class="bd">
        <div class="login-box">
            <div>
                <img src="{{ asset('img/textile.jpg') }}" alt="Logo">
            </div>
    
            <form action="{{ 'login' }}" method="post">
                @csrf
    
                <h3 style="color: darkblue">Welcome Back!</h3>
                <h6 class="text-secondary">Login into your account.</h6>
    
                @if ($errors->any())
                    <div id="error" class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                    <script>
                        setTimeout(function() {
                            document.getElementById('successAlert').style.display = 'none';
                        }, 3000);
                    </script>
                @endif
    
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                        required>
                </div>
    
                <div class="form-group">
                    <label for="password">Password:</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" required>
                        
                    </div>
                </div>
                <div style="margin-top: -10px;" class="mb-3">
                    <span class="">
                        <input type="checkbox" id="show-password"><label for="show-password" class="mx-2">Show Password</label>
                    </span>
                </div>
    
                <button type="submit" class="btn btn-primary btn-block">Login</button>
    
                <h6 class="text-secondary mt-3">No account yet? <a href="/sendrequest">Send Request</a> </h6>
    
    
            </form>
        </div>
    </div>

    <!-- Link Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var passwordInput = document.getElementById('password');
            var showPasswordCheckbox = document.getElementById('show-password');
    
            showPasswordCheckbox.addEventListener('change', function () {
                if (showPasswordCheckbox.checked) {
                    passwordInput.type = 'text';
                } else {
                    passwordInput.type = 'password';
                }
            });
        });
    </script>
</body>

</html>
