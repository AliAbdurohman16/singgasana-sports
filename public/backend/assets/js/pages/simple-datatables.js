// Define separate instances for table1
let dataTable1 = new simpleDatatables.DataTable(
    document.getElementById("table1")
);

// Function to move "per page dropdown" selector element out of label
// to make it work with Bootstrap 5. Add bs5 classes.
function adaptPageDropdown(dataTable1) {
    const selector = dataTable1.wrapper.querySelector(".dataTable-selector");
    selector.parentNode.parentNode.insertBefore(selector, selector.parentNode);
    selector.classList.add("form-select");
}

// Function to add bs5 classes to pagination elements
function adaptPagination(dataTable1) {
    const paginations = dataTable1.wrapper.querySelectorAll(
      "ul.dataTable-pagination-list"
    );

    for (const pagination of paginations) {
      pagination.classList.add(...["pagination", "pagination-primary"]);
    }

    const paginationLis = dataTable1.wrapper.querySelectorAll(
      "ul.dataTable-pagination-list li"
    );

    for (const paginationLi of paginationLis) {
      paginationLi.classList.add("page-item");
    }

    const paginationLinks = dataTable1.wrapper.querySelectorAll(
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


// Define separate instances for table2
let dataTable2 = new simpleDatatables.DataTable(
    document.getElementById("table2")
);

// Function to move "per page dropdown" selector element out of label
// to make it work with Bootstrap 5. Add bs5 classes.
function adaptPageDropdown(dataTable2) {
    const selector = dataTable2.wrapper.querySelector(".dataTable-selector");
    selector.parentNode.parentNode.insertBefore(selector, selector.parentNode);
    selector.classList.add("form-select");
}

// Function to add bs5 classes to pagination elements
function adaptPagination(dataTable2) {
    const paginations = dataTable2.wrapper.querySelectorAll(
      "ul.dataTable-pagination-list"
    );

    for (const pagination of paginations) {
      pagination.classList.add(...["pagination", "pagination-primary"]);
    }

    const paginationLis = dataTable2.wrapper.querySelectorAll(
      "ul.dataTable-pagination-list li"
    );

    for (const paginationLi of paginationLis) {
      paginationLi.classList.add("page-item");
    }

    const paginationLinks = dataTable2.wrapper.querySelectorAll(
      "ul.dataTable-pagination-list li a"
    );

    for (const paginationLink of paginationLinks) {
      paginationLink.classList.add("page-link");
    }
}

// Patch "per page dropdown" and pagination after table2 rendered
dataTable2.on("datatable.init", function () {
    adaptPageDropdown(dataTable2);
    adaptPagination(dataTable2);
});

// Re-patch pagination after the page was changed for table2
dataTable2.on("datatable.page", function () {
    adaptPagination(dataTable2);
});

// Define separate instances for table2
let dataTable3 = new simpleDatatables.DataTable(
    document.getElementById("table3")
);

// Function to move "per page dropdown" selector element out of label
// to make it work with Bootstrap 5. Add bs5 classes.
function adaptPageDropdown(dataTable3) {
    const selector = dataTable3.wrapper.querySelector(".dataTable-selector");
    selector.parentNode.parentNode.insertBefore(selector, selector.parentNode);
    selector.classList.add("form-select");
}

// Function to add bs5 classes to pagination elements
function adaptPagination(dataTable3) {
    const paginations = dataTable3.wrapper.querySelectorAll(
      "ul.dataTable-pagination-list"
    );

    for (const pagination of paginations) {
      pagination.classList.add(...["pagination", "pagination-primary"]);
    }

    const paginationLis = dataTable3.wrapper.querySelectorAll(
      "ul.dataTable-pagination-list li"
    );

    for (const paginationLi of paginationLis) {
      paginationLi.classList.add("page-item");
    }

    const paginationLinks = dataTable3.wrapper.querySelectorAll(
      "ul.dataTable-pagination-list li a"
    );

    for (const paginationLink of paginationLinks) {
      paginationLink.classList.add("page-link");
    }
}

// Patch "per page dropdown" and pagination after table3 rendered
dataTable3.on("datatable.init", function () {
    adaptPageDropdown(dataTable3);
    adaptPagination(dataTable3);
});

// Re-patch pagination after the page was changed for table3
dataTable3.on("datatable.page", function () {
    adaptPagination(dataTable3);
});
