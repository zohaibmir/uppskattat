
$(function() {

	$('.twitter-share').click(function() {
		var elem = $(this);
		var url = elem.data('href');
		var title = elem.data('title');

		window.open("https://twitter.com/intent/tweet?url="+encodeURIComponent(url)+"&text="+encodeURIComponent(title)+ "&count=none/", "", "height=300, width=550, resizable=1");
       return true;
	});

	$("span.close-fb").click(function() {
		$(this).parent().hide("fast");
	});
});
