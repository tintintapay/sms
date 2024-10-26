<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="assets/css/faqs.css">
  <link rel="stylesheet" href="vendor/fontawesome-6.5.1/css/all.min.css">
  <title>FAQs</title>
</head>

<body>
  <?php include_once 'common/nav.php'; ?>
  <div class="background-image"></div>
  <div class="dark-overlay"></div>
  <div class="card" style="width: 800px">
    <h2>Frequently Asked Questions</h2>
    <hr>
    <h3>Forgotten Password - Email Token Recovery</h3>
    <div class="accordion">
      <div class="accordion-item">
        <div class="accordion-header" onclick="toggleAccordion(this)">
          How do I request a password reset?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-body">
          Click on the "Forgot Password?" link on the login page and enter your email address. You’ll receive a token
          via email.
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header" onclick="toggleAccordion(this)">
          I didn’t receive the email. What should I do?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-body">
          Check your spam or junk folder. If it's not there, ensure you entered the correct email address and try
          resending the token.
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header" onclick="toggleAccordion(this)">
          How long is the token valid?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-body">
          The token is typically valid for 5 minutes. If it expires, you’ll need to request a new one.
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header" onclick="toggleAccordion(this)">
          What do I do with the token?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-body">
          Enter the token in the password reset page to verify your identity, then follow the prompts to create a new
          password.
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header" onclick="toggleAccordion(this)">
          Can I change my password without a token?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-body">
          No, the token is required for security reasons to verify your identity before allowing a password reset.
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header" onclick="toggleAccordion(this)">
          What if I forget the new password I just set?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-body">
          You can repeat the password reset process using the "Forgot Password?" link again.
        </div>
      </div>
    </div>
    <hr>
    <h3>Submitting Evaluations for Selective Athletes</h3>
    <div class="accordion">
      <div class="accordion-item">
        <div class="accordion-header" onclick="toggleAccordion(this)">
          Who can see the evaluation button on the schedule?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-body">
          Only athletes selected by the coordinator will have access to the evaluation button on their schedule.
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header" onclick="toggleAccordion(this)">
          How do I submit my evaluation?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-body">
          Click the evaluation button on your schedule, fill out the required fields, and submit the form.
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header" onclick="toggleAccordion(this)">
          What happens if I can’t see the evaluation button?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-body">
          If you don’t see the button, it means you were not selected for evaluation. Contact the coordinator for
          clarification.
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header" onclick="toggleAccordion(this)">
          Is there a deadline for submitting evaluations?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-body">
          Yes, please check the schedule for specific submission deadlines to ensure your evaluation is considered.
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header" onclick="toggleAccordion(this)">
          Can I edit my evaluation after submission?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-body">
          Typically, evaluations cannot be edited once submitted. If you need to make changes, contact the coordinator
          directly.
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header" onclick="toggleAccordion(this)">
          What if I have technical issues submitting my evaluation?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-body">
          If you encounter any problems, please reach out to technical support or your coordinator for assistance.
        </div>
      </div>
    </div>
    <hr>
    <h3>Allowance Distribution for Athletes</h3>
    <div class="accordion">
      <div class="accordion-item">
        <div class="accordion-header" onclick="toggleAccordion(this)">
          How will I know when the allowance will be distributed?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-body">
          The admin will create an announcement detailing the venue and time of distribution for each campus.
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header" onclick="toggleAccordion(this)">
          How do I verify if I have received my allowance?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-body">
          Athletes must log into their accounts to check their allowance status and verify if they have received it.
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header" onclick="toggleAccordion(this)">
          What if I don’t see an announcement about the allowance distribution?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-body">
          If there’s no announcement, check back later or contact the admin for updates regarding distribution.
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header" onclick="toggleAccordion(this)">
          Can I check my allowance status before the distribution date?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-body">
          No , only updated allowance status is you can view.
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header" onclick="toggleAccordion(this)">
          What should I do if I believe there’s an error in my allowance distribution?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-body">
          Contact the admin immediately to address any discrepancies or issues with your allowance.
        </div>
      </div>
    </div>
    <hr>
    <h3>How Coordinators Rate Athletes</h3>
    <div class="accordion">
      <div class="accordion-item">
        <div class="accordion-header" onclick="toggleAccordion(this)">
          How does the coordinator rate athletes?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-body">
          Ratings are based on data reported by coaches or members of the sports organization, including performance
          metrics, points, scores, standings, and rankings.
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header" onclick="toggleAccordion(this)">
          Where can I view my rating?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-body">
          Athletes can view their ratings in the "Profile" section of their accounts, under "Stats."
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header" onclick="toggleAccordion(this)">
          Will I be informed about my rating?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-body">
          Yes, athletes will be informed by the use of the Profiling Stats on their accounts.
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header" onclick="toggleAccordion(this)">
          Can I see the data that influenced my rating?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-body">
          Yes, you can view the detailed data, including scores and match details, by accessing your profile stats.
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header" onclick="toggleAccordion(this)">
          What if I disagree with my rating?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-body">
          If you have concerns about your rating, please discuss them with the coordinator for clarification.

        </div>
      </div>
    </div>
    <hr>
    <h3>Athlete Registration</h3>
    <div class="accordion">
      <div class="accordion-item">
        <div class="accordion-header" onclick="toggleAccordion(this)">
          How do I access the registration system?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-body">
          Athletes must access the website to went to home page in which the registration button place below the login
          button.
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header" onclick="toggleAccordion(this)">
          Is there a deadline for registration?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-body">
          No, the registration has no expiration, so you can complete it at your convenience.
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header" onclick="toggleAccordion(this)">
          What information do I need to provide during registration?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-body">
          You’ll need to enter personal details such as your name, contact information, certificate of registration, 2*2
          picture and etc.
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header" onclick="toggleAccordion(this)">
          Can I edit my registration details after submitting?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-body">
          No, you cannot edit your registration details. Only the coordinator can allow changes.
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header" onclick="toggleAccordion(this)">
          What if I encounter issues during registration?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-body">
          If you have issues, refer to the FAQ section on the website or contact the coordinator’s support team for
          assistance.
        </div>
      </div>
    </div>
  </div>



  <script>
    function toggleAccordion(element) {
      const allHeaders = document.querySelectorAll('.accordion-header');
      const allBodies = document.querySelectorAll('.accordion-body');

      // Close all other accordion items
      allHeaders.forEach(header => {
        if (header !== element) {
          header.classList.remove('active');
          header.querySelector('i').classList.replace('fa-chevron-up', 'fa-chevron-down');
        }
      });
      allBodies.forEach(body => {
        if (body.previousElementSibling !== element) {
          body.style.display = 'none';
        }
      });

      // Toggle the clicked accordion item
      element.classList.toggle('active');
      const body = element.nextElementSibling;
      const icon = element.querySelector('i');

      if (element.classList.contains('active')) {
        body.style.display = 'block';
        icon.classList.replace('fa-chevron-down', 'fa-chevron-up');
      } else {
        body.style.display = 'none';
        icon.classList.replace('fa-chevron-up', 'fa-chevron-down');
      }
    }
  </script>

</body>

</html>