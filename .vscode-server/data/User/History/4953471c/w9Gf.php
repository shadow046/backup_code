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
         <input type="checkbox" name="category[]" value="Laravel">
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