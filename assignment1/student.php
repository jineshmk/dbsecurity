<html>
    <head>
        <title>Add New Record in MySQL Database</title>
    </head>

    <body>
        <?php
               //Connection parameters
                $dbhost = "localhost";
                $dbuser = "root"; //replace with your username
                $dbpass = "test"; //replace withyour password
                $dbname ="STUDENTS";
                //Establish Connection
                $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
               //Connection failed, show error
               if(! $conn ) {
                  die('Could not connect: ' . mysqli_connect_error());
                }
            
             //if POST is isset
              if(isset($_POST['add'])){
                    //Get values
                    $name = $_POST['name'];
                    $rollno = $_POST['rollno'];
                    $dob = $_POST['dob']; 
                    //Create query
                    $sql = "INSERT INTO DETAILS "."(ROLL_NO,NAME,DOB)"."VALUES ".  "('$rollno','$name','$dob')";
                    //Insert values to db
                    $retval = mysqli_query( $conn,$sql );
                    //
                    if(! $retval ) {
                            // Insertion failed
                            echo  "<script type='text/javascript'> alert('Insertion Failed');</script>";
                    }
                    else{
                            //Show success message
                            echo  "<script type='text/javascript'> alert('Successfully Inserted');</script>";
                    }
             }
             ?>
   <div align="center">
   <h3> Student Details </h3>
   
          <form method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>" >
           <table width = "600" border = "0" cellspacing = "1" cellpadding = "2">
            <tr>
               <td width = "250">Name</td>
               <td><input name = "name" type = "text" id = "name"></td>
            </tr>
            <tr>
               <td width = "250">Roll No</td>
               <td> <input name = "rollno" type = "text" id = "rollno"> </td>
            </tr>
            <tr> 
               <td width = "250">Date of Birth [   yyyy-mm-dd ]</td>
               <td> <input name = "dob" type = "text" id = "dob"></td>
            </tr>
            <tr>
               <td width = "250"> </td>
               <td> </td>
            </tr>
            <tr>
               <td width = "250"> </td>
               <td><input name = "add" type = "submit" id = "add"  value = "Add Student"></td>
            </tr>
         </table>
      </form>
      
      <hr/>
      <h4> Available Details </h4>
       <table width = "600" border = "0" cellspacing = "1" cellpadding = "2">
       <tr> <th> Roll No</th> <th> Name</th> <th>Date of Birth</th></tr>
      <?php
           //Sql query
           $sql = "SELECT ROLL_NO,NAME,DOB FROM DETAILS";
           $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {//has result
                // take row by row and print it
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr align='center'><td> " . $row["ROLL_NO"]. " </td><td> " . $row["NAME"]. "</td><td>  " . $row["DOB"]. "</td></tr>";
                }
          } else {
             echo "0 results";
        }
        mysqli_close();
     ?>
      </table>
      </div>
   </body>
</html>
