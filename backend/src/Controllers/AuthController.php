<?php

/* namespace App\Controllers; */
/*  */
/* use App\Models\Auth; */
/* use App\Controllers\Mantenimientos\AuditoriaController; */
/* use App\Models\Formulacion; */
/* use App\Models\Mantenimientos\Usuarios; */
/*  */
/*  */
/* class AuthController */
/* { */
/*  */
/*   private $auditoria; */
/*  */
/*   public function __construct() */
/*   { */
/*     $this->auditoria = new AuditoriaController(); */
/*   } */
/*  */
/*   public static function validarLogueo() */
/*   { */
/*      */
/*   } */
/*  */
/*   public function login($user, $password) */
/*   { */
/*     $user = $this->usuarios->getUsuarioByUsername($user); */
/*     if ($user && password_verify($password, $user['password'])) { */
/*       $_SESSION['user'] = $user; */
/*       return true; */
/*     } */
/*   } */
/* } */




 //class AuthController
 //{
 // public function login()
 // {
 // include 'views/auth/login.php';
 // }
 //
 // public function loginPost()
 // {
 // $username = $_POST['username'] ?? '';
 // $password = $_POST['password'] ?? '';
 //
 // if ($username === 'admin' && $password === 'admin123') {
 // $_SESSION['user'] = [
 // 'id' => 1,
 // 'username' => $username
 // ];
 // header('Location: /TuRifadigi/');
 // exit;
 // }
 //
 // header('Location: /TuRifadigi/auth/login');
 // exit;
 // }
 //
 // public function logout()
 // {
 // session_destroy();
 // $this->redirect('/TuRifadigi/auth/login');
 // }
 //}
