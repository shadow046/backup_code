<!-- Modal -->
<div id="newemployee" class="modal fade in">
    <div class="modal-dialog modal-xl">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style=" background-color: #0d1a80; color:white">
            <h4 class="modal-title w-100 text-center"id ="employeeTitle">CREATE NEW EMPLOYEE</h4>
            <button class="close closeModal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" >
          <div class= "container-fluid">
          <div class="row">
            <div class="col-sm-3"style="padding:3px">
            </div>
            <div class="col-sm-9" style="padding:3px">
             <input type="text" class="form-control" id="branchcode" placeholder="First Name" required>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3"style="padding:3px">
            </div>
            <div class="col-sm-9" style="padding:3px">
             <input type="text" class="form-control" id="branchcode" placeholder="Last Name" required>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3"style="padding:3px">
            </div>
            <div class="col-sm-9" style="padding:3px">
             <input type="text" class="form-control" id="branchcode" placeholder="Middle Name" required>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3"style="padding:3px">
              <input type="text" class="form-control" id="branchcode" placeholder="Shift" required>
            </div>
            <div class="col-sm-4" style="padding:3px">
              <input type="text" class="form-control" id="branchcode" placeholder="Position" required>
            </div>
            <div class="col-sm-5"style="padding:3px" >
              <select class="form-control" id="branchname" style="color: Gray;" required>
                <option value="" selected disabled style="color: Gray;">Branch Name</option>
                @foreach($branchname as $branchnames)
                  <option value="{{$branchnames->branch_code}}" style="color: Black;">{{strtoupper($branchnames->branch_name)}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3"style="padding:3px">
              <input type="text" class="form-control" id="branchcode" placeholder="Date Hired" required>
            </div>
            <div class="col-sm-4" style="padding:3px">
              <input type="text" class="form-control" id="branchcode" placeholder="Email Address" required>
            </div>
            <div class="col-sm-5"style="padding:3px" >
              <input type="text" class="form-control" id="branchcode" placeholder="Contact No." required>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3"style="padding:3px">
              <input type="text" class="form-control" id="branchcode" placeholder="Leave Credits" required>
            </div>
            <div class="col-sm-9" style="padding:3px">
              <input type="text" class="form-control" id="branchcode" placeholder="Home Address" required>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3"style="padding:3px">
              <input type="text" class="form-control" id="branchcode" placeholder="Approving Group" required>
            </div>
            <div class="col-sm-3" style="padding:3px">
              <select class="form-control" id="employeestatus" style="color: Gray;" required>
                <option value="" selected disabled style="color: Gray;">Employee Status</option>
                @foreach($employeestatus as $employeesstatus)
                  <option value="{{$employeesstatus->id}}" style="color: Black;">{{strtoupper($employeesstatus->name)}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-3" style="padding:3px">
              <select class="form-control" id="userlevel" style="color: Gray;" required>
                <option value="" selected disabled style="color: Gray;">User Level</option>
                @foreach($userlevel as $userlevels)
                  <option value="{{$userlevels->name}}" style="color: Black;">{{strtoupper($userlevels->name)}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-3" style="padding:3px">
            <select class="form-control" id="status" style="color: Gray;" required>
              <option value="" selected disabled style="color: Gray;">Status</option>
              <option value="Active" style="color: Black;">ACTIVE</option>
              <option value="Inactive" style="color: Black;">INACTIVE</option>
            </select>
            </div>
            <div>
            <label id ="leavecred" style="text-align:left; font-size: x-small;" value="0">Leave Credits :</label>
            <label style="text-align:left; font-size: x-small;" value ="0" >0</label>
            </div>
            <div>
            <label style="text-align:left; font-size: x-small; ">Approving Group :</label>
            <label style="text-align:left; font-size: x-small;" value ="None" >None</label>
            </div>
          </div>
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-default bp closeModal" data-dismiss="modal">Cancel</button>
          <input type="button" id="btnSave" class="btn btn-primary bp" value="Save">
        </div>
        
      </div>
  
    </div>
  </div>