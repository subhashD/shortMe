window.alertSuccess = (message) => {
  return Swal.fire({
    title: 'Success!',
    text: message,
    // type: 'success',
    confirmButtonText: 'Ok'
  });
}

window.alertError = (message) => {
  Swal.fire({
    title: 'Error!',
    text: message,
    // type: 'error',
    confirmButtonText: 'Ok'
  });
}

window.alertWarning = (message) => {
  Swal.fire({
    // title: 'Error!',
    text: message,
    // type: 'warning',
    confirmButtonText: 'Ok'
  });
}

window.alertConfirm = (message) => {
  return Swal.fire({
    // title: 'Are you sure?',
    text: message,
    // type: 'warning',
    showCancelButton: true,
    // confirmButtonColor: '#3085d6',
    // cancelButtonColor: '#d33',
    confirmButtonText: 'Yes'
  })

}