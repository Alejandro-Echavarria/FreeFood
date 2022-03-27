/* The above code is creating a toast message that will display a warning message for 9 seconds. */
const Toast = Swal.mixin({
    toast: true,
    position: 'bottom-end',
    iconColor: 'rgb(61, 61, 61)',
    showConfirmButton: false,
    timer: 9000,
    timerProgressBar: true,
    customClass: {
        popup: 'colored-toast'
      },
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });

Toast.fire({
    icon: 'warning',
    title: 'Este form no es funcional, solo preciona el botón ingresar'
  });