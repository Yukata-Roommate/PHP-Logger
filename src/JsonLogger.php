<?php

namespace YukataRm\Logger;

use YukataRm\Logger\Interface\JsonLoggerInterface;
use YukataRm\Logger\BaseLogger;

use YukataRm\Logger\Enum\LogFormatEnum;

/**
 * JSON Logger
 * 
 * @package YukataRm\Logger
 */
class JsonLogger extends BaseLogger implements JsonLoggerInterface
{
    /*----------------------------------------*
     * Format
     *----------------------------------------*/

    /**
     * log format
     *
     * @var array<string>|null
     */
    protected array|null $logFormat = null;

    /**
     * format to content
     * 
     * @param string $message
     * @param string|null $value
     * @return string
     */
    protected function format(string $message, string|null $value): string
    {
        $content = [];

        $logFormat = $this->logFormat();

        foreach (LogFormatEnum::cases() as $case) {
            if (!in_array($case->format(), $logFormat)) continue;

            if ($case === LogFormatEnum::MESSAGE) {
                $contentKey = is_null($value) ? $case->value : $message;

                $content[$contentKey] = is_null($value) ? $message : $value;

                continue;
            }

            $content[$case->value] = $this->formatContent($case);
        }

        return json_encode($content, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /**
     * get log format
     *
     * @return array<string>
     */
    public function logFormat(): array
    {
        return $this->logFormat ?? $this->envLogFormatJson();
    }

    /**
     * set log format
     * 
     * @param array<string> $logFormat
     * @return static
     */
    public function setLogFormat(array $logFormat): static
    {
        $this->logFormat = $logFormat;

        return $this;
    }

    /**
     * add log format
     * 
     * @param \YukataRm\Logger\Enum\LogFormatEnum|string $logFormat
     * @return static
     */
    public function addLogFormat(LogFormatEnum|string $logFormat): static
    {
        $this->logFormat[] = $logFormat instanceof LogFormatEnum ? $logFormat->format() : $logFormat;

        return $this;
    }
}
