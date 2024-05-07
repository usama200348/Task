function fetchBlogPosts() {
    fetch('read.php')
        .then(response => response.json())
        .then(posts => {
            const blogPostsContainer = document.getElementById('blog-posts');
            if (posts.length > 0) {
                blogPostsContainer.innerHTML = posts.map(post => `
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">${post.title}</h5>
                            <p class="card-text">${post.content.substring(0, 100)}...</p>
                            <p class="card-text"><small class="text-muted">${post.publication_date}</small></p>
                        </div>
                    </div>
                `).join('');
            } else {
                blogPostsContainer.innerHTML = '<p>No posts found.</p>';
            }
        })
        .catch(error => {
            console.error('Error fetching posts:', error);
            document.getElementById('blog-posts').innerHTML = '<p>Error fetching posts.</p>';
        });
}


document.addEventListener('DOMContentLoaded', fetchBlogPosts);


document.getElementById('updatePostForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const postId = document.getElementById('updatePostId').value;
    const updatedTitle = document.getElementById('updateTitle').value;
    const updatedContent = document.getElementById('updateContent').value;
    const updatedImage = document.getElementById('updateImage').value;
    
    fetch('update.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        id: postId,
        title: updatedTitle,
        content: updatedContent,
        image: updatedImage,
      }),
    })
    .then(response => response.json())
    .then(data => {
      console.log(data);
      fetchBlogPosts(); 
      $('#updatePostModal').modal('hide');     })
    .catch(error => console.error('Error updating post:', error));
  });
  
  
  document.getElementById('confirmDelete').addEventListener('click', function() {
    const postId = document.getElementById('deletePostId').value;
    fetch('delete.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        id: postId,
      }),
    })
    .then(response => response.json())
    .then(data => {
      console.log(data);
      fetchBlogPosts(); 
      $('#deletePostModal').modal('hide'); 
    })
    .catch(error => console.error('Error deleting post:', error));
  });
  

  