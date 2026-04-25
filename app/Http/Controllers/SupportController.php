<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    public function showCancelForm()
    {
        $orders = Auth::user()
            ->orders()
            ->latest()
            ->get(['id', 'status', 'created_at', 'total']);

        return view('orders.cancel', compact('orders'));
    }

    public function submitCancel(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer|exists:orders,id',
            'reason' => 'required|string|max:1000',
        ]);

        $order = Order::where('id', $request->order_id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$order) {
            return back()->with('error', 'Order not found for your account.')->withInput();
        }

        if ($order->status === 'cancelled') {
            return back()->with('error', 'This order is already cancelled.')->withInput();
        }

        if ($order->status === 'delivered') {
            return back()->with('error', 'Delivered orders cannot be cancelled.')->withInput();
        }

        $order->status = 'cancelled';
        $order->save();

        $this->storeContactMessage(
            Auth::user()->name,
            Auth::user()->email,
            "[Cancel Request] Order #{$order->id}. Reason: {$request->reason}"
        );

        return redirect()->route('orders.index')->with('success', 'Your order has been cancelled successfully.');
    }

    public function showFeedbackForm(Request $request)
    {
        $orders = Auth::user()
            ->orders()
            ->latest()
            ->get(['id', 'status', 'created_at']);

        $preselectedOrderId = null;
        if ($request->filled('order_id')) {
            $candidate = (int) $request->order_id;
            $preselectedOrderId = $orders->contains('id', $candidate) ? $candidate : null;
        }

        return view('feedback.create', compact('orders', 'preselectedOrderId'));
    }

    public function submitFeedback(Request $request)
    {
        $request->validate([
            'order_id' => 'nullable|integer|exists:orders,id',
            'subject' => 'required|string|max:120',
            'message' => 'required|string|max:2000',
        ]);

        if ($request->filled('order_id')) {
            $ownsOrder = Order::where('id', $request->order_id)
                ->where('user_id', Auth::id())
                ->exists();

            if (!$ownsOrder) {
                return back()->with('error', 'Selected order does not belong to your account.')->withInput();
            }
        }

        $orderPart = $request->filled('order_id') ? "Order #{$request->order_id}. " : '';

        $this->storeContactMessage(
            Auth::user()->name,
            Auth::user()->email,
            "[Feedback] {$orderPart}Subject: {$request->subject}. Message: {$request->message}"
        );

        return redirect()->route('feedback.form')->with('success', 'Thank you! Your feedback has been submitted.');
    }

    private function storeContactMessage(string $name, string $email, string $message): void
    {
        $columns = array_flip(Schema::getColumnListing('contacts'));

        $payload = [];

        if (isset($columns['name'])) {
            $payload['name'] = $name;
        }

        if (isset($columns['email'])) {
            $payload['email'] = $email;
        }

        if (isset($columns['message'])) {
            $payload['message'] = $message;
        }

        if (isset($columns['is_read'])) {
            $payload['is_read'] = false;
        }

        if (!empty($payload)) {
            Contact::create($payload);
        }
    }
}
