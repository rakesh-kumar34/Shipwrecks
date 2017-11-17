<!DOCTYPE html>
<html>
<head>
   <title>D3 Example</title>
   <script src="http://d3js.org/d3.v3.min.js"></script>
   <script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/alasql@0.4.2/dist/alasql.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
   <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
   <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
   <style type="text/css">
html,body {
      height: 100%;
      margin: 0;
      padding: 0;
      font-family: -apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif;
    }
    .navbargradient {
      background: #ffffff;
      /* Old browsers */
      background: -moz-linear-gradient(top, #ffffff 0%, #e5e5e5 100%);
      /* FF3.6-15 */
      background: -webkit-linear-gradient(top, #ffffff 0%, #e5e5e5 100%);
      /* Chrome10-25,Safari5.1-6 */
      background: linear-gradient(to bottom, #ffffff 0%, #e5e5e5 100%);
      /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
      filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#e5e5e5', GradientType=0);
      /* IE6-9 */
    }   
#chart rect {
  fill: #4aaeea;
}

#chart text {
  fill: white;
  font: 10px sans-serif;
  text-anchor: end;
}

.axis text {
  font: 10px sans-serif;
}
#chart {
  width: 60%;
  height: 60%;
}
.axis path,
.axis line {
  fill: none;
  stroke: black;
  shape-rendering: crispEdges;
}
.bar{
    fill: steelblue;
  }

  .bar:hover{
    fill: brown;
  }	
.d3-tip {
  line-height: 1;
  font-weight: bold;
  padding: 12px;
  background: rgba(0, 0, 0, 0.8);
  color: #fff;
  border-radius: 2px;
}

/* Creates a small triangle extender for the tooltip */
.d3-tip:after {
  box-sizing: border-box;
  display: inline;
  font-size: 10px;
  width: 100%;
  line-height: 1;
  color: rgba(0, 0, 0, 0.8);
  content: "\25BC";
  position: absolute;
  text-align: center;
}

/* Style northward tooltips differently */
.d3-tip.n:after {
  margin: -1px 0 0 0;
  top: 100%;
  left: 0;
}
#analyzeBy{
float: right;
margin: 120px;
}

</style>
   
</head>

<body class="animated fadeInRight">
<div>
	    <nav class="navbar navbar-toggleable-md navbar-light bg-faded navbargradient">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
      <a class="navbar-brand" href="index.php" style="font-weight: bold">Modern Shipwrecks</a>
      <div class="collapse navbar-collapse" id="navbarToggle">
        <ul class="navbar-nav mr-auto mt-2 mt-md-0">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="data-download.php">Data</a>
          </li>
          <li class="nav-item">
	    <a class="nav-link" href="analyze.php">Analyze</a>
          </li>
          <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          Resources
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
		          <a class="dropdown-item" href="pmsimages.php">Photos</a>
		          <a class="dropdown-item" href="pmsdocs.php">Documents</a>
		          <a class="dropdown-item" href="glossary.html">Ship Glossary</a>
		          <a class="dropdown-item" href="metadata.html">Data Dictionary</a>
		          <a class="dropdown-item" href="astrolabes.php">Astrolabes</a>		          
		        </div>
		      </li>
          <li class="nav-item">
            <a class="nav-link" href="about.html">About</a>
          </li>      
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
        </ul>
      </div>
      <div>
        <a href="https://www.tamu.edu/"><img border="0" alt="TAMU" src="../images/Capture.png" width="200px"></a>
      </div>
    </nav>
</div>
<div class="form-group" id="analyzeBy">
		      <label for="Style"><b>Analyze By<b></label>
		      <select id="style-selector" class="form-control">
		        <option value="default" selected="selected">Lost Country</option>
		        <option value="max-beam">Max Beam(m)</option>
		        <option value="keel-length">Keel Length(m)</option>
		      </select>
</div>

<script>
// set the dimensions of the canvas
var margin = {top: 20, right: 20, bottom: 50, left: 80},
    width = 1200 - margin.left - margin.right,
    height = 600 - margin.top - margin.bottom;


// set the ranges
var x = d3.scale.ordinal().rangeRoundBands([0, width], .05);

var y = d3.scale.linear().range([height, 0]);

// define the axis
var xAxis = d3.svg.axis()
    .scale(x)
    .orient("bottom");


var yAxis = d3.svg.axis()
    .scale(y)
    .orient("left")
    .ticks(10);

var tip = d3.tip()
  .attr('class', 'd3-tip')
  .offset([-10, 0])
  .html(function(d) {
    return "<strong>Shiperwreck Count:</strong> <span style='color:red'>" + d.Freq+ "</span>";
  })
// add the SVG element
var svg = d3.select("body").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
    .append("g")
    .attr("transform", 
          "translate(" + margin.left + "," + margin.top + ")");

svg.call(tip);

// load the data
d3.json("pmsJson.php", function(error, data) {
    var lostctr = alasql('SELECT LostCountry, Count(Site) AS Freq FROM ? where LostCountry is not null GROUP BY LostCountry order by Count(Site) desc',[data]);    
    JSON.stringify(lostctr);
    console.log(lostctr);
    lostctr.forEach(function(d) {
        d.LostCountry = d.LostCountry;
        d.Freq = d.Freq;
    });
	
  // scale the range of the data
  x.domain(lostctr.map(function(d) { return d.LostCountry; }));
  y.domain([0, d3.max(lostctr, function(d) { return d.Freq; })]);

  // add axis
  svg.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + height + ")")
      .call(xAxis)
    .selectAll("text")
      .style("text-anchor", "end")
      .attr("dx", "-.8em")
      .attr("dy", "-.55em")
      .attr("transform", "rotate(-90)" );

  svg.append("g")
      .attr("class", "y axis")
      .call(yAxis)
    .append("text")
      .attr("transform", "rotate(-90)")
      .attr("y", 1)
      .attr("dy", ".71em")
      .style("text-anchor", "end")
      .text("Frequency");


  // Add bar chart
  svg.selectAll("bar")
      .data(lostctr)
      .enter().append("rect")
      .attr("class", "bar")
      .attr("x", function(d) { return x(d.LostCountry); })
      .attr("width", x.rangeBand())
      .attr("y", function(d) { return y(d.Freq); })
      .attr("height", function(d) { return height - y(d.Freq); })
      .on('mouseover', tip.show)
      .on('mouseout', tip.hide);

});


</script>

</body>
</html>