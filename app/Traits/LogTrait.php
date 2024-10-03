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
        // Mensaje personalizado o el mensaje de la excepción
        $message = $customMessage ?? $e->getMessage();

        // Contexto adicional
        $context = array_merge([
            'exception_message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
        ], $context);

        // Registro del log
        Log::error($message, $context);
    }
}

