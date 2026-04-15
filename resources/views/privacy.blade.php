<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Oykey CRM | Privacy Policy & Meta Connect</title>
    <!-- Google Fonts for clean typography -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <!-- Font Awesome 6 (free icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f4f7fc;
            color: #1a2c3e;
            line-height: 1.5;
            padding: 2rem 1rem;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            background: white;
            border-radius: 32px;
            box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.08), 0 2px 6px rgba(0, 0, 0, 0.02);
            overflow: hidden;
        }

        /* header / connect banner */
        .connect-header {
            background: linear-gradient(135deg, #0b2b3b 0%, #1a4a5f 100%);
            padding: 1.8rem 2.5rem;
            color: white;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.15);
        }

        .brand h2 {
            font-weight: 700;
            font-size: 1.7rem;
            letter-spacing: -0.3px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand h2 i {
            font-size: 1.8rem;
            color: #7bc5e8;
        }

        .brand p {
            font-size: 0.85rem;
            opacity: 0.85;
            margin-top: 6px;
        }

        .connect-action {
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(4px);
            padding: 0.6rem 1.2rem;
            border-radius: 60px;
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .connect-status {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .status-badge {
            background: #e9f5ef;
            color: #1e6f3f;
            padding: 5px 12px;
            border-radius: 40px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-badge.disconnected {
            background: #ffe6e5;
            color: #bc3f2e;
        }

        .btn-meta {
            background: #1877F2;
            border: none;
            padding: 8px 20px;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.9rem;
            color: white;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-family: inherit;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .btn-meta i {
            font-size: 1rem;
        }

        .btn-meta:hover {
            background: #0e63d4;
            transform: scale(1.02);
        }

        .btn-meta:disabled {
            background: #9bb7d4;
            cursor: not-allowed;
            transform: none;
        }

        .privacy-content {
            padding: 2rem 2.5rem;
        }

        /* typography */
        h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            letter-spacing: -0.02em;
            color: #0b2b3b;
        }

        .effective-date {
            background: #f0f4f9;
            padding: 0.6rem 1.2rem;
            border-radius: 20px;
            display: inline-block;
            font-size: 0.85rem;
            margin: 1rem 0 1.5rem 0;
            color: #2c5a74;
            font-weight: 500;
        }

        h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 1.8rem 0 0.8rem 0;
            color: #144d66;
            border-left: 4px solid #2d8fbb;
            padding-left: 1rem;
        }

        h3 {
            font-size: 1.2rem;
            font-weight: 600;
            margin: 1.2rem 0 0.5rem 0;
            color: #1f5e7a;
        }

        p, li {
            font-size: 1rem;
            line-height: 1.55;
            color: #2c3e44;
            margin-bottom: 0.75rem;
        }

        ul, ol {
            margin: 0.5rem 0 1rem 1.8rem;
        }

        li {
            margin-bottom: 0.4rem;
        }

        .highlight-box {
            background: #eef4fa;
            border-radius: 20px;
            padding: 1rem 1.5rem;
            margin: 1.2rem 0;
            border-left: 4px solid #1877F2;
        }

        .footer-note {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e2edf2;
            font-size: 0.85rem;
            text-align: center;
            color: #5e7e8f;
        }

        .contact-block {
            background: #f9fbfd;
            border-radius: 24px;
            padding: 1.2rem 1.8rem;
            margin: 2rem 0 0.5rem;
            border: 1px solid #dce9f0;
        }

        @media (max-width: 700px) {
            .connect-header {
                flex-direction: column;
                align-items: flex-start;
            }
            .privacy-content {
                padding: 1.5rem;
            }
            h1 {
                font-size: 1.7rem;
            }
            h2 {
                font-size: 1.3rem;
            }
        }

        .inline-code {
            background: #eef2f5;
            font-family: monospace;
            padding: 0.2rem 0.4rem;
            border-radius: 8px;
            font-size: 0.85rem;
        }

        i.fa, i.fab {
            margin-right: 4px;
        }

        button:focus-visible {
            outline: 2px solid white;
            outline-offset: 2px;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Header with Connect integration (Facebook Lead Ads) -->
    {{-- <div class="connect-header">
        <div class="brand">
            <h2><i class="fas fa-chart-line"></i> Oykey CRM</h2>
            <p>Lead Management • Smart Integration • Privacy First</p>
        </div>
        <div class="connect-action">
            <div class="connect-status" id="connectStatusArea">
                <i class="fab fa-meta" style="font-size: 1.2rem;"></i>
                <span id="statusText">Meta Lead Ads: Not Connected</span>
                <span id="statusBadge" class="status-badge disconnected">Disconnected</span>
            </div>
            <button id="connectMetaBtn" class="btn-meta"><i class="fab fa-facebook"></i> Connect Meta Lead Forms</button>
        </div>
    </div> --}}

    <div class="privacy-content">
        <h1>Privacy Policy</h1>
        <div class="effective-date">
            <i class="far fa-calendar-alt"></i> Effective Date: 01/03/2026 &nbsp;|&nbsp; 
            <i class="fas fa-edit"></i> Last Updated: 10/04/2026
        </div>

        <!-- 1. Introduction -->
        <h2>1. Introduction</h2>
        <p>Welcome to Oykey (“we”, “our”, “us”). We provide a SaaS-based Lead Management CRM that allows users to integrate their lead sources, including forms from platforms such as Meta (Facebook & Instagram), into a centralized dashboard. We are committed to protecting your privacy and ensuring transparency about how your data is collected, used, and safeguarded.</p>

        <!-- 2. Scope -->
        <h2>2. Scope of Policy</h2>
        <p>This Privacy Policy applies to:</p>
        <ul>
            <li>Users of our CRM platform</li>
            <li>Businesses connecting their lead sources (e.g., Meta Lead Forms)</li>
            <li>Visitors of our website</li>
        </ul>

        <!-- 3. Information we collect -->
        <h2>3. Information We Collect</h2>
        <h3>3.1 Information You Provide</h3>
        <ul><li>Name, email address, phone number</li><li>Business details (company name, website, etc.)</li><li>Account login credentials</li></ul>
        <h3>3.2 Information from Third-Party Integrations</h3>
        <ul><li>Lead data (name, phone, email, custom fields)</li><li>Campaign and form-related metadata</li></ul>
        <h3>3.3 Automatically Collected Data</h3>
        <ul><li>IP address</li><li>Device/browser type</li><li>Usage data (login activity, feature usage)</li></ul>

        <!-- 4. How we use information -->
        <h2>4. How We Use Information</h2>
        <p>We use collected data to: provide and operate our CRM services; sync and display leads from integrated platforms; improve product functionality and user experience; provide customer support; ensure security and prevent fraud; comply with legal obligations.</p>

        <!-- 5. Meta data compliance (critical) -->
        <h2>5. Data from Meta (Facebook & Instagram)</h2>
        <div class="highlight-box">
            <i class="fab fa-facebook-square" style="color:#1877F2; margin-right: 8px;"></i> <strong>Meta Integration Compliance</strong>
            <p style="margin-top: 8px;">If you connect your account via Meta Platforms, Inc. services:</p>
            <ul>
                <li>We only access data that you explicitly authorize</li>
                <li>We do not sell or misuse Meta lead data</li>
                <li>Data is used solely to deliver CRM functionality (lead syncing, management, notifications)</li>
                <li>We comply with Meta Platform Terms and Data Protection requirements</li>
            </ul>
        </div>

        <!-- 6. Data sharing -->
        <h2>6. Data Sharing & Disclosure</h2>
        <p>We do NOT sell your data. We may share data only in limited cases: with trusted service providers (hosting, analytics, etc.), when required by law, or to protect rights, safety, or prevent fraud. All third-party vendors are bound by strict data protection obligations.</p>

        <!-- 7. Security -->
        <h2>7. Data Storage & Security</h2>
        <p>We implement industry-standard security measures: SSL encryption, secure cloud infrastructure, access control and authentication, regular monitoring and updates. Despite best efforts, no system is 100% secure. However, we continuously improve our safeguards.</p>

        <!-- 8. Retention -->
        <h2>8. Data Retention</h2>
        <p>Data is retained only as long as necessary to provide services. Users can request deletion at any time. Deleted data is permanently removed within a reasonable timeframe.</p>

        <!-- 9. User Rights -->
        <h2>9. User Rights</h2>
        <p>You have the right to: access your data; correct inaccurate data; request deletion; withdraw consent; disconnect integrations (like Meta Lead Forms). To exercise these rights, contact us at: <strong>info@oykey.in</strong></p>

        <!-- 10. Third Party -->
        <h2>10. Third-Party Links & Services</h2>
        <p>Our platform may integrate with third-party services. We are not responsible for their privacy practices. Users should review their respective policies.</p>

        <!-- 11. Children -->
        <h2>11. Children’s Privacy</h2>
        <p>Our services are not intended for individuals under 18. We do not knowingly collect data from minors.</p>

        <!-- 12. Changes -->
        <h2>12. Changes to This Policy</h2>
        <p>We may update this Privacy Policy periodically. Updates will be posted on this page with a revised "Last Updated" date.</p>

        <!-- 14. Compliance statement -->
        <h2>14. Compliance Statement</h2>
        <p>We comply with applicable data protection laws, platform policies (including Meta Lead Ads policies), and industry best practices for SaaS data handling.</p>

        <!-- 15. Consent -->
        <h2>15. Consent</h2>
        <p>By using our services, you agree to this Privacy Policy and consent to our data practices.</p>

        <!-- 16. Contact + additional business details -->
        <div class="contact-block">
            <h2 style="margin-top:0; border-left-color:#2d8fbb;">16. Contact Information</h2>
            {{-- <p><i class="fas fa-envelope"></i> <strong>Email:</strong> info@oykey.in<br> --}}
            <i class="fas fa-building"></i> <strong>Company Name:</strong> Alphonic India Pvt. Ltd.<br>
            <i class="fas fa-map-marker-alt"></i> <strong>Address:</strong> 3rd Floor, C-203, Noida Sector 63, UP-201301<br>
            <i class="fas fa-headset"></i> <strong>Support:</strong> info@oykey.in</p>
            <p style="margin-bottom:0; font-size:0.9rem;">For privacy requests or data deletion, please email us. We respond within 30 days.</p>
        </div>

        <div class="footer-note">
            <i class="fas fa-shield-alt"></i> Oykey CRM — Lead management with transparency & security. 
            <br>This document reflects our commitment to Meta platform policies and user data protection.
        </div>
    </div>
</div>

{{-- <script>
    // Simulate realistic Meta OAuth connection flow (Facebook Lead Ads Integration)
    // This UI shows "Connect" and stores a mock connection state in localStorage.
    // In production, this would redirect to Meta OAuth dialog, but here we emulate
    // the connection process to demonstrate the "connect" feature required.
    
    const connectBtn = document.getElementById('connectMetaBtn');
    const statusTextSpan = document.getElementById('statusText');
    const statusBadgeSpan = document.getElementById('statusBadge');

    // Helper: update connection UI based on state
    function updateConnectionUI(isConnected) {
        if (isConnected) {
            statusTextSpan.innerHTML = '<i class="fab fa-meta"></i> Meta Lead Ads: Connected ✓';
            statusBadgeSpan.innerHTML = 'Connected';
            statusBadgeSpan.className = 'status-badge';
            statusBadgeSpan.style.background = '#dff0e4';
            statusBadgeSpan.style.color = '#116b3c';
            connectBtn.innerHTML = '<i class="fas fa-link-slash"></i> Disconnect Meta';
            // change button style slightly but keep primary
            connectBtn.style.background = '#4b5c6e';
            connectBtn.style.backgroundColor = '#2c3e50';
        } else {
            statusTextSpan.innerHTML = '<i class="fab fa-meta"></i> Meta Lead Ads: Not Connected';
            statusBadgeSpan.innerHTML = 'Disconnected';
            statusBadgeSpan.className = 'status-badge disconnected';
            connectBtn.innerHTML = '<i class="fab fa-facebook"></i> Connect Meta Lead Forms';
            connectBtn.style.background = '#1877F2';
            connectBtn.style.backgroundColor = '';
        }
    }

    // retrieve stored connection from localStorage (simulate persisted integration)
    function getStoredConnection() {
        const stored = localStorage.getItem('oykey_meta_connected');
        return stored === 'true';
    }

    function setStoredConnection(connected) {
        localStorage.setItem('oykey_meta_connected', connected);
    }

    // initial load
    let isConnected = getStoredConnection();
    updateConnectionUI(isConnected);

    // handle connect/disconnect click: this demonstrates explicit user consent & integration flow.
    // In a real CRM, the connect action would redirect to Facebook OAuth endpoint with app_id, scope: 'leads_retrieval', 'pages_manage_ads', etc.
    // But given this is a demonstration of "correct this privacy policy page with connect", we implement a compliant mock
    // that simulates connecting Meta Lead Forms while respecting privacy policy statements.
    connectBtn.addEventListener('click', async () => {
        const currentlyConnected = getStoredConnection();
        
        if (currentlyConnected) {
            // Disconnect flow: user removes integration
            const userConfirmed = confirm("Disconnect Meta Lead Ads? Your previously synced leads will remain in CRM but new leads won't auto-sync. You can reconnect anytime. Do you want to proceed?");
            if (userConfirmed) {
                setStoredConnection(false);
                updateConnectionUI(false);
                // Optional: show toast feedback
                showToast("Meta Lead Ads disconnected. Integration removed.", "info");
                // In a real system, we'd revoke OAuth token via backend.
            }
        } else {
            // Connect flow: request authorization (mock OAuth popup / redirect simulation)
            // According to Meta platform policies, we must request explicit permission and show data usage.
            // We show a detailed consent dialog referencing privacy policy.
            const consentGiven = await showMetaConsentDialog();
            if (consentGiven) {
                // Simulate OAuth handshake success
                setStoredConnection(true);
                updateConnectionUI(true);
                showToast("Successfully connected to Meta Lead Ads! Lead forms will now sync.", "success");
                // Here we would normally redirect to Meta OAuth URL. For demo purposes we just set state.
                // Additional note: The CRM would now have a webhook / leadgen integration.
            } else {
                showToast("Connection cancelled. We never access data without your permission.", "warning");
            }
        }
    });

    // Custom consent modal matching Meta's requirements and our privacy policy statements
    function showMetaConsentDialog() {
        return new Promise((resolve) => {
            // create modal overlay
            const modalDiv = document.createElement('div');
            modalDiv.style.position = 'fixed';
            modalDiv.style.top = '0';
            modalDiv.style.left = '0';
            modalDiv.style.width = '100%';
            modalDiv.style.height = '100%';
            modalDiv.style.backgroundColor = 'rgba(0,0,0,0.65)';
            modalDiv.style.display = 'flex';
            modalDiv.style.alignItems = 'center';
            modalDiv.style.justifyContent = 'center';
            modalDiv.style.zIndex = '10000';
            modalDiv.style.backdropFilter = 'blur(3px)';
            modalDiv.style.fontFamily = "'Inter', sans-serif";
            
            const modalCard = document.createElement('div');
            modalCard.style.maxWidth = '500px';
            modalCard.style.width = '90%';
            modalCard.style.backgroundColor = 'white';
            modalCard.style.borderRadius = '32px';
            modalCard.style.padding = '1.8rem';
            modalCard.style.boxShadow = '0 30px 40px rgba(0,0,0,0.2)';
            modalCard.style.animation = 'fadeSlideUp 0.2s ease';
            
            modalCard.innerHTML = `
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 1.2rem;">
                    <i class="fab fa-facebook" style="font-size: 32px; color:#1877F2;"></i>
                    <h3 style="margin:0; font-weight:700;">Connect Meta Lead Ads</h3>
                </div>
                <p style="margin-bottom: 12px;"><strong>Oykey CRM</strong> requests permission to access your Facebook & Instagram lead forms.</p>
                <div style="background:#f5f8ff; border-radius: 20px; padding: 12px 16px; margin: 16px 0;">
                    <p style="margin:0 0 6px 0; font-weight:600;"><i class="fas fa-check-circle" style="color:#2a9d8f;"></i> What we will access:</p>
                    <ul style="margin: 0 0 0 20px;">
                        <li>Lead data from connected Pages (name, email, phone, answers)</li>
                        <li>Form & campaign metadata</li>
                        <li>Page access to retrieve leads via webhooks/API</li>
                    </ul>
                    <p style="margin-top: 12px; font-size:0.85rem; color:#2c5f7a;"><i class="fas fa-lock"></i> We never sell or share your lead data. Data used only for CRM syncing as per <a href="#" style="color:#1877F2;" id="privacyPolicyLinkModal">Privacy Policy</a>.</p>
                </div>
                <p style="font-size:0.9rem;">By continuing, you agree to our <strong>Privacy Policy</strong> and <strong>Meta Platform Terms</strong>. You can disconnect anytime from dashboard.</p>
                <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 28px;">
                    <button id="cancelConsentBtn" style="background:#eef2f5; border:none; padding: 8px 20px; border-radius: 40px; font-weight:500; cursor:pointer;">Cancel</button>
                    <button id="approveConsentBtn" style="background:#1877F2; border:none; padding: 8px 24px; border-radius: 40px; color:white; font-weight:600; cursor:pointer;">Allow & Connect</button>
                </div>
            `;
            
            modalDiv.appendChild(modalCard);
            document.body.appendChild(modalDiv);
            
            // add keyframe animation dynamically
            if (!document.querySelector('#modalKeyframeStyle')) {
                const styleSheet = document.createElement('style');
                styleSheet.id = 'modalKeyframeStyle';
                styleSheet.textContent = `@keyframes fadeSlideUp { from { opacity:0; transform: translateY(20px); } to { opacity:1; transform: translateY(0); } }`;
                document.head.appendChild(styleSheet);
            }
            
            const cancelBtn = modalCard.querySelector('#cancelConsentBtn');
            const approveBtn = modalCard.querySelector('#approveConsentBtn');
            const privacyLink = modalCard.querySelector('#privacyPolicyLinkModal');
            
            const closeModal = (result) => {
                if (modalDiv && modalDiv.parentNode) modalDiv.remove();
                resolve(result);
            };
            
            cancelBtn.addEventListener('click', () => closeModal(false));
            approveBtn.addEventListener('click', () => closeModal(true));
            privacyLink.addEventListener('click', (e) => {
                e.preventDefault();
                // scroll to privacy policy section smoothly (optional)
                document.querySelector('.privacy-content').scrollIntoView({ behavior: 'smooth' });
                closeModal(false); // user can reconsider, but we close modal and they can click connect again
                showToast("Review our Privacy Policy before connecting. Click Connect again to proceed.", "info");
            });
            modalDiv.addEventListener('click', (e) => { if(e.target === modalDiv) closeModal(false); });
        });
    }
    
    // Simple toast notification
    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.style.position = 'fixed';
        toast.style.bottom = '24px';
        toast.style.left = '50%';
        toast.style.transform = 'translateX(-50%)';
        toast.style.backgroundColor = type === 'success' ? '#1e6f3f' : (type === 'warning' ? '#c97e00' : '#1f6392');
        toast.style.color = 'white';
        toast.style.padding = '10px 24px';
        toast.style.borderRadius = '50px';
        toast.style.fontWeight = '500';
        toast.style.fontSize = '0.9rem';
        toast.style.zIndex = '10001';
        toast.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
        toast.style.backdropFilter = 'blur(4px)';
        toast.innerHTML = `<i class="fas ${type === 'success' ? 'fa-check-circle' : (type === 'warning' ? 'fa-exclamation-triangle' : 'fa-info-circle')}" style="margin-right:8px;"></i> ${message}`;
        document.body.appendChild(toast);
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 300);
        }, 3200);
    }
    
    // In addition: for any external links or anchor, also mention we comply with Meta policies.
    console.log("Privacy Policy page with Meta Connect ready. Compliant with Meta Lead Ads policies and Oykey data handling.");
    
    // Also ensure that if the user ever wants to disconnect we respect rights.
    // For completeness we also attach a small rights reminder in console.
</script> --}}
</body>
</html>