<?php 
require_once __DIR__.'/../_.php';
require_once __DIR__.'/_header.php';  
?>

<main class="w-full min-h-screen mt-16">
  <form onsubmit="validate(signup); return false" 
  class="flex flex-col px-4
  lg:w-1/3 mx-auto gap-4 [&_label]:text-gray-500 [&_input]:px-2 [&_input]:border 
  [&_input]:border-gray-600 [&_input]:h-10 [&_input]:rounded-md [&_input]:outline-none">

    <div class="grid">
      <label for="user_name" class="flex">
        <span class="font-bold text-pink-500">name</span> 
        <span class="ml-auto"><?= USER_NAME_MIN ?> to <?= USER_NAME_MAX ?> characters</span>
      </label>
      <input id="user_name" name="user_name" type="text"
      data-validate="str" data-min="<?= USER_NAME_MIN ?>" data-max="<?= USER_NAME_MAX ?>"
      class="">
    </div>

    <div class="grid">
      <label for="user_last_name" class="flex">
        <span class="font-bold text-pink-500">last name</span>   
        <span class="ml-auto"><?= USER_LAST_NAME_MIN ?> to <?= USER_LAST_NAME_MAX ?> characters</span>
        
      </label>    
      <input id="user_last_name" name="user_last_name" type="text"
      data-validate="str" data-min="<?= USER_LAST_NAME_MIN ?>" data-max="<?= USER_LAST_NAME_MAX ?>"
      class="">
    </div>

    <div class="grid">
      <label for="">
      <span class="font-bold text-pink-500">email</span> 
      </label>    
      <input name="user_email" type="text" 
      onblur="is_email_available()"
      onfocus='document.querySelector("#msg_email_not_available").classList.add("hidden")'
      data-validate="email">
      <div id="msg_email_not_available" class="hidden">
        Email is not available
      </div>
    </div>

    <div class="grid" class="flex">
      <label for="user_name" class="flex">
        <span class="font-bold text-pink-500">password</span> 
        <span class="ml-auto"><?= USER_PASSWORD_MIN ?> to <?= USER_PASSWORD_MAX ?> characters</span>
      </label>        
      <input name="user_password" type="text"
      data-validate="str" data-min="<?= USER_PASSWORD_MIN ?>" data-max="<?= USER_PASSWORD_MAX ?>"
      class="">
    </div>

    <div class="grid">
      <span class="font-bold text-pink-500">confirm password</span> 
      <input name="user_confirm_password" type="text"
      data-validate="match" data-match-name="user_password"
      class="">
    </div>

    <button class="w-full h-10 bg-sky-600 text-white rounded-md">Signup</button>

  </form>
</main>

<?php require_once __DIR__.'/_footer.php'  ?>





