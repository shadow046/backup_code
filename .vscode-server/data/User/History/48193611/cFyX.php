<!-- Modal -->
<div id="newholiday" class="modal fade in">
    <div class="modal-dialog">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header text-center" style=" background-color: #0d1a80; color:white">
          <h4 id="holidayTitle" class="modal-title">CREATE NEW HOLIDAY</h4>
          <button type="button" class="close closeModal" data-dismiss="modal" style="margin-right:-120px; ">&times;</button>
        </div>
        <div class="modal-body">
          <form id='holidayform'>
          <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
          <input type="hidden" name="id" id="id">
          <div class="form-group my-4">
            <label class="control-label col-sm-3" for="holidayname">Holiday Name:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="holidayname" style="margin-top:-8px !important;"  placeholder="Enter holiday name" required>
            </div>
          </div>
          <div class="form-group my-4">
            <span class="col-sm-12">&nbsp;</span>
          </div>
          <div class="form-group my-4">
            <label class="control-label col-sm-3" for="type">Holiday Type:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="type" style="margin-top:-8px !important;"  placeholder="Enter holiday type" required>
            </div>
          </div>
          <div class="form-group my-4">
            <span class="col-sm-12">&nbsp;</span>
          </div>
          <div class="form-group my-4">
            <label class="control-label col-sm-3" for="remarks">Remarks:</label>
            <div class="col-sm-9">
              <input type="password" class="form-control" id="remarks" style="margin-top:-8px !important;"  placeholder="Enter remarks" required>
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
                {{-- @foreach($role as $roles) --}}
                @foreach($htype as $holiday_type)
                  <option value="{{$holiday_type->name}}" style="color: Black;">{{strtoupper($holiday_type->name)}}</option>
                @endforeach
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