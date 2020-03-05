<?php

require '../vendor/autoload.php';

use App\Greeter;

$greeter = new Greeter();
echo $greeter->hello();
