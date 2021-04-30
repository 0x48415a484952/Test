<?php

namespace App\Http\Traits;


trait ApiResponseStatus
{
    /**
     * Return a success JSON response.
     *
     * @param  array|string  $data
     * @param  string  $message
     * @param  int|null  $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function JsonResponseSuccess(?string $message = null, ?int $code = 200, $data = null)
    {
        if ($data === null && $message ==! null) {
            return response()->json([
                'message' => $message,
                'status' => 'success',
            ], $code);
        }

        if ($data !== null && $message === null) {
            return response()->json([
                'status' => 'success',
                'data' => $data
            ], $code);
        }

        if ($data === null && $message === null) {
            return response()->json([
                'status' => 'success'
            ], $code);
        }

        return response()->json([
            'message' => $message,
            'status' => 'success',
            'data' => $data
        ], $code);
        
    }

    /**
     * Return an error JSON response.
     *
     * @param  string  $message
     * @param  int  $code
     * @param  array|string|null  $data
     * @return \Illuminate\Http\JsonResponse
     */
	protected function JsonResponseError(?string $message = null, ?int $code = 200, $data = null)
	{
        if ($data === null && $message ==! null) {
            return response()->json([
                'message' => $message,
                'status' => 'error',
            ], $code);
        }

        if ($data !== null && $message === null) {
            return response()->json([
                'status' => 'error',
                'data' => $data
            ], $code);
        }

        if ($data === null && $message === null) {
            return response()->json([
                'status' => 'error'
            ], $code);
        }

        return response()->json([
            'message' => $message,
            'status' => 'error',
            'data' => $data
        ], $code);

        
	}
}
