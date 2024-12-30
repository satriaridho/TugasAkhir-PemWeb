document.addEventListener('DOMContentLoaded', function() {
    const cart = [];

    // Fungsi untuk update keranjang
    function updateCart() {
        let total = 0;
        let itemCount = 0;

        // Menghitung total harga dan jumlah item
        cart.forEach(item => {
            total += item.price * item.quantity;
            itemCount += item.quantity;
        });

        // Memperbarui tampilan total harga dan jumlah item
        document.getElementById('total').textContent = total;
        document.getElementById('item-count').textContent = itemCount;
    }

    // Menambahkan event listener untuk setiap item menu
    document.querySelectorAll('.menu-item').forEach(item => {
        item.addEventListener('click', function() {
            const menuId = this.getAttribute('id');
            const menuImage = this.getAttribute('gambar');
            const menuName = this.getAttribute('nama');
            const menuPrice = parseInt(this.getAttribute('harga'));

            // Cek apakah item sudah ada di keranjang
            const existingItem = cart.find(cartItem => cartItem.id === menuId);

            if (existingItem) {
                // Jika item sudah ada, tambahkan kuantitasnya
                existingItem.quantity += 1;
            } else {
                // Jika item belum ada, tambahkan item baru ke keranjang
                cart.push({
                    id: menuId,
                    image: menuImage,
                    name: menuName,
                    price: menuPrice,
                    quantity: 1
                });
            }

            // Kirim data ke server untuk disimpan di sesi
            fetch('index.php', {
                method: 'POST',
                body: new URLSearchParams({
                    'add_to_cart': '1',
                    'menu_id': menuId,
                    'menu_image': menuImage,
                    'menu_name': menuName,
                    'menu_price': menuPrice
                })
            }).then(response => {
                // Update keranjang setelah menambah item
                updateCart();
            });
        });
    });
});
