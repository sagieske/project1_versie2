<h3>Search for a recipe here.</h3>

<form action="show_searched_recipes" method="get" data-inline="true">
<fieldset data-role="controlgroup" >
	<legend>Search for:</legend>

    	<input type="radio" name="radio-mini" id="radio-mini-1" value="choice-1" checked="checked" />
    	<label for="radio-mini-1">Name</label>

	    <input type="radio" name="radio-mini" id="radio-mini-2" value="choice-2"  />
    	<label for="radio-mini-2">Description</label>
    	
    	<input type="radio" name="radio-mini" id="radio-mini-3" value="choice-3"  />
    	<label for="radio-mini-3">Ingredients</label>
    	
        <input type="text"  name="search" id="search">
</fieldset>
</form>

<input type="submit" value="Search!" data-inline="true">

<hr>
<label for="slider-time">Maximum time:</label>
<input type="range" name="slider-time" id="slider-time"  step="5"/>
<input type="submit" value="Search!" data-inline="true" id="timesearch">

<hr>
<label for="slider-yield">Maximum yield:</label>
<input type="range" name="slider-yield" id="slider-yield"  step="1"/>
<input type="submit" value="Search!" data-inline="true" id="yieldsearch">

<!--Script to set min time and max time on slider dependent on smallest/biggest time of all recipes-->
<script>

$("#slider-time").attr("value", parseInt('<?php echo $maxtime[0]['time'] ;?>')) //set standard value to max time
$("#slider-time").attr("min", parseInt('<?php echo $mintime[0]['time'] ;?>'))
$("#slider-time").attr("max", parseInt('<?php echo $maxtime[0]['time'] ;?>'))

$("#slider-yield").attr("value", parseInt('<?php echo $maxyield[0]['yield'] ;?>')) //set standard value to max time
$("#slider-yield").attr("min", parseInt('<?php echo $minyield[0]['yield'] ;?>'))
$("#slider-yield").attr("max", parseInt('<?php echo $maxyield[0]['yield'] ;?>'))
</script>

</div>
