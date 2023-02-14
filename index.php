<?php

require_once 'app/Core/Core.php';

require_once 'lib/Database/Connection.php';

require_once 'app/Controller/HomeController.php';
require_once 'app/Controller/ErroController.php';
require_once 'app/Controller/ProductController.php';
require_once 'app/Controller/SobreController.php';
require_once 'app/Controller/AdminController.php';
require_once 'app/Model/Product.php';


require_once 'vendor/autoload.php';




$template = file_get_contents('app/Template/template.html');

ob_start();
$core = new Core;
$core->start($_GET);


$output = ob_get_contents();
ob_end_clean();

$TemplateOutput = str_replace('{{root}}', $output, $template);
echo $TemplateOutput;
