<!-- Modal -->
<div id="newuser" class="modal fade in">
    <div class="modal-dialog">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header text-center" style=" background-color: blue">
          <h4 id="userTitle" class="modal-title">CREATE NEW USER</h4>
          <button type="button" class="close closeModal" data-dismiss="modal" style="margin-right:-120px; ">&times;</button>
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
              <input type="password" class="form-control hidepass" id="password" style="margin-top:-8px !important;"  placeholder="Enter password" required>
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
                <option value="admin" style="color: Black;">Admin</option>
                <option value="manager" style="color: Black;">Manager</option>
                <option value="supervisor" style="color: Black;">Supervisor</option>
                <option value="employee" style="color: Black;">Employee</option>
              </select>
            </div>
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