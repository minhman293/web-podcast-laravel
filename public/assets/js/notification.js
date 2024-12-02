// const token = getCookieByName({ name: 'token' })
const userId = document.querySelector('meta[name="user-id"]').getAttribute('content');
const WS_CLIENT = document.querySelector('meta[name="ws-client"]').getAttribute('content');
const socket = new WebSocket(`${WS_CLIENT}?user_id=${userId}`);

function createNotification(data) {
    const list = document.getElementById('__notification_list')
    list.innerHTML = `<li><a href="/podcast/redirect/${data.podcast_id}">${data.content}</a></li>` + list.innerHTML
    document.querySelectorAll('.notification_counts').forEach(element => {
        element.innerText = Number(element.innerText) + 1
        element.classList.remove('hide')
    });

}

socket.onmessage = function (e) {
    createNotification(JSON.parse(e.data));
};

async function readNewNotifications() {
    try {
        document.querySelectorAll('.notification_counts').forEach(item => {
            item.innerText = 0
            item.classList.add('hide')
        })
        const response = await fetch(`/api/notifications`, {
            method: 'GET',
            headers: createHeaderRequest(),
        });
        const data = await response.json();
        console.log({ data })
    } catch (err) {
        console.log(err)
    }
}

document.querySelectorAll('.notification_label').forEach(item => {
    item.addEventListener('mouseover', readNewNotifications)
})


function sendMessage(msg) {
    socket.send(JSON.stringify(msg));
}

async function saveNotification(data) {
    try { 
        const response = await fetch('/api/notifications', {
            method: 'POST',
            headers: createHeaderRequest(),
            body: JSON.stringify({ ...data })
        })
        const _data = await response.json()
        console.log(_data)
    } catch (err) {
        console.log(err)
    }
}
