<?php require_once('includes/header.php');
      require_once('includes/classes/VideoDetailsFormProvider.php');
?>

<div class="column">
   <?php
     $x = new VideoDetailsFormProvider($conn);
     echo  $x->createUploadForm();

   ?>
</div>
<script>
  $("form").submit(function(){
      $("#modalLoader").modal("show");
  })
  
</script>

<!-- Modal -->
<div class="modal fade" id="modalLoader" tabindex="-1" role="dialog" aria-labelledby="modalLoader" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
         Please wait. This might take a while...
         <img src = "./assets/images/icons/loading-spinner.gif">
      </div>
    </div>
  </div>
</div>
<?php require_once('includes/footer.php') ?>
 