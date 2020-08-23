@if(blank($links))	
	<tr>
		<td colspan="3">No Links Found</td>
	</tr>
@else
	@foreach($links as $link)
	<tr>
		<td>{{$link['id']}}</td>
		<td>
			<a href="{{$link['short_url']}}" target="_blank">
			{{$link['short_url']}}
			</a>
		</td>
		<td>
			<a href="{{$link['long_url']}}" target="_blank" title="{{$link['long_url']}}">
			{{substr($link['long_url'],0,100)}}
			</a>
		</td>
	</tr>
	@endforeach
@endif