// ハンバーガーメニューの表示 (app.blade.php)
const btn = document.querySelector('.btn_menu');
const nav = document.querySelector('nav');
 
btn.addEventListener('click', () => {
  nav.classList.toggle('open-menu')
});


// レシピ工程の順番　（create.blade.php）

let block_0 = $("#block_0");
let block_1 = $("#block_1");
let block_2 = $("#block_2");
let block_3 = $("#block_3");
let block_4 = $("#block_4");

var MAX_NUM = 5;
var blocks = [];

for (i = 0; i < MAX_NUM; i++) {
   blocks[i] = $("#block_" + i);
}

// up ボタンのクリックイベント
function block_up(up){
    return function(){
      blocks[up].prev().before(blocks[up]);
    }; 
}
for ( var i = 0; i < MAX_NUM; i ++ ){
  var u = block_up(i);
  $('#block'+i+'_up').click(u);
}
 
// down ボタンのクリックイベント
 function block_down(down){
     return function(){
       blocks[down].next().after(blocks[down]);
     };
 }
 for ( var i = 0; i < MAX_NUM; i ++ ){
  var d = block_down(i);
  $('#block'+i+'_down').click(d);
 }

// フォームの送信　（create.php）

$("#recipe_submit").on("click", function(){
    $.when(
        // 先に実行したい処理をここ
        $("#sort_0").val(block_0.index()),
        $("#sort_1").val(block_1.index()),
        $("#sort_2").val(block_2.index()),
        $("#sort_3").val(block_3.index()),
        $("#sort_4").val(block_4.index())

    ).done(function(){ 
    
        // その後実行したい処理をここ
        document.recipe_form.submit();
    });
});

// 画像プレビューの表示 create.blade.php / recipeedit.blade.php

$('#hd_img').on('change', function (e) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $("#preview").attr('src', e.target.result);
    }
    reader.readAsDataURL(e.target.files[0]);
});

// 画像プレビューの表示（レシピ工程用） create.blade.php / recipeedit.blade.php

var previews = [];
for (i = 0; i < MAX_NUM; i++) {
  previews[i] = $("#preview_" + i);
}

function recipe_preview(view){
  return function(e){
    var reader = new FileReader();
    reader.onload = function (e) {
      previews[view].attr('src', e.target.result);
    }
    reader.readAsDataURL(e.target.files[0]);
  }; 
}
for ( var i = 0; i < MAX_NUM; i ++ ){
  var u = recipe_preview(i);
  $('#image_'+i).change(u);
}

// 画像プレビューの表示 useredit.blade.php

$('#icon').on('change', function (e) {
  var reader = new FileReader();
  reader.onload = function (e) {
      $("#preview").attr('src', e.target.result);
  }
  reader.readAsDataURL(e.target.files[0]);
});

// 削除時のアラート recipeedit.blade.php / useredit.blade.php
$("#delete").on("click", function(){
    if(!confirm("削除してよろしいですか？")){
      return false;
    }
});

// 削除時のアラート stock.blade.php
$("#stock_destroy").on("click", function(){
    if(!confirm("今週の献立を削除してよろしいですか？（作成したレシピはマイページに保存されます）")){
      return false;
    }
});

// ユーザーページの切り替え （userpage.blade.php）
$("#userpage_cook").on("click", function(){
  $("#userpage_cook").removeClass("off");
  $("#userpage_cook").addClass("on");
  $("#userpage_recipe").removeClass("on");
  $("#userpage_recipe").addClass("off");
  $("#recipe_block").addClass("hidden");
  $("#recipe_block").addClass("hidden");
  $("#cook_block").removeClass("hidden");
  $("#cook_num").removeClass("hidden");
  $("#recipe_num").addClass("hidden");
});

$("#userpage_recipe").on("click", function(){
  $("#userpage_recipe").removeClass("off");
  $("#userpage_recipe").addClass("on");
  $("#userpage_cook").removeClass("on");
  $("#userpage_cook").addClass("off");
  $("#cook_block").addClass("hidden");
  $("#recipe_block").removeClass("hidden");
  $("#recipe_num").removeClass("hidden");
  $("#cook_num").addClass("hidden");
});

// 完了/未完了表示の切り替え
$(".lesson_card_bg").mouseover(function(){
  $(".lesson_card_bg h4").removeClass("display_none");
  $(".lesson_card_bg").addClass("bg_darken");
})
$(".lesson_card_bg").mouseleave(function(){
  $(".lesson_card_bg h4").addClass("display_none");
  $(".lesson_card_bg").removeClass("bg_darken");
})
$(".lesson_card_bg").touchstart(function(){
  $(".lesson_card_bg h4").removeClass("display_none");
  $(".lesson_card_bg").addClass("bg_darken");
})
$(".lesson_card_bg").touchend(function(){
  $(".lesson_card_bg h4").addClass("display_none");
  $(".lesson_card_bg").removeClass("bg_darken");
})