<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" teype="text/css" href="hmainstyle.css">
  <link rel="stylesheet" teype="text/css" href="./new.css">
  <link rel="stylesheet" teype="text/css" href="footer.css">
  <link rel="stylesheet" teype="text/css" href="sliderc.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">


  <?php include './mainlink.php' ?>


  <title>Career</title>


  <!-- css -->
  <style>
    .apply-box {
      max-width: 600px;
      padding: 35px;
      background-color: #fff;
      margin: 0 auto;
      margin-top: 50px;
      border-radius: 50px;
      box-shadow: 4px 0px 16px rgba(1, 1, 1, 0.1);
      margin-bottom: 50px;
    }

    .title_small {
      font-size: 20px;
      color: orangered;
    }

    .form_container {
      margin-top: 20px;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
    }

    .careerh1 {
      color: #2A4A7C;
    }

    .form_control {
      display: flex;
      flex-direction: column;
    }

    .textarea_control {
      grid-column: 1 / span 2;
    }

    .textarea_control textarea {
      width: 100%;
    }

    label {
      font-size: 15px;
      margin-bottom: 5px;
      color: #2A4A7C;
    }

    input,
    select,
    textarea {
      padding: 6px 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 15px;
    }

    input:focus,
    textarea:focus,
    select:focus {
      outline-color: red;
    }

    .button_container {
      display: flex;
      justify-content: flex-end;
      margin-top: 20px;
    }

    .button_container button {
      background: #2A4A7C;
      border: transparent solid 2px;
      padding: 5px 10px;
      color: #fff;
      border-radius: 10px;
      transition: 0.3s ease-in;
      cursor: pointer;
    }

    @media screen and (max-width: 550px) {
      .textarea_control {
        grid-column: 1 / span 1;
      }
    }
  </style>

</head>

<body>
  <?php include './header.php'; ?>
  <div class="container">
    <div class="apply-box">
      <h1 class="careerh1">
        Job Applicaiton
      </h1>
      <!-- form starts -->
      <form action="#">
        <div class="form_container">
          <div class="form_control">
            <label for="first">First Name</label>
            <input type="text" name="first" id="first" placeholder="Enter first name" required>
          </div>
          <div class="form_control">
            <label for="last">Last Name</label>
            <input type="text" name="last" id="last" placeholder="Enter last name" required>
          </div>
          <div class="form_control">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter email id" required>
          </div>
          <!-- <div class="form_control">
                <label for="job_role">Job Role</label>
              <select name="job_role" id="job_role">
                  <option value="null">Choose Job Role</option>
                  <option value="frontend">FrontEnd</option>
                  <option value="backend">BackEnd</option>
                  <option value="ui">UI-Development</option>
                  <option value="mobile">Mobile App Development</option>
              </select>
            </div> -->
          <div class="textarea_control">
            <label for="address">Address</label>
            <textarea name="address" id="address" cols="50" rows="4" required></textarea>
          </div>
          <div class="form_control">
            <label for="city">City</label>
            <input type="text" name="city" id="city" placeholder="Enter city name" required>
          </div>
          <div class="form_control">
            <label for="pin">Pincode</label>
            <input type="number" name="pin" id="pin" placeholder="Enter Pin Code" required>
          </div>
          <div class="form_control">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" value="2023-07-21" required>
          </div>
          <div class="form_control">
            <label for="cv">Upload CV</label>
            <input type="file" name="cv" id="cv" required>
          </div>
        </div>
        <div class="button_container">
          <button type="submit">Apply Now</button>
        </div>
      </form>
      <!-- form end -->
    </div>
  </div>

  <?php include './footer.php'; ?>
</body>

</html>