@extends("layouts.app")
@section("title", "Recommendation")

@section("content")
    <section>
        <div>
            <h2>
                Recommendations
            </h2>
        </div>
        <div>
            @if(\Illuminate\Support\Facades\Session::has('success'))
                <p class="alert alert-success" role="alert">
                    {{\Illuminate\Support\Facades\Session::get('success')}}
                </p>
            @endif
            @if(\Illuminate\Support\Facades\Session::has('error'))
                <p class="alert alert-danger" role="alert">
                    {{\Illuminate\Support\Facades\Session::get('error')}}
                </p>
            @endif
        </div>
        <div>
{{--            left--}}
            <div>
                <form method="POST" action="{{route('getRecommendation')}}">
                    @csrf
                    <table>
                        <tr>
                            <td>
                                <label for="location">Flat:</label>
                            </td>
                            <td>
                                <select id="flat" name="flat">
                                    <option value="0">-Select Location-</option>
                                    @foreach($data['flats'] as $flat)
                                        <option value="{{$flat->id}}">{{$flat->title}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="location">Location:</label>
                            </td>
                            <td>
                                <select id="location" name="location">
                                    <option value="0">-Select Location-</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="rent">Rent:</label>
                            </td>
                            <td>
                                <select id="rent" name="rent">
                                    <option value="0">-Select Rent-</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="category">Category:</label>
                            </td>
                            <td>
                                <select id="category" name="category" disabled>
                                    <option value="0">-Select Category-</option>
                                </select>
                                <span>
                            <input type="checkbox" id="toggle_ward" checked> Exclude Ward
                            <input type="hidden" id="ward_enabled" name="ward_enabled" value="0">
                        </span>
                            </td>
                        </tr>
                        <tr>
                            <td>

                            </td>
                            <td>
                                <input type="submit" value="Get recommendation" id="submit">
                                <p id="error_submit" class="alert alert-danger" role="alert" style="display:none;"></p>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
{{--            right recommendation--}}
            <div>
                @if($data['recommendations'] == [])
{{--                    <p>No match found on location</p>--}}
                @elseif($data['recommendations']->isEmpty())
                    <p>No match found on location</p>
                @else
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Location</th>
                        </tr>
                        @foreach($data['recommendations'] as $rec)
                            <tr>
                                <td>{{$rec->title}}</td>
                                <td>{{$rec->category}}-{{$rec->rent}}, {{$rec->location}}, {{$rec->flat}}</td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            </div>
        </div>
        <div>
            <div>
                
            </div>
            <div>
                <a href="{{route('home.userpage')}}">
                    <button>Back to Main</button>
                </a>
            </div>
        </div>
    </section>
    <script>
        document.getElementById('toggle_category').addEventListener('change', function () {
            if(document.getElementById('toggle_category').checked === true) {
                document.getElementById('category_enabled').value = '0';
                document.getElementById('category').disabled = true;
            } else {
                document.getElementById('category_enabled').value = '1';
                document.getElementById('category').disabled = false;
            }
        });
        // get districts from province selected
        $('#flat').change(function () {
            $.ajax({
                type: 'POST',
                url: '/location/getLocactions',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    province:  $('#flat').val()
                },
                success: function (districts) {
                    let option_all = '<option value="0">-Select Location-</option>';
                    for (let i = 0; i < locationss.length; i++) {
                        option_all = option_all + '<option value="' + locactions[i].id + '">' + locations[i].location + '</option>';
                    }
                    $('#location').html(option_all);
                }
            });
        });
        // get metropolitans from districts selected
        $('#locaction').change(function () {
            $.ajax({
                type: 'POST',
                url: '/rent/getrents',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    location:  $('#location').val()
                },
                success: function (metropolitans) {
                    let option_all = '<option value="0">-Select Rent-</option>';
                    for (let i = 0; i < metropolitans.length; i++) {
                        option_all = option_all + '<option value="' + rents[i].id + '">' + rents[i].rent + '</option>';
                    }
                    $('#rent').html(option_all);
                }
            });
        });
        // get max wards from metropolitan selected
        $('#rent').change(function () {
            $.ajax({
                type: 'POST',
                url: '/rent/getCategories',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                   rent:  $('#rent').val()
                },
                success: function (wards) {
                    let max_wards = wards[0].wards;
                    let option_all = '<option value="0">-Select Category-</option>';
                    for (let i = 1; i <= max_categories; i++) {
                        option_all = option_all + '<option value="' + i + '">' + i + '</option>';
                    }
                    $('#catgory').html(option_all);
                }
            });
        });
        $('#category').change(function () {
            $.ajax({
                type: 'POST',
                url: '/flat/getFlats',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    rent:  $('#rent').val(),
                    category:  $('#category').val()
                },
                success: function (flats) {
                    let option_all = '<option value="0">-Select Flat-</option>';
                    for (let i = 0; i < flats.length; i++) {
                        console.log(i);
                        option_all = option_all + '<option value="' + flats[i].cs_id + '">' + flats[i].title + '</option>';
                    }
                    $('#flat').html(option_all);
                }
            });
        });
        $('#submit').click(function () {
            if($('#rent').val() == 0) {
                document.getElementById('error_submit').style.display = 'block';
                $('#error_submit').html("Please select a valid location.");
                return false;
            }
        });
    </script>
@endsection


