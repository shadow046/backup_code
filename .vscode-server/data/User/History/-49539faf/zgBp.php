<!-- Modal -->
<div id="leavecredit" class="modal fade in" style="justify-content:center; align-items: center;">
    <div class="modal-dialog">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style=" background-color: #0d1a80; color:white">
          <h4 class="modal-title w-100 text-center" id ="leaveCredit">Leave Credits</h4>
          <button class="close " data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
        <div class="modal-body">
          <form id='userform'>
          <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
          <input type="hidden" name="id" id="id">
          <div class="form-group my-4">
            <label class="control-label col-sm-3" for="employeeleave">Leave type:</label>
            <div class="col-sm-9">
              <select class="form-control" id="employeeleave" style="margin-top:-8px !important; color: Gray;" required>
                <option value="" selected disabled style="color: Gray;">Select employee leave type</option>
                @foreach($leavetype as $leavetypes)
                  <option value="{{$leavetypes->code}}" style="color: Black;">{{strtoupper($leavetypes->type)}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group my-4">
            <span class="col-sm-12">&nbsp;</span>
          </div>
          <div class="form-group my-4">
            <label class="control-label col-sm-3" for="noofdays">No. of days:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="noofdays" style="margin-top:-8px !important;"  placeholder="0">
            </div>
          </div>
          <div class="form-group my-4">
            <span class="col-sm-12">&nbsp;</span>
          </div>
          <div class="form-group my-4">
            <label class="control-label col-sm-3" for=""></label>
            <div class="col-sm-9">
          <input type="button" id="btnAdd" class="btn btn-primary bp" style="margin-top:-8px !important;" value="Add">
            </div>
          </div>
          <div class="form-group my-4">
            <span class="col-sm-12">&nbsp;</span>
          </div>  
        </form>
          <table id="leaveTable" class="table leaveTable table-hover display" style="cursor: pointer; width: 100%; font-size: 14px;">
            <thead style="background-color: #0d1a80; color: white; font-size: 15px;">
                <tr>
                    <th>Leave Code</th>
                    <th>Leave Type</th>
                    <th>No Of Days</th>
                </tr>
            </thead>
          </table>
        </div>
        <div class="modal-footer">
          <input type="button" id="btnDelete" class="btn btn-primary bp" style="margin-right: 235px; display:none;" value="Delete">
          <button type="button" class="btn btn-default bp " data-bs-dismiss="modal">Cancel</button>
          <input type="button" id="btnSave" class="btn btn-primary bp" value="Save">
        </div>
      </div>
  
    </div>
  </div>