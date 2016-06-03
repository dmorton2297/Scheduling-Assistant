<?php
namespace GLS\Audit;

use GLS\Audit\models\Log as AuditLog;

class Logger
{
    /* priorities */
    const LOG_EMERG     = 0;
    const LOG_ALERT     = 1;
    const LOG_CRIT      = 2;
    const LOG_ERR       = 3;
    const LOG_WARNING   = 4;
    const LOG_NOTICE    = 5;
    const LOG_INFO      = 6;
    const LOG_DEBUG     = 7;

    /* facilities */
    const LOG_SYSTEM    = 0;
    const LOG_USERS     = 1;

    /**
     * Demote a user to a normal user.
     * @param string $message log message
     * @param integer $severity log severeity.
     * @param integer $facility log facility.
     * @returns boolean Return value
     */
    public static function log($message, $facility = Logger::LOG_SYSTEM, $severity = Logger::LOG_NOTICE)
    {
        $log = new AuditLog();
        $log->message = $message;
        $log->severity_id = $severity;
        $log->facility_id = $facility;
        $log->save();

        return true;
    }
}