<?php

function dd($var)
{
    echo "<pre><code>";
    var_dump($var);
    echo "<br /> </code></pre>";

    die();
}
