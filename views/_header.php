<?php
require_once __DIR__ . '/../_.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="/index.css">
  <link rel="stylesheet" href="/app.css">

  <title>YumHub</title>
</head>

<body class="w-full min-h-screen bg-hot-noir text-white">
  <header class="sticky top-0 z-10 backdrop-blur backdrop-brightness-75">
    <nav class="grid grid-cols-[1fr_auto_1fr] p-4">
      <div class="flex gap-4">
        <?php if (_is_admin()) : ?>
          <a href="/all_users" class="flex items-center">
            All users
          </a>
          <a href="/all_orders" class="flex items-center">
            All orders
          </a>
          <a href="/partners" class="flex items-center">
            All data
          </a>
        <?php endif ?>
        <?php if (_is_partner()) : ?>
          <!-- <a href="/user_orders" class="flex items-center">
        <span class="material-symbols-outlined mr-2 font-thin">
          receipt_long
        </span>
        Orders
      </a> -->
          <!-- TODO: Orders made for partner store -->
        <?php endif ?>
        <?php if (_is_employee()) : ?>
          <!-- <a href="/user_orders" class="flex items-center">
        <span class="material-symbols-outlined mr-2 font-thin">
          receipt_long
        </span>
        Orders
      </a> -->
          <!-- TODO: Orders made for related partner store to employee -->
        <?php endif ?>
        <?php if (_is_customer()) : ?>
          <a href="/user_orders" class="flex items-center">
            Orders
          </a>
        <?php endif ?>
      </div>
      <div class="flex">
        <p class="font-semibold text-2xl italic ">YumHub</p>
        <p class="text-xs">
          <?php if (_is_admin()) : ?>
            (admin)
          <?php endif ?>
          <?php if (_is_employee()) : ?>
            (partner)
          <?php endif ?>
        </p>
      </div>
      <div class="flex justify-end gap-6">
        <a href="/" class="flex items-center">
          <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M14.2818 14.2731L21 21M16.5556 8.77778C16.5556 13.0733 13.0733 16.5556 8.77778 16.5556C4.48223 16.5556 1 13.0733 1 8.77778C1 4.48223 4.48223 1 8.77778 1C13.0733 1 16.5556 4.48223 16.5556 8.77778Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </a>
        <a href="/account" class="flex items-center">
          <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1.66675 21V19.8235C1.66675 16.5748 4.30037 13.9412 7.5491 13.9412H12.255C15.5037 13.9412 18.1373 16.5748 18.1373 19.8235V21M14.6079 5.70588C14.6079 8.30487 12.501 10.4118 9.90204 10.4118C7.30305 10.4118 5.19616 8.30487 5.19616 5.70588C5.19616 3.10689 7.30305 1 9.90204 1C12.501 1 14.6079 3.10689 14.6079 5.70588Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </a>
      </div>
    </nav>
    <nav id="mobile"></nav>
  </header>

  <main class="">