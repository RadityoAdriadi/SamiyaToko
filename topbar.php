<div class="topbar"> 
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-6">
        <div class="contact">
          <ul>
            <li>
              <?php if(isset($_SESSION['pelanggan']))
              {
                echo "<i class='fas fa-user-alt'></i>";
                echo "&nbsp;";
                echo $_SESSION['pelanggan']['nama_pelanggan'];
                echo "&nbsp;";
                echo "<a href='logout.php' class='btn btn-danger btn-sm'>Logout</a>";
              }
              ?>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>