<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $invoices = $user->invoices()
            ->with('items.challenge')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('invoices.index', compact('invoices'));
    }
}
