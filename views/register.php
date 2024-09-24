<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/register.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>

    <header class="header">
        <div class="avatar"></div> <!-- Avatar/Logo in the center -->
        <div class="title">Register</div>
    </header>

    <div class="container">
        <div class="form-container">
            <form action="register/create" method="POST" enctype="multipart/form-data">

                <div class="form-field">
                    <label for="first_name" class="label">First Name</label>
                    <input type="text" id="first_name" name="first_name" class="sms-input" placeholder="First Name" required>
                </div>
                <div class="form-field">
                    <label for="last_name" class="label">Last Name</label>
                    <input type="text" id="last_name" name="last_name" class="sms-input" placeholder="Last Name" required>
                </div>
                <div class="form-field">
                    <label for="middle_name" class="label">Middle Name</label>
                    <input type="text" id="middle_name" name="middle_name" class="sms-input" placeholder="Middle Name">
                </div>
                <div class="form-field gender-field">
                    <label class="label">Gender</label>
                    <label><input type="radio" name="gender" value="male" required> Male</label>
                    <label><input type="radio" name="gender" value="female" required> Female</label>
                </div>
                <div class="form-field">
                    <label for="year_level" class="label">Year Level</label>
                    <select id="year_level" name="year_level" class="sms-input" required>
                        <option value="" selected disabled>- Please Select -</option>
                        <option value="1st">1st</option>
                        <option value="2nd">2nd</option>
                        <option value="3rd">3rd</option>
                        <option value="4th">4th</option>
                        <option value="5th">5th</option>
                    </select>
                </div>
                <div class="form-field">
                    <label for="course" class="label">Course</label>
                    <input type="text" id="course" name="course" class="sms-input" placeholder="Year & Course" required>
                </div>
                <div class="form-field">
                    <label for="address" class="label">Address</label>
                    <input type="text" id="address" name="address" class="sms-input" placeholder="Address" required>
                </div>
                <div class="form-field">
                    <label for="email" class="label">Email (G Suite Account)</label>
                    <input type="email" id="email" name="email" class="sms-input" placeholder="Email" required>
                </div>
                <div class="form-field">
                    <label for="school" class="label">School</label>
                    <input type="text" id="school" name="school" class="sms-input" placeholder="School" required>
                </div>
                <div class="form-field">
                    <label for="guardian" class="label">Guardian</label>
                    <input type="text" id="guardian" name="guardian" class="sms-input" placeholder="Guardian" required>
                </div>
                <div class="form-field">
                    <label for="password" class="label">Password</label>
                    <input type="password" id="password" name="password" class="sms-input" placeholder="Password" required>
                </div>
                <div class="form-field">
                    <label for="confirm_password" class="label">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="sms-input" placeholder="Confirm Password" required>
                </div>
                <div class="form-field">
                    <label for="age" class="label">Age</label>
                    <input type="number" id="age" name="age" class="sms-input" placeholder="Age" required>
                </div>
                <div class="form-field">
                    <label for="sport" class="label">Sports</label>
                    <select name="sport" id="sport" class="sms-input">
                        <option value="" selected disabled>- Please Select -</option>
                        <?php foreach ($sports as $key => $value): ?>
                            <option value="<?= $key ?>"><?= $value ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-field">
                    <label for="phone_number" class="label">Phone Number</label>
                    <input type="tel" id="phone_number" name="phone_number" class="sms-input" placeholder="Phone Number (11 digits)" pattern="\d{11}" required>
                </div>
                <div class="form-field">
                    <label for="cor" class="label">Certificate of Registration (COR)</label>
                    <input type="file" id="cor" name="cor" accept=".pdf,.jpg,.png" required>
                    <div class="file-notes">Accepted file formats: PDF, JPG, PNG.</div>
                </div>
                <div class="form-field">
                    <label for="psa" class="label">PSA Birth Certificate</label>
                    <input type="file" id="psa" name="psa" accept=".pdf,.jpg,.png" required>
                    <div class="file-notes">Accepted file formats: PDF, JPG, PNG.</div>
                </div>
                <div class="form-field">
                    <label for="medical_cert" class="label">Medical Certificate</label>
                    <input type="file" id="medical_cert" name="medical_cert" accept=".pdf,.jpg,.png" required>
                    <div class="file-notes">Accepted file formats: PDF, JPG, PNG.</div>
                </div>
                <div class="form-field">
                    <label for="picture" class="label">2x2 Picture with White Background</label>
                    <input type="file" id="picture" name="picture" accept=".jpg,.png" required>
                    <div class="file-notes">Accepted file formats: JPG, PNG.</div>
                </div>
                <div class="checkbox-field">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">I agree to the <a href="terms">Terms and Conditions</a></label>
                </div>
                <div class="form-actions">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showConfirmation() {
            alert("Your registration has been submitted. Please wait up to 24 hours for registration validation.");
            // Optionally, you can use a `return false` here to prevent form submission for testing
            return true; // Continue with form submission
        }
    </script>


    <script src="assets/js/register.js"></script> <!-- Link to the external JavaScript file -->
</body>

</html>