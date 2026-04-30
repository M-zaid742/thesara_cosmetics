/**
 * DermAI Chatbot Logic
 * Handles message sending, image analysis, and UI updates.
 */

class DermAIChat {
    constructor(config) {
        this.config = config;
        this.sessionId = null;
        this.chatBox = document.getElementById('chatBox');
        this.messagesArea = document.getElementById('messagesArea');
        this.chatForm = document.getElementById('chatForm');
        this.messageInput = document.getElementById('messageInput');
        this.imageInput = document.getElementById('imageInput');
        this.imagePreviewContainer = document.getElementById('imagePreviewContainer');
        this.imagePreview = document.getElementById('imagePreview');
        this.typingIndicator = document.getElementById('typingIndicator');

        this.init();
    }

    init() {
        // Auto-resize textarea
        this.messageInput.addEventListener('input', () => {
            this.messageInput.style.height = 'auto';
            this.messageInput.style.height = (this.messageInput.scrollHeight < 120 ? this.messageInput.scrollHeight : 120) + 'px';
        });

        // Enter key to send
        this.messageInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                this.chatForm.dispatchEvent(new Event('submit'));
            }
        });

        // Form submission
        this.chatForm.addEventListener('submit', (e) => this.handleSubmit(e));
    }

    previewImage(event) {
        if (event.target.files.length > 0) {
            const src = URL.createObjectURL(event.target.files[0]);
            this.imagePreview.src = src;
            this.imagePreviewContainer.classList.remove('d-none');
            this.messageInput.placeholder = "Include a description of this image (optional)...";
        }
    }

    clearImage() {
        this.imageInput.value = '';
        this.imagePreview.src = '';
        this.imagePreviewContainer.classList.add('d-none');
        this.messageInput.placeholder = "Describe your concern or ask a question...";
    }

    appendMessage(role, content, isHtml = false) {
        const msgDiv = document.createElement('div');
        msgDiv.className = `message ${role} d-flex mb-4`;

        let avatar = role === 'assistant'
            ? `<div class="avatar bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center shadow-sm" style="width:40px; height:40px; flex-shrink:0;"><i class="bi bi-robot"></i></div>`
            : `<div class="avatar bg-secondary text-white rounded-circle ms-3 d-flex align-items-center justify-content-center shadow-sm" style="width:40px; height:40px; flex-shrink:0;"><i class="bi bi-person"></i></div>`;

        let wrapperClass = role === 'assistant' ? 'bg-light text-dark' : 'bg-primary text-white';
        let parsedContent = isHtml ? content : marked.parse(content);

        msgDiv.innerHTML = `
            ${role === 'assistant' ? avatar : ''}
            <div class="message-content ${wrapperClass} p-3 rounded-4 shadow-sm border border-light markdown-content" style="max-width: 75%;">
                ${parsedContent}
            </div>
            ${role === 'user' ? avatar : ''}
        `;

        this.messagesArea.appendChild(msgDiv);
        this.scrollToBottom();
        return msgDiv;
    }

    scrollToBottom() {
        this.chatBox.scrollTop = this.chatBox.scrollHeight;
    }

    hasRealClinicalData(data) {
        const hasOtc = data.treatments?.otc && data.treatments.otc.length > 0;
        const hasRx = data.treatments?.prescription && data.treatments.prescription.length > 0;
        const hasDiet = data.diet_lifestyle && data.diet_lifestyle.length > 0;
        const hasAm = data.skincare_routine?.am && data.skincare_routine.am.length > 0;
        const hasPm = data.skincare_routine?.pm && data.skincare_routine.pm.length > 0;
        return hasOtc || hasRx || hasDiet || hasAm || hasPm;
    }

    buildAnalysisCard(data) {
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

    async handleSubmit(e) {
        e.preventDefault();

        const messageText = this.messageInput.value.trim();
        const imageFile = this.imageInput.files[0];

        if (!messageText && !imageFile) return;

        // Process message visually
        if (messageText) this.appendMessage('user', messageText);
        if (imageFile) this.appendMessage('user', `<div class="d-flex align-items-center gap-2"><i class="bi bi-image fs-4"></i> Sent an image for analysis</div>`, true);

        // UI cleanup
        this.messageInput.value = '';
        this.messageInput.style.height = 'auto';
        this.chatBox.appendChild(this.typingIndicator);
        this.typingIndicator.classList.remove('d-none');
        this.scrollToBottom();

        try {
            if (imageFile) {
                // Image analysis
                const formData = new FormData();
                formData.append('image', imageFile);
                this.clearImage();

                const analyzeRes = await axios.post(this.config.analyzeRoute, formData, {
                    headers: { 'Content-Type': 'multipart/form-data' }
                });

                this.typingIndicator.classList.add('d-none');

                if (analyzeRes.data.success) {
                    const resp = analyzeRes.data.data;
                    let newMsg;
                    if (resp.response_type === 'chat' || !this.hasRealClinicalData(resp)) {
                        newMsg = this.appendMessage('assistant', resp.explanation || "I need more details to provide an analysis.");
                    } else {
                        newMsg = this.appendMessage('assistant', this.buildAnalysisCard(resp), true);
                    }
                    if (newMsg) newMsg.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            } else {
                // Text chat
                const data = {
                    message: messageText,
                    session_id: this.sessionId
                };

                const chatRes = await axios.post(this.config.chatRoute, data);
                this.typingIndicator.classList.add('d-none');

                if (chatRes.data.success) {
                    this.sessionId = chatRes.data.session_id;
                    const resp = chatRes.data.response;
                    let newMsg;
                    
                    // Show card if it's explicitly clinical OR if it contains actual medical data (treatments, routine, etc.)
                    const isClinical = resp.response_type === 'clinical';
                    const hasData = this.hasRealClinicalData(resp);
                    
                    if ((isClinical || hasData) && resp.condition_detected && resp.condition_detected !== 'N/A') {
                        newMsg = this.appendMessage('assistant', this.buildAnalysisCard(resp), true);
                    } else {
                        newMsg = this.appendMessage('assistant', resp.explanation || "I'm sorry, I couldn't perform this clinical analysis.");
                    }
                    if (newMsg) newMsg.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        } catch (error) {
            console.error(error);
            this.typingIndicator.classList.add('d-none');
            this.appendMessage('assistant', '<span class="text-danger">Sorry, I encountered an error. Please try again.</span>', true);
        }
    }
}
