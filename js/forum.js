// Forum-specific Interactions
class ForumManager {
    constructor() {
        this.init();
    }

    init() {
        this.setupTopicPreview();
        this.setupQuickReply();
        this.setupPostActions();
        this.setupNotifications();
        this.setupMessageEditor();
        this.setupPollCreation();
        this.setupInfiniteScroll();
        this.setupImageLightbox();
    }

    // Topic Preview on Hover
    setupTopicPreview() {
        const topicLinks = document.querySelectorAll('.topic-link');
        let previewTimeout;

        topicLinks.forEach(link => {
            link.addEventListener('mouseenter', async (e) => {
                const topicId = link.getAttribute('data-topic-id');
                if (!topicId) return;

                previewTimeout = setTimeout(async () => {
                    try {
                        const preview = await this.fetchTopicPreview(topicId);
                        this.showPreviewPopup(e, preview);
                    } catch (error) {
                        console.error('Error loading topic preview:', error);
                    }
                }, 500);
            });

            link.addEventListener('mouseleave', () => {
                clearTimeout(previewTimeout);
                this.hidePreviewPopup();
            });
        });
    }

    // Quick Reply Functionality
    setupQuickReply() {
        const quickReplyForm = document.querySelector('.quick-reply-form');
        if (!quickReplyForm) return;

        quickReplyForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(quickReplyForm);
            
            try {
                await this.submitQuickReply(formData);
                this.refreshTopicPosts();
                quickReplyForm.reset();
            } catch (error) {
                console.error('Error submitting quick reply:', error);
                this.showError('Failed to submit reply. Please try again.');
            }
        });
    }

    // Post Actions (Quote, Edit, Delete)
    setupPostActions() {
        document.addEventListener('click', async (e) => {
            const action = e.target.closest('[data-post-action]');
            if (!action) return;

            const postId = action.getAttribute('data-post-id');
            const actionType = action.getAttribute('data-post-action');

            switch (actionType) {
                case 'quote':
                    await this.handleQuoteAction(postId);
                    break;
                case 'edit':
                    await this.handleEditAction(postId);
                    break;
                case 'delete':
                    await this.handleDeleteAction(postId);
                    break;
            }
        });
    }

    // Real-time Notifications
    setupNotifications() {
        if (!window.WebSocket) return;

        const ws = new WebSocket(this.getWebSocketURL());

        ws.addEventListener('message', (event) => {
            const notification = JSON.parse(event.data);
            this.showNotification(notification);
        });

        ws.addEventListener('close', () => {
            setTimeout(() => this.setupNotifications(), 5000);
        });
    }

    // Rich Text Editor Integration
    setupMessageEditor() {
        const editors = document.querySelectorAll('.message-editor');
        
        editors.forEach(editor => {
            this.initializeRichTextEditor(editor);
        });
    }

    // Poll Creation Interface
    setupPollCreation() {
        const pollToggle = document.querySelector('.poll-toggle');
        const pollForm = document.querySelector('.poll-form');
        
        if (!pollToggle || !pollForm) return;

        pollToggle.addEventListener('click', () => {
            pollForm.classList.toggle('show');
        });

        this.setupPollOptionsDynamicAdd();
    }

    // Infinite Scroll for Topics/Posts
    setupInfiniteScroll() {
        const contentContainer = document.querySelector('.forum-content');
        if (!contentContainer) return;

        const observer = new IntersectionObserver(
            (entries) => {
                const lastEntry = entries[0];
                if (lastEntry.isIntersecting) {
                    this.loadMoreContent();
                }
            },
            { threshold: 0.5 }
        );

        const sentinel = document.createElement('div');
        sentinel.className = 'scroll-sentinel';
        contentContainer.appendChild(sentinel);
        observer.observe(sentinel);
    }

    // Image Lightbox
    setupImageLightbox() {
        const images = document.querySelectorAll('.message-content img:not(.emoji)');
        
        images.forEach(image => {
            image.addEventListener('click', () => {
                this.showImageLightbox(image.src);
            });
        });
    }

    // Utility Methods

    async fetchTopicPreview(topicId) {
        const response = await fetch(`/api/topic-preview/${topicId}`);
        if (!response.ok) throw new Error('Failed to fetch topic preview');
        return await response.json();
    }

    showPreviewPopup(event, preview) {
        const popup = document.createElement('div');
        popup.className = 'topic-preview-popup';
        popup.innerHTML = `
            <h4>${preview.title}</h4>
            <p>${preview.excerpt}</p>
            <div class="preview-meta">
                <span>${preview.replies} replies</span>
                <span>${preview.views} views</span>
            </div>
        `;

        document.body.appendChild(popup);

        const rect = event.target.getBoundingClientRect();
        popup.style.top = `${rect.bottom + 10}px`;
        popup.style.left = `${rect.left}px`;
    }

    hidePreviewPopup() {
        document.querySelector('.topic-preview-popup')?.remove();
    }

    async submitQuickReply(formData) {
        const response = await fetch('/api/quick-reply', {
            method: 'POST',
            body: formData
        });

        if (!response.ok) throw new Error('Failed to submit reply');
        return await response.json();
    }

    async refreshTopicPosts() {
        const topicId = document.querySelector('[data-topic-id]')?.getAttribute('data-topic-id');
        if (!topicId) return;

        const response = await fetch(`/api/topic/${topicId}/posts`);
        const posts = await response.json();
        this.updatePostsList(posts);
    }

    showError(message) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.textContent = message;
        document.body.appendChild(errorDiv);

        setTimeout(() => errorDiv.remove(), 5000);
    }

    async handleQuoteAction(postId) {
        const post = await this.fetchPost(postId);
        const editor = document.querySelector('.message-editor');
        if (editor) {
            editor.value += `[quote author="${post.author}" post="${postId}"]${post.content}[/quote]\n`;
        }
    }

    async handleEditAction(postId) {
        const post = await this.fetchPost(postId);
        const editor = document.querySelector('.message-editor');
        if (editor) {
            editor.value = post.content;
            editor.setAttribute('data-editing-post', postId);
        }
    }

    async handleDeleteAction(postId) {
        if (confirm('Are you sure you want to delete this post?')) {
            try {
                await fetch(`/api/post/${postId}`, { method: 'DELETE' });
                document.querySelector(`[data-post-id="${postId}"]`)?.remove();
            } catch (error) {
                this.showError('Failed to delete post');
            }
        }
    }

    getWebSocketURL() {
        const protocol = location.protocol === 'https:' ? 'wss:' : 'ws:';
        return `${protocol}//${location.host}/ws/notifications`;
    }

    showNotification(notification) {
        const notif = document.createElement('div');
        notif.className = 'notification';
        notif.innerHTML = `
            <div class="notification-title">${notification.title}</div>
            <div class="notification-message">${notification.message}</div>
        `;

        document.body.appendChild(notif);
        setTimeout(() => notif.remove(), 5000);
    }

    initializeRichTextEditor(editor) {
        // Initialize your preferred rich text editor here
        // This is a placeholder for the actual implementation
    }

    setupPollOptionsDynamicAdd() {
        const addOptionBtn = document.querySelector('.add-poll-option');
        const optionsContainer = document.querySelector('.poll-options');
        
        if (!addOptionBtn || !optionsContainer) return;

        addOptionBtn.addEventListener('click', () => {
            const newOption = document.createElement('div');
            newOption.className = 'poll-option';
            newOption.innerHTML = `
                <input type="text" name="poll_option[]" placeholder="Enter option">
                <button type="button" class="remove-option">Remove</button>
            `;
            optionsContainer.appendChild(newOption);
        });

        optionsContainer.addEventListener('click', (e) => {
            if (e.target.matches('.remove-option')) {
                e.target.closest('.poll-option').remove();
            }
        });
    }

    async loadMoreContent() {
        const lastItem = document.querySelector('.forum-item:last-child');
        if (!lastItem) return;

        const lastId = lastItem.getAttribute('data-id');
        try {
            const response = await fetch(`/api/load-more?after=${lastId}`);
            const newItems = await response.json();
            this.appendNewItems(newItems);
        } catch (error) {
            console.error('Error loading more content:', error);
        }
    }

    appendNewItems(items) {
        const container = document.querySelector('.forum-content');
        items.forEach(item => {
            const itemElement = this.createItemElement(item);
            container.insertBefore(itemElement, container.lastElementChild);
        });
    }

    createItemElement(item) {
        const div = document.createElement('div');
        div.className = 'forum-item';
        div.setAttribute('data-id', item.id);
        div.innerHTML = `
            <h3>${item.title}</h3>
            <div class="item-meta">
                <span>${item.author}</span>
                <span>${item.date}</span>
            </div>
        `;
        return div;
    }

    showImageLightbox(src) {
        const lightbox = document.createElement('div');
        lightbox.className = 'lightbox';
        lightbox.innerHTML = `
            <div class="lightbox-content">
                <img src="${src}" alt="Lightbox Image">
                <button class="lightbox-close">&times;</button>
            </div>
        `;

        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox || e.target.matches('.lightbox-close')) {
                lightbox.remove();
            }
        });

        document.body.appendChild(lightbox);
    }
}

// Initialize Forum Manager
document.addEventListener('DOMContentLoaded', () => {
    window.forumManager = new ForumManager();
});
