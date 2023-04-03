<?php 
//读取item表数据，空出三行标题
$file = fopen('D:\client\towerlands\assets\resources\StaticData\ItemTableData.csv','r'); 
// $file = fopen('D:\client\branches\wechatGameOnline\assets\resources\StaticData\ItemTableData.csv','r'); 

fgetcsv($file);
fgetcsv($file);
fgetcsv($file);
while ($data = fgetcsv($file)) { //每次读取CSV里面的一行内容
    //此为一个数组，要获得每一个数据，访问数组下标即可
    $goods_list[] = $data;
 }
fclose($file);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  //获取前端itemid
  $q=$_GET["q"];
  if (strlen($q) > 0){
    $hint="";
    $hint1="";
    if(preg_match('/^[1-9][0-9]*$/', $q) > 0){
      for($i=0; $i<count($goods_list); $i++){
        if ($q==$goods_list[$i][0]){
          //查id
          if ($hint==""){
            $hint=$goods_list[$i][1];
          }
        }
      }
    }else{
      for($i=0; $i<count($goods_list); $i++){
        if ($q==$goods_list[$i][1]){
          //查名字
          if ($hint1==""){
            $hint1=$goods_list[$i][0];
          }
        }
      }
    }
  }
  
  if ($hint == "" and $hint1 == ""){
    $response="没找到物品";
  }elseif(preg_match('/^[1-9][0-9]*$/', $q) > 0){
    $response=$hint;
  }else{
    $response=$hint1;
  }
  //返回itemname
  echo $response;
}
?>


