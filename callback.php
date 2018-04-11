<?php
session_start();
$token=getPage('https://github.com/login/oauth/access_token',true,[
    'client_id'=>'8724243b5b227eb533ee',
    'client_secret'=>'9719978cd664ba98f60dd57ed00f1d85154f239d',
    'code'=>$_GET['code'],
    'redirect_uri'=>'http://untitled3/callback.php',
    'state'=>$_SESSION['state']
]);

function getPage($url,$post=false,$data=null){
    $ch=curl_init($url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (X11; U; Linux x86_64; en-US) AppleWebKit/540.0 (KHTML,like Gecko) Chrome/9.1.0.0 Safari/540.0');
    if($post){
        curl_setopt($ch,CURLOPT_POST,1);
    }
    if(!is_null($data)){
        curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($data));
    }
    $headers[]='Accept:application/json';
    curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
    $response=curl_exec($ch);
    curl_close($ch);
    return json_decode($response);
}

if (isset($token->access_token)){
    $_SESSION['access_token']=$token->access_token;
}