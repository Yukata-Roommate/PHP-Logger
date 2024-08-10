<?php

namespace YukataRm\Logger\Proxy;

use YukataRm\Logger\Interface\BaseLoggerInterface;
use YukataRm\Logger\Interface\LoggerInterface;
use YukataRm\Logger\Interface\JsonLoggerInterface;

use YukataRm\Logger\Logger;
use YukataRm\Logger\JsonLogger;

use YukataRm\Logger\Enum\LogLevelEnum;

/**
 * Proxy Manager
 * 
 * @package YukataRm\Logger\Proxy
 */
class Manager
{
    /**
     * make Logger instance
     *
     * @param \YukataRm\Logger\Enum\LogLevelEnum $logLevel
     * @return \YukataRm\Logger\Interface\LoggerInterface
     */
    public function make(LogLevelEnum $logLevel): LoggerInterface
    {
        return new Logger($logLevel);
    }

    /**
     * make JsonLogger instance
     *
     * @param \YukataRm\Logger\Enum\LogLevelEnum $logLevel
     * @return \YukataRm\Logger\Interface\JsonLoggerInterface
     */
    public function makeJson(LogLevelEnum $logLevel): JsonLoggerInterface
    {
        return new JsonLogger($logLevel);
    }

    /*----------------------------------------*
     * Create Logger Instance
     *----------------------------------------*/

    /**
     * make debug Logger instance
     *
     * @return \YukataRm\Logger\Interface\LoggerInterface
     */
    public function debug(): LoggerInterface
    {
        return $this->make(LogLevelEnum::DEBUG);
    }

    /**
     * make info Logger instance
     *
     * @return \YukataRm\Logger\Interface\LoggerInterface
     */
    public function info(): LoggerInterface
    {
        return $this->make(LogLevelEnum::INFO);
    }

    /**
     * make notice Logger instance
     *
     * @return \YukataRm\Logger\Interface\LoggerInterface
     */
    public function notice(): LoggerInterface
    {
        return $this->make(LogLevelEnum::NOTICE);
    }

    /**
     * make warning Logger instance
     *
     * @return \YukataRm\Logger\Interface\LoggerInterface
     */
    public function warning(): LoggerInterface
    {
        return $this->make(LogLevelEnum::WARNING);
    }

    /**
     * make error Logger instance
     *
     * @return \YukataRm\Logger\Interface\LoggerInterface
     */
    public function error(): LoggerInterface
    {
        return $this->make(LogLevelEnum::ERROR);
    }

    /**
     * make critical Logger instance
     *
     * @return \YukataRm\Logger\Interface\LoggerInterface
     */
    public function critical(): LoggerInterface
    {
        return $this->make(LogLevelEnum::CRITICAL);
    }

    /**
     * make alert Logger instance
     *
     * @return \YukataRm\Logger\Interface\LoggerInterface
     */
    public function alert(): LoggerInterface
    {
        return $this->make(LogLevelEnum::ALERT);
    }

    /**
     * make emergency Logger instance
     *
     * @return \YukataRm\Logger\Interface\LoggerInterface
     */
    public function emergency(): LoggerInterface
    {
        return $this->make(LogLevelEnum::EMERGENCY);
    }

    /*----------------------------------------*
     * Create JsonLogger Instance
     *----------------------------------------*/

    /**
     * make debug JsonLogger instance
     * 
     * @return \YukataRm\Logger\Interface\JsonLoggerInterface
     */
    public function debugJson(): JsonLoggerInterface
    {
        return $this->makeJson(LogLevelEnum::DEBUG);
    }

    /**
     * make info JsonLogger instance
     * 
     * @return \YukataRm\Logger\Interface\JsonLoggerInterface
     */
    public function infoJson(): JsonLoggerInterface
    {
        return $this->makeJson(LogLevelEnum::INFO);
    }

    /**
     * make notice JsonLogger instance
     * 
     * @return \YukataRm\Logger\Interface\JsonLoggerInterface
     */
    public function noticeJson(): JsonLoggerInterface
    {
        return $this->makeJson(LogLevelEnum::NOTICE);
    }

    /**
     * make warning JsonLogger instance
     * 
     * @return \YukataRm\Logger\Interface\JsonLoggerInterface
     */
    public function warningJson(): JsonLoggerInterface
    {
        return $this->makeJson(LogLevelEnum::WARNING);
    }

    /**
     * make error JsonLogger instance
     * 
     * @return \YukataRm\Logger\Interface\JsonLoggerInterface
     */
    public function errorJson(): JsonLoggerInterface
    {
        return $this->makeJson(LogLevelEnum::ERROR);
    }

    /**
     * make critical JsonLogger instance
     * 
     * @return \YukataRm\Logger\Interface\JsonLoggerInterface
     */
    public function criticalJson(): JsonLoggerInterface
    {
        return $this->makeJson(LogLevelEnum::CRITICAL);
    }

    /**
     * make alert JsonLogger instance
     * 
     * @return \YukataRm\Logger\Interface\JsonLoggerInterface
     */
    public function alertJson(): JsonLoggerInterface
    {
        return $this->makeJson(LogLevelEnum::ALERT);
    }

    /**
     * make emergency JsonLogger instance
     * 
     * @return \YukataRm\Logger\Interface\JsonLoggerInterface
     */
    public function emergencyJson(): JsonLoggerInterface
    {
        return $this->makeJson(LogLevelEnum::EMERGENCY);
    }

    /*----------------------------------------*
     * Logging
     *----------------------------------------*/

    /**
     * logging
     * 
     * @param \YukataRm\Logger\Interface\BaseLoggerInterface $logger
     * @param mixed $message
     * @param mixed $value
     * @return void
     */
    protected function logging(BaseLoggerInterface $logger, mixed $message, mixed $value = null): void
    {
        $logger->setStackTraceIndex(3)->add($message, $value)->logging();
    }

    /**
     * logging at debug level
     *
     * @param mixed $message
     * @param mixed $value
     * @param bool $isJson
     * @return void
     */
    public function debugLog(mixed $message, mixed $value = null, bool $isJson = false): void
    {
        $this->logging(
            $isJson ? $this->debugJson() : $this->debug(),
            $message,
            $value
        );
    }

    /**
     * logging at info level
     *
     * @param mixed $message
     * @param mixed $value
     * @param bool $isJson
     * @return void
     */
    public function infoLog(mixed $message, mixed $value = null, bool $isJson = false): void
    {
        $this->logging(
            $isJson ? $this->infoJson() : $this->info(),
            $message,
            $value
        );
    }

    /**
     * logging at notice level
     *
     * @param mixed $message
     * @param mixed $value
     * @param bool $isJson
     * @return void
     */
    public function noticeLog(mixed $message, mixed $value = null, bool $isJson = false): void
    {
        $this->logging(
            $isJson ? $this->noticeJson() : $this->notice(),
            $message,
            $value
        );
    }

    /**
     * logging at warning level
     *
     * @param mixed $message
     * @param mixed $value
     * @param bool $isJson
     * @return void
     */
    public function warningLog(mixed $message, mixed $value = null, bool $isJson = false): void
    {
        $this->logging(
            $isJson ? $this->warningJson() : $this->warning(),
            $message,
            $value
        );
    }

    /**
     * logging at error level
     *
     * @param mixed $message
     * @param mixed $value
     * @param bool $isJson
     * @return void
     */
    public function errorLog(mixed $message, mixed $value = null, bool $isJson = false): void
    {
        $this->logging(
            $isJson ? $this->errorJson() : $this->error(),
            $message,
            $value
        );
    }

    /**
     * logging at critical level
     *
     * @param mixed $message
     * @param mixed $value
     * @param bool $isJson
     * @return void
     */
    public function criticalLog(mixed $message, mixed $value = null, bool $isJson = false): void
    {
        $this->logging(
            $isJson ? $this->criticalJson() : $this->critical(),
            $message,
            $value
        );
    }

    /**
     * logging at alert level
     *
     * @param mixed $message
     * @param mixed $value
     * @param bool $isJson
     * @return void
     */
    public function alertLog(mixed $message, mixed $value = null, bool $isJson = false): void
    {
        $this->logging(
            $isJson ? $this->alertJson() : $this->alert(),
            $message,
            $value
        );
    }

    /**
     * logging at emergency level
     *
     * @param mixed $message
     * @param mixed $value
     * @param bool $isJson
     * @return void
     */
    public function emergencyLog(mixed $message, mixed $value = null, bool $isJson = false): void
    {
        $this->logging(
            $isJson ? $this->emergencyJson() : $this->emergency(),
            $message,
            $value
        );
    }
}
