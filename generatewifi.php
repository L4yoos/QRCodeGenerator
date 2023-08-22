<?php

require "vendor/autoload.php";

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;

$network = $_POST['network'];
$password = $_POST['password'];
$encryption = $_POST['encryption'];

$data = 'WIFI:T:'.$encryption.';S:'.$network.';P:'.$password.';;';

$result = Builder::create()
    ->writer(new PngWriter())
    ->data($data)
    ->build();

$dataUri = $result->getDataUri();
echo $dataUri;