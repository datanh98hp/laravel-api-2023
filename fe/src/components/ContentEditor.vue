<script setup>
import { component as CKEditor } from '@ckeditor/ckeditor5-vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
// import SimpleUploadAdapter from '@ckeditor/ckeditor5-upload/src/adapters/simpleuploadadapter';
// import Base64UploadAdapter from '@ckeditor/ckeditor5-upload/src/adapters/base64uploadadapter';
// import Image from '@ckeditor/ckeditor5-image/src/image';
// import ImageToolbar from '@ckeditor/ckeditor5-image/src/imagetoolbar';
// import ImageCaption from '@ckeditor/ckeditor5-image/src/imagecaption';
// import ImageStyle from '@ckeditor/ckeditor5-image/src/imagestyle';
// import ImageResize from '@ckeditor/ckeditor5-image/src/imageresize';
// import LinkImage from '@ckeditor/ckeditor5-link/src/linkimage';

import { ref } from '@vue/reactivity';
import { watch } from '@vue/runtime-core';
import { MyCustomUploadAdapterPlugin } from '../UploadAdapter';

const props = defineProps({
  modelValue: String
})
const editorData = ref(props.modelValue || '')

const editorConfig = ref({
  // plugins: [MyCustomUploadAdapterPlugin, /* ... */],
  toolbar: ['bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote', 'link', 'uploadImage', 'insertTable', 'undo', 'redo', 'outdent', 'indent', '|',],
  heading: {
    options: [
      { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
      { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
      { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
    ]
  },
  simpleUpload: {
    // The URL that the images are uploaded to.
    uploadUrl: 'http://example.com',

    // Enable the XMLHttpRequest.withCredentials property.
    withCredentials: true,

    // Headers sent along with the XMLHttpRequest to the upload server.
    headers: {
      'X-CSRF-TOKEN': 'CSRF-Token',
      Authorization: 'Bearer <JSON Web Token>'
    }
  }
})
const emit = defineEmits(['update:modelValue'])
watch(editorData, () => {
  emit('update:modelValue', editorData.value)
  console.log(editorData.value)
})
</script>

<template>
  <div>
    <CKEditor :editor="ClassicEditor" v-model="editorData" :config="editorConfig"></CKEditor>
  </div>
</template>

<style>
.ck-editor__editable {
  min-height: 260px;
}
</style>