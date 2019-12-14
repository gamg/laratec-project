<?php
namespace App\Services;

use App\Models\Customer;

class Customers
{
    public function get()
    {
        $customers = Customer::all();
        $data = [];

        foreach ($customers as $customer) {
            $data[$customer->id] = $customer->name;
        }

        return $data;
    }
}
