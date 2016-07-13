@extends('layouts.app')

@section('content')
<h1>Enter Data</h1></br>
@if (count($errors) > 0)
  	<p style="color:red"> All fields must be filled in </p>
@endif
                    <form method="POST" action="/admin/newCourse2">
                        {{ csrf_field() }}
						<table>
							<tr>
								<th style="width:60px">Hole</th>					
								@for ($i = 1; $i <= 18; $i++)
								<th>{{$i}}</th>
								@endfor
								<th >Slope</th>
							</tr>
						@foreach($colors as $color)
						<tr>
							<td>{{$color}}</td> <!-- capitalize -->	
							
							@for ($k=1; $k<=18; $k++)
								<td><input type="text" size="2" name="{{'' . $color . $k}}"
								value="{{old($color . $k)}}"></td>
							@endfor
							<td><input type="text" size="2" name="{{$color . 'slope'}}"
								value="{{old($color . 'slope')}}"></td>
						</tr>
						@endforeach
							<tr>
								<td>Par</td>
								@for ($i = 1; $i <= 18; $i++)
								<td><input type="text" size="2" name="{{'par' . $i}}"
									value="{{old('par' . $i)}}"></td>
								@endfor
								<td></td>
							</tr>
							<tr>
								<td>Handicap</td>
								@for ($i = 1; $i <= 18; $i++)
								<td><input type="text" size="2" name="{{'hdcp' . $i}}"
									value="{{old('hdcp' . $i)}}"></td>
								@endfor
								<td></td>
							</tr>                        
						</table>
						<input type="submit" value="submit" name="submit">
					 </form>
@endsection
