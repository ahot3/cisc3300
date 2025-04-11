document.addEventListener("DOMContentLoaded", () => {
    fetchProducts();

    document.getElementById("productForm").addEventListener("submit", async (e) => {
        e.preventDefault();

        const id = document.getElementById("productId").value;
        const name = document.getElementById("name").value;
        const type = document.getElementById("type").value;
        const description = document.getElementById("description").value;

        const payload = { name, type, description };

        const url = id
            ? `/products/update/${id}`
            : `/products/create`;

        const method = id ? "PUT" : "POST";

        await fetch(url, {
            method: method,
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(payload)
        });

        document.getElementById("productForm").reset();
        fetchProducts();
    });
});

async function fetchProducts() {
    const res = await fetch("/products");
    const products = await res.json();

    const list = document.getElementById("productList");
    list.innerHTML = "";

    products.forEach((product) => {
        const item = document.createElement("div");
        item.className = "product-card";
        item.innerHTML = `
            <h3>${product.name}</h3>
            <p><strong>Type:</strong> ${product.type}</p>
            <p><strong>Description:</strong> ${product.description}</p>
            <button onclick="editProduct(${product.id}, '${product.name}', '${product.type}', \`${product.description}\`)">Edit</button>
            <button onclick="deleteProduct(${product.id})">Delete</button>
        `;
        list.appendChild(item);
    });
}

function editProduct(id, name, type, description) {
    document.getElementById("productId").value = id;
    document.getElementById("name").value = name;
    document.getElementById("type").value = type;
    document.getElementById("description").value = description;
}

async function deleteProduct(id) {
    await fetch(`/products/delete/${id}`, {
        method: "DELETE"
    });
    fetchProducts();
}
