@extends('layouts.app')
@section('title', 'Deposit Funds')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="row justify-content-center mb-4">
        <div class="col-lg-8">
            <div class="text-center">
                <div class="deposit-icon mb-3">
                    <i class="fas fa-wallet text-primary"></i>
                </div>
                <h2 class="fw-bold text-dark mb-2">Add Funds to Your Wallet</h2>
                <p class="text-muted">Deposit USD to start trading and investing</p>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <!-- Main Deposit Card -->
            <div class="card border-0 shadow-lg deposit-card">
                <div class="card-body p-4">
                    <!-- Amount Selection -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold mb-3">
                            <i class="fas fa-dollar-sign text-primary me-2"></i>
                            How much would you like to deposit?
                        </label>
                        
                        <!-- Quick Amount Buttons -->
                        <div class="quick-amounts mb-3">
                            <button type="button" class="btn btn-outline-primary quick-amount-btn" data-amount="100">$100</button>
                            <button type="button" class="btn btn-outline-primary quick-amount-btn" data-amount="250">$250</button>
                            <button type="button" class="btn btn-outline-primary quick-amount-btn" data-amount="500">$500</button>
                            <button type="button" class="btn btn-outline-primary quick-amount-btn" data-amount="1000">$1,000</button>
                        </div>

                        <!-- Custom Amount Input -->
                        <form method="POST" action="{{ route('deposit.fiat') }}" id="depositForm">
                            @csrf
                            <div class="amount-input-container">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-dollar-sign text-muted"></i>
                                    </span>
                                    <input 
                                        type="number" 
                                        class="form-control border-start-0 amount-input @error('amount') is-invalid @enderror" 
                                        id="amount" 
                                        name="amount" 
                                        step="0.01" 
                                        min="1" 
                                        value="{{ old('amount') }}" 
                                        placeholder="Enter custom amount"
                                        required
                                    >
                                    @error('amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="amount-display mt-2">
                                    <small class="text-muted">Minimum deposit: $1.00</small>
                                </div>
                            </div>
                    </div>

                    <!-- Payment Method Selection -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold mb-3">
                            <i class="fas fa-credit-card text-primary me-2"></i>
                            Payment Method
                        </label>
                        <div class="payment-methods">
                            <div class="payment-method-item active">
                                <input type="radio" class="form-check-input" name="payment_method" value="card" checked>
                                <div class="payment-method-content">
                                    <div class="payment-method-icon">
                                        <i class="fas fa-credit-card"></i>
                                    </div>
                                    <div class="payment-method-details">
                                        <div class="payment-method-title">Debit/Credit Card</div>
                                        <div class="payment-method-subtitle">Instant deposit • 2.9% fee</div>
                                    </div>
                                </div>
                            </div>
                            <div class="payment-method-item">
                                <input type="radio" class="form-check-input" name="payment_method" value="bank">
                                <div class="payment-method-content">
                                    <div class="payment-method-icon">
                                        <i class="fas fa-university"></i>
                                    </div>
                                    <div class="payment-method-details">
                                        <div class="payment-method-title">Bank Transfer</div>
                                        <div class="payment-method-subtitle">1-3 business days • No fees</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Deposit Summary -->
                    <div class="deposit-summary mb-4">
                        <div class="summary-row">
                            <span class="summary-label">Deposit Amount</span>
                            <span class="summary-value" id="depositAmount">$0.00</span>
                        </div>
                        <div class="summary-row">
                            <span class="summary-label">Processing Fee</span>
                            <span class="summary-value" id="processingFee">$0.00</span>
                        </div>
                        <hr class="my-2">
                        <div class="summary-row total-row">
                            <span class="summary-label fw-bold">Total Charge</span>
                            <span class="summary-value fw-bold" id="totalCharge">$0.00</span>
                        </div>
                    </div>

                    <!-- Security Notice -->
                    <div class="security-notice mb-4">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-shield-alt text-success me-2 mt-1"></i>
                            <div>
                                <small class="text-muted">
                                    <strong>Secure Transaction:</strong> Your payment information is encrypted and processed securely. We never store your card details.
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary btn-lg w-100 deposit-btn" disabled>
                        <i class="fas fa-lock me-2"></i>
                        <span class="btn-text">Proceed to Payment</span>
                        <div class="btn-loading d-none">
                            <div class="spinner-border spinner-border-sm me-2" role="status"></div>
                            Processing...
                        </div>
                    </button>
                        </form>
                </div>
            </div>

            <!-- Additional Info Cards -->
            <div class="row mt-4">
                <div class="col-md-6 mb-3">
                    <div class="info-card">
                        <div class="info-card-icon">
                            <i class="fas fa-clock text-primary"></i>
                        </div>
                        <div class="info-card-content">
                            <h6 class="mb-1">Instant Deposits</h6>
                            <small class="text-muted">Card deposits are available immediately</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="info-card">
                        <div class="info-card-icon">
                            <i class="fas fa-shield-alt text-success"></i>
                        </div>
                        <div class="info-card-content">
                            <h6 class="mb-1">Bank-Level Security</h6>
                            <small class="text-muted">256-bit SSL encryption</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
@if(session('success'))
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-body text-center p-4">
                <div class="success-icon mb-3">
                    <i class="fas fa-check-circle text-success"></i>
                </div>
                <h5 class="mb-2">Deposit Successful!</h5>
                <p class="text-muted mb-3">{{ session('success') }}</p>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Continue</button>
            </div>
        </div>
    </div>
</div>
@endif


<script>
document.addEventListener('DOMContentLoaded', function() {
    const amountInput = document.getElementById('amount');
    const quickAmountBtns = document.querySelectorAll('.quick-amount-btn');
    const paymentMethodInputs = document.querySelectorAll('input[name="payment_method"]');
    const paymentMethodItems = document.querySelectorAll('.payment-method-item');
    const depositBtn = document.querySelector('.deposit-btn');
    const form = document.getElementById('depositForm');

    // Quick amount buttons
    quickAmountBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const amount = this.dataset.amount;
            amountInput.value = amount;
            
            // Update active state
            quickAmountBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            updateSummary();
            updateButtonState();
        });
    });

    // Payment method selection
    paymentMethodInputs.forEach((input, index) => {
        input.addEventListener('change', function() {
            paymentMethodItems.forEach(item => item.classList.remove('active'));
            paymentMethodItems[index].classList.add('active');
            updateSummary();
        });
    });

    // Payment method item clicks
    paymentMethodItems.forEach((item, index) => {
        item.addEventListener('click', function() {
            paymentMethodInputs[index].checked = true;
            paymentMethodInputs[index].dispatchEvent(new Event('change'));
        });
    });

    // Amount input changes
    amountInput.addEventListener('input', function() {
        // Remove active state from quick buttons
        quickAmountBtns.forEach(btn => btn.classList.remove('active'));
        updateSummary();
        updateButtonState();
    });

    // Form submission
    form.addEventListener('submit', function(e) {
        const btnText = depositBtn.querySelector('.btn-text');
        const btnLoading = depositBtn.querySelector('.btn-loading');
        
        btnText.classList.add('d-none');
        btnLoading.classList.remove('d-none');
        depositBtn.disabled = true;
    });

    function updateSummary() {
        const amount = parseFloat(amountInput.value) || 0;
        const selectedPaymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
        
        let fee = 0;
        if (selectedPaymentMethod === 'card') {
            fee = amount * 0.029; // 2.9% fee
        }
        
        const total = amount + fee;
        
        document.getElementById('depositAmount').textContent = `$${amount.toFixed(2)}`;
        document.getElementById('processingFee').textContent = `$${fee.toFixed(2)}`;
        document.getElementById('totalCharge').textContent = `$${total.toFixed(2)}`;
    }

    function updateButtonState() {
        const amount = parseFloat(amountInput.value) || 0;
        depositBtn.disabled = amount < 1;
    }

    // Initialize
    updateSummary();
    updateButtonState();

    // Show success modal if there's a success message
    @if(session('success'))
        const successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
    @endif
});
</script>
@endsection