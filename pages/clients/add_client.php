<section class="container">
  <span id="result"></span>
  <div class="col m-5 p-5">

    <div class="border border-secondary rounded text-black m-auto " style="max-width: 600px;">

      <p class="text-center h3 fw-bold mb-5 mx-1 mx-md-4 mt-4">Create New Client</p>

      <form class="mx-1 mx-md-4" id="client_form" action="php/save.php" method="post">
        <div class="align-items-center mb-4">
          <div class="form-outline flex-fill m-auto" style="max-width: 400px;">
            <label class="form-label" for="form3Example1c">
              <i class="fas fa-user fa-lg me-3 fa-fw"></i>Client Name
            </label>
            <input type="text" id="client_name" class="form-control" name="client_name" />
          </div>
        </div>

        <div class="align-items-center mb-4">
          <div class="form-outline flex-fill m-auto" style="max-width: 400px;">
            <label class="form-label" for="form3Example1c">
              <i class="fa fa-id-badge fa-lg me-3 fa-fw" aria-hidden="true"></i>Client Code
            </label>
            <input type="text" id="client_code" class="form-control" name="client_code" disabled />
          </div>
        </div>

        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
          <input name="create_client" class="btn btn-primary" value="Create" id="sub_client">
        </div>

      </form>

    </div>

  </div>

</section>