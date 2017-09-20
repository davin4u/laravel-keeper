
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');

$(document).ready(function(){
    $(".show-password-btn").on("click", function(){
        if ($(".show-password-btn").hasClass("shown")) {
            $(this).closest(".password-group").find("input").attr("type", "password");
            $(".show-password-btn").removeClass("shown");
        }
        else {
            $(this).closest(".password-group").find("input").attr("type", "text");
            $(".show-password-btn").addClass("shown");
        }
        return false;
    });
});
