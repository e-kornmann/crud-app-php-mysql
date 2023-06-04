<?php

$formData = $_SESSION['form_data'] ?? array();

$errorMessage = $_SESSION['errormessage'] ?? "";
unset($_SESSION['errormessage']);

$firstname = $formData['firstname'] ?? "";
$lastname = $formData['lastname'] ?? "";
$email = $formData['email'] ?? "";
$mobile = $formData['mobile'] ?? "";
$street = $formData['street'] ?? "";
$housenumber = $formData['housenumber'] ?? "";
$postalcode = $formData['postalcode'] ?? "";
$city = $formData['city'] ?? "";
$day = $formData['day'] ?? "";
$month = $formData['month'] ?? "";
$year = $formData['year'] ?? "";
$gender = $formData['gender'] ?? "";

if (isset($_GET['id'])) {
	unset($_SESSION['form_data']);
	echo "<div id='graybg'>&nbsp;</div>";
	echo "<form action='handlers/update.php' method='POST' id='employee-form'>";

	$id = $_GET['id'];
	$sql = "SELECT * FROM employee WHERE id = ?";
	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_bind_param($stmt, "i", $id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$employee = mysqli_fetch_assoc($result);
	mysqli_stmt_close($stmt);


	$birthday = isset($employee['birthdate']) ? $employee['birthdate'] : "";
	$birthdayParts = explode('-', $birthday);
	$empYear = isset($birthdayParts[0]) ? $birthdayParts[0] : "";
	$empMonth = isset($birthdayParts[1]) ? $birthdayParts[1] : "";
	$empDay = isset($birthdayParts[2]) ? $birthdayParts[2] : "";
} else {
	echo "<div id='graybg'>&nbsp;</div>";
	echo "<form action='handlers/create.php' method='POST' id='employee-form'>";
}
?>

<form action="handlers/update.php" method="POST" id="employee-form" onsubmit="return validateForm()">
	<fieldset>
		<div class="row">
			<input type="hidden" name="id" value="<?php echo isset($employee['id']) ? $employee['id'] : ""; ?>">

			<legend class="span">Your name</legend>
			<input 
				type="text" 
				placeholder="First name" 
				id="firstname" 
				class="firstname"
				name="firstname" 
				value="<?php echo isset($employee['firstname']) ? $employee['firstname'] : $firstname; ?>"
			>
			<input 
				type="text" 
				placeholder="Last name" 
				id="lastname" 
				class="lastname"
				name="lastname" 
				value="<?php echo isset($employee['lastname']) ? $employee['lastname'] : $lastname; ?>"
			>
		</div>
	</fieldset>
	<fieldset>
		<div class="row">
			<legend class="span">E-mail</legend>
			<input 
				class="span" 
				type="email" 
				placeholder="name@example.com"
				id="email" 
				name="email" 
				value="<?php echo isset($employee['email']) ? $employee['email'] : $email; ?>"
			>
		</div>
	</fieldset>
	<fieldset>
		<div class="row">
			<legend class="span">Mobile</legend>
			<input 
			 	class="span" 
				type="text" 
				placeholder="eg. +31 6 12 23 4568" 
				id="mobile" 
				name="mobile" 
				value="<?php echo isset($employee['mobile']) ? $employee['mobile'] : $mobile; ?>"
			>
		</div>
	</fieldset>
	<fieldset>
		<div class="row">
			<legend class="span">Address</legend>
			<input 
				type="text" 
				placeholder="Street" 
				id="street" 
				class="street" 
				name="street" 
				value="<?php echo isset($employee['street']) ? $employee['street'] : $street; ?>"
			>
			<input 
				type="text" 
				placeholder="No." 
				id="housenumber" 
				class="housenumber" 
				name="housenumber" 
				value="<?php echo isset($employee['housenumber']) ? $employee['housenumber'] : $housenumber; ?>"
			>
		</div>
		<div class="row">
			<input 
				type="text" 
				placeholder="1234 XX" 
				maxlength="7" 
				oninput="moveToNextField(event, 'city')" 
				id="postalcode" 
				class="postalcode" 
				name="postalcode" 
				value="<?php echo isset($employee['postalcode']) ? $employee['postalcode'] : $postalcode; ?>"
			>
			<input 
				type="text" 
				placeholder="City" 
				id="city" 
				class="city" 
				name="city" 
				value="<?php echo isset($employee['city']) ? $employee['city'] : $city; ?>"
			>
		</div>
	</fieldset>
	<fieldset>
		<div class="row">
			<div class="row__birthday">
				<legend class="span legend-dateofbirth">Date of birth</legend>
				<div class="birthday--field">
					<label for="day">Day</label>
					<input 
						type="text" 
						maxlength="2" 
						oninput="moveToNextField(event, 'month')" 
						placeholder="DD" 
						name="day" 
						value="<?php echo isset($empDay) ? $empDay : $day; ?>">
				</div>
				<div class="birthday--field">
					<label for="month">Month</label>
					<input 
						type="text" 
						maxlength="2" 
						oninput="moveToNextField(event, 'year')" 
						placeholder="MM" 
						id="month" 
						maxlength="2" 
						name="month" 
						value="<?php echo isset($empMonth) ? $empMonth : $month; ?>"
					>
				</div>
				<div class="birthday--field">
					<label for="year">Year</label>
					<input 
						type="text" 
						maxlength="4" 
						placeholder="YYYY" 
						id="year" 
						maxlength="4" 
						name="year" 
						value="<?php echo isset($empYear) ? $empYear : $year; ?>"
					>
				</div>
			</div>
			<div class="row__gender">
				<legend class="span legend__gender">Gender</legend>
				<div class="gender--field">
					<input 
						type="radio" 
						name="gender" 
						id="male" 
						value="male" 
						<?php echo (isset($employee['gender']) && $employee['gender'] === 'male') || $gender === 'male' ? 'checked' : ''; ?>
					>
					<label for="male" class="radio--label">Male</label>
					<input 
						type="radio" 
						name="gender" 
						id="female" 
						value="female" 
						<?php echo (isset($employee['gender']) && $employee['gender'] === 'female') || $gender === 'female' ? 'checked' : ''; ?>
					>
					<label for="female" class="radio--label">Female</label>
					<input 
						type="radio" 
						name="gender" 
						id="others" 
						value="others" 
						<?php echo (isset($employee['gender']) && $employee['gender'] === 'others') || $gender === 'others' ? 'checked' : ''; ?>
					>
					<label for="others" class="radio--label">Others</label>
				</div>
			</div>
		</div>
	</fieldset>
<div class="row buttons">
	<button class="main-button close" type="reset" name="close" value="close" onclick="closeForm()">Close</button>
	<button class="main-button submit" type="submit" name="submit" value="submit">Submit</button>
</div>

	<?php if (!empty($errormessage)) {
    echo '<div class="error">' . $errormessage . '</div>';
} ?>
</form>
