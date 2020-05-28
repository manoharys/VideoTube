<?php require_once('includes/header.php');
      require_once('includes/classes/VideoDetailsFormProvider.php');
?>

<div class="column">
   <?php
     $x = new VideoDetailsFormProvider($conn);
     echo  $x->createUploadForm();

   ?>

</div>
<?php require_once('includes/footer.php') ?>
 