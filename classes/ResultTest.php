<?php

namespace parseLog;

require_once 'DescriptionLog.php';
require_once 'RootLog.php';
require_once 'Node.php';
require_once 'Prp.php';
require_once 'ChildNode.php';

use parseLog\classes\DescriptionLog as DescriptionLog;
use parseLog\classes\Node;
use parseLog\classes\RootLog as RootLog;
use parseLog\classes\Prp as Prp;

class ResultTest
{
    public $descriptionLog;
    public $rootLog;

    public function __construct()
    {
        $this->descriptionLog = new DescriptionLog();
    }

    public function cleanDescriptionLog($log)
    {
        $this->descriptionLog->testCount = (int)$this->getValue($log, "test count");
        $this->descriptionLog->globalStatus = (int)$this->getValue($log, "status");
        $this->descriptionLog->rootLogDataName = $this->getValue($log, "root logdata name");
        $this->descriptionLog->completed = (int)$this->getValue($log, "completed");
        $this->descriptionLog->errorTestCount = (int)$this->getValue($log, "error test count");
        $this->descriptionLog->warningTestCount = (int)$this->getValue($log, "warning test count");
        $this->descriptionLog->successTestCount = (int)$this->getValue($log, "success test count");
        $this->descriptionLog->warningCount = (int)$this->getValue($log, "warning count");
        $this->descriptionLog->errorCount = (int)$this->getValue($log, "error count");
        $this->descriptionLog->executionTime = $this->getTime($this->getValue($log, "start time"), $this->getValue($log, "stop time"));
    }

    public function cleanRootLog($log)
    {
        $this->rootLog = json_decode(json_encode($log), FALSE);
    }

    public function getTime($timeStart, $timeStop)
    {
        $timeStr = '0 min %s% sec';
        $minutesInDay = 1440;
        $secondsInMinutes = 60;

        $timeDifference = $timeStop - $timeStart;
        $timeDifference *= $minutesInDay;

        $minutes = intval($timeDifference);
        $seconds = ($timeDifference - $minutes) * $secondsInMinutes;

        if ($minutes != 0) {
            $timeStr = str_replace("0", $minutes, $timeStr);
        }

        $timeStr = str_replace("%s%", number_format($seconds, 1), $timeStr);
        return $timeStr;
    }

    private function getValue($log, $nameProperty)
    {
        foreach ($log as $key => $value) {
            if ($nameProperty == $log[$key]['name']) {
                return $log[$key]['value'];
            }
        }
        return -1;
    }
}