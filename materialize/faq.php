<?php
  include "template/header.php";
?>
        <main>
            <div class="row">
                <div class="col s8 m8 l8 offset-m2 offset-s2 offset-l2">
          <div class="card" style="margin-top:5%";>
            <div class="card-content">
              <span class="card-title" style="color:black;">FAQs</span>
                <li class="divider"></li>
                <ul class="collapsible" data-collapsible="expandable">
    <li>
      <div class="collapsible-header active teal lighten-3" >Lorem ipsum dolor sit amet?</div>
      <div class="collapsible-body"><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p></div>
    </li>
    <li>
      <div class="collapsible-header active teal lighten-3">Lorem ipsum dolor sit amet?</div>
      <div class="collapsible-body"><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p></div>
    </li>
    <li>
      <div class="collapsible-header active teal lighten-3">Lorem ipsum dolor sit amet?</div>
      <div class="collapsible-body"><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p></div>
    </li>
  </ul>
            </div>
          </div>
        </div>
      </div>
            </div>
            </div>
        </main>

         <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
        <script>
        $(document).ready(function(){
    $('.collapsible').collapsible({
      accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    });
  });
        </script>
        
    <?php include "template/footer.php"; ?>
  