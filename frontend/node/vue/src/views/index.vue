<template>
  <!--div class='d-flex justify-center mt-2 flex-nowrap align-items-end' style='flex-basis: 30%'-->
  <div>
    <table class='table-sm table-bordered'>
      <form>
      <caption style='caption-side: top'><small></small></caption>
        <tr>
          <td class='text-center bg-dark text-light'>day</td>
        </tr>
        <tr>
          <td class='text-center bg-dark text-light' style='border-top: 2px solid'>week</td>
        </tr>
        <tr>
          <td class='bg-dark text-light' style='border-top: 2px solid' nowrap><input type='radio' id='r20' name='period' value="20">month</td>
        </tr>
        <tr>
          <td class='bg-dark text-light' style='border-top: 2px solid' nowrap><input type='radio' id='r60' name='period' value="60">quarter</td>
        </tr>
        <tr>
          <td class='bg-dark text-light' style='border-top: 2px solid' nowrap><input type='radio' id='r125' name='period' value="125" checked="checked">half-year</td>
        </tr>
        <tr>
          <td class='bg-dark text-light' style='border-top: 2px solid' nowrap><input type='radio' id='r250' name='period' value="250">year</td>
        </tr>
        <tr>
          <td class='bg-dark text-light' style='border-top: 2px solid' nowrap><input type='radio' id='r1000' name='period' value="1000">4 years</td>
        </tr>
        <tr>
          <td class='bg-dark text-light' style='border-top: 2px solid' nowrap><input type='radio' id='r5000' name='period' value="5000">20 years</td>
        </tr>
      </form>
    </table>
    <table class='table-sm'>
      <tr>
        <th class='px-2 text-center bg-dark text-light font-weight-normal' id='vix' v-bind:title="message[0]">VIX</th>
        <th class='px-2 text-center bg-warning text-secondary' id='bse' v-bind:title='message[1]'>BSE</th>
        <th class='px-2 text-center bg-info text-dark' id='ixic' v-bind:title="message[2]">IXIC</th>
        <th class='px-2 text-center bg-warning text-light font-weight-bold font-italic text-lowercase' id='ibov' v-bind:title='message[3]'>IBOV</th>
        <th class='px-2 text-center bg-info text-dark' id='rut' v-bind:title="message[4]">RUT</th>
        <th class='px-2 text-center bg-info text-dark'>S&P500</th>
        <th class='px-2 text-center bg-info text-warning' id='szse' v-bind:title='message[5]'>SZSE </th>
        <th class='px-2 text-center bg-info text-dark'>DAX</th>
        <th class='px-2 text-center bg-info text-warning' id='sse' v-bind:title='message[6]'>SSE</th>
        <th class='px-2 text-center bg-dark text-light font-weight-bold font-italic'>Wheat</th>
        <th class='px-2 text-center bg-dark text-light font-weight-bold font-italic'>WTI</th>
        <th class='px-2 text-center bg-dark text-light font-weight-bold font-italic'>Copper</th>
        <th class='px-2 text-center bg-dark text-light'>Gold</th>
        <th class='px-2 text-center bg-dark text-light font-weight-normal' id='ust' v-bind:title="message[7]">UST</th>
      </tr>
      <tr v-for="ticker, key in tickers[0]"  v-bind:key='key'>
        <td class='change-tnx text-right' style='border-right: 2px solid black'>
          {{ ticker.dif_vix }}
        </td>
        <td class='change text-right' style='border-top: 2px solid black'>
          {{ ticker.dif_bsesn }}
        </td>
        <td class='change text-right' style='border-top: 2px solid black'>
          {{ ticker.dif_ixic }}
        </td>
        <td class='change text-right' style='border-top: 2px solid black'>
          {{ ticker.dif_bvsp }}
        </td>
        <td class='change text-right' style='border-top: 2px solid black'>
          {{ ticker.dif_rut }}
        </td>
        <td class='change text-right' style='border-top: 2px solid black'>
          {{ ticker.dif_gspc }}
        </td>
        <td class='change text-right' style='border-top: 2px solid black'>
          {{ ticker.dif_sz }}
        </td>
        <td class='change text-right' style='border-top: 2px solid black'>
          {{ ticker.dif_gdaxi }}
        </td>
        <td class='change text-right' style='border-top: 2px solid black'>
          {{ ticker.dif_ss }}
        </td>
        <td class='change text-right' style='border-top: 2px solid black'>
          {{ ticker.dif_wheat }}
        </td>
        <td class='change text-right' style='border-top: 2px solid black'>
          {{ ticker.dif_wti }}
        </td>
        <td class='change text-right' style='border-top: 2px solid black'>
          {{ ticker.dif_cop }}
        </td>
        <td class='change text-right' style='border-top: 2px solid black; border-right: 2px solid black'>
          {{ ticker.dif_gold }}
        </td>
        <td class='change-invert text-right'>
          {{ ticker.dif_tnx }}
        </td>
      </tr>
    </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "Index",
  data() {
    return {
      message: ["Treasury Yield 10 Years", "NASDAQ Composite", 'Russell 2000', 'SSE Composite', 'Shenzhen Component',
      'Brasil Sao Paulo Stock Exchange Index','S&P Bombay Stock Exchange Sensitive Index','volatility index',],
      tickers: null
    };
  },
  mounted() {

    axios
      .get('http://127.0.0.1:8080/api/')
      .then(response => (this.tickers = response.data))
  },
  updated: function() { 
    //console.log(this.tickers[0][0].dif_vix);
    let tr = this.$el.querySelectorAll(".change");
    let arr = Array.from(tr);

    for (let i = 0; i < arr.length; i += 12) {
      let arrInt = arr.slice(i, i + 12).map((i) => parseFloat(i.innerText));
      //console.log(arrInt);
      let maxArr = Math.max.apply(null, arrInt);
      let minArr = Math.min.apply(null, arrInt);
      for (let j = 0; j < arrInt.length; j++) {
        if (arrInt[j] > 0) {
          arr[j + i].style.backgroundColor = 'rgba(40, 167, 69,'  + arrInt[j]/maxArr + ')';
        }
        else if (arrInt[j] < 0) {
          arr[j + i].style.backgroundColor = 'rgba(220, 53, 69,'  + arrInt[j]/minArr+ ')';
        }
      }
    }
  }
};

</script>
