<div class="d-flex">
    <img class="p-2 align-self-end" src="/idsi.png" style="width: auto; height: 80px; border-right:1px solid #3333">
    <h3 class="p-2 align-self-end" style="color: #0d1a80; font-family: arial; font-weight: bold;">CUSTOMER WARRANTY AND MA MONITORING SYSTEM</h3>
        <div class="p-2 ml-auto align-self-end d-flex">
            <div class="p-2 ml-auto" style="text-align: right;">
                {{ \App\Models\Admin::where('id','=',session('LoggedUser'))->first()->name}} </br>
                {{Carbon\Carbon::now()->toDayDateTimeString()}}</br>
                {{\App\Models\Admin::where('id','=',session('LoggedUser'))->first()->email}}</br>
            </div>
                <i class="fa fa-user-circle fa-4x p-2" aria-hidden="true"></i>
        </div>
</div><hr>
 