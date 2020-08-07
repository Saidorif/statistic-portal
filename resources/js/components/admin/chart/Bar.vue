<template>
	<canvas ref="canvas" height="400"></canvas>
</template>
<script>
import { Bar } from 'vue-chartjs'
export default {
  	extends: Bar,
	props: ['propchartdata', 'propSettings'],
	data(){
		return{
			chartdata: {
				labels: this.propchartdata.labels,
				datasets: []
			},
			options: {
				responsive: true,
				type: Object,
				default: null,
				maintainAspectRatio: false,
				title: {
					display: true,
					text: this.propSettings[0].chartTitle
				},
				scales: {
					xAxes: [{
						ticks: {
							display: false
						}
					}]
				}
			},
		}
	},
	mounted () {
		this.propSettings.forEach((element, index, array) => {
				const ThisData = {
					label: element.label,
					backgroundColor: element.backgroundColor,
					borderWidth: element.borderWidth,
					borderColor: element.borderColor,
					data: this.propchartdata[element.data],	
				}
				this.chartdata.datasets.push(ThisData)
		});
		this.renderChart(this.chartdata, this.options)
	}
}
</script>
<style scoped>
	
</style>

