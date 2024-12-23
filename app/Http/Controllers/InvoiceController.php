<?php

namespace App\Http\Controllers;

use App\Http\Middleware\UserHasInvoiceAccess;
use App\Http\Requests\InvoiceRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class InvoiceController extends Controller  implements HasMiddleware
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            'auth',
            new Middleware(UserHasInvoiceAccess::class, except: ['index', 'create', 'addProducts', 'store']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the invoices for the logged in user with status.
        $invoicesQuery = Invoice::with(['status'])->where('user_id', Auth::user()->id);

        // Search by client name or invoice id.
        if($request->search) {
            $invoicesQuery
                ->whereLike('client_name', '%'.$request->search.'%', caseSensitive: false)
                ->OrWhereLike('id', '%'.$request->search.'%');
        } else {
            $invoicesQuery;
        }

        $invoicesQuery->orderBy('id', 'desc');

        return Inertia::render('Invoice/Index', [
            'invoices' =>  $invoicesQuery->paginate(12),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Invoice/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvoiceRequest $request)
    {
        // Retrieve the validated input data.
        $validated = $request->validated();

        // Defaults to status pending.
        $validated['status'] = 1;

        // Defaults to logged in user.
        $validated['user_id'] = Auth::user()->id;

        // Store validated data.
        $invoice = Invoice::create($validated);

        $products = $invoice->products()->get();

        $this->calculateTotal($products, $invoice);

        // Redirects to newly created invoice page.
        return Redirect::route('invoice.show.add-products', ['invoice' => $invoice->id])->with('message','Details successfully added');
    }

    /**
     * Show add products page.
     */
    public function addProducts(Invoice $invoice)
    {
        $invoice->load(['createdBy', 'status', 'products']);

        $products = $invoice->products()->get();

        $this->calculateTotal($products, $invoice);

        return Inertia::render('Invoice/AddProducts', ['invoice' => $invoice]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteProduct(Invoice $invoice, Product $product)
    {
        $productFound = $invoice->products()->find($product)->first();

        $productFound->delete();

        return back()->with('message', 'Product successfully deleted!');
    }

    /**
     * Store the products for the newly created invoice
     */
    public function storeProducts(ProductRequest $request, Invoice $invoice)
    {
        $invoice->load(['createdBy', 'status', 'products']);

        // Retrieve the validated input data.
        $validated = $request->validated();

        // Defaults to newly created invoice id.
        $validated['invoice_id'] = $invoice->id;

        // Store validated data.
        $invoice->products()->firstOrCreate($validated);

        $products = $invoice->products()->get();

        $this->calculateTotal($products, $invoice);

        return back()->with('message', 'Product successfully added!');
    }

    public function calculateTotal($products, $invoice)
    {
        // TODO
        // move all the calculations to frontend side.
        // only save total amount once it's all been
        // calculated and sent from frontend.

        // Total charge.
        $totalChargeArray = [];
        // Grand total.
        $grandTotal = 0;

        foreach ($products as $product) {
            array_push($totalChargeArray, $product->total_charge);
        }

        $sumOfTotalCharge = array_sum($totalChargeArray);

        $vatPercentage = $invoice->vat_percentage;

        $grandTotal = $sumOfTotalCharge + ($vatPercentage / 100 ) * $sumOfTotalCharge;

        $invoice->find($invoice->id)->update([
            'sub_total' => $sumOfTotalCharge ,
            'total' => $grandTotal
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        // Pre-load related invoice creator data.
        $invoice->load(['createdBy', 'status', 'products']);

        $products = $invoice->products()->get();

        $this->calculateTotal($products, $invoice);

        return Inertia::render('Invoice/Show', [
            'invoice' =>  $invoice,
            'statuses' => Status::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InvoiceRequest $request, Invoice $invoice): RedirectResponse
    {
        // Retrieve the validated input data.
        $validated = $request->validated();

        // Update validated data.
        $invoice->update($validated);

        $products = $invoice->products()->get();

        $this->calculateTotal($products, $invoice);

        // Redirects to the updated invoice page.
        return back()->with('message', 'Invoice successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return Redirect::route('invoice.index')->with('message', 'Invoice successfully deleted!');
    }

    /**
     * Generate invoice PDF
     */
    public function generatePDF(Invoice $invoice)
    {
        // Pre-load related invoice creator data.
        $invoice->load(['createdBy', 'status', 'products']);

        $pdf = Pdf::loadView('pdf.invoice', ['invoice' => $invoice]);
        $pdf->setOption([
            'dpi' => 150,
            'defaultFont' => 'sans-serif'
        ]);
        return $pdf->stream('invoice#'.$invoice->id.'.pdf');
    }
}
