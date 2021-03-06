function tooltipContentEditor(str, seriesIndex, pointIndex, plot) {
    // display series_label, x-axis_tick, y-axis value
    return "Temperature: " + plot.data[seriesIndex][pointIndex].toFixed(2).replace(',', '.');
}

$(document).ready(function(){
    // Can specify a custom tick Array.
    // Ticks should match up one for each y value (category) in the series.
     
    var plot1 = $.jqplot('chart1', [s1], {
        // The "seriesDefaults" option is an options object that will
        // be applied to all series in the chart.
        seriesDefaults:{
            rendererOptions: {fillToZero: true}
        },
        // Custom labels for the series are specified with the "label"
        // option on the series option.  Here a series option object
        // is specified for each series.
        series:[
            {label:'Temperature'}
        ],
        // Show the legend and put it outside the grid, but inside the
        // plot container, shrinking the grid to accomodate the legend.
        // A value of "outside" would not shrink the grid and allow
        // the legend to overflow the container.
        axes: {
            // Use a category axis on the x axis and use our custom ticks.
            xaxis: {
                renderer: $.jqplot.DateAxisRenderer,
                                 tickOptions:{
                                        formatString:'%H:%M:%S'
                                 }, 
				tickInterval: '1 hour',
            },
            // Pad the y axis just a little so bars can get close to, but
            // not touch, the grid boundaries.  1.2 is the default padding.
            yaxis: {
                pad: 1.05,
                tickOptions: {formatString: '%d&deg'}
            }
        },
		cursor:{ 
        show: true,
        zoom:true, 
        } ,
		highlighter:{
        show:true
    }
    });
});