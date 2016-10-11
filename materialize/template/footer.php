<footer class="page-footer" style="padding:0 5px;">
    <div class="row" style="margin:0;">
    <h4 style="margin-left:2%;color:white;font-size:1.8em;">Newsplate</h4>
    </div>
   <li class="divider" style="margin-bottom:2%;"></li>

<?php
    if($result=$db->query("SELECT * From categorylist")){
        $x=-1;

        echo "<div class='row'>";
        while($row=$result->fetch_assoc()) {
        $x++;
        if ($x%4==0) {      
          echo "<div class='col offset-l1 l2 s12 center-align'><ul>";
        }    
        echo '<li><a class="grey-text text-lighten-3" href="category.php?category='.$row['category'].'">'.$row['category'].'</a></li>';

        if ($x%4==3) {
        echo  '</ul></div>';
        }
    }
  }
        echo "</div>";
  
      ?>   
            <div class="row"></div>
          <div class="footer-copyright">
            <div class="container center-align">
            &copy; Newsplate <?php echo date("Y"); ?>
            </div>
          </div>
        </footer>
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.js"></script>
    </body>
  </html>