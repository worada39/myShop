<!DOCTYPE html>
<html>
<head>
  <title>Book-O-Rama Display</title>
</head>
<body>
  <h1>Book-O-Rama Display</h1>
  <?php
    // create short variable names
    $db = new mysqli('localhost', 'root', '', 'books');
    if (mysqli_connect_errno()) {
       echo '<p>Error: Could not connect to database.<br/>
       Please try again later.</p>';
       exit;
    }
    $query = "SELECT ISBN, Author, Title, Price FROM Books ";
    $stmt = $db->prepare($query);  
    $stmt->execute();
    $stmt->store_result();
  
    $stmt->bind_result($isbn, $author, $title, $price);
    echo "<p>Number of books found: ".$stmt->num_rows."</p>";
    while($stmt->fetch()) {
      echo "<p><strong>Title: ".$title."</strong>";
      echo "<br />Author: ".$author;
      echo "<br />ISBN: ".$isbn;
      echo "<br />Price: \$".number_format($price,2)."</p>";
    }
    $stmt->free_result();
    $db->close();
  ?>
</body>
</html>