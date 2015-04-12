<!--<script src="/static/unknown1.js">
	console.log('this will be if unknown.js failed to load');
	console.log();
</script>-->
<?php echo $this->Resources(false); ?>
<script>
	//console.log(google.maps.MapTypeId,google.maps.ZoomControlStyle);
		var route = new GoogleMap.Route({
			points: [
				{lat: 46.98388282922901, lng: 28.853445053100586},
				{lat: 46.986107836605754, lng: 28.857393264770508},
				{lat: 46.975157564707445, lng: 28.87335777282715},
				{lat: 46.97445479688531, lng: 28.87129783630371},
				{lat: 46.974571925497024, lng: 28.864946365356445},
				{lat: 46.97439623248324, lng: 28.861513137817383},
				{lat: 46.973283496658276, lng: 28.856019973754883},
				{lat: 46.97158506576047, lng: 28.852243423461914},
				{lat: 46.97386914997858, lng: 28.848552703857422},
				{lat: 46.97785142246889, lng: 28.84537696838379},
				{lat: 46.98364861253893, lng: 28.852758407592773}
			]
		});

		var area = new GoogleMap.Polygon({
			width: 10,
			center: {
				lat: 46.98388282922901,
				lng: 28.853445053100586
			}
		});

		var distinct = new GoogleMap.Circle({
			width: 10,
			center: {
				lat: 46.98388282922901,
				lng: 28.853445053100586
			}
		});

	$(function () {
		var tooltip = new GoogleMap.Tooltip({
			content: $('#test').html(),
			custom: false
		});

		tooltip.On('closeclick', function () {
			route.Hide();
			area.Hide();
			distinct.Hide();
		});

		var marker = new GoogleMap.Marker({
			draggable: true,
			position: {
				lat: 46.98388282922901,
				lng: 28.853445053100586
			}
		});

		marker.Child(tooltip);
		marker.Child(route);
		marker.Child(area);
		marker.Child(distinct);

		marker.On('click', function () {
			tooltip.Show();
			route.Show();
			area.Show();
			distinct.Show();
		});
		marker.On('drag', function (e) {
			route.Move(e.delta);
			area.Move(e.delta);
			area.center = e.position;
			distinct.Move(e.delta);
		});

		var map = new GoogleMap('#map', {
			zoom: 12,
			center: {
				lat: 46.9842927059675,
				lng: 28.852930068969727
			}
		});
		map.Child(marker);
		map.On('click', function (e) {
			console.log(e.position);
		});
	});

	$(document).on('input', '.area', function () {
		area.Square($(this).val(), area.center);
	});

	$(document).on('input', '.distinct', function () {
		distinct.Width($(this).val());
	});
</script>
<div id="test" style="display: none;">
	Тестовая форма:<br>
	<input class="quark-input" placeholder="Нзвание" /><br>
	<input class="quark-input" placeholder="Нзвание" /><br>
	<input class="quark-input" placeholder="Нзвание" /><br>
	<br>
	<input type="range" class="area" min="0.5" max="25" value="10" />
	<input type="range" class="distinct" min="0.5" max="25" value="10" />
</div>
<div id="map" style="width: 100%; height: 100%;"></div>