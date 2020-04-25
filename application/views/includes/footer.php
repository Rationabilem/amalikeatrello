    </div>
    
    
    <?php
      if(isset($data['js'])) {
        foreach ($data['js'] as $script) {
          echo $script;
        }
      }
    ?>
    <script src="<?php echo URL_ROOT; ?>/js/main.js"></script>
  </body>
</html>