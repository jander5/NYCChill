$(document).ready(function () {
	ary = [];
	$.ajax({
		url: 'obj.json',
		type: 'get',
		dataType: 'JSON',
		cache: 'false',
		error: function (data) {
			console.log(data);
		},
		success: function (data) {

			// upon successfully retrieving the json file loop through the data dynamically generate cards on the index page
			$.each(data, function (index, value) {
				//					console.log(Object.keys(value));
				//					console.log(index);
				//					console.log(value);
				id = index;
				var location = value.location;
				var year = value.year;
				var thumbs = value.thumbs;
				u = year + '_' + location;

				if (ary.indexOf(year) == -1) {
					ary.push(year);
					$('#first').append('<div class="row featurette alignm"><a href="#" class="cola"><h1>NYC ' + year + '</h1></a><div class="caps" style="display: none;"><div id="sites' + year + '"></div></div>');
				}

				$('#sites' + year).append('<div id="' + id + '"class=" col-sm-offset-0 displayer"></div>');

				$("#" + id).append('<h3>' + location + '</h3>');
				$("#" + id).append('<img class="display" src="' + u + '/img1.jpg">');
				$("#" + id).append('<ul class="thumbs" id="' + u + '"></ul>');
				for (y = 0; y < thumbs.length; ++y) {
					pic = thumbs[y];
					$("#" + id + " .thumbs").append('<li><img src="' + pic + '"></li>');
				}
			});
			thumbs = (document.querySelectorAll(".thumbs > li > img"));
			for (i = 0; i < thumbs.length; ++i) {
				thumbs[i].onclick = function () {
					imgsrc = this.src;
					console.log(imgsrc);
					display = $(this).parents('.displayer').find('.display').attr('src', imgsrc);
				};
			}

			var g = document.querySelectorAll('.cola');

			for (i = 0; i < g.length; ++i) {
				g[i].onclick = function () {
					var caps = this.nextElementSibling;
					if (caps.style.display === 'block' || caps.style.display === '') {
						caps.style.display = "none";
					} else {
						caps.style.display = "block";
					}
					return false;
				}
			}
		}
	});
});
