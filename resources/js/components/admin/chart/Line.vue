<template>
	<canvas ref="canvas" height="400"></canvas>
</template>
<script>
import { Line } from 'vue-chartjs'
export default {
  extends: Line ,
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
        ],
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