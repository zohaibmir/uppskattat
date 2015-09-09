<?php wp_footer(); ?>



</div> <!-- close main container -->

<div class="footer"
	 style=" background:#333333; color:#999999; font-family: 'Merriweather Sans', sans-serif; font-weight:100;">
	<div id="main-container" class="container">
		<div class="col-sm-4">
			<h3 style="color: #FFF; font-size:1.2em;">Om Uppskattat.se</h3>

        <span>
	Vår lilla redaktion har ett stort hjärta, och vi kämpar för att du ska få ta del av det absolut mysigaste, chockerande och hetaste från internet. Vår målsättning är att du inte ska kunna besöka vår hemsida och förbli opåverkad av känslor. Våra klipp, bilder och berättelser kommer tveklöst träffa dig i hjärtat.
	</span>
		</div>
		<div class="col-sm-4">
			<h3 style="color: #FFF; font-size:1.2em;">Länkar</h3>
			<ul style="margin-left:-10px;">
<li><a style="color:#FFF;" href="http://uppskattat.se/annonsera-2/">Annonsering</a></li>				
<li><a style="color:#FFF;" href="http://www.uppskattat.se">Startsidan</a></li>
				<li><a style="color:#FFF;" href="http://www.facebook.com/UppskattatSE">Facebook</a></li>
				<li><a style="color:#FFF;" href="http://uppskattat.se/info">Info</a></li>
				<li><a style="color:#FFF;" href="http://uppskattat.se/kontakta-oss/">Kontakta oss</a></li>
<li><a style="color:#FFF;" href="http://uppskattat.se/cookies/">Info om cookies</a></li>


			</ul>
		</div>

		<div class="col-sm-12"
			 style="border-top: 1px solid #444444; text-align:center; margin-top:20px; padding-top:15px; color:#999999;">
			<span>Copyright @ 2014</br> Skapad i Wordpress</span>
		</div>
	</div>
</div>

<script src="<?php bloginfo('template_directory'); ?>/js/main.js"></script>
<div id="fb-root"></div>


<script>
	(function (d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s);
		js.id = id;
		js.src = "//connect.facebook.net/sv_SV/all.js#xfbml=1&appId=441735099297814"; // APP ID
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-52688929-1', 'auto');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');

</script>
<?php 
if(wp_is_mobile()) {
?>
<div class="ad-footer">
</div>
<?php
}
?>
</body>
</html>
