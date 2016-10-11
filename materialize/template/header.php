  <!DOCTYPE html>
  <?php
  include 'core/init.php';
  include "template/head.php";
  if(logged_in()){
    $user=$_SESSION['user_name'];
    $email=$_SESSION['email'];
  }
  else
    $user="Login/Register";
  ?>
  <body>
    <header>
     <!-- Dropdown Structure -->
    
     <ul id="dropdown1" class="dropdown-content">
      <?php
      if($result=$db->query("SELECT * From categorylist")){
        while($row=$result->fetch_assoc()) {
          echo '<li><a href="category.php?category='.$row['category'].'">'.$row['category'].'</a><li><li class="divider"></li>';
        }
      }
      ?>
    </ul>
    <ul id="dropdown2" class="dropdown-content">
     <?php
     if(logged_in()){
      $link="profile.php";
      $profile=$path.getprofileimage($email,$db);
      $img='<img src='.$profile.' class="circle responsive-img" width=100px height=100px style="overflow: hidden;">';
    }
    else{
      $img="";
      $link="login.php";
    }
    echo '<a href='.$link.'>
    <li>'.$img.'</li><li>'.$user?></a></li>
    <?php
    if(logged_in()){
      echo '<li><a href="preferences_page.php">Your News</a></li>';

      if ($_SESSION['email']=="newsplate2015@gmail.com") {
        echo "<li><a href=admin.php>Administrator</a></li>";  
      }
    }
    ?>
    
    <li><a href="faq.php">FAQ</a></li>
    <li><a href="contact.php">Contact Us</a></li>
    <li><a href="about.php">About Us</a></li>
    <?php
    if(logged_in()){
    echo '<li><a href="core/logout.php"><span style="display:inline;">Log Out</span><i style="display:inline;position:relative;left:10px;top:8px;" class="right-align material-icons">power_settings_new</i></a></li>';
    
    }?>
  </ul>
  <div class="navbar-fixed">
  <nav >
    <div class="nav-wrapper">
      <a href="index.php" class="left brand-logo">News Plate</a>
      <ul class="right">
        <li>
            <form action="search.php" method=get>
              <input class="sb-search-input" placeholder="Search News...." type="text" name="search" id="search" autocomplete="off" style="">
              <input type=submit hidden>
            </input>
            </form>
        </li>
        <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="material-icons">view_list</i></a></li>
        <li><a class="dropdown-button" href="#" data-activates="dropdown2"><i class="material-icons">settings</i></a></li>
      </ul>
    </div>
  </nav>
</div>
</header>
