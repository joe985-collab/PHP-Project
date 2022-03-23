<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Simple SQL Table</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Madurai:wght@300&family=IBM+Plex+Serif:wght@300&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="Header">
        <h1>MySQL Table Creator</h1>
    </div>
    <div class="credentials">
          <p>Please enter your table name below.</p>
          <div class="table">
             <em>Table Name: </em> <input type="text" name="table_name" />
           </div>
           <div class="submit">
              <input class="button-7" type="submit">
           </div>
        </form>
    </div>

    <?php
        //I have added css to make the site look more appealing. :)
        error_reporting(E_ERROR|E_PARSE); //ignores warnings from php and only displays errors.
        $servername = ""; //required fields
        $username = ""; //required fields
        $password = ""; //required fields
        $dbname = ""; //required fields
        $table_name = $_POST["table_name"]; // retrieve data from the form
        if($username != NULL && $password != NULL && $dbname != NULL){ //since fields are initially empty, i have temporarily set it to print hello world.
          try{
          $conn = new mysqli($servername, $username, $password,$dbname); //check if all fields entered are valid or not.
          //Check connection
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error); //connection error message, closes the sql connection
          }
          if(!empty($_POST["table_name"])){ //check if table field is empty, i feel this is unnecessary
          try{
                $result = $conn -> query("SELECT * FROM $table_name"); // Check if we can select all items from the table
                echo ("<div class='warning'>
                  <p>
                  Table $table_name already exists. Please try another name.
                  </p>
                </div>");
              }catch(Exception $e){ //catches the error if table does not exist
                $sql = "CREATE TABLE $table_name(
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                firstname VARCHAR(30) NOT NULL,
                lastname VARCHAR(30) NOT NULL,
                email VARCHAR(50)
                )";
                $conn->query($sql);
                echo "<p>Table $table_name created successfully<p>";
                $conn->close();
              }
            }else{
              echo ("<div class='warning'>
                  <p> Enter a table name. Currently its empty. </p>
              </div>");
            }
        }catch(Exception $e){
          echo("<div class='warning'>
              <p>Invalid Credentials or Database Used.</p>
          </div>"); //catches permission denied error
        }
        }else{
            echo("<div class='warning'>
                <p>Hello World.</p>
            </div>");
          }

          ?>
  </body>
</html>
