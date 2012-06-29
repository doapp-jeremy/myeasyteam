var responseTypeMap = {
    1: 'No response',
    2: 'Yes',
    3: 'Probable',
    4: 'Maybe',
    5: 'No'
};
// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.
function drawChart() {
  var eventId = $('#eventId').val();
  
  $.ajax({
    url: '/Events/getResponses/' + eventId,
    cache: false,
    dataType: 'json',
    success: function(event) {
      if(event) {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Response');
        data.addColumn('number', 'Count');
        var responsesByType = {
            1: 0,
            2: 0,
            3: 0,
            4: 0,
            5: 0,
        };
        // aggregate the responses by type id
        for (var i in event.Response)
        {
          var response = event.Response[i];
          responsesByType[response.response_type_id]++;
        }
        // now create the rows
        for (var i in responsesByType)
        {
          var count = responsesByType[i];
          data.addRow([responseTypeMap[i], count]);
        }
        // Set chart options
        var options = {
            'title':'Responses',
            'width':400,
            'height':300
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    }
  });
}
