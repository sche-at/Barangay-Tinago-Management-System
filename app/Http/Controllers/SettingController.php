<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SettingController extends Controller
{
    public function getPrice(): JsonResponse
{
    $price = Setting::where('key', 'request_price')->first();
    return response()->json(['value' => $price->value]);
}

public function updatePrice(Request $request)
{
    $request->validate([
        'price' => 'required|numeric|min:0',
    ]);

    $setting = Setting::where('key', 'request_price')->first();
    if ($setting) {
        $setting->value = $request->price;
        $setting->save();
    }

    return redirect()->back()->with('success', 'Price updated successfully!');
}
public function showTransactionForm()
{
    $priceSetting = Setting::where('key', 'request_price')->first();
    $price = $priceSetting ? $priceSetting->value : 0; // Default to 0 if not set

    // Adjust the view path to include 'resident'
    return view('resident.transactions', compact('price'));
}
// public function index()
// {
//     $currentPriceSetting = \App\Models\Setting::where('key', 'request_price')->first();
//     $currentPrice = $currentPriceSetting ? $currentPriceSetting->value : 50; // Default to 50 if not set

//     return view('resident.transactions', compact('currentPrice'));
// }
}