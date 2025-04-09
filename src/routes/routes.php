<?php

use App\Controllers\{
  AuthController,
  HomeController,
  LoteriaController,
  AuditoriaController,
  AlertasController
};

return [
  // Rutas públicas
  'GET' => [
    '/' => [AuthController::class, 'login'],
    '/login' => [AuthController::class, 'login'],
    '/register' => [AuthController::class, 'register'],
  ],

  // Rutas protegidas (requieren autenticación)
  'GET' => [
    '/home' => [HomeController::class, 'index'],
    '/loteria' => [LoteriaController::class, 'index'],
    '/loteria/create' => [LoteriaController::class, 'create'],
    '/loteria/{id}' => [LoteriaController::class, 'show'],
    '/auditoria' => [AuditoriaController::class, 'index'],
    '/alertas' => [AlertasController::class, 'index'],
  ],

  // Rutas POST
  'POST' => [
    '/login' => [AuthController::class, 'login'],
    '/register' => [AuthController::class, 'register'],
    '/logout' => [AuthController::class, 'logout'],
    '/loteria' => [LoteriaController::class, 'store'],
    '/loteria/{id}/update' => [LoteriaController::class, 'update'],
    '/loteria/{id}/delete' => [LoteriaController::class, 'delete'],
  ]
];
