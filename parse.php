<?php

$url = 'http://u.travel/test_config.txt';

if (!$rows = file($url)) {
    die("Can`t read url\n");
};

$result = [];
foreach ($rows as $row) {
    $item = explode('=', $row);
    if(count($item) != 2){
        continue;
    }
    $temp = explode('.', $item[0]);
    $lastVal = rtrim($item[1]);
    for ($i = count($temp) - 1; $i >= 0; $i--) {
        $lastVal = array($temp[$i] => $lastVal);
    }
    $result = arrayMergeRecursive($result, $lastVal);
};
var_dump($result);

function arrayMergeRecursive(array &$array1, array &$array2)
{
    $merged = $array1;
    foreach ($array2 as $key => &$value) {
        if (is_array($value) && isset ($merged[$key]) && is_array($merged[$key])) {
            $merged[$key] = arrayMergeRecursive($merged[$key], $value);
        } else {
            $merged[$key] = $value;
        }
    }

    return $merged;
}
