<!-- Modal -->
<div id="newleave" class="modal fade in">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header" style=" background-color: #0d1a80; color:white">
              <h4 class="modal-title w-100 text-center" id ="leaveTitle">CREATE NEW LEAVE</h4>
              <button class="close closeModal" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
        <div class="modal-body">
          <form id='newleaveform'>
                <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                <input type="hidden" name="id" id="id">
                <div>
                  <div class="col-sm-4">
                    <label>Leave Code:</label>
                  </div>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="leavecode" style="margin-top:-8px !important;"  placeholder="Enter leave code" required>
                  </div>
                </div>
                <div>
                  <span class="col-sm-12">&nbsp;</span>
                </div>
                <div>
                  <div class="col-sm-4">
                    <label>Leave Type:</label>
                  </div>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="leavetype" style="margin-top:-8px !important;"  placeholder="Enter leave type" required>
                  </div>
                </div>
                <div>
                  <span class="col-sm-12">&nbsp;</span>
                </div>
                <div>
                  <div class="col-sm-4">
                    <label>No of Days:</label>
                  </div>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="noofdays" style="margin-top:-8px !important;"  placeholder="Enter the no. of days" required>
                  </div>
                </div>
                <div>
                  <span class="col-sm-12">&nbsp;</span>
                </div>
                <div>
                  <div class="col-sm-4">
                    <label>Availment Month:</label>
                  </div>
                  <div class="col-sm-8">
                    <select class="form-control" id="availmonthfrom" style="margin-top:-8px !important; color: Gray;" required>
                      <option value="" selected disabled style="color: Gray;">From the month of </option>
                      <option value="1" style="color: Black;">January</option>
                      <option value="2" style="color: Black;">February</option>
                      <option value="3" style="color: Black;">March</option>
                      <option value="4" style="color: Black;">April</option>
                      <option value="5" style="color: Black;">May</option>
                      <option value="6" style="color: Black;">June</option>
                      <option value="7" style="color: Black;">July</option>
                      <option value="8" style="color: Black;">August</option>
                      <option value="9" style="color: Black;">September</option>
                      <option value="10" style="color: Black;">October</option>
                      <option value="11" style="color: Black;">November</option>
                      <option value="12" style="color: Black;">December</option>
                    </select>
                  </div>
                </div>
                <div>
                  <span class="col-sm-12">&nbsp;</span>
                </div>
                <div>
                  <div class="col-sm-4">
                    <label></label>
                  </div>
                  <div class="col-sm-8">
                    <select class="form-control" id="availmonthto" style="margin-top:-8px !important; color: Gray;" required>
                      <option value="" selected disabled style="color: Gray;">To the month of</option>
                      <option value="1" style="color: Black;">January</option>
                      <option value="2" style="color: Black;">February</option>
                      <option value="3" style="color: Black;">March</option>
                      <option value="4" style="color: Black;">April</option>
                      <option value="5" style="color: Black;">May</option>
                      <option value="6" style="color: Black;">June</option>
                      <option value="7" style="color: Black;">July</option>
                      <option value="8" style="color: Black;">August</option>
                      <option value="9" style="color: Black;">September</option>
                      <option value="10" style="color: Black;">October</option>
                      <option value="11" style="color: Black;">November</option>
                      <option value="12" style="color: Black;">December</option>
                    </select>
                  </div>
                </div>
                <div>
                  <span>&nbsp;</span>
                </div>
                <div>
                  <div class="col-sm-4">
                    <label>Days to avail:</label>
                  </div>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="noofdaystoavail" style="margin-top:-8px !important;"  placeholder="Enter the no. of days to avail" required>
                  </div>
                </div>
                <div>
                  <span class="col-sm-12">&nbsp;</span>
                </div>
                <div>
                  <div class="col-sm-4">
                    <label>Activation:</label>
                  </div>
                  <div class="col-sm-8">
                      <select class="form-control" id="activation" style="margin-top:-8px !important; color: Gray;" required>
                        <option value="" selected disabled style="color: Gray;">Select activation</option>
                          @foreach($activation as $activations)
                            <option value="{{$activations->name}}" style="color: Black;">{{strtoupper($activations->name)}}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
                <div>
                  <span class="col-sm-12">&nbsp;</span>
                </div>
                <div>
                  <div class="col-sm-4">
                  <label>Expiration:</label>
                  </div>
                  <div class="col-sm-8">
                    <select class="form-control" id="expiration" style="margin-top:-8px !important; color: Gray;" required>
                      <option value="" selected disabled style="color: Gray;">Select expiration</option>
                      <option value="One Year" style="color: Black;">One Year</option>
                      <option value="Accumulative" style="color: Black;">Accumulative</option>
                    </select>
                  </div>
                </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default bp closeModal" data-dismiss="modal">Cancel</button>
          <input type="button" id="btnSave" class="btn btn-primary bp" value="Save">
        </div>
      </div>
    </div>
  </div>