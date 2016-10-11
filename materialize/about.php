<?php
  include "template/header.php";

?>
        <main>
            <div class="row">
                <div class="col s8 m8 l8 offset-m2 offset-s2 offset-l2">
          <div class="card" style="margin-top:5%";>
            <div class="card-content">
              <span class="card-title" style="color:black;">About Us</span>
                <li class="divider"></li>
                <p style="padding:3%;">
                <div class="row">
                <img class="col m4 circle responsive-img" src="images/suyash.jpg" >
                     <img class="col m4 circle responsive-img" src="images/bhavesh.jpg" >
                     <img class="col m4 circle responsive-img" src="images/piyush.jpg" >
                </div>
                <div class="row">
                <span class="col m4 center-align"><b>Suyash Thakare</b></span>
                <span class="col m4 center-align"><b>Bhavesh Patel</b></span>
                <span class="col m4 center-align"><b>Piyush Saravagi</b></span>
                </div>
                <li class="divider"></li>
                <div class="row" style="padding:3%;">
                    O dolor velit lorem excepteur eu expetendis lorem dolore quo cillum, voluptate 
                    ita velit, appellat quid varias ea multos. Mentitum velit dolor non amet non 
                    culpa deserunt do vidisse, iis singulis aut iudicem, do a eram voluptate ubi 
                    esse possumus fabulas de eu enim si quis, proident qui nisi voluptate te ad aute 
                    sed quid. Duis ut iis eram consequat. Excepteur fore nostrud mandaremus, 
                    occaecat te lorem. Duis praetermissum iudicem anim ullamco. Cillum quo doctrina 
                    aut eram laboris et aute varias. Eu labore voluptate praesentibus, admodum 
                    summis nulla mandaremus aliqua ut voluptate multos nostrud fabulas hic ab cillum 
                    arbitror.
                </div>
                </p>
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