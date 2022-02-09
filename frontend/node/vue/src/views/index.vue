<template>
  <div class='d-flex justify-center mt-2 flex-nowrap align-items-end' style='flex-basis: 30%'>
    <table  class='table-sm table-bordered' v-for="(val, key) in table.data" v-bind:key='key'>
      <tr v-for="val2, key in val"  v-bind:key='key'>
        <td>{{key}}, {{val2}}</td>
      </tr>
    </table>
    <!--table class='table-sm table-bordered'>
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
        <th class='px-2 text-center bg-dark text-light font-weight-normal' id='vix' v-bind:title="message">VIX</th>
        <th class='px-2 text-center bg-warning text-secondary' id='bse' v-bind:title='message'>BSE</th>
        <th class='px-2 text-center bg-info text-dark' id='ixic' v-bind:title="message">IXIC</th>
        <th class='px-2 text-center bg-warning text-light font-weight-bold font-italic text-lowercase' id='ibov' v-bind:title='message'>IBOV</th>
        <th class='px-2 text-center bg-info text-dark' id='rut' v-bind:title="message">RUT</th>
        <th class='px-2 text-center bg-info text-dark'>S&P500</th>
        <th class='px-2 text-center bg-info text-warning' id='szse' v-bind:title='message'>SZSE </th>
        <th class='px-2 text-center bg-info text-dark'>DAX</th>
        <th class='px-2 text-center bg-info text-warning' id='sse' v-bind:title='message'>SSE</th>
        <th class='px-2 text-center bg-dark text-light font-weight-bold font-italic'>Wheat</th>
        <th class='px-2 text-center bg-dark text-light font-weight-bold font-italic'>WTI</th>
        <th class='px-2 text-center bg-dark text-light font-weight-bold font-italic'>Copper</th>
        <th class='px-2 text-center bg-dark text-light'>Gold</th>
        <th class='px-2 text-center bg-dark text-light font-weight-normal' id='ust' v-bind:title="message">UST</th>
      </tr>
      <tr>
        <td class='change-tnx text-right' style='border-right: 2px solid black'>
          {{ table.data[0] }}
        </td>
        <td class='change text-right' style='border-top: 2px solid black'>
          {{ table.data[0] }}
        </td>
        <td class='change text-right' style='border-top: 2px solid black'>
          {{ table.data[0] }}
        </td>
        <td class='change text-right' style='border-top: 2px solid black'>
          {{ table.data[0] }}
        </td>
        <td class='change text-right' style='border-top: 2px solid black'>
          {{ table.data[0] }}
        </td>
        <td class='change text-right' style='border-top: 2px solid black'>
          {{ table.data[0] }}
        </td>
        <td class='change text-right' style='border-top: 2px solid black'>
          {{ table.data[0] }}
        </td>
        <td class='change text-right' style='border-top: 2px solid black'>
          {{ table.data[0] }}
        </td>
        <td class='change text-right' style='border-top: 2px solid black'>
          {{ table.data[0] }}
        </td>
        <td class='change text-right' style='border-top: 2px solid black'>
          {{ table.data[0] }}
        </td>
        <td class='change text-right' style='border-top: 2px solid black'>
          {{ table.data[0] }}
        </td>
        <td class='change text-right' style='border-top: 2px solid black'>
          {{ table.data[0] }}
        </td>
        <td class='change text-right' style='border-top: 2px solid black; border-right: 2px solid black'>
          {{ table.data[0] }}
        </td>
        <td class='change-invert text-right'>
          {{ table.data[0] }}
        </td>
      </tr>
    </table-->
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "Index",
  data() {
    return {
      table: null
    };
  },
  mounted() {
    axios
      .get('http://127.0.0.1:8080/api/')
      .then(response => (this.table = response))
      .catch(error => console.log(error));
  }
};
</script>
