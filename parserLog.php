<?php

namespace parseLog;

require_once 'classes/ResultTest.php';
require_once 'classes/XmlParser.php';

use parseLog\classes\XmlParser as XmlParser;

$xmlParser = new XmlParser();

$descriptionXml = $xmlParser->readXml('logs\description.tcLog');
$dataDescriptionLog = $xmlParser->parseDescriptionXml($descriptionXml);

$rootXml = $xmlParser->readXml('logs\RootLogData.dat');
$dataRootLog = $xmlParser->parseRootXml($rootXml);


$resultTest = new ResultTest();
$resultTest->cleanDescriptionLog($dataDescriptionLog);
$resultTest->cleanRootLog($dataRootLog);
print_r($resultTest);
