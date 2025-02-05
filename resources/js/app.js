import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

function toggleReplyForm(commentId) {
    var replyForm = document.getElementById('reply-form-' + commentId);
    var replyButton = document.getElementById('reply-btn-' + commentId);

    console.log('Toggling reply form for comment:', commentId);
    console.log('Reply form element:', replyForm);
    console.log('Reply button element:', replyButton);

    if (!replyForm || !replyButton) {
        console.error('Reply form or button not found!');
        return;
    }

    if (replyForm.style.display === 'none' || replyForm.style.display === '') {
        replyForm.style.display = 'block';
        replyButton.style.display = 'none';
    } else {
        replyForm.style.display = 'none';
        replyButton.style.display = 'inline-block';
    }
}

function attachReplyButtonListeners() {
    const replyButtons = document.querySelectorAll('.reply-btn');
    console.log('Found reply buttons:', replyButtons);

    replyButtons.forEach(button => {
        console.log('Attaching listener to button:', button);
        button.addEventListener('click', function () {
            // Extract the commentId from the button's id
            const commentId = this.id.replace('reply-btn-', '');
            console.log('Reply button clicked for comment:', commentId);
            toggleReplyForm(commentId);
        });
    });
}

function attachCloseButtonListeners() {
    const closeButtons = document.querySelectorAll('.close-btn');
    closeButtons.forEach(button => {
        button.addEventListener('click', function () {
            const commentId = this.id.split('-').pop();
            toggleReplyForm(commentId);
        });
    });
}

function attachLoadRepliesButtonListeners() {
    const loadRepliesButtons = document.querySelectorAll('.load-replies-btn');
    loadRepliesButtons.forEach(button => {
        button.addEventListener('click', function () {
            const commentId = this.id.split('-').pop();
            loadReplies(commentId);
        });
    });
}

document.addEventListener('DOMContentLoaded', function () {
    attachReplyButtonListeners();
    attachCloseButtonListeners();
    attachLoadRepliesButtonListeners();
});

document.addEventListener('DOMContentLoaded', function () {
    const commentsContainer = document.getElementById('comments-list');

    if (commentsContainer) {
        commentsContainer.addEventListener('click', function (event) {
            if (event.target.classList.contains('reply-btn')) {
                const commentId = event.target.id.split('-').pop();
                toggleReplyForm(commentId);
            }

            if (event.target.classList.contains('close-btn')) {
                const commentId = event.target.id.split('-').pop();
                toggleReplyForm(commentId);
            }

            if (event.target.classList.contains('load-replies-btn')) {
                const commentId = event.target.id.split('-').pop();
                loadReplies(commentId);
            }
        });
    }
});

function loadReplies(commentId) {
    var repliesContainer = document.getElementById('replies-container-' + commentId);
    var loadRepliesButton = document.getElementById('load-replies-btn-' + commentId);

    if (repliesContainer.style.display === 'block') {
        return;
    }

    repliesContainer.style.display = 'block';
    if (loadRepliesButton) loadRepliesButton.style.display = 'none';

    fetch(`/comments/${commentId}/load-replies`)
        .then(response => response.json())
        .then(data => {
            data.replies.forEach(reply => {
                const replyDiv = document.createElement('div');
                replyDiv.classList.add('comment-box');
                replyDiv.style.marginLeft = '20px';

                const authorElement = document.createElement('strong');
                authorElement.textContent = reply.author.name;

                const textElement = document.createElement('p');
                textElement.textContent = reply.text;

                const postedDate = document.createElement('small');
                postedDate.textContent = `Posted on ${new Date(reply.created_at).toLocaleString()}`;

                const replyButton = document.createElement('button');
                replyButton.classList.add('reply-btn');
                replyButton.textContent = 'Reply';
                replyButton.id = `reply-btn-${reply.id}`;

                const replyFormDiv = document.createElement('div');
                replyFormDiv.classList.add('reply-form');
                replyFormDiv.style.display = 'none';
                replyFormDiv.id = `reply-form-${reply.id}`;

                const closeButton = document.createElement('button');
                closeButton.type = 'button';
                closeButton.classList.add('close-btn');
                closeButton.textContent = 'X';
                closeButton.id = `close-btn-${reply.id}`;

                const form = document.createElement('form');
                form.action = `/comments/store`;
                form.method = 'POST';

                const input = document.createElement('textarea');
                input.name = 'text';
                input.rows = '3';
                input.placeholder = 'Write your reply...';
                input.required = true;

                const submitButton = document.createElement('button');
                submitButton.type = 'submit';
                submitButton.textContent = 'Reply';

                form.appendChild(input);
                form.appendChild(submitButton);
                replyFormDiv.appendChild(closeButton);
                replyFormDiv.appendChild(form);

                replyDiv.appendChild(authorElement);
                replyDiv.appendChild(textElement);
                replyDiv.appendChild(postedDate);
                replyDiv.appendChild(replyButton);
                replyDiv.appendChild(replyFormDiv);

                repliesContainer.appendChild(replyDiv);
            });
        })
        .catch(error => {
            console.error('Error loading replies:', error);
        });
}


document.addEventListener('DOMContentLoaded', () => {
    document.body.addEventListener('click', (event) => {
        const button = event.target.closest('.vote-button');
        if (!button) return;

        const postId = button.dataset.postId;
        const postType = button.dataset.postType;
        const voteType = button.dataset.voteType;

        fetch('/vote', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                post_id: postId,
                post_type: postType,
                vote_type: voteType
            })
        })
            .then(response => {
                if (response.redirected) {
                    if (response.url.includes('/login')) {
                        window.location.href = '/login';
                        throw new Error('Redirected to login page');
                    }
                }
                if (!response.ok) {
                    if (response.status === 401) {
                        window.location.href = '/login';
                    } else {
                        throw new Error('Could not process the vote');
                    }
                }
                return response.json();
            })
            .then(data => {
                const netVotesElement = document.getElementById(`net-votes-${postId}`);
                if (netVotesElement) {
                    netVotesElement.textContent = data.netVotes;
                }
            })
            .catch(error => {
                console.error('Error processing vote:', error);
            });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const commentForm = document.getElementById('comment-form');

    if (commentForm) {
        commentForm.addEventListener('submit', function (event) {
            event.preventDefault();

            const formData = new FormData(commentForm);

            fetch(commentForm.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: formData
            })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => { throw err; });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        commentForm.querySelector('textarea').value = '';

                        const commentsContainer = document.getElementById('comments-list');
                        const newComment = createCommentElement(data.comment);
                        commentsContainer.insertBefore(newComment, commentsContainer.firstChild);

                        attachCommentEventListeners(data.comment.id);
                    } else {
                        alert('Error posting comment');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    if (error.errors) {
                        alert(`Validation Error: ${Object.values(error.errors).join(', ')}`);
                    } else {
                        alert('An unexpected error occurred.');
                    }
                });
        });
    }
});

// Function to create a comment element
function createCommentElement(comment) {
    const commentDiv = document.createElement('div');
    commentDiv.classList.add('comment-box');
    commentDiv.id = `comment-${comment.id}`;

    // Author name
    const authorElement = document.createElement('strong');
    authorElement.textContent = comment.author.name;

    // Comment text
    const textElement = document.createElement('p');
    textElement.textContent = comment.text;

    // Posted date
    const postedDate = document.createElement('small');
    postedDate.textContent = `Posted on ${new Date(comment.created_at).toLocaleString()}`;

    // Reply button
    const replyButton = document.createElement('button');
    replyButton.classList.add('reply-btn');
    replyButton.textContent = 'Reply';
    replyButton.id = `reply-btn-${comment.id}`;

    // Reply form (initially hidden)
    const replyFormDiv = document.createElement('div');
    replyFormDiv.classList.add('reply-form');
    replyFormDiv.style.display = 'none';
    replyFormDiv.id = `reply-form-${comment.id}`;

    const closeButton = document.createElement('button');
    closeButton.type = 'button';
    closeButton.classList.add('close-btn');
    closeButton.textContent = 'X';
    closeButton.id = `close-btn-${comment.id}`;

    const replyForm = document.createElement('form');
    replyForm.action = `/comments/store`;
    replyForm.method = 'POST';

    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = document.querySelector('meta[name="csrf-token"]').content;

    const parentIdInput = document.createElement('input');
    parentIdInput.type = 'hidden';
    parentIdInput.name = 'parent_id';
    parentIdInput.value = comment.id;

    const textarea = document.createElement('textarea');
    textarea.name = 'text';
    textarea.rows = '3';
    textarea.placeholder = 'Write your reply...';
    textarea.required = true;

    const submitButton = document.createElement('button');
    submitButton.type = 'submit';
    submitButton.textContent = 'Reply';

    replyForm.appendChild(csrfInput);
    replyForm.appendChild(parentIdInput);
    replyForm.appendChild(textarea);
    replyForm.appendChild(submitButton);
    replyFormDiv.appendChild(closeButton);
    replyFormDiv.appendChild(replyForm);

    // Load replies button (conditionally rendered)
    if (comment.children && comment.children.length > 0) {
        const loadRepliesButton = document.createElement('button');
        loadRepliesButton.classList.add('load-replies-btn');
        loadRepliesButton.textContent = 'Load Replies';
        loadRepliesButton.id = `load-replies-btn-${comment.id}`;
        commentDiv.appendChild(loadRepliesButton);
    }

    // Replies container (initially hidden)
    const repliesContainer = document.createElement('div');
    repliesContainer.id = `replies-container-${comment.id}`;
    repliesContainer.classList.add('replies-container');
    repliesContainer.style.display = 'none';

    // Append all elements to the comment div
    commentDiv.appendChild(authorElement);
    commentDiv.appendChild(textElement);
    commentDiv.appendChild(postedDate);
    commentDiv.appendChild(replyButton);
    commentDiv.appendChild(replyFormDiv);
    commentDiv.appendChild(repliesContainer);

    return commentDiv;
}

// Function to attach event listeners to a comment
function attachCommentEventListeners(commentId) {
    const replyButton = document.getElementById(`reply-btn-${commentId}`);
    const closeButton = document.getElementById(`close-btn-${commentId}`);
    const loadRepliesButton = document.getElementById(`load-replies-btn-${commentId}`);

    if (replyButton) {
        replyButton.addEventListener('click', function () {
            toggleReplyForm(commentId);
        });
    }

    if (closeButton) {
        closeButton.addEventListener('click', function () {
            toggleReplyForm(commentId);
        });
    }

    if (loadRepliesButton) {
        loadRepliesButton.addEventListener('click', function () {
            loadReplies(commentId);
        });
    }
}
