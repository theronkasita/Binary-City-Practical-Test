<section class="container">
  <span id="result"></span>
  <div class="col m-5 p-5">

    <div class="border border-secondary rounded text-black m-auto " style="max-width: 600px;">

      <p class="text-center h3 fw-bold mb-5 mx-1 mx-md-4 mt-4">Create New Contact</p>

      <form class="mx-1 mx-md-4" id="contact_form" action="php/save.php" method="post">
        <div class="align-items-center mb-4">
          <div class="form-outline flex-fill m-auto" style="max-width: 400px;">
            <label class="form-label" for="form3Example1c">
              <i class="fas fa-user fa-lg me-3 fa-fw"></i>Contact Name
            </label>
            <input type="text" id="contact_name" class="form-control" name="contact_name" required />
          </div>
        </div>

        <div class="align-items-center mb-4">
          <div class="form-outline flex-fill m-auto" style="max-width: 400px;">
            <label class="form-label" for="form3Example1c">
              <i class="fa fa-user fa-lg me-3 fa-fw" aria-hidden="true"></i>Contact Surname
            </label>
            <input type="text" id="contact_surname" class="form-control" name="contact_surname" required />
          </div>
        </div>

        <div class="align-items-center mb-4">
          <div class="form-outline flex-fill m-auto" style="max-width: 400px;">
            <label class="form-label" for="form3Example1c">
              <i class="fa fa-envelope fa-lg me-3 fa-fw" aria-hidden="true"></i>Email Address
            </label>
            <input type="email" id="email_address" class="form-control" name="contact_email_address" required />
          </div>
        </div>

        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
          <input name="create_contact" class="btn btn-primary" value="Create" id="sub_contact">
        </div>

      </form>

    </div>

  </div>

</section>
