<?php
include_once('db.php');
include_once('html.php');
include_once('html_utility.php');

//用session傳遞student_id
session_start();
$student_id = $_SESSION["student_id"];

//select student data
$sql = "select student_id,name,grade,department,total_credits from student where student_id = \"$student_id\""; 
$result = mysqli_query($conn, $sql) or die('MySQL query error : select total_creedits ');	
$row = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html>
<style> 
  .end {
    text-align: center;
    background-color: rgb(43, 56, 92);
    color: white;
    margin-top: 15%;
  }
  a{
    text-decoration: none;
  }
  .navbar-brand a{
    font-size:70px;
  }
  .mid-img img{
    width:68%;
    height:600px;
    margin:5% 4% 4% 15%;
  }
  .card {
    width: 70%;
    transition: all 0.2s ease;
    display: inline-block;
    cursor: pointer;
    justify-content: center; /* 水平置中 */
    align-items: center; /* 垂直置中 */
    position: absolute;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin:40px 300px;
    margin-left:35%;
    box-shadow: 0 0 5px rgba(0,0,0,0.4);
  }
  .card:hover{
    background-color: #f5f5f5;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 5);
  }
  .card-group a{
    text-decoration: none;
    color: inherit;
  }
</style>
<head>
<script> 
  function check_alert(){
    if(confirm("是否要登出?") == true){
      window.alert("您已登出");
      window.location.href = "index.php"; 
    } else{
      window.location.href = "homepage.php"; 
    }
  }
 
</script>   
<title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
  <nav class="navbar navbar-expand-sm" >
    <div class="container-fluid">
      <a class="navbar-brand" href="homepage.php" >
        <h1>逢甲大學選課系統</h1>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="d-flex" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li>
            <a class="nav-link"> <?php print $row['name'] . "歡迎" ; ?> </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="selectpage.php">選課頁面</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="selectedpage.php">已選課程</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="week.php">我的課表</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" onclick="check_alert()">登出</a>
            
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class = "mid-img">
    <img src="background_pattern.jpg" alt="fcu"></img>
  </div>
  <div class="card-group"> 
    <a href="selectpage.php"> 
      <div class="card">
        <div class="card-body">
          <br>
          <h4 class="card-title">選課頁面</h4>   
          <br>   
        </div> 
      </div>
    </a>  
    <a href="selectedpage.php">
      <div class="card">  
        <div class="card-body">
          <br>
          <h4 class="card-title">已選課程</h4>
          <br>
        </div>
      </div>
    </a> 
    <a href="week.php">
      <div class="card">  
        <div class="card-body">
          <br>
          <h4 class="card-title">我的課表</h4>   
          <br>   
        </div>
      </div>
    </a>

    <a href="student_data.php">
      <div class="card">  
        <div class="card-body">
          <br>
          <h4 class="card-title">學生資料</h4>     
          <br>
        </div>
      </div>
    </a>
    <br>
    <br>
  </div>

  <br>
  <hr>
  <br>
  <div class="end">
  <footer id="footer" class="custom-bg-color-1 border-top-0 m-0">
    <div class="container">
      <div class="row py-5 "> 
        <p class="pr-2" style="margin-top: 4%;">逢甲資訊工程系成立於1969年，是我國資訊教育界先驅之一，具有學士班、碩士班及博士班，學制完整形成相互學習的場域，迄今已有畢業系友萬餘人。本系以教學為本，建立扎實基礎;
          精實研究，厚實創能人才; 鼓勵產學合作，培育務實能力。</p>
        <br>
        <div style="margin-left: 19%; margin-top: 5%;" class="col-sm-6 col-lg-2">
          <h2 class="text-color-light custom-fontsize-6 mb-3">常用服務</h2>
          <ul class="list list-unstyled">
              <li><a href="https://coursesearch02.fcu.edu.tw/main.aspx">課程檢索系統</a></li>
              <li><a href="https://topic-coiee.fcu.edu.tw/booking?unit=dcb44906-4411-4e7f-b7d1-12afb73e173e">研討室借用系統</a></li>
              <li><a href="https://topic-coiee.fcu.edu.tw/booking">資電學院資源借用</a></li>
              <li><a href="https://topic-coiee.fcu.edu.tw/">專題計畫管理系統</a></li>
              <li><a href="https://intern.iecs.fcu.edu.tw/">產學實習管理系統</a></li>
          </ul>
        </div>
        <div style="margin-left: 5%;  margin-top: 5%;" class="col-sm-6 col-lg-2">
          <h2 class="text-color-light custom-fontsize-6 mb-3">快速連結</h2>
          <ul class="list list-unstyled">
              <li><a href="http://www.fcu.edu.tw">逢甲大學</a></li>
              <li><a href="https://www.checkinatfcu.com/">逢城學記</a></li>
              <li><a href="https://ilearn2.fcu.edu.tw/">ilearn2.0</a></li>
              <li><a href="http://www.coiee.fcu.edu.tw">資訊電機學院</a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3" style=" margin-top: 5%;">
          <h2 class="text-color-light custom-fontsize-6 mb-3">聯絡我們</h2>
          <a href="https://goo.gl/maps/Ly6QMouiP8y"><p>逢甲大學 資訊電機館二樓(資電201)<br>台中市西屯區逢大路127號(文華路100號) </p></a>
          <a href="tel:0424517250"><p class="mb-0 text-white">聯絡電話：0424517250#3701</p></a>
          <a href="mailto:iecs@fcu.edu.tw"><p class="mb-0 text-white">聯絡信箱：iecs@fcu.edu.tw</p></a>
          <a href="https://www.fcu.edu.tw/privacy/"><p class="mb-0">個資保護政策</p></a>
          
      </div>
      </div> 
    </div>
   
    <br>         
  </footer>
</div>  
</body>
</html>

<?php
$conn->close();
?>