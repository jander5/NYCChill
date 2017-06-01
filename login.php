<?php session_start();
		
if(isset($_POST['submit'])){
            if(empty($_POST['email']) || empty($_POST['pwd'])){
                echo "empty fields";
            } else{
                $e = $_POST['email'];
                $p = $_POST['pwd'];
                
                $cnt = mysqli_connect("localhost", "root", "root", "janderson");
                
                $qry = "SELECT * from nycchill where pwd = '$p' AND email = '$e'";
                
                $login = mysqli_query($cnt, $qry);
                
                $rows = $login->num_rows;
                
//                print_r($login);
//               echo "<hr>";
//                echo $rows;
                
                if($rows == 1 ){
                    $a = mysqli_fetch_assoc($login);
                    //print_r($a);
                   
                    $_SESSION['email'] = $a['email'];
                    $_SESSION['pwd'] = $a['pwd'];
                    header('location:up.html');
                    
               
                }
            }
            
        }
?>