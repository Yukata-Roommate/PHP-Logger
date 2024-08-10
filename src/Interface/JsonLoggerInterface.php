<?php

namespace YukataRm\Logger\Interface;

use YukataRm\Logger\Interface\BaseLoggerInterface;

use YukataRm\Logger\Enum\LogFormatEnum;

/**
 * JSON Logger Interface
 * 
 * @package YukataRm\Logger\Interface
 */
interface JsonLoggerInterface extends BaseLoggerInterface
{
    /*----------------------------------------*
     * Format
     *----------------------------------------*/

    /**
     * get log format
     *
     * @return array<string>
     */
    public function logFormat(): array;

    /**
     * set log format
     * 
     * @param array<string> $logFormat
     * @return static
     */
    public function setLogFormat(array $logFormat): static;

    /**
     * add log format
     * 
     * @param \YukataRm\Logger\Enum\LogFormatEnum|string $logFormat
     * @return static
     */
    public function addLogFormat(LogFormatEnum|string $logFormat): static;
}
