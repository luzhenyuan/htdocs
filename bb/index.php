<p>连接到mysql数据库</p>
<?php
header("Content-Type: text/html;charset=utf-8");
try{
    //解析config.ini文件
    $config = parse_ini_file(realpath(dirname(__FILE__) . '/config/config.ini'));
    //对mysqli类进行实例化
    $conn = new mysqli($config['host'], $config['username'], $config['password'], $config['dbname']);   
    if(mysqli_connect_errno()){    //判断是否成功连接上MySQL数据库
        throw new Exception('数据库连接错误！');  //如果连接错误，则抛出异常
    }else{
        echo '数据库连接成功！';   //打印连接成功的提示
    }
}catch (Exception $e){        //捕获异常
    echo $e->getMessage();    //打印异常信息
}

// 使用 sql 创建数据表
$sql = "CREATE TABLE tab (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    effect VARCHAR(50),
    customer VARCHAR(30) NOT NULL,
    Totalprice VARCHAR(30) NOT NULL,
    product VARCHAR(50)
    )";
     
    if ($conn->query($sql) === TRUE) {
        echo "Table MyGuests created successfully";
    } else {
        echo "创建数据表错误: " . $conn->error;
    }
$conn->close();
?>

