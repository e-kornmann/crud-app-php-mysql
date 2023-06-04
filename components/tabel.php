<?php
include("database/connect.php");

$sql = "SELECT * FROM employee";
$result = mysqli_query($conn, $sql);

?>

<table class="employee-table">
  <thead>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Mobile</th>
      <th>Address</th>
      <th>Birthdate</th>
      <th>Gender</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <tr>
          <td><?php echo $row["firstname"] . "&nbsp;" . $row["lastname"]; ?></td>
          <td><?php echo $row["email"]; ?></td>
          <td><?php echo $row["mobile"]; ?></td>
          <td><?php echo $row["street"] . " " . $row["housenumber"];
              if (!empty($row["street"]) || !empty($row["housenumber"])) {
                echo ",<br>";
              }
              echo $row["postalcode"] . " " . $row["city"]
              ?></td>
          <td><?php echo date('d-m-Y', strtotime($row["birthdate"])); ?></td>
          <td><?php echo $row["gender"]; ?></td>

          <td class="employee-table--buttoncell">
            <a class="main-button" onclick="openForm()" href="index.php?id=<?php echo $row['id']; ?>"><img class="icons" src="assets/icons/icon_edit.svg"></a>
            <a class="main-button" href="handlers/delete.php?id=<?php echo $row['id']; ?>"><img class="icons" src="assets/icons/icon_trash.svg"></a>
          </td>
        </tr>
    <?php
      } 


    } else {
      echo '<tr><td colspan="6">There are no employees in this list.</td></tr>';
      

    }
    ?>
  </tbody>
</table>