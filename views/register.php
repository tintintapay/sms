<?php require_once 'views/config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vendor/fontawesome-6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/register.css">
    <script src="vendor/jquery/jquery-3.7.1.js"></script>
    <script src="assets/js/toggle-password.js"></script>
    <title>Register</title>
</head>

<body>
    <?php include_once 'common/nav.php'; ?>
    <div class="background-image"></div>
    <div class="dark-overlay"></div>
    <div class="container">
        <div class="welcome-msg">
            <img src="assets/images/sportan-logo.png" style="width:250px" alt="">
            <h1>Register</h1>
        </div>
        <div class="card" style="width: 500px; height: 550px; overflow:auto">
            <form action="register" method="POST" enctype="multipart/form-data">
                <div class="msg" style="display:<?php echo !empty($flash['message']) ? 'block' : 'none' ?>">
                    <?php echo $flash['message'] ?? ''; ?>
                </div>
                <div class="form-field">
                    <label for="first_name" class="label">First Name</label>
                    <input type="text" id="first_name" name="first_name" class="sms-input" value="<?= $request['first_name'] ?? ''?>" placeholder="First Name"
                        required>
                </div>
                <div class="form-field">
                    <label for="last_name" class="label">Last Name</label>
                    <input type="text" id="last_name" name="last_name" class="sms-input" value="<?= $request['last_name'] ?? '' ?>" placeholder="Last Name"
                        required>
                </div>
                <div class="form-field">
                    <label for="middle_name" class="label">Middle Name</label>
                    <input type="text" id="middle_name" name="middle_name" class="sms-input" value="<?= $request['middle_name'] ?? '' ?>" placeholder="Middle Name">
                </div>
                <div class="form-field gender-field">
                    <label class="label">Gender</label>
                    <label><input type="radio" name="gender" value="male" <?= isset($request['gender']) && $request['gender'] === 'male' ? 'checked' : ''?> required> Male</label>
                    <label><input type="radio" name="gender" value="female" <?= isset($request['gender']) && $request['gender'] === 'female' ? 'checked' : '' ?> required> Female</label>
                </div>
                <div class="form-field">
                    <label for="year_level" class="label">Year Level</label>
                    <select id="year_level" name="year_level" class="sms-input" required>
                        <option value="" selected disabled>- Please Select -</option>
                        <option value="1st" <?= isset($request['year_level']) && $request['year_level'] === '1st' ? 'selected' : '' ?>>1st</option>
                        <option value="2nd" <?= isset($request['year_level']) && $request['year_level'] === '2nd' ? 'selected' : '' ?>>2nd</option>
                        <option value="3rd" <?= isset($request['year_level']) && $request['year_level'] === '3rd' ? 'selected' : '' ?>>3rd</option>
                        <option value="4th" <?= isset($request['year_level']) && $request['year_level'] === '4th' ? 'selected' : '' ?>>4th</option>
                        <option value="5th" <?= isset($request['year_level']) && $request['year_level'] === '5th' ? 'selected' : '' ?>>5th</option>
                    </select>
                </div>
                <div class="form-field">
                    <label for="course" class="label">Course</label>
                    <input type="text" id="course" name="course" class="sms-input" value="<?= $request['course'] ?? '' ?>" placeholder="Course" required>
                </div>
                <div class="form-field">
                    <label for="address" class="label">Address</label>
                    <input type="text" id="address" name="address" class="sms-input" value="<?= $request['address'] ?? '' ?>" placeholder="Address" required>
                </div>
                <div class="form-field">
                    <label for="email" class="label">Email (G Suite Account)</label>
                    <input type="email" id="email" name="email" class="sms-input" value="<?= $request['email'] ?? '' ?>" placeholder="Email" required>
                </div>
                <div class="form-field">
                    <label for="school" class="label">Campus</label>
                    <!-- <input type="text" id="school" name="school" class="sms-input" placeholder="Campus" required> -->
                    <select name="school" id="school" class="sms-input" required>
                        <option value="" selected disabled>- Please Select -</option>
                        <?php foreach ($schools as $key => $value): ?>
                            <option value="<?= $key ?>" <?= isset($request['school']) && $request['school'] === $key ? 'selected' : '' ?>><?= $value ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-field">
                    <label for="guardian" class="label">Guardian</label>
                    <input type="text" id="guardian" name="guardian" class="sms-input" value="<?= $request['guardian'] ?? '' ?>" placeholder="Guardian" required>
                </div>
                <div class="form-field">
                    <label for="birthday" class="label">Birth Day</label>
                    <input type="date" id="birthday" name="birthday" class="sms-input" value="<?= $request['birthday'] ?? '' ?>" max="<?= (new DateTime())->modify('-15 years')->format('Y-m-d');?>" placeholder="Birth Day" required>
                </div>

                <div class="form-field">
                    <label for="sport" class="label">Sports</label>
                    <select name="sport" id="sport" class="sms-input">
                        <option value="" selected disabled>- Please Select -</option>
                        <?php foreach ($sports as $key => $value): ?>
                            <option value="<?= $key ?>" <?= isset($request['sport']) && $request['sport'] === $key ? 'selected' : '' ?>><?= $value ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-field">
                    <label for="phone_number" class="label">Phone Number</label>
                    <input type="tel" id="phone_number" name="phone_number" class="sms-input"  value="<?= $request['phone_number'] ?? '' ?>"
                        placeholder="Phone Number (11 digits)" pattern="\d{11}" required>
                </div>

                <hr>

                <div class="form-field" style="position:relative">
                    <label for="password" class="label">Password</label>

                    <input type="password" class="toggle-password sms-input" id="password" name="password"
                        placeholder="Password" style="padding-right: 30px; width:calc(100% - 44px)">
                    <i class="fa-solid fa-eye" id="togglePassword"
                        style="position: absolute; right: 10px; top: 55%; transform: translateY(-50%); cursor: pointer;"></i>

                </div>
                <div class="form-field">
                    <label for="confirm_password" class="label">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password"
                        class="toggle-password sms-input" placeholder="Confirm Password" required>
                </div>

                <hr>

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


</body>

</html>