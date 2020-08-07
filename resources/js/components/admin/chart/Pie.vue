<template>
	<canvas ref="canvas" height="600"></canvas>
</template>
<script>
import { Pie } from 'vue-chartjs'
export default {
  	extends: Pie,
	props: ['propchartdata', 'propLabel', 'propColor'],
	data(){
		return{
			chartdata: {
				labels: this.propchartdata.labels,
				datasets: [
					{
						label: this.propLabel,
						backgroundColor: this.propColor,
						data: this.propchartdata.datas
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

