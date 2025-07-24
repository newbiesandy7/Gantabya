<?php 
session_start();
include 'db_conn.php';
$logged = false;
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
	 $logged = true;
	 $user_id = $_SESSION['user_id'];
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contact Form</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="css/navbar_custom.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    :root {
    --primary-color: #6D9773;          /* Muted Green */
    --dark-accent: #0C3B2E;            /* Dark Forest Green */
    --button-color: #BB8A52;           /* Earthy Brown */
    --highlight-color: #FFBA00;        /* Vibrant Yellow */
    --text-color: #333333;
    --background-light: #f8f8f8;
    --container-bg: #fff;
    --border-color: #e0e0e0;
}
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: white;
      /* display: flex; */
   
      height: 100vh;
    }
    .contact-section {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
      padding: 20px;
    }

    .contact-container {
      background: white;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
      width: 90%;
      max-width: 900px;
      display: flex;
      overflow: hidden;
    }

    .contact-left, .contact-right {
      padding: 40px;
      flex: 1;
    }

    .contact-left {
      background: var(--primary-color);
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .contact-left h2 {
      margin-bottom: 20px;
      font-size: 30px;
      font-weight: 100;
      color: black;
    }

    .contact-left p {
      color: var(--text-color);
      font-size: 16px;
      line-height: 1.6;
    }

    form .field {
      margin-bottom: 15px;
      display: flex;
      flex-direction: column;
    }

    form label {
      margin-bottom: 5px;
      font-weight: 600;
      color: #333;
    }

    form input[type="text"], form textarea {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
    }

    form textarea {
      resize: vertical;
      height: 100px;
    }

    #button {
      background-color: var(--button-color);
      color: white;
      padding: 10px;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    #button:hover {
      background-color: var(--highlight-color);
      color:black;
    }

    #status {
      margin-top: 10px;
      font-weight: bold;
      color: #28a745;
    }

    @media (max-width: 768px) {
      .contact-container {
        flex-direction: column;
      }
    }
  </style>
  	
</head>
<body>
<nav>
<?php 
        include 'inc/NavBar.php';
	 ?>
   </nav>
   <section class="contact-section">
<div class="contact-container">
  <div class="contact-left">
    <h2>Get in Touch</h2>
    <p>We'd love to hear from you! Fill out the form on the right and we'll get back to you as soon as possible.</p>
    <p>Email: gantabya601@gmail.com.com<br>Phone: +123 456 7890</p>
  </div>

  <div class="contact-right">
    <form id="form">
      <div class="field">
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
      </div>
      <div class="field">
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
      </div>
      <div class="field">
        <label for="time">Subject</label>
        <input type="text" name="time" id="time">
      </div>
      <div class="field">
        <label for="message">Message</label>
        <input type="text" name="message" id="message">
      </div>
      <div class="field">
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
      </div>

      <input type="submit" id="button" value="Send Email">
      <div id="status"></div>
    </form>
  </div>
</div>
</section>
<!-- JavaScript -->
<script type="text/javascript"
  src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>

<script type="text/javascript">
  emailjs.init('KvLxRKTkuF3FGVR81')
</script>
  <script>
    
const btn = document.getElementById('button');

document.getElementById('form')
 .addEventListener('submit', function(event) {
   event.preventDefault();

   btn.value = 'Sending...';

   const serviceID = 'default_service';
   const templateID = 'template_ikkz07q';

   emailjs.sendForm(serviceID, templateID, this)
    .then(() => {
      btn.value = 'Send Email';
      alert('Sent!');
    }, (err) => {
      btn.value = 'Send Email';
      alert(JSON.stringify(err));
    });
});
   
  </script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
<?php 
        include 'inc/footer.php';
	 ?>
</body>
</html>
