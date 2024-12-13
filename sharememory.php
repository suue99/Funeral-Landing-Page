<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="description"
      content="In Loving Memory | Rev Elijah O. Akinyemi"
    />
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="images/favicon.ico" />
    <title>Submit Tributes</title>
    <script
      src="https://kit.fontawesome.com/dafa6859c8.js"
      crossorigin="anonymous"
    ></script>

    <script defer src="script.js"></script>
  </head>

  <body>
    <?php include 'nav/header.php'; ?>

    <section class="form-container">
  <form id="contact" action="submit_tribute.php" method="post" enctype="multipart/form-data">
    <h3>Submit Your Tribute</h3>
    <fieldset>
      <input
        placeholder="Your full name"
        type="text"
        name="name"
        tabindex="1"
        required
        autofocus
      />
    </fieldset>

    <div class="dropdown">
      <label for="select-where">
        <span class="dropdown-text">Relationship</span></label
      >
      <select id="select-where" name="relationship" required>
        <option value="">Please choose an option</option>
        <option value="family">Family</option>
        <option value="friend">Friend</option>
        <option value="church">Church</option>
        <option value="work">Work</option>
        <option value="other">Other</option>
      </select>
    </div>

    <fieldset>
      <textarea
        placeholder="Type your Message Here...."
        name="message"
        tabindex="5"
        required
      ></textarea>
    </fieldset>

    <fieldset>
      <input
        placeholder="Your location (optional)"
        type="text"
        name="location"
        tabindex="6"
      />
    </fieldset>

    <fieldset>
      <input
        placeholder="Church Name (optional)"
        type="text"
        name="church_name"
        tabindex="7"
      />
    </fieldset>

    <fieldset>
      <label for="image-upload">Share picture memory (optional):</label>
      <input
        type="file"
        id="image-upload"
        name="image"
        accept="image/*"
      />
    </fieldset>

    <fieldset>
      <button
        name="submit"
        type="submit"
        id="contact-submit"
        data-submit="...Sending"
      >
        Submit Tribute
      </button>
    </fieldset>
  </form>
</section>


    <?php include 'nav/footer.php'; ?>

    <script
      type="module"
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"
    ></script>
  </body>
</html>
