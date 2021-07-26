<?php
$let1 = 4;
$let2 = 15;

function multiply() {
    global  $let1,$let2;
    $let2 =  $let1 * $let2;
    echo $let2;
}
echo "the multiplication value of 4 * 15 =";
multiply();

?>
