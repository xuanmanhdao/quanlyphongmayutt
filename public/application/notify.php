<?php

function notify($to,$data){

    //key server firebase
    $api_key="AAAAbbsAYds:APA91bGJXmo_9J6MHwe2vMrWqXlXbR6BDV-J6R7_U5jSlUKs1VpMnmLUR9rm7-yspljp2TZJFAwmnVl63WfYAfN1Mof4eImtRl3UKboT0YB9Tj33gOsAHnRyr3yX26RDpGp3C_d78VNf";
    //url firebase
    $url="https://fcm.googleapis.com/fcm/send";
    
    $fields=json_encode(array('to'=>$to,'notification'=>$data));

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, ($fields));

    $headers = array();
    $headers[] = 'Authorization: key ='.$api_key;
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
}
//  $ngayhuy='1-1-2001';
// $data=array(
//     'title'=>'Lịch bị huỷ',
//     'body'=>'Lịch ngày '.$ngayhuy.' bị huỷ'
// );
//     //token
//     $to="eixN-B9FQTQ:APA91bHInNwWRrXMdVMPx8HgTAOB1lyohF8GF2OJBZmJuWJXpvJYPjpFOQzsCwJlU3yyYUV65y0j1RFlqeL1sjn8qBDj_tlxS26Ot2Ihj2UBrkt6AJHFjzDEqkCmDjeVoIdv4qU6uHSa";
// notify($to,$data);
echo "Notification Sent";

?>