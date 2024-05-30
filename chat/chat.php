<?php session_start(); ?>
<?php require './db-connect.php'; ?>
<?php

?>
package com.example.demo.controller;
 
 import org.springframework.stereotype.Controller;
 import org.springframework.web.bind.annotation.GetMapping;
 import org.springframework.web.bind.annotation.RequestMapping;
  
 @Controller
 @RequestMapping("hi")
 public class TopViewController {
  
     @GetMapping("first")
     public String top() {
         return "topfile";
     }
     @GetMapping("second")
     public String sub() {
         return "/sub/subfile";
     }
 }
 
 <!DOCTYPE html> < html > <head> <meta ch...、宮本 悠 が作成
 宮本 悠
 10:35
 <!DOCTYPE html>
 <html>
 <head>
 <meta charset="UTF-8">
 <title>Insert title here</title>
 </head>
 <body>
     <h1>サブファイル</h1>
     <p>SD3E 宮本　悠</p>
     <img src="/images/siba2.jpg">
     <p><button onclick="location.href='first'">Go to topfile</button></p>
 </body>
 </html>
 <!DOCTYPE html> <html> <head> <meta char...、宮本 悠 が作成
 宮本 悠
 10:36
 <!DOCTYPE html>
 <html>
 <head>
 <meta charset="UTF-8">
 <title>Insert title here</title>
 </head>
 <body>
     <h1>サブファイル</h1>
     <p>SD3E 宮本　悠</p>
     <img src="/images/siba2.jpg">
     <p><button onclick="location.href='first'">Go to topfile</button></p>
 </body>
 </html>
 @charset "UTF-8" ; body { background-colo...、宮本 悠 が作成
 宮本 悠
 10:36
 @charset "UTF-8";
 body{
 background-color: #FFDBC9;
 }
 コンテキスト メニューあり