<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login – koperasi</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container"><br>
        <div class="col-md-4 col-md-offset-4">
            <h2 class="text-center"><b>Taman<span style="color: rgb(2, 87, 2)">Siswa</span> 2</b><br>
                school center of excellence</h3>
                <hr>

                @if(session('error'))
                <div class="alert alert-danger"> <b>Opps!</b> {{session('error')}} </div>
                @endif

                <form action="{{ route('actionlogin') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" required="">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required="">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Log
                        In</button>
                    <hr>
                    
                </form>
                <a href="register">register</a>
        </div>
    </div>
</body>

</html>