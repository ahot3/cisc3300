document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('search');
    const nameInput = document.getElementById('name');
    const typeInput = document.getElementById('type');
    const descInput = document.getElementById('description');
    const saveBtn = document.getElementById('saveBtn');
    const productList = document.getElementById('productList');

    function fetchProducts(query = '') {
        fetch(`/products?search=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                productList.innerHTML = '';
                data.forEach(product => {
                    const div = document.createElement('div');
                    div.innerHTML = `
                        <strong>${product.name}</strong> (${product.type})<br>
                        ${product.description}<br>
                        <button onclick="deleteProduct(${product.id})">Delete</button>
                        <hr>
                    `;
                    productList.appendChild(div);
                });
            })
            .catch(err => {
                productList.innerHTML = `<p style="color:red;">Error loading products: ${err.message}</p>`;
            });
    }

    searchInput.addEventListener('input', () => {
        fetchProducts(searchInput.value);
    });

    saveBtn.addEventListener('click', () => {
        const formData = new FormData();
        formData.append('name', nameInput.value);
        formData.append('type', typeInput.value);
        formData.append('description', descInput.value);

        fetch('/products', {
            method: 'POST',
            body: formData
        })
            .then(() => {
                nameInput.value = '';
                typeInput.value = '';
                descInput.value = '';
                fetchProducts();
            });
    });

    window.deleteProduct = function(id) {
        const formData = new FormData();
        formData.append('id', id);

        fetch('/products/delete', {
            method: 'POST',
            body: formData
        })
        .then(() => fetchProducts());
    };

    fetchProducts();
});
