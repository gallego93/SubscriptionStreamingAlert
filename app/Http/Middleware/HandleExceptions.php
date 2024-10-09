<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Http\Request;
use App\Traits\LogTrait;
use Symfony\Component\HttpFoundation\Response;

class HandleExceptions
{
    use LogTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            return $next($request);
        } catch (ModelNotFoundException $e) {
            $message = 'El recurso no fue encontrado.';
            $this->logError($e, $message);
            return redirect()->back()->with('error', $message);
        } catch (ValidationException $e) {
            $this->logError($e);
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            $message = 'Hubo un problema inesperado.';
            $this->logError($e, $message);
            return redirect()->back()->with('error', $message);
        }
    }
}
