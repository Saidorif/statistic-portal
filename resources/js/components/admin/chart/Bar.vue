<template>
	<canvas ref="canvas"   style="width: 100%; height: 400px;"></canvas>
</template>
<script>
import { Bar } from 'vue-chartjs'
export default {
  	extends: Bar,
	props: ['propchartdata', 'propSettings'],
	data(){
		return{
			chartdata: {
				labels: [],
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
				},
			}
		}
	},
	mounted () {
		this.renderThisChart();
	},
	computed: {
		chartBarData: function() {
			return this.propchartdata;
		}
	},
	watch: {
		propchartdata: function() {
			this.$data._chart.destroy();
			this.renderThisChart();
		},
	},
	methods: {
		renderThisChart(){
			this.chartdata.labels = this.propchartdata.labels;
			this.chartdata.datasets = [];
			this.propSettings.forEach((element, index, array) => {
				const ThisData = {
					label: element.label,
					backgroundColor: element.backgroundColor,
					borderWidth: element.borderWidth,
					borderColor: element.borderColor,
					data: this.chartBarData[element.data],
				}
				this.chartdata.datasets.push(ThisData)
			});
			this.renderChart(this.chartdata, this.options)
		}
	}
  }
</script>
<style scoped></style>

