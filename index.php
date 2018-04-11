<?php
session_start();
//unset($_SESSION);
$state=md5(rand(20,50));
$_SESSION['state']=$state;

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
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
if(!isset($_SESSION['access_token'])){
   echo '<h1><a href="https://github.com/login/oauth/authorize?client_id=8724243b5b227eb533ee&redirect_uri=http://untitled3/callback.php?scope=user:email&state='.$state.'">Enter GITHUB</a></h1>';
}
else{
    $user=getPage('https://api.github.com/user?access_token='.$_SESSION['access_token']);
    var_dump($user);
}
?>
</body>
</html>

