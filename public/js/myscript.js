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



// function number format
function numberFormatThousands(basicSalary) {
    let val = basicSalary.value;
    val = val.replace(/[^0-9\.]/g, '');

    if (val != "") {
        valArr = val.split('.');
        valArr[0] = (parseInt(valArr[0], 10)).toLocaleString();
        val = valArr.join('.');
    }

    basicSalary.value = val;
}

function getAlertWarning(message) {
    Swal.fire({
        icon: 'warning',
        title: 'Opps..',
        text: message,
        confirmButtonColor: '#191c1f',
    });
}

// data table
$(document).ready( function () {
    $('#table-employees').DataTable();
} );

// function handleDeletePosition(event, id){
//     event.preventDefault();

//     const formDeletePosition = document.getElementById('form-delete-position-'+id);

//     Swal.fire({
//         title: 'Are you sure?',
//         text: "You won't be able to revert this!",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes, delete it!'
//       }).then((result) => {
//         if (result.isConfirmed) {
//             window.location = formDeletePosition.action
//         }
//       })
// }

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