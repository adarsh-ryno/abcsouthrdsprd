// Add your JS customizations here
//gravity forms error handling
jQuery(document).on('gform_post_render', function(event, form_id, current_page){
    // code to trigger on form or form page render
    //Error for form with static labels
  jQuery('.gfield_error > .ginput_container').focusin(function(){
    jQuery(this).parent('li').children('label').show();
    jQuery(this).parent('li').find('.validation_message').hide();
    jQuery(this).parent('li').removeClass('gfield_error');
  });
  console.log('form render');
  toggleFloatLabel('.ginput_container_text');
  toggleFloatLabel('.ginput_container_textarea');
  toggleFloatLabel('.ginput_container_phone');
  toggleFloatLabel('.ginput_container_email');
  toggleFloatLabel('.ginput_container_date');
  toggleFloatLabel('.ginput_container_select');
  //Code for form with floating labels
  jQuery('.ginput_container_text').focusin(function(){
    jQuery(this).parent('li').children('label').addClass('float_label');
  });


  jQuery('.ginput_container_text').focusout(function(){
   toggleFloatLabel(this, 'input');
 });

  jQuery('.ginput_container_email').focusin(function(){
    jQuery(this).parent('li').children('label').addClass('float_label');
  });

  jQuery('.ginput_container_email').focusout(function(){
    toggleFloatLabel(this, 'email');
  });
  jQuery('.ginput_container_select').focusin(function(){
    jQuery(this).parent('li').children('label').addClass('float_label');
  });
  jQuery('.ginput_container_select').focusout(function(){
    toggleFloatLabel(this, 'select');
  });
  jQuery('.ginput_container_date').focusin(function(){
    jQuery(this).parent('li').children('label').addClass('float_label');
  });

  jQuery('.ginput_container_date').focusout(function(){
    toggleFloatLabel(this, 'input');
  });

  jQuery('.ginput_container_textarea').focusin(function(){
    jQuery(this).parent('li').children('label').addClass('float_label');
  });


  jQuery('.ginput_container_textarea').focusout(function(){
   toggleFloatLabel(this, 'textarea');

 });

  jQuery('.ginput_container_phone').focusin(function(){
    jQuery(this).parent('li').children('label').addClass('float_label');
  });


  jQuery('.ginput_container_phone').focusout(function(){
   toggleFloatLabel(this, 'tel');

 });


    //Error handling for form with floating labels
  jQuery('.floating_labels .gfield_error > label').hide();
  jQuery('.floating_labels .gfield_error .validation_message').addClass('validation_message--float');    

});

function toggleFloatLabel(selector, type){
  var containerClass='.ginput_container_text';
  if(typeof type == "undefined" || !type){

    containerClass = selector;
  }
  if(containerClass == '.ginput_container_date'){
    type="input"
  }
  
  if(type=='textarea'){
    containerClass='.ginput_container_textarea';
  }

  if(type=='email'){
    containerClass='.ginput_container_email';
    type="input";
  }

  if(type=='tel'){
    containerClass='.ginput_container_phone';
    type='input';
  }
  if(type=='select'){
    containerClass='.ginput_container_select';
    type='select';
  }
  
  
  jQuery(selector).children(type).each(function(){
    if(!jQuery(this).val() || jQuery(this).val() == "(___) ___-____") {
      jQuery(this).parent(containerClass).parent('li').find('label').removeClass('float_label');
    } else {
      jQuery(this).parent(containerClass).parent('li').find('label').addClass('float_label');
    }
  })

}


//Desktop Nav Start
jQuery(".nav_container_desktop .navbar-nav li").hover(
  function(){
    jQuery(this).children('ul').hide();
    jQuery(this).children('ul').show();
  },
  function () {
    jQuery('ul', this).hide();            
  });


//Desktop Nav End

//Nav mobile Start
function moveMenuToTop(e) {
  var n = window.scrollY;
  e.offset({ top: n + 50 });
}
var icon_up = dropdown_icon_up.split(" ");
var icon_down = dropdown_icon_down.split(" ");
jQuery(".mobile_nav_type_A .close-level-3").on("touchstart click", function (e) {
  e.stopPropagation(),
  jQuery(".bc_nav_container_mobile").animate({ left: "0" }, 300, "swing", function () {
    var e = jQuery(".mobile_nav_type_A .navbar-nav"),
    n = jQuery(".level-3-active");
    e.find("i").removeClass(icon_up),
    e.find("i").addClass(icon_down),
    e.find("li").removeClass("dropdown-active"),
    e.find("ul").hide(),
    n.css("top", ""),
    n.css("left", ""),
    n.removeClass("level-3-active"),
    jQuery(".bc_nav_container_mobile").removeClass("show-level-3");
  });
});
var movecount = 0;
jQuery(".mobile_nav_type_A .nav-link").on("touchmove", function (e) {
  movecount++;
}),
jQuery(".mobile_nav_type_A .nav-link").on("touchend click", function (e) {
  return movecount > 0
  ? ((movecount = 0), !1)
  : (e.stopPropagation(),
    jQuery(this).parent("li").hasClass("depth-level-1") && jQuery(this).hasClass("dropdown-toggle") && !jQuery(this).parent("li").hasClass("level-3-active")
    ? (jQuery(this).parent("li").addClass("level-3-active"),
      jQuery(".bc_nav_container_mobile").addClass("show-level-3"),
      moveMenuToTop(jQuery(this).parent("li")),
      jQuery(".bc_nav_container_mobile").animate({ left: "-100%" }, 300),
      !1)
    : jQuery(this).hasClass("dropdown-toggle") && !jQuery(this).parent("li").hasClass("level-3-active")
    ? (jQuery(this).children("span").children("i").hasClass(icon_up)
      ? (jQuery(this).children("span").children("i").removeClass(icon_up), jQuery(this).children("span").children("i").addClass(icon_down))
      : (jQuery(this).children("span").children("i").addClass(icon_up), jQuery(this).children("span").children("i").removeClass(icon_down)),
      jQuery(this).parent("li").toggleClass("dropdown-active"),
                    // jQuery(this).parent("li").children("ul").toggle(),
      jQuery(this).parent("li").siblings().removeClass("dropdown-active"),
      jQuery(this).parent("li").siblings().find("ul").hide(),
      jQuery(this).parent("li").siblings().find("i").removeClass(icon_up),
      jQuery(this).parent("li").siblings().find("i").addClass(icon_down),
      !1)
    : void (window.location = this.getAttribute("href")));
});

//Nav mobile End


jQuery(document).ready(function() {
  jQuery('.navbar-collapse').on('shown.bs.collapse', function () {
    jQuery('body').addClass('nav-expanded');
  });

  jQuery('.navbar-collapse').on('hidden.bs.collapse', function () {
    jQuery('body').removeClass('nav-expanded');
  });
});

jQuery(document).ready(function() {

  jQuery(".dropdown-toggle").click(function(){
   
  });
});