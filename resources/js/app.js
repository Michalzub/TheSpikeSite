    import './bootstrap';

    /*--------------------------*/
    /*--COMMENT POST AJAX-------*/
    /*--------------------------*/

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
                            if (response.status === 401) {
                                window.location.href = '/login';
                            } else {
                                throw new Error('Could not process the favorite');
                            }
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            commentForm.querySelector('textarea').value = '';

                            const commentsContainer = document.getElementById('comments-list');
                            const newComment = createCommentElement(data.comment);
                            commentsContainer.insertBefore(newComment, commentsContainer.firstChild);
                        } else {
                            alert('Error posting comment');
                        }
                    })
                    .catch(error => {
                        console.error('Error processing comment:', error);
                    });
            });
        }
    });

    function createCommentElement(comment) {
        const commentDiv = document.createElement('div');
        commentDiv.classList.add('comment-box');
        commentDiv.id = `comment-${comment.id}`;

        const authorElement = document.createElement('strong');
        authorElement.textContent = comment.author.name;

        const textElement = document.createElement('p');
        textElement.textContent = comment.text;

        const postedDate = document.createElement('small');
        postedDate.textContent = `Posted on ${new Date(comment.created_at).toLocaleString()}`;

        const form = document.createElement('form');
        form.action = `/comments/${comment.id}`;
        form.method = 'POST';
        form.classList.add('delete-comment-form');

        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = csrfToken;
        form.appendChild(csrfInput);

        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);

        const button = document.createElement('button');
        button.type = 'submit';
        button.classList.add('submit-btn');
        button.textContent = 'Delete';

        form.appendChild(button);


        commentDiv.appendChild(authorElement);
        commentDiv.appendChild(textElement);
        commentDiv.appendChild(postedDate);
        commentDiv.appendChild(form)

        return commentDiv;
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-comment-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                if (!confirm('Are you sure you want to delete this comment?')) {
                    e.preventDefault();
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-discussion-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                if (!confirm('Are you sure you want to delete this discussion?')) {
                    e.preventDefault();
                }
            });
        });
    });

    /* =========================== */
    /*     AJAX FOR VOTING         */
    /* =========================== */

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


    /* =========================== */
    /*     AJAX FOR FAVOURITING    */
    /* =========================== */

    document.addEventListener('DOMContentLoaded', function() {
        var favoriteButton = document.getElementById('favorite-btn');

        if (favoriteButton) {
            favoriteButton.addEventListener('click', function(event) {
                var uuid = event.target.getAttribute('data-uuid');
                var type = event.target.getAttribute('data-type');
                var button = event.target;

                fetch('/favorite/' + uuid + '/' + type, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        uuid: uuid,
                        type: type,
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
                                throw new Error('Could not process the favorite');
                            }
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.message === 'Added to favorites') {
                            button.innerText = 'Unfavorite';
                        } else {
                            button.innerText = 'Favorite';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        }
    });
