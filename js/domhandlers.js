const moveToNextField = (event, nextFieldId) => {
    const input = event.target;
    const maxLength = input.getAttribute('maxlength');

    if (input.value.length >= maxLength) {
        const nextInput = document.getElementById(nextFieldId);
        nextInput.focus();
    }
  }

const closeForm = () => {
    window.location.href = 'handlers/unset_session_data.php';
    document.getElementById("employee-form").style.display = "none";
    document.getElementById("graybg").style.display = "none"
}

const openForm = () => {
    setTimeout(() => {
      document.getElementById("employee-form").style.display = "block";
      document.getElementById("graybg").style.display = "block";
    }, 50);
  }