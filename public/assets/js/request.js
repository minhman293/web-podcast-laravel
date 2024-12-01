function getCookieByName({ name }) {
    // return (`; ${document.cookie}`).split(`; ${name}=`).pop()
    const _ =   (`; ${document.cookie}`).split(`; ${name}=`)
    return _.length === 2 ? _.pop() : ''
}

function createHeaderRequest() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    return {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        "Authorization": `Bearer ${getCookieByName({ name: 'token' })}`,
        'X-CSRF-TOKEN': csrfToken
    }
}