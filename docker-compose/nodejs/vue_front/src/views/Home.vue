<template>
<div id="app">
  <div>{{info}}</div>
  <!--h1>Bitcoin Price Index</h1>
  <div v-for="(currency, key) in info" class="currency" v-bind:key="key">
    {{ currency.description }}:
    <span class="lighten">
      <span v-html="currency.symbol"></span>{{ currency.rate_float | currencydecimal }}
    </span>
  </div-->
</div>
</template>

<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script>
import axios from 'axios'

export default {
    name: 'Btc',
    data() {
        return {
            info: null
        };
    },
    mounted() {
        axios.get('http://127.0.0.1:8080/api/').then(response => (this.info = response.data.bpi)).
        catch(error => {
            console.log(error);
            this.errored = true;
      })
      .finally(() => (this.loading = false));;
    } 
}
</script>