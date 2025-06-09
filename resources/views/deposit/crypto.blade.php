@extends('layouts.app')
@section('title', 'Deposit Crypto')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="row justify-content-center mb-4">
        <div class="col-lg-8">
            <div class="text-center">
                <div class="crypto-icon mb-3">
                    <i class="fab fa-bitcoin text-warning"></i>
                </div>
                <h2 class="fw-bold text-dark mb-2">Deposit Cryptocurrency</h2>
                <p class="text-muted">Generate a secure address to receive your crypto deposits</p>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if(!session('address'))
                <!-- Asset Selection Card -->
                <div class="card border-0 shadow-lg crypto-card">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3">
                                <i class="fas fa-coins text-primary me-2"></i>
                                Select Cryptocurrency
                            </h5>
                            <p class="text-muted mb-0">Choose the cryptocurrency you want to deposit</p>
                        </div>

                        <form method="POST" action="{{ route('deposit.crypto') }}" id="cryptoDepositForm">
                            @csrf
                            <div class="mb-4">
                                <div class="crypto-assets-grid">
                                    @foreach($assets as $asset)
                                        <div class="crypto-asset-card" data-asset-id="{{ $asset->id }}">
                                            <input type="radio" name="asset" value="{{ $asset->id }}" id="asset_{{ $asset->id }}" class="asset-radio" required>
                                            <label for="asset_{{ $asset->id }}" class="crypto-asset-label">
                                                <div class="crypto-asset-content">
                                                    <div class="crypto-asset-icon">
                                                        @switch(strtolower($asset->symbol))
                                                            @case('btc')
                                                                <i class="fab fa-bitcoin text-warning"></i>
                                                                @break
                                                            @case('eth')
                                                                <i class="fab fa-ethereum text-info"></i>
                                                                @break
                                                            @case('ltc')
                                                                <i class="fas fa-coins text-secondary"></i>
                                                                @break
                                                            @default
                                                                <i class="fas fa-coins text-primary"></i>
                                                        @endswitch
                                                    </div>
                                                    <div class="crypto-asset-details">
                                                        <div class="crypto-asset-symbol">{{ $asset->symbol }}</div>
                                                        <div class="crypto-asset-name">{{ $asset->name ?? 'Cryptocurrency' }}</div>
                                                    </div>
                                                </div>
                                                <div class="crypto-asset-check">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Important Notice -->
                            <div class="security-notice mb-4">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-shield-alt text-warning me-3 mt-1"></i>
                                    <div>
                                        <h6 class="mb-2 text-warning">Important Security Notice</h6>
                                        <ul class="list-unstyled mb-0 small text-muted">
                                            <li class="mb-1">• Only send the selected cryptocurrency to the generated address</li>
                                            <li class="mb-1">• Sending other cryptocurrencies may result in permanent loss</li>
                                            <li class="mb-1">• Always verify the address before sending funds</li>
                                            <li>• Each address is single-use for security purposes</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 generate-btn" disabled>
                                <i class="fas fa-key me-2"></i>
                                <span class="btn-text">Generate Secure Address</span>
                                <div class="btn-loading d-none">
                                    <div class="spinner-border spinner-border-sm me-2" role="status"></div>
                                    Generating...
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <!-- Generated Address Card -->
                <div class="card border-0 shadow-lg address-card">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <div class="success-icon mb-3">
                                <i class="fas fa-check-circle text-success"></i>
                            </div>
                            <h5 class="fw-bold text-success mb-2">Address Generated Successfully!</h5>
                            <p class="text-muted">Use the address below to deposit your cryptocurrency</p>
                        </div>

                        <!-- QR Code Section -->
                        <div class="qr-section mb-4">
                            <div class="qr-code-container">
                                <div class="qr-code-placeholder">
                                    <i class="fas fa-qrcode text-muted"></i>
                                    <div class="mt-2 small text-muted">QR Code</div>
                                </div>
                            </div>
                        </div>

                        <!-- Address Display -->
                        <div class="address-section mb-4">
                            <label class="form-label fw-semibold mb-2">
                                <i class="fas fa-wallet text-primary me-2"></i>
                                Deposit Address
                            </label>
                            <div class="address-container">
                                <div class="input-group">
                                    <input type="text" class="form-control address-input" value="{{ session('address') }}" readonly id="depositAddress">
                                    <button class="btn btn-outline-primary copy-btn" type="button" data-address="{{ session('address') }}">
                                        <i class="fas fa-copy me-1"></i>
                                        Copy
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Instructions -->
                        <div class="instructions-section mb-4">
                            <h6 class="fw-semibold mb-3">
                                <i class="fas fa-list-ol text-primary me-2"></i>
                                How to Deposit
                            </h6>
                            <div class="instruction-steps">
                                <div class="instruction-step">
                                    <div class="step-number">1</div>
                                    <div class="step-content">
                                        <div class="step-title">Copy the Address</div>
                                        <div class="step-description">Copy the generated address or scan the QR code</div>
                                    </div>
                                </div>
                                <div class="instruction-step">
                                    <div class="step-number">2</div>
                                    <div class="step-content">
                                        <div class="step-title">Send from Your Wallet</div>
                                        <div class="step-description">Use your external wallet to send crypto to this address</div>
                                    </div>
                                </div>
                                <div class="instruction-step">
                                    <div class="step-number">3</div>
                                    <div class="step-content">
                                        <div class="step-title">Wait for Confirmation</div>
                                        <div class="step-description">Your deposit will appear after network confirmations</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Security Warnings -->
                        <div class="security-warnings">
                            <div class="alert alert-warning border-0 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-exclamation-triangle me-2 mt-1"></i>
                                    <div>
                                        <strong>Security Reminder:</strong>
                                        <div class="mt-1 small">
                                            Share this address only through secure, encrypted channels like Signal. 
                                            Never share it via SMS, email, or unsecured messaging apps.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="alert alert-info border-0 mb-0">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-info-circle me-2 mt-1"></i>
                                    <div>
                                        <strong>Single Use Address:</strong>
                                        <div class="mt-1 small">
                                            This address is for one-time use only. Generate a new address for future deposits.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons mt-4">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <a href="{{ route('deposit.crypto') }}" class="btn btn-outline-primary w-100">
                                        <i class="fas fa-plus me-2"></i>
                                        Generate New Address
                                    </a>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <a href="{{ route('wallet') }}" class="btn btn-success w-100">
                                        <i class="fas fa-wallet me-2"></i>
                                        View Wallet
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Additional Info Cards -->
            <div class="row mt-4">
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <div class="info-card-icon">
                            <i class="fas fa-clock text-primary"></i>
                        </div>
                        <div class="info-card-content">
                            <h6 class="mb-1">Processing Time</h6>
                            <small class="text-muted">1-6 confirmations required</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <div class="info-card-icon">
                            <i class="fas fa-shield-alt text-success"></i>
                        </div>
                        <div class="info-card-content">
                            <h6 class="mb-1">Secure Addresses</h6>
                            <small class="text-muted">Unique, single-use addresses</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <div class="info-card-icon">
                            <i class="fas fa-eye text-info"></i>
                        </div>
                        <div class="info-card-content">
                            <h6 class="mb-1">Track Deposits</h6>
                            <small class="text-muted">Real-time status updates</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Copy Success Toast -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="copyToast" class="toast border-0 bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
            <i class="fas fa-check me-2"></i>
            Address copied to clipboard!
        </div>
    </div>
</div>

<style>
.crypto-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.1), rgba(255, 193, 7, 0.05));
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    font-size: 2rem;
}

.crypto-card, .address-card {
    border-radius: 16px;
    transition: all 0.3s ease;
}

.crypto-card:hover, .address-card:hover {
    transform: translateY(-2px);
}

.crypto-assets-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1rem;
}

.crypto-asset-card {
    position: relative;
}

.asset-radio {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.crypto-asset-label {
    display: block;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 1.25rem;
    cursor: pointer;
    transition: all 0.2s ease;
    position: relative;
    background: white;
    margin-bottom: 0;
}

.crypto-asset-label:hover {
    border-color: var(--bs-primary);
    background-color: rgba(var(--bs-primary-rgb), 0.02);
    transform: translateY(-1px);
}

.asset-radio:checked + .crypto-asset-label {
    border-color: var(--bs-primary);
    background-color: rgba(var(--bs-primary-rgb), 0.05);
    box-shadow: 0 4px 12px rgba(var(--bs-primary-rgb), 0.15);
}

.crypto-asset-content {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.crypto-asset-icon {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: rgba(var(--bs-primary-rgb), 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.crypto-asset-symbol {
    font-weight: 700;
    font-size: 1.1rem;
    color: var(--bs-dark);
}

.crypto-asset-name {
    font-size: 0.875rem;
    color: var(--bs-secondary);
}

.crypto-asset-check {
    position: absolute;
    top: 0.75rem;
    right: 0.75rem;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: var(--bs-primary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    opacity: 0;
    transform: scale(0);
    transition: all 0.2s ease;
}

.asset-radio:checked + .crypto-asset-label .crypto-asset-check {
    opacity: 1;
    transform: scale(1);
}

.security-notice {
    background: rgba(255, 193, 7, 0.05);
    border: 1px solid rgba(255, 193, 7, 0.2);
    border-radius: 12px;
    padding: 1rem;
}

.generate-btn {
    border-radius: 12px;
    padding: 0.875rem 2rem;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.2s ease;
}

.generate-btn:hover:not(:disabled) {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(var(--bs-primary-rgb), 0.3);
}

.generate-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.success-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: rgba(var(--bs-success-rgb), 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    font-size: 2.5rem;
}

.qr-section {
    text-align: center;
}

.qr-code-container {
    display: inline-block;
    padding: 1rem;
    background: white;
    border: 2px dashed #dee2e6;
    border-radius: 12px;
}

.qr-code-placeholder {
    width: 150px;
    height: 150px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: #adb5bd;
}

.address-container {
    position: relative;
}

.address-input {
    font-family: 'Courier New', monospace;
    font-size: 0.9rem;
    padding: 0.75rem;
    background: #f8f9fa;
    border-radius: 8px 0 0 8px;
}

.copy-btn {
    border-radius: 0 8px 8px 0;
    padding: 0.75rem 1rem;
    font-weight: 500;
}

.instruction-steps {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.instruction-step {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.step-number {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: var(--bs-primary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.875rem;
    flex-shrink: 0;
}

.step-title {
    font-weight: 600;
    color: var(--bs-dark);
    margin-bottom: 0.25rem;
}

.step-description {
    font-size: 0.875rem;
    color: var(--bs-secondary);
}

.info-card {
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 12px;
    padding: 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    height: 100%;
    transition: all 0.2s ease;
}

.info-card:hover {
    border-color: var(--bs-primary);
    transform: translateY(-1px);
}

.info-card-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background: rgba(var(--bs-primary-rgb), 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

@media (max-width: 768px) {
    .crypto-assets-grid {
        grid-template-columns: 1fr;
    }
    
    .crypto-asset-content {
        gap: 0.75rem;
    }
    
    .crypto-asset-icon {
        width: 40px;
        height: 40px;
        font-size: 1.25rem;
    }
    
    .instruction-step {
        gap: 0.75rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const assetRadios = document.querySelectorAll('.asset-radio');
    const generateBtn = document.querySelector('.generate-btn');
    const copyBtn = document.querySelector('.copy-btn');
    const form = document.getElementById('cryptoDepositForm');

    // Asset selection
    assetRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            updateButtonState();
        });
    });

    // Form submission
    if (form) {
        form.addEventListener('submit', function(e) {
            const btnText = generateBtn.querySelector('.btn-text');
            const btnLoading = generateBtn.querySelector('.btn-loading');
            
            btnText.classList.add('d-none');
            btnLoading.classList.remove('d-none');
            generateBtn.disabled = true;
        });
    }

    // Copy address functionality
    if (copyBtn) {
        copyBtn.addEventListener('click', function() {
            const address = this.dataset.address;
            navigator.clipboard.writeText(address).then(function() {
                // Show success toast
                const toast = new bootstrap.Toast(document.getElementById('copyToast'));
                toast.show();
                
                // Update button text temporarily
                const originalText = copyBtn.innerHTML;
                copyBtn.innerHTML = '<i class="fas fa-check me-1"></i>Copied!';
                copyBtn.classList.add('btn-success');
                copyBtn.classList.remove('btn-outline-primary');
                
                setTimeout(() => {
                    copyBtn.innerHTML = originalText;
                    copyBtn.classList.remove('btn-success');
                    copyBtn.classList.add('btn-outline-primary');
                }, 2000);
            }).catch(function(err) {
                console.error('Failed to copy: ', err);
            });
        });
    }

    function updateButtonState() {
        const selectedAsset = document.querySelector('.asset-radio:checked');
        if (generateBtn) {
            generateBtn.disabled = !selectedAsset;
        }
    }

    // Initialize
    updateButtonState();
});
</script>
@endsection