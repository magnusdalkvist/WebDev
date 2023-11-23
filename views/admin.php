<?php
require_once __DIR__.'/../_.php';
if( ! _is_admin()){
  header('Location: /login'); 
  exit();
}

require_once __DIR__.'/_header.php';
?>

<main>
  Admin
</main>

<?php
require_once __DIR__.'/_footer.php';
?>