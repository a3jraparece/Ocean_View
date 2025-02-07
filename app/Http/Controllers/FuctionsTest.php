<?php

$total_payment = 58128;

$days = 100;
$percent = 0;

if ($days >= 7) {
    $percent  = ((floor($days / 7)) * 2) >= 20 ? 20 : (floor($days / 7)) * 2;
}
