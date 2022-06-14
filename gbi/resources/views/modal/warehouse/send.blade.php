<div id="sendModal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-full modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title w-100 text-center">STOCK REQUEST FORM</h6>
                <button class="close cancel" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mod" style="max-height:400px;overflow-y: auto;">
                <form id="sendForm">
                    {{ csrf_field() }}
                    <div class="row no-margin">
                        <div class="col-md-6 form-group row">
                            <label for="bname" style="color: black" class="col-md-5 col-form-label text-md-right">Date requested:</label>
                            <div class="col-md-7">
                                <input type="text" style="color: black" class="form-control form-control-sm " name="date" id="sdate" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 form-group row">
                            <label for="reqno" class="col-md-4 col-form-label text-md-right">Request no.:</label>
                            <div class="col-md-8">
                                <input type="text" style="color: black" class="form-control form-control-sm " name="reqno" id="sreqno" placeholder="1-001" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="col-md-6 form-group row">
                            <label for="branch" class="col-md-5 col-form-label text-md-right">Branch name:</label>
                            <div class="col-md-7">
                                <input type="text" style="color: black" class="form-control form-control-sm " name="branch" id="sbranch" value="{{ auth()->user()->branch->branch }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Requested by:</label>
                            <div class="col-md-8">
                                <input type="text" style="color: black" class="form-control form-control-sm " name="name" id="sname" value="{{ auth()->user()->name }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="col-md-6 form-group row">
                            <label class="col-md-5 col-form-label text-md-right">Date schedule:</label>
                            <div class="col-md-7">
                                <input type="text" style="color: black" class="form-control form-control-sm datepicker" name="datesched" id="datesched" readonly="readonlyy" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </form>
                <div>
                    <h5 class="modal-title w-100 text-center">REQUEST DETAILS</h5>
                </div>
                <table class="table-hover table sendDetails" style="height: 150px;width:100%;font-size:80%">
                    <thead class="thead-dark">
                        <th>Item Code</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Stock Available</th>
                    </thead>
                </table>
            </div>
            <div class="modal-header">
                <h6 class="modal-title w-100 text-center">ENTER ITEM HERE</h6>
            </div>
            <div class="modal-body" id="reqfield">
            </div>
            <hr>
            <div class="modal-footer">
                <input type="button" class="btn btn-primary save_Btn" id="save_Btn" class="button" value="Save Only" hidden>
                <input type="button" class="btn btn-primary sub_Btn" id="sub_Btn" class="button" value="Submit" disabled>
            </div>
        </div>
    </div>
</div>
