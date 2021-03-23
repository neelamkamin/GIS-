<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

#login-btn {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 49.5%;
}
#reset-btn {
  background-color: silver;
  color: blue;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 49.5%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 12px 0 6px 0;
}

img.avatar {
  width: 20%;
  border-radius: 30%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}
#info-mm{
    font-size: 25px;
    text-align: center;
  }


/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 600px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
  #info-mm{
    font-size: 10px;
  }
}
</style>

<link rel="stylesheet" type="text/css" href="<?= base_url("assests/css/bootstrap.min.css") ?>">
<title>REPORT MANAGEMENT SYSTEM AND ARUNACHAL DIGITAL MAP</title>
</head>
<body>
<button class="btn btn-primary" style="float:right"><a href="http://ditc.online/mm/msg.html" target="_blank">About us</a></button>

<button class="btn btn-primary" style="float:left"><a href="http://ditc.online/gis/gis.php" target="_blank">GIS-Digital Map of A.P</a></button>
  <br> <br>
<h3 id="info-mm" align="center"><i>Project Report Management System, Dept. of IT & C </i></h3>

<form action="Login/officer_login" method="post">
  <div class="imgcontainer">
    <img src="<?php echo base_url('assests/css/loGO.png'); ?>" alt="Avatar" class="avatar">
  </div>

        <div class="container">
          <label for="username"><b>Username</b></label>
          <input type="text" placeholder="Enter Username" name="username" required>

          <label for="password"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="password" required>
       
          <button id="login-btn" type="submit" name="submit">Login</button>
          <button id="reset-btn" type="reset" name="reset">Reset</button>
    </div>       
  </div>
</form>
</body>
</html>
