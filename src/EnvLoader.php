<?php

namespace YukataRm\Logger;

use YukataRm\EnvLoader\BaseEnvLoader;

/**
 * EnvLoader
 * 
 * @package YukataRm\Logger
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
     * @var bool
     */
    public bool $isRotateLog;

    /**
     * whether rotate log default value
     * 
     * @var bool
     */
    const IS_ROTATE_LOG = true;

    /**
     * whether rotate log key name
     * 
     * @var string
     */
    const IS_ROTATE_LOG_KEY = self::KEY_PREFIX . "IS_ROTATE_LOG";

    /*----------------------------------------*
     * Retention Days
     *----------------------------------------*/

    /**
     * retention days
     * 
     * @var int
     */
    public int $retentionDays;

    /**
     * retention days default value
     * 
     * @var int
     */
    const RETENTION_DAYS = 7;

    /**
     * retention days key name
     * 
     * @var string
     */
    const RETENTION_DAYS_KEY = self::KEY_PREFIX . "RETENTION_DAYS";

    /*----------------------------------------*
     * Log Format
     *----------------------------------------*/

    /**
     * log format
     * 
     * @var string
     */
    public string $logFormat;

    /**
     * log format default value
     * 
     * @var string
     */
    const LOG_FORMAT = "[%datetime%] %level%: %message%";

    /**
     * log format key name
     * 
     * @var string
     */
    const LOG_FORMAT_KEY = self::KEY_PREFIX . "LOG_FORMAT";

    /*----------------------------------------*
     * Format JSON
     *---------------------------------------*/

    /**
     * log json format
     * 
     * @var string
     */
    public string $logFormatJson;

    /**
     * log json format default value
     * 
     * @var string
     */
    const LOG_FORMAT_JSON = "datetime, level, message";

    /**
     * log json format key name
     * 
     * @var string
     */
    const LOG_FORMAT_JSON_KEY = self::KEY_PREFIX . "LOG_FORMAT_JSON";

    /*----------------------------------------*
     * Base Directory
     *----------------------------------------*/

    /**
     * base directory
     * 
     * @var string
     */
    public string $baseDirectory;

    /**
     * base directory default value
     * 
     * @var string
     */
    const BASE_DIRECTORY = "logs";

    /**
     * base directory key name
     * 
     * @var string
     */
    const BASE_DIRECTORY_KEY = self::KEY_PREFIX . "BASE_DIRECTORY";

    /*----------------------------------------*
     * File Name Format
     *----------------------------------------*/

    /**
     * file name format
     * 
     * @var string
     */
    public string $fileNameFormat;

    /**
     * file name format default value
     * 
     * @var string
     */
    const FILE_NAME_FORMAT = "Y-m-d";

    /**
     * file name format key name
     * 
     * @var string
     */
    const FILE_NAME_FORMAT_KEY = self::KEY_PREFIX . "FILE_NAME_FORMAT";

    /*----------------------------------------*
     * File Extension
     *----------------------------------------*/

    /**
     * file extension
     * 
     * @var string
     */
    public string $fileExtension;

    /**
     * file extension default value
     * 
     * @var string
     */
    const FILE_EXTENSION = "log";

    /**
     * file extension key name
     * 
     * @var string
     */
    const FILE_EXTENSION_KEY = self::KEY_PREFIX . "FILE_EXTENSION";

    /*----------------------------------------*
     * Memory Real Usage
     *----------------------------------------*/

    /**
     * whether real memory usage
     *
     * @var bool
     */
    public bool $isMemoryRealUsage;

    /**
     * whether real memory usage default value
     *
     * @var bool
     */
    const IS_MEMORY_REAL_USAGE = true;

    /**
     * whether real memory usage key name
     *
     * @var string
     */
    const IS_MEMORY_REAL_USAGE_KEY = self::KEY_PREFIX . "IS_MEMORY_REAL_USAGE";

    /*----------------------------------------*
     * Memory Format
     *----------------------------------------*/

    /**
     * whether memory format
     *
     * @var bool
     */
    public bool $isMemoryFormat;

    /**
     * whether memory format default value
     *
     * @var bool
     */
    const IS_MEMORY_FORMAT = true;

    /**
     * whether memory format key name
     *
     * @var string
     */
    const IS_MEMORY_FORMAT_KEY = self::KEY_PREFIX . "IS_MEMORY_FORMAT";

    /*----------------------------------------*
     * Memory Precision
     *----------------------------------------*/

    /**
     * memory usage precision
     *
     * @return int
     */
    public int $memoryPrecision;

    /**
     * memory usage precision default value
     *
     * @return int
     */
    const MEMORY_PRECISION = 2;

    /**
     * memory usage precision key name
     *
     * @return string
     */
    const MEMORY_PRECISION_KEY = self::KEY_PREFIX . "MEMORY_PRECISION";

    /**
     * set .env parameters
     * 
     * @return void
     */
    protected function setEnv(): void
    {
        $this->isRotateLog       = $this->getEnvBool(self::IS_ROTATE_LOG_KEY, self::IS_ROTATE_LOG);
        $this->retentionDays     = $this->getEnvInt(self::RETENTION_DAYS_KEY, self::RETENTION_DAYS);
        $this->logFormat         = $this->getEnvString(self::LOG_FORMAT_KEY, self::LOG_FORMAT);
        $this->logFormatJson     = $this->getEnvString(self::LOG_FORMAT_JSON_KEY, self::LOG_FORMAT_JSON);
        $this->baseDirectory     = $this->getEnvString(self::BASE_DIRECTORY_KEY, self::BASE_DIRECTORY);
        $this->fileNameFormat    = $this->getEnvString(self::FILE_NAME_FORMAT_KEY, self::FILE_NAME_FORMAT);
        $this->fileExtension     = $this->getEnvString(self::FILE_EXTENSION_KEY, self::FILE_EXTENSION);
        $this->isMemoryRealUsage = $this->getEnvBool(self::IS_MEMORY_REAL_USAGE_KEY, self::IS_MEMORY_REAL_USAGE);
        $this->isMemoryFormat    = $this->getEnvBool(self::IS_MEMORY_FORMAT_KEY, self::IS_MEMORY_FORMAT);
        $this->memoryPrecision   = $this->getEnvInt(self::MEMORY_PRECISION_KEY, self::MEMORY_PRECISION);
    }
}
