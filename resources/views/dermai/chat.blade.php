@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="chat-container glass-panel shadow-lg rounded-4 overflow-hidden border border-light">
                <!-- Header -->
                <div class="chat-header bg-gradient-primary text-white p-4 d-flex align-items-center mb-0">
                    <div class="me-3 bg-white p-2 rounded-circle shadow-sm">
                        <i class="bi bi-robot text-primary fs-3"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-bold text-white">DermAI</h4>
                        <small class="opacity-75">Your Professional Dermatology Assistant</small>
                    </div>
                    <div class="ms-auto">
                        <a href="{{ route('dermai.progress') }}" class="btn btn-outline-light btn-sm rounded-pill px-3">
                            <i class="bi bi-journal-medical me-1"></i> My Progress
                        </a>
                    </div>
                </div>

                <!-- Chat Box -->
                <div class="chat-box p-4" id="chatBox">
                    <div class="text-center text-muted mb-4">
                        <small>Today</small>
                    </div>
                    
                    <!-- Welcome Message -->
                    <div class="message assistant d-flex mb-4">
                        <div class="avatar bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center shadow-sm" style="width:40px; height:40px;">
                            <i class="bi bi-robot"></i>
                        </div>
                        <div class="message-content bg-light p-3 rounded-4 shadow-sm border border-light">
                            Hello {{ auth()->user()->name }}! I am DermAI, your AI dermatology assistant. You can upload an image of your skin concern, or just ask me any skincare-related questions.
                            <br><small class="text-muted d-block mt-2"><i class="bi bi-exclamation-triangle"></i> Note: This is an AI tool and does not replace professional medical advice.</small>
                        </div>
                    </div>
                    
                    <div id="messagesArea"></div>
                    <div id="typingIndicator" class="d-none message assistant mb-4">
                        <div class="d-flex align-items-center gap-2">
                            <div class="spinner-grow spinner-grow-sm text-primary" role="status"></div>
                            <div class="spinner-grow spinner-grow-sm text-primary" role="status"></div>
                            <div class="spinner-grow spinner-grow-sm text-primary" role="status"></div>
                        </div>
                    </div>
                </div>

                <!-- Input Area -->
                <div class="chat-input-area p-3 bg-white border-top">
                    <!-- Image Preview -->
                    <div id="imagePreviewContainer" class="d-none mb-2 position-relative d-inline-block">
                        <img id="imagePreview" src="" class="img-thumbnail rounded-3" style="max-height:100px;">
                        <button type="button" class="btn btn-sm btn-danger rounded-circle position-absolute top-0 start-100 translate-middle" onclick="clearImage()">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>

                    <form id="chatForm" class="d-flex align-items-end gap-2">
                        @csrf
                        <input type="hidden" id="sessionId" name="session_id" value="">
                        
                        <label class="btn btn-light rounded-circle shadow-sm border p-2 mb-0" style="width:45px; height:45px; display:flex; align-items:center; justify-content:center; cursor:pointer;" title="Upload Skincare Image">
                            <i class="bi bi-camera-fill text-primary"></i>
                            <input type="file" id="imageInput" accept="image/*" class="d-none" onchange="previewImage(event)">
                        </label>
                        
                        <textarea id="messageInput" class="form-control rounded-4 shadow-sm py-2 px-3 flex-grow-1" rows="1" placeholder="Describe your concern or ask a question..." style="resize:none; max-height:120px;"></textarea>
                        
                        <button type="submit" class="btn btn-primary rounded-circle shadow p-2" style="width:45px; height:45px; display:flex; align-items:center; justify-content:center;">
                            <i class="bi bi-send-fill"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dependencies -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- Styles -->
<link rel="stylesheet" href="{{ asset('css/dermai-chat.css') }}">

<script src="{{ asset('js/dermai-chat.js') }}"></script>
<script>
    // Initialize the Chatbot with Laravel Routes
    const dermAI = new DermAIChat({
        analyzeRoute: "{{ route('dermai.analyze') }}",
        chatRoute: "{{ route('dermai.chat.message') }}"
    });

    // Helper functions for HTML attributes (like onchange)
    function previewImage(event) { dermAI.previewImage(event); }
    function clearImage() { dermAI.clearImage(); }
</script>
@endsection
