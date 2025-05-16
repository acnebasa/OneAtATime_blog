<div class="posts-container">
    <?php if (!empty($posts)): ?>
        <?php foreach ($posts as $post): ?>
            <div class="post-card" data-post-id="<?= $post['post_id'] ?>">
                <!-- Profile section -->
                <div class="post-profile">
                    <img src="<?= base_url('assets/images/default-profile.jpg') ?>" alt="Profile" class="profile-pic">
                    <div>
                        <span class="post-username"><?= htmlspecialchars($post['user_name']) ?></span>
                        <span class="post-time"><?= date('M j, Y g:i A', strtotime($post['created_At'])) ?></span>
                    </div>
                </div>

                <!-- Post content -->
                <div class="post-content">
                    <?= nl2br(htmlspecialchars($post['content'])) ?>
                </div>

                <!-- Tags section -->
                <?php $post_tags = $this->Post_model->get_post_tags($post['post_id']); ?>
                <?php if (!empty($post_tags)): ?>
                    <div class="post-tags">
                        <?php foreach ($post_tags as $tag): ?>
                            <span class="tag" data-tag="<?= strtolower(htmlspecialchars($tag['category'])) ?>">
                                <?= htmlspecialchars($tag['category']) ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Post footer -->
                <div class="post-footer">
                    <div class="like-section">
                        <button class="like-button" data-post-id="<?= $post['post_id'] ?>">
                            <i class="far fa-heart"></i>
                            <span class="like-text">Like</span>
                        </button>
                        <span class="like-count"><?= (int) $post['reaction_count'] ?></span>
                    </div>

                    <?php if ($this->session->userdata('user_id') == $post['user_id']): ?>
                        <button class="delete-post-btn" onclick="confirmDelete(<?= $post['post_id'] ?>)">
                            Delete
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="no-posts">
            <p>No posts to display at the moment.</p>
        </div>
    <?php endif; ?>
</div>

<style>
    .posts-container {
        max-width: 600px;
        margin: 20px auto;
        padding: 0 15px;
    }

    .post-card {
        background: #fff;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .post-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .post-profile {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
    }

    .profile-pic {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 12px;
        border: 2px solid #f0f0f0;
    }

    .post-username {
        font-weight: 600;
        color: #333;
        display: block;
    }

    .post-time {
        font-size: 13px;
        color: #888;
    }

    .post-content {
        margin-bottom: 15px;
        line-height: 1.5;
        color: #333;
        font-size: 15px;
    }

    .post-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 15px;
    }

    .tag {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 16px;
        font-size: 12px;
        font-weight: 500;
        background-color: #f0f5ff;
        color: #3a7bd5;
        transition: all 0.2s ease;
    }

    .tag:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .post-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #f0f0f0;
        padding-top: 12px;
    }

    .like-section {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .like-button {
        background: none;
        border: none;
        color: #666;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 4px;
        padding: 4px 8px;
        border-radius: 4px;
        transition: all 0.2s ease;
    }

    .like-button:hover {
        background: #f8f8f8;
        color: #e74c3c;
    }

    .like-button.liked {
        color: #e74c3c;
    }

    .like-count {
        font-size: 13px;
        color: #666;
    }

    .delete-post-btn {
        background: #ffebee;
        color: #d32f2f;
        border: none;
        padding: 4px 12px;
        border-radius: 4px;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .delete-post-btn:hover {
        background: #ffcdd2;
    }

    .no-posts {
        text-align: center;
        padding: 40px;
        color: #999;
        font-size: 16px;
    }

    /* Specific tag colors */
    .tag[data-tag="travel"] {
        background-color: #e3f2fd;
        color: #1976d2;
    }

    .tag[data-tag="food"] {
        background-color: #e8f5e9;
        color: #388e3c;
    }

    .tag[data-tag="technology"] {
        background-color: #f3e5f5;
        color: #8e24aa;
    }

    .tag[data-tag="books"] {
        background-color: #fff3e0;
        color: #f57c00;
    }

    .tag[data-tag="fitness"] {
        background-color: #e0f7fa;
        color: #00acc1;
    }

    .tag[data-tag="life"] {
        background-color: #fce4ec;
        color: #c2185b;
    }

    .tag[data-tag="inspiration"] {
        background-color: #fff8e1;
        color: #ff8f00;
    }

    .tag[data-tag="humor"] {
        background-color: #f1f8e9;
        color: #689f38;
    }
</style>

<script>
    // Like button functionality
    document.querySelectorAll('.like-button').forEach(button => {
        button.addEventListener('click', async function () {
            const postId = this.dataset.postId;
            const icon = this.querySelector('i');
            const likeText = this.querySelector('.like-text');
            const likeCount = this.closest('.like-section').querySelector('.like-count');

            try {
                const response = await fetch('<?= site_url("post/like") ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: `post_id=${postId}&<?= $this->security->get_csrf_token_name() ?>=<?= $this->security->get_csrf_hash() ?>`
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || 'Unknown error');
                }

                if (data.success) {
                    likeCount.textContent = data.new_count;
                    this.classList.toggle('liked');
                    likeText.textContent = data.action === 'liked' ? 'Liked' : 'Like';
                    icon.className = data.action === 'liked' ? 'fas fa-heart' : 'far fa-heart';
                }
            } catch (error) {
                console.error('Like error:', error);
                alert('Error: ' + error.message);
            }
        });
    });
</script>