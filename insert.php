<?php

require 'config.inc.php';


$name = '';
$gender = '';
$color = '';
$password = '';

if (isset($_POST['submit'])) {

    $ok = true;

    if (!isset($_POST['name']) || $_POST['name'] === '') {      
        $ok = false;
        } else {      
        $name = $_POST['name'];          
    };
    if (!isset($_POST['password']) || $_POST['password'] === '') {      
        $ok = false;
        } else {      
        $password = $_POST['password'];          
    };
    if (!isset($_POST['gender']) || $_POST['gender'] === '') {
        $ok = false;
        } else { 
        $gender = $_POST['gender'];
    };
    if (!isset($_POST['color']) || $_POST['color'] === '') {
        $ok = false;
        } else { 
        $color = $_POST['color'];
    };  

    if($ok) {

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $db = new mysqli(
            MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE
        );
    
        $sql = sprintf(
            "INSERT INTO users (name, gender, color, hash) VALUES (
             '%s', '%s', '%s', '%s')", 
             $db->real_escape_string($name),
             $db->real_escape_string($gender),
             $db->real_escape_string($color),
             $db->real_escape_string($hash));

                $db->query($sql);
                echo '<p>User added.</p>';
                $db->close();

    }

}

readFile('header.tmpl.html');

?>

<form
    action=""
    method="post">
    User Name <input type="text" class="form-control" name="name" id="name" value="<?php
    echo htmlspecialchars($name, ENT_QUOTES);
    ?>"><br>
    <div class="form-group">
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password">
    </div>
        <div><label>Gender</label></div>
    <input type="radio" name="gender" value="f"<?php
        if ($gender === 'f'){
            echo ' checked';
        }
    ?>> 
    <label class="form-check-label" for="gender-f">female</label>
    <div class="form-check form-check-inline">
            <input type="radio" name="gender" value="m"<?php
        if ($gender === 'm'){
            echo ' checked';
        }
    ?>>
    <label class="form-check-label" for="gender-m">male</label>
    </div>
    <div class="form-check form-check-inline">
            <input type="radio" ]name="gender-o" value="o"<?php
        if ($gender === 'o'){
            echo ' checked';
        }
    ?>>    <label class="form-check-label" for="gender">other</label>
    </div>
   </div>
    <div class="form-group">
    <label for="color">Favorite color</label> 
    <select class="form-control" name="color">
        <option value="">Please Select</option>
        <option value="#f00"<?php
        if ($color === '#f00'){
            echo ' selected';
        }
    ?>>Red</option>
        <option value="#0f0"<?php
        if ($color === '#0f0'){
            echo ' selected';
        }
    ?>>Green</option>
        <option value="#00f"<?php
        if ($color === '#00f'){
            echo ' selected';
        }
    ?>>Blue</option>
    </select>
    </div>

    <input type="submit" name="submit" value="Register">
</form>

<?php
    readfile('footer.tmpl.html');
?>