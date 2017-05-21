$(document).ready(function(){

function photoup() {
    $.ajax({
			url: 'obj.json',
			type: 'get',
			dataType: 'JSON',
            cache:'false',
			error: function (data) {
				console.log(data);
			},
			success: function (data) {
				// upon successfully retrieving the json file loop through the data dynamically generate cards on the index page
				$.each(data, function (index, value) {
					console.log(Object.keys(value));
					console.log(index);
					console.log(value);
                    id = index;
                    var location = value.location;
					var year = value.year;
                     u = year +'_'+ location;
                    
                    
                    $('#first').append('<div class="row featurette alignm"><a href="#" class="cola"><h1>NYC' + year +'</h1></a><div class="caps" style="display: none;">');
                    
                     $('#sites'+ year).append('<div id="'+id+'"class="col-md-6 col-sm-offset-0 displayer"></div>');
                    
                    $("#"+id).append('<h3>'+location+'</h3>');
                    $("#"+id).append('<img class="display" src="'+ u +'/img1.jpg">');
                    $("#"+id).append('<ul class="thumbs"></ul>'); 
                    $("#"+id+" .thumbs").append('<li><img src="'+ u +'/img1.jpg"></li><li><img src="'+ u +'/img2.jpg"></li><li><img src="'+ u +'/img3.jpg"></li><li><img src="'+ u +'/img4.jpg"></li>');

              
                    
				});
                thumbs = (document.querySelectorAll(".thumbs > li > img"));
    for (i = 0; i < thumbs.length; ++i){
    thumbs[i].onclick = function(){
        imgsrc = this.src;
        //console.log(document.getElementById('displayer').src);
        console.log(imgsrc);
        imgsrc = imgsrc.split('/');
        imgsrc = imgsrc[imgsrc.length-1];
        console.log(imgsrc);
        display = $(this).parents('#'+id+'.displayer').find('.display').attr('src', u +'/'+ imgsrc);
        //display.src = 'img/' + imgsrc;
      };
    }
                var g = document.querySelectorAll('.cola');

          for (i = 0; i < g.length; ++i){
            g[i].onclick = function(){
              var caps = this.nextElementSibling;
              if (caps.style.display === 'block' || caps.style.display === ''){
                caps.style.display = "none";
              } else {
                caps.style.display = "block";
              }
              return false;
            }

          }

			}
		});
}
    
    photoup();
    
    $("form").submit(function (e) {
//		$('.person').remove();
		var formData = new FormData($(this)[0]);
		$.ajax({
			url: "process.php",
			type: "POST",
			data: formData,
			success: function(){
				console.log('got here');
				photoup();
			},
			cache: false,
			contentType: false,
			processData: false
		});
		e.preventDefault();
	});
});

