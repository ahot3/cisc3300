const form = document.getElementById('postForm');
const title = document.getElementById('title');
const content = document.getElementById('content');
const postId = document.getElementById('postId');
const container = document.getElementById('postsContainer');

function fetchPosts() {
  fetch('api/read.php')
    .then(res => res.json())
    .then(data => {
      container.innerHTML = '';
      data.forEach(post => {
        const div = document.createElement('div');
        div.className = 'card';
        div.innerHTML = `
          <h2>${post.title}</h2>
          <p>${post.content}</p>
          <button onclick="editPost(${post.id}, '${post.title}', \`${post.content}\`)">Edit</button>
          <button onclick="deletePost(${post.id})">Delete</button>
        `;
        container.appendChild(div);
      });
    });
}

function editPost(id, t, c) {
  postId.value = id;
  title.value = t;
  content.value = c;
}

function deletePost(id) {
  fetch('api/delete.php', {
    method: 'POST',
    body: JSON.stringify({ id })
  }).then(fetchPosts);
}

form.onsubmit = e => {
  e.preventDefault();
  const data = {
    title: title.value,
    content: content.value,
    id: postId.value
  };

  const url = data.id ? 'api/update.php' : 'api/create.php';

  fetch(url, {
    method: 'POST',
    body: JSON.stringify(data)
  }).then(() => {
    form.reset();
    fetchPosts();
  });
};

fetchPosts();
