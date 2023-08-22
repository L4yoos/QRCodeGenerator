<?php

require "vendor/autoload.php";

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelMedium;

$link = $_POST['link'];
$size = $_POST['size'];
$margin = $_POST['margin'];

list($r0, $g0, $b0) = sscanf($_POST['colorForeground'], "#%02x%02x%02x");
list($r1, $g1, $b1) = sscanf($_POST['colorBackground'], "#%02x%02x%02x");

switch($_POST['ErrorCorrectionOption']) {
    case "L":
        $ErrorCorrectionOption = new ErrorCorrectionLevelLow();
        break;
    case "M":
        $ErrorCorrectionOption = new ErrorCorrectionLevelMedium();
        break;
    case "H":
        $ErrorCorrectionOption = new ErrorCorrectionLevelHigh();
        break;
    default:
        $ErrorCorrectionOption = new ErrorCorrectionLevelMedium();
        break;
}

$writer = new PngWriter();

$qr_code = QrCode::create($link)
    ->setEncoding(new Encoding('UTF-8'))
    ->setErrorCorrectionLevel($ErrorCorrectionOption)
    ->setSize($size)
    ->setMargin($margin)
    ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
    ->setForegroundColor(new Color($r0, $g0, $b0))
    ->setBackgroundColor(new Color($r1, $g1, $b1));

if(filter_var($_POST['image'], FILTER_VALIDATE_URL) && !empty($_POST['image'])) {
    $logo = Logo::create($_POST['image'])
    ->setResizeToWidth(50)
    ->setPunchoutBackground(true);
    $result = $writer->write($qr_code, $logo);
}
else {
    $result = $writer->write($qr_code);
}

$dataUri = $result->getDataUri();
echo $dataUri;