<div class="posts-container">
    <?php if (!empty($posts)): ?>
        <?php foreach ($posts as $post): ?>
            <div class="post-card">
                <div class="post-header">
                    <span class="post-username"><?php echo $username; ?></span>
                    <span class="post-time"><?php echo date('M j, Y g:i A', strtotime($post['created_At'])); ?></span>
                </div>
                
                <div class="post-content">
                    <?php echo htmlspecialchars($post['content']); ?>
                </div>
                
                <?php if (!empty($post['tag_name'])): ?>
                    <div class="post-tag">
                        <span class="tag-bubble"><?php echo $post['tag_name']; ?></span>
                    </div>
                <?php endif; ?>
                
                <div class="post-footer">
                    <span class="reaction-count"><?php echo $post['reaction_count']; ?> likes</span>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="no-posts">
            <p>No posts found.</p>
        </div>
    <?php endif; ?>
</div>

<style>
    .posts-container {
        max-width: 600px;
        margin: 20px auto;
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
    }
    
    .post-time {
        color: #666;
    }
    
    .post-content {
        margin-bottom: 10px;
        line-height: 1.4;
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
</style>