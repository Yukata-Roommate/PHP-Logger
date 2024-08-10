<?php

namespace YukataRm\Logger\Interface;

use YukataRm\Logger\Interface\BaseLoggerInterface;

use YukataRm\Logger\Enum\LogFormatEnum;

/**
 * Logger Interface
 * 
 * @package YukataRm\Logger\Interface
 */
interface LoggerInterface extends BaseLoggerInterface
{
    /*----------------------------------------*
     * Format
     *----------------------------------------*/

    /**
     * get log format
     *
     * @return string
     */
    public function logFormat(): string;

    /**
     * set log format
     * 
     * @param \YukataRm\Logger\Enum\LogFormatEnum|string $logFormat
     * @return static
     */
    public function setLogFormat(LogFormatEnum|string $logFormat): static;

    /**
     * add log format
     *
     * @param \YukataRm\Logger\Enum\LogFormatEnum|string $logFormat
     * @param string $before
     * @param string $after
     * @return static
     */
    public function addLogFormat(LogFormatEnum|string $logFormat, string $before = "", string $after = " "): static;

    /*----------------------------------------*
     * Content
     *----------------------------------------*/

    /**
     * add empty
     *
     * @return static
     */
    public function addEmpty(): static;

    /**
     * add divider
     *
     * @return static
     */
    public function addDivider(): static;
}
