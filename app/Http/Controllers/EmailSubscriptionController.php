<?php

namespace App\Http\Controllers;

use App\Models\EmailSubscription;
use Illuminate\Http\Request;

class EmailSubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|unique:newsletter,email',
        ]);

        EmailSubscription::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Thanks for subscribing, ' . $request->name . '!');
    }
}