import DataTable from "datatables.net";
import "datatables.net-bs5";
import "datatables.net-responsive-bs5";

// Import Bootstrap JS
import "bootstrap";

// Import Bootstrap SCSS
import "bootstrap/scss/bootstrap.scss";

jQuery(document).ready(function ($) {
  function formreach_typeOrder(formreach_data, formreach_type, formreach_row) {
    if (formreach_type === "sort") {
      if ($(formreach_data).hasClass("fa-whatsapp")) {
        return 1;
      } else if ($(formreach_data).hasClass("fa-envelope")) {
        return 2;
      }
      return parseInt(formreach_data);
    }
    return formreach_data;
  }

  if (window.innerWidth >= 768) {
    $("#formreach_form_history_table").DataTable({
      order: [[0, "desc"]],
      columnDefs: [
        { width: "70px", targets: 0 }, // ID
        { width: "100px", targets: 1, render: formreach_typeOrder }, // Type
        { width: "200px", targets: 3 }, // Date
        { width: "80px", targets: 4, orderable: false }, // Delete
      ],
    });
  } else {
    $("#formreach_form_history_table").DataTable({
      responsive: true,
      order: [[0, "desc"]],
      columnDefs: [
        { responsivePriority: 1, targets: 3 }, // Date
        { responsivePriority: 2, targets: 4, orderable: false },
        { targets: 1, render: formreach_typeOrder }, // Type
      ],
    });
  }
});
