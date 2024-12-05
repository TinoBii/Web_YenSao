<?php
get_header();
?>

  <link rel="stylesheet" href="public/css/add_img.css">
 <div id="page-body" class="d-flex">
        <?php get_sidebar()?>
        <div id="wp-content">
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Upload ảnh cho <?php echo $product['title']?>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">    
            <!-- <input type="file" name="files[]" multiple> -->
                <fieldset class="upload_dropZone text-center mb-3 p-4">

                    <!-- <legend class="visually-hidden">Image uploader</legend> -->

                    <svg class="upload_svg" width="60" height="60"  aria-hidden="true">
                    <use href="#icon-imageUpload"></use>
                    </svg>

                    <p class="small my-2"> Kéo hình vào để upload ảnh lên website<br><i>or</i></p>

                    <input id="upload_image_background" data-post-name="image_background" data-post-url="https://someplace.com/image/uploads/backgrounds/" class="position-absolute invisible" name="files[]" type="file" multiple accept="image/jpeg, image/png, image/svg+xml" />
                    <label class="btn btn-upload mb-3" for="upload_image_background">Chọn file(s)</label>

                    <div class="upload_gallery d-flex flex-wrap justify-content-center gap-3 mb-0"></div>

                </fieldset>
                <?php echo form_error('soluong')?>
                <button type="submit" name="btn-upload" class="btn btn-primary">UPLOAD ẢNH</button>
            </form>
            <p class=" m-3">Có (<?php echo count($list_img)?>) tấm ảnh</p>
            <table class="table table-striped table-checkall text-center">
              
                <thead>
                    <tr>
                        <th scope="col">
                            <input name="checkall" type="checkbox">
                        </th>
                        <th scope="col">Ảnh</th>  
                        <th scope="col">Tên ảnh</th>    
                        <th scope="col">Số tt</th>           
                        <th scope="col">Tác vụ</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                   $stt=0;
                     if(!empty($list_img)){
                        foreach(array_reverse($list_img) as $item){
                            
                    ?>
                    <tr class="Search">
                        <td>
                            <input type="checkbox">
                        </td>
                        <td>
                        

                            <a href="" title=""><img width="100px;" src="public/images/<?php echo $item['url_img']?>" alt=""></a>
                        </td>           
                        <td><a href="#"><?php echo $item['name_img']?></a></td>
                        <td scope="row"><input  data_id="44" class="get_number" min="1" value="<?php echo $item['stt']?>" type="number"></td>

                        <td>
                             <a href="?mod=images&action=edit_img&id_img=<?php echo $item['id_img']?>"><button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button></a>
                            <a href="?mod=images&action=delete_img&id_img=<?php echo $item['id_img']?>"><button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></a>
                          
                        </td>
                    </tr>
                    <?php
                    }
                        
                    }
                    else{
                        echo "Danh sách rỗng";
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    
console.clear();
('use strict');


// Drag and drop - single or multiple image files
// https://www.smashingmagazine.com/2018/01/drag-drop-file-uploader-vanilla-js/
// https://codepen.io/joezimjs/pen/yPWQbd?editors=1000
(function () {

  'use strict';
  
  // Four objects of interest: drop zones, input elements, gallery elements, and the files.
  // dataRefs = {files: [image files], input: element ref, gallery: element ref}

  const preventDefaults = event => {
    event.preventDefault();
    event.stopPropagation();
  };

  const highlight = event =>
    event.target.classList.add('highlight');
  
  const unhighlight = event =>
    event.target.classList.remove('highlight');

  const getInputAndGalleryRefs = element => {
    const zone = element.closest('.upload_dropZone') || false;
    const gallery = zone.querySelector('.upload_gallery') || false;
    const input = zone.querySelector('input[type="file"]') || false;
    return {input: input, gallery: gallery};
  }

  const handleDrop = event => {
    const dataRefs = getInputAndGalleryRefs(event.target);
    dataRefs.files = event.dataTransfer.files;
    handleFiles(dataRefs);
  }


  const eventHandlers = zone => {

    const dataRefs = getInputAndGalleryRefs(zone);
    if (!dataRefs.input) return;

    // Prevent default drag behaviors
    ;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(event => {
      zone.addEventListener(event, preventDefaults, false);
      document.body.addEventListener(event, preventDefaults, false);
    });

    // Highlighting drop area when item is dragged over it
    ;['dragenter', 'dragover'].forEach(event => {
      zone.addEventListener(event, highlight, false);
    });
    ;['dragleave', 'drop'].forEach(event => {
      zone.addEventListener(event, unhighlight, false);
    });

    // Handle dropped files
    zone.addEventListener('drop', handleDrop, false);

    // Handle browse selected files
    dataRefs.input.addEventListener('change', event => {
      dataRefs.files = event.target.files;
      handleFiles(dataRefs);
    }, false);

  }


  // Initialise ALL dropzones
  const dropZones = document.querySelectorAll('.upload_dropZone');
  for (const zone of dropZones) {
    eventHandlers(zone);
  }


  // No 'image/gif' or PDF or webp allowed here, but it's up to your use case.
  // Double checks the input "accept" attribute
  const isImageFile = file => 
    ['image/jpeg', 'image/png', 'image/svg+xml'].includes(file.type);


  function previewFiles(dataRefs) {
    if (!dataRefs.gallery) return;
    for (const file of dataRefs.files) {
      let reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onloadend = function() {
        let img = document.createElement('img');
        img.className = 'upload_img mt-2';
        img.setAttribute('alt', file.name);
        img.src = reader.result;
        dataRefs.gallery.appendChild(img);
      }
    }
  }

  // Based on: https://flaviocopes.com/how-to-upload-files-fetch/
  const imageUpload = dataRefs => {

    // Multiple source routes, so double check validity
    if (!dataRefs.files || !dataRefs.input) return;

    const url = dataRefs.input.getAttribute('data-post-url');
    if (!url) return;

    const name = dataRefs.input.getAttribute('data-post-name');
    if (!name) return;

    const formData = new FormData();
    formData.append(name, dataRefs.files);

    fetch(url, {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      console.log('posted: ', data);
      if (data.success === true) {
        previewFiles(dataRefs);
      } else {
        console.log('URL: ', url, '  name: ', name)
      }
    })
    .catch(error => {
      console.error('errored: ', error);
    });
  }


  // Handle both selected and dropped files
  const handleFiles = dataRefs => {

    let files = [...dataRefs.files];

    // Remove unaccepted file types
    files = files.filter(item => {
      if (!isImageFile(item)) {
        console.log('Not an image, ', item.type);
      }
      return isImageFile(item) ? item : null;
    });

    if (!files.length) return;
    dataRefs.files = files;

    previewFiles(dataRefs);
    imageUpload(dataRefs);
  }

})();
</script>
<?php
get_footer();
?>