<?php
get_header();
?>

<div id="page-body" class="d-flex">
    <?php get_sidebar()?>
    <div id="wp-content">
        <div id="content" class="container-fluid">
            <div class="card">
                <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                    <h5 class="m-0">Danh sách Liên hệ</h5>
                    <div class="form-search form-inline">
                        <form action="#">
                            <input type="text" id="Search" class="form-control form-search" placeholder="Tìm kiếm">
                            <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                        </form>
                    </div>
                </div>
                <div>
                    <a href="?mod=contact&action=list_contact_garbage" class="text-primary">Thùng rác<span class="text-muted">(<?php echo get_total_contact_rac()?>)</span></a>
                </div>
                <div class="row justify-content-between align-items-center">
                    <div style="text-align:end" class="col-sm-12 ">
                        <a href="?mod=contact&action=add_contact">
                            <button style="margin: 10px 10px 0 0;" type="submit" class="btn btn-success">
                                <i style="color:#fff" class="plus-icon fas fa-plus-circle"></i> Thêm mới
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-checkall text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Họ Tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Nội dung</th>
                                <th scope="col">Nghề nghiệp</th>
                                <th scope="col">Kiểu</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stt = 0;
                            if (!empty($list_contact)) {  
                                foreach (array_reverse($list_contact) as $item) {
                            ?>
                            <tr>
                                <td scope="row"><?php echo ++$stt; ?></td>
                                <td><?php echo $item['fullname']; ?></td>
                                <td><?php echo $item['email']; ?></td>
                                <td><?php echo $item['phone_number']; ?></td>
                                <td>
                                    <?php if (!empty($item['img'])): ?>
                                        <img width="120px" height="120px" src="public/images/<?php echo $item['img']; ?>" alt="Hình ảnh">
                                    <?php else: ?>
                                        Không có ảnh
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $item['content']; ?></td>
                                <td><?php echo $item['job']; ?></td>
                                <td><?php echo ($item['kieu'] == 1) ? 'Liên hệ' : 'Phản hồi khách hàng'; ?></td>
                                <td>                           
                                    <?php $action=$_GET['action'] ; 
                                        if($action=='list_contact'){
                                    ?>
                                    <a href="?mod=contact&action=edit_contact&lienhe_id=<?php echo $item['lienhe_id']?>"><button class="btn btn-success btn-sm rounded-0 m-2" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button></a>
                                    <a href="?mod=contact&action=trash_can&lienhe_id=<?php echo $item['lienhe_id']?>"><button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></a>
                                    <?php }
                                    else if($action=='list_contact_garbage'){
                                    ?>
                                    <a href="?mod=contact&action=restore_contact&lienhe_id=<?php echo $item['lienhe_id']?>"><button class="btn btn-success btn-sm rounded-0 m-2" type="button" data-toggle="tooltip" data-placement="top" title="Restore"><i class="fa-solid fa-trash-can-arrow-up"></i></button></a>
                                    <a href="?mod=contact&action=delete_contact&lienhe_id=<?php echo $item['lienhe_id']?>"><button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></a>
                                    <?php }else{
                                    ?>
                                    <a href="?mod=contact&action=edit_contact&lienhe_id=<?php echo $item['lienhe_id']?>"><button class="btn btn-success btn-sm rounded-0 m-2" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button></a>
                                    <a href="?mod=contact&action=trash_can&lienhe_id=<?php echo $item['lienhe_id']?>"><button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></a>
                                    <?php }
                                    ?>
                                </td>
                            </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='8'>Danh sách rỗng</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <?php if (!empty($pagging)) { get_pagging1($num_page, $page, "?mod=contact&action=list_contact"); } ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>
