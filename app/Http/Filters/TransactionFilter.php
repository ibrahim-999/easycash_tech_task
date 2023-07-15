<?php

namespace App\Http\Filters;

class TransactionFilter extends BaseFilters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [
        'amount',
        'currency',
        'phone',
        'status',
    ];

    /**
     * Filter the query by a given name.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */

     protected function amount($value)
     {
         if ($value) {
         if (Str::contains($value, ',')) {
             $from = explode(',', $value)[0];
             $to = explode(',', $value)[1];
             $this->builder->whereBetween('amount', [$from, $to]);
         } else {
             $this->builder->where('amount', $value);
         }
     }
 
         return $this->builder;
     }


    protected function currency($value)
    {
        if ($value) {
            return $this->builder->where('currency',$value);
        }

        return $this->builder;
    }

    protected function status($value)
    {
        switch ($value) {
            case 'paid':
                $this->builder->where('status','done');
                break;
            case 'pending':
                $this->builder->where('status','wait');
                break;
            case 'reject':
                 $this->builder->where('status','nope');
                 break;    
           
        }

        return $this->builder;
    }

    /**
     * Filter the query to include users by type.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
  
    /**
     * Sorting results by the given id.
     *
     * @param $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function selectedId($value)
    {
        if ($value) {
            $this->builder->sortingByIds($value);
        }

        return $this->builder;
    }
}
