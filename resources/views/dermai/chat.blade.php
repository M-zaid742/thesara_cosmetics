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

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, var(--brand-mocha) 0%, var(--brand-brown) 100%);
    }
    .chat-container {
        border: 1px solid var(--border-subtle);
    }
    .chat-box {
        height: 60vh;
        overflow-y: auto;
        background-color: var(--bg-body);
    }
    .message.user {
        flex-direction: row-reverse;
    }
    .message.user .message-content {
        background: linear-gradient(135deg, var(--brand-mocha) 0%, var(--brand-brown) 100%) !important;
        color: white;
        border-bottom-right-radius: 4px !important;
    }
    .message.assistant .message-content {
        background: var(--bg-card) !important;
        border: 1px solid var(--border-light);
        border-bottom-left-radius: 4px !important;
    }
    .glass-panel {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(12px);
    }
    .markdown-content p:last-child {
        margin-bottom: 0;
    }
    .markdown-content ul, .markdown-content ol {
        margin-bottom: 0.5rem;
    }
    .analysis-card {
        background: var(--bg-card);
        border-left: 4px solid var(--brand-gold);
    }
    .chat-header h4 {
        font-family: var(--font-heading);
    }
    .chat-input-area {
        background: var(--bg-card) !important;
        border-top: 1px solid var(--border-light) !important;
    }
</style>

<script>
    const chatBox = document.getElementById('chatBox');
    const messagesArea = document.getElementById('messagesArea');
    const chatForm = document.getElementById('chatForm');
    const messageInput = document.getElementById('messageInput');
    const imageInput = document.getElementById('imageInput');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    const imagePreview = document.getElementById('imagePreview');
    const typingIndicator = document.getElementById('typingIndicator');
    let sessionId = null;

    // Auto-resize textarea
    messageInput.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight < 120 ? this.scrollHeight : 120) + 'px';
    });
    
    messageInput.addEventListener('keydown', function(e) {
        if(e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            chatForm.dispatchEvent(new Event('submit'));
        }
    });

    function previewImage(event) {
        if(event.target.files.length > 0){
            const src = URL.createObjectURL(event.target.files[0]);
            imagePreview.src = src;
            imagePreviewContainer.classList.remove('d-none');
            messageInput.placeholder = "Include a description of this image (optional)...";
        }
    }

    function clearImage() {
        imageInput.value = '';
        imagePreview.src = '';
        imagePreviewContainer.classList.add('d-none');
        messageInput.placeholder = "Describe your concern or ask a question...";
    }

    function appendMessage(role, content, isHtml = false) {
        const msgDiv = document.createElement('div');
        msgDiv.className = `message ${role} d-flex mb-4`;
        
        let avatar = role === 'assistant' 
            ? '<div class="avatar bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center shadow-sm" style="width:40px; height:40px; flex-shrink:0;"><i class="bi bi-robot"></i></div>'
            : '<div class="avatar bg-secondary text-white rounded-circle ms-3 d-flex align-items-center justify-content-center shadow-sm" style="width:40px; height:40px; flex-shrink:0;"><i class="bi bi-person"></i></div>';
            
        let wrapperClass = role === 'assistant' ? 'bg-light text-dark' : 'bg-primary text-white';
        let parsedContent = isHtml ? content : marked.parse(content);

        msgDiv.innerHTML = `
            ${role === 'assistant' ? avatar : ''}
            <div class="message-content ${wrapperClass} p-3 rounded-4 shadow-sm border border-light markdown-content" style="max-width: 75%;">
                ${parsedContent}
            </div>
            ${role === 'user' ? avatar : ''}
        `;
        
        messagesArea.appendChild(msgDiv);
        scrollToBottom();
        return msgDiv;
    }

    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    function hasRealClinicalData(data) {
        const hasOtc = data.treatments?.otc && data.treatments.otc.length > 0;
        const hasRx = data.treatments?.prescription && data.treatments.prescription.length > 0;
        const hasDiet = data.diet_lifestyle && data.diet_lifestyle.length > 0;
        const hasAm = data.skincare_routine?.am && data.skincare_routine.am.length > 0;
        const hasPm = data.skincare_routine?.pm && data.skincare_routine.pm.length > 0;
        return hasOtc || hasRx || hasDiet || hasAm || hasPm;
    }

    function buildAnalysisCard(data) {
        return `
            <div class="analysis-card p-3 rounded-3 shadow-sm mt-2 mb-2">
                <h5 class="fw-bold text-primary mb-1"><i class="bi bi-clipboard2-pulse"></i> DermAI Clinical Report</h5>
                <p class="mb-2"><strong>Focus:</strong> ${data.condition_detected} <span class="badge bg-${data.severity === 'severe' ? 'danger' : (data.severity === 'moderate' ? 'warning' : 'success')}">${data.severity === 'N/A' ? 'info' : data.severity}</span></p>
                <div class="small mb-3 text-muted">${data.explanation || ''}</div>
                
                <div class="row g-2">
                    <div class="col-md-6">
                        <div class="bg-light p-2 rounded border">
                            <h6 class="text-primary fs-6 mb-1"><i class="bi bi-capsule"></i> Treatments</h6>
                            <ul class="mb-0 small ps-3">
                                ${(data.treatments?.otc || []).map(t => `<li>Otc: ${t}</li>`).join('')}
                                ${(data.treatments?.prescription || []).map(t => `<li>Rx: ${t}</li>`).join('')}
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-light p-2 rounded border">
                            <h6 class="text-success fs-6 mb-1"><i class="bi bi-apple"></i> Diet & Lifestyle</h6>
                            <ul class="mb-0 small ps-3">
                                ${(data.diet_lifestyle || []).map(d => `<li>${d}</li>`).join('')}
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="bg-light p-2 rounded border border-info">
                            <h6 class="text-info fs-6 mb-1"><i class="bi bi-moon-stars"></i> Suggested Routine</h6>
                            <div class="small">
                                <strong>AM:</strong> ${(data.skincare_routine?.am || []).join(' → ')}<br>
                                <strong>PM:</strong> ${(data.skincare_routine?.pm || []).join(' → ')}
                            </div>
                        </div>
                    </div>
                    ${data.products_data && data.products_data.length > 0 ? `
                    <div class="col-12 mt-3">
                        <h6 class="text-primary fw-bold mb-2"><i class="bi bi-cart-check"></i> Recommended Products</h6>
                        <div class="d-flex overflow-auto gap-2 pb-2">
                            ${data.products_data.map(p => `
                                <div class="card shadow-sm border-0 flex-shrink-0" style="width: 140px; border-radius: 8px; overflow: hidden; background-color: var(--bg-card);">
                                    <img src="${p.image_url}" class="card-img-top" style="height: 100px; object-fit: cover;" alt="${p.name}">
                                    <div class="card-body p-2 text-center">
                                        <div class="text-truncate small fw-bold mb-1" title="${p.name}">${p.name}</div>
                                        <div class="text-primary fw-bold small mb-1">Rs. ${p.price}</div>
                                        <a href="/product/${p.id}" class="btn btn-sm btn-outline-primary w-100 py-0" style="font-size: 0.75rem;">View Item</a>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                    ` : ''}
                </div>
                <div class="mt-3 small px-2 py-1 bg-warning text-dark border-warning rounded d-inline-block">
                    <i class="bi bi-exclamation-triangle-fill"></i> Please consult a physician.
                </div>
            </div>
        `;
    }

    chatForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const messageText = messageInput.value.trim();
        const imageFile = imageInput.files[0];
        
        if (!messageText && !imageFile) return;

        // Process message visually
        if (messageText) appendMessage('user', messageText);
        if (imageFile) appendMessage('user', `<div class="d-flex align-items-center gap-2"><i class="bi bi-image fs-4"></i> Sent an image for analysis</div>`, true);

        // UI cleanup
        messageInput.value = '';
        messageInput.style.height = 'auto';
        chatBox.appendChild(typingIndicator);
        typingIndicator.classList.remove('d-none');
        scrollToBottom();

        try {
            if (imageFile) {
                // If there's an image, send to analyze endpoint
                const formData = new FormData();
                formData.append('image', imageFile);
                clearImage(); // Clear UI image
                
                const analyzeRes = await axios.post('{{ route('dermai.analyze') }}', formData, {
                    headers: { 'Content-Type': 'multipart/form-data' }
                });
                
                typingIndicator.classList.add('d-none');
                
                if (analyzeRes.data.success) {
                    const resp = analyzeRes.data.data;
                    let newMsg;
                    if (resp.response_type === 'chat' || !hasRealClinicalData(resp)) {
                        newMsg = appendMessage('assistant', resp.explanation || "I need more details to provide an analysis. Please describe your concern or upload a clearer image.");
                    } else {
                        newMsg = appendMessage('assistant', buildAnalysisCard(resp), true);
                    }
                    if (newMsg) newMsg.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            } else {
                // Determine whether to chat normally
                const data = {
                    message: messageText,
                    session_id: sessionId
                };
                
                const chatRes = await axios.post('{{ route('dermai.chat.message') }}', data);
                typingIndicator.classList.add('d-none');
                
                if (chatRes.data.success) {
                    sessionId = chatRes.data.session_id; // Set session ID
                    const resp = chatRes.data.response;
                    let newMsg;
                    if (resp.response_type === 'clinical' && resp.condition_detected && resp.condition_detected !== 'N/A' && hasRealClinicalData(resp)) {
                        newMsg = appendMessage('assistant', buildAnalysisCard(resp), true);
                    } else {
                        newMsg = appendMessage('assistant', resp.explanation || "I'm sorry, I couldn't perform this clinical analysis without an image or more details.");
                    }
                    if (newMsg) newMsg.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }

            }
        } catch (error) {
            console.error(error);
            typingIndicator.classList.add('d-none');
            appendMessage('assistant', '<span class="text-danger">Sorry, I encountered an error. Please try again.</span>', true);
        }
    });
</script>
@endsection
