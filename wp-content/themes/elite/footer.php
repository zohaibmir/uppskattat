</div>

<?php if (!is_home() && is_page()) { ?>
    <div class="footer">
        <div id="main-container" class="container">
            <div class="row">
                <div class="small-12 large-6 columns">
                    <h3 style="color: #FFF; font-size:14px;">Om Uppskattat.se</h3>

                    <span>
                        Vår lilla redaktion har ett stort hjärta, och vi kämpar för att du ska få ta del av det absolut mysigaste, chockerande och hetaste från internet. Vår målsättning är att du inte ska kunna besöka vår hemsida och förbli opåverkad av känslor. Våra klipp, bilder och berättelser kommer tveklöst träffa dig i hjärtat.
                    </span>
                </div>

                <div class="small-12 large-6 columns">
                    <h3 class="menu-links">Länkar</h3>
                    <ul class="footer-links">
                        <li><a style="color:#FFF;" href="<?php echo get_site_url(); ?>/annonsera-2/">Annonsering</a></li>				
                        <li><a style="color:#FFF;" href="<?php echo get_site_url(); ?>">Startsidan</a></li>
                        <li><a style="color:#FFF;" href="http://www.facebook.com/UppskattatSE">Facebook</a></li>
                        <li><a style="color:#FFF;" href="<?php echo get_site_url(); ?>/info">Info</a></li>
                        <li><a style="color:#FFF;" href="<?php echo get_site_url(); ?>/kontakta-oss/">Kontakta oss</a></li>
                        <li><a style="color:#FFF;" href="<?php echo get_site_url(); ?>/cookies/">Info om cookies</a></li>


                    </ul>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-12"
                     style="border-top: 1px solid #444444; text-align:center; margin-top:20px; padding-top:15px; color:#999999;">
                    <span>Copyright @ 2014</br> Skapad i Wordpress</span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<script src="<?php bloginfo('template_directory'); ?>/js/main.js"></script>
<div id="fb-root"></div>


<script>
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/sv_SV/all.js#xfbml=1&appId=441735099297814"; // APP ID
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>


<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-52688929-1', 'auto');
    ga('require', 'displayfeatures');
    ga('send', 'pageview');

</script>
<?php wp_footer(); ?>



<script src="<?php bloginfo('template_directory'); ?>/js/jquery.sidr.min.js"></script>

<script>
    $('#responsive-menu-button').sidr({
        name: 'sidr-main',
        source: '#navigation'
    });
    //$("#addsidebar").addClass('sticky-add');
    $(window).scroll(function (event) {
        var scroll = $(window).scrollTop();
        if (parseInt(scroll) > 3080) {
            if (!$("#addsidebar").hasClass('sticky-add')) {
                $("#addsidebar").addClass('sticky-add');
            }
        } else {
            if ($("#addsidebar").hasClass('sticky-add')) {
                $("#addsidebar").removeClass('sticky-add');
            }
        }
        //console.log(scroll);
        // Do something
    });
</script>
</body>
</html>
