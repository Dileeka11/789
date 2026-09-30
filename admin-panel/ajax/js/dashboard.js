$("document").ready(function () {
  $(document).on("change", "#year", function (event) {
    let year = $("#year").val();
    let batch = $("#batch").val();
    if (year != "" && batch != "") {
      //start preloarder
    //   $(".someBlock").preloader();
      $.ajax({
        url: "ajax/php/dashboard.php",
        type: "POST",
        data: {
          year,
          batch,
          action: "COURSE_SUMMARY",
        },
        dataType: "json",
        success: function (result) {
          $("#requests").text(result.requests);
          $("#applications").text(result.applications);
          $("#students").text(result.students);
          $("#dropout_students").text(result.dropout_students);
          $("#enrolled_courses").text(result.enrolled_courses);

          //remove preloarder

        //   $(".someBlock").preloader("remove");
        },
      });
    }
  });
  $(document).on("change", "#batch", function (event) {
    let year = $("#year").val();
    let batch = $("#batch").val();
    if (year != "" && batch != "") {
      //start preloarder
    //   $(".someBlock").preloader();
      $.ajax({
        url: "ajax/php/dashboard.php",
        type: "POST",
        data: {
          year,
          batch,
          action: "COURSE_SUMMARY",
        },
        dataType: "json",
        success: function (result) {
          $("#requests").text(result.requests);
          $("#applications").text(result.applications);
          $("#students").text(result.students);
          $("#dropout_students").text(result.dropout_students);
          $("#enrolled_courses").text(result.enrolled_courses);

          //remove preloarder

        //   $(".someBlock").preloader("remove");
        },
      });
    }
  });
});
