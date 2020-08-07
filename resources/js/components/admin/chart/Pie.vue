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
				// labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
				datasets: [
					{
						// label: this.propLabel,
						// backgroundColor: this.propColor,
						label: 'Ekport',
						// backgroundColor: '#011638',
						data: this.propchartdata.datas_ex,
          				backgroundColor: [
							  '#998DA0', '#63585E', '#011638', '#2E294E', 
							  '#9055A2', '#C4E7D4', '#C4DACF', '#B9C0DA', 
							  '#D499B9', '#E8C1C5', '#B9FFB7', '#ABEDC6', 
							  '#98D9C2', '#F19A3E', '#403233', '#AA4465',
							  '#EDF0DA', '#A89B8C', '#F0DFAD', '#8F5C38',
							  '#ADFCF9', '#89A894', '#4B644A', '#49393B',
							],
						// data: [40, 20, 12, 39, 10, 40, 39, 80, 40, 20, 12, 12, 12]
					},
					// {
					// 	label: 'Import',
					// 	  // backgroundColor: '#C4DACF',
					// 	            				backgroundColor: [
					// 		  '#998DA0', '#63585E', '#011638', '#2E294E', 
					// 		  '#9055A2', '#C4E7D4', '#C4DACF', '#B9C0DA', 
					// 		  '#D499B9', '#E8C1C5', '#B9FFB7', '#ABEDC6', 
					// 		  '#98D9C2', '#F19A3E', '#403233', '#AA4465',
					// 		  '#EDF0DA', '#A89B8C', '#F0DFAD', '#8F5C38',
					// 		  '#ADFCF9', '#89A894', '#4B644A', '#49393B',
					// 		],
					// 	data: this.propchartdata.data_im,
					// }
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

