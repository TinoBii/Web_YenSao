<?php
function get_pagging($num_page,$page,$base_url=""){
    $str_pagging="<ul class='pagging'>";
    if($page>1){
      $page_pre=$page-1;
      $str_pagging.="<li><a href=\"{$base_url}&page={$page_pre}\">Trước</a></li>";
    }
    for($i=1;$i<=$num_page;$i++){
      $active="class=''";
      if($i==$page) $active="class='active'";
        $str_pagging.="<li ><a {$active} href=\"{$base_url}&page={$i}\">{$i}</a></li>";
    }
    if($page<$num_page){
      $page_next=$page+1;
      $str_pagging.="<li><a href=\"{$base_url}&page={$page_next}\">Sau</a></li>";
    }
    $str_pagging.="</ul>";
    echo $str_pagging;
}
function get_pagging1($num_page,$page,$base_url=""){
    $str_pagging="<ul class='pagination'>";
    if($page>1){
      $page_pre=$page-1;
      // $str_pagging.="<li class='page-item'><a href=\"{$base_url}&page={$page_pre}\">Trước</a></li>";
      $str_pagging.="<li class='page-item'>
      <a class='page-link' href=\"{$base_url}&page={$page_pre}\" aria-label='Previous'>
          <span aria-hidden='true'>Trước</span>
          <span class='sr-only'>Sau</span>
      </a>
  </li>";
    }
    for($i=1;$i<=$num_page;$i++){
      $active="id='active'";
      if($i==$page) $active="class='active'";
        $str_pagging.="<li class='page-item'><a class='page-link' {$active} href=\"{$base_url}&page={$i}\">{$i}</a></li>";
    }
    if($page<$num_page){
      $page_next=$page+1;
      // $str_pagging.="<li><a href=\"{$base_url}&page={$page_next}\">Sau</a></li>";
      $str_pagging.="<a class='page-link' href=\"{$base_url}&page={$page_next}\" aria-label='Next'>
      <span aria-hidden='true'>&raquo;</span>
      <span class='sr-only'>Next</span>
      </a>";
    }
    $str_pagging.="</ul>";
    echo $str_pagging;
}
?>
