
/*sign up ,sign in and forget password login*/
$(document).ready(function(){
    $(".signupacnt").click(function(){
        $("#myModal").modal("hide");
        setTimeout(function(){ $("#signupmodal").modal("show");}, 500);
      });
    $(".loginacnt").click(function(){
        $("#signupmodal").modal("hide");
        setTimeout(function(){ $("#myModal").modal("show");}, 500);
      });
    $(".forget-pw").click(function(){
        $("#myModal").modal("hide");
        setTimeout(function(){ $("#forgetmyModal").modal("show");}, 500);
      });
  });
/*sign up ,sign in and forget password login*/