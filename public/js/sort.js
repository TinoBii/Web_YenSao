$(document).ready(function() {
    $("#order_by").on('change', function() {
        var selectedOption = $(this).val(); // Lấy giá trị được chọn từ phần tử <select>
        var data = { order_by: selectedOption }; // Tạo đối tượng dữ liệu để gửi đi
        
        // Kiểm tra xem giá trị đã được chọn có rỗng không
        if(selectedOption.trim() !== "") {
            $.ajax({
                url: '?mod=product&action=sort',
                method: 'POST',
                data: data,
                dataType: 'html',
                success: function(data) {
                    console.log(data.list_search);
                    $("ul.list-search").html(data.list_search); // Cập nhật danh sách sản phẩm
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        }
    });
});