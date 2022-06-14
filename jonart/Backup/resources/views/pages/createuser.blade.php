<div class="container">
    <div class="modal fade in" id="createUser">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header" style="background-color:#04147c; color:white;">
            <h4 class="modal-title">CREATE NEW USER</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">                
            <form action="{{ route('auth.save')}}" method="post">                
                    @csrf
                <div class="form-group" >
                    <label>Name</label>
                    <input type="text" width="707" colspan="3" class="form-control" name="name" placeholder="Enter full name" value="{{ old('name')}}" autocomplete="off">
                    <span class="text-danger">@error('name'){{ $message }} @enderror</span>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Enter Email address" value="{{ old('email')}}" autocomplete="off">
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
                    <button type="submit" class="btn btn-info float-right" style="color:black;">SAVE</button><br>                 
            </form>
        </div>              
    </div>
    </div>
    </div>
</div>

