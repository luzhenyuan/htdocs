<?php
include ("..\config\servercon.php");
include ("..\config\batcon.php");
echo "<h2>Step 1：服务器操作（服务器没在提审时才可操作）</h2>
<h>tips:关启服请等待 <b>'执行完毕'</b> 提示后在进行下一步操作！</h>";
echo "<form action='delete.php' method='post' style='font-size:30px'>
        <select name='serkey' style='font-size:20px'>
            <option value='rs'>燃烧军团</option>
            <option value='tz'>天灾军团</option>
            <option value='zx'>中心服</option>
            <option value='jg'>金戈铁马</option>
        </select>
        <input type='submit' value='start' name='启服' style='font-size:20px'>
        <input type='submit' value='stop' name='关服' style='font-size:20px'>
    </form>";
echo "<form action='delete.php' method='post'>
        <input type='submit' value='重启所有游戏服和中心服' name='Restart' style='font-size:25px'>
</form>";
echo "<h2>Step 2：删除所有排行奖励数据（关服操作）</h2>";
echo "<form action='delete.php' method='post' style='font-size:20px'>
        <select name='cars' style='font-size:20px'>
            <option value='67'>路振元</option>
            <option value='98'>张加熙</option>
            <option value='101'>燃烧军团</option>
        </select>
        <input type='submit' value='删除' style='font-size:20px'>
    </form>";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_REQUEST["cars"]) != 1){
        if(isset($_POST["Restart"]) == 1){
            shell_exec($rsstop);
            shell_exec($rsstart);
            shell_exec($tzstop);
            shell_exec($tzstart);
            shell_exec($zxstop);
            shell_exec($zxstart);
            shell_exec($jgstop);
            shell_exec($jgstart);
            shell_exec($chicken01stop);
            shell_exec($chicken02stop);
            shell_exec($chicken03stop);
            shell_exec($chicken01start);
            shell_exec($chicken02start);
            shell_exec($chicken03start);
            echo "<script type='text/javascript'>alert('执行完毕！');</script>";
        }else{
            //php执行shell命令
            switch ($_POST["serkey"]){
                case 'rs':
                    if(isset($_REQUEST["启服"]) != 1){
                        shell_exec($rsstop);
                        echo "<script type='text/javascript'>alert('执行完毕！');</script>";
                    }else{
                        shell_exec($rsstart);
                        echo "<script type='text/javascript'>alert('执行完毕！');</script>";
                    }
                    break;
                case 'tz':
                    if(isset($_REQUEST["启服"]) != 1){
                        shell_exec($tzstop);
                        echo "<script type='text/javascript'>alert('执行完毕！');</script>";
                    }else{
                        shell_exec($tzstart);
                        echo "<script type='text/javascript'>alert('执行完毕！');</script>";
                    }
                    break;
                case 'zx':
                    if(isset($_REQUEST["启服"]) != 1){
                        shell_exec($zxstop);
                        echo "<script type='text/javascript'>alert('执行完毕！');</script>";
                    }else{
                        shell_exec($zxstart);
                        echo "<script type='text/javascript'>alert('执行完毕！');</script>";
                    }
                    break;
                case 'jg':
                    if(isset($_REQUEST["启服"]) != 1){
                        shell_exec($jgstop);
                        echo "<script type='text/javascript'>alert('执行完毕！');</script>";
                    }else{
                        shell_exec($jgstart);
                        echo "<script type='text/javascript'>alert('执行完毕！');</script>";
                    }
                    break;
            default:
                echo "<script type='text/javascript'>alert('没有找到服务器，请重新选择');</script>";
            }
        }
    }else{
        echo "<table border='1'>";
        echo "<tr><th>ranktype</th><th>endtime</th></tr>";
        $serverid = trim($_REQUEST["cars"]);
        $dbname = "db_mszc_ranklist_".$serverid;
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
            if ($serverid < 100){
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            }
            else{
                $conn = new PDO("mysql:host=$servername1;dbname=$dbname", $username1, $password1);
            }
            // 设置 PDO 错误模式为异常
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dwl = $conn->prepare("truncate table ranklistsettle"); 
            //删除400开头的数据
            $stmt = $conn->prepare("SELECT ranktype, endtime FROM ranklistsettle"); 
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
    
}

?>