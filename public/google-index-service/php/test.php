<?php
$week = date ("08.03.2022");
$week = date ("W", strtotime("31.12.2022"));

echo $week;
/* На дату 06.11.2015 показывает первую неделю */
if(!$week%2 == 0){
    $dresul = 1;
}else{
    $dresul = 2;
}
echo "<br>$dresul неделя! ";