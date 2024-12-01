async function getLastPodCastByPodcasterId({ podcasterId }) {
    try {
        const response = await fetch(`/api/podcast/${podcasterId}/last`, {
            method: 'GET',
            headers: createHeaderRequest(),
        })
        return await response.json()
    } catch (err) {
        console.log(err)
    }
}

// socket.onmessage = async function (e) {
//     const data = JSON.parse(e.data)
//     // const lastPodcast = await getLastPodCastByPodcasterId({ podcasterId: data.sender_id });
//     console.log({ data })
//     // createNotification({ ...data, podcast_id: lastPodcast.id });
//     createNotification(data);
// };


document.getElementById('podcast_create_form').addEventListener('submit', async function (e) {
    e.preventDefault();
    const senderId = document.querySelector('meta[name="user-id"]').getAttribute('content');
    const senderName = document.querySelector('meta[name="user-name"]').getAttribute('content');

    if(!senderId) return;

    const payload = {
        sender_id: Number(senderId),
        receiver_id: null,
        podcast_id: null,
        content: `${senderName} just posted a new podcast!`,
        is_seen: false,
        type: 'POST_NEW_PODCAST'
    }

    await saveNotification(payload)
    sendMessage(payload);
    // e.target.submit();
})
