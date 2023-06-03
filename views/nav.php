<nav class="nav justify-content-between">
    <a class="navbar-brand d-flex align-items-center" href="#"> 
        <span class="text-warning">Hotel &nbsp;</span> 
        <span class="text-light"> Management &nbsp;System </span>
    </a>
    <button data-bs-toggle="modal" data-bs-target="#signOutModal">
        <i class="fa fa-sign-out"></i>
    </button>
</nav>

<div class="modal fade" id="signOutModal" tabindex="-1" aria-labelledby="signOutModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="signOutModalLabel">Sign Out Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Do you really wish to log out from this account?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary"  data-dismiss="modal" onclick="window.location.href='logout.php'">Yes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>