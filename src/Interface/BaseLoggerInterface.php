<?php

namespace YukataRm\Logger\Interface;

use YukataRm\Logger\Enum\LogLevelEnum;

/**
 * Base Logger Interface
 * 
 * @package YukataRm\Logger\Interface
 */
interface BaseLoggerInterface
{
    /*----------------------------------------*
     * Constructor
     *----------------------------------------*/

    /**
     * get LogLevelEnum instance
     *
     * @return \YukataRm\Logger\Enum\LogLevelEnum
     */
    public function logLevel(): LogLevelEnum;

    /*----------------------------------------*
     * Logging
     *----------------------------------------*/

    /**
     * logging
     *
     * @param bool $isFlush
     * @return void
     */
    public function logging(bool $isFlush = true): void;

    /*----------------------------------------*
     * Log Rotation
     *----------------------------------------*/

    /**
     * set whether rotate log
     * 
     * @param bool $isRotateLog
     * @return static
     */
    public function setRotateLog(bool $isRotateLog): static;

    /**
     * get whether rotate log
     * 
     * @return bool
     */
    public function isRotateLog(): bool;

    /**
     * set retention days
     * 
     * @param int $retentionDays
     * @return static
     */
    public function setRetentionDays(int $retentionDays): static;

    /**
     * get retention days
     * 
     * @return int
     */
    public function retentionDays(): int;

    /*----------------------------------------*
     * Content
     *----------------------------------------*/

    /**
     * add content
     *
     * @param mixed $message
     * @param mixed $value
     * @return static
     */
    public function add(mixed $message, mixed $value = null): static;

    /**
     * flush content
     * 
     * @return static
     */
    public function flush(): static;

    /*----------------------------------------*
     * Directory
     *----------------------------------------*/

    /**
     * get output directory
     *
     * @return string
     */
    public function outputDirectory(): string;

    /**
     * get base directory
     * 
     * @return string
     */
    public function baseDirectory(): string;

    /**
     * set base directory
     * 
     * @param string $baseDirectory
     * @return static
     */
    public function setBaseDirectory(string $baseDirectory): static;

    /**
     * add base directory
     *
     * @param string $baseDirectory
     * @return static
     */
    public function addBaseDirectory(string $baseDirectory): static;

    /**
     * get directory
     *
     * @return string
     */
    public function directory(): string;

    /**
     * set directory
     *
     * @param string $directory
     * @return static
     */
    public function setDirectory(string $directory): static;

    /**
     * add directory
     *
     * @param string $directory
     * @return static
     */
    public function addDirectory(string $directory): static;

    /*----------------------------------------*
     * File Name
     *----------------------------------------*/

    /**
     * get file name
     *
     * @return string
     */
    public function fileName(): string;

    /**
     * set file name
     *
     * @param string $fileName
     * @return static
     */
    public function setFileName(string $fileName): static;

    /**
     * get file name
     *
     * @return string
     */
    public function fileNameFormat(): string;

    /**
     * set file name
     *
     * @param string $fileNameFormat
     * @return static
     */
    public function setFileNameFormat(string $fileNameFormat): static;

    /*----------------------------------------*
     * File Extension
     *----------------------------------------*/

    /**
     * get file extension
     *
     * @return string
     */
    public function fileExtension(): string;

    /**
     * set file extension
     *
     * @param string $fileExtension
     * @return static
     */
    public function setFileExtension(string $fileExtension): static;

    /*----------------------------------------*
     * Stack Trace
     *----------------------------------------*/

    /**
     * set stack trace index
     * 
     * @param int $index
     * @return static
     */
    public function setStackTraceIndex(int $index): static;
}
