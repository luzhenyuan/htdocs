<?php
include('csv.php');
include ("..\config\servercon.php");
// $_SERVER["REQUEST_METHOD"] == "POST" and 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(preg_match('/^[1-9][0-9]*$/', $_REQUEST['itemId']) > 0 or $_REQUEST['itemId'] === ''){
            $post = array(
                'showID' => $_REQUEST['showID'],
                'showID1' => $_REQUEST['showID1'],
                'itemId' => $_REQUEST['itemId'],
                'itemNum' => $_REQUEST['itemNum'],
                'itemlevel' => $_REQUEST['itemlevel'],
                'flag' => $_REQUEST['flag'],
                'roleScore' => $_REQUEST['roleScore'],
             ); 
    }else{
        for($i=0; $i<count($GLOBALS['goods_list']); $i++){
            if($GLOBALS['goods_list'][$i][1] == $_REQUEST['itemId']){
                $post = array(
                    'showID' => $_REQUEST['showID'],
                    'itemId' => $GLOBALS['goods_list'][$i][0],
                    'itemNum' => $_REQUEST['itemNum'],
                    'itemlevel' => $_REQUEST['itemlevel'],
                    'flag' => $_REQUEST['flag'],
                    'roleScore' => $_REQUEST['roleScore'],
                ); 
            }
        }
   }
}

function get_html($url, $request_method = "GET", $PHPSESSID = ""){
    $ch = curl_init();//初始化cURL
    if ($request_method === "POST") {
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($GLOBALS['post']));//POST数据
    }
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //返回原生的（Raw）输出
    curl_setopt($ch, CURLOPT_HTTPHEADER,
        array(
            'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
            'content-type: application/x-www-form-urlencoded',
            'Cookie: PHPSESSID='.$PHPSESSID,
          )); 
    // curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
    curl_exec($ch);
    curl_close($ch);
}



function Get_BigNumItem(){
    $hero = [];
    for($i=0; $i<count($GLOBALS['goods_list']); $i++){
        if($GLOBALS['goods_list'][$i][2] == "2"){
            //英雄
            // echo $GLOBALS['goods_list'][$i][0].$GLOBALS['goods_list'][$i][1].'<br>';
            array_push($hero, $GLOBALS['goods_list'][$i][0]);
        }
    }
    return $hero; 
}
function Get_SmallNumItem(){
    // global $GLOBALS['goods_list'];
    $SmallNumItem = [];
    for($i=0; $i<count($GLOBALS['goods_list']); $i++){
        switch ($GLOBALS['goods_list'][$i][2]){
            case 10:
                //信使
                // echo $GLOBALS['goods_list'][$i][0].$GLOBALS['goods_list'][$i][1].'<br>';
                array_push($SmallNumItem, $GLOBALS['goods_list'][$i][0]);
                break;
            case 11:
                //战车
                // echo $GLOBALS['goods_list'][$i][0].$GLOBALS['goods_list'][$i][1].'<br>';
                array_push($SmallNumItem, $GLOBALS['goods_list'][$i][0]);
                break;
        }
    }
    return $SmallNumItem; 
}

function Get_other(){
    $other = [];
    for($i=0; $i<count($GLOBALS['goods_list']); $i++){
        switch ($GLOBALS['goods_list'][$i][2]){
            // case 5:
                //头像框
                // echo $GLOBALS['goods_list'][$i][0].$GLOBALS['goods_list'][$i][1].'<br>';
                // array_push($other, $GLOBALS['goods_list'][$i][0]);
                // break;
            case 12:
                //皮肤
                // echo $GLOBALS['goods_list'][$i][0].$GLOBALS['goods_list'][$i][1].'<br>';
                array_push($other, $GLOBALS['goods_list'][$i][0]);
                break;
        }
    }
    return $other; 
}

function Send_Big(){ 
    //发英雄
    foreach(Get_BigNumItem() as $x){
        $GLOBALS['post']['itemNum'] = 500;//默认数量
        $GLOBALS['post']['itemId'] = $x;
        get_html('http://192.168.1.242/gmsys_mszc_lzy/web/index.php?actionid=316', "POST", $GLOBALS['PHPSESSID']);
            // get_html1("http://192.168.1.242/gmsys_mszc_lzy/web/index.php?actionid=404&t=4&itemID=".$GLOBALS['goods_list'][$i][0]."&roleID=".$GLOBALS['post']['showID1']."&itemLevel=".$GLOBALS['post']['itemlevel']);
    }
}
function item_level(){ 
    //等级
    foreach(Get_BigNumItem() as $x){
        get_html("http://192.168.1.242/gmsys_mszc_lzy/web/index.php?actionid=404&t=4&itemID=".$x."&roleID=".$GLOBALS['post']['showID1']."&itemLevel=".$GLOBALS['post']['itemlevel'], "GET", $GLOBALS['PHPSESSID']);
    }
}
function Send_Small(){ 
    //发信使和战车
    $GLOBALS['post']['itemNum'] = 500;//默认数量
    foreach(Get_SmallNumItem() as $x){
        $GLOBALS['post']['itemId'] = $x;
        get_html('http://192.168.1.242/gmsys_mszc_lzy/web/index.php?actionid=316', "POST", $GLOBALS['PHPSESSID']);
     }
}

function Send_other(){ 
    //发头像框和皮肤
    $GLOBALS['post']['itemNum'] = 1;//默认数量
    foreach(Get_other() as $x){
        $GLOBALS['post']['itemId'] = $x;
        get_html('http://192.168.1.242/gmsys_mszc_lzy/web/index.php?actionid=316', "POST", $GLOBALS['PHPSESSID']);
     }
}

function One_key_strongest(){
    Send_Big();
    Send_Small();
    Send_other();
    item_level();
    //金币，钻石，广告卡，扫荡券，恶魔果
    $money = array('1001','1002','1007','1010','1012');
    foreach($money as $x){
        if ($x === '1001' or $x === '1002') {
            $GLOBALS['post']['itemNum'] = 100000000;//默认数量
            $GLOBALS['post']['itemId'] = $x;
            get_html('http://192.168.1.242/gmsys_mszc_lzy/web/index.php?actionid=316', "POST", $GLOBALS['PHPSESSID']);
        }else{
            $GLOBALS['post']['itemNum'] = 10000;//默认数量
            $GLOBALS['post']['itemId'] = $x;
            get_html('http://192.168.1.242/gmsys_mszc_lzy/web/index.php?actionid=316', "POST", $GLOBALS['PHPSESSID']);
        }
    }
    $GLOBALS['post']['roleScore'] = 30000;//默认杯数
    get_html('http://192.168.1.242/gmsys_mszc_lzy/web/index.php?actionid=316', "POST", $GLOBALS['PHPSESSID']);
}

switch ($_REQUEST["modify"])
{
case '修改':
    if($GLOBALS['post']['itemId'] === "" and $GLOBALS['post']['itemlevel'] === ""){
        // print_r($GLOBALS['post']);
        get_html('http://192.168.1.242/gmsys_mszc_lzy/web/index.php?actionid=311');
    }elseif($GLOBALS['post']['roleScore']  === "" and $GLOBALS['post']['itemlevel'] === ""){
        // print_r($GLOBALS['post']);
        get_html('http://192.168.1.242/gmsys_mszc_lzy/web/index.php?actionid=316');
    }elseif($GLOBALS['post']['itemId'] === "" and $GLOBALS['post']['roleScore'] === ""){
        item_level();
    }elseif($GLOBALS['post']['itemId'] != "" and $GLOBALS['post']['itemlevel'] != ""){
        get_html1("http://192.168.1.242/gmsys_mszc_lzy/web/index.php?actionid=404&t=4&itemID=".$GLOBALS['post']['itemId']."&roleID=".$GLOBALS['post']['showID1']."&itemLevel=".$GLOBALS['post']['itemlevel']);
    }else{
        get_html('http://192.168.1.242/gmsys_mszc_lzy/web/index.php?actionid=316');
        get_html('http://192.168.1.242/gmsys_mszc_lzy/web/index.php?actionid=311');
    }
    header('location:add.html');//重定向
    break;
case '一键牛逼':
    One_key_strongest();
    // Send_Big();
    header('location:add.html');//重定向
    // print_r(Get_BigNumItem());
    break;
default:
    echo '没找到指令';
}

?>