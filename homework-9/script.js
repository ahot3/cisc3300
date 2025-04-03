async function searchFruits() {
    const query = document.getElementById('searchInput').value;

    const res = await fetch('api/search.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ search: query })
    });

    const data = await res.json();
    const results = document.getElementById('results');
    results.innerHTML = '';

    if (Array.isArray(data) && data.length > 0) {
        data.forEach(item => {
            const div = document.createElement('div');
            div.className = 'result';
            div.innerHTML = `<h2>${item.name}</h2><p>${item.description}</p>`;
            results.appendChild(div);
        });
    } else {
        results.innerHTML = '<p>No matching fruits found.</p>';
    }
}
