<?php

namespace App\Http\Controllers;

use App\Models\EmailSubscription;
use App\Mail\NewsletterMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class NewsletterController extends Controller
{
    public function index()
    {
        $subscribers = EmailSubscription::latest()->paginate(20);
        
        $stats = [
            'total' => EmailSubscription::count(),
        ];

        return view('newsletter.index', compact('subscribers', 'stats'));
    }

    public function create()
    {
        $subscriberCount = EmailSubscription::count();
        return view('newsletter.create', compact('subscriberCount'));
    }

   public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'button_text' => 'nullable|string|max:100',
        'button_link' => 'nullable|url|max:500',
    ]);

    // Handle image upload if provided
    $imageData = null;
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageData = [
            'data' => base64_encode(file_get_contents($image->getRealPath())),
            'mime' => $image->getMimeType(),
            'name' => $image->getClientOriginalName()
        ];
    }

    // Get all subscribers
    $subscribers = EmailSubscription::all();

    if ($subscribers->isEmpty()) {
        return redirect()->route('newsletter.index')
            ->with('error', 'No subscribers found to send newsletter to.');
    }

    // Prepare newsletter data
    $newsletterData = [
        'title' => $request->title,
        'body' => $request->body,
        'image' => $imageData,
        'button_text' => $request->button_text,
        'button_link' => $request->button_link,
    ];

    // Send newsletter to all subscribers
    $sentCount = 0;
    foreach ($subscribers as $subscriber) {
        try {
            Mail::to($subscriber->email)->send(new NewsletterMail($newsletterData, $subscriber->name));
            $sentCount++;
        } catch (\Exception $e) {
           //No actions
        }
    }

    return redirect()->route('newsletter.index')
        ->with('success', "Newsletter sent successfully to {$sentCount} subscriber(s)!");
}

    public function destroy(EmailSubscription $subscriber)
    {
        $subscriber->delete();

        return redirect()->route('newsletter.index')
            ->with('success', 'Subscriber deleted successfully!');
    }
}