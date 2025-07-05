function togglePaymentDetails() {
    const method = document.getElementById('payment_method').value;
    const bank = document.getElementById('bankDetails');
    const qris = document.getElementById('qrisDetails');
    const button = document.getElementById('payButton');
    const buttonIcon = button.querySelector('.payment-method-icon');

    bank.classList.remove('show');
    qris.classList.remove('show');

    setTimeout(() => {
        bank.style.display = 'none';
        qris.style.display = 'none';

        if (method === 'bank') {
            bank.style.display = 'block';
            setTimeout(() => bank.classList.add('show'), 10);
            buttonIcon.className = 'fas fa-university payment-method-icon';
            button.innerHTML = '<i class="fas fa-university payment-method-icon"></i>Konfirmasi Transfer';
        } else if (method === 'qris') {
            qris.style.display = 'block';
            setTimeout(() => qris.classList.add('show'), 10);
            buttonIcon.className = 'fas fa-qrcode payment-method-icon';
            button.innerHTML = '<i class="fas fa-qrcode payment-method-icon"></i>Bayar dengan QRIS';
        }
    }, 200);
}

function handlePayment(event) {
    const button = document.getElementById('payButton');
    const message = document.getElementById('successMessage');
    button.innerText = 'Pembayaran Selesai';
    button.disabled = true;
    message.style.display = 'block';

    setTimeout(() => {
        createConfetti();
    }, 500);
}

function createConfetti() {
    const colors = ['#ff6b6b', '#4ecdc4', '#45b7d1', '#96ceb4', '#ffeaa7'];

    for (let i = 0; i < 50; i++) {
        setTimeout(() => {
            const confetti = document.createElement('div');
            confetti.style.position = 'fixed';
            confetti.style.left = Math.random() * 100 + 'vw';
            confetti.style.top = '-10px';
            confetti.style.width = '10px';
            confetti.style.height = '10px';
            confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            confetti.style.borderRadius = '50%';
            confetti.style.pointerEvents = 'none';
            confetti.style.zIndex = '9999';
            confetti.style.animation = 'fall 3s linear forwards';
            document.body.appendChild(confetti);
            setTimeout(() => confetti.remove(), 3000);
        }, i * 50);
    }
}

window.addEventListener('load', () => {
    document.querySelector('.payment-card').style.opacity = '0';
    setTimeout(() => {
        document.querySelector('.payment-card').style.opacity = '1';
    }, 100);
});

// Tambah animasi confetti
const style = document.createElement('style');
style.textContent = `
@keyframes fall {
    to {
        transform: translateY(100vh) rotate(360deg);
        opacity: 0;
    }
}`;
document.head.appendChild(style);
