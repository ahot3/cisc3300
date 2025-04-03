document.getElementById('searchForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const type = document.getElementById('typeInput').value;
  
    fetch('api/search.php?type=' + encodeURIComponent(type))
      .then(res => res.json())
      .then(data => {
        const results = document.getElementById('results');
        results.innerHTML = '';
        if (data.length === 0) {
          results.innerHTML = '<p>No matching fruits found.</p>';
        } else {
          data.forEach(item => {
            const div = document.createElement('div');
            div.className = 'card';
            div.innerHTML = '<h2>' + item.name + '</h2><p>' + item.description + '</p>';
            results.appendChild(div);
          });
        }
      });
  });
  