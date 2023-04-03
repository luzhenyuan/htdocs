<?php
include ("..\config\servercon.php");
// $_SERVER["REQUEST_METHOD"] == "POST" and 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $post = array(
                'rolename' => $_REQUEST['rolename'],
                'gettype' => $_REQUEST['gettype'],
                'flag' => $_REQUEST['flag'],
             ); 
}

function get_html($url){
    $ch = curl_init();//初始化cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //返回原生的（Raw）输出
    curl_setopt($ch, CURLOPT_HTTPHEADER,
        array(
            'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
            'content-type: application/x-www-form-urlencoded',
            'Cookie: PHPSESSID='.$GLOBALS['PHPSESSID'],
          )); 
    // curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
    // $response = curl_exec($ch);
    curl_exec($ch);
    // curl_exec($ch);
    curl_close($ch);
}
$z=111;
// echo 'http://192.168.1.242/gmsys_mszc_lzy/web/index.php?actionid=404&t=4&itemID='.$z.'&roleID=670000000000001&itemLevel=25'
get_html('http://192.168.1.242/gmsys_mszc_lzy/web/index.php?actionid=404&t=4&itemID=1&roleID=670000000000085&itemLevel=25');

// switch ($_REQUEST["modify"])
// {
// case '查询':
//     // print_r($GLOBALS['post']);
//     // ?actionid=404&t=4&itemID=1&roleID=670000000000001&roleLevel=1&itemLevel=1&itemNum=1&itemName=冰骑
//     get_html('http://192.168.1.242/gmsys_mszc_lzy/web/index.php?actionid=404&t=4&itemID=1&roleID=670000000000001&roleLevel=1&itemLevel=25&itemNum=1&itemName=冰骑');
//     break;
// default:
//     echo '没找到指令';
// }



?>