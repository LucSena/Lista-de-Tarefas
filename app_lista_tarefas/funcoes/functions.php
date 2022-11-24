<?php
function dd($p = [])
{
    echo '<pre>';
    print_r($p);
    echo '</pre>';
    exit();
}


function redirect($url)
{
    header('Location: ' . $url);
}

?>