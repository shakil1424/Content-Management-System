<?php

/*$elementText = ["Total Post","Published Post", "Draft Post",
    "Total Comment", "Approved Comment", "new Comment",
    "Total User", "Admin", "Subscriber",
    "Category"];
$elementCount = [10,4,5,
    10,4,5,
    10,4,6,
    3];

$elementColor = ["#6621e5", "#3d578b", "#6495ED",
    "#d5671f","#CD5C5C", "#DC143C",
    "#0a8d3d","#008B8B", "#7FFFD4",
    "#E9967A" ];
for($i = 0;$i<9;$i++){
    echo "['{$elementText[$i]}'".","."{$elementCount[$i]}".","."'{$elementColor[$i]}'],";

}*/

//$element[] ="";
$count= 7;
$totalPage = ceil($count/5);
echo $totalPage;

?>