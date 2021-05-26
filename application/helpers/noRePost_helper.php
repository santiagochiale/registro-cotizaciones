<?php


function prevent_doble_post(){

  echo '<script>
            if (window.history.replaceState) {
              window.history.replaceState(null, null, window.location.href);
              
            }
             
          </script>';
}