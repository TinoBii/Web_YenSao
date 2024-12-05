<?php
get_header();
?>

<div id="page-body" class="d-flex">
    <?php get_sidebar() ?>
    <div id="wp-content">
        <div id="content" class="container-fluid">
            <div class="card">
                <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                    <h5 class="m-0">Danh sách danh mục</h5>
                    <div class="form-search form-inline">
                        <form action="#">
                            <input type="text" id="Search" class="form-control form-search" placeholder="Tìm kiếm">
                            <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                        </form>
                    </div>
                </div>
                <div style="text-align:end; margin: 15px 0 0 0" class="col-sm-12 ">
                    <a href="?mod=categories&action=add_categories"><button type="submit" class="btn btn-success"><i style="color:#fff" class="plus-icon fas fa-plus-circle"></i> Thêm mới</button></a>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-checkall text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID Danh mục</th>
                                <th scope="col">Cấp</th>
                                <th scope="col">Kiểu</th>
                                <th scope="col">Danh mục cha</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Nổi bật</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stt = 0;
                            if (!empty($list_categories)) {
                                foreach (array_reverse($list_categories) as $item) {
                            ?>
                            <tr>
                                <td scope="row"><?php echo ++$stt; ?></td>
                                <td><?php echo $item['danhmuc_id']; ?></td>
                                <td><?php echo $item['cap']; ?></td>
                                <td> <?php 
                                    $kieuLabels = [
                                        1 => 'Giới thiệu',
                                        2 => 'Sản phẩm',
                                        3 => 'Tin tức',
                                        4 => 'Chính sách'
                                    ];
                                    echo isset($kieuLabels[$item['kieu']]) ? $kieuLabels[$item['kieu']] : 'Không xác định';
                                ?></td>
                                <td><?php echo !empty($item['danhmuc_id_cha']) ? $item['danhmuc_id_cha'] : 'Không có'; ?></td>
                                <td><?php echo $item['ten_danhmuc']; ?></td>
                                <td><?php echo $item['trangthai'];?></td>
                                <td><?php echo ($item['noibat'] == 2) ? 'Nổi bật' : 'Không nổi bật'; ?></td>
                                <td>
                                    <?php $action = $_GET['action']; 
                                        if ($action == 'list_categories') {
                                    ?>
                                    <a href="?mod=categories&action=edit_categories&danhmuc_id=<?php echo $item['danhmuc_id']; ?>"><button class="btn btn-success btn-sm rounded-0 m-2" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button></a>
                                    <a href="?mod=categories&action=delete_categories&danhmuc_id=<?php echo $item['danhmuc_id']; ?>"><button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></a>
                                    <?php } ?>
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
                        <?php if (!empty($pagging)) { get_pagging1($num_page, $page, "?mod=category&action=list_category"); } ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>
