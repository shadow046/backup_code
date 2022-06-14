<?php
namespace app\iclock\controller;
use think\Controller;
use think\facade\Request;
use app\iclock\model\Mechine;
use app\iclock\model\Checklog;
use think\facade\Log;
use app\iclock\model\Cmds;
//use app\mobile\controller\Pushcheck;
class Cdata extends Controller
{
    public function login()
    {
    //exit;
        $flag = json_encode(Request::param());
        $sn = Request::param('SN');
        file_put_contents('log.txt',$flag.PHP_EOL,FILE_APPEND);
        //1. Déterminer si la machine de présence existe
        $res = Mechine::where('sn',$sn)->find();
        if($res)
        {
        //Existe, Mettre à jour d'abord les informations de la machine de présence
            Mechine::where('sn',$sn)->update(['update_time'=>time()]);
            if(Request::param('options') == 'all')
            {
                // Recevoir un message de la machine de présence pour la première fois
                $return = "GET OPTION FROM : {$sn}";
                $array = [
                    'Stamp' => time(),
                    'OpStamp' => time(),
                    'PhotoStamp' => time(),
                    'ErrorDelay' => 30,
                    'Delay' => 30,
                    'TransFlag' => '0000000000',
                    'Realtime' => 1,
                    'TransInterval'=>0,
                    'Encrypt' => 0,
                    'ServerVer' => '2.32 '.date('Y-m-d'),
                    'ATTLOGStamp' => time(),
                    'ATTPHOTOStamp'=>time(),
                ];
                $unix_time = date_default_timezone_set('GMT');
                header("HTTP/1.0 200 OK");
                header("Content-Type: text/plain");
                header("Date:".$unix_time);
                $string = "";
                foreach ($array as $key => $val)
                $return .= $key .'='.$val.PHP_EOL;
                return ($return)->header('Content-Type', 'text/plain')->header("Date:".$unix_time);
            }
            else
            {
                if(Request::param('table') == 'ATTLOG')
                {
                    // Obtenir l'heure et le numéro de la carte
                    $stamp = json_encode(Request::param('Stamp'));
                    // file_put_contents('ATTLOG.txt',$stamp.PHP_EOL,FILE_APPEND);
                    $text = json_encode(file_get_contents("php://input"));
                    file_put_contents('ATTLOG1.txt',$text.PHP_EOL,FILE_APPEND);
                    return "ok";
                }
                elseif(Request::param('table') == 'OPERLOG')
                {
                    $stamp = json_encode(Request::param());
                    //file_put_contents('OPERLOG.txt',$stamp.PHP_EOL,FILE_APPEND);
                    $text = json_encode(file_get_contents("php://input"));
                    // file_put_contents('OPERLOG1.txt',$text.PHP_EOL,FILE_APPEND);
                    return "ok";
                }
                elseif(Request::param('table') == 'ATTPHOTO')
                {
                    $text = file_get_contents("php://input");
                    file_put_contents('1111a.txt',$text,FILE_APPEND);
                    $str2 = substr($text,68);
                    $filepath = 'attendance/';
                    if(!is_dir($filepath))mkdir($filepath,0777,true);
                    $filename=$filepath.time().'.jpg';
                    $tmp = explode('.jpg', $text);
                    $pin = explode('-', $tmp[0]);
                    $checktimetmp = $pin[0];
                    $checktime = explode('=', $checktimetmp);
                    $checktime = strtotime($checktime[1]);
                    //pin: Numéro d'emploi de l'utilisateur
                    $pin = $pin[1];
                    if($pin){ // Authentification de l'utilisateur réussie
                        //sn:Numéro du matériel
                        $sntmp = explode('=', $text);
                        $sn = str_replace('size', '', $sntmp[2]);
                        $checklog = model('Checklog')->get(['pin'=>$pin,'checktime'=>$checktime,'sn'=>$sn]);
                        if($checklog){
                            return iconv("UTF-8", "GB2312//IGNORE", 'ok');
                        }else{
                            file_put_contents($filename,$str2);
                            file_put_contents('ATTPHOTO1.txt',$str2.PHP_EOL,FILE_APPEND);
                            $info = Cmds::get
                            (function($query) use ($pin)
                                {
                                    $query->where(['pin'=>$pin,'status'=>1])->order('update_time desc')->field('card,student_name');
                                }
                            );
                            $card = $info->card;
                            $student_name = $info->student_name;
                            $model = new Checklog();
                            $rs = $model->save(['pin'=>$pin,'checktime'=>$checktime,'pic'=>$filename,'sn'=>$sn,'card'=>$card,'student_name'=>$student_name]);
                            if(!$rs){
                                $rs = $model->save(['pin'=>$pin,'checktime'=>$checktime,'pic'=>$filename,'sn'=>$sn,'card'=>$card,'student_name'=>$student_name]);
                            }
                            // Pousser les informations de présence
                            // $this->sendTempletemsg($model->id);
                            $this->https_request('https://'.config('domain').'/mobile/pushcheck/sendTempletemsg?checkid='.$model->id);
                        }
                        return iconv("UTF-8", "GB2312//IGNORE", 'ok');
                    }
                        /*Fin*/
                }
            }
        }
        else
        {
            //N'existe pas, Écrivez les informations de la machine de présence
            $data = ['sn' => $sn,'options'=>$flag,'create_time'=>time()];
            Mechine::insert($data);
        }
    }
    function get_contents() {
        $xmlstr = file_get_contents('php://input')?file_get_contents('php://input') : gzuncompress($GLOBALS['HTTP_RAW_POST_DATA']);//Je l'ai.postLes données binaires brutes arrivent
        $filename=time().'.png';
        if(file_put_contents($filename,$xmlstr)){
            echo 'success';
        }else{
            echo 'failed';
        }
    }
// Une chaîne entre deux chaînes
    public function str_between(){
        $str = 'DATA UPDATE USERINFO PIN=1\tName=Tests2\tPasswd=123456\tPri=14\tsCard=[1985100]';
        $str1 = 'Name=';
        $str2 = '\tPasswd';
        $start = mb_strpos($str,$str1)+mb_strlen($str1);
        $end = mb_strpos($str,$str2);
        $length = $end-$start;
        dump($length);
        $needle = mb_substr($str,$start,$length,'utf8');
        dump($needle);
        return $needle;
    }
    // Envoyer un message de modèle push de présence
    public function sendTempletemsg($checkid){
        // $checkid = input('param.checkid'); //Horloge de présenceid
        $checkinfo = Checklog::get(intval($checkid)); // Informations sur l'horloge de présence
        if(!$checkinfo)return;
        $card_sn = $checkinfo->card; //Numéro de la carte
        $user = model('user')->get(array('card_sn'=>$card_sn)); // Rechercher des informations sur les étudiants par numéro de carte
        if(!$user)return;
        $user_id = $user->id;
        $parentinfo = model('wxuser')->all(array('user_id'=>intval($user_id))); // La requête lie tous les parents et enseignants de l'étudiant
        $access_token = $this->getWXToken();
        $url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$access_token;
        foreach ($parentinfo as $key=>$value){
            $openid = $value->openid;
            $data = array(
                "touser"=>$openid,
                "template_id"=>"Y44crAtSKT47r8Cd5mnCM844vn7Iw6uVvU2Dq7p2tng",
                'url'=>'http://'.config('domain').'/'.$checkinfo->pic,
                'data'=>array(
                    'first'=>array(
                        'value'=>'Bonjour, Vous avez un rappel de présence ！',
                        'color'=>'#41495e'
                    ),
                    'keyword1'=>array(
                        'value'=>$user['real_name'], //Nom de l'étudiant
                    ),
                    'keyword2'=>array(
                        'value'=>date('Y-m-d H:i:s',$checkinfo->checktime), //Temps de frappe
                    ),
                    'keyword3'=>array(
                        'value'=>$checkinfo->status, // État de présence
                    ),
                    'keyword4'=>array(
                        'value'=>$checkinfo->card, // Numéro de carte de transfert
                    ),
                    'keyword5'=>array(
                        'value'=>$checkinfo->address, //Lieu
                    ),
                    "remark"=>array(
                        'value'=>" Cliquez pour voir les photos de présence ",
                        'color'=>'#41495e'
                    )
                )
            );
            $result = $this->https_request($url,json_encode($data));
            $result = json_decode($result,true);
            if($result['errcode'] == 0){
                // Enregistrer les notifications Push
                $model = new Checklog();
                $model->save(['pushstate'=>1],['id'=>$checkid]);
                return true;
            }else{
            //La poussée a échoué TODO
                return false;
            }
        }
    }
//Accès à Wechataccess_token
    public function getWXToken(){
    // error_reporting(E_ERROR | E_WARNING | E_PARSE);
    // $wxconfig = config('wxconfig');
    // $cache_file = dirname(__FILE__).'/../../../access_token.json';
    // if(file_exists($cache_file)) $info = json_decode(file_get_contents($cache_file),true);
    // if($info['access_token'] && $info['expire_time']>time()){
    // return $info['access_token'];
    // }
    // $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$wxconfig['appid'].'&secret='.$wxconfig['appsecret'];
    // $result = $this->https_request($url);
    // $data = json_decode($result,true);
    // if($data['access_token']){
    // $arr = array();
    // $arr['access_token'] = $data['access_token'];
    // $arr['expire_time'] = time() + 7000;
    // file_put_contents($cache_file,json_encode($arr));
    // return $data['access_token'];
    // }
    // else return '';
    }
//httpsDemande（SoutienGETEtPOST）
    public function https_request($url, $data = null){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
}