<template>
  <div>
    <div class="hakkou_area">
      <h3>タイトル</h3>
      <input type="text" class="text_area">
      <h3>期限日</h3>
      <input type="text" class="text_area">
      <h3>完了条件</h3>
      <input type="text" class="text_area">
      <h3>ランク</h3>
      <input type="text" class="text_area">
      <h3>ジャンル</h3>
      <input type="text" class="text_area">
      <h3>詳細</h3>
      <input type="text" class="text_area">
      <div class="radio_area">

      </div>
    </div>
    <div>
      <button class="hakkou_btn">発行</button>
    </div>
</div>
</template>
<script setup>

</script>
<style scoped>
.hakkou_area{
  width: 90%;
  height: 70vh;
  background-color: white;
  position: relative;
  top: 21vw;
  left: 5vw;
}
.hakkou_btn{
  width: 40vw;
  height: 6vh;
  border-radius: 8px;
  font-size: 1.7em;
  background-color: #5ab4bd;
  color: white;
  position: relative;
  top: 22vw;
  left: 30vw;
}

</style>