<?php

$num = 2;
$foo = $num." "."be";
$bar = "or not ".$num." be";

echo $foo." ".$bar . "\n"; //\n is for space

echo $num * $num * $num;

// comment
/*comment */

if (true) {
    echo "TRUE \n";
} else {
    echo "FALSE \n";
}

while (true) {
    break; //stop it after a while
}

$arr = [1,1,2,3,4,5]; //php arrays is like a list of things, like JS 

$arr2 = [
    "first" => "Tom",
    "second" => "Bipin",
    "best" => "DS"
];

function printList($someArr){
    echo "<ul>\n";
    foreach($someArr as $key => $val){
        echo "<li>".$key." is ".$val."</li>\n";
    }
    echo "</ul>\n";
}   

printList($arr);
printList($arr2);

echo json_encode(
    $arr2,
    JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR
);