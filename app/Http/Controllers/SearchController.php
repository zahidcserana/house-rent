<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchCustomer(Request $request) {
        $term = $request->input('term', null);
        $term = $term ? '%' . $term . '%' : null;

        $where = array();

        $data = Customer::where($where)
            ->when($term, function ($query, $term) {
                return  $query->where('name', 'like', $term)
                    ->orWhere('id', 'like', $term)
                    ->orWhere('address', 'like', $term)
                    ->orWhere('nid', 'like', $term)
                    ->orWhere('email', 'like', $term)
                    ->orWhere('mobile', 'like', $term);
            })
            ->latest()->pluck('id, name as text')->toArray();
    }
}
