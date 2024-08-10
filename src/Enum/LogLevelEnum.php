<?php

namespace YukataRm\Logger\Enum;

/**
 * Log Level Enum
 * 
 * @package YukataRm\Logger\Enum
 */
enum LogLevelEnum: string
{
    case DEBUG     = "debug";
    case INFO      = "info";
    case NOTICE    = "notice";
    case WARNING   = "warning";
    case ERROR     = "error";
    case CRITICAL  = "critical";
    case ALERT     = "alert";
    case EMERGENCY = "emergency";

    /**
     * whether log level is debug
     *
     * @return bool
     */
    public function isDebug(): bool
    {
        return $this->value === self::DEBUG;
    }

    /**
     * whether log level is info
     *
     * @return bool
     */
    public function isInfo(): bool
    {
        return $this->value === self::INFO;
    }

    /**
     * whether log level is notice
     *
     * @return bool
     */
    public function isNotice(): bool
    {
        return $this->value === self::NOTICE;
    }

    /**
     * whether log level is warning
     *
     * @return bool
     */
    public function isWarning(): bool
    {
        return $this->value === self::WARNING;
    }

    /**
     * whether log level is error
     *
     * @return bool
     */
    public function isError(): bool
    {
        return $this->value === self::ERROR;
    }

    /**
     * whether log level is critical
     *
     * @return bool
     */
    public function isCritical(): bool
    {
        return $this->value === self::CRITICAL;
    }

    /**
     * whether log level is alert
     *
     * @return bool
     */
    public function isAlert(): bool
    {
        return $this->value === self::ALERT;
    }

    /**
     * whether log level is emergency
     *
     * @return bool
     */
    public function isEmergency(): bool
    {
        return $this->value === self::EMERGENCY;
    }
}
