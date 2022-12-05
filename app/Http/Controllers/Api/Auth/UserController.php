<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login\RegisterStoreRequest;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private UserService $service;

    /**
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @param RegisterStoreRequest $request
     * @return JsonResponse|string
     */
    public function registerUser(Request $request): JsonResponse|string
    {

        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if($validator->fails()){
                return response()->json([
                    'message' => "Validation Error",
                    'data' => $validator->errors()
                ]);
            }

            $data = $this->service->registerUser($request->all());
            return response()->json([
                'data' => $data
            ]);

        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse|string
     */
    public function login(Request $request): JsonResponse|string
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if($validator->fails()){
                return response()->json([
                    'message' => "Validation Error",
                    'data' => $validator->errors()
                ]);
            }

            $data = $this->service->login($request->all());
            return response()->json([
                'data' => $data
            ]);

        } catch (Exception $exception) {
            return $exception->getMessage();
        }

    }
}
