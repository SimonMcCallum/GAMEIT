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
		.living
			{
				fill:#999999;
			}
		.dead
			{
				fill:red;
			}
		.saved
			{
				fill:green;
			}
		.light
			{
				fill:#DDD;
				stroke:#BBB;
			}
	</style>
</head>
<body>
	<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
	<script src="./js/d3.geo.js" charset="utf-8"></script>
	<script>
		var width = 400;
		var height = 400;
		var dataset = [ 5, 10, 13, 19];
		
		var dead = 0;
		
		var svg = d3.select("body").append("svg")
		    .attr("width", width)
		    .attr("height", height);
		    svg.attr("id","gameview");
		    svg.append("text")
		    .attr("id","killtext")
		    .attr("x","350")
		    .attr("y","20")
		    .attr("font-family","sans-serif")
		    .attr("font-size","10px")
		    .attr("fill","red")
		    .text("Starting pop.");
		    
		var defs=svg.append("defs");
		defs.append("mask");
		    
		// All the Counties in Norway
		// geoJson from:
		// http://gangerolf.blogspot.no/2012/09/norway-in-geojson.html

		var path = d3.geo.path()
			.projection(d3.geo.albers()
			.origin([18, 65])
			.parallels( [60.0, 68.0] )
			.scale(1500)
			.translate([200, 200])
		);

		var fylker = svg.append("svg:g").attr("id", "fylker");
		d3.json( "fylker.json", function( json ){
			fylker.selectAll( "path" )
				.data( json.features )
				.enter().append("svg:path")
				.attr("d", path)
				.attr("class","light");
		}); 
		
		
            function make_row(name, icon, n, x, y, row)
            {
                d3.select("svg").selectAll(name)
                    .data(d3.range(n))
                    .enter()
                    .append("svg:use")
                    .attr("class", name)
                    .attr("id", function(d,i) { return "icon"+row+"_"+i})
                    .attr("xlink:href", "#" + icon + "icon")
                    .attr("transform", function(d,i) {
                           return "translate(" + [x + 15 * i, y] + ")" + "scale("+ 0.3 +")"
                    })
            }
            
		
		 
		//d3.json("test.json", function(error, data) {
		//	for(var d in data)
		//	{
		//		console.log(data[d][1]);
		//	 	svg.append("circle").attr("r", data[d][1]).attr("transform", "translate("+(20*(d+1))+",100)")
		//	 	.attr("style", "fill:#00ff00;fill-opacity:1;stroke:none");
		//	}
			// data.foreach(function(d){
			// 	console.log(d.item[0]);
			// });
		//});
		
		function load_human(name){
			d3.xml("./images/human.svg", "image/svg+xml", function (xml) {  
			  var human = document.importNode(xml.documentElement, true);
			   
			   svg.selectAll("g")
			   // .data(dataset)
			    //.enter()
			    .append("g")
			    .attr("transform","translate(0,60)scale("+ 0.3 +")");
			
			    
			   
                       	    
                       	    defs=d3.select("defs");
                       	    var mask = defs.append("svg:mask");
                        	mask.attr("id", name + "iconmask");
                        	human.id = name + "icon";
                    //this is where the icon gets inserted into the DOM
                    		mask.node().appendChild(human);
                       	    
                       	    
                       	    
			    //.attr("transform", function(d, i){ 
			    //    return "translate(" + (i * (width / dataset.length)) + "," 
			    //        + (height -50) + ")"
			    //        +"scale("+ 0.3 +")";
			    //})
			    //.each(function(d, i){ 
			    //    var plane = this.appendChild(human.cloneNode(true)); 
			    //    d3.select(plane).selectAll("path").attr("style", "fill:#00"+(3+i*2)+"000;fill-opacity:1;stroke:none");
			    //})
			    //.transition()
			    //.duration(2000)
			    //.attr("transform", function(d, i){ 
			    //    return "translate(" + (i * (width / dataset.length)) + "," 
			    //        + (height - d*4 - (width / dataset.length)) + ")"
			    //        +"scale("+ 0.3 +")";
			    //});
		}); 
		}

		function randomkill(){
			reset("dead");
			reset("saved");
		        var killed = 3+Math.floor(Math.random()*4);
		        d3.select("killtext").text(killed+" died");
		        for (var i=0; i<killed; i++)
		        {
				var kill_object = document.getElementById("icon"+Math.floor(Math.random()*10)+"_"+Math.floor(Math.random()*20));
				dead += 1;
				kill_object.setAttribute("class","dead");
				//kill_object.setAttribute("transform","translate(" + [400+(dead *12),300] + ")" + "scale("+ 0.3 +")")
			}
			var saved = 3+Math.floor(Math.random()*4);
		        for (var i=0; i<saved; i++)
		        {
				var kill_object = document.getElementById("icon"+Math.floor(Math.random()*10)+"_"+Math.floor(Math.random()*20));
				dead += 1;
				kill_object.setAttribute("class","saved");
				//kill_object.setAttribute("transform","translate(" + [400+(dead *12),300] + ")" + "scale("+ 0.3 +")")
			}
			console.log(kill_object);
		}
		
		function reset(classname){
			var deadones= document.getElementsByClassName(classname);
			for(var i=0 ; i<deadones.length;i++){
				deadones[i].setAttribute("class","living");
			};
		}

		load_human("human");
		for (var i=0;i<10;i++)
		{
			make_row("living","human",20,20,40*i,i);
			};
		
		

</script><br\>
<input id="clickMe" type="button" value="Run test" onclick="randomkill();" />
</body>
</html>