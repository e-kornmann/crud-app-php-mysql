<?php
session_start();
$errormessage = isset($_SESSION['errormessage']) ? $_SESSION['errormessage'] : "";
unset($_SESSION['errormessage']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="icon" href="favicon.svg" />
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fresh Portal - Employee list</title>
  <link href="css/reset.css" rel="stylesheet">
  <link href="css/form.css" rel="stylesheet">
  <link href="css/table.css" rel="stylesheet">
  <link href="css/header.css" rel="stylesheet">
  <link href="css/buttons.css" rel="stylesheet">
  <script src="js/domhandlers.js"></script>

</head>

<body>

<header>
    <?php include("components/header.php"); ?>
</header>
  <main>
    <?php include("components/tabel.php"); ?>
  </main>

  <?php include("components/form.php"); ?>
  <?php
  if ($errormessage) {
    echo "<script>openForm();</script>";
  } else if (isset($_GET['id'])) {
    echo "<script>openForm();</script>";
  }
  ?>

</body>
</html>
