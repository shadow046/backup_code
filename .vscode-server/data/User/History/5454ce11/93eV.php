<!-- Modal -->
<div id="newshift" class="modal fade in">
    <div class="modal-dialog">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style=" background-color: #0d1a80; color:white">
          <h4 class="modal-title w-100 text-center" id ="shiftTitle">CREATE NEW SHIFT</h4>
          <button class="close closeModal" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
        <div class="modal-body">
          <form id='shiftform'>
          <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
          <input type="hidden" name="id" id="id">
          <div class="form-group my-4">
            <label class="control-label col-sm-4" for="shiftcode">Shift Code:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="shiftcode" style="margin-top:-8px !important;"  placeholder="Enter shift code" required>
            </div>
          </div>
          <div class="form-group my-4">
            <span class="col-sm-12">&nbsp;</span>
          </div>
          <div class="form-group my-4">
            <label class="control-label col-sm-4" for="leavetype">Leave Type:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="leavetype" style="margin-top:-8px !important;"  placeholder="Enter leave type" required>
            </div>
          </div>
          <div class="form-group my-4">
            <span class="col-sm-12">&nbsp;</span>
          </div>
          <div class="form-group my-4">
            <label class="control-label col-sm-4" for="start">Start:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="start" style="margin-top:-8px !important;"  placeholder="Enter start" required>
            </div>
          </div>
          <div class="form-group my-4">
            <span class="col-sm-12">&nbsp;</span>
          </div>
          <div class="form-group my-4">
            <label class="control-label col-sm-4" for="break1">Break 1:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="break1" style="margin-top:-8px !important;"  placeholder="Enter first break" required>
            </div>
          </div>
          <div class="form-group my-4">
            <span class="col-sm-12">&nbsp;</span>
          </div>
          <div class="form-group my-4">
            <label class="control-label col-sm-4" for="break2">Break 2:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="break2" style="margin-top:-8px !important;"  placeholder="Enter second break" required>
            </div>
          </div>
          <div class="form-group my-4">
            <span class="col-sm-12">&nbsp;</span>
          </div>
          <div class="form-group my-4">
            <label class="control-label col-sm-4" for="end">End:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="end" style="margin-top:-8px !important;"  placeholder="Enter end" required>
            </div>
          </div>
          <div class="form-group my-4">
            <span class="col-sm-12">&nbsp;</span>
          </div>
          <div class="form-group my-4">
            <label class="control-label col-sm-4" for="totalhours">Total Hours:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="totalhours" style="margin-top:-8px !important;"  placeholder="Enter total hours" required>
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