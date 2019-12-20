<?php
require __DIR__. '/vendor/autoload.php';
Use eftec\bladeone\BladeOne;
$blade=new BladeOne();
echo $blade->run("jahresauswahl" );
