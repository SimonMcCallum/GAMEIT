<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Game-IT</title>
	<style type="text/css">
		body
		{
			background: #efefef;
		}
	</style>
</head>
<body>
	<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
	<script src="/js/d3.geo.js" charset="utf-8"></script>
	<script>
		var width = 960;
		var height = 400;

		var svg = d3.select("body").append("svg")
		    .attr("width", width)
		    .attr("height", height);

		// All the Counties in Norway
		// geoJson from:
		// http://gangerolf.blogspot.no/2012/09/norway-in-geojson.html

		var path = d3.geo.path()
			.projection(d3.geo.albers()
			.origin([12, 65])
			.parallels( [60.0, 68.0] )
			.scale(1000)
			.translate([200, 200])
		);

		var fylker = svg.append("svg:g").attr("id", "fylker");
		d3.json( "fylker.json", function( json ){
			fylker.selectAll( "path" )
				.data( json.features )
				.enter().append("svg:path")
				.attr("d", path);
		}); 


		d3.json("test.json", function(error, data) {


			for(var d in data)
			{
				console.log(data[d][1]);
			 	svg.append("circle").attr("r", data[d][1]).attr("transform", "translate("+(20*(d+1))+",100)");
			}

			// data.foreach(function(d){
			// 	console.log(d.item[0]);
			// });
		});
</script>
</body>
</html>