<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="user" content="{{ Auth::user() }}">
<title>Laravel</title>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/alt/icheck-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/alt/ionicons.min.css') }}">
<style>
  .principal {
    margin: auto;
  }
  </style>
</head>
