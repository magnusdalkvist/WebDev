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

  <link rel="stylesheet" href="/app.css">

  <title>YumHub</title>
</head>

<body class="w-full h-screen text-base font-roboto font-light bg-slate-200
[&_input]:h-8 [&_input]:border [&_input]:border-slate-300 [&_input]:rounded-md [&_input]:outline-none">

  <nav class="fixed top-12 left-0 flex flex-col gap-4 w-48 h-screen py-4
text-gray-600 bg-slate-200 [&_a]:px-4">

    <?php if (_is_admin()) : ?>
      <div class="flex flex-col gap-4">
        <a href="/browse" class="flex items-center">
          <span class="material-symbols-outlined mr-2 font-thin">
            storefront
          </span>
          Browse
        </a>
        <a href="/all_users" class="flex items-center">
          <span class="material-symbols-outlined mr-2 font-thin">
            group
          </span>
          All users
        </a>
        <a href="/all_orders" class="flex items-center">
          <span class="material-symbols-outlined mr-2 font-thin">
            receipt_long
          </span>
          All orders
        </a>
        <a href="/partners" class="flex items-center">
          <span class="material-symbols-outlined mr-2 font-thin">
            database
          </span>
          All data
        </a>
      </div>
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
        <span class="material-symbols-outlined mr-2 font-thin">
          receipt_long
        </span>
        Orders
      </a>

    <?php endif ?>

    <?php if (!isset($_SESSION['user'])) : ?>
      <a href="/browse" class="flex items-center">
        <span class="material-symbols-outlined mr-2 font-thin">
          storefront
        </span>
        Browse
      </a>
      <a href="/login" class="flex items-center">
        <span class="material-symbols-outlined mr-2 font-thin">
          key
        </span>
        Login
      </a>
      <a href="/signup" class="flex items-center">
        <span class="material-symbols-outlined mr-2 font-thin">
          key
        </span>
        Signup
      </a>
    <?php else : ?>
      <a href="/account" class="flex items-center">
        <span class="material-symbols-outlined mr-2 font-thin">
          Person
        </span>
        Account
      </a>
      <a href="/logout" class="flex items-center">
        <span class="material-symbols-outlined mr-2 font-thin">
          lock
        </span>
        Logout
      </a>
    <?php endif ?>
  </nav>


  <header class="fixed top-0 flex items-center w-full h-12 px-4 bg-white z-10">

    <a href="/" class="flex items-center w-44 h-12 bg-white">
      <span class="material-symbols-outlined font-thin">
        dashboard
      </span>
      YumHub
    </a>

    <form action="/search-results" method="GET" class="relative flex items-center">
      <input name="query" type="text" class="pl-7 bg-slate-200">
      <button class="absolute flex items-center">
        <span class="material-symbols-outlined ml-1 font-thin">
          search
        </span>
      </button>
    </form>

    <button class="flex items-center ml-auto">
      <span class="material-symbols-outlined font-thin">
        menu
      </span>
    </button>
  </header>


  <main class="absolute top-0 left-48 w-[calc(100%-12rem)] h-full">