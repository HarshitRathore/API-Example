<?php
require '../vendor/autoload.php';

// Create image
$image = new \NMC\ImageWithText\Image(dirname(__FILE__) . '/source.jpg');

// Add styled text to image
$name = $_GET['name'];
$text1 = new \NMC\ImageWithText\Text("Facebook Name : ".$name, 3, 40);
$text1->align = 'left';
$text1->color = 'FFFFFF';
$text1->font = dirname(__FILE__) . '/Ubuntu-Medium.ttf';
$text1->lineHeight = 36;
$text1->size = 36;
$text1->startX = 450;
$text1->startY = 40;
$image->addText($text1);

// Add another styled text to image
$text2 = new \NMC\ImageWithText\Text('Here we can show anything.', 1, 30);
$text2->align = 'left';
$text2->color = '000000';
$text2->font = dirname(__FILE__) . '/Ubuntu-Medium.ttf';
$text2->lineHeight = 20;
$text2->size = 20;
$text2->startX = 580;
$text2->startY = 140;
$image->addText($text2);

// Render image
$image->render(dirname(__FILE__) . '/destination.jpg');
?>