<?php

namespace App\Http\Traits;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait RestControllerTrait
{
    // RESPOSTAS
    // ======================================================

    /**
     * Show json individual response.
     *
     * @param type $data
     *
     * @return type
     */
    protected function createdResponse($data)
    {
        $response = [
            'code'   => 201,
            'status' => 'success',
            'data'   => $data,
        ];

        return response()->json($response, $response['code']);
    }

    /**
     * Show json individual response.
     *
     * @param type $data
     *
     * @return type
     */
    protected function showResponse($data)
    {
        $response = [
            'code'   => 200,
            'status' => 'success',
            'data'   => $data,
        ];

        return response()->json($response, $response['code']);
    }

    /**
     * List json individual response with paginate.
     *
     * @param type $data
     *
     * @return type
     */
    protected function listResponse($data)
    {
        $response = [
            'code'   => 200,
            'status' => 'success',
            'data'   => $data,
        ];

        return response()->json($response, $response['code']);
    }

    /**
     * Not found response.
     *
     * @return type
     */
    protected function notFoundResponse($data = null)
    {
        $response = [
            'code'    => 404,
            'status'  => 'error',
            'data'    => $data === null ? 'Resource Not Found' : $data,
            'message' => 'Not Found',
        ];

        return response()->json($response, $response['code']);
    }

    /**
     * Deleted response.
     *
     * @return type
     */
    protected function deletedResponse()
    {
        $response = [
            'code'    => 200,
            'status'  => 'success',
            'data'    => [],
            'message' => 'Resource deleted',
        ];

        return response()->json($response, $response['code']);
    }

    /**
     * Client error response.
     *
     * @param type $data
     *
     * @return type
     */
    protected function clientErrorResponse($data)
    {
        $response = [
            'code'    => 422,
            'status'  => 'error',
            'data'    => $data,
            'message' => 'Unprocessable entity',
        ];

        return response()->json($response, $response['code']);
    }

    /**
     * Client error response.
     *
     * @param type $data
     *
     * @return type
     */
    protected function unauthorizedErrorResponse($data)
    {
        $response = [
            'code'    => 401,
            'status'  => 'error',
            'data'    => $data,
            'message' => 'Unauthorized',
        ];

        return response()->json($response, $response['code']);
    }

    /**
     * Accepted response.
     *
     * @return type
     */
    protected function acceptedResponse()
    {
        $response = [
            'code'    => 202,
            'status'  => 'success',
            'data'    => [],
            'message' => 'Accepted',
        ];

        return response()->json($response, $response['code']);
    }

}