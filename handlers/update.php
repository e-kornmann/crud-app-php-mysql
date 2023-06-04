<?php

include("../database/connect.php");
include("../handlers/validateform.php");

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $street = $_POST['street'];
    $housenumber = $_POST['housenumber'];
    $postalcode = $_POST['postalcode'];
    $city = $_POST['city'];
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $gender = $_POST['gender'] ?? "";
    $birthdate = $year . "-" . $month . "-" . $day;

    session_start();

    $_SESSION['form_data'] = array(
      'firstname' => $firstname,
      'lastname' => $lastname,
      'email' => $email,
      'mobile' => $mobile,
      'street' => $street,
      'housenumber' => $housenumber,
      'postalcode' => $postalcode,
      'city' => $city,
      'day' => $day,
      'month' => $month,
      'year' => $year,
      'gender' => $gender
    );

    $errorMessage = validateForm($_SESSION['form_data']);

    if ($errorMessage !== "") {
      $_SESSION['errormessage'] = $errorMessage;
      header('Location: ../');
      exit();
    }

    $sql = "UPDATE employee 
            SET 
              firstname = ?, 
              lastname = ?, 
              email = ?, 
              mobile = ?, 
              street = ?, 
              housenumber = ?, 
              postalcode = ?, 
              city = ?, 
              birthdate = ?, 
              gender = ?
            WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param(
      $stmt, 
      "ssssssssssi", 
      $firstname, 
      $lastname, 
      $email, 
      $mobile, 
      $street, 
      $housenumber, 
      $postalcode, 
      $city, 
      $birthdate, 
      $gender, 
      $id
    );
    


    try {
        mysqli_stmt_execute($stmt);
        header('Location: ../');
        unset($_SESSION['form_data']);
        exit();
    } catch (mysqli_sql_exception $e) {
        $_SESSION['errormessage'] = "Could not update employee! Error: " . $e->getMessage();
        header('Location: ../');
        exit();
    }
}

mysqli_close($conn);
header('Location: ../');
exit();


?>