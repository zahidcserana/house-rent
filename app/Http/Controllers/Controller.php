<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function adminUser()
    {
        return Auth()->user()->isAdmin();
    }

    public function houseList()
    {
        $where = array();

        if (!$this->adminUser()) {
            $where = array_merge(array(['houses.user_id', Auth::user()->id]), $where);
        }

        $data = House::select('id', 'name as label')->where($where)->get();

        return $data;
    }

    public function customerList()
    {
        $where = array();

        if (!$this->adminUser()) {
            $where = array_merge(array(['customers.user_id', Auth::user()->id]), $where);
        }

        $data = Customer::select('id', 'name as label')->where($where)->get();

        return $data;
    }
}
