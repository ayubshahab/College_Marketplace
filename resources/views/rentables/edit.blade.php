<x-layout>
    <link rel="stylesheet" types = "text/css" href="/css/createListing.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="listings-parent-container" style="padding-bottom: 50px; padding-top: 50px;">
        <div class ="container">
           <div class="createListingSection">
                <div class="info">
                    
                </div>
                <div class = "listingFormContainer">

                    {{-- SOURCE CODE FROM CODE PEN --}}
                    {{-- LINK: https://codepen.io/webbarks/pen/QWjwWNV --}}
                    <div id="svg_wrap"></div>
                    <h1>Update My Rental</h1>
                    <form class="listingForm" method = "POST" action="/rentables/{{$rentable->id}}" id="listingForm"
                    enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="user_id"  value="{{ old('user_id', '3') }}"
                        >

                        {{-- card #1 --}}
                        <section class = "listingCard">
                            <p class="create-listing-header">Rental Details</p>
                            <input type="text" name = "rental_title" placeholder="Rental Title"  value="{{ $rentable->rental_title }}" />
                            @error('rental_title')
                                <p>{{$message}}</p>
                            @enderror
                            

                            <p class="create-listing-header">
                                Rental Duration
                            </p>
                            <div class="condition-box">
                                <select name="rental_duration" id="rentalDuration">
                                    <option value="Hourly" {{ $rentable->rental_duration == 'Hourly' ? "selected":""}}>Hourly</option>
                                    
                                    <option value="Daily" {{  $rentable->rental_duration == 'Daily' ? "selected":""}}>Daily</option>

                                    <option value="Weekly" {{  $rentable->rental_duration == 'Weekly' ? "selected":""}}>Weekly</option>

                                    <option value="Monthly" {{ $rentable->rental_duration == 'Monthly' ? "selected":""}}>Monthly</option>
                                </select>
                                @error('rental_duration')
                                    <p>{{$message}}</p>
                                @enderror
                            </div>

                            <input id="rental_charging" type="number" min="0.00" name = "rental_charging" max="10000.00" step="0.01" placeholder="Rental Price per Hour "  value="{{ $rentable->rental_charging }}"/>
                            @error('rental_charging')
                                <p>{{$message}}</p>
                            @enderror

                            <p class="create-listing-header">Condition</p>
                            <div class ="conditionBox">
                                <select name="condition" id="">
                                    <option value="New" {{ $rentable->condition == 'New' ? "selected":""}}>New</option>

                                    <option value="Good" 
                                    {{ $rentable->condition == 'Good' ? "selected":""}}
                                    >Good</option>
                                    <option value="Slightly Used" {{ $rentable->condition == 'Slightly Used' ? "selected":""}}>Slightly Used </option>
                                    <option value="Used Normal Wear" {{ $rentable->condition == 'Used Normal Wear' ? "selected":""}}>Used Normal Wear </option>
                                </select>
                                @error('condition')
                                    <p>{{$message}}</p>
                                @enderror
                            </div>

                            <p class="create-listing-header">Categories</p>
                            <div class ="conditionBox">
                                 @php
                                    $categories = explode(", ", $rentable->category);
                                    while(count($categories)<5)
                                        array_push($categories, '')
                                    
                                @endphp
                                <ul class="ks-cboxtags">
                                    <li>
                                        <input type="checkbox" name="category[]" id="checkboxSix" value="Furniture" 
                                        {{ $categories[0] == 'Furniture' ? 'checked' : '' }}
                                        {{ $categories[1] == 'Furniture' ? 'checked' : '' }}
                                        {{ $categories[2] == 'Furniture' ? 'checked' : '' }}
                                        {{ $categories[3] == 'Furniture' ? 'checked' : '' }}
                                        {{ $categories[4] == 'Furniture' ? 'checked' : '' }}>
                                        <label for="checkboxSix"
                                        >Furniture</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="category[]" id="checkboxSeven" value="Clothes"
                                        {{ $categories[0]  == 'Clothes' ? 'checked' : '' }}
                                        {{ $categories[1]  == 'Clothes' ? 'checked' : '' }}
                                        {{ $categories[2]  == 'Clothes' ? 'checked' : '' }}
                                        {{ $categories[3]  == 'Clothes' ? 'checked' : '' }}
                                        {{ $categories[4]  == 'Clothes' ? 'checked' : '' }}>
                                        <label for="checkboxSeven">Clothes</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="category[]" id="checkboxEight" value="Electronics" 
                                        {{ $categories[0]  == 'Electronics' ? 'checked' : '' }}
                                        {{ $categories[1] == 'Electronics' ? 'checked' : '' }}
                                        {{ $categories[2]  == 'Electronics' ? 'checked' : '' }}
                                        {{ $categories[3]  == 'Electronics' ? 'checked' : '' }}
                                        {{ $categories[4] == 'Electronics' ? 'checked' : '' }}>
                                        <label for="checkboxEight">Electronics</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="category[]" id="checkboxNine" value="Kitchen"
                                        {{ $categories[0]  == 'Kitchen' ? 'checked' : '' }}
                                        {{ $categories[1]  == 'Kitchen' ? 'checked' : '' }}
                                        {{ $categories[2]  == 'Kitchen' ? 'checked' : '' }}
                                        {{ $categories[3]  == 'Kitchen' ? 'checked' : '' }}
                                        {{ $categories[4]  == 'Kitchen' ? 'checked' : '' }}>
                                        <label for="checkboxNine">Kitchen</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="category[]" id="checkboxTen" value="School Accessories"
                                        {{ $categories[0]  == 'School Accessories' ? 'checked' : '' }}
                                        {{ $categories[1]  == 'School Accessories' ? 'checked' : '' }}
                                        {{ $categories[2]  == 'School Accessories' ? 'checked' : '' }}
                                        {{ $categories[3]  == 'School Accessories' ? 'checked' : '' }}
                                        {{ $categories[4] == 'School Accessories' ? 'checked' : '' }}>
                                        <label for="checkboxTen">School Accessories</label>
                                    </li>
                                </ul>
                                @error('category')
                                    <p>{{$message}}</p>
                                @enderror
                            </div>      
                        </section>

                        {{-- card #2 --}}
                        <section class = "listingCard">
                            <p class="create-listing-header">Sub-Categories/ Tags (comma seperated)</p>
                            <input name = "tags" type="text" placeholder="Tags" value="{{ $rentable->tags}}"/>
                            @error('tags')
                                <p>{{$message}}</p>
                            @enderror
                            <textarea name="description" placeholder="Description" rows="3" style="resize: none;">{{ $rentable->description }}</textarea>
                            @error('description')
                                <p>{{$message}}</p>
                            @enderror
                            <p class="create-listing-header">Attach Images</p>
                            <input class="imgUpload" type="file" id="image_uploads" name="image_uploads[]" accept=".jpg, .jpeg, .png" multiple >
                            <div class="preview">
                                {{-- <h6>No files selected</h6> --}}
                                <ul class = "user-img-list">
                                    @if(is_array(json_decode($rentable->image_uploads)))
                                        @foreach(json_decode($rentable->image_uploads) as $link)
                                            <li>
                                                 <img src={{$rentable->image_uploads ? Storage::disk('s3')->url($link): asset('/images/rotunda.jpg')}} alt = "User Uploads">
                                            </li>
                                        @endforeach
                                    @else
                                        <h6>No files uploaded</h6>
                                    @endif
                                </ul>
                            </div>
                            @error('image_uploads')
                                <p>{{$message}}</p>
                            @enderror
                        </section>

                        {{-- card #3 --}}
                        <section class = "listingCard">
                            <p class="create-listing-header">Address:</p>
                            <input type="text" name="street" placeholder="Street, nbr"  value="{{ $rentable->street}}"/>
                            @error('street')
                                <p>{{$message}}</p>
                            @enderror
                            <input type="text" name = "city" placeholder="City"  value="{{$rentable->city }}"/>
                            @error('city')
                                <p>{{$message}}</p>
                            @enderror
                            <input type="text" name = "state" placeholder="State"  value="{{ $rentable->state}}"/>
                            @error('state')
                                <p>{{$message}}</p>
                            @enderror
                            <input type="text" name = "country" placeholder="Country"  value="{{$rentable->country }}" />
                            @error('country')
                                <p>{{$message}}</p>
                            @enderror
                            <input type="text" name = "postcode" placeholder="Postcode"  value="{{$rentable->postcode }}" />
                            @error('postcode')
                                <p>{{$message}}</p>
                            @enderror

                            {{-- <p class="create-listing-header">Use My Location:</p>
                            <div onclick="getLocation()">Get Location</div> --}}
                        </section>


                        <div class = "listingButtonsContainer">
                            <div class="button" id="prev">&larr; Previous</div>
                            <div class="button" id="next">Next &rarr;</div>
                            <button class="submit-create-listing button" id="submit" type="submit">
                                Submit
                            </button>
                            {{-- <div class="button" id="submit" type="submit">Post</div> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else { 
                console.log("location not supported")
            }
        }

        function showPosition(position) {
           console.log("Latitude: " + position.coords.latitude + 
            "<br>Longitude: " + position.coords.longitude);
        }

        function showError(error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    console.log("User denied the request for Geolocation.");
                break;
                case error.POSITION_UNAVAILABLE:
                    console.log("Location information is unavailable.");
                break;
                case error.TIMEOUT:
                    console.log( "The request to get user location timed out.");
                break;
                case error.UNKNOWN_ERROR:
                    console.log( "An unknown error occurred.");
                break;
            }
        }

        // source code from code pen
        // link: https://codepen.io/webbarks/pen/QWjwWNV
        // script to change between view cards for create listing
        $( document ).ready(function() {

            $("#rental_charging").attr("placeholder", "Rental Price per Hour");
            $('#rentalDuration').change(function(){
                switch ($(this).val()){
                    case 'Hourly':
                        $("#rental_charging").attr("placeholder", "Rental Price per Hour");
                        break;
                    case 'Daily':
                        $("#rental_charging").attr("placeholder", "Rental Price per Day");
                        break;
                    case 'Weekly':
                        $("#rental_charging").attr("placeholder", "Rental Price per Week");
                        break;
                    case 'Monthly':
                        $("#rental_charging").attr("placeholder", "Rental Price per Month");
                        break;
                }
            })

            var base_color = "rgb(230,230,230)";
            // var active_color = "rgb(237, 40, 70)";
            var active_color = "#cc5500";

            var child = 1;
            var length = $("section").length - 1;
            $("#prev").addClass("disabled");
            $("#submit").addClass("disabled");

            $("section").not("section:nth-of-type(1)").hide();
            $("section").not("section:nth-of-type(1)").css('transform','translateX(100px)');

            var svgWidth = length * 200 + 24;
            $("#svg_wrap").html(
            '<svg version="1.1" id="svg_form_time" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 ' +
                svgWidth +
                ' 24" xml:space="preserve"></svg>'
            );

            function makeSVG(tag, attrs) {
                var el = document.createElementNS("http://www.w3.org/2000/svg", tag);
                for (var k in attrs) 
                    el.setAttribute(k, attrs[k]);
                return el;
            }

            for (i = 0; i < length; i++) {
                var positionX = 12 + i * 200;
                var rect = makeSVG("rect", { x: positionX, y: 9, width: 200, height: 6 });
                document.getElementById("svg_form_time").appendChild(rect);
                // <g><rect x="12" y="9" width="200" height="6"></rect></g>'
                var circle = makeSVG("circle", {
                    cx: positionX,
                    cy: 12,
                    r: 12,
                    width: positionX,
                    height: 6
                });
                document.getElementById("svg_form_time").appendChild(circle);
            }

            var circle = makeSVG("circle", {
                cx: positionX + 200,
                cy: 12,
                r: 12,
                width: positionX,
                height: 6
            });
            document.getElementById("svg_form_time").appendChild(circle);

            $('#svg_form_time rect').css('fill',base_color);
            $('#svg_form_time circle').css('fill',base_color);
            $("circle:nth-of-type(1)").css("fill", active_color);

            
            $(".button").click(function () {
                $("#svg_form_time rect").css("fill", active_color);
                $("#svg_form_time circle").css("fill", active_color);
                var id = $(this).attr("id");
                if (id == "next") {
                    $("#prev").removeClass("disabled");
                    if (child >= length) {
                    $(this).addClass("disabled");
                    $('#submit').removeClass("disabled");
                    }
                    if (child <= length) {
                    child++;
                    }
                } else if (id == "prev") {
                    $("#next").removeClass("disabled");
                    $('#submit').addClass("disabled");
                    if (child <= 2) {
                    $(this).addClass("disabled");
                    }
                    if (child > 1) {
                    child--;
                    }
                }
                var circle_child = child + 1;
                $("#svg_form_time rect:nth-of-type(n + " + child + ")").css(
                    "fill",
                    base_color
                );
                $("#svg_form_time circle:nth-of-type(n + " + circle_child + ")").css(
                    "fill",
                    base_color
                );
                var currentSection = $("section:nth-of-type(" + child + ")");
                currentSection.fadeIn();
                currentSection.css('transform','translateX(0)');
                currentSection.prevAll('section').css('transform','translateX(-100px)');
                currentSection.nextAll('section').css('transform','translateX(100px)');
                $('section').not(currentSection).hide();
            });

        });


        // source code link: https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/file
        //script to process img upload and show previews
        const input = document.querySelector('.imgUpload');
        const preview = document.querySelector('.preview');

        // input.style.opacity = 0;
        input.addEventListener('change', updateImageDisplay);
        function updateImageDisplay() {
            while(preview.firstChild) {
                preview.removeChild(preview.firstChild);
            }

            const curFiles = input.files;
            if(curFiles.length === 0) {
                const para = document.createElement('p');
                para.textContent = 'No files selected';
                preview.appendChild(para);
            }else if(curFiles.length >5){
                const para = document.createElement('p');
                para.textContent = 'Please select less than 5 images';
                preview.appendChild(para);
                input.value = null;
            } else {
                const list = document.createElement('ul');
                list.className="user-img-list";
                preview.appendChild(list);

                for(const file of curFiles) {
                const listItem = document.createElement('li');
                const para = document.createElement('p');
                if(validFileType(file)) {
                    const image = document.createElement('img');
                    image.src = URL.createObjectURL(file);

                    listItem.appendChild(image);
                    listItem.appendChild(para);
                } else {
                    para.textContent = `File name ${file.name}: Not a valid file type. Update your selection.`;
                    listItem.appendChild(para);
                }

                list.appendChild(listItem);
                }
            }
        }

        const fileTypes = [
            "image/apng",
            "image/bmp",
            "image/gif",
            "image/jpeg",
            "image/pjpeg",
            "image/png",
            "image/svg+xml",
            "image/tiff",
            "image/webp",
            "image/x-icon"
        ];

        function validFileType(file) {
            return fileTypes.includes(file.type);
        }

        function returnFileSize(number) {
            if(number < 1024) {
                return number + 'bytes';
            } else if(number >= 1024 && number < 1048576) {
                return (number/1024).toFixed(1) + 'KB';
            } else if(number >= 1048576) {
                return (number/1048576).toFixed(1) + 'MB';
            }
        }

    </script>
</x-layout>