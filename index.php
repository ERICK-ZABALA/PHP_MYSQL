
<?php
//------------VARIABLES SEARCH ----------------
$fname = "";
$lname = "";
$uname ="";
$pwd = "";
$email = "";
$phone = "";
$city = "";


//----------------------------VARIABLE DATA BASE MYSQL----------------
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forma";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";


if(isset($_GET['Register']))
{
    getData();
    dataInsert();
}

if (isset($_GET ['Remove']))
{
    getDataa();
    dataDelete ();
}
if (isset($_GET ['Change']))
{
    getData();
    dataUpdate();
}

if (isset($_GET ['Search']))
{

    dataFind();


    echo $lname;

}


function getData () {
    $data = array();
    $data [0] = $_GET['fname'];
    $data [1] = $_GET ['lname'];
    $data [2] = $_GET ['uname'];
    $data [3] = $_GET ['pwd'];
    $data [4] = $_GET ['email'];
    $data [5] = $_GET ['phone'];
    $data [6] = $_GET ['city'];

    return $data;
}

function getDataa () {
    $data = array();

    $data[0] = $_GET['email'];

    return $data;
}

function dataInsert() {

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forma";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


$info = getData();
$sql = "INSERT INTO formulario (Name, Last, Username, Password, Email, Phone, City) 
VALUES ('$info[0]','$info[1]', '$info[2]', '$info[3]', '$info[4]', '$info[5]', '$info[6]')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

}

function dataDelete () {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "forma";

// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $info = getDataa();

    $sql = "DELETE FROM formulario WHERE Email='$info[0]'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

}

function dataUpdate() {

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forma";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


$info = getData();
$sql = "UPDATE formulario SET Name='$info[0]' , Last='$info[1]', Username='$info[2]', Password='$info[3]', Email='$info[4]', Phone='$info[5]', 
                   City='$info[6]' WHERE Email='$info[4]'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}


function dataFind(){


    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "forma";

// Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);


    $info = getDataa();
    echo json_encode($info[0]);
    //echo json_encode($info);
    $search_Query = "SELECT * FROM formulario WHERE Email='$info[0]'";
    $search_Result = mysqli_query($conn, $search_Query);
    //echo json_encode($search_Query);
    //echo json_encode($search_Result);
    var_dump($search_Result); // es un objeto
    //object(mysqli_result)#3 (5) { ["current_field"]=> int(0) ["field_count"]=> int(7)
    //                              ["lengths"]=> NULL ["num_rows"]=> int(1) ["type"]=> int(0) }
    //while($row = mysqli_fetch_assoc($search_Result))
    //    $test[] = $row;
    //print json_encode($test);

    $row = mysqli_fetch_assoc($search_Result);
    // convert to array return all values about row MSQL
    // {"Name":"Sergio","Last":"Zabala","Username":"sergio",
    //"Password":"Cwse","Email":"sergio@hotmail.com","Phone":"514-345-2134","City":"montreal"}

    echo json_encode($row);
    // {"Name":"Sergio","Last":"Zabala","Username":"sergio",
    //"Password":"Cwse","Email":"sergio@hotmail.com","Phone":"514-345-2134","City":"montreal"}

    global $fname, $lname, $uname, $pwd, $email, $phone, $city;

    $fname = $row['Name'];
    $lname = $row['Last'];
    $uname = $row['Username'];
    $pwd = $row['Password'] ;
    $email = $row['Email'];
    $phone = $row['Phone'];
    $city = $row['City'];

}




?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="main.css">
    <title>PHP INSERT UPDATE DELETE SEARCH</title>
</head>

<body>
<form action="index.php" method="get">

    <h2>Register Form</h2><br>
    <label for="fname">First Name:</label>
    <input type="text" id="fname" name="fname" placeholder="Name" value="<?php echo $fname; ?>"><br><br>

    <label for="lname">Last Name:</label>
    <input type="text" id="lname" name="lname" placeholder="Last Name" value="<?php echo $lname; ?>"><br><br>

    <label for="uname">Username:</label>
    <input type="text" id="uname" name="uname" placeholder="Username" value="<?php echo $uname; ?>"><br><br>
    <label for="pwd">Password:</label>
    <input type="password" id="pwd" name="pwd" placeholder="Password" value="<?php echo $pwd; ?>"><br><br>

    <label for="email">Enter your email:</label>
    <input type="email" id="email" name="email" placeholder="username@mail.com" value="<?php echo $email; ?>"><br><br>

    <label for="phone">Mobile No:</label>
    <input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="514-430-0349" value="<?php echo $phone;?>"><br><br>

    <label for="city">City:</label>
    <select id="city" name="city" value="<?php echo $city;?>">
        <option value="montreal">Montreal</option>
        <option value="toronto">Toronto</option>
        <option value="vancouver">Vancouver</option>
        <option value="regina">Regina</option>
    </select><br><br>

    <button class="button"  type="submit"  name="Register">Register</button>
    <button class="button"  type="submit"  name="Remove">Remove</button>
    <button class="button"  type="submit"  name="Change">Change</button>
    <button class="button"  type="submit"  name="Search">Search</button>





</form>

</body>
</html>

