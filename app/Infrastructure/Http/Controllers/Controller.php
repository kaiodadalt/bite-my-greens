<?php
declare(strict_types=1);

namespace App\Infrastructure\Http\Controllers;

use App\Domain\Shared\Exceptions\DomainAuthorizationException;
use App\Domain\Shared\Exceptions\DomainException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

abstract class Controller extends BaseController
{

    /**
     * Handle exceptions automatically for all controller methods.
     *
     * @param string $method
     * @param array $parameters
     * @return Response
     */
    public function callAction($method, $parameters): Response
    {
        try {
            return parent::callAction($method, $parameters);
        } catch (DomainAuthorizationException $e) {
            return $this->errorResponse($e->getMessage(), 403);
        } catch (DomainException $e) {
            return $this->errorResponse($e->getMessage(), 422);
        } catch (\Exception $e) {
            Log::error('An unexpected error occurred', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return $this->errorResponse('An unexpected error occurred.', 500);
        }
    }

    /**
     * Generate an error JSON response.
     *
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    protected function errorResponse(string $message, int $status): JsonResponse
    {
        return response()->json(['message' => $message], $status);
    }
}
