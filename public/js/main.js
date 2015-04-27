$(document).ready(function() {
	if($('#addBr').length) {
		$('#addBr').click(function() {
			var oldText = $('#text').val();
			$('#text').val(oldText + '<br>');
		});
		$('#addLink').click(function() {
			var oldText = $('#text').val();
			$('#text').val(oldText + '<a href=""></a>');
		});
		$('#addStrong').click(function() {
			var oldText = $('#text').val();
			$('#text').val(oldText + '<strong></strong>');
		});
		$('#addEm').click(function() {
			var oldText = $('#text').val();
			$('#text').val(oldText + '<em></em>');
		});
		$('#addVideo').click(function() {
			var oldText = $('#text').val();
			$('#text').val(oldText + '<iframe src="$$URL§§" width="720" height="405" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');
		});
		$('#addProc').click(function() {
			var oldText = $('#text').val();
			var newId  = $('#newId').text();
			$('#text').val(oldText + '<canvas data-processing-sources="/processing/' + newId +'/FILE.pde "</canvas>');
		});
		$('#addImg').click(function() {
			var oldText = $('#text').val();
			$('#text').val(oldText + '<img src="">');
		});
	}
});

function showEntry(id) {
	var selector = "toggle" + id;
	if(id == "recite") {
		$(".togglerecite").toggle();
		$(".toggletags").hide();
		$(".togglecomments").hide();
	} else if(id == "tags") {
		$(".togglerecite").hide();
		$(".toggletags").toggle();
		$(".togglecomments").hide();
	} else if(id == "comments") {
		$(".togglerecite").hide();
		$(".toggletags").hide();
		$(".togglecomments").toggle();
	} else {
		$("." + selector).toggle();
	}
	return false;
}