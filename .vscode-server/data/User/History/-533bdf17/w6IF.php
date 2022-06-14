<!-- Modal -->
<div id="newuser" class="modal fade in">
    <div class="modal-dialog">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style=" background-color: #0d1a80; color:white">
          <h4 class="modal-title w-100 text-center" id ="userTitle">CREATE NEW USER</h4>
          <button class="close closeModal" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
        <div class="modal-body">
          <form id='userform'>
          <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
          <input type="hidden" name="id" id="id">
          <div class="form-group my-4">
            <label class="control-label col-sm-3" for="fullname">Fullname:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="fullname" style="margin-top:-8px !important;"  placeholder="Enter full name" required>
            </div>
          </div>
          <div class="form-group my-4">
            <span class="col-sm-12">&nbsp;</span>
          </div>
          <div class="form-group my-4">
            <label class="control-label col-sm-3" for="email">Email:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="email" style="margin-top:-8px !important;"  placeholder="Enter email" required>
            </div>
          </div>
          <div class="form-group my-4 hidepass">
            <span class="col-sm-12">&nbsp;</span>
          </div>
          <div class="form-group my-4 hidepass">
            <label class="control-label col-sm-3 hidepass" for="password">Password:</label>
            <div class="col-sm-9">
              <input type="password" class="form-control hidepass" id="password" style="margin-top:-8px !important;"  placeholder="Enter password" minlength="8" required>
            </div>
          </div>
          <div class="form-group my-4">
            <span class="col-sm-12">&nbsp;</span>
          </div>
          <div class="form-group my-4">
            <label class="control-label col-sm-3" for="userlevel">User Level:</label>
            <div class="col-sm-9">
              <select class="form-control" id="userlevel" style="margin-top:-8px !important; color: Gray;" required>
                <option value="" selected disabled style="color: Gray;">Select User Level</option>
                {{-- <option value="admin" style="color: Black;">Admin</option>
                <option value="manager" style="color: Black;">Manager</option>
                <option value="supervisor" style="color: Black;">Supervisor</option>
                <option value="employee" style="color: Black;">Employee</option> --}}
                @foreach($role as $roles)
                  <option value="{{$roles->name}}" style="color: Black;">{{strtoupper($roles->name)}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group my-4">
            <span class="col-sm-12">&nbsp;</span>
          </div>
          {{-- <div class="form-group my-4">
            <label class="control-label col-sm-3" for="status">Status:</label>
            <div class="col-sm-9">
              <select class="form-control" id="status" style="margin-top:-8px !important; color: Gray;" required>
                <option value="" selected disabled style="color: Gray;">Select status</option>
                <option value="Active" style="color: Black;">Active</option>
                <option value="Inactive" style="color: Black;">Inactive</option>
              </select>
            </div>
          </div> --}}
          <div class="form-group my-4">
            {{-- <div class="input-group-prepend"> --}}
                <label class="input-group-text" style="width: 120px; height: 34px !important;">Status</label>
            {{-- </div> --}}
            <label class="switch" style="margin-left: -20px;">
                <input type="checkbox" id="status" class="togBtn" value="ACTIVE">
                  <div class="slider round">
                    <span class="on">ACTIVE</span>
                    <span class="off">INACTIVE</span>
                  </div>
            </label>
        </div>
          </form>
        </div>
        <div class="modal-footer">
          <input type="button" id="btnDelete" class="btn btn-primary bp" style="margin-right: 235px; display:none;" value="Delete">
          <button type="button" class="btn btn-default bp closeModal" data-dismiss="modal">Cancel</button>
          <input type="button" id="btnSave" class="btn btn-primary bp" value="Save">
        </div>
      </div>
  
    </div>
  </div>