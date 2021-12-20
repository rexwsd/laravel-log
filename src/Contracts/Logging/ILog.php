<?php
namespace Larave\Log\Contracts\Logging;
interface ILog
{
    public function makeLogger($logFilePath);
}