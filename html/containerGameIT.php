<section class="container">
		<div id="tabs">
<ul>
<li><a href="#tabs-1">Population</a></li>
<li><a href="#tabs-2">CVD</a></li>
<li><a href="#tabs-3">Art.Fib</a></li>
<li><a href="#tabs-4">Throm</a></li>
</ul>
<div class="decisions">
<div id="tabs-1">
    <p>The diagram below shows the current poplation. If you are happy with all the decisions then you can move to the next year with the button below</p>
  </div>
  <div id="tabs-2">
    <p>What recommendations will you make for people with coronary disease.  The population below is the group with coronary disease.</p>
    <table><tr><td>Population</td><td id="Population"></td></tr>
	<tr><td>Intervention</td><td id="Intervention"></td></tr>
	<tr><td>Recommendations</td></tr>
	<tr><td><div class="strength">
      		<a class="selectitem" class="str0" href="#">None</a>
		<a class="selectitem" class="str1" href="#">Weak</a>
		<a class="selectitem" class="str2" href="#">Strong</a></td><td id="rec"></div></td></tr>
	</table>
  </div>
  <div id="tabs-3">
    <p>What recommendations will you make for Arterial Fibrosis</p>
     <table><tr><td>Population</td><td id="Population"></td></tr>
	<tr><td>Intervention</td><td id="Intervention"></td></tr>
	<tr><td>Recommendations</td></tr>
	<tr><td><div class="strength">
      		<a class="selectitem" class="str0" href="#">None</a>
		<a class="selectitem" class="str1" href="#">Weak</a>
		<a class="selectitem" class="str2" href="#">Strong</a></td><td id="rec"></div></td></tr>
	</table>
 </div>
  <div id="tabs-4">
    <p>What recommendations will you make for Thrombosis</p>
    <table><tr><td>Population</td><td id="Population"></td></tr>
	<tr><td>Intervention</td><td id="Intervention"></td></tr>
	<tr><td>Recommendations</td></tr>
	<tr><td><div class="strength">
      		<a class="selectitem" class="str0" href="#">None</a>
		<a class="selectitem" class="str1" href="#">Weak</a>
		<a class="selectitem" class="str2" href="#">Strong</a></td><td id="rec"></div></td></tr>
	</table>
    


  </div>
<div id="questions"> </div>
</div>
</div>
		<h2> Year <span id="yearNumber">2000</span></h2>
		<div class="svg"></div>
		
		<input id="yearStep" type="button" value="End Turn" onclick="endTurn()" />
		<br />
		<!-- 2000<input id="year" type="range" steps="1" value="0" min="0" max="10" name="year" class="slider" /> 2010
		<span id="yearSliderValLabel"> Year Range: <span id="yearSliderVal">0</span></span> -->

	</section>