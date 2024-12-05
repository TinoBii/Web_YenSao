$(document).ready(function() {
    // Load tất cả các cấp khi trang được tải
    loadCap(1);
    loadCap(2);
    loadCap(3);
    loadCap(4);

    // Lắng nghe sự kiện thay đổi cho các cấp
    $('select[id^="cap"]').on('change', function() {
        var selected_value = $(this).val();
        var selected_id = $(this).attr('id').replace('cap', '');

        // Tìm cấp cha của cấp hiện tại
        if (selected_value) {
            loadParent(selected_id, selected_value);
        } else {
            // Xóa các cấp bên dưới khi không chọn gì
            for (var i = selected_id; i <= 4; i++) {
                $('#cap' + i).empty().append('<option value="">--Chọn Cấp ' + i + '--</option>');
            }
        }
    });
});

// Hàm load các cấp
function loadCap(cap, danhmuc_id_cha = null) {
    $.ajax({
        url: '?mod=product&controllers=index&action=ajax_get_cap',
        method: 'GET',
        dataType: "json",
        data: {
            cap: cap,
            danhmuc_id_cha: danhmuc_id_cha // Sử dụng danhmuc_id_cha
        },
        success: function(data) {
            var select_id = '#cap' + cap;
            $(select_id).empty().append('<option value="">--Chọn Cấp ' + cap + '--</option>');
            $.each(data, function(i, item) {
                $(select_id).append($('<option>', {
                    value: item.id,
                    text: item.name
                }));
            });
        },
        error: function(xhr, textStatus, errorThrown) {
            console.log('Error: ' + errorThrown);
        }
    });
}

// Hàm load cấp cha khi người dùng chọn
function loadParent(selected_id, selected_value) {
    var danhmuc_id_cha = selected_value;
    // Tải các cấp trên của cấp đã chọn
    for (var i = selected_id - 1; i >= 1; i--) {
        loadCap(i, danhmuc_id_cha); // Sử dụng danhmuc_id_cha thay vì parent_id
        danhmuc_id_cha = selected_value;
    }
}