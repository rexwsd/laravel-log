<?php

namespace Laravel\Log\Facades;

use Laravel\Log\Monolog\LogManager;
use Illuminate\Support\Facades\Facade;

/**
 * 创建人：Rex.栗田庆
 * 创建时间：2019-05-13 19:48
 * @method static LogManager makeLogger($name)
 * @see LogManager
 */
class Log extends Facade
{
    /**
     * 获取组件注册名称
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {

        return 'Psr\Log\LoggerInterface';
    }
}
