<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Watchdog;
use App\Http\Requests\StoreWatchdogRequest;
use App\Http\Requests\UpdateWatchdogRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class WatchdogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $watchDogs = Watchdog::where('user_id', Auth::id())
            ->join('currencies', 'watchdogs.currency_id', '=', 'currencies.id')
            ->select('watchdogs.*', 'currencies.name as currency_name','currencies.current_price as currency_price')
            ->paginate(10);
        return view('watchdog.index', compact('watchDogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currencies = Currency::orderBy('name', 'asc')->pluck('id', 'name');
        return view('watchdog.create', compact('currencies'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWatchdogRequest $request)
    {
        $validatedData = $request->validate([
            'currency_id' => [
                'required',
                Rule::unique('watchdogs')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                }),
            ],
        ],
        [
            'currency_id.unique' => 'You are already monitoring this currency.',
        ]);
        $createWatchdog = Watchdog::create([
            'user_id' => Auth::id(),
            'currency_id'=>$request->currency_id
        ]);

        return redirect('/watchdogs')->with('success', 'Watchdog was successfully created');

    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Watchdog $watchdog)
    {
        $watchdog->delete();
        return redirect()->back()->with('success', 'Watchdog was successfully deleted');
    }
}
