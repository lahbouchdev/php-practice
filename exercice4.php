<!DOCTYPE html>
<html>

<head>
     <title>json-php</title>
</head>

<body>
     <br />
     <div class="container" style="width:500px;">
          <h3 align="">save data to JSON File</h3><br />
          <form method="post">
               <?php
               if (isset($error)) {
                    echo $error;
               }
               ?>
               <br />
               <label>First Name</label>
               <input type="text" name="name" /><br />
               <label>Last Name</label>
               <input type="text" name="lname" /><br />
               <label>N° phone</label>
               <input type="number" name="phone" /><br />
               <input type="submit" name="submit" value="save" /><br />
               <?php
               if (isset($message)) {
                    echo $message;
               }
               ?>
          </form>
     </div>

     <br>

     <?php
     $message = '';
     $error = '';
     if (isset($_POST["submit"])) {
          if (empty($_POST["name"])) {
               $error = "<label>Enter Name</label>";
          } else if (empty($_POST["lname"])) {
               $error = "<label>Enter Gender</label>";
          } else if (empty($_POST["phone"])) {
               $error = "<label>Enter Designation</label>";
          } else {

               if (file_exists('data.json')) {
                    $current_data = file_get_contents('data.json');
                    $array_data = json_decode($current_data, true);
                    $extra = array(
                         'name'               =>     $_POST['name'],
                         'lname'          =>     $_POST["lname"],
                         'phone'     =>     $_POST["phone"]
                    );
                    $array_data[] = $extra;
                    $final_data = json_encode($array_data);
                    if (file_put_contents('data.json', $final_data)) {
                         $message = "<label >File Appended Success fully</p>";
                    }

                    $content = file_get_contents("data.json");
                    $data = json_decode($content, true);
                    echo '<table class="table table-borderless">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>N° Phone</th>
                    </tr>
               </thead>';

                    foreach ($data as $row) {
                         echo '<table>
                
                <tbody>
                <td>' . $row["name"] . '</td>  <td>' . $row["lname"] . '</td>  <td>' . $row["phone"] . '</td><br><br>
                </tbody>
            </table> ';
                    }
               } else {
                    $error = 'JSON File not exits';
               }
          }
     }
     ?>
</body>

</html>