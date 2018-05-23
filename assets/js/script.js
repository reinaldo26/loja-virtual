$(function(){
  //slider filter
	$( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: maxValue,
      values: [ $('#slider0').val(), $('#slider1').val() ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "R$" + ui.values[ 0 ] + " - R$" + ui.values[ 1 ] );
      },
      change: function( event, ui ) {
      	var sel = $(ui.handle).index();
      	sel = sel - 1;
      	$('#slider'+sel).val(ui.value);
      	$('.filterarea form').submit();
      }
    });
    $( "#amount" ).val( "R$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - R$" + $( "#slider-range" ).slider( "values", 1 ) );

    $('.filterarea').find('input').on('change', function(){
    	$('.filterarea form').submit();
    });

    //form cart
    $('.addtocartform button').on('click', function(e){
      e.preventDefault();
      var qt = parseInt($('.addtocartqt').val());
      var action = $(this).attr('data-action');
      if(action == 'decrease'){
        if(qt-1 >= 1){
          qt = qt - 1;
        }        
      } else if(action == 'increase'){
        qt = qt + 1;
      }
      $('.addtocartqt').val(qt);
    });

    //gallery
    $('.photo_item').on('click', function(){
      var url = $(this).find('img').attr('src');
      $('.mainphoto').find('img').attr('src', url);
    });
});