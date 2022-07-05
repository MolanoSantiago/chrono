const notificarBtn = document.querySelector('#notificar');

notificarBtn.addEventListener('click', () => {
    Notification.requestPermission().then(resultado => {
        console.log('Respuesta: ', resultado);
    })
})

const verNotificacion = document.querySelector('#vernotificacion');