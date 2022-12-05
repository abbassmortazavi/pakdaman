<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\RemittanceService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RemittanceController extends Controller
{
    private RemittanceService $service;

    public function __construct(RemittanceService $service)
    {
        $this->service = $service;
    }
    public function insertRemittance(Request $request): JsonResponse|string
    {
        try {
            $validator = Validator::make($request->all(), [
                'commodity_id' => 'required',
                'type' => 'required',
            ]);

            if($validator->fails()){
                return response()->json([
                    'message' => "Validation Error",
                    'data' => $validator->errors()
                ]);
            }

            $data = $this->service->store($request->all());
            return response()->json([
                'data' => $data
            ]);

        } catch (Exception $exception) {
            return $exception->getMessage();
        }

    }
}
