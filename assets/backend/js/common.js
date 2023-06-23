$(function () {
    'use strict';
    $(document).on('click','.delete-data',function(e) {
        e.preventDefault();
        let target = $(this).attr('data-id');
       Swal.fire({
          title: 'Are you sure?',
          text: "You won't to delete this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $('#'+target).submit();
          }
        })
    });
})
