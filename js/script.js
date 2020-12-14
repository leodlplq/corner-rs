$(".menu_interractions").click(function() {

  $(this).addClass('active');
  $('.menu_publication').removeClass('active');
  $('.menu_amis').removeClass('active');
  $("div.friends").hide();
  $("div.publication").hide();
  $("div.interactions_block").css('display','flex');
});

$(".menu_publication").click(function() {

  $(this).addClass('active');
  $('.menu_interractions').removeClass('active');
  $('.menu_amis').removeClass('active');
  $("div.friends").hide();
  $("div.publication").css('display','flex');
  $("div.interactions_block").hide();
});

$(".menu_amis").click(function() {

  $(this).addClass('active');
  $('.menu_publication').removeClass('active');
  $('.menu_interractions').removeClass('active');
  $("div.friends").css('display','block');
  $("div.publication").hide();
  $("div.interactions_block").hide();
});
