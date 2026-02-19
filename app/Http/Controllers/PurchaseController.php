<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $challengeIds = InvoiceItem::whereHas('invoice', function ($q) use ($user) {
            $q->where('user_id', $user->id)->whereIn('status', ['paid', 'completed']);
        })->pluck('challenge_id')->unique()->toArray();

        $challenges = Challenge::whereIn('id', $challengeIds)->get();

        return view('purchases.index', compact('challenges'));
    }
}
