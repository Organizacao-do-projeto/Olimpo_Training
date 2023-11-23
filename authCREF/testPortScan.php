<?php

ini_set('max_execution_time', 0);
ini_set('memory_limit', -1);

echo $_SERVER['REMOTE_ADDR'];
echo "<br>";

$host = 'google.com';
$host = '127.0.0.1';
$ports = [ 25 , 465, 587, 2525];

foreach($ports as $port){
    $connection = @fsockopen($host,$port,$errno,$errstr, 2);

    if(is_resource($connection)){
        echo '<h2>'.$host.': '.$port.' '.'('.getservbyport($port, 'tcp').')is open.</h2>'."\n";
        fclose($connection);
    }else{
        echo '<h2>'.$host.': '.$port.' is not responding.</h2>'."\n";
    }
}