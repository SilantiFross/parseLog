<?php
namespace parseLog\classes;

class XmlParser
{

    public function readXml($filename)
    {
        if (file_exists($filename)) {
            $xmlFile = simplexml_load_file($filename);
        } else {
            exit('Failed to open file: ' . $filename);
        }
        return $xmlFile->Node;
    }

    public function parseDescriptionXml($descriptionXml)
    {
        $log = array();

        $i = 0;
        foreach ($descriptionXml->Prp as $value) {
            $this->addAllAttributes($log[$i], $value);
            $i += 1;
        }
        return $log;
    }

    function parseRootXml($rootXml)
    {
        $log = array();

        $i = 0;
        $j = 0;
        $k = 0;
        foreach ($rootXml->Node as $nodeRootLog) {
            $this->addAllAttributes($log[$i], $nodeRootLog);
            foreach ($nodeRootLog->Node as $val) {
                $this->addAllAttributes($log[$i][$j], $val);
                foreach ($val->Prp as $valPrp) {
                    $this->addAllAttributes($log[$i][$j][$k], $valPrp);
                    $k += 1;
                }
                $j += 1;
                $k = 0;
            }
            $j = 0;
            foreach ($nodeRootLog->Prp as $child) {
                $j += 1;
                $this->addAllAttributes($log[$i][$j], $child);
            }
            $j = 0;
            $i += 1;
        }

        return $log;
    }

    private function addAllAttributes(&$element, $value)
    {
        foreach ($value->attributes() as $attrName => $attrValue) {
            $element[$attrName] = (string)$attrValue;
        }
    }
}