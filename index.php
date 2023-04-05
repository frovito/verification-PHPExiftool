<?php
die('here');
require __DIR__ . '/vendor/autoload.php';

use Monolog\Logger;
use PHPExiftool\Reader;
use PHPExiftool\Driver\Value\ValueInterface;

$logger = new Logger('exiftool');
$reader = Reader::create($logger);

$metadataBag = $reader->files("test-files/IMG_2259.mov")->first();

foreach ($metadataBag as $metadata) {
    if (ValueInterface::TYPE_BINARY === $metadata->getValue()->getType()) {
        echo sprintf("\t--> Field %s has binary data" . PHP_EOL, $metadata->getTag());
    } else {
        echo sprintf("\t--> Field %s has value(s) %s" . PHP_EOL, $metadata->getTag(), $metadata->getValue()->asString());
    }
}