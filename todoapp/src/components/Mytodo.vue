<template>
  <div>
    <select>
      <option value="">並び替え</option>
      <option value="">昇順</option>
      <option value="">降順</option>
    </select>
    <div class="tabs">
      <input id="all" type="radio" name="tab_item" checked>
      <label class="tab_item" for="all">未完了</label>
      <input id="programming" type="radio" name="tab_item">
      <label class="tab_item" for="programming">仮完了</label>
      <input id="design" type="radio" name="tab_item">
      <label class="tab_item" for="design">完了</label>
        <div class="tab_content" id="mi_content">
          <div class="mikanryou">
            <h3>チャーハン材料</h3>
            <p>期限日：〇月〇日</p>
            <p>ランク：A</p>
            <p>完了条件：ネギ、卵、ベーコンを買ってくる</p>
            <p>掲示板許可：ON</p>
            <div class="button_area">
              <button class="button kan">完了</button>
              <paper-ripple fit></paper-ripple>
              <button class="button saku">削除</button>
            </div>
          </div>
        </div>
        <div class="tab_content" id="kari_content">
          <div class="karikanryou">

          </div>
        </div>
        <div class="tab_content" id="kan_content">
          <div class="kanryou">

          </div>
        </div>
    </div>
  </div>
</template>
<script setup>
</script>
<style scoped>
select {
  appearance: none;
  width: 40%;
  padding: 10px;
  border: 1px solid #999;
  background: #eee;
}
/*タブ切り替え全体のスタイル*/
.tabs {
  background-color: #fff;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  width: 90%;
  margin: 0 auto;
  
}

/*タブのスタイル*/
.tab_item {
  width: calc(100%/3);
  height: 50px;
  border-bottom: 3px solid #5ab4bd;
  background-color: #d9d9d9;
  line-height: 50px;
  font-size: 16px;
  text-align: center;
  color: #565656;
  display: block;
  float: left;
  text-align: center;
  font-weight: bold;
  transition: all 0.2s ease;
}
.tab_item:hover {
  opacity: 0.75;
}

/*ラジオボタンを全て消す*/
input[name="tab_item"] {
  display: none;
}

/*タブ切り替えの中身のスタイル*/
.tab_content {
  display: none;
  padding: 20px 20px 20px;
  clear: both;
  overflow: hidden;
}


/*選択されているタブのコンテンツのみを表示*/
#all:checked ~ #mi_content,
#programming:checked ~ #kari_content,
#design:checked ~ #kan_content {
  display: block;
}

/*選択されているタブのスタイルを変える*/
.tabs input:checked + .tab_item {
  background-color: #5ab4bd;
  color: #fff;
}

.mikanryou{
  position: relative;
  border: 2px solid #5ab4bd;
  border-radius: 10px;
}
.button_area{
  position: absolute;
  top:2vw;
  left:55vw;
  width: 23vw;
  height: 12vh;
}
.button {
      width: 20vw;
      height: 4vh;
      border-radius: 8px;
      font-size: 0.9em;
      background-color: #5ab4bd;
      color: white;
      margin-top: 2vw;
    }
</style>
