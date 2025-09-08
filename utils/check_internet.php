<?php
function checkInternet()
{
    $connected = @fsockopen("www.google.com", 80);
    if ($connected) {
        fclose($connected);
        return true; // Có internet
    } else {
        return false; // Không có internet
    }
}