<!DOCTYPE HTML>
<head>
  <!-- Latest compiled and minified CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="stylesheet.css">
</head>

<!-------------------------------------------------------------------------------------------------------------------------------------->

<html>

<!-- Sign-up form -->
<body>
  
  <div class="min-vh-100 d-flex justify-content-center align-items-center bg-light">
    <form action="processsignup.php" method = "post">
        Firstname: <input type="text" name ="firstname"><br>
        Surname: <input type="text" name ="lastname"><br>
        Email: <input type="text" name ="email"><br>
        Password: <input type="password" name ="password"><br>
        Position: <select name="positionid">
            <option value="GK">GK</option>
            <option value="CB">CB</option>
            <option value="CM">CM</option>
            <option value="ST">ST</option>
            </select>
        
        <br><input type="submit" value="Submit">
       </form>
  </div>

</body>

</html> 
