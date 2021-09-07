const flashDataSuccess = document.getElementById('flash-data-success');

if (flashDataSuccess){
    if (flashDataSuccess.getAttribute('data-flashdata')){
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: flashDataSuccess.getAttribute('data-flashdata'),
            confirmButtonColor: '#191c1f',
        }); 
    }
}

const flashDataError = document.getElementById('flash-data-error');

if (flashDataError){
    if (flashDataError.getAttribute('data-flashdata')){
        Swal.fire({
            icon: 'error',
            title: 'Opps..',
            text: flashDataError.getAttribute('data-flashdata'),
            confirmButtonColor: '#191c1f',
        }); 
    }
}

// function handleButtonDelete(){

//     Swal.fire({
//         title: 'Yakin',
//         text: "Data ingin dihapus?",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#363636',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes'
//       }).then((result) => {
//         if (result.isConfirmed) {
          
//         }
//       })
// }