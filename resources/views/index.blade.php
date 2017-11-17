<?php

$command = '/check 700';
$commands = explode(' ', $command);
$returnMessage = '';
if (@$commands[0] == '/check' && @$commands[1]) {
    $stockCode = str_pad($commands[1], 5, '0', STR_PAD_LEFT);
    $returnMessage = @file_get_contents('http://qt.gtimg.cn/?q=s_hk' . $stockCode);
}
echo $returnMessage;

?>