import swal from 'sweetalert2'
window.Swal = swal

export function success_message(message){
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: toast => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    Toast.fire({
        icon: 'success',
        title: message
    })
}

export function error_message(errors){
    let list = []
    $.each(errors, function (key, value) {
        list.push(value)
    })
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: list[0],
        showConfirmButton: false,
        timer: 1500
    })
}
