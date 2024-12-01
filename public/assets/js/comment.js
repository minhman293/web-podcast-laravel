document.getElementById('comment_form').addEventListener('submit', async function (e) {
    e.preventDefault();
    const payload = {
        sender_id: Number(e.target.getAttribute('data-user-id')),
        receiver_id: Number(e.target.getAttribute('data-podcaster-id')),
        podcast_id: Number(window.location.href.split('/').pop()),
        content: `${e.target.getAttribute('data-user-name')} commented on your podcast!`,
        is_seen: false,
        type: 'COMMENT'
    }

    sendMessage(payload);
    await saveNotification(payload)
    e.target.submit();
})
