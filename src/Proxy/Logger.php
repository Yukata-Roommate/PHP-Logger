<?php

namespace YukataRm\Logger\Proxy;

use YukataRm\StaticProxy\StaticProxy;

use YukataRm\Logger\Proxy\Manager;

/**
 * Logger Proxy
 * 
 * @package YukataRm\Logger\Proxy
 * 
 * @method static \YukataRm\Logger\Interface\LoggerInterface make(\YukataRm\Logger\Enum\LogLevelEnum $logLevel)
 * @method static \YukataRm\Logger\Interface\JsonLoggerInterface makeJson(\YukataRm\Logger\Enum\LogLevelEnum $logLevel)
 * 
 * @method static \YukataRm\Logger\Interface\LoggerInterface debug()
 * @method static \YukataRm\Logger\Interface\LoggerInterface info()
 * @method static \YukataRm\Logger\Interface\LoggerInterface notice()
 * @method static \YukataRm\Logger\Interface\LoggerInterface warning()
 * @method static \YukataRm\Logger\Interface\LoggerInterface error()
 * @method static \YukataRm\Logger\Interface\LoggerInterface critical()
 * @method static \YukataRm\Logger\Interface\LoggerInterface alert()
 * @method static \YukataRm\Logger\Interface\LoggerInterface emergency()
 * 
 * @method static \YukataRm\Logger\Interface\JsonLoggerInterface debugJson()
 * @method static \YukataRm\Logger\Interface\JsonLoggerInterface infoJson()
 * @method static \YukataRm\Logger\Interface\JsonLoggerInterface noticeJson()
 * @method static \YukataRm\Logger\Interface\JsonLoggerInterface warningJson()
 * @method static \YukataRm\Logger\Interface\JsonLoggerInterface errorJson()
 * @method static \YukataRm\Logger\Interface\JsonLoggerInterface criticalJson()
 * @method static \YukataRm\Logger\Interface\JsonLoggerInterface alertJson()
 * @method static \YukataRm\Logger\Interface\JsonLoggerInterface emergencyJson()
 * 
 * @method static void debugLog(mixed $message, mixed $value = null, bool $isJson = false)
 * @method static void infoLog(mixed $message, mixed $value = null, bool $isJson = false)
 * @method static void noticeLog(mixed $message, mixed $value = null, bool $isJson = false)
 * @method static void warningLog(mixed $message, mixed $value = null, bool $isJson = false)
 * @method static void errorLog(mixed $message, mixed $value = null, bool $isJson = false)
 * @method static void criticalLog(mixed $message, mixed $value = null, bool $isJson = false)
 * @method static void alertLog(mixed $message, mixed $value = null, bool $isJson = false)
 * @method static void emergencyLog(mixed $message, mixed $value = null, bool $isJson = false)
 * 
 * @see \YukataRm\Logger\Proxy\Manager
 */
class Logger extends StaticProxy
{
    /** 
     * get class name calling dynamic method
     * 
     * @return string 
     */
    protected static function getCallableClassName(): string
    {
        return Manager::class;
    }
}
