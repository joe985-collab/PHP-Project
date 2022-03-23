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
        <p>Enter your MySQL credentials below.</p>
        <form action="mytable.php" method="post">
          <div class="user">
            <em>username:</em> <input  type="text" name="username1"> <br>
          </div>
          <div class="pass">
            <em>password:</em> <input  type="password" name="pass1"> <br>
          </div>
          <div class="dbase">
            <em>Database:</em> </em> <input type="text" name="db">
          </div>
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
        error_reporting(E_ERROR|E_PARSE);
        $servername = "localhost";
        $username = $_POST["username1"];
        $password = $_POST["pass1"];
        $dbname = $_POST["db"];
        $table_name = $_POST["table_name"];
        if($username != NULL && $password != NULL && $dbname != NULL){
          try{
          $conn = new mysqli($servername, $username, $password,$dbname);
          //Check connection
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }
          if(!empty($_POST["table_name"])){
          try{
                $result = $conn -> query("SELECT * FROM $table_name");
                echo ("<div class='warning'>
                  <p>
                  Table $table_name already exists. Please try another name.
                  </p>
                </div>");
              }catch(Exception $e){
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
          </div>");
        }
        }else{
            echo("<div class='warning'>
                <p>Important Fields are empty.</p>
            </div>");
          }

          ?>
  </body>
</html>
