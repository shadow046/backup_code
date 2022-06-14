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
        <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
        <input type="hidden" name="id" id="id">
        <div class="modal-body" >
          <div class= "container-fluid">
          <div class="row">
            <div class="col-sm-3"style="padding:3px">
            </div>
            <div class="col-sm-9" style="padding:3px">
             <input type="text" class="form-control" id="firstname" placeholder="First Name" required>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3"style="padding:3px">
            </div>
            <div class="col-sm-9" style="padding:3px">
             <input type="text" class="form-control" id="lastname" placeholder="Last Name" required>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3"style="padding:3px">
              <input type="text" class="form-control" id="employeeno" placeholder="Employee No" required>
            </div>
            <div class="col-sm-4" style="padding:3px">
             <input type="text" class="form-control" id="middlename" placeholder="Middle Name" required>
            </div>
            <div class="col-sm-5" style="padding:3px">
              <select class="form-control" id="gender" style="color: Gray;" required>
                <option value="" selected disabled style="color: Gray;">Gender</option>
                <option value="Male" style="color: Black;">Male</option>
                <option value="Female" style="color: Black;">Female</option>
              </select>
              </div>
          </div>
          <div class="row">
            <div class="col-sm-3"style="padding:3px">
              <input type="text" class="form-control" id="shift" placeholder="Shift" required>
            </div>
            <div class="col-sm-4" style="padding:3px">
              <input type="text" class="form-control" id="position" placeholder="Position" required>
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
              <input type="date" class="form-control" id="datehired" placeholder="Date Hired" required>
            </div>
            <div class="col-sm-4" style="padding:3px">
              <input type="text" class="form-control" id="email" placeholder="Email Address" required>
            </div>
            <div class="col-sm-5"style="padding:3px" >
              <input type="text" class="form-control" id="contactno" placeholder="Contact No." required>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3"style="padding:3px">
              <input type="button" id="btnAddCredits" class="btn btn-primary bp" value="Leave Credit" style="display:block; width:100%">
              {{-- <button class="btn btn-primary bp"; type="button" style="display:block; width:100%" id="btnAddCredits" data-toggle="modal" data-target="#leaveCredit" data-backdrop="static" data-keyboard="false" >Leave Credit</button> --}}
            </div>
            <div class="col-sm-9" style="padding:3px">
              <input type="text" class="form-control" id="address" placeholder="Home Address" required>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3"style="padding:3px">
              <input type="button" id="btnApprovingGroup" class="btn btn-primary bp" value="Approving Group" style="display:block; width:100%">
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