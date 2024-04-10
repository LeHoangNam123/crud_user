<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
      <!-- content -->
      <div class="row justify-content-around">
        <form method="post" action="{{route('custom.register')}}" enctype="multipart/form-data" class="col-md-6 bg-light p-3 my-3">
            <h1 class="text-center text-uppercase h3 py-3">Đăng ký người dùng</h1>
            @csrf
            <div class="form-group">
                <label for="Username">Username</label>
                <input id="username" type="text" class="form-control"  name="name"  placeholder="Enter username">
            </div>

            <div class="form-group">
                <label for="Email">Email</label>
                <input id="useremail" type="email" class="form-control" name="email"  placeholder="Enter email">
            </div>

            <div class="form-group">
                <label for="Phone">Phone</label>
                <input id="userphone" type="text" class="form-control" name="phone"  placeholder="Enter phone">
            </div>

            <div class="form-group">
                <label for="Password">Password</label>
                <input id="userpass" type="password" class="form-control"  name="password"  placeholder="Enter password">
            </div>

            <div class="form-group">
                <label for="Avatar">Avatar</label>
                <input type="file" class="form-control" name="image">
            </div>
                <button type="submit" class="btn btn-primary btn-block" >Đăng Ký</button>
                Bạn đã có tài khoản: <a href="{{route('login')}}" >Register</a>
        </form>
        </div> 
    
    </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>