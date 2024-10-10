<?php

namespace YukataRm\Logger;

use YukataRm\EnvLoader\BaseEnvLoader;

/**
 * EnvLoader
 * 
 * @package YukataRm\Logger
 * 
 * @property-read bool $isRotateLog
 * @property-read int $retentionDays
 * @property-read string $logFormat
 * @property-read string $logFormatJson
 * @property-read string $baseDirectory
 * @property-read string $fileNameFormat
 * @property-read string $fileExtension
 * @property-read int $fileMode
 * @property-read string|null $fileOwner
 * @property-read string|null $fileGroup
 * @property-read bool $isMemoryRealUsage
 * @property-read bool $isMemoryFormat
 * @property-read int $memoryPrecision
 */
class EnvLoader extends BaseEnvLoader
{
    /**
     * key name prefix
     * 
     * @var string
     */
    const KEY_PREFIX = self::KEY_PREFIX_DEFAULT . "LOGGER_";

    /*----------------------------------------*
     * Rotate Log
     *---------------------------------------*/

    /**
     * whether rotate log
     * 
     * @var bool|null
     */
    protected bool|null $_isRotateLog;

    /**
     * whether rotate log key name
     * 
     * @var string
     */
    const IS_ROTATE_LOG_KEY = self::KEY_PREFIX . "IS_ROTATE_LOG";

    /**
     * get whether rotate log
     * 
     * @return bool
     */
    public function isRotateLog(): bool
    {
        return isset($this->_isRotateLog) ? $this->_isRotateLog : true;
    }

    /*----------------------------------------*
     * Retention Days
     *----------------------------------------*/

    /**
     * retention days
     * 
     * @var int|null
     */
    protected int|null $_retentionDays;

    /**
     * retention days key name
     * 
     * @var string
     */
    const RETENTION_DAYS_KEY = self::KEY_PREFIX . "RETENTION_DAYS";

    /**
     * get retention days
     * 
     * @return int
     */
    public function retentionDays(): int
    {
        return isset($this->_retentionDays) ? $this->_retentionDays : 7;
    }

    /*----------------------------------------*
     * Log Format
     *----------------------------------------*/

    /**
     * log format
     * 
     * @var string|null
     */
    protected string|null $_logFormat;

    /**
     * log format key name
     * 
     * @var string
     */
    const LOG_FORMAT_KEY = self::KEY_PREFIX . "LOG_FORMAT";

    /**
     * get log format
     * 
     * @return string
     */
    public function logFormat(): string
    {
        return isset($this->_logFormat) ? $this->_logFormat : "[%datetime%] %level%: %message%";
    }

    /*----------------------------------------*
     * Format JSON
     *---------------------------------------*/

    /**
     * log json format
     * 
     * @var string|null
     */
    protected string|null $_logFormatJson;

    /**
     * log json format key name
     * 
     * @var string
     */
    const LOG_FORMAT_JSON_KEY = self::KEY_PREFIX . "LOG_FORMAT_JSON";

    /**
     * get log json format
     * 
     * @return string
     */
    public function logFormatJson(): string
    {
        return isset($this->_logFormatJson) ? $this->_logFormatJson : "datetime, level, message";
    }

    /*----------------------------------------*
     * Base Directory
     *----------------------------------------*/

    /**
     * base directory
     * 
     * @var string|null
     */
    protected string|null $_baseDirectory;

    /**
     * base directory key name
     * 
     * @var string
     */
    const BASE_DIRECTORY_KEY = self::KEY_PREFIX . "BASE_DIRECTORY";

    /**
     * get base directory
     * 
     * @return string
     */
    public function baseDirectory(): string
    {
        return isset($this->_baseDirectory) ? $this->_baseDirectory : "logs";
    }

    /*----------------------------------------*
     * File Name Format
     *----------------------------------------*/

    /**
     * file name format
     * 
     * @var string|null
     */
    protected string|null $_fileNameFormat;

    /**
     * file name format key name
     * 
     * @var string
     */
    const FILE_NAME_FORMAT_KEY = self::KEY_PREFIX . "FILE_NAME_FORMAT";

    /**
     * get file name format
     * 
     * @return string
     */
    public function fileNameFormat(): string
    {
        return isset($this->_fileNameFormat) ? $this->_fileNameFormat : "Y-m-d";
    }

    /*----------------------------------------*
     * File Extension
     *----------------------------------------*/

    /**
     * file extension
     * 
     * @var string|null
     */
    protected string|null $_fileExtension;

    /**
     * file extension key name
     * 
     * @var string
     */
    const FILE_EXTENSION_KEY = self::KEY_PREFIX . "FILE_EXTENSION";

    /**
     * get file extension
     * 
     * @return string
     */
    public function fileExtension(): string
    {
        return isset($this->_fileExtension) ? $this->_fileExtension : "log";
    }

    /*----------------------------------------*
     * File Mode
     *----------------------------------------*/

    /**
     * file mode
     * 
     * @var int|null
     */
    protected int|null $_fileMode;

    /**
     * file mode key name
     * 
     * @var string
     */
    const FILE_MODE_KEY = self::KEY_PREFIX . "FILE_MODE";

    /**
     * get file mode
     * 
     * @return int
     */
    public function fileMode(): int
    {
        return isset($this->_fileMode) ? $this->_fileMode : 0666;
    }

    /*----------------------------------------*
     * File Owner
     *----------------------------------------*/

    /**
     * file owner
     * 
     * @var string|null
     */
    protected string|null $_fileOwner;

    /**
     * file mode key name
     * 
     * @var string
     */
    const FILE_OWNER_KEY = self::KEY_PREFIX . "FILE_OWNER";

    /**
     * get file owner
     * 
     * @return string|null
     */
    public function fileOwner(): string|null
    {
        return isset($this->_fileOwner) ? $this->_fileOwner : null;
    }

    /*----------------------------------------*
     * File Group
     *----------------------------------------*/

    /**
     * file group
     * 
     * @var string|null
     */
    protected string|null $_fileGroup;

    /**
     * file group key name
     * 
     * @var string
     */
    const FILE_GROUP_KEY = self::KEY_PREFIX . "FILE_GROUP";

    /**
     * get file group
     * 
     * @return string|null
     */
    public function fileGroup(): string|null
    {
        return isset($this->_fileGroup) ? $this->_fileGroup : null;
    }

    /*----------------------------------------*
     * Memory Real Usage
     *----------------------------------------*/

    /**
     * whether real memory usage
     *
     * @var bool|null
     */
    protected bool|null $_isMemoryRealUsage;

    /**
     * whether real memory usage key name
     *
     * @var string
     */
    const IS_MEMORY_REAL_USAGE_KEY = self::KEY_PREFIX . "IS_MEMORY_REAL_USAGE";

    /**
     * get whether real memory usage
     * 
     * @return bool
     */
    public function isMemoryRealUsage(): bool
    {
        return isset($this->_isMemoryRealUsage) ? $this->_isMemoryRealUsage : true;
    }

    /*----------------------------------------*
     * Memory Format
     *----------------------------------------*/

    /**
     * whether memory format
     *
     * @var bool|null
     */
    protected bool|null $_isMemoryFormat;

    /**
     * whether memory format key name
     *
     * @var string
     */
    const IS_MEMORY_FORMAT_KEY = self::KEY_PREFIX . "IS_MEMORY_FORMAT";

    /**
     * get whether memory format
     * 
     * @return bool
     */
    public function isMemoryFormat(): bool
    {
        return isset($this->_isMemoryFormat) ? $this->_isMemoryFormat : true;
    }

    /*----------------------------------------*
     * Memory Precision
     *----------------------------------------*/

    /**
     * memory usage precision
     *
     * @var int|null
     */
    protected int|null $_memoryPrecision;

    /**
     * memory usage precision key name
     *
     * @var string
     */
    const MEMORY_PRECISION_KEY = self::KEY_PREFIX . "MEMORY_PRECISION";

    /**
     * get memory usage precision
     * 
     * @return int
     */
    public function memoryPrecision(): int
    {
        return isset($this->_memoryPrecision) ? $this->_memoryPrecision : 2;
    }

    /**
     * bind .env parameters
     * 
     * @return void
     */
    protected function bind(): void
    {
        $this->_isRotateLog       = $this->nullableBool(self::IS_ROTATE_LOG_KEY);
        $this->_retentionDays     = $this->nullableInt(self::RETENTION_DAYS_KEY);
        $this->_logFormat         = $this->nullableString(self::LOG_FORMAT_KEY);
        $this->_logFormatJson     = $this->nullableString(self::LOG_FORMAT_JSON_KEY);
        $this->_baseDirectory     = $this->nullableString(self::BASE_DIRECTORY_KEY);
        $this->_fileNameFormat    = $this->nullableString(self::FILE_NAME_FORMAT_KEY);
        $this->_fileExtension     = $this->nullableString(self::FILE_EXTENSION_KEY);
        $this->_fileMode          = $this->nullableInt(self::FILE_MODE_KEY);
        $this->_fileOwner         = $this->nullableString(self::FILE_OWNER_KEY);
        $this->_fileGroup         = $this->nullableString(self::FILE_GROUP_KEY);
        $this->_isMemoryRealUsage = $this->nullableBool(self::IS_MEMORY_REAL_USAGE_KEY);
        $this->_isMemoryFormat    = $this->nullableBool(self::IS_MEMORY_FORMAT_KEY);
        $this->_memoryPrecision   = $this->nullableInt(self::MEMORY_PRECISION_KEY);
    }
}
