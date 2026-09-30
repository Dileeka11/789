$(document).ready(function () {
  //get course by course type
  $("#type").change(function () {
    var type = $(this).val();

    if (type == "1") {
      $("#position_bar").removeClass("hidden");
      $("#send_divisions").addClass("hidden");
      $("#copy_divisions").addClass("hidden");
    } else if (type == "2") {
      $("#send_divisions").removeClass("hidden");
      $("#copy_divisions").removeClass("hidden");
      $("#position_bar").addClass("hidden");
    } else {
      $("#position_bar").removeClass("hidden");
      $("#send_divisions").removeClass("hidden");
      $("#copy_divisions").removeClass("hidden");
    }
  });

  //create doc
  $("#create").click(function (event) {
    event.preventDefault();
    // tinymce.triggerSave();
    //-- ** Start Error Messages
    if (!$("#type").val() || $("#type").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select letter type.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#title").val() || $("#title").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select document title.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#minit").val() || $("#minit").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please enter your minit.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (
      ($("#type").val() == 1 || $("#type").val() == 3) &&
      $("#position").val() == ""
    ) {
      swal({
        title: "Error!",
        text: "Please select position.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (
      ($("#type").val() == 2 || $("#type").val() == 3) &&
      $("#other_divisions").val().length === 0
    ) {
      swal({
        title: "Error!",
        text: "Please select at least one division.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#document").val() || $("#document").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select document.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else {
      //start preloarder
      $(".someBlock").preloader();
      //grab all form data

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
          $(".someBlock").preloader("remove");
          if (result.status === "success") {
            swal({
              title: "success!",
              text: "Your data saved successfully !",
              type: "success",
              timer: 2000,
              showConfirmButton: false,
            });
            window.setTimeout(function () {
              window.location.reload();
            }, 2000);
          } else if (result.status === "error") {
            swal({
              title: "Error!",
              text: "Something went wrong",
              type: "error",
              timer: 2000,
              showConfirmButton: false,
            });
          }
        },
      });
    }
    return false;
  });

  $(document).on("click", ".approve-document", function (e) {
    var id = $(this).attr("data-id");

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
        swal(
          {
            title: "Enter Minit!",
            text: "<textarea id='text' rows='5'></textarea>",
            // --------------^-- define html element with id
            html: true,
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "Write Minit",
          },
          function (inputValue) {
            if (inputValue === false) {
              swal.showInputError("You need to write a minit!");
              return false;
            }
            if (inputValue === "") {
              swal.showInputError("You need to write a minit!");
              return false;
            }
            // get value using textarea id
            var val = $("#text").val();
            if (val === "") {
              swal.showInputError("You need to write a minit!");
              return false;
            }
            $.ajax({
              url: "ajax/php/submit-document.php",
              type: "POST",
              data: {
                id,
                val,
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
    );
  });

  $(document).on("click", ".open-modal", function (e) {
    let id = $(this).attr("data-id");
    $("#doc_id").val(id);
  });
  $(document).on("click", "#re-apply-document", function (e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    if (!$("#document_name").val() || $("#document_name").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select document.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#minit").val() || $("#minit").val().length === 0) {
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
          let id = $("#doc_id").val();
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
        swal(
          {
            title: "Enter Minit!",
            text: "<textarea id='text' rows='5'></textarea>",
            // --------------^-- define html element with id
            html: true,
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "Write Minit",
          },
          function (inputValue) {
            if (inputValue === false) {
              swal.showInputError("You need to write a minit!");
              return false;
            }
            if (inputValue === "") {
              swal.showInputError("You need to write a minit!");
              return false;
            }
            // get value using textarea id
            var val = $("#text").val();
            if (val === "") {
              swal.showInputError("You need to write a minit!");
              return false;
            }
            $.ajax({
              url: "ajax/php/submit-document.php",
              type: "POST",
              data: {
                id,
                val,
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
    );
  });
  $(document).on("click", ".return-document", function (e) {
    var id = $(this).attr("data-id");

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
        swal(
          {
            title: "Enter Minit!",
            text: "<textarea id='text' rows='5'></textarea>",
            // --------------^-- define html element with id
            html: true,
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "Write Minit",
          },
          function (inputValue) {
            if (inputValue === false) {
              swal.showInputError("You need to write a minit!");
              return false;
            }
            if (inputValue === "") {
              swal.showInputError("You need to write a minit!");
              return false;
            }
            // get value using textarea id
            var val = $("#text").val();
            if (val === "") {
              swal.showInputError("You need to write a minit!");
              return false;
            }
            $.ajax({
              url: "ajax/php/submit-document.php",
              type: "POST",
              data: {
                id,
                val,
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
    );
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
