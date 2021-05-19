<?php

namespace App\Http\Controllers;

use App\Models\Flat;
use Inertia\Inertia;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CustomerResource;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Customer\StoreRequest;
use App\Http\Requests\Customer\UpdateRequest;
use App\Http\Resources\CustomerTableResource;
use App\Http\Requests\Customer\DestroyRequest;
use App\Http\Resources\FlatCollection;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query();
        $where = array();

        if (!$this->adminUser()) {
            $where = array_merge(array(['customers.user_id', Auth::user()->id]), $where);
        }

        $data = Customer::where($where)->get();

        $param['data'] = CustomerTableResource::collection($data);
        $param['status'] = \config('settings.invoice_status');
        $param['query'] = $query;

        return Inertia::render('settings/customer/index', ['param' => $param]);
    }

    public function create()
    {
        return Inertia::render('settings/customer/create');
    }

    public function store(StoreRequest $request)
    {
        app()->customer->store($request);

        return Redirect::route('customer.index')->with('message', 'Customer Created Successfully.');
    }

    public function edit(Customer $customer)
    {
        $param['data'] =  $customer;

        return Inertia::render('settings/customer/edit', ['param' => $param]);
    }

    public function update(UpdateRequest $request, Customer $customer)
    {
        app()->customer->update($request, $customer);

        return redirect()->back()->with('message',  __('Data successfully updated.'));
    }

    public function destroy(DestroyRequest $request, Customer $customer)
    {
        app()->customer->destroy($request, $customer);

        return redirect()->back()->with('message',  __('Data successfully deleted.'));
    }

    public function customerFlat(Customer $customer)
    {
        $data = app()->customer->customerFlat($customer);

        return new FlatCollection($data);
    }
}
