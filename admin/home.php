<h1>Welcome to <?php echo $_settings->info('name') ?></h1>
<hr>

        
        
<div class="container-fluid">
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Earnings (Daily)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                       P <?php
                            if ($_settings->userdata('type') == 3) {
                                $total = $conn->query("SELECT SUM(amount) AS total FROM sale_list WHERE user_id = '{$_settings->userdata('id')}' AND DATE(date_created) = CURDATE()");
                            } else {
                                $total = $conn->query("SELECT SUM(amount) AS total FROM sale_list WHERE DATE(date_created) = CURDATE()");
                            }
                            $total = $total->num_rows > 0 ? $total->fetch_array()['total'] : 0;
                            $total = $total > 0 ? $total : 0;
                            echo format_num($total);
                            ?>

                        </div>
                    </div>
                    <div class="col-auto">
                    <i class="fas fa-money-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Earnings (Weekly)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                       P <?php
                          if ($_settings->userdata('type') == 3) {
                              $total = $conn->query("SELECT SUM(amount) AS total FROM sale_list WHERE user_id = '{$_settings->userdata('id')}' AND WEEK(date_created) = WEEK(CURDATE()) AND YEAR(date_created) = YEAR(CURDATE())");
                          } else {
                              $total = $conn->query("SELECT SUM(amount) AS total FROM sale_list WHERE WEEK(date_created) = WEEK(CURDATE()) AND YEAR(date_created) = YEAR(CURDATE())");
                          }
                          $total = $total->num_rows > 0 ? $total->fetch_array()['total'] : 0;
                          $total = $total > 0 ? $total : 0;
                          echo format_num($total);
                          ?>




                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-money-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tasks Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Earnings (Monthly)
                          
                          </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php
                            if ($_settings->userdata('type') == 3) {
                                $total = $conn->query("SELECT SUM(amount) AS total FROM sale_list WHERE user_id = '{$_settings->userdata('id')}' AND YEAR(date_created) = YEAR(CURDATE()) AND MONTH(date_created) = MONTH(CURDATE())");
                            } else {
                                $total = $conn->query("SELECT SUM(amount) AS total FROM sale_list WHERE YEAR(date_created) = YEAR(CURDATE()) AND MONTH(date_created) = MONTH(CURDATE())");
                            }
                            $total = $total->num_rows > 0 ? $total->fetch_array()['total'] : 0;
                            $total = $total > 0 ? $total : 0;
                            echo format_num($total);
                            ?>

                        </div>
                    </div>
                    <div class="col-auto">
                    <i class="fas fa-money-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Category List
                          
                          </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php 
                          $category = $conn->query("SELECT * FROM category_list where delete_flag = 0 and `status` = 1")->num_rows;
                          echo format_num($category);
                        ?>
                        </div>
                    </div>
                    <div class="col-auto">
                          
                        <i class="fas fa-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
             



<canvas id="incomeChart"></canvas>



<script>
    $(document).ready(function() {
  $.ajax({
    url: 'admin/get_daily_income.php', // Replace with the correct URL to the get_daily_income.php script
    type: 'GET',
    dataType: 'json',
    success: function(data) {
      var dates = [];
      var income = [];
      
      // Extracting data from the AJAX response
      for (var i = 0; i < data.length; i++) {
        dates.push(data[i].date);
        income.push(data[i].amount);
      }
      
      // Creating the chart using Chart.js
      var ctx = document.getElementById('incomeChart').getContext('2d');
      var chart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: dates,
          datasets: [{
            label: 'Daily Income',
            data: income,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    },
    error: function(xhr, status, error) {
      // Handle the error case
      console.log(error);
    }
  });
});

  </script>




