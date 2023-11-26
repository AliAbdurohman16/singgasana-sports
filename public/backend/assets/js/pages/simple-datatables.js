// Define separate instances for table1 and table2
let dataTable1 = new simpleDatatables.DataTable(
    document.getElementById("table1")
  );

  let dataTable2 = new simpleDatatables.DataTable(
    document.getElementById("table2")
  );

  // Function to move "per page dropdown" selector element out of label
  // to make it work with Bootstrap 5. Add bs5 classes.
  function adaptPageDropdown(dataTable) {
    const selector = dataTable.wrapper.querySelector(".dataTable-selector");
    selector.parentNode.parentNode.insertBefore(selector, selector.parentNode);
    selector.classList.add("form-select");
  }

  // Function to add bs5 classes to pagination elements
  function adaptPagination(dataTable) {
    const paginations = dataTable.wrapper.querySelectorAll(
      "ul.dataTable-pagination-list"
    );

    for (const pagination of paginations) {
      pagination.classList.add(...["pagination", "pagination-primary"]);
    }

    const paginationLis = dataTable.wrapper.querySelectorAll(
      "ul.dataTable-pagination-list li"
    );

    for (const paginationLi of paginationLis) {
      paginationLi.classList.add("page-item");
    }

    const paginationLinks = dataTable.wrapper.querySelectorAll(
      "ul.dataTable-pagination-list li a"
    );

    for (const paginationLink of paginationLinks) {
      paginationLink.classList.add("page-link");
    }
  }

  // Patch "per page dropdown" and pagination after table1 rendered
  dataTable1.on("datatable.init", function () {
    adaptPageDropdown(dataTable1);
    adaptPagination(dataTable1);
  });

  // Re-patch pagination after the page was changed for table1
  dataTable1.on("datatable.page", function () {
    adaptPagination(dataTable1);
  });

  // Patch "per page dropdown" and pagination after table2 rendered
  dataTable2.on("datatable.init", function () {
    adaptPageDropdown(dataTable2);
    adaptPagination(dataTable2);
  });

  // Re-patch pagination after the page was changed for table2
  dataTable2.on("datatable.page", function () {
    adaptPagination(dataTable2);
  });
