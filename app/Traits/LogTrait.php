<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait LogTrait
{
    /**
     * Registra un error detallado en el log.
     *
     * @param \Exception $e
     * @param string|null $customMessage
     * @param array $context
     * @return void
     */
    public function logError(\Exception $e, $customMessage = null, array $context = [])
    {
        $message = $customMessage ?? $e->getMessage();
        $context = array_merge([
            'exception_message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
        ], $context);

        Log::error($message, $context);
    }

    /**
     * Registra una advertencia en el log.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function logWarning($message, array $context = [])
    {
        Log::warning($message, $context);
    }

    /**
     * Registra información en el log.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function logInfo($message, array $context = [])
    {
        Log::info($message, $context);
    }

    /**
     * Registra información crítica en el log.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function logCritical($message, array $context = [])
    {
        Log::critical($message, $context);
    }
}
