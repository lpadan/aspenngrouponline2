<?php

$source = "../pdfFiles/agenda.pdf";
$target = "../pdfFiles/agenda.jpg";

$im = new Imagick;
$im->readImage("{$source}[0]");
$im->setimageformat("jpeg");
$im->thumbnailimage(300, 225);
$im->setImageAlphaChannel(Imagick::ALPHACHANNEL_REMOVE);
$im->writeimage($target);

