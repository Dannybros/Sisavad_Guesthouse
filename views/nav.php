<nav class="nav justify-content-between align-items-center">
    <a class="navbar-brand d-flex align-items-center" href="#"> 
        <div class="text-warning me-2" data-i18n="nav.span1"></div> 
        <div class="text-light" data-i18n="nav.span2"></div> 
    </a>
    <div class="d-flex">

      <div class="btn-group bg-light me-5">
        <button class="btn text-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="assets/img/en-flag.png" id="curr_lang" height="20" alt=""/>
        </button>
        <ul class="dropdown-menu" id="language-list">
        </ul>
      </div>
      
      <button class="text-white" onclick="logOut()">
        <i class="fa fa-sign-out"></i>
      </button>
    </div>
</nav>
