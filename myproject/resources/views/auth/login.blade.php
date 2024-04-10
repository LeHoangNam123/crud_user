<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <style>
        body{
            font-family: 'Montserrat', sans-serif;
            font-size: 17px;
        }
        *{
            box-sizing: border-box;

        }
        .container{
            display: flex;
            justify-content: center;
            min-height: 80vh;
            align-items: center;
        }
        form{
            border: 1px solid #dadce0;
            border-radius: 5px;
            padding: 40px;
        }
        h3{
            text-align: center;
            font-size: 24px;
            font-weight: 500;
        }
        .form-group{
            margin-bottom: 15px;
            position: relative;
        }
        input{
            height: 50px;
            width: 300px;
            outline: none;
            border: 1px solid #dadce0;
            padding: 10px;
            border-radius: 5px;
            font-size: inherit;
            color: #202124;
        }
        label{
            position: absolute;
            padding: 0px 5px;
            left: 5px;
            top:50%;
            pointer-events: none;
            transform: translateY(-50%);
            background: #fff;
            transition: all 0.3 ease-in-out
        }
        .form-group input:focus{
            border: 2px solid #1a73e8;
        }
        .form-group input:focus + label{
            top: 0px;
            font-size: 13px;
            font-weight: 500;
            color: #1a73e8;
        }
        button{
            width: 100%;
        }

    </style>
    
    <div class="container">
      <!-- content -->
      
    <form method="post" action="{{route('custom.login')}}"> 
        <h3 class="title">Đăng Nhập</h2>
        @csrf
        <div class="form-group">
            <input type="email" name="email"  placeholder="Enter email">
        </div>

        <div class="form-group">
            <input type="password"  name="password"  placeholder="Enter password">
            @if(session('error'))<span class="text-danger">{{ session('error') }}</span> @endif
        </div>
        <button type="submit" class="btn btn-primary">Đăng Nhập</button>
        <br>
        Bạn chưa có tài khoản: <a href="{{route('register')}}" >Register</a>
    </form>
    
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>