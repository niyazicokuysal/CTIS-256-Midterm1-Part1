<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
    <title></title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<style>
    .nav-wrapper{
        margin-left: 15px;
        margin-right: 15px;
    }
    .info{
        color: #cccccc;
        text-align: center;
    }
    .striped{
        margin: 0 auto; 
        margin-top: 30px;
        width: 700px;     
    }
    .pagination{
        margin: 0 auto;    
        margin-top: 20px;
        margin-bottom: 20px;
        width: 700px;  
    }
</style>
<body>
    <nav>
        <div class="nav-wrapper">
            <a href="midterm1_1.php" class="brand-logo"><i class="large material-icons">home</i>HOME</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li <?= $_GET["gender"] == "female" ? " class='active' ": "" ?>><a href="midterm1_1.php?gender=female&page=1" >Female</a></li>
                <li <?= $_GET["gender"] == "male" ? " class='active' ": "" ?>><a href="midterm1_1.php?gender=male&page=1" >Male</a></li>
            </ul>
        </div>
    </nav>
    <?php
        function dob ($birthday){
            list($day,$month,$year) = explode("/",$birthday);
            $year_diff  = date("Y") - $year;
            $month_diff = date("m") - $month;
            $day_diff   = date("d") - $day;
            if ($day_diff < 0 || $month_diff < 0)
                $year_diff--;
            return $year_diff;
        }
        
        require "./middb.php" ;
        $gender_prm = $_GET["gender"] ?? "" ;
        if ($gender_prm == "female") {
            $femaleUsers = [] ;
            foreach($users as $email => $userInfo){
                foreach( $orders as $order){
                    if( $email == $order["email"] && $userInfo["gender"] == "female"){
                        $femaleUsers[] = ["fullname" => $userInfo["fullname"], "age" => dob($userInfo["birthday"]),
                                            "product" => $order["prd_name"], "price" => $order["price"]];
                    }
                }  
            }
            usort($femaleUsers,function($a,$b){
                return $a["fullname"] <=> $b["fullname"];
            });
            echo "<table class='striped'>";
            echo "<tr>";
            echo "<th>Name</th>";
            echo "<th>Age</th>";
            echo "<th>Product</th>";
            echo "<th>Price</th>";
            echo "</tr>";
            if($_GET["page"] == 7){
                 for($k = 60; $k < count($femaleUsers) ; $k++){
                    extract($femaleUsers[$k]);
                    echo "<tr>";
                    echo "<td>$fullname</td>" ;
                    echo "<td>$age</td>" ;
                    echo "<td>$product</td>" ;
                    echo "<td>$$price,00</td>" ;
                    echo "</tr>";
                }
            }else{
                for($k = 0+10*($_GET["page"]-1); $k < 10*$_GET["page"] ; $k++){
                    extract($femaleUsers[$k]);
                    echo "<tr>";
                    echo "<td>$fullname</td>" ;
                    echo "<td>$age</td>" ;
                    echo "<td>$product</td>" ;
                    echo "<td>$$price,00</td>" ;
                    echo "</tr>";
                }
            }
            echo "</table>";
            
            echo '<ul class="pagination">';
            echo '<li', $_GET["page"] == 1 ? " class='disabled' ": "", '><a href= "midterm1_1.php?gender=female&page=', $_GET["page"] == "1" ? urlencode($_GET["page"]) : urlencode($_GET["page"]-1),'"><i class="material-icons">chevron_left</i></a></li>';
            for ($p = 1; $p < (count($femaleUsers) / 10) + 1; $p++){
                echo "<li ",$_GET["page"] == $p ? " class='active' ": "" ,"><a href='midterm1_1.php?gender=female&page=", urlencode($p), "'>$p</a></li>";
            }
            echo '<li ', $_GET["page"] == 7 ? " class='disabled' ": "", 'class="waves-effect"><a href="midterm1_1.php?gender=female&page=', $_GET["page"] == 7? urlencode($_GET["page"]) : urlencode($_GET["page"]+1) ,'"><i class="material-icons">chevron_right</i></a></li>';
            
        }else if($gender_prm == "male"){
            $maleUsers = [] ;
            foreach($users as $email => $userInfo){
                foreach( $orders as $order){
                    if( $email == $order["email"] && $userInfo["gender"] == "male"){
                        $maleUsers[] = ["fullname" => $userInfo["fullname"], "age" => dob($userInfo["birthday"]),
                                            "product" => $order["prd_name"], "price" => $order["price"]];
                    }
                }  
            }
            
            usort($maleUsers,function($a,$b){
                return $a["fullname"] <=> $b["fullname"];
            });
            echo "<table class='striped'>";
            echo "<tr>";
            echo "<th>Name</th>";
            echo "<th>Age</th>";
            echo "<th>Product</th>";
            echo "<th>Price</th>";
            echo "</tr>";
            if($_GET["page"] == 4){
                 for($k = 30; $k < count($maleUsers) ; $k++){
                    extract($maleUsers[$k]);
                    echo "<tr>";
                    echo "<td>$fullname</td>" ;
                    echo "<td>$age</td>" ;
                    echo "<td>$product</td>" ;
                    echo "<td>$$price,00</td>" ;
                    echo "</tr>";
                }
            }else{
                for($k = 0+10*($_GET["page"]-1); $k < 10*$_GET["page"] ; $k++){
                    extract($maleUsers[$k]);
                    echo "<tr>";
                    echo "<td>$fullname</td>" ;
                    echo "<td>$age</td>" ;
                    echo "<td>$product</td>" ;
                    echo "<td>$$price,00</td>" ;
                    echo "</tr>";
                }
            }
            echo "</table>";
            
            echo '<ul class="pagination">';
            echo '<li', $_GET["page"] == 1 ? " class='disabled' ": "", '><a href= "midterm1_1.php?gender=male&page=', $_GET["page"] == "1" ? urlencode($_GET["page"]) : urlencode($_GET["page"]-1),'"><i class="material-icons">chevron_left</i></a></li>';
            for ($p = 1; $p < (count($maleUsers) / 10) + 1; $p++){
                echo "<li ",$_GET["page"] == $p ? " class='active' ": "" ,"><a href='midterm1_1.php?gender=male&page=", urlencode($p), "'>$p</a></li>";
            }
            echo '<li ', $_GET["page"] == 4 ? " class='disabled' ": "", 'class="waves-effect"><a href="midterm1_1.php?gender=male&page=', $_GET["page"] == 4? urlencode($_GET["page"]) : urlencode($_GET["page"]+1) ,'"><i class="material-icons">chevron_right</i></a></li>';
            
        }else{
            echo '<h1 class="info">Niyazi Berkay Cokuysal</h1>';
            echo '<h2 class="info">21702848</h2>';
            echo '<h5 class="info">Midterm1 - Part1</h5>';
        }
    ?>      
    </ul>
</body>
</html>
