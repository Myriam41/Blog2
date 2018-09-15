<?php
?>
  <div class="postAdd">
  
  <form action="index.php?page=commentAdd" method="post" class="col-lg-10">
    <legend>Ecrire un commentaire</legend>
    <fieldset>
      <div class="form group">  
        <label for "contmessage">Message : </label>
      <textarea id="contmessage" name="contmessage" class="form-control" rows="4" cols="50">
      </textarea> </div>

      <input type="hidden" name="postId" value= $_SESSION['postId'] />
</br>
      <div class="form-group">
            <button type="submit" class="btn btn-primary" id="sendMessageButton">Envoyer</button>
      </div>
  </fieldset>
    </form>
  </div>