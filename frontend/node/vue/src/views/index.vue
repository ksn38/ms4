<template>
  <div class="index">
    <TableTickers/>
    <ChartsTickers/>
  </div>
</template>

<script>
// @ is an alias to /src
import TableTickers from '@/components/TableTickers.vue'
import ChartsTickers from '@/components/ChartsTickers.vue'

export default {
  name: 'Index',
  components: {
    TableTickers,
    ChartsTickers
  }
}
</script>
