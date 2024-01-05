$(document).ready(function(){
  var docWidth = $('body').width(),
      imgNb = 10,
      $images = $('#imgs');
  
  
  $(window).on('resize', function(){
    docWidth = $('body').width();
    slidesWidth = $('#imgs').width();
  });
  
  $(document).mousemove(function(e) {
    var mouseX = e.pageX,        
        rotate = mouseX*360/docWidth;
    
    $images.css({
      '-webkit-transform': 'rotate3d(0,1,0,' + -rotate + 'deg)',
              'transform': 'rotate3d(0,1,0,' + -rotate + 'deg)',
    });
  });
})