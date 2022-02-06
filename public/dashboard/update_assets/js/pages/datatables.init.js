!(function () {
  $(document).ready(function () {
    $(".cc-datatable").DataTable({
      buttons: ["copy", "excel", "pdf", "colvis"],
      language: {
       
        paginate: {
          next: '<i class="icon-right-arrow"></i>',
          previous: '<i class="icon-left-arrow"></i>',
        },
        searchPlaceholder: "Search",
        search: '<i class="fas fa-search"></i>',
      },
    });

    $(".dataTable").wrap('<div class="table-responsive"><div>');
  });
})();
