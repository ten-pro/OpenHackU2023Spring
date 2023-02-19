<template>
    <div class="childwrap">

    </div>
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

  // send FormData object to php using axios post method
  axios.post('http://kyuuri.daa.jp/deploy/image.php', formData)
    .then(response => {
      // handle success response
      console.log(response.data);
    })
    .catch(error => {
      // handle error response
      console.error(error);
    });
}

// use defineExpose function to explicitly expose properties and methods to template
defineExpose({
  uploadFile,
});

// const button =()=>{
//     console.log(file.value)
// axios
//     .post('http://kyuuri.daa.jp/deploy/image.php', {
//         upload:file.value,
//         name:file.value.name,
//     }, {
//         headers: {
//             'Content-Type': 'multipart/form-data'
//         }
//     })
//     .then(
//         (response) => (console.log(response.data)),

//     )
// }
</script>
<style scoped>
.childwrap{
    width:40vw;
    height:10vh;
    margin-right:20vw;
    background-color: rgb(255, 0, 0);
}
</style>
