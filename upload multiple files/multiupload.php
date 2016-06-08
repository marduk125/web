<!DOCTYPE html>
<html>
    <head>
		<title>Upload Multiple Images Using jquery and PHP</title>
         <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

		<!-------Including jQuery from google------>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="script.js"></script>
		
		<!-------Including CSS File------>
        <link rel="stylesheet" type="text/css" href="style.css">
    <body>
        
                <form enctype="multipart/form-data" action="" method="post">
                   <hr/>
                    <div id="filediv"><input name="file[]" type="file" id="file"  value="add" ></div><br/>
           
                    <input class="btn btn-primary" type="button" id="add_more" class="upload" value="Ajouter des Images"/>
                    
                    <input class="btn btn-success" type="submit" value="Uploader des Images" name="submit" id="upload" class="upload"/>
                </form>
                <br/>
                <br/>
				<!-------Including PHP Script here------>
                <?php include "upload.php"; ?>
           
           
		   <!-- Right side div -->
           
    </body>
</html>