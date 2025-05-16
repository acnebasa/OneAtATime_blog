<div class="posts-container">
    <?php if (!empty($posts)): ?>
        <?php foreach ($posts as $post): ?>
            <div class="post-card" data-post-id="<?php echo $post['post_id']; ?>">
                <div class="post-header">
                    <span class="post-username"><?php echo $username; ?></span>
                    <span class="post-time"><?php echo date('M j, Y g:i A', strtotime($post['created_At'])); ?></span>
                </div>

                <div class="post-content">
                    <?php echo htmlspecialchars($post['content']); ?>
                </div>

                <?php if (!empty($post['tag_name'])): ?>
                    <div class="post-tags">
                        <?php foreach ($this->Post_model->get_post_tags($post['post_id']) as $tag): ?>
                            <span class="tag"><?= $tag['category'] ?></span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="post-footer">
                    <span class="reaction-count"><?php echo $post['reaction_count']; ?> likes</span>

                    <!-- Add delete button - only show if user owns the post -->
                    <?php if ($post['user_id'] == $this->session->userdata('user_id')): ?>
                        <button class="delete-post-btn" onclick="confirmDelete(<?php echo $post['post_id']; ?>)">
                            Delete
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="no-posts">
            <p>No posts found.</p>
        </div>
    <?php endif; ?>
</div>

<script>
    function confirmDelete(postId) {
        if (confirm('Are you sure you want to delete this post? This action cannot be undone.')) {
            // User confirmed, proceed with deletion
            deletePost(postId);
        }
    }

    function deletePost(postId) {
        // AJAX request to delete the post
        fetch('<?php echo site_url("post/delete"); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'post_id=' + postId
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove the post from the DOM
                    document.querySelector(`.post-card[data-post-id="${postId}"]`).remove();

                    // Optional: Show success message
                    alert('Post deleted successfully');
                } else {
                    alert('Error deleting post: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error.message);
                alert('An error occurred while deleting the post');
            });
    }

    const maxTags = 3;
    if (selectedTags.length >= maxTags) {
        document.getElementById('tag-dropdown').disabled = true;
        document.getElementById('tag-limit-message').style.display = 'block';
    } else {
        document.getElementById('tag-dropdown').disabled = false;
        document.getElementById('tag-limit-message').style.display = 'none';
    }
</script>

<style>
    .posts-container {
        max-width: 600px;
        margin: 20px auto;
    }

    .post-card {
        background: #fff;
        border-radius: 8px;
        padding: 20px;
        /* Increased padding */
        margin-bottom: 20px;
        /* Increased margin */
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        min-height: 180px;
        /* Minimum height for each post */
        display: flex;
        flex-direction: column;
    }

    .post-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 14px;
    }

    .post-username {
        font-weight: bold;
    }

    .post-time {
        color: #666;
    }

    .post-content {
        margin-bottom: 15px;
        /* Increased margin */
        line-height: 1.5;
        /* Improved line height */
        flex-grow: 1;
        /* Takes available space */
        word-wrap: break-word;
        /* Ensures long words break */
        overflow-wrap: break-word;
        /* Alternative for better support */
    }

    .tag-bubble {
        display: inline-block;
        background: #f0f2f5;
        padding: 3px 10px;
        border-radius: 15px;
        font-size: 12px;
        color: #1d9bf0;
    }

    .post-footer {
        border-top: 1px solid #eee;
        padding-top: 8px;
        font-size: 13px;
        color: #666;
    }

    .no-posts {
        text-align: center;
        padding: 40px;
        color: #666;
    }

    .delete-post-btn {
        background: #ff4444;
        color: white;
        border: none;
        padding: 3px 10px;
        border-radius: 4px;
        font-size: 12px;
        cursor: pointer;
        margin-left: 10px;
    }

    .delete-post-btn:hover {
        background: #cc0000;
    }

    .post-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #eee;
        padding-top: 8px;
        font-size: 13px;
        color: #666;
    }
</style>