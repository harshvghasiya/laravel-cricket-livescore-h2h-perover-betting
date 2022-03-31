$(function ($) {
    "use strict";
  
    jQuery(document).ready(function () {
  
      // preloader
      $("#preloader").delay(300).animate({
        "opacity": "0"
      }, 500, function () {
        $("#preloader").css("display", "none");
      });
  
      // Scroll Top
      var ScrollTop = $(".scrollToTop");
      $(window).on('scroll', function () {
        if ($(this).scrollTop() < 500) {
          ScrollTop.removeClass("active");
        } else {
          ScrollTop.addClass("active");
        }
      });
      $('.scrollToTop').on('click', function () {
        $('html, body').animate({
          scrollTop: 0
        }, 500);
        return false;
      });
  
      // Navbar Dropdown
      $(window).resize(function () {
        if ($(window).width() < 992) {
          $(".dropdown-menu").removeClass('show');
        }
        else {
          $(".dropdown-menu").addClass('show');
        }
      });
      if ($(window).width() < 992) {
        $(".dropdown-menu").removeClass('show');
      }
      else {
        $(".dropdown-menu").addClass('show');
      }
  
      // Sticky Header
      var fixed_top = $(".header-section");
      $(window).on("scroll", function () {
        if ($(window).scrollTop() > 50) {
          fixed_top.addClass("animated fadeInDown header-fixed");
        }
        else {
          fixed_top.removeClass("animated fadeInDown header-fixed");
        }
      });
  
      // Modal active
      $(".login").on("click", function () {
        $("#loginArea").addClass("show").addClass("active");
        $("#regArea").removeClass("show").removeClass("active");
        $("#loginArea-tab").addClass("active");
        $("#regArea-tab").removeClass("active");
      });
      $(".reg").on("click", function () {
          $("#regArea").addClass("show").addClass("active");
          $("#loginArea").removeClass("show").removeClass("active");
          $("#loginArea-tab").removeClass("active");
          $("#regArea-tab").addClass("active");
      });
  
      // increase decrease value
      $('.minus, .plus').click(function() {
        var $input = $(".InDeVal1");
        var val = parseFloat($input.val());
        val += $(this).hasClass('plus') ? 0.1 : -0.1;
        if (val < 0.1 || isNaN(val))
          val = 0.1;
        $input.val(val.toFixed(1)).trigger('change');
      });
      $('.minus2, .plus2').click(function() {
        var $input = $(".InDeVal2");
        var val = parseFloat($input.val());
        val += $(this).hasClass('plus2') ? 0.1 : -0.1;
        if (val < 0.1 || isNaN(val))
          val = 0.1;
        $input.val(val.toFixed(1)).trigger('change');
      });
  
      // Quick Amounts
      $('.quickIn').click(function(){
        var btnVal = $(this).html();
        $(".InDeVal1").val(btnVal);
      });
  
      // Login Reg Tab
      $('.reg-btn').click(function(){
        $("#regArea-tab").click();
      });
      $('.log-btn').click(function(){
        $("#loginArea-tab").click();
      });
  
      // Withdraw Deposit Tab
      $('.withdraw-btn').click(function(){
        $("#withdraw-tab").click();
      });
      $('.deposit-btn').click(function(){
        $("#deposit-tab").click();
      });
  
      // User Active
      $('.single-item .user-btn').on('click', function () {
        $('.user-content').toggleClass('active');
        $('.notifications-content').removeClass('active');
      });
      $('.single-item .notifications-btn').on('click', function () {
        $('.notifications-content').toggleClass('active');
        $('.user-content').removeClass('active');
      });
  
      // Enable Google Authentication
      $( "#switch" ).change(function() {
        $( ".google-authentication" ).slideToggle( "slow" );
      });
  
      // Betpop Up Modal Active
      $('.bottom-item .firstTeam').on('click', function () {
        $(".top-item .cmn-btn").removeClass("active");
        $(".top-item .firstTeam").addClass("active");
      });
      $('.bottom-item .lastTeam').on('click', function () {
        $(".top-item .cmn-btn").removeClass("active");
        $(".top-item .lastTeam").addClass("active");
      });
      $('.bottom-item .draw').on('click', function () {
        $(".top-item .cmn-btn").removeClass("active");
        $(".top-item .draw").addClass("active");
      });
  
      // Blog Reply btn
      var replybtn = $(".reply-btn");
      $(replybtn).on('click', function () {
        $(this).next().slideToggle('slow');
      });
  
      // social link active
      var socialLink = $(".social-link a");
      $(socialLink).on('mouseover', function () {
        $(socialLink).removeClass('active');
        $(this).addClass('active');
      });
  
    });
  });