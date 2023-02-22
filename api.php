<?php

$link = mysqli_connect("localhost", "root", "", "world");

if(!empty($_GET['stateId'])){

    $sid = $_GET['stateId'];
    $sel = mysqli_query($link, "select * from states where country_id = '$sid'");

    $recordExist = mysqli_num_rows($sel);

    if($recordExist > 0){
        $data = mysqli_fetch_all($sel, MYSQLI_ASSOC);
    }else{
        $data = [];
    }
}


if(!empty($_GET['cityId'])){

    $cid = $_GET['cityId'];
    $sel = mysqli_query($link, "select * from cities where state_id = '$cid'");

    $recordExist = mysqli_num_rows($sel);

    if($recordExist > 0){
        $data = mysqli_fetch_all($sel, MYSQLI_ASSOC);
    }else{
        $data = [];
    }

}

echo json_encode(['data'=> $data]);

?>