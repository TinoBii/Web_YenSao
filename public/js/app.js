$(document).ready(function () {
    $(".num-order").change(function () {
        var data_id = $(this).attr('data_id');
        var num_order = $(this).val();
        var data = { data_id: data_id, num_order: num_order};
        console.log(data);
        $.ajax({
            url:'?mod=cart&action=update_sl',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function(data) {
                $(".sub-total-"+data_id).text(data.sub_total);
                $("#total").text(data.total);
                $("#Provisional").text(data.total);
                $("#total_cart").text(data.total);
                $("#btn-cart span#num").text(data.num_order);
                $("#num").text(data.num_order);
                $("span#qty-"+data_id).text(data.qty);
            },
            error: function (xhr, ajaxOptions, throwError) {
                alert(xhr.status);
                alert(throwError);
                alert(data);
            }
        });
    })
});
