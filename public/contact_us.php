<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
    <h2>Contact Us</h2>
    <form action="send_message.php" method="POST" class="contact-form">
      <label for="name">Name</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>

      <label for="subject">Subject</label>
      <input type="text" id="subject" name="subject" required>

      <label for="message">Message</label>
      <textarea id="message" name="message" rows="5" required></textarea>

      <button type="submit">Send Message</button>
    </form>
  </div>
    <?php include 'footer.php'; ?>
</body>

</html>