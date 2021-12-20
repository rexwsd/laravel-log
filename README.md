# 基于monoLog二次开发的日志Libray


## Install

### 方式一

> composer require rex/laravel-log

### 方式二
Step1: 在项目composer.json文件require段中增加如下：


```php
"require": {
         "rex/laravel-log": "0.*"
     }
```

Step2: 执行  
> composer update rex/laravel-log

## Document
### config配置

> 拷贝包内config/logging.php  到项目下 config/logging.php

#### env配置
> 配置日志写入路径
```dotenv
#日志配置
LOG_CHANNEL=daily
ENABLE_LOG_UUID=true
LOG_CHANNELS_DAILY_PATH=/data/log/wwwroot/项目名字
LOG_CHANNELS_DAILY_LEVEL=debug
LOG_CHANNELS_SINGLE_PATH=/data/log/wwwroot/项目名字
LOG_CHANNELS_SINGLE_LEVEL=debug
```

---

### 服务注册

> bootstrap/app.php 内注册服务

```php
$app->register(\Laravel\Log\LogServiceProvider::class); //Log
```

### 食用方法

```php
use Laravel\Log\Facades\Log;

Log::makeLogger('adapter.error')->error('消息入参', [
                'paramater' => $this->options,
                'payload'=> $data
            ]);
```

- getLogger 的参数是你要生成日志的文件名 上面例子最终会生成一个 adapter.error.log 的文件
- error 是日志的级别 ([附录1.1](#11-%E6%97%A5%E5%BF%97%E7%AD%89%E7%BA%A7))
- error 参数1  type string 日志标题
- error 参数2  type array 一个map类型数组  key=>string  value=>object


### 生成日志格式

```dotenv
================系统信息==================
[日志产生时间 : 2020-07-23 13:54:37,691602]
[级别 : INFO] [主机 : ddfeebc13ea6] [唯一 ID :  35e2cd981ee01be7e3dc0a47 ]
[日志产生自 :  /data/wwwroot/official-accounts/app/Components/WeChat/Handlers/Base/MessageLogHandler.php : 第41行 ]
---------------记录信息开始-------------->

消息入参 :

{
    "paramater": {
        "signature": "824cefc369bfb237888347971a7651141d702359",
        "timestamp": "1595483677",
        "nonce": "1137759158",
        "openid": "oGnh81nKwbMTiYxfPhLv2JAHIah8"
    },
    "payload": {
        "ToUserName": "gh_7996f09b388b",
        "FromUserName": "oGnh81nKwbMTiYxfPhLv2JAHIah8",
        "CreateTime": "1595483677",
        "MsgType": "event",
        "Event": "subscribe",
        "EventKey": null
    }
}

<--------------记录信息结束---------------
```


---
## 附录

### 1.1 日志等级
- DEBUG (100): Detailed debug information.详细的Debug信息
- INFO (200): Interesting events. Examples: User logs in, SQL logs.感兴趣的事件或信息，如用户登录信息，SQL日志信息
- NOTICE (250): Normal but significant events.普通但重要的事件信息
- WARNING (300): Exceptional occurrences that are not errors. Examples: Use of deprecated APIs, poor use of an API, undesirable things that are not necessarily wrong.
- ERROR (400): Runtime errors that do not require immediate action but should typically be logged and monitored.
- CRITICAL (500): Critical conditions. Example: Application component unavailable, unexpected exception.
- ALERT (550): Action must be taken immediately. Example: Entire website down, database unavailable, etc. This should trigger the SMS alerts and wake you up.
- EMERGENCY (600): Emergency: system is unusable.
