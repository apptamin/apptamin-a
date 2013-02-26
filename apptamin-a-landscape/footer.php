
    </div><!-- #main -->
    
    <?php
    
    // action hook for placing content above the footer
    thematic_abovefooter();
	
	// action hook creating the footer 
    thematic_footer();
    
    // action hook for placing content below the footer
    thematic_belowfooter();?>
	</div>


	<?php
    if (apply_filters('thematic_close_wrapper', true)) {
    	echo '</div><!-- #wrapper .hfeed -->';
    }
    
    ?>  

<?php 

// calling WordPress' footer action hook
wp_footer();

// action hook for placing content before closing the BODY tag
thematic_after(); 

?>

</body>
</html>