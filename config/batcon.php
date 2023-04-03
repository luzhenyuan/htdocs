<?php
//燃烧和中心
$rsstop = "python ..\py\getServertargz.py cd ../data/mszc/serverbin;sh closeall";
$rsstart = "python ..\py\getServertargz.py cd ../data/mszc/serverbin;sh startall";
//天灾
$tzstop = "python ..\py\getServertargz.py cd ../data/tudou/serverbin;sh close";
$tzstart = "python ..\py\getServertargz.py cd ../data/tudou/serverbin;sh start";
//金戈铁马
$jgstop = "python ..\py\getServertargz.py cd ../data/qqgame/serverbin;sh closeall";
$jgstart = "python ..\py\getServertargz.py cd ../data/qqgame/serverbin;sh startall";
//中心
$zxstop = "python ..\getServertargz.py cd ../data/mszc/serverbin;sh closeallcenter";
$zxstart = "python ..\getServertargz.py cd ../data/mszc/serverbin;sh startallcenter";
//三个吃鸡服务器
$chicken01start = "python ..\getServertargz.py cd ../data/chicken/chicken01/serverbin;sh startchicken";
$chicken02start = "python ..\getServertargz.py cd ../data/chicken/chicken02/serverbin;sh startchicken";
$chicken03start = "python ..\getServertargz.py cd ../data/chicken/chicken03/serverbin;sh startchicken";
$chicken01stop = "python ..\getServertargz.py cd ../data/chicken/chicken01/serverbin;sh closechicken";
$chicken02stop = "python ..\getServertargz.py cd ../data/chicken/chicken02/serverbin;sh closechicken";
$chicken03stop = "python ..\getServertargz.py cd ../data/chicken/chicken03/serverbin;sh closechicken";
?>