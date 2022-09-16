<?php // create previous , next and number of pages for pagination  ?>
<?php if (ceil($total_pages / $num_results_on_page) > 0): ?>
		<ul class="pagination">
			<?php if ($page > 1){ ?>
                    <li class="prev"><a href="<?php echo basename($_SERVER['PHP_SELF']);?>?page=<?php echo $page-1 ?>">Prev</a></li>
            <?php }else { ?> 
                    <li class="prev"><a style="opacity:0.1">Prev</a></li>       
            <?php } ?>
                            
            <?php if ($page > 3): ?>
                     <li class="start"><a href="<?php echo basename($_SERVER['PHP_SELF']);?>?page=1">1</a></li>
                     <!--<li class="dots">...</li>-->
            <?php endif; ?>

			<?php if ($page-2 > 0): ?><li class="page"><a href="<?php echo basename($_SERVER['PHP_SELF']);?>?page=<?php echo $page-2 ?>"><?php echo $page-2 ?></a></li><?php endif; ?>
            <?php if ($page-1 > 0): ?><li class="page"><a href="<?php echo basename($_SERVER['PHP_SELF']);?>?page=<?php echo $page-1 ?>"><?php echo $page-1 ?></a></li><?php endif; ?>
            
            <?php if ($page >= 1): ?>                
            <li class="currentpage"><a href="<?php echo basename($_SERVER['PHP_SELF']);?>?page=<?php echo $page ?>"><?php echo $page ?></a></li>
            <?php endif; ?>
            
			<?php if ($page+1 < ceil($total_pages / $num_results_on_page)+1): ?>
                    <li class="page"><a href="<?php echo basename($_SERVER['PHP_SELF']);?>?page=<?php echo $page+1 ?>"><?php echo $page+1 ?></a></li>
			<?php endif; ?>
            <?php if ($page+2 < ceil($total_pages / $num_results_on_page)+1): ?>
                    <li class="page"><a href="<?php echo basename($_SERVER['PHP_SELF']);?>?page=<?php echo $page+2 ?>"><?php echo $page+2 ?></a></li>
			<?php endif; ?>
                            
            <?php if ($page < ceil($total_pages / $num_results_on_page)-2): ?>
                      <!--<li class="dots">...</li>-->
                     <li class="end"><a href="<?php echo basename($_SERVER['PHP_SELF']);?>?page=<?php echo ceil($total_pages / $num_results_on_page) ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
			<?php endif; ?>

			<?php if ($page < ceil($total_pages / $num_results_on_page)){ ?>
					<li class="next"><a href="<?php echo basename($_SERVER['PHP_SELF']);?>?page=<?php echo $page+1 ?>">Next</a></li>
			<?php }else {; ?>
                    <li class="next"><a style="opacity:0.1">Next</a></li>
            <?php }?>
		</ul>
<?php endif; ?>
