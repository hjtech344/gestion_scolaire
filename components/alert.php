<?php

if(isset($success_messages)){
    foreach($success_messages as $success_message){
       echo '<script>
             swal("'.$success_message.'", "", "success").then((result) => {
              window.location.href = "index.php";
            });
            </script>';
    }  
}

if(isset($error_messages)){
    foreach($error_messages as $error_message){
      echo '<script>swal("'.$error_message.'", "", "error")</script>';
    }
}

if(isset($warning_messages)){
    foreach($warning_messages as $warning_message){
     echo '<script>swal("'.$warning_message.'", "", "warning")</script>';
    }
}

if(isset($info_messages)){
    foreach($info_messages as $info_message){
     echo '<script>swal("'.$info_message.'", "", "info")</script>';
    }
}
