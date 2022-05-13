function confirm_aksi(no,text,Title='Peringatan!'){
    $(document).ready(function(){
        const laman = $('#klik_'+no).data("url");
    
    swal({
        title: Title,
        text: text,
        icon: "warning",
        buttons: [
          'No, cancel it!',
          'Yes, I am sure!'
        ],
        dangerMode: true,
      }).then(function(isConfirm) {
        if (isConfirm) {
         // alert(0);\
         window.location.href=laman;
        } else {
          swal("Cancelled", "dibatalkan", "error");
        }
      })
    })

}

function confirm_submit(nama_form,text,Title='Peringatan!'){
  $(document).ready(function(){
      // const laman = $('#klik_'+no).data("url");
  $(nama_form).on("click",function(){
    swal({
      title: Title,
      text: text,
      icon: "warning",
      buttons: [
        'No, cancel it!',
        'Yes, I am sure!'
      ],
      dangerMode: true,
    }).then(function(isConfirm) {
      if (isConfirm) {
       // alert(0);\
       alert('ass');
       $(nama_form).submit();
      } else {
        swal("Cancelled", "dibatalkan", "error");
      }
    })
  })
  });
  

}



