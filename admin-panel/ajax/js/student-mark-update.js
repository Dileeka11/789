$("document").ready(function () {
    
    
  $("#create").click(function (event) {
        event.preventDefault();

        //-- ** Start Error Messages
        if (!$("#mcq_mark").val() || $("#mcq_mark").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter mcq mark.",
                type: "error",
                timer: 4000,
                showConfirmButton: false,
            });
        } else if (!$("#practical_mark").val() || $("#practical_mark").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter practical mark.",
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
                url: "ajax/php/student-mark-update.php",
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
    
    
    
  $("#update").click(function (event) {
    event.preventDefault();
    
    
    //-- ** Start Error Messages
    if (
      !$("#practical_mark").val() ||
      $("#practical_mark").val().length === 0
    ) {
      swal({
        title: "Error!",
        text: "Please enter practical marks.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else {
      //start preloarder
      $(".someBlock").preloader();
      //grab all form data

      var formData = new FormData($("#form-data")[0]); //grab all form data

      $.ajax({
        url: "ajax/php/student-mark-update.php",
        type: "POST",
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (result) {
          //remove preloarder

          window.setTimeout(function () {
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
              }, 4000);
            } else if (result.status === "error") {
              swal({
                title: "Error!",
                text: "Something went wrong",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
              });
            }
          }, 2000);
        },
      });
    }
    return false;
  });
  
  
  $("#update1").click(function (event) {
    event.preventDefault();
    //-- ** Start Error Messages
    
    
    if (
       
      $("#practical_mark").val().length === 0
    ) {
      swal({
        title: "Error!",
        text: "Please enter atleast one test mark.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else {
        
      //start preloarder
      $(".someBlock").preloader();
      //grab all form data

      var formData = new FormData($("#form-data")[0]); //grab all form data

      $.ajax({
        url: "ajax/php/student-mark-update.php",
        type: "POST",
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (result) {
          //remove preloarder

          window.setTimeout(function () {
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
              }, 4000);
            } else if (result.status === "error") {
              swal({
                title: "Error!",
                text: "Something went wrong",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
              });
            }
          }, 2000);
        },
      });
    }
    return false;
  });
  //---------- End Create Data ---------
});
