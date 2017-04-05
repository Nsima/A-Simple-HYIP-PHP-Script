	


        <!-- jQuery -->
        <script src="<?=URL?>/public/js/jquery.min.js"></script>
        <script src="<?=URL?>/public/js/bootstrap.min.js"></script>
        <script src="<?=URL?>/public/js/jquery.flexslider.js"></script>
        <script src="<?=URL?>/public/js/jquery.inview.js"></script>
        <script src="https://maps.google.com/maps/api/js?sensor=true"></script>
        <script src="<?=URL?>/public/js/script.js"></script>
        <script src="<?=URL?>/public/contactform/contactform.js"></script>

        <?php if(isset($this->js)): ?>
    	<?php foreach($this->js as $js): ?>
    		<script src="<?=URL?>/public/js/<?=$js?>.js"></script>
    	<?php endforeach; ?>
	    <?php else: ?>

	    <?php endif; ?>

    </div>
</body>

</html>









