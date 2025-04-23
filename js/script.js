// script.js

// Fungsi untuk menangani tombol "Beli"
const buyButtons = document.querySelectorAll('.btn-buy');
buyButtons.forEach(button => {
    button.addEventListener('click', () => {
        // Mendapatkan data produk
        const product = button.getAttribute('data-product');
        const price = button.getAttribute('data-price');

        // Menyimpan data ke Local Storage
        localStorage.setItem('selectedProduct', product);
        localStorage.setItem('selectedPrice', price);

        // Mengarahkan ke halaman pembayaran
        window.location.href = 'payment.html';
    });
});

// Mengisi form pembayaran dengan data dari Local Storage
if (window.location.pathname.includes('payment.html')) {
    const productInput = document.getElementById('product');
    const priceInput = document.getElementById('price');

    const product = localStorage.getItem('selectedProduct');
    const price = localStorage.getItem('selectedPrice');

    if (product && price) {
        productInput.value = product;
        priceInput.value = `Rp${price}`;
    }
}

// Menangani submit form pembayaran
const paymentForm = document.getElementById('paymentForm');
if (paymentForm) {
    paymentForm.addEventListener('submit', function(e) {
        e.preventDefault();

        // Mengambil data dari form
        const name = document.getElementById('name').value;

        const address = document.getElementById('address').value;
        const paymentMethod = document.getElementById('paymentMethod').value;

        // Validasi sederhana
        if (paymentMethod === '') {
            alert('Silakan pilih metode pembayaran.');
            return;
        }

        // Tampilkan pesan sukses
        alert(`Terima kasih ${name}, pesanan Anda akan segera
        diproses.\nAlamat: ${address}\nMetode Pembayaran:
        ${paymentMethod}`);

        // Menghapus data dari Local Storage
        localStorage.removeItem('selectedProduct');
        localStorage.removeItem('selectedPrice');

        // Mengarahkan kembali ke halaman utama
        window.location.href = 'index.html';
    });
}

// Menangani submit form kontak
const contactForm = document.getElementById('contactForm');
if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();

        // Mengambil data dari form
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;

        const message = document.getElementById('message').value;

        // Tampilkan pesan sukses
        alert(`Terima kasih ${name}, pesan Anda telah terkirim.`);

        // Reset form
        contactForm.reset();
    });
}