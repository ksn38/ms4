<template>
  <div class='flex-wrap'>
    <span class="d-flex justify-content-center text-secondary"><small>(from finance.yahoo.com)</small></span>
    <span class="d-flex justify-content-center mt-2">
      <span class='mx-1 border border-primary rounded p-1'>
        <select id="data1" class='mr-1'>
          <option value="vix">VIX</option>
          <option value="bsesn">S&P BSE SENSEX</option>
          <option value="ixic">NASDAQ Composite</option>
          <option value="bvsp">IBOVESPA</option>
          <option value="rut">Russell 2000</option>
          <option value="gspc">S&P500</option>
          <option value="sz">Shenzhen Component</option>
          <option value="gdaxi">DAX</option>
          <option value="ss">SSE Composite</option>
          <option value="wheat">Wheat</option>
          <option value="wti">WTI</option>
          <option value="cop">Copper</option>
          <option value="gold">Gold</option>
          <option value="wti_gold">Wti/Gold</option>
          <option value="wheat_gold">Wheat/Gold</option>
          <option value="cop_gold">Copper/Gold</option>
          <option selected value="tnx">Treasury Yield 10 Years</option>
        </select>
        <select id="data2" class='mr-1'>
          <option value="vix">VIX</option>
          <option value="bsesn">S&P BSE SENSEX</option>
          <option value="ixic">NASDAQ Composite</option>
          <option value="bvsp">IBOVESPA</option>
          <option value="rut">Russell 2000</option>
          <option value="gspc">S&P500</option>
          <option value="sz">Shenzhen Component</option>
          <option value="gdaxi">DAX</option>
          <option value="ss">SSE Composite</option>
          <option value="wheat">Wheat</option>
          <option value="wti">WTI</option>
          <option value="cop">Copper</option>
          <option selected value="gold">Gold</option>
          <option value="wti_gold">Wti/Gold</option>
          <option value="wheat_gold">Wheat/Gold</option>
          <option value="cop_gold">Copper/Gold</option>
          <option value="tnx">Treasury Yield 10 Years</option>
        </select>
        <input type="submit" value="Show" id='button0'>
      </span>
      <span class='mx-1 border border-primary rounded p-1'>
        <input type="button" id="animation-button" value='Start'>
        <input type="range" id="animation-speed" value='300' min="100" max="1000" class='ml-1'>
      </span>
    </span>
    <canvas id="line-chart0" width="1400" height="600"></canvas>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  mounted() {

    axios
      .get('http://127.0.0.1:8080/api/')
      .then(response => (this.tickers = response.data))
  },
  updated: function() {
    //let chart0 = this.$el.getElementById("line-chart0");
  }
}
</script>
