<!-- Modal -->
<div id="newbranch" class="modal fade in">
    <div class="modal-dialog">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style=" background-color: #0d1a80; color:white">
            <h4 class="modal-title w-100 text-center"id ="branchTitle">CREATE NEW BRANCH</h4>
            <button class="close closeModal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id='branchform'>
          <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
          <input type="hidden" name="id" id="id">
          <div class="form-group my-4">
            <label class="control-label col-sm-4" for="branchcode">Branch Code:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="branchcode" style="margin-top:-8px !important;"  placeholder="Enter branch code" required>
            </div>
          </div>
          <div class="form-group my-4">
            <span class="col-sm-12">&nbsp;</span>
          </div>
          <div class="form-group my-4">
            <label class="control-label col-sm-4" for="branchname">Branch Name:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="branchname" style="margin-top:-8px !important;"  placeholder="Enter branch name" required>
            </div>
          </div>
          <div class="form-group my-4">
            <span class="col-sm-12">&nbsp;</span>
          </div>
          <div class="form-group my-4">
            <label class="control-label col-sm-4" for="address">Address:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="address" style="margin-top:-8px !important;"  placeholder="Enter branch address" required>
            </div>
          </div>
          <div class="form-group my-4">
            <span class="col-sm-12">&nbsp;</span>
          </div>
          <div class="form-group my-4">
            <label class="control-label col-sm-4" for="province">Province:</label>
            <div class="col-sm-8">
              <select class="form-control" id="province" style="margin-top:-8px !important; color: Gray;" required>
                <option value="" selected disabled style="color: Gray;">Select Province</option>
                @foreach ($refprovinces as $refprovince) 
                <option value="{{$refprovince->provCode}}">{{$refprovince->provDesc}}</option>
              @endforeach
              </select>
            </div>
          </div>
          <div class="form-group my-4">
            <span class="col-sm-12">&nbsp;</span>
          </div>
          <div class="form-group my-4">
            <label class="control-label col-sm-4" for="city">City:</label>
            <div class="col-sm-8">
              <select class="form-control" id="city" style="margin-top:-8px !important; color: Gray;" required>
                <option value="" selected disabled style="color: Gray;">Select City</option>
              </select>
            </div>
          </div>
          <div class="form-group my-4">
            <span class="col-sm-12">&nbsp;</span>
          </div>
          <div class="form-group my-4">
            <label class="control-label col-sm-4" for="region">Region:</label>
            <div class="col-sm-8">
              <select class="form-control" id="region" style="margin-top:-8px !important; color: Gray; cursor:default" disabled required>
                <option value="" selected disabled style="color: Gray;">Region</option>
              </select>
            </div>
          </div>
          <div class="form-group my-4">
            <span class="col-sm-12">&nbsp;</span>
          </div>
          <div class="form-group my-4">
            <label class="control-label col-sm-4" for="status">Status:</label>
            <div class="col-sm-8">
              <select class="form-control" id="status" style="margin-top:-8px !important; color: Gray;" required>
                <option value="" selected disabled style="color: Gray;">Select status</option>
                <option value="Active" style="color: Black;">Active</option>
                <option value="Inactive" style="color: Black;">Inactive</option>
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