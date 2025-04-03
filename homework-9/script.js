document.addEventListener("DOMContentLoaded", () => {
    const searchBtn = document.getElementById("searchBtn");
    const fruitInput = document.getElementById("fruitType");
    const resultsDiv = document.getElementById("results");

    searchBtn.addEventListener("click", () => {
        const fruitType = fruitInput.value.trim();
        if (!fruitType) {
            resultsDiv.innerHTML = "<p>Please enter a fruit type.</p>";
            return;
        }

        fetch("api/search.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ type: fruitType })
        })
        .then(res => res.json())
        .then(data => {
            if (!Array.isArray(data)) {
                resultsDiv.innerHTML = "<p>Error: Invalid response format.</p>";
                return;
            }

            if (data.length === 0) {
                resultsDiv.innerHTML = "<p>No matching fruits found.</p>";
            } else {
                resultsDiv.innerHTML = data.map(item => `
                    <div class="card">
                        <h3>${item.name}</h3>
                        <p>${item.description}</p>
                    </div>
                `).join("");
            }
        })
        .catch(err => {
            console.error(err);
            resultsDiv.innerHTML = "<p>Error fetching results.</p>";
        });
    });
});

  