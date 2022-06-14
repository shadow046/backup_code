<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iclock;


class IclockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $devserial = $request->SN."\n";
        $option = $request->option;
        
        // $response = "GET OPTION FROM: " . $devserial . "\n";
        // $response = $response . "Stamp=82983982\n";
        // $response = $response . "OPStamp=0\n";
        // $response = $response . "ErrorDelay=60\n";
        // $response = $response . "Delay=30\n";
        // $response = $response . "TransTimes=00:00;23:59\n";
        // $response = $response . "TransInterval=1\n";
        // $response = $response . "TransFlag=1111000000\n";
        // $response = $response . "Realtime=1\n";
        // $response = $response . "Encrypt=0\n";
        // return $response;
        // if (DtrUploadClientHttpServer.lasttxndatetime.trim().length() > 0) {
        // $response = $response . "ATTLOGStamp=" . DtrUploadClientHttpServer.dateTimeFormat01.format(DtrUploadClientHttpServer.dateTimeFormat00.parse(DtrUploadClientHttpServer.lasttxndatetime)) . "\n";
        // $response = $response . "OPERLOGStamp=" . DtrUploadClientHttpServer.dateTimeFormat01.format(DtrUploadClientHttpServer.dateTimeFormat00.parse(DtrUploadClientHttpServer.lasttxndatetime)) . "\n";
        // $response = $response . "ATTPHOTOStamp=" . DtrUploadClientHttpServer.dateTimeFormat01.format(DtrUploadClientHttpServer.dateTimeFormat00.parse(DtrUploadClientHttpServer.lasttxndatetime)) . "\n";
        // }
        $save = new Iclock;
        $save->id = '1'.$request;
        $save->Save();
        if ($request->options == 'all') {
            $save = new Iclock;
            $save->id = $request;
            $save->Save();
            $save = new Iclock;
            $save->id = $devserial;
            $save->Save();
            $return = "GET OPTION FROM: {$devserial}";
            $array = [
                'Stamp' => 0,
                'OpStamp' => 0,
                'PhotoStamp' => 0,
                'ErrorDelay' => 30,
                'Delay' => 30,
                'TransFlag' => '1111000000',
                'Realtime' => 1,
                'TransInterval'=>0,
                'Encrypt' => 0,
                'ServerVer' => '3.4.1 20100607',
                'ATTLOGStamp'=>'2020-09-01T00:00:01',
                'OPERLOGStamp'=>'2020-09-01T00:00:01',
                'ATTPHOTOStamp'=>'2020-09-01T00:00:01',
                'SyncTime'=>3600
            ];
            $unix_time = date_default_timezone_set('GMT');
            header("HTTP/1.0 200 OK");
            header("Content-Type: text/plain");
            header("Date:".$unix_time);
            $string = "";
            foreach ($array as $key => $val)$return .= $key .'='.$val.PHP_EOL;
            $save = new Iclock;
            $save->id = $return;
            $save->Save();
            return $return;
        }
        else{
            if($request->table == 'ATTLOG')
            {
                // Obtenir l'heure et le numéro de la carte
                $stamp = json_encode(Request::param('Stamp'));
                // file_put_contents('ATTLOG.txt',$stamp.PHP_EOL,FILE_APPEND);
                // $text = json_encode(file_get_contents("php://input"));
                // file_put_contents('ATTLOG1.txt',$text.PHP_EOL,FILE_APPEND);
                $save = new Iclock;
                $save->id = $stamp;
                $save->Save();
                return "OK";
            }
        }

    }
    public function post(Request $request)
    {
        $dev =$request->SN;
        $Stamp = $request->Stamp;
        $save = new Iclock;
        $save->id = $request->Stamp.'testing';
        $save->Save();

        if($request->table == 'ATTLOG')
            {
                // Obtenir l'heure et le numéro de la carte
                $stamp = json_encode(Request::param('Stamp'));
                // file_put_contents('ATTLOG.txt',$stamp.PHP_EOL,FILE_APPEND);
                // $text = json_encode(file_get_contents("php://input"));
                // file_put_contents('ATTLOG1.txt',$text.PHP_EOL,FILE_APPEND);
                $save = new Iclock;
                $save->id = $stamp;
                $save->Save();
                return response("OK");
            }
        return 'OK';
        if ($Stamp==99999999) {
            $save = new Iclock;
            $save->id = $request->dev;
            $save->Save();
            if ($save) {
                return 'OK';
            }
        }
    }
}
