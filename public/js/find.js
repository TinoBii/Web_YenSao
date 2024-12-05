$(document).ready(function() {
    $("#s").on('input', function() {
        var text_input = $(this).val();
        var data = {text_input: text_input };
        console.log(data);
        if(text_input!=" "){
        $.ajax({
            url: '?mod=home&action=search',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function(data) {
                console.log(data.list_search);
                let dataSearch = '';
               
                data.list_search.forEach(element => {
                   
                    let dataItem = `
                        <li class="clearfix">
                            <a href="?mod=product&action=detail_product&product_id=${element['product_id']}.html" class="thumb-search fl-left">
                                <img style="height: 100% !important;" src="admin/public/images/${element['img']}">
                            </a>
                            <div class="info fl-right">
                                <a href="?mod=product&action=detail_product&product_id=${element['product_id']}.html" class="product-name">${element['title']}</a>
                                <span class="price">${element['price']}đ</span>
                                <a href="mua-ngay/hai-san-${element['product_id']}.htm" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                    `;
                    dataSearch += dataItem;
                   
                });
                $("ul.list-search").html(dataSearch);
            },
            // error: function(xhr, ajaxOptions, thrownError) {
            //     alert(xhr.status);
            //     alert(thrownError);
            // }
        })
        }
    })
})
