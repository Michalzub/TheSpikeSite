import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

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
