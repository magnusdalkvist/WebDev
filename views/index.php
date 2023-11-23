<?php
require_once __DIR__.'/_header.php';

// $user_name = '<script>alert()</script>'; // This came from the database/API
// $user_name = '<script>document.querySelector("body").style.backgroundColor="gray"</script>'; // This came from the database/API
$user_name = out('<script>alert</script>'); // This came from the database/API

?>

<main class="absolute top-0 left-48 w-[calc(100%-12rem)] h-full">
  Home
</main>

<?php
require_once __DIR__.'/_footer.php';
?>
