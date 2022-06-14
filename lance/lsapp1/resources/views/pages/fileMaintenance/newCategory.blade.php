<div class="modal fade in" id="newCategory">
    <div class="modal-dialog modal-m">
    <div class="modal-content">
        <div class="modal-header text-center" style="background-color: #0d1a80; color: white; height: 45px;">
            <h6 class="modal-title w-100">ADD NEW CATEGORY</h6>    
            <button type="button" class="btn-close btn-close-white close" id="close" data-dismiss="modal"></button>
        </div>
        <div class="modal-body" style="background-color: white; color: black;">                
            <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
            <div class="form-inline">
                <label class="form-control form-control-sm" style="width:120px;">Category Name</label>
                <input class="form-control form-control-sm" id="category" style="width: 335px; margin-right: 10px;" type="text" maxlength="255">
            </div>
            <button type="button" id="btnSaveCategory" class="btn btn-primary float-right bp" style="margin-right: 10px; margin-top: 10px;">SUBMIT</button>
        </div>
    </div>
    </div>
</div>