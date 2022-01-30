<?php
	$con = mysqli_connect("localhost","root","","agro") or die("Connection failed");
	$resultsel = $con->query("SELECT id,date FROM date");	
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Agrocast
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css">
<script type="text/javascript" src="jquery.js"></script>
<style>

  </style>
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <img src="../../assets/logo.png" alt="">
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li class="active">
            <a>
              <i class="now-ui-icons users_single-02"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li>
            <a href="./admin.html">
              <i class="now-ui-icons users_single-02"></i>
              <p>Admin</p>
            </a>
          </li>
          <li>
            <a href="./icons.html">
              <i class="now-ui-icons objects_globe"></i>
              <p>Icons</p>
            </a>
          </li>
          <li>
            <a href="./map.html">
              <i class="now-ui-icons location_map-big"></i>
              <p>Maps</p>
            </a>
          </li>
          <li>
            <a href="./user.html">
              <i class="now-ui-icons users_single-02"></i>
              <p>User Profile</p>
            </a>
          </li>
          <li>
            <a href="./notifications.html">
              <i class="now-ui-icons media-1_button-power"></i>
              <p>Log Out</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
    <div class="container-main">
      <div id="main">
        <div id="content">
        
            <label>District : </label>
            <select id="state">
              <option value="" >Select state</option>
            </select>
            
            <label>Taluka : </label>
            <select id="city" >
          <!-- <option value="0" default>default</option> -->
              <option value="" >select city</option>
            </select>
        <label>Date : </label>
            <select id="date">
        <option >date</option>
              <?php
            while($rows = $resultsel -> fetch_assoc())
            {
              $id = $rows['id'];
              $date = $rows['date'];
              echo "<option value = '{$rows['id']}'>$date</option>";
            }
          ?>
            </select>
            <!-- <label>Period : </label>
            <select id="month">
              <option>Last 7 days</option>
              <option>Last 1 Month</option>
              <option>Last 5 month</option>
              <option>Last 1 Year</option>
          </select> -->
        
        </div>
      </div>
      <div id="container" ></div>
          </div>
     </div>


     
<!-- .................................................................  -->
     <!-- add container css ..... empty class  -->
    


     <footer class="footer">
        <div class=" container-fluid ">
          <nav>
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  Creative Tim
                </a>
              </li>
              <li>
                <a href="http://presentation.creative-tim.com">
                  About Us
                </a>
              </li>
              <li>
                <a href="http://blog.creative-tim.com">
                  Blog
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright" id="copyright">
            &copy; <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>, Designed by <a href="https://www.invisionapp.com" target="_blank">Invision</a>. Coded by <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script>
    $(document).ready(function(){
      function loadData(type, category_id){
        $.ajax({
          url : "load-cs.php",
          type : "POST",
          data: {type : type, id : category_id},
          success : function(data){
            if(type == "stateData"){
              $("#city").html(data);
            }else{
              $("#state").append(data);
            }
          }
        });
      }
  
      loadData();
  
      $("#state").on("change",function(){
        var state = $("#state").val();
  
        if(state != ""){
          loadData("stateData", state);
        }else{
          $("#city").html("");
        }
  
        
      })
    });
  
    $(function () {
      
      //on page load  
      getAjaxData(1);
      
      //on changing select option
      $('#state').change(function(){
        var val = $('#state').val();
        // console.log(val);
        getAjaxData(val);
        
      });
      function getAjaxData(id){
      
      //use getJSON to get the dynamic data via AJAX call
      $.getJSON('data.php', {id: id}, function(chartData) {
        $('#container').highcharts({
          chart: {
            type: 'line'
          },
          title: {
            text: 'Taluka weather information'
          },
          xAxis: {
              categories:['2020-12-26','2020-12-25','2020-12-24','2020-12-23','2020-12-22','2020-12-21','2020-12-20','2020-12-19','2020-12-18','2012-12-17','2020-12-16','2020-12-15']
            },
            yAxis: {
            min: 0,
            title: {
              text: 'Value'
            }
          },
          series: chartData
        });
      });
    }
  });
  $(function () {
      
      //on page load  
      getAjaxData(1);
      
      //on changing select option
      $('#city').change(function(){
      var val = $('#city').val();
      // console.log(val);
      getAjaxData(val);
      
  });
      function getAjaxData(id){
      
      //use getJSON to get the dynamic data via AJAX call
      $.getJSON('city.php', {id: id}, function(chartData) {
      $('#container').highcharts({
          chart: {
              type: 'line'
          },
          title: {
              text: 'Taluka weather information'
          },
          xAxis: {
          categories:['2020-12-26','2020-12-25','2020-12-24','2020-12-23','2020-12-22','2020-12-21','2020-12-20','2020-12-19','2020-12-18','2012-12-17','2020-12-16','2020-12-15']
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Value'
              }
          },
          series: chartData
      });
  });
    }
  });
  $(function () {
      
      //on page load  
      getAjaxData(1);
      
  $('#date').change(function(){
      var val = $('#date').val();
      console.log(val);
      getAjaxData(val);
      
  });
      function getAjaxData(id){
      
      //use getJSON to get the dynamic data via AJAX call
      $.getJSON('date.php', {id:id}, function(chartData) {
      $('#container').highcharts({
          chart: {
              type: 'line'
          },
          title: {
              text: 'Taluka weather information'
          },
          xAxis: {
          categories:['2020-12-26','2020-12-25','2020-12-24','2020-12-23','2020-12-22','2020-12-21','2020-12-20','2020-12-19','2020-12-18','2012-12-17','2020-12-16','2020-12-15']
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Value'
              }
          },
          series: chartData
      });
  });
    }
  });
  </script>
</body>

</html>