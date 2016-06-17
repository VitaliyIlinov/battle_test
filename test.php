<?php
$hp=rand(1,100);
$block=85;
$critical=25;
if ($critical>10){
    $hp=$hp*round(1.1 + mt_rand() / mt_getrandmax() * (5.5 - 1.1),1);
    echo $hp.'gggggggggggggg';
    echo 'crit';
}if($block>85){
    $hp=0;
}