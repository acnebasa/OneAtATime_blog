<div class="main-content-container">
    <!-- Left Container (70%) -->
    <div class="left-container">
        <div class="post-text-container">
            <textarea class="post-textarea" placeholder="Write your day..." rows="2"></textarea>
        </div>
        <div class="post-controls">
            <button class="tags-button">+ Tags</button>
            <button class="post-button">Post</button>
        </div>
    </div>

    <!-- Right Container (30%) -->
    <div class="right-container">
        <div class="date-greeting">
            <h3><?= date('g:i A') ?></h3>
            <p>Hello, <?= $username ?? 'User' ?>!</p>
        </div>
    </div>
</div>

<style>
    .main-content-container {
        display: flex;
        max-width: 500px;
        margin: 8px auto;
        margin-bottom: 100px;
        gap: 12px;
    }

    .left-container {
        flex: 7;
        background: #fff;
        border-radius: 12px;
        padding: 10px;
        border: 1px solid #e0e0e0;
    }

    .right-container {
        flex: 3;
        background: #f8f9fa;
        border-radius: 12px;
        padding: 10px;
        font-size: 0.9em;
    }

    .post-textarea {
        width: 100%;
        min-height: 60px;
        border: none;
        font-size: 14px;
        resize: none;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        /* Remove outline completely */
        outline: none;
        /* Optional: Add custom focus style if desired */
        /* border: 1px solid #1d9bf0; */
    }

    .post-controls {
        display: flex;
        justify-content: space-between;
        padding-top: 6px;
        margin-top: 4px;
        border-top: 1px solid #eee;
    }

    .tags-button {
        background: transparent;
        border: 1px solid #ddd;
        padding: 3px 10px;
        border-radius: 12px;
        font-size: 12px;
    }

    .post-button {
        background: #1d9bf0;
        color: white;
        border: none;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 13px;
    }

    .date-greeting h3 {
        color: #536471;
        font-size: 13px;
        margin-bottom: 3px;
    }

    .date-greeting p {
        color: #0f1419;
        font-size: 13px;
        margin: 2px 0;
    }
</style>