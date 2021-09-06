const flashDataSuccess = document.getElementById('flash-data-success').getAttribute('data-flashdata');

if (flashDataSuccess){
    Swal.fire({
        icon: 'success',
        title: 'Sukses',
        text: flashDataSuccess,
        confirmButtonColor: '#191c1f',
    }); 
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