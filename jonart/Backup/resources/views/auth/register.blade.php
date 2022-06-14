<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="{{ asset('bootstrap-3.1.1/css/bootstrap.min.css') }}"> 
</head>
<body>
    <div class="container">
        <div class="row" style="margin-top:45px; ">
            <div class="col-md-4 col-md-offset-4">
                <center><div><img src="/idsi.png" style="height: 80px; margin-top:10px;" class="pr-3">
               <h4> CUSTOMER WARRANTY AND MA MONITORING SYSTEM </h4><hr>
                </div></center>
                <form action="{{ route('auth.save')}}" method="post">
                    @if(Session::get('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success')}}
                        </div>
                    @endif
                    @if(Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail')}}
                        </div>
                    @endif
                    @csrf
                    <div class="form-group" id="createUser">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter full name" value="{{ old('name')}}">
                        <span class="text-danger">@error('name'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter Email address" value="{{ old('email')}}">
                        <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password">
                        <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label>User Level</label>
                        <select name="userlevel" class="form-control">
                            <option value="Admin">Admin</option>
                            <option value="User" selected='selected'>User</option>
                        </select>
                    </div><br>
                    <input type="hidden" class="form-control" name="status" value="Active">
                
                    <button type="submit" class="btn btn-block btn-primary">Sign up</button><br>
                    
                </form>
            </div>
        </div>
    </div>
</body>
</html>