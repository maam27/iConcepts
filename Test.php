<?
$date = new DateTime();
echo $date;
$date->add(new DateInterval('P1D')); // P1D means a period of 1 day
$Date2 = $date->format('Y-m-d');
echo $Date2;

