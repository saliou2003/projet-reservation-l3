<form enctype="multipart/form-data" action="uploadaction.php" method="post">
    <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
     
      Importer un fichier image : <input name="userfile" type="file" />
   
    <br/>
    <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
     
    Importer un fichier pdf : <input name="userpdf" type="file" />
      <br/> <br/>
    <input type="submit" value="Envoyer le fichier" />

</form>