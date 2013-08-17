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
	<script src="./js/d3.v3.min.js" charset="utf-8"></script>
	<script src="./js/d3.geo.js" charset="utf-8"></script>
	<script>
		var width = 600;
		var height = 400;
		
		var grid_rows = 10;
		var grid_cols = 40;
		
		var total_dead = 0;
		var total_saved = 0;
		
		//set up the svg for the game
		var svg = d3.select("body").append("svg")
		    .attr("width", width)
		    .attr("height", height);
		    svg.attr("id","gameview");
		    
		    //Add the text
		    svg.append("text")
		    .attr("id","killtext")
		    .attr("x","350")
		    .attr("y","20")
		    .attr("font-family","sans-serif")
		    .attr("font-size","10px")
		    .attr("fill","red")
		    .text("Starting pop.");
		
		//Add the defs and mask which act as the icon containers    
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
		
		
		
		/* This function adds a row.
		icon is the loaded icon stored in the defs
		class name is the class to use
		n is the number of icons in the row
		x is the  
		
		*/
	            function make_row(icon, class_name, n, x_offset, x_step, y_offset, row, scale)
	            {
	        	d3.select("svg").selectAll(class_name)
	                .data(d3.range(n))
	                .enter()
	                .append("svg:use")
	                .attr("class", class_name)
	                .attr("id", function(d,i) { return "icon"+row+"_"+i})
	                .attr("xlink:href", "#" + icon + "icon")
	                .attr("transform", function(d,i) {
	                      return "translate(" + [x_offset + (x_step * i), y_offset] + ")" + "scale("+ scale +")"
	                })
		    }
            
            
		/* this function makes the grid of humans
		width and height are pixel size
		number = the total number of humans to show
		for example 
		Make_Grid(10,20,400,400, 200); would make 200 humans in a sqare 400 X 400
		*/
		function Make_Grid(rows, cols,width, height){
			var scale = 0.3;
			var x_step = 40 * scale;
			var y_step = x_step*3.3; //The human has a 2:1 ration of hieght to width
			var x_offset = x_step/2;
			var y_offset = y_step/2;
			var x_gap = 2; // space between columns
			var y_gap = 1; // space between rows
			
			var number = rows * cols;
			for (var i=0;i<rows;i++)
			{
				make_row("human","living",cols,
					x_offset,x_step+x_gap,
					i*(y_step+y_gap),i,scale);
				};
		}            
		
		/*Function to load human icon from images*/
		function load_human(name){
			d3.xml("./images/human.svg", "image/svg+xml", function (xml) {  
			  var human = document.importNode(xml.documentElement, true);
			   
			   svg.selectAll("g")
			   // .data(dataset)
			    //.enter()
			    .append("g")
			    .attr("transform","translate(0,60)");//scale("+ 0.3 +")
					           	    
                       	    defs=d3.select("defs");
                       	    var mask = defs.append("svg:mask");
                        	mask.attr("id", name + "iconmask");
                        	human.id = name + "icon";
                    //this is where the icon gets inserted into the DOM
                    		mask.node().appendChild(human);
                       	    
                       	    
                       	    
		}); 
		}

		//This extracts the numbers and runs the test.
		function runTest()
		{
		 var rate = parseInt(document.getElementById('rate').value);
		 var stddev_rate = parseInt(document.getElementById('stddev_rate').value);
		 var intervention = parseInt(document.getElementById('intervention').value);
		 var stddev_intervention = parseInt(document.getElementById('stddev_intervention').value);
		 var treatment = document.getElementById('treatment').value;
		
		console.log(rate,"   ",stddev_intervention);
		
		 randomKill(rate,stddev_rate,intervention,stddev_intervention);
		
		}

		function randomKill(dead,dead_var,save,save_var){
			reset("dead");
			reset("saved");
		        var killed = dead+(Math.floor((Math.random()*dead_var)-(dead_var/2)));
		        d3.select("killtext").text(killed+" died");
		        for (var i=0; i<killed; i++)
		        {
				var kill_object = document.getElementById("icon"+Math.floor(Math.random()*grid_rows)+"_"+Math.floor(Math.random()*grid_cols));
				total_dead += 1;
				kill_object.setAttribute("class","dead");
				//kill_object.setAttribute("transform","translate(" + [400+(dead *12),300] + ")" + "scale("+ 0.3 +")")
				console.log(kill_object,"   ",i);
			}
			var saved = save+(Math.floor((Math.random()*save_var)-save_var/2));
			
		        for (var i=0; i<saved; i++)
		        {
				var kill_object = document.getElementById("icon"+Math.floor(Math.random()*grid_rows)+"_"+Math.floor(Math.random()*grid_cols));
				total_saved += 1;
				kill_object.setAttribute("class","saved");
				//kill_object.setAttribute("transform","translate(" + [400+(dead *12),300] + ")" + "scale("+ 0.3 +")")
				console.log(kill_object,"   ",i," ",saved);
			}
			console.log(kill_object);
		}
		
		/*
		Reset all items with a specific class name
		used to reset the set svgs
		*/
		function reset(classname){
			var deadones= document.getElementsByClassName(classname);
			for(var i=0 ; i<deadones.length;i++){
				deadones[i].setAttribute("class","living");
			};
		}



		load_human("human");
		Make_Grid(grid_rows,grid_cols ,width, height);
		

		
		 
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
			
		
		
		

</script>
<br/>
This is a prototype for visualising effects.  Enter the relevant numbers below:</br>
Total : 
<input id="rate" type="text" value="20" style="width:40px"/>
<input id="stddev_rate" type="text" value="10" style="width:40px"/>
<input id="intervention" type="text" value="4" style="width:40px"/>
<input id="stddev_intervention" type="text" value="3" style="width:40px"/>
<input id="treatment" type="checkbox" checked="true"/>

<input id="clickMe" type="button" value="Run test" onclick="runTest()" />
</body>
</html>




