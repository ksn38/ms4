<template>
    <div id="index">{{info}}</div>
</template>

<script>
import axios from 'axios';

export default {
  name: "Index",
  data() {
    return {
      info: null
    };
  },
  mounted() {
    axios
      .get('http://localhost/api')
      .then(response => (this.info = response));
  }
};
</script>
