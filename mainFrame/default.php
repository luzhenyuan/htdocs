<?php
//废弃代码
echo "<h2>角色操作</h2>";
echo "<form action='default.php' method='post'>
        角色ID：<input type='text' name='showID'><br>
        玩家杯数：<input type='text' name='score' value='0'><br>
        道具ID：<input type='text' name='itemID' value='0'><br><br>
        <input type='submit'>
    </form>";
echo "<table border='1'>";
echo "<tr><th>itemid</th><th>itemnum</th></tr>";
include ("..\config\servercon.php"); //导入配置
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //判断post传参，取对应参数赋值
    $score = trim($_REQUEST["score"]);
    $showID = trim($_REQUEST["showID"]);
    $itemID = trim($_REQUEST["itemID"]);
    //正则匹配用于区分区服
    preg_match('/^[0-9]{3}/',$showID,$Front);
    preg_match('/[0-9]{6}$/',$showID,$Behind);
    if (strlen(rtrim($Front[0], '0')) == 2){
        $serverid = rtrim($Front[0], '0');
    }else{
        $serverid = $Front[0];
    }
    $dbname = "db_mszc_role_".$serverid;
    class TableRows extends RecursiveIteratorIterator {
        function __construct($it) { 
            parent::__construct($it, self::LEAVES_ONLY); 
        }
        function current() {
            return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
        }
 
        function beginChildren() { 
            echo "<tr>"; 
        } 
 
        function endChildren() { 
            echo "</tr>" . "\n";
        } 
    } 
 
    try {
        if (strlen(rtrim($Front[0], '0')) == 2){
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        }
        else{
            $conn = new PDO("mysql:host=$servername1;dbname=$dbname", $username1, $password1);
        }
        // 设置 PDO 错误模式为异常
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT itemid, itemNum, roleID FROM item1 where roleID LIKE '%$Behind[0]'"); 
        $dwl = $conn->prepare("UPDATE item1 SET itemNum = 1 WHERE roleID LIKE '%$Behind[0]'"); 
        $dwl->execute();
        $stmt->execute();
        
        // 设置结果集为关联数组
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
            echo $v;
        }
        }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    echo "</table>";
    }


?>