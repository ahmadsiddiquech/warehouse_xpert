<div class="page-content-wrapper">
<div class="page-content">
<style>
img {
  display: block;
  margin-left: auto;
  margin-right: auto;
}
.shadow{
    box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 3px 3px rgba(0,0,0,0.23);
}
* {box-sizing: border-box;}
ul {list-style-type: none;}
body {font-family: Verdana, sans-serif;}

.month {
  padding: 20px 15px;
  width: 100%;
  background: #1abc9c;
  text-align: center;
}

.month ul {
  margin: 0;
  padding: 0;
}

.month ul li {
  color: white;
  font-size: 20px;
  text-transform: uppercase;
  letter-spacing: 3px;
}

.weekdays {
  margin: 0;
  padding: 10px 0;
  background-color: #ddd;
}

.weekdays li {
  display: inline-block;
  width: 13.6%;
  color: #666;
  text-align: center;
}

.days {
  padding: 10px 0;
  background: #eee;
  margin: 0;
}

.days li {
  list-style-type: none;
  display: inline-block;
  width: 13.6%;
  text-align: center;
  margin-bottom: 5px;
  font-size:12px;
  color: #777;
}

.days li .active {
  padding: 5px;
  background: #1abc9c;
  color: white !important
}

/* Add media queries for smaller screens */
@media screen and (max-width:720px) {
  .weekdays li, .days li {width: 13.1%;}
}

@media screen and (max-width: 420px) {
  .weekdays li, .days li {width: 12.5%;}
  .days li .active {padding: 2px;}
}

@media screen and (max-width: 290px) {
  .weekdays li, .days li {width: 12.2%;}
}
</style>

<div class="row" style="padding-left:40px;padding-bottom: 30px;padding-top: 30px;">
    <div class="col-md-3" onclick="location.href='product';">
        <div class="card text-white col-md-12 shadow" style="background-color: rgb(255, 189, 53); border-radius: 5px;">
            <div class="card-body ">
                <h3 class="card-text"><center>Total <br>Product<br><?php echo $product; ?></center></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3" onclick="location.href='customer';" >
        <div class="card text-white  col-md-12 shadow" style="background-color: rgb(2, 156, 252); border-radius: 5px;">
            <div class="card-body">
                <h3 class="card-text"><center>Total Customers<br><?php echo $customer; ?></center></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3" onclick="location.href='supplier';">
        <div class="card text-white col-md-12 shadow" style="background-color: rgb(115, 96, 237); border-radius: 5px;">
            <div class="card-body">
                <h3 class="card-text"><center>Total <br>Suppliers<br><?php echo $supplier; ?></center></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3" onclick="location.href='sale_invoice';">
        <div class="card text-white col-md-10 shadow" style="background-color: rgb(85, 206, 101); border-radius: 5px;">
            <div class="card-body">
                <h3 class="card-text"><center>Total <br>Invoices<br><?php echo $invoice; ?></center></h3>
            </div>
        </div>
    </div>
</div>
<div class="row" style="padding-left:40px;padding-bottom: 30px;padding-top: 30px;">
  <div class="col-md-11">
    <canvas id="lineChart"></canvas>
  </div>
</div>
<div class="row" style="padding-top: 20px;">
  <div class="col-md-1"></div>
  <div class="col-md-10">
      <div class="month" style="border-radius: 5px;">      
  <ul>
    <li>
        <?php
            date_default_timezone_set("Asia/Karachi");
            echo date("F");
            $month = date("m");
        ?>
    <br>
      <span style="font-size:18px">
        <?php
            $year = date("Y");
            echo $year;
        ?>
    </span>
    </li>
  </ul>
</div>
<ul class="weekdays">
  <li>Mon</li>
  <li>Tue</li>
  <li>Wed</li>
  <li>Thu</li>
  <li>Fri</li>
  <li>Sat</li>
  <li>Sun</li>
</ul>
<!-- <span class="active">10</span> -->
<ul class="days">
    <?php
    $day = date('d');
    $limit = cal_days_in_month(CAL_GREGORIAN,$month,$year);    
    for ($i=1; $i<=$limit ; $i=$i+1):
        echo '<li>';
        if ($i == $day) {
            echo '<span class="active">';
        }
        echo $i;
        echo '</li>';
     endfor;
    ?>
</ul>
    </div>
</div>
<!-- END PAGE HEADER-->
</div>
</div>
</div>
</div>
</div>
<script src="<?php echo STATIC_ADMIN_JS?>Chart.js"></script>
<script src="<?php echo STATIC_ADMIN_JS?>Chart.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var ctxL = document.getElementById("lineChart").getContext('2d');
    var myLineChart = new Chart(ctxL, {
    type: 'line',
    data: {
    labels: ["","Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul","Aug", "Sep", "Oct", "Nov", "Dec"],
    datasets: [{
    label: "Expense",
    data: [<?=$expense?>],
    backgroundColor: [
    'rgba(105, 0, 132, .2)',
    ],
    borderColor: [
    'rgba(200, 99, 132, .7)',
    ],
    borderWidth: 3
    },
    {
    label: "Income",
    data: [<?=$expense?>],
    backgroundColor: [
    'rgba(0, 137, 132, .2)',
    ],
    borderColor: [
    'rgba(0, 10, 130, .7)',
    ],
    borderWidth: 3
    }
    ]
    },
    options: {
    responsive: true
    }
    });
  });
</script>