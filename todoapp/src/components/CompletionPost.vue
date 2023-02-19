<template>
    <input type="file" ref="fileInput">
    <button @click="uploadFile">Upload</button>
</template>
<script setup lang="ts">
import axios from "axios"
import { ref } from "vue";

const fileInput = ref(null);

// create uploadFile method and expose it to template
const uploadFile = () => {
  const file = fileInput.value.files[0];
  if (!file) return;

  // create FormData object and append file object
  const formData = new FormData();
  formData.append('image', file);
  formData.append('user_id', "1");
    formData.append('todo_id', "1");

  // send FormData object to php using axios post method
  axios.post('http://mp-class.chips.jp/group_task/upload.php',formData)
    .then(response => {
      // handle success response
      console.log(response.data);
    })
    .catch(error => {
      // handle error response
      console.error(error);
    });
//   axios.post('http://mp-class.chips.jp/group_task/upload.php', {
//     formData:formData,
//     user_id:1,
//     todo_id:1
//     }, {
//         headers: {
//             'Content-Type': 'multipart/form-data'
//         }
//     })
//     .then(response => {
//       // handle success response
//       console.log(response.data);
//     })
//     .catch(error => {
//       // handle error response
//       console.error(error);
//     });
}

// use defineExpose function to explicitly expose properties and methods to template
defineExpose({
  uploadFile,
});
</script>
<style scoped>
.childwrap{
    width:40vw;
    height:10vh;
    margin-right:20vw;
    background-color: rgb(255, 0, 0);
}
</style>
