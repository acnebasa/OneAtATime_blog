<div class="explore-container">
    <?php if (!empty($posts)): ?>
        <?php foreach ($posts as $post): ?>
            <div class="post-card" data-post-id="<?php echo $post['post_id']; ?>">
                <!-- Profile Picture Container -->
                <div class="profile-container">
                    <img src="<?php echo base_url('assets/images/default-profile.jpg'); ?>" alt="Profile" class="profile-pic">
                </div>
                
                <!-- Content Container -->
                <div class="content-container">
                    <!-- Username and Date -->
                    <div class="post-header">
                        <span class="post-username"><?php echo $post['user_name']; ?></span>
                        <span class="post-date"><?php echo date('M j, Y g:i A', strtotime($post['created_At'])); ?></span>
                    </div>
                    
                    <!-- Post Content -->
                    <div class="post-content">
                        <?php echo htmlspecialchars($post['content']); ?>
                    </div>
                    
                    <!-- Footer with Like Button and Tag -->
                    <div class="post-footer">
                        <div class="like-section">
                            <button class="like-button">
                                <i class="far fa-heart"></i> Like
                            </button>
                            <span class="like-count"><?php echo $post['reaction_count']; ?></span>
                        </div>
                        
                        <?php if (!empty($post['tag_name'])): ?>
                            <span class="post-tag"><?php echo $post['tag_name']; ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="no-posts">
            <p>No posts to explore yet.</p>
        </div>
    <?php endif; ?>
</div>

<div class="posts-container">
    <?php if (!empty($posts)): ?>
        <?php foreach ($posts as $post): ?>
            <div class="post-card">
                <div class="post-header">
                    <span class="post-username"><?php echo htmlspecialchars($post['username']); ?></span>
                    <span class="post-time"><?php echo date('M j, Y g:i A', strtotime($post['created_At'])); ?></span>
                </div>

                <div class="post-content">
                    <?php echo nl2br(htmlspecialchars($post['content'])); ?>
                </div>

                <?php if (!empty($post['tag_name'])): ?>
                    <div class="post-tag">
                        <span class="tag-bubble"><?php echo htmlspecialchars($post['tag_name']); ?></span>
                    </div>
                <?php endif; ?>

                <div class="post-footer">
                    <span class="reaction-count"><?php echo (int) $post['reaction_count']; ?> likes</span>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="no-posts">
            <p>No public posts to explore at the moment.</p>
        </div>
    <?php endif; ?>
</div>

<style>
    .content {
        text-align: center;
        padding: 30px 15px 10px;
        background-color: #f9f9f9;
        border-bottom: 1px solid #eee;
    }

    .content h1 {
        font-size: 28px;
        margin-bottom: 10px;
        color: #222;
    }

    .content p {
        font-size: 16px;
        color: #666;
    }

    .posts-container {
        max-width: 600px;
        margin: 20px auto;
        padding: 0 15px;
    }

    .post-card {
        background: #fff;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .post-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 14px;
    }

    .post-username {
        font-weight: bold;
        color: #333;
    }

    .post-time {
        color: #888;
        font-size: 13px;
    }

    .post-content {
        margin-bottom: 10px;
        line-height: 1.4;
        color: #444;
    }

    .post-tag {
        margin-bottom: 10px;
    }

    .tag-bubble {
        display: inline-block;
        background: #eaf4ff;
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 13px;
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
        color: #999;
    }
</style>
