<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscription;

class NewsletterSubscriberController extends Controller
{
    public function index()
    {
        $subscribers = NewsletterSubscription::latest()->paginate(20);

        return view('admin.newsletter-subscribers.index', compact('subscribers'));
    }

    public function destroy(NewsletterSubscription $subscriber)
    {
        $subscriber->delete();

        return redirect()->route('admin.newsletter-subscribers.index')
            ->with('success', 'Subscriber removed successfully.');
    }

    public function export()
    {
        $subscribers = NewsletterSubscription::latest()->get();

        $filename = 'newsletter-subscribers-'.now()->format('Y-m-d-His').'.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($subscribers) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Email', 'Subscribed At', 'Date Added']);

            foreach ($subscribers as $subscriber) {
                fputcsv($handle, [
                    $subscriber->email,
                    $subscriber->subscribed_at?->format('M j, Y g:i A') ?? '',
                    $subscriber->created_at->format('M j, Y g:i A'),
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
