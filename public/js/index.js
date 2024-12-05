
$('#slide_show > li:first').css('display', 'block').addClass('active');
var isHoverBtn = false;

$('#next_slide').bind('click', function() {
  runSlide(true);
});

$('#prev_slide').bind('click', function() {
  runSlide(false);
});

$('.slide_btn').hover(function() {
  isHoverBtn = true;
}, function() {
  isHoverBtn = false;
});

setInterval(function(){
  if (!isHoverBtn) {
    runSlide(true);
  }
}, 3000);


function runSlide(isNext) {
  var oldItem = $('#slide_show > li.active');
  var newItem;

  if (isNext) {
    newItem = oldItem.next();

    if (newItem.length === 0) {
      newItem = $('#slide_show > li:first');
    }
  } else {
    newItem = oldItem.prev();

    if (newItem.length === 0) {
      newItem = $('#slide_show > li:last');
    }
  }

  if (newItem.length === 0) {
    newItem = $('#slide_show > li:eq(0)');
  }

  oldItem.fadeOut(function() {
    $(this).removeClass('active');
  });

  newItem.fadeIn(function() {
      $(this).addClass('active');
    });
}


let menu_click = document.querySelector('#menu_click');
let menu_mb = document.querySelector('.menu_mb');

menu_click.addEventListener('click', function() {
  // Kiểm tra nếu menu đang được hiển thị (display không phải là 'none')
  if (menu_mb.style.display !== 'block') {
    // Nếu menu đang ẩn, hiển thị nó
    menu_mb.style.display = 'block';
    menu_mb.style.zIndex = '30';
  } else {
    // Nếu menu đang hiển thị, ẩn nó
    menu_mb.style.display = 'none';
  }
});
