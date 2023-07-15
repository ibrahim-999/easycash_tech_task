<?php

namespace App\Services;

use App\Enums\DataProviderWStatusEnum;
use App\Enums\DataProviderXStatusEnum;
use App\Enums\DataProviderYStatusEnum;
use App\Enums\StatusCodeTypeEnum;
use Illuminate\Http\Request;

class TransactionService
{
    // function return all the available providerDataProvider(W/X/Y).
    public function Providers(): array
    {
        $jsonFilePaths = glob(public_path('*.json'));
        $combinedData = [];
        foreach ($jsonFilePaths as $jsonFilePath) {
            // Read the JSON file contents into a string
            $jsonString = file_get_contents($jsonFilePath);

            // Convert the JSON string to an array using the json_decode function
            $jsonData = json_decode($jsonString, true);

            // Merge the current JSON data into the combined data array
            $combinedData = array_merge($combinedData, $jsonData);
        }
        return $combinedData;
    }
    // return specific file data like(/api/v1/transactions?provider=DataProviderX)

    public function showProvider($provider)
    {
        $jsonFiles = glob(public_path('*.json'));
        $dataArray = [];
        foreach ($jsonFiles as $jsonFile) {

            if (basename($jsonFile, '.json') === $provider) {
                $jsonData = file_get_contents($jsonFile);
                $dataArray = json_decode($jsonData, true);
                break; //
            }
        }
        if (!empty($dataArray)) {
            return $dataArray;
        } else {
            return 'data not found';
        }
    }
    // return all data with search statusCode in all json files like(/api/v1/transactions?statusCode=paid)

    public function statusProvider($status, $data): \Illuminate\Http\JsonResponse|array
    {
        $search_results = [];
        $status_values = array();
        if ($status == StatusCodeTypeEnum::PAID->value) {
            $status_values = array(
                DataProviderWStatusEnum::PAID->value,
                DataProviderXStatusEnum::PAID->value,
                DataProviderYStatusEnum::PAID->value
            );
        } elseif ($status == StatusCodeTypeEnum::PENDING->value) {
            $status_values = array(
                DataProviderWStatusEnum::PENDING->value,
                DataProviderXStatusEnum::PENDING->value,
                DataProviderYStatusEnum::PENDING->value
            );
        } elseif ($status == StatusCodeTypeEnum::REJECT->value) {
            $status_values = array(
                DataProviderWStatusEnum::REJECT->value,
                DataProviderXStatusEnum::REJECT->value,
                DataProviderYStatusEnum::REJECT->value
            );
        } else {
            return response()->json('No data is available for this research');
        }
        foreach ($data as $item) {

            if (array_key_exists('status', $item)  && in_array($item['status'], $status_values)) {

                $search_results[] = $item;
            }
            if (array_key_exists('transactionStatus', $item) && in_array($item['transactionStatus'], $status_values)) {

                $search_results[] = $item;
            }
        }
        return $search_results;
    }
    // return all data with search amountRange in all json files like(/api/v1/transactions?amounteMin=10&amounteMax=100 iwith including 10 and 100.)

    public function amountRange(Request $request, $data): array
    {

        $results = array_filter($data, function ($item) use ($request) {
            return (
                (array_key_exists('amount', $item) && $item['amount'] >= $request->amounteMin && $item['amount'] <= $request->amounteMax) ||


                (array_key_exists('transactionAmount', $item) && $item['transactionAmount'] >= $request->amounteMin && $item['transactionAmount'] <= $request->amounteMax)

            );
        });
        return $results;
    }
    // return all data with search amountRange in all json files like( /api/v1/transactions?currency=EGP)

    public function currency($search, $data): array
    {
        $results = array_filter($data, function ($item) use ($search) {
            return (array_key_exists('currency', $item) && $item['currency'] == $search

            );
        });
        return $results;
    }
}

if(!function_exists('public_path'))
{

    /**
     * Return the path to public dir
     * @param string|null $path
     * @return string
     */
    function public_path(?string $path = '')
    {
        return base_path('public') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}
