// レシピ工程の順番　（create.blade.php）

let block_0 = $("#block_0");
let block_1 = $("#block_1");
let block_2 = $("#block_2");

var MAX_NUM = 3;
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
for ( var i = 0; i < 3; i ++ ){
var u = block_up(i);
$('#block'+i+'_up').click(u);
}
 
// down ボタンのクリックイベント
 function block_down(down){
     return function(){
       blocks[down].next().after(blocks[down]);
     }; 
 }
 for ( var i = 0; i < 3; i ++ ){
 var d = block_down(i);
 $('#block'+i+'_down').click(d);
 }

// フォームの送信　（create.php）

$("#recipe_submit").on("click", function(){
    $.when(
        // 先に実行したい処理をここ
        $("#sort_0").val(block_0.index()),
        $("#sort_1").val(block_1.index()),
        $("#sort_2").val(block_2.index())

    ).done(function(){ 
    
        // その後実行したい処理をここ
        document.recipe_form.submit();
    });
});


// 検索機能 find.blade.php -> result.blade.php

　//URLのパラメーターを取得
let v = new URLSearchParams(window.location.search);
　//URLのパラメーターのうち検索されたキーワードを取得
  v = v.get('search-key');
　//検索したい全てのURLを配列に格納
  const urlLists = [
    "/list/"];
    
  $.each(urlLists, function(i){
    $.ajax({
      url　: urlLists[i],
      dataType : 'html',
      success　: function(data){
　　　   //上記のURLからキーワードを探す
        if( $(data).find("#article").text().indexOf(v) !== -1){
　　　　　　//あれば、ページを表示する
          $('<li><a href="' + urlLists[i] + '">' +$(data).find("h1").text() + '</a></li>').appendTo('ul');
          }
        },
        error: function(data){
          console.log("error")
        }
      });
    });
