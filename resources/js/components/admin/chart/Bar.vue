<template>
	<canvas ref="canvas" height="400"></canvas>
</template>
<script>
import { Bar } from 'vue-chartjs'
export default {
  	extends: Bar,
	props: ['propchartdata', 'propLabel', 'propColor'],
	data(){
		return{
			chartdata: {
				labels: this.propchartdata.labels,
				// labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
				datasets: [
					{
						label: this.propLabel,
						backgroundColor: this.propColor,
						data: this.propchartdata.datas
						// data: [40, 20, 12, 39, 10, 40, 39, 80, 40, 20, 12, 11]
					}
				]
			},
			options: {
				responsive: true,
				type: Object,
				default: null,
				maintainAspectRatio: false
			},
		}
	},
	mounted () {
		this.renderChart(this.chartdata, this.options)
	}
}
</script>
<style scoped>
	
</style>

