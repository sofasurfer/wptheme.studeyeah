    <footer>         
    <p><a href="https://www.sofasurfer.org" target="_blank" title="Built by SofaSurfer">Built by SofaSurfer</a></p>
    </footer>    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <?= wp_footer() ?>
    <script type="text/javascript">
      var _paq = _paq || [];
      /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
      _paq.push(['trackPageView']);
      _paq.push(['enableLinkTracking']);
      (function() {
        var u="//piwik.sofasurfer.org/";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', '28']);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
      })();
    </script>
    <!-- End Piwik Code -->

<!-- cookie stuff -->
<?php 

// Add tracking code
if(isset($_COOKIE['cookiebanner_min'])) {
    echo apply_filters( 'c_get_option', 'tracking_necessary' );
}

if(isset($_COOKIE['cookiebanner_all'])) {
    echo apply_filters( 'c_get_option', 'tracking_necessary' );
    echo apply_filters( 'c_get_option', 'tracking_optional' );
}
?>
<!-- cookie stuff end -->
</body>
</html>
