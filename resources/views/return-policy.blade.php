@extends('layouts.app')

@section('title', 'Exchange & Return Policy – Thesara Cosmetics')

@section('content')
<div class="container section reveal">
    <div class="thesara-page-header">
        <h1>Exchange & Return Policy</h1>
        <p>At Thesara Cosmetics, your satisfaction is our priority. Please review our policies below regarding returns and exchanges.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="thesara-card p-4 p-md-5 mb-5">
                <div class="row g-5">
                    <div class="col-md-6">
                        <h3 class="fw-bold mb-3" style="font-family: var(--font-heading); color: var(--brand-brown);">Returns</h3>
                        <p class="text-secondary">We accept returns of unused and unopened products within <strong>14 days</strong> of delivery. Due to hygiene reasons, we cannot accept returns for products that have been opened or used.</p>
                        <ul class="text-secondary ps-3">
                            <li class="mb-2">Items must be in original packaging.</li>
                            <li class="mb-2">Proof of purchase is required.</li>
                            <li class="mb-2">Return shipping costs are the responsibility of the customer unless the item was damaged upon arrival.</li>
                        </ul>
                    </div>

                    <div class="col-md-6">
                        <h3 class="fw-bold mb-3" style="font-family: var(--font-heading); color: var(--brand-brown);">Exchanges</h3>
                        <p class="text-secondary">If you received a defective or damaged item, we will happily exchange it for a new one. Please notify us within <strong>48 hours</strong> of receiving your order.</p>
                        <ul class="text-secondary ps-3">
                            <li class="mb-2">Send us a photo of the damaged item.</li>
                            <li class="mb-2">Exchanges are processed within 3-5 business days.</li>
                            <li class="mb-2">Subject to stock availability.</li>
                        </ul>
                    </div>
                </div>

                <hr class="my-5" style="border-color: var(--border-light);">

                <div class="text-center">
                    <h3 class="fw-bold mb-3" style="font-family: var(--font-heading); color: var(--brand-brown);">How to Start a Request</h3>
                    <p class="text-secondary mb-4">To initiate a return or exchange, please contact our support team with your order number and details of the request.</p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="mailto:support@thesara.com" class="btn btn-dark px-4 py-2">Email Support</a>
                        <a href="{{ route('feedback.form') }}" class="btn btn-outline-secondary px-4 py-2">Submit Feedback</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
  <script src="{{ asset('js/script.js') }}"></script>
@endpush
@endsection
