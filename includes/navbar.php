<nav class="sticky-top nav-justified navbar navbar-expand-lg navbar-light bg-light main-nav small" style="width: 100%; font-size: medium;">
  <div class="container-fluid">
    <!-- Company name and logo -->
    <span class="ml-4 fs-5 col-8">
      <img src="img/logo.jpg" alt="Binary City" class="nav-logo"> Binary City Development Practical Test
    </span>

    <div class="collapse navbar-collapse float-right" id="navbarSupportedContent" style="text-align: right;">

      <ul class="nav navbar-nav">
        <li class="m-2"><a type="button" class="btn nav-btn btn-dark" onclick="showClient() , showTab(1)"> <i class="fa fa-user" aria-hidden="true"></i> Clients <span id="client-badge" class=" badge badge-light"></span> </a></li>
        <li class="m-2"><a type="button" class="btn nav-btn btn-dark" onclick="showContact(), showTab(4)"> <i class="fa fa-phone" aria-hidden="true"></i> Contacts <span id="contact-badge" class="badge badge-light"></span> </a></li>
        <li class="m-2"><a type="button" class="btn nav-btn btn-dark" onclick="showLink(), showTab(4)"> <i class="fa fa-link" aria-hidden="true"></i> Links <span id="link-badge" class="badge badge-light"></span></a></li>
        <li class="m-2"><span onclick="window.print()"><i class=" m-2 fa fa-print w-100" title="Print Page"></i></span></li>
      </ul>

    </div>

  </div>
</nav>