$("document").ready(function () {
    $(".data-table").DataTable({
        saveState: true,
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        columnDefs: [
            {
                targets: "datatable-nosort",
                orderable: false,
            },
        ],
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "الجميع"],
        ],
        language: {
            emptyTable: "لا توجد بيانات لكي يتم عرضها",
            info: "عرض _START_ الي _END_ من _TOTAL_ صفوف",
            infoEmpty: "عرض 0 الي 0 من 0 صفوف",
            infoFiltered: "(تمت تصفيته من إجمالي _MAX_ من الصفوف)",
            zeroRecords: "لا توجد بيانات متطابقة",
            infoPostFix: "",
            thousands: ",",
            lengthMenu: "عرض _MENU_ صفوف",
            loadingRecords: "جارى التحميل...",
            searchPlaceholder: "",
						search: "ابحث من هنا",
            paginate: {
                next: '<i class="ion-chevron-left"></i>',
                previous: '<i class="ion-chevron-right"></i>',
            },
        },
        buttons: [
            {
                extend: "searchBuilder",
                config: {
                    depthLimit: 2,
                },
            },
        ],
    });
});
