/**
 * 
 */

var dataMort = [3];
var dataMorb = [8];
var dataRecur = [19];
var dataMax = 25; //instead of d3.max(data)
var numYears = 13; //instead of data.length

var w = 400, 
h = 200, 
margin = 20,
marginL =30,
yLookup = d3.scale.linear().domain([0, dataMax]).range([0 + margin, h - margin]), 
xLookup = d3.scale.linear().domain([0, numYears]).range([0 + marginL, w - margin]);
var vis = d3.select("body .container .svggraph").append("svg:svg").attr("width", w).attr("height", h).attr("id", "graph"); 
var g = vis.append("svg:g").attr("transform", "translate(0,200)");

function updateGraph(){
	g.selectAll("#graphpathMort").attr("d", line(dataMort));
	g.selectAll("#graphpathMorb").attr("d", line(dataMorb));
	g.selectAll("#graphpathRecur").attr("d", line(dataRecur));
}

var line = d3.svg.line().x(function(d,i){ return xLookup(i);}).y(function(d){ return -1 * yLookup(d); });

g.append("svg:path").attr("id","graphpathMort"); 
g.append("svg:path").attr("id","graphpathMorb"); 
g.append("svg:path").attr("id","graphpathRecur"); 

g.append("svg:line").attr("class","graphline").attr("x1", xLookup(0)).attr("y1", -1 * yLookup(0)).attr("x2", xLookup(w)).attr("y2", -1 * yLookup(0));

g.append("svg:line").attr("class","graphline").attr("x1", xLookup(0)).attr("y1", -1 * yLookup(0)).attr("x2", xLookup(0)).attr("y2", -1 * yLookup(dataMax));




g.selectAll(".xScale")
.data(xLookup.ticks(5))
.enter().append("svg:text")
.attr("class", "xScale")
.text(function(i){return i+2000;})
.attr("x", function(d) { return xLookup(d); })
.attr("y", 0)
.attr("text-anchor", "middle");

g.selectAll(".yScale")
.data(yLookup.ticks(4))
.enter().append("svg:text")
.attr("class", "yScale")
.text(function(i){return i+"%";})
.attr("x", 0)
.attr("y", function(d) { return -1 * yLookup(d); })
.attr("text-anchor", "right")
.attr("dy", 4);

g.selectAll(".xTicks")
.data(xLookup.ticks(5))
.enter().append("svg:line")
.attr("class", "xTicks")
.attr("x1", function(d) { return xLookup(d); })
.attr("y1", -1 * yLookup(0))
.attr("x2", function(d) { return xLookup(d); })
.attr("y2", -1 * yLookup(-0.6));

g.selectAll(".yTicks")
.data(yLookup.ticks(4)) 
.enter().append("svg:line")
.attr("class", "yTicks")
.attr("y1", function(d) { return -1 * yLookup(d); })
.attr("x1", xLookup(-0.1))
.attr("y2", function(d) { return -1 * yLookup(d); })
.attr("x2", xLookup(0));

updateGraph();