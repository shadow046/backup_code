@extends('layouts.app')

@section('content')
<div class="table-responsive">
    <div style="float: right;" class="pt-3">
        <b>SEARCH&nbsp;&nbsp;</b><a href="#" id="search-ic"><i class="fa fa-lg fa-search" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>
    <table class="table-hover table posTable" id="posTable" style="font-size:80%">
        <thead class="thead-dark">
            <tr class="tbsearch" style="display:none">
                    <td>
                        <input type="text" class="form-control filter-input fl-0" data-column="0">
                    </td>
                    <td>
                        <input type="text" class="form-control filter-input fl-1" data-column="1" />
                    </td>
                    <td>
                        <input type="text" class="form-control filter-input fl-2" data-column="2" />
                    </td>
                    <td>
                        <input type="text" class="form-control filter-input fl-3" data-column="3" />
                    </td>
                    <td>
                        <input type="text" class="form-control filter-input fl-4" data-column="4" />
                    </td>
            </tr>
            <tr>
                <th>
                    Date
                </th>
                <th>
                    DR no.
                </th>
                <th>
                    POS Model
                </th>
                <th>
                    Serial
                </th>
                <th>
                    Client
                </th>
            </tr>
        </thead>
    </table>
</div>
@endsection