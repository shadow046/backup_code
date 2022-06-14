<!-- Modal -->
<div id="approvinggroup" class="modal fade in">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style=" background-color: #0d1a80; color:white">
        <h4 class="modal-title w-100 text-center" id ="leaveCredit">Approving Group</h4>
        <button class="close " data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
      <div class="modal-body">
        <form id='approvinggroupform'>
        {{-- <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
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
            <input type="text" class="form-control" id="noofdays" style="margin-top:-8px !important;"  placeholder="0" readonly>
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
        </div>   --}}
      </form>
        <table id="approvinggroupTable" class="table approvinggroupTable table-hover display" style="cursor: pointer; width: 100%; font-size: 14px;">
          <thead style="background-color: #0d1a80; color: white; font-size: 15px;">
              <tr>
                  <th>Branch Code</th>
                  <th>Branch Name</th>
                  <th>Officer Name</th>
                  <th>Position</th>
              </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        {{-- <input type="button" id="btnReset" class="btn btn-primary bp" value="Reset">
        <button type="button" class="btn btn-default bp " data-bs-dismiss="modal">OK</button> --}}
      </div>
    </div>

  </div>
</div>