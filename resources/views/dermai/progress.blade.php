@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <h2 class="fw-bold text-primary mb-0"><i class="bi bi-journal-medical"></i> My Skin Progress</h2>
        <a href="{{ route('dermai.chat') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
            <i class="bi bi-chat-dots me-1"></i> New Analysis
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success fw-bold rounded-3 shadow-sm alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        @forelse($analyses as $analysis)
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-3">
                <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-dark">
                        <i class="bi bi-calendar-check text-primary me-2"></i> 
                        {{ $analysis->created_at->format('M d, Y - h:i A') }}
                    </h5>
                    <span class="badge bg-{{ strtolower($analysis->severity) == 'severe' ? 'danger' : (strtolower($analysis->severity) == 'moderate' ? 'warning' : 'success') }} rounded-pill px-3 py-2">
                        {{ ucfirst($analysis->severity) }} - {{ $analysis->condition_detected }}
                    </span>
                </div>
                
                <div class="card-body p-4 bg-light">
                    <div class="row g-4">
                        <div class="col-md-3 text-center">
                            <div class="position-relative d-inline-block rounded-4 overflow-hidden border shadow-sm">
                                <img src="{{ asset('storage/' . str_replace('private/', '', $analysis->image_path)) }}" alt="Original Analysis" class="img-fluid" style="object-fit:cover; height: 180px; width: 100%;">
                                <div class="position-absolute bottom-0 start-0 w-100 bg-dark bg-opacity-50 text-white py-1 small">Original Image</div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <h6 class="text-primary fw-bold mb-2">Diagnosis Context:</h6>
                            <p class="text-muted small mb-4">{{ $analysis->gemini_response['explanation'] ?? 'No explanation recorded.' }}</p>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="bg-white p-3 rounded-4 shadow-sm border border-light h-100">
                                        <h6 class="fw-bold mb-3 d-flex align-items-center text-secondary">
                                            <i class="bi bi-capsule text-primary fs-5 me-2"></i> Treatments
                                        </h6>
                                        <ul class="mb-0 small text-muted lh-lg">
                                            @foreach($analysis->gemini_response['treatments']['otc'] ?? [] as $otc)
                                                <li>Otc: {{ $otc }}</li>
                                            @endforeach
                                            @foreach($analysis->gemini_response['treatments']['prescription'] ?? [] as $rx)
                                                <li>Rx: {{ $rx }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bg-white p-3 rounded-4 shadow-sm border border-light h-100">
                                        <h6 class="fw-bold mb-3 d-flex align-items-center text-secondary">
                                            <i class="bi bi-moon-stars text-info fs-5 me-2"></i> Routine
                                        </h6>
                                        <div class="small text-muted lh-lg">
                                            <strong>AM:</strong> {{ implode(' → ', $analysis->gemini_response['skincare_routine']['am'] ?? []) }}<br>
                                            <strong>PM:</strong> {{ implode(' → ', $analysis->gemini_response['skincare_routine']['pm'] ?? []) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Logs -->
                    <div class="mt-4 pt-3 border-top">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0 fw-bold"><i class="bi bi-activity text-success"></i> Follow-ups</h5>
                            <button class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm" data-bs-toggle="collapse" data-bs-target="#logForm{{ $analysis->id }}">
                                <i class="bi bi-plus me-1"></i> Add Log
                            </button>
                        </div>

                        <!-- Add Log Form -->
                        <div class="collapse mb-4" id="logForm{{ $analysis->id }}">
                            <div class="card card-body border border-primary shadow-sm rounded-4">
                                <form action="{{ route('dermai.progress.log') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="analysis_id" value="{{ $analysis->id }}">
                                    <div class="row g-3">
                                        <div class="col-md-8">
                                            <label class="form-label small fw-bold text-muted">Notes on improvement or new symptoms</label>
                                            <textarea name="notes" class="form-control rounded-3 border-light shadow-sm" rows="2" placeholder="My skin feels much softer, but the redness is..."></textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small fw-bold text-muted">Follow-up Image <small>(optional)</small></label>
                                            <input type="file" name="follow_up_image" class="form-control form-control-sm rounded-3 shadow-sm" accept="image/*">
                                        </div>
                                        <div class="col-12 mt-3 text-end">
                                            <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">Save Log</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Past Logs -->
                        @if($analysis->progressLogs->count() > 0)
                            <div class="d-flex overflow-auto pb-2 gap-3 pb-3">
                                @foreach($analysis->progressLogs as $log)
                                    <div class="bg-white border rounded-4 shadow-sm p-3 min-w-300px" style="min-width: 300px;">
                                        <div class="d-flex justify-content-between text-muted small mb-2 border-bottom pb-2">
                                            <span><i class="bi bi-clock"></i> {{ $log->created_at->diffForHumans() }}</span>
                                            <span>{{ $log->created_at->format('M d') }}</span>
                                        </div>
                                        <p class="small mb-2">{{ $log->notes }}</p>
                                        @if($log->follow_up_image_path)
                                            <img src="{{ asset('storage/' . str_replace('private/', '', $log->follow_up_image_path)) }}" class="rounded-3 img-thumbnail" style="height:80px; object-fit:cover;">
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted small fst-italic">No follow-ups recorded yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5 bg-white rounded-4 shadow-sm">
            <div class="text-primary fs-1 mb-3"><i class="bi bi-stars"></i></div>
            <h4 class="fw-bold mb-2">No Skin Analyses Yet</h4>
            <p class="text-muted mb-4">You haven't scanned any skin conditions yet. Start by uploading an image in the Chat.</p>
            <a href="{{ route('dermai.chat') }}" class="btn btn-primary px-4 rounded-pill shadow">Start New Scanner</a>
        </div>
        @endforelse
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<style>
    .card {
        border: 1px solid var(--border-subtle) !important;
    }
    .card-header {
        background: var(--bg-card) !important;
        border-bottom: 1px solid var(--border-light) !important;
    }
    .card-body.bg-light {
        background-color: var(--bg-body) !important;
    }
    h2.fw-bold {
        font-family: var(--font-heading);
    }
</style>
@endsection
