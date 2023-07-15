<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    private TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function allProviders(Request $request)
    {
        $data = $this->transactionService->Providers();
        if ($request->query('provider')) {
            $data = $this->transactionService->showProvider($request->query('provider'));
        }
        if ($request->query('statusCode')) {
            $data =  $this->transactionService->statusProvider($request->query('statusCode'), $data);
        }
        if ($request->query('currency')) {

            $data = $this->transactionService->currency($request->query('currency'), $data);
        }
        if ($request->query('amounteMin') && $request->query('amounteMin')) {
            $data =  $this->transactionService->amountRange($request, $data);
        }
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json('No data is available for this research');
        }
    }
}
