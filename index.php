<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foundation for Sites</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" type="text/css" href="css/foundation-prototype.css">
    <link rel="stylesheet" href="css/app.css">
  </head>
  <body>
  <div class="grid-container">
  <div class="grid-x">

      <div class="cell large-6">
        <h1 class="margin-1">Ajax Address Book</h1>
      </div>
      <div class="cell large-6">
        <div class="clearfix"><a href="#" class="add-btn button float-right meduim margin-2 radius bordered shadow primary" data-open="myModel">Add Contact</a></div>
      </div>

  </div>
</div>

          <div id="myModel" class="large reveal" data-reveal data-animation-in="scale-in-up fast" data-animation-out="slide-out-up fast">
          <h2>Add Contacts</h2>
          <form id="addContant" method="post">
            <div class="grid-x">
              <div class="cell large-6 padding-right-1">
                <label>First Name
                      <input name="first_name" type="text" placeholder="Enter First name"/>
                </label>
              </div>
                <div class="cell large-6">
                <label>Last Name
                      <input name="last_name" type="text" placeholder="Enter Last name"/>
                </label>
              </div>
          </div>
          <div class="grid-x">
              <div class="cell large-4 padding-right-1">
                <label>Email
                      <input name="email" type="email" placeholder="Enter your email">
                </label>
                </div>
                <div class="cell large-4 padding-right-1">
                <label>Phone number
                      <input name="phone" type="text" placeholder="Enter Phone number">
                </label>
              </div>
              <div class="cell large-4">
                <label>Contact group
                      <select name="contact_group">
                        <option value="husker">Family</option>
                        <option value="starbucks">Friends</option>
                        <option value="hotdog">Business</option>
                      </select>
                </label>
              </div>
            
          </div>
          <div class="grid-x">
              <div class="cell large-6 padding-right-1">
                <label>Address1
                      <input name="address1" type="text" placeholder="Enter address">
                </label>
                </div>
                <div class="cell large-6">
                <label>Address2
                      <input name="address2" type="text" placeholder="Enter Address">
                </label>
              </div>
          </div>
          <div class="grid-x">
              <div class="cell large-4 padding-right-1">
                <label>City
                      <input name="city" type="text" placeholder="Enter your city">
                </label>
                </div>
                <div class="cell large-4 padding-right-1">
                <label>Zipcode
                      <input name="zipcode" type="text" placeholder="Enter Zipcode">
                </label>
              </div>
              <div class="cell large-4">
                <label>State
                      <select name="state">
                        <option value="AL">Alabama</option>
                        <option value="CA">California</option>
                        <option value="HI">Hawaii</option>
                      </select>
                </label>
              </div>
          </div>
          <div class="grid-x">
              <div class="cell large-12">
                <label>Notes
                      <textarea name="notes" placeholder="Enter Notes"></textarea>
                </label>
            </div>
          </div>
          <input type="submit" class="add-btn button float-right meduim" name="submit" value="submit">
          </form>
          <button class="close-button" data-close aria-label="Close modal" type="button">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="loader"></div>
        <div id="pageContent">
          
        </div>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
