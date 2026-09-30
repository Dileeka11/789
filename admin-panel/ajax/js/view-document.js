$(document).ready(function () {
  $(document).on("click", ".approve-document", function (e) {
    var id = $(this).attr("data-id");
    tinymce.triggerSave();
    let minit = $("#minit").val();
    if (!$("#minit").val() || $("#minit").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please enter minit.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else {
      swal(
        {
          title: "Are you sure?",
          text: "Do you want to approve this document!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, approve it!",
          closeOnConfirm: false,
        },
        function () {
          $.ajax({
            url: "ajax/php/submit-document.php",
            type: "POST",
            data: {
              id,
              val: minit,
              option: "APPROVE",
            },
            dataType: "JSON",
            success: function (jsonStr) {
              if (jsonStr.status) {
                swal({
                  title: "Approved!",
                  text: "Document has been approved.",
                  type: "success",
                  timer: 2000,
                  showConfirmButton: false,
                });

                $("#div" + id).remove();
                window.setTimeout(function () {
                  window.location.reload();
                }, 2000);
              }
            },
          });
        }
      );
    }
  });
  $(document).on("click", ".re-apply-document", function (e) {
    e.preventDefault();
    tinymce.triggerSave();
    var id = $(this).attr("data-id");
    if (!$("#minit").val() || $("#minit").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please enter minit.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (
      !$("#document_name").val() ||
      $("#document_name").val().length === 0
    ) {
      swal({
        title: "Error!",
        text: "Please select document.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else {
      swal(
        {
          title: "Are you sure?",
          text: "Do you want to re apply this document!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, re apply it!",
          closeOnConfirm: false,
        },
        function () {
          let file_name = $("#document_name").val();
          let minit = $("#minit").val();
          $.ajax({
            url: "ajax/php/submit-document.php",
            type: "POST",
            data: {
              file_name,
              minit,
              id,
              option: "REAPPLY",
            },
            dataType: "JSON",
            success: function (jsonStr) {
              if (jsonStr.status) {
                swal({
                  title: "Re Applied!",
                  text: "Document has been re applied.",
                  type: "success",
                  timer: 2000,
                  showConfirmButton: false,
                });
                window.setTimeout(function () {
                  window.location.reload();
                }, 2000);
              }
            },
          });
        }
      );
    }
  });
  $(document).on("click", ".accept-document", function (e) {
    var id = $(this).attr("data-id");

    tinymce.triggerSave();
    let minit = $("#minit").val();
    if (!$("#minit").val() || $("#minit").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please enter minit.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else {
      swal(
        {
          title: "Are you sure?",
          text: "Do you want to accept this document!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, accept it!",
          closeOnConfirm: false,
        },
        function () {
          $.ajax({
            url: "ajax/php/submit-document.php",
            type: "POST",
            data: {
              id,
              val: minit,
              option: "ACCEPT",
            },
            dataType: "JSON",
            success: function (jsonStr) {
              if (jsonStr.status) {
                swal({
                  title: "Accepted!",
                  text: "Document has been accepted.",
                  type: "success",
                  timer: 2000,
                  showConfirmButton: false,
                });

                $("#div" + id).remove();
                window.setTimeout(function () {
                  window.location.reload();
                }, 2000);
              }
            },
          });
        }
      );
    }
  });
  $(document).on("click", ".return-document", function (e) {
    var id = $(this).attr("data-id");
    tinymce.triggerSave();
    let minit = $("#minit").val();
    if (!$("#minit").val() || $("#minit").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please enter minit.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else {
      swal(
        {
          title: "Are you sure?",
          text: "Do you want to return this document!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, return it!",
          closeOnConfirm: false,
        },
        function () {
          $.ajax({
            url: "ajax/php/submit-document.php",
            type: "POST",
            data: {
              id,
              val: minit,
              option: "RETURN",
            },
            dataType: "JSON",
            success: function (jsonStr) {
              if (jsonStr.status) {
                swal({
                  title: "Returned!",
                  text: "Document has been returned.",
                  type: "success",
                  timer: 2000,
                  showConfirmButton: false,
                });

                $("#div" + id).remove();
                window.setTimeout(function () {
                  window.location.reload();
                }, 2000);
              }
            },
          });
        }
      );
    }
  });
  $(document).on("change", "#file", function (e) {
    var formData = new FormData($("#form-data")[0]); //grab all form data

    $.ajax({
      url: "ajax/php/submit-document.php",
      type: "POST",
      data: formData,
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "JSON",
      success: function (result) {
        //remove preloarder
        // $('.someBlock').preloader('remove');
        if (result.file_name != "") {
          $("#document_name").val(result.file_name);
        } else if (result.status === "error") {
          swal({
            title: "Error!",
            text: "Something went wrong",
            type: "error",
            timer: 2000,
            showConfirmButton: false,
          });
          window.setTimeout(function () {
            window.location.reload();
          }, 2000);
        }
      },
    });
  });
});
