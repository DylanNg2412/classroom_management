<?php

  // start session
  session_start();

  // require the functions.php file
  require "includes/functions.php";
  require "includes/class-auth.php";
  require "includes/class-student.php";


  $path = $_SERVER["REQUEST_URI"];
  // trim out the beginning slash
  $path = trim( $path, '/' );

  // init classes
  $auth = new Authentication();
  $student = new Student();

  // simple router system - deciding what page to load based on the url
  // Routes
  switch ( $path ) {
    // action routes
    case 'auth/login':
      $auth->login();
      break;
    case 'auth/signup':
      $auth->signup();
      break;
    case 'student/add':
      $auth->add();
      break;
    case 'student/update':
      $auth->update();
      break;
    case 'student/delete':
      $auth->delete();
      break;

    // page routes
    case 'login':
      require 'pages/login.php';
      break;
    case 'signup':
      require 'pages/signup.php';
      break;
    case 'logout':
      $auth->logout();
      break;
    default:
    $page_title = "Home Page";
      require 'pages/home.php';
      break;
  }
