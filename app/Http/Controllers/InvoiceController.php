<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\House;
use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\InvoiceResource;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Invoice\StoreRequest;
use App\Http\Requests\Invoice\UpdateRequest;
use App\Http\Resources\InvoiceTableResource;
use App\Http\Requests\Invoice\DestroyRequest;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $dataCollection = Invoice::query();

        if (!$this->adminUser()) {
            $dataCollection = $dataCollection->whereHas('customer', function ($query) {
                $query->where('user_id', Auth::user()->id);
            });
        }

        $dataCollection->when($request['customer_id'], function ($q) use ($request) {
            return $q->where('customer_id', $request['customer_id']);
        });

        $request['status'] = empty($request['status']) ? 'unpaid' : ($request['status'] == 'all' ? null : $request['status']);

        $dataCollection->when($request['status'], function ($q) use ($request) {
            return $q->where('status', $request['status']);
        });

        $data = $dataCollection->get();

        $param['data'] = InvoiceTableResource::collection($data);
        $param['customers'] = Customer::select(['name', 'id'])->get();
        $param['status'] = \config('settings.invoice_status');
        $param['query'] = $request->query();

        return Inertia::render('invoice/index', ['param' => $param]);
    }

    public function create()
    {
        Artisan::call('invoice:generate');

        return Redirect::back()->with('message', 'Invoice Created Successfully.');
    }

    public function store(StoreRequest $request)
    {
        app()->invoice->store($request);

        return Redirect::route('invoice.index')->with('message', 'Invoice Created Successfully.');
    }

    public function edit(Invoice $invoice)
    {
        $invoice = new InvoiceResource($invoice);

        return Inertia::render('invoice/edit', ['param' => $invoice]);
    }

    public function update(UpdateRequest $request, Invoice $invoice)
    {
        app()->invoice->update($request, $invoice);

        return redirect()->back()->with('message',  __('Data successfully updated.'));
    }

    public function destroy(DestroyRequest $request, Invoice $invoice)
    {
        app()->invoice->destroy($request, $invoice);

        return redirect()->back()->with('message',  __('Data successfully deleted.'));
    }
}
