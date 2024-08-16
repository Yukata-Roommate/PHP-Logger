<?php

namespace YukataRm\Logger;

use YukataRm\Logger\Interface\BaseLoggerInterface;

use YukataRm\Logger\EnvLoader;
use YukataRm\Logger\Enum\LogLevelEnum;
use YukataRm\Logger\Enum\LogFormatEnum;

use YukataRm\File\Base\Interface\WriterInterface;
use YukataRm\File\Proxy\Writer;

/**
 * Base Logger
 * 
 * @package YukataRm\Logger
 */
abstract class BaseLogger implements BaseLoggerInterface
{
    /*----------------------------------------*
     * Constructor
     *----------------------------------------*/

    /**
     * EnvLoader instance
     * 
     * @var \YukataRm\Logger\EnvLoader
     */
    protected EnvLoader $env;

    /**
     * LogLevelEnum instance
     *
     * @var \YukataRm\Logger\Enum\LogLevelEnum
     */
    protected LogLevelEnum $logLevel;

    /**
     * constructor
     *
     * @param \YukataRm\Logger\Enum\LogLevelEnum $logLevel
     */
    public function __construct(LogLevelEnum $logLevel)
    {
        $this->env      = new EnvLoader();
        $this->logLevel = $logLevel;
    }

    /**
     * get LogLevelEnum instance
     *
     * @return LogLevelEnum
     */
    public function logLevel(): LogLevelEnum
    {
        return $this->logLevel;
    }

    /*----------------------------------------*
     * Logging
     *----------------------------------------*/

    /**
     * logging
     *
     * @param bool $isFlush
     * @return void
     */
    public function logging(bool $isFlush = true): void
    {
        $this->rotateLog();

        if (!$this->isLogging()) return;

        $this->loggingByWriter();

        if ($isFlush) $this->flush();
    }

    /**
     * whether logging
     *
     * @return bool
     */
    protected function isLogging(): bool
    {
        return !empty($this->contents);
    }

    /**
     * logging by writer
     * 
     * @return void
     */
    protected function loggingByWriter(): void
    {
        $writer = $this->writer();

        $writer->setDirname($this->outputDirectory())
            ->setFilename($this->fileName())
            ->setExtension($this->fileExtension())
            ->useFileAppend()
            ->useLockEx()
            ->writeAsIs($this->contents);
    }

    /**
     * get Writer instance
     * 
     * @return \YukataRm\File\Base\Interface\WriterInterface
     */
    protected function writer(): WriterInterface
    {
        return Writer::make();
    }

    /*----------------------------------------*
     * Log Rotation
     *----------------------------------------*/

    /**
     * whether rotate log
     * 
     * @var bool|null
     */
    protected bool|null $isRotateLog = null;

    /**
     * retention days
     * 
     * @var int|null
     */
    protected int|null $retentionDays = null;

    /**
     * rotate log
     * 
     * @return void
     */
    protected function rotateLog(): void
    {
        if (!$this->isRotateLog()) return;

        $retentionDays = $this->retentionDays();

        if ($retentionDays <= 0) return;

        $deleteDate = date("Ymd", strtotime("-{$retentionDays} day"));

        $pattern = $this->outputDirectory() . DIRECTORY_SEPARATOR . "*." . $this->fileExtension();

        $files = glob($pattern);

        if (!is_array($files)) return;

        foreach ($files as $file) {
            $fileDate = date("Ymd", filemtime($file));

            if ($fileDate < $deleteDate) unlink($file);
        }
    }

    /**
     * set whether rotate log
     * 
     * @param bool $isRotateLog
     * @return static
     */
    public function setRotateLog(bool $isRotateLog): static
    {
        $this->isRotateLog = $isRotateLog;

        return $this;
    }

    /**
     * get whether rotate log
     * 
     * @return bool
     */
    public function isRotateLog(): bool
    {
        return $this->isRotateLog ?? $this->envIsRotateLog();
    }

    /**
     * set retention days
     * 
     * @param int $retentionDays
     * @return static
     */
    public function setRetentionDays(int $retentionDays): static
    {
        $this->retentionDays = $retentionDays;

        return $this;
    }

    /**
     * get retention days
     * 
     * @return int
     */
    public function retentionDays(): int
    {
        return $this->retentionDays ?? $this->envRetentionDays();
    }

    /*----------------------------------------*
     * Content
     *----------------------------------------*/

    /**
     * contents
     *
     * @var array<string>
     */
    protected array $contents = [];

    /**
     * add content
     *
     * @param mixed $message
     * @param mixed $value
     * @return static
     */
    public function add(mixed $message, mixed $value = null): static
    {
        $this->setStackTrace();

        $message = $this->toStringMessage($message);
        $value   = $this->toStringValue($value);

        $content = $this->format($message, $value);

        return $this->addContent($content);
    }

    /**
     * flush content
     * 
     * @return static
     */
    public function flush(): static
    {
        $this->contents = [];

        return $this;
    }

    /**
     * format to content
     * 
     * @param string $message
     * @param string|null $value
     * @return string
     */
    abstract protected function format(string $message, string|null $value): string;

    /**
     * to string message
     * 
     * @param mixed $message
     * @return string
     */
    protected function toStringMessage(mixed $message): string
    {
        return match (true) {
            is_string($message)                       => $message,
            is_null($message)                         => "null",
            is_numeric($message)                      => (string) $message,
            is_bool($message)                         => $message ? "true" : "false",
            is_array($message) || is_object($message) => json_encode($message, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),

            default => $message,
        };
    }

    /**
     * to string value
     * 
     * @param mixed $value
     * @return string|null
     */
    protected function toStringValue(mixed $value): string|null
    {
        return match (true) {
            is_string($value)                       => $value,
            is_null($value)                         => null,
            is_numeric($value)                      => (string) $value,
            is_bool($value)                         => $value ? "true" : "false",
            is_array($value) || is_object($value)   => json_encode($value, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),

            default => $value,
        };
    }

    /**
     * get format content
     * 
     * @param \YukataRm\Logger\Enum\LogFormatEnum $format
     * @return string
     */
    protected function formatContent(LogFormatEnum $format): string
    {
        return match ($format) {
            LogFormatEnum::LOG_LEVEL         => $this->logLevel->value,
            LogFormatEnum::DATETIME          => date("Y-m-d H:i:s"),
            LogFormatEnum::FILE_NAME         => $this->stackTraceFileName(),
            LogFormatEnum::LINE_NUMBER       => $this->stackTraceLineNumber(),
            LogFormatEnum::FUNCTION_NAME     => $this->stackTraceFunctionName(),
            LogFormatEnum::CLASS_NAME        => $this->stackTraceClassName(),
            LogFormatEnum::MEMORY_USAGE      => $this->memoryUsage(),
            LogFormatEnum::MEMORY_PEAK_USAGE => $this->memoryPeakUsage(),
        };
    }

    /**
     * add content
     * 
     * @param string $content
     * @return static
     */
    protected function addContent(string $content): static
    {
        $this->contents[] = $content . PHP_EOL;

        return $this;
    }

    /*----------------------------------------*
     * Directory
     *----------------------------------------*/

    /**
     * base directory
     * 
     * @var string|null
     */
    protected string|null $baseDirectory = null;

    /**
     * directory
     *
     * @var string|null
     */
    protected string|null $directory = null;

    /**
     * get output directory
     *
     * @return string
     */
    public function outputDirectory(): string
    {
        return $this->baseDirectory() . DIRECTORY_SEPARATOR . $this->directory();
    }

    /**
     * get base directory
     * 
     * @return string
     */
    public function baseDirectory(): string
    {
        return $this->baseDirectory ?? $this->envBaseDirectory();
    }

    /**
     * set base directory
     * 
     * @param string $baseDirectory
     * @return static
     */
    public function setBaseDirectory(string $baseDirectory): static
    {
        if (empty($baseDirectory)) return $this;

        $this->baseDirectory = $baseDirectory;

        return $this;
    }

    /**
     * add base directory
     *
     * @param string $baseDirectory
     * @return static
     */
    public function addBaseDirectory(string $baseDirectory): static
    {
        if (empty($baseDirectory)) return $this;

        if (empty($this->baseDirectory)) return $this->setBaseDirectory($baseDirectory);

        $this->baseDirectory .= DIRECTORY_SEPARATOR . $baseDirectory;

        return $this;
    }

    /**
     * get directory
     *
     * @return string
     */
    public function directory(): string
    {
        return $this->directory ?? $this->logLevel->value;
    }

    /**
     * set directory
     *
     * @param string $directory
     * @return static
     */
    public function setDirectory(string $directory): static
    {
        if (empty($directory)) return $this;

        $this->directory = $directory;

        return $this;
    }

    /**
     * add directory
     *
     * @param string $directory
     * @return static
     */
    public function addDirectory(string $directory): static
    {
        if (empty($directory)) return $this;

        if (empty($this->directory)) return $this->setDirectory($directory);

        $this->directory .= DIRECTORY_SEPARATOR . $directory;

        return $this;
    }

    /*----------------------------------------*
     * File Name
     *----------------------------------------*/

    /**
     * file name
     *
     * @var string|null
     */
    protected string|null $fileName = null;

    /**
     * file name format
     *
     * @var string|null
     */
    protected string|null $fileNameFormat = null;

    /**
     * get file name
     *
     * @return string
     */
    public function fileName(): string
    {
        return $this->fileName ?? (new \DateTime())->format($this->fileNameFormat());
    }

    /**
     * set file name
     *
     * @param string $fileName
     * @return static
     */
    public function setFileName(string $fileName): static
    {
        if (empty($fileName)) return $this;

        $this->fileName = $fileName;

        return $this;
    }

    /**
     * get file name
     *
     * @return string
     */
    public function fileNameFormat(): string
    {
        return $this->fileNameFormat ?? $this->envFileNameFormat();
    }

    /**
     * set file name
     *
     * @param string $fileNameFormat
     * @return static
     */
    public function setFileNameFormat(string $fileNameFormat): static
    {
        if (empty($fileNameFormat)) return $this;

        $this->fileNameFormat = $fileNameFormat;

        return $this;
    }

    /*----------------------------------------*
     * File Extension
     *----------------------------------------*/

    /**
     * file extension
     * 
     * @var string|null
     */
    protected string|null $fileExtension = null;

    /**
     * get file extension
     *
     * @return string
     */
    public function fileExtension(): string
    {
        return $this->fileExtension ?? $this->envFileExtension();
    }

    /**
     * set file extension
     *
     * @param string $fileExtension
     * @return static
     */
    public function setFileExtension(string $fileExtension): static
    {
        $this->fileExtension = $fileExtension;

        return $this;
    }

    /*----------------------------------------*
     * Memory Usage
     *----------------------------------------*/

    /**
     * get memory usage
     *
     * @return string
     */
    protected function memoryUsage(): string
    {
        $usage = memory_get_usage($this->envIsMemoryRealUsage());

        return $this->envIsMemoryFormat() ? $this->formatBytes($usage) : (string)$usage;
    }

    /**
     * get memory peak usage
     *
     * @return string
     */
    protected function memoryPeakUsage(): string
    {
        $usage = memory_get_peak_usage($this->envIsMemoryRealUsage());

        return $this->envIsMemoryFormat() ? $this->formatBytes($usage) : (string)$usage;
    }

    /**
     * format memory bytes
     *
     * @param float $bytes
     * @return string
     */
    protected function formatBytes(float $bytes): string
    {
        $units = [
            3 => "GB",
            2 => "MB",
            1 => "KB",
            0 => "B",
        ];

        foreach ($units as $pow => $unit) {
            $target = 1024 ** $pow;

            if ($bytes < $target) continue;

            return round($bytes / $target, $this->envMemoryPrecision()) . $unit;
        }
    }

    /*----------------------------------------*
     * Stack Trace
     *----------------------------------------*/

    /**
     * stack trace
     *
     * @var array
     */
    protected array $stackTrace = [];

    /**
     * stack trace index
     * 
     * @var int
     */
    protected int $stackTraceIndex = 0;

    /**
     * set stack trace index
     * 
     * @param int $index
     * @return static
     */
    public function setStackTraceIndex(int $index): static
    {
        $this->stackTraceIndex = $index;

        return $this;
    }

    /**
     * set stack trace
     *
     * @return static
     */
    protected function setStackTrace(): static
    {
        $stackTrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);

        array_shift($stackTrace);

        array_shift($stackTrace);

        $this->stackTrace = $stackTrace;

        return $this;
    }

    /**
     * get stack trace value
     * 
     * @param int $index
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    protected function stackTraceValue(int $index, string $key, mixed $default): mixed
    {
        return isset($this->stackTrace[$index][$key]) ? $this->stackTrace[$index][$key] : $default;
    }

    /**
     * get stack trace file name
     * 
     * @return string
     */
    protected function stackTraceFileName(): string
    {
        return $this->stackTraceValue($this->stackTraceIndex, "file", "");
    }

    /**
     * get stack trace line number
     * 
     * @return int
     */
    protected function stackTraceLineNumber(): int
    {
        return $this->stackTraceValue($this->stackTraceIndex, "line", 0);
    }

    /**
     * get stack trace function name
     * 
     * @return string
     */
    protected function stackTraceFunctionName(): string
    {
        return $this->stackTraceValue($this->stackTraceIndex + 1, "function", "");
    }

    /**
     * get stack trace class name
     * 
     * @return string
     */
    protected function stackTraceClassName(): string
    {
        return $this->stackTraceValue($this->stackTraceIndex + 1, "class", "");
    }

    /*----------------------------------------*
     * Env
     *----------------------------------------*/

    /**
     * get env is rotate log
     * 
     * @return bool
     */
    protected function envIsRotateLog(): bool
    {
        return $this->env->isRotateLog;
    }

    /**
     * get env retention days
     * 
     * @return int
     */
    protected function envRetentionDays(): int
    {
        return $this->env->retentionDays;
    }

    /**
     * get env log format
     * 
     * @return string
     */
    protected function envLogFormat(): string
    {
        return $this->env->logFormat;
    }

    /**
     * get env log format json
     * 
     * @return array<string>
     */
    protected function envLogFormatJson(): array
    {
        return explode(
            ",",
            str_replace(
                " ",
                "",
                $this->env->logFormatJson
            )
        );
    }

    /**
     * get env base directory
     * 
     * @return string
     */
    protected function envBaseDirectory(): string
    {
        return $this->env->baseDirectory;
    }

    /**
     * get env file name format
     * 
     * @return string
     */
    protected function envFileNameFormat(): string
    {
        return $this->env->fileNameFormat;
    }

    /**
     * get env file extension
     * 
     * @return string
     */
    protected function envFileExtension(): string
    {
        return $this->env->fileExtension;
    }

    /**
     * get env whether real memory usage
     * 
     * @return bool
     */
    protected function envIsMemoryRealUsage(): bool
    {
        return $this->env->isMemoryRealUsage;
    }

    /**
     * get env whether memory format
     * 
     * @return bool
     */
    protected function envIsMemoryFormat(): bool
    {
        return $this->env->isMemoryFormat;
    }

    /**
     * get env memory usage precision
     * 
     * @return int
     */
    protected function envMemoryPrecision(): int
    {
        return $this->env->memoryPrecision;
    }
}
