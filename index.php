<!DOCTYPE html>
<html>
<head>
  <title>User Details Form</title>
  <style>
    .form-container {
      max-width: 400px;
      margin: 0 auto;
    }

    .form-container label,
    .form-container input,
    .form-container button {
      display: block;
      margin-bottom: 10px;
    }

    .form-container button {
      padding: 10px 20px;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <form id="user-form">
      <label for="name">Name:</label>
      <input type="text" id="name" required>
      
      <label for="age">Age:</label>
      <input type="number" id="age" required>
      
      <label for="weight">Weight:</label>
      <input type="number" id="weight" required>
      
      <label for="email">Email:</label>
      <input type="email" id="email" required>
      
      <label for="pdf">PDF Upload:</label>
      <input type="file" id="pdf" accept=".pdf">
      
      <button type="submit">Submit</button>
    </form>
  </div>

  <script>
    document.getElementById('user-form').addEventListener('submit', function(e) {
      e.preventDefault();

      var name = document.getElementById('name').value;
      var age = document.getElementById('age').value;
      var weight = document.getElementById('weight').value;
      var email = document.getElementById('email').value;
      var pdf = document.getElementById('pdf').files[0];

      // Create a FormData object to send the data to PHP
      var formData = new FormData();
      formData.append('name', name);
      formData.append('age', age);
      formData.append('weight', weight);
      formData.append('email', email);
      formData.append('pdf', pdf);

      // Send the form data to the PHP file
      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'insert_user_details.php', true);
      xhr.onload = function() {
        if (xhr.status === 200) {
          // Success message or redirect
          alert(xhr.responseText);
        } else {
          // Error message
          alert('Error: ' + xhr.status);
        }
      };
      xhr.send(formData);
    });
  </script>
</body>
</html>
