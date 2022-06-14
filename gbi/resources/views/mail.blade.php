<div>
    <p style="color:blue;"><b>This is a system-generated email. Please do not reply.</b></p>
    <table>
        <tbody>
            <tr style="height:14pt">
                <td width="707" colspan="2" valign="top" style="width:690pt;border-top:none;border:solid #d9d9d9 1.0pt;background:red;"></td>
            </tr>
            <tr style="height:50pt">
                <td width="707" colspan="2" valign="top" style="width:690pt;border-top:none;border:solid #d9d9d9 1.0pt;background:white;">
                    <p><img src="{{asset('idsi.png')}}" height="50"/></p>
                </td>
            </tr>
            <tr style="height:14pt">
                <td width="707" colspan="2" valign="top" style="width:690pt;border-top:none;border:solid #d9d9d9 1.0pt;background:white;">
                    <p>Stock Request {{ $reqno }} has been submitted.</p>
                </td>
            </tr>
            <tr style="height:14pt">
                <td width="165" style="width:143;border-top:none;border:solid #d9d9d9 1.0pt;background:white;">
                    <p>Requested item/s</p>
                </td>
                <td width="542" style="width:546pt;border-top:none;border:solid #d9d9d9 1.0pt;background:white;">
                    <p>
                        <span style="color:black">
                            <ul>
                                @foreach ($reqitem as $item)
                                    <li>{{ $item->item }} - {{ $item->quantity }}</li>
                                @endforeach
                            </ul>
                        </span>
                    </p>
                </td>
            </tr>
            <tr style="height:14pt">
                <td width="165" style="width:143;border-top:none;border:solid #d9d9d9 1.0pt;background:white;">
                    <p>Requested for:</p>
                </td>
                <td width="542" style="width:546pt;border-top:none;border:solid #d9d9d9 1.0pt;background:white;">
                    <p>
                        <span style="color:black">
                           {{auth()->user()->branch->branch}}
                        </span>
                    </p>
                </td>
            </tr>
            <tr style="height:14pt">
                <td width="165" style="width:143;border-top:none;border:solid #d9d9d9 1.0pt;background:white;">
                    <p>Requested by:</p>
                </td>
                <td width="542" style="width:546pt;border-top:none;border:solid #d9d9d9 1.0pt;background:white;">
                    <p>
                        <span style="color:black">
                           {{auth()->user()->name}}
                        </span>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</div>