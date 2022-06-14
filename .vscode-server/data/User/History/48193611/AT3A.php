<!-- Modal -->
<div id="newholiday" class="modal fade in">
    <div class="modal-dialog">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style=" background-color: #0d1a80; color:white">
          <h6 class="modal-title w-100 text-center">CREATE NEW HOLIDAY</h6>
          <button class="close cancel" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
        <div class="modal-body">
          <form id='holidayform'>
          <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
          <input type="hidden" name="id" id="id">
          <div class="form-group my-4">
            <label class="control-label col-sm-4" for="holidayname">Holiday Name:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="holidayname" style="margin-top:-8px !important;"  placeholder="Enter holiday name" required>
            </div>
          </div>
          <div class="form-group my-4">
            <span class="col-sm-12">&nbsp;</span>
          </div>
          <div class="form-group my-4">
            <label class="control-label col-sm-4" for="holidaytype">Holiday Type:</label>
            <div class="col-sm-8">
              <select class="form-control" id="holidaytype" style="margin-top:-8px !important; color: Gray;" required>
                <option value="" selected disabled style="color: Gray;">Select Holiday Type</option>
                {{-- <option value="admin" style="color: Black;">Admin</option>
                <option value="manager" style="color: Black;">Manager</option>
                <option value="supervisor" style="color: Black;">Supervisor</option>
                <option value="employee" style="color: Black;">Employee</option> --}}
                {{-- @foreach($role as $roles) --}}
                @foreach($holiday as $holidays)
                  <option value="{{$holidays->id}}" style="color: Black;">{{strtoupper($holidays->name)}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group my-4">
            <span class="col-sm-12">&nbsp;</span>
          </div>
          <div class="form-group my-4">
            <label class="control-label col-sm-4" for="remarks">Remarks:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="remarks" style="margin-top:-8px !important;"  placeholder="Enter remarks" required>
            </div>
          </div>
          <div class="form-group my-4">
            <span class="col-sm-12">&nbsp;</span>
          </div>
          <div class="form-group my-4">
            <label class="control-label col-sm-4" for="date">Date:</label>
            <div class="col-sm-8">
              <input type="date" class="form-control" id="date" style="margin-top:-8px !important;"  placeholder="Enter date" required>
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