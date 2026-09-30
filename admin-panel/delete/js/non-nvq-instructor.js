$(document).ready(function () {
  $(document).on("click", ".delete-non-nvq", function () {
    var id = $(this).attr("data-id");

    swal(
      {
        title: "Are you sure?",
        text: "You will not be able to recover this record!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false,
      },
      function () {
        $.ajax({
          url: "delete/php/non-nvq-instructor.php",
          type: "POST",
          data: { id: id, option: "delete" },
          dataType: "JSON",
          success: function (jsonStr) {
            if (jsonStr.status) {
              swal({
                title: "Deleted!",
                text: "Record has been deleted.",
                type: "success",
                timer: 2000,
                showConfirmButton: false,
              });
              $("#row-" + id).remove();
              window.location.reload();
            }
          },
        });
      }
    );
  });
});
