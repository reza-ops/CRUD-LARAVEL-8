"use strict";
// Class definition

var global = function() {
    var basic_datatbale = function(id, url, column){
        var datatable = $(id).dataTable({
            processing: true,
            serverSide: true,
            pageSize: 10,
            language: {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
                paginate: {
                    next: '<span><i class="fa fa-angle-right" aria-hidden="true"></i></span>',
                    previous: '<span><i class="fa fa-angle-left" aria-hidden="true"></i></span>'
                }
            },
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            ajax: url,
            columns :column
        });

        $(id).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var el = this;
            var route = $(this).attr("data-route");
            Swal.fire({
                title: "Apakah yakin hapus datass ini ?",
                text: "Lanjutkan untuk menghapus",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: route,
                        type: 'GET', // replaced from put
                        dataType: "JSON",
                        beforeSend: function () {
                            $.blockUI();
                        },
                        success: function (response) {
                            if (response.status == true) {
                                $(id).DataTable().ajax.reload();
                                swal.fire("Deleted!", response.message, "success");
                            } else {
                                swal.fire("Failed!", response.message, "error");
                            }
                            $.unblockUI();
                        },
                        error: function (xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                };
            });
        });
    };

    return {
        init_datatable: function (id, url, column) {
            basic_datatbale(id, url, column);
        },
    }
}();
