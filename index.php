<!DOCTYPE html>

<?php 
    $connect = mysql_connect("mysql.freehosting.io", "u488574653_swf", "code4change") 
            or die("Check your connection!"); 
    mysql_select_db("u488574653_swf");
    
    $query = "SELECT id, username, time, billcode, price, pic2, status " . 
                     "FROM transaction " .
		     "WHERE status='pending'" . 
                     "ORDER BY time DESC ";
    
    $results = mysql_query($query) 
            or die(mysql_error());
    
    $num_transaction = mysql_num_rows($results);
    
    $src = "";
?>


<html>
<head>
    <meta charset="UTF-8">
    <title>[DEMO] Food For Change</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/navbar-login.css" rel="stylesheet">
</head>
<style>
	img.thumb{
		max-width: 200px;
		height: auto;
	}
</style>

<body>
    
    <!-- NAVBAR -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="account.html"><span class="glyphicon glyphicon-user"></span> Tài khoản</a></li>
                    <li class="active"><a href="index.php"><span class="glyphicon glyphicon-ok-circle"></span> Kiểm duyệt</a></li>
                    <li><a href="customer.php"><span class="glyphicon glyphicon-th"></span> Khách hàng</a></li>
                    <li><a href="transaction.php"><span class="glyphicon glyphicon-tasks"></span> Giao dịch gần đây</a></li>
                    <li><a href="discount.php"><span class="glyphicon glyphicon-cog"></span> Quản lý Discount</a></li>
                </ul>
                
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <form class="navbar-search navbar-form" method="get" action="">
                            <span class="input-group">
                            <input class="form-control" placeholder="Search" name="search" type="text">
                            <span class="input-group-btn"><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button></span>
                            </span>
                        </form>
                    </li>
                    
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span> 
                        <strong>Hoàng Yến</strong>
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="navbar-login">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <p class="text-center">
                                            <img src="img/hoangyen.png">
                                        </p>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="text-left"><strong>Nhà hàng Hoàng Yến</strong></p>
                                        <p class="text-left">
                                            <a href="#" class="btn btn-primary btn-block btn-sm">Thông tin tài khoản</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="navbar-login navbar-login-session">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>
                                            <a href="#" class="btn btn-danger btn-block">Đăng xuất</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END NAVBAR -->
    <!--- USER Widget--->
    
    <!--- END USER Widget--->
    
    <div class="container">
        <div class="row">
            <div class="col-md-9" style=" height: auto;">
                <!--Map-->
<!--------------------------------------------------->
<h3>Bảng kiểm duyệt</h3><br>
<?php
//if
if($num_transaction == 0){
    $src =<<<CELL
    <center><h4>Tất cả các yêu cầu discount đã được xử lý xong!</h4><br><img src="img/hurray.jpg"></center>
CELL;
    echo $src;
} else{
    $count = 1;
    $src .=<<<CELL0
    <form name="input" action="update.php" method="post">
    <table class='table table-striped'>
CELL0;
    for($i = 1; $i <= ($num_transaction / 3 + 1); $i++){
        $src .= "<tr>";
        for($j = 1; $j <= 3; $j++){
	    if($count <= $num_transaction){
		$count ++;
		$row = mysql_fetch_array($results);
		extract($row);
		$money = number_format($price);
            $src .=<<<CELL
                <td><center>
					<div class="pull-left"><span class="glyphicon glyphicon-user"></span> $username </div><div class="pull-right"><small><span class="glyphicon glyphicon-usd"></span> $money</small></div>
					<div class"well" style="width: 100%;"><span class="glyphicon glyphicon-qrcode"></span> $billcode</div>
					<div style="height: 200px;">
                    <img class="thumb" src="http://swf.letsgeekaround.com/upload/$pic2" class="img-rounded"><br /> 
					</div>
		    <div>
			<lable><input type="radio" name="$id" value="approve" checked> <span class="glyphicon glyphicon-ok"  style="color: blue;"></span></lable>
			<lable><input type="radio" name="$id" value="pending"> <span class="glyphicon glyphicon-pushpin"  style="color: gray;"></span> </lable>
			<lable><input type="radio" name="$id" value="refuse"> <span class="glyphicon glyphicon-remove"  style="color: red;"></span> </lable>
			<lable><input type="radio" name="$id" value="redflag"> <span class="glyphicon glyphicon-flag"  style="color: red;"></span> </lable>
		    </div>
                </center></td>
CELL;
	    } else {
	        $src .=<<<CELL1
		<td></td>
CELL1;
 	    }
        }
        $src .= "</tr>";
    }
    $src .=<<<CELL2
        </table>
		<center><button type="submit" class="btn btn-success">Submit</button></center>
    </form>
CELL2;
    echo $src;
//end if
}
?>
<p><br><br><center>Nhóm Hackathon : Trung tâm Change</center><p>
<!--------------------------------------------------->
                <!--END Map-->
            </div>
            <div class="col-md-3">
                 <div class="panel panel-default">
                    <div class="panel-thumbnail">
                        <img class="img-responsive" src="img/hoangyen.png"> 
                    </div>
                    <div class="panel-body">
                        <p><b>Hoàng Yến Restaurant</b></p>
                        <a class="btn btn-success btn-lg btn-block" href="index.php">Làm mới danh sách<br><span class="glyphicon glyphicon-refresh"></span></a>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p><b>Ghi chú</b></p>
                        <p><span class="glyphicon glyphicon-ok" style="color: blue;"></span> Chấp nhận discount <small>(mặc định)</small></p>
                        <p><span class="glyphicon glyphicon-pushpin" style="color: gray;"></span> Xử lý sau.</p>
                        <p><span class="glyphicon glyphicon-remove" style="color: red;"></span> Không chấp nhận.</p>
                        <p><span class="glyphicon glyphicon-flag" style="color: red;"></span> Gắn nhãn vi phạm.</p>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p><center><strong>Thống kê</strong></center></p>
                        <hr>
                        <p><b>Thời gian:</b> 10/08/2014</p>
                        <p><b>Tổng lượt khách:</b> 1250 <small>lượt</small></p>
                        <p><b>Số discount yêu cầu:</b> 182<small> discounts</small></p>
                        <p><b>Số discount đã tặng:</b> 173<small> discounts</small></p>
                        <p><center><b>Tỉ lệ:</b></center></p>
                        <div class="progress">
                        <div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%">
                            <span class="sr-only" style="color: red;"></span>95%
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <!--footer-->
    <div>
        <p></p>   
    </div>
    
    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js"></script>
	</body>
</html>
