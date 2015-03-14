<!-- Start footer -->
<footer id="footer-container<?php if(of_get_option('footer_columns') == 'footer0col') {echo "_no_footer";}?>">

<?php if(of_get_option('footer_columns') == 'footer0col') {}else{?>
    <div class="footer-columns">
        <div class="row">
            <?php if(of_get_option('footer_columns') == 'footer2col' || of_get_option('footer_columns') == 'footer3col') {?>
            <div class="<?php if(of_get_option('footer_columns') == 'footer2col'){echo "six columns";}elseif(of_get_option('footer_columns') == 'footer3col'){echo "four columns";}?>"><?php if (is_active_sidebar('footer1-sidebar')) : dynamic_sidebar('footer1-sidebar'); endif; ?></div>
            <div class="<?php if(of_get_option('footer_columns') == 'footer2col'){echo "six columns";}elseif(of_get_option('footer_columns') == 'footer3col'){echo "four columns";}?>"><?php if (is_active_sidebar('footer2-sidebar')) : dynamic_sidebar('footer2-sidebar'); endif; ?></div>
            <?php }?>
            <?php if(of_get_option('footer_columns') == 'footer1col' || of_get_option('footer_columns') == 'footer3col') {?>
            <div class="<?php if(of_get_option('footer_columns') == 'footer1col'){echo "twelve columns";}elseif(of_get_option('footer_columns') == 'footer3col'){echo "four columns";}?>"><?php if (is_active_sidebar('footer3-sidebar')) : dynamic_sidebar('footer3-sidebar'); endif; ?></div>
     		<?php }?>
        </div>
    </div>
    <?php }?>
    <div class="footer-bottom">
        <div class="row">
            <div class="six columns footer-left"> <?php echo of_get_option('copyright'); ?></div>
            <div class="six columns footer-right">                  
                    <?php $footer_menu = array('theme_location' => 'Footer_Menu', 'depth' => 1, 'container' => false, 'menu_class' => 'menu-footer', 'menu_id' => '', 'fallback_cb' => false ); ?>
                    <?php wp_nav_menu($footer_menu); ?>             
             </div>
        </div>  
    </div>  
</footer>
<!-- End footer -->
<?php
$tracking_code = of_get_option('google_analytics_code');
if (!empty($tracking_code)) {
    echo '<script>' . $tracking_code . '</script>';
}
?>
<?php
wp_footer();
?>
</div>
<div id="go-top"><a href="#go-top"><i class="fa fa-chevron-up"></i></a></div>
</body>
</html>