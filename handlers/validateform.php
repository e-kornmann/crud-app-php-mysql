<?php

function validateForm($formData) {
  $validationRules = array(
    'email' => array(
      'error' => "Please enter the employee's email",
      'condition' => $formData['email'] === ""
    ),
    'day' => array(
      'error' => "Invalid day",
      'condition' => ($formData['day'] === '' || !ctype_digit($formData['day']) || $formData['day'] < 1 || $formData['day'] > 31)
    ),
    'month' => array(
      'error' => "Invalid month",
      'condition' => ($formData['month'] === '' || !ctype_digit($formData['month']) || $formData['month'] < 1 || $formData['month'] > 12)
    ),
    'year' => array(
      'error' => "Invalid year",
      'condition' => ($formData['year'] === '' || !ctype_digit($formData['year']) || $formData['year'] < 1900 || $formData['year'] > 2023)
    )
  );

  foreach ($validationRules as $field => $rule) {
    if ($rule['condition']) {
      return $rule['error'];
    }
  }

  return ""; 
}
?>