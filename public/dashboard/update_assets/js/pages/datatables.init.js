!(function () {
  $(document).ready(function () {
    $(".cc-datatable").DataTable({
    language: {
        paginate: {
          next: '<i class="icon-right-arrow"></i>',
          previous: '<i class="icon-left-arrow"></i>',
        },
      },
    });
    $(".dataTable").wrap('<div class="table-responsive"><div>');
  });
})();
