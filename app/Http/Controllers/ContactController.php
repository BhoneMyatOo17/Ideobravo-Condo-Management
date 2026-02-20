<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of contact requests (Staff & Admin only).
     */
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');
        
        $query = Contact::with('resolver')->latest();
        
        if ($status === 'pending') {
            $query->pending();
        } elseif ($status === 'resolved') {
            $query->resolved();
        }
        
        $contacts = $query->paginate(15);
        
        return view('contacts.index', compact('contacts', 'status'));
    }

    /**
     * Display the specified contact request.
     */
    public function show(Contact $contact)
    {
        $contact->load('resolver');
        return view('contacts.show', compact('contact'));
    }

    /**
     * Store a newly created contact request from the public form.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'property_interest' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        Contact::create($validated);

        return redirect()->back()->with('success', 'Thank you for contacting us! We will get back to you within 24 hours.');
    }

    /**
     * Mark a contact request as resolved.
     */
    public function resolve(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'resolution_note' => 'required|string|max:5000',
        ]);

        $contact->update([
            'status' => 'resolved',
            'resolution_note' => $validated['resolution_note'],
            'resolved_by' => Auth::id(),
            'resolved_at' => now(),
        ]);

        return redirect()->route('contacts.show', $contact)->with('success', 'Contact request has been marked as resolved.');
    }
}