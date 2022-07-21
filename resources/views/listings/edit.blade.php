<x-layout>
    <link rel="stylesheet" types = "text/css" href="/css/createListing.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="listings-parent-container crud" style="padding-bottom: 50px; padding-top: 50px;">
        <div class ="container">
           <div class="createListingSection">

                <div class="back-button">
                    <a href="javascript:history.back()" class="button1 b-button">
                        <i class="fa-solid fa-arrow-left"></i> Back
                    </a>
                </div> 

                <div class="info">
                    <h1>Lorem ipsum dolor sit amet consectetur.</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus eum tempore nam consectetur, possimus dolorum quidem tempora et laboriosam est deleniti sunt modi, provident quasi!</p>
                    <br>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptate temporibus ab excepturi doloremque cumque.</p>
                </div>

                <div class = "listingFormContainer">
 
                    {{-- SOURCE CODE FROM CODE PEN --}}
                    {{-- LINK: https://codepen.io/webbarks/pen/QWjwWNV --}}
                    <div id="svg_wrap"></div>
                    <h1 style="padding: 5px 15px;">Update My Listing</h1>
                    <form class="listingForm" method = "POST" action="/listings/{{$listing->id}}" id="listingForm"
                    enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="user_id"  value="{{ old('user_id', '3') }}"
                        >

                        {{-- card #1 --}}
                        <section class = "listingCard default-card">
                            <p class="create-listing-header">Item Description</p>
                            <input type="text" name = "item_name" placeholder="Item Title"  value="{{ $listing->item_name}}" />
                            @error('item_name')
                                <p>{{$message}}</p>
                            @enderror
                            <input type="number" min="0.00" name = "price" max="10000.00" step="0.01" placeholder="Price or 0 for free"  value="{{ $listing->price }}"/>
                            @error('price')
                                <p>{{$message}}</p>
                            @enderror

                            <p class="create-listing-header">
                                Price Negotiable, Fixed, or Free
                            </p>
                            <div class="condition-box">
                                <select name="negotiable" id="">
                                     <option value="Fixed"{{ $listing->negotiable == 'Fixed' ? "selected":""}}>Fixed</option>
                                    
                                    <option value="Negotiable" {{ $listing->negotiable == 'Negotiable' ? "selected":""}}
                                        >Negotiable/ OBO (best offer)</option>

                                    <option value="Free" {{ $listing->negotiable == 'Free' ? "selected":""}}>Free</option>
                                </select>
                                @error('negotiable')
                                    <p>{{$message}}</p>
                                @enderror
                            </div>

                            <p class="create-listing-header">Condition</p>
                            <div class ="conditionBox">
                                <select name="condition" id="">
                                    <option value="New" {{ $listing->condition == 'New' ? "selected":""}}>New</option>

                                    <option value="Good" 
                                    {{ $listing->condition == 'Good' ? "selected":""}}
                                    >Good</option>
                                    <option value="Slightly Used" {{ $listing->condition == 'Slightly Used' ? "selected":""}}>Slightly Used </option>
                                    <option value="Used Normal Wear" {{ $listing->condition == 'Used Normal Wear' ? "selected":""}}>Used Normal Wear </option>
                                </select>
                                @error('condition')
                                    <p>{{$message}}</p>
                                @enderror
                            </div>

                            <p class="create-listing-header">Categories</p>
                            <div class ="conditionBox">
                                @php
                                    $categories = explode(", ", $listing->category);
                                    while(count($categories)<6)
                                        array_push($categories, '')
                                    
                                @endphp
                                <ul class="ks-cboxtags">
                                    <li>
                                        <input type="checkbox" name="category[]" id="checkboxSix" value="Furniture" 
                                        {{ $categories[0] == 'Furniture' ? 'checked' : '' }}
                                        {{ $categories[1] == 'Furniture' ? 'checked' : '' }}
                                        {{ $categories[2] == 'Furniture' ? 'checked' : '' }}
                                        {{ $categories[3] == 'Furniture' ? 'checked' : '' }}
                                        {{ $categories[4] == 'Furniture' ? 'checked' : '' }}
                                        {{ $categories[5] == 'Furniture' ? 'checked' : '' }}
                                        >
                                        <label for="checkboxSix"
                                        >Furniture</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="category[]" id="checkboxSeven" value="Clothes"
                                        {{ $categories[0]  == 'Clothes' ? 'checked' : '' }}
                                        {{ $categories[1]  == 'Clothes' ? 'checked' : '' }}
                                        {{ $categories[2]  == 'Clothes' ? 'checked' : '' }}
                                        {{ $categories[3]  == 'Clothes' ? 'checked' : '' }}
                                        {{ $categories[4]  == 'Clothes' ? 'checked' : '' }}
                                        {{ $categories[5]  == 'Clothes' ? 'checked' : '' }}
                                        >
                                        <label for="checkboxSeven">Clothes</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="category[]" id="checkboxEight" value="Electronics" 
                                        {{ $categories[0]  == 'Electronics' ? 'checked' : '' }}
                                        {{ $categories[1] == 'Electronics' ? 'checked' : '' }}
                                        {{ $categories[2]  == 'Electronics' ? 'checked' : '' }}
                                        {{ $categories[3]  == 'Electronics' ? 'checked' : '' }}
                                        {{ $categories[4] == 'Electronics' ? 'checked' : '' }}
                                        {{ $categories[5] == 'Electronics' ? 'checked' : '' }}
                                        >
                                        <label for="checkboxEight">Electronics</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="category[]" id="checkboxNine" value="Kitchen"
                                        {{ $categories[0]  == 'Kitchen' ? 'checked' : '' }}
                                        {{ $categories[1]  == 'Kitchen' ? 'checked' : '' }}
                                        {{ $categories[2]  == 'Kitchen' ? 'checked' : '' }}
                                        {{ $categories[3]  == 'Kitchen' ? 'checked' : '' }}
                                        {{ $categories[4]  == 'Kitchen' ? 'checked' : '' }}
                                        {{ $categories[5]  == 'Kitchen' ? 'checked' : '' }}
                                        >
                                        <label for="checkboxNine">Kitchen</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="category[]" id="checkboxTen" value="School Accessories"
                                        {{ $categories[0]  == 'School Accessories' ? 'checked' : '' }}
                                        {{ $categories[1]  == 'School Accessories' ? 'checked' : '' }}
                                        {{ $categories[2]  == 'School Accessories' ? 'checked' : '' }}
                                        {{ $categories[3]  == 'School Accessories' ? 'checked' : '' }}
                                        {{ $categories[4] == 'School Accessories' ? 'checked' : '' }}
                                        {{ $categories[5] == 'School Accessories' ? 'checked' : '' }}
                                        >
                                        <label for="checkboxTen">School Accessories</label>
                                    </li>
                                     <li>
                                        <input type="checkbox" name="category[]" id="checkboxEleven" value="Books"
                                        {{ $categories[0]  == 'Books' ? 'checked' : '' }}
                                        {{ $categories[1]  == 'Books' ? 'checked' : '' }}
                                        {{ $categories[2]  == 'Books' ? 'checked' : '' }}
                                        {{ $categories[3]  == 'Books' ? 'checked' : '' }}
                                        {{ $categories[4] == 'Books' ? 'checked' : '' }}
                                        {{ $categories[5] == 'Books' ? 'checked' : '' }}
                                        >
                                        <label for="checkboxEleven">Books</label>
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
                            <input name = "tags" type="text" placeholder="Tags" value="{{ $listing->tags}}"/>
                            @error('tags')
                                <p>{{$message}}</p>
                            @enderror
                            <textarea name="description" placeholder="Description" rows="3" style="resize: none;">{{ $listing->description }}</textarea>
                            @error('description')
                                <p>{{$message}}</p>
                            @enderror
                            <p class="create-listing-header">Attach Images</p>
                            <input class="imgUpload" type="file" id="image_uploads" name="image_uploads[]" accept=".jpg, .jpeg, .png" multiple >
                            <div class="preview">
                                {{-- <h6>No files selected</h6> --}}
                                <ul class = "user-img-list">
                                    @if(is_array(json_decode($listing->image_uploads)))
                                        @foreach(json_decode($listing->image_uploads) as $link)
                                            <li>
                                                 <img src={{$listing->image_uploads ? Storage::disk('s3')->url($link) : asset('/images/rotunda.jpg')}} alt = "User Uploads">
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
                            <p class="create-listing-header">Location</p>
                            <input type="text" id = "street" name="street" placeholder="Enter a Location*"  value="{{ $listing->street }}"/>
                            @error('street')
                                <p>{{$message}}</p>
                            @enderror
                            <input type="text" id = "apartment_floor" name="apartment_floor" placeholder="Apartment, unit, suite, or floor #"  value="{{ $listing->apartment_floor }}"/>
                            <input type="text" id = "city" name = "city" placeholder="City*"  value="{{ $listing->city }}"/>
                            @error('city')
                                <p>{{$message}}</p>
                            @enderror
                            <input type="text" id = "state" name = "state" placeholder="State*"  value="{{ $listing->state }}"/>
                            @error('state')
                                <p>{{$message}}</p>
                            @enderror
                            <input type="text" id = "country" name = "country" placeholder="Country*"  value="{{ $listing->country }}" />
                            @error('country')
                                <p>{{$message}}</p>
                            @enderror
                            <input type="text" id = "postcode" name = "postcode"placeholder="Postcode*"  value="{{ $listing->postcode }}" />
                            @error('postcode')
                                <p>{{$message}}</p>
                            @enderror

                            <input type="hidden" name="latitude" id ="latitude" value = "{{$listing->latitude}}">
                            <input type="hidden" name="longitude" id = "longitude" value = "{{$listing->longitude}}">

                            <p class="create-listing-header">Use My Location:</p>
                            <h6 onclick="getLocation()" class = "preview" id="location" style="font-size:1em;">
                                @if($listing->latitude != null and $listing->longitude != null)
                                    Latitude: {{$listing->latitude}} Longitude: {{$listing->longitude}}
                                @else
                                    Get My Location
                                @endif
                            </h6>
                        </section>


                        <div class = "listingButtonsContainer">
                            <div class="button" id="prev">&larr; Previous</div>
                            <div class="button" id="next">Next &rarr;</div>
                            <button class="submit-create-listing button" id="submit" type="submit">
                                Update Listing
                            </button>
                            {{-- <div class="button" id="submit" type="submit">Post</div> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>

        // $(document).ready(function(){
        //    $(function() {
        //         $("#select option").each(function(i){
        //             alert($(this).text() + " : " + $(this).val());
        //         });
        //     });
        // });
        // source code from code pen
        // link: https://codepen.io/webbarks/pen/QWjwWNV
        // script to change between view cards for create listing
        $( document ).ready(function() {
            var base_color = "black";
            // var active_color = "rgb(237, 40, 70)";
            var active_color = "#db6657";

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
                currentSection.css('display', 'flex');
                currentSection.css('flex-direction', 'column');

                currentSection.prevAll('section').css('transform','translateX(-100px)');
                currentSection.nextAll('section').css('transform','translateX(100px)');
                $('section').not(currentSection).hide();
            });

        });

        const input = document.querySelector('.imgUpload');
        const preview = document.querySelector('.preview');

        $('form').submit(function(e){
            for(const tempFile of input.files){
                if(validFileType(tempFile)) {
                    if (tempFile.size > 5*1024*1024) {
                        alert("Too large Image. Only images smaller than 5MB can be uploaded. Only images smaller then 5MB will be kept");
                        e.preventDefault();
                        break;
                    }
                }
            }      
            e.currentTarget.submit();     
        });

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

                var userAlerted = false;
                for(const file of curFiles) {
                    const listItem = document.createElement('li');
                    const para = document.createElement('p');
                    if(validFileType(file)) {
                        const image = document.createElement('img');
                        image.src = URL.createObjectURL(file);

                        listItem.appendChild(image);

                        if (file.size > 5*1024*1024 ) {
                            if(!userAlerted){
                                alert("Too large Image. Only images smaller than 5MB can be uploaded. Only images smaller then 5MB will be kept");
                                userAlerted=true;
                            }
                            para.innerHTML = returnFileSize(file.size) + '<i class="fa fa-times" aria-hidden="true"></i>';
                            para.classList.add("file-details", "not-approved");
                        }else{ //the approved images with a check mark
                            para.innerHTML = returnFileSize(file.size) + '<i class="fa fa-check" aria-hidden="true"></i>';
                            para.classList.add("file-details", "approved");
                        }
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

        function initAutocomplete() {
            address1Field = document.getElementById("street");
            address2Field = document.getElementById("streetTwo");
            postalField = document.getElementById("postcode");

            // Create the autocomplete object, restricting the search predictions to
            // addresses in the US and Canada.
            autocomplete = new google.maps.places.Autocomplete(address1Field, {
            componentRestrictions: { country: ["us"] },
            fields: ["address_components", "geometry"],
            types: ["address"],
            });
            address1Field.focus();

            // When the user selects an address from the drop-down, populate the
            // address fields in the form.
            autocomplete.addListener("place_changed", fillInAddress);
        }

        function fillInAddress() {
            // Get the place details from the autocomplete object.
            const place = autocomplete.getPlace();
            let address1 = "";
            let postcode = "";

            // Get each component of the address from the place details,
            // and then fill-in the corresponding field on the form.
            // place.address_components are google.maps.GeocoderAddressComponent objects
            // which are documented at http://goo.gle/3l5i5Mr
            for (const component of place.address_components) {
                // @ts-ignore remove once typings fixed
                const componentType = component.types[0];

                switch (componentType) {
                    case "street_number": {
                    address1 = `${component.long_name} ${address1}`;
                    break;
                }
                case "route": {
                    address1 = `${address1}${component.long_name} `;
                    break;
                }
                case "postal_code": {
                    postcode = `${component.long_name}${postcode}`;
                    break;
                }

                case "postal_code_suffix": {
                    postcode = `${postcode}-${component.long_name}`;
                    break;
                }

                case "locality":
                    (document.getElementById("city")).value =
                    component.long_name;
                    break;

                case "administrative_area_level_1": {
                    (document.getElementById("state")).value =
                    component.short_name;
                    break;
                }

                case "country":
                    (document.getElementById("country")).value =
                    component.long_name;
                    break;
                }
            }
            address1Field.value = address1;
            postalField.value = postcode;

            // After filling the form with address components from the Autocomplete
            // prediction, set cursor focus on the second address line to encourage
            // entry of subpremise information such as apartment, unit, or floor number.
            address2Field.focus();
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError, options);
            } else { 
                console.log("location not supported")
            }
        }

        function showPosition(position) {
            var latitude = position.coords.latitude;
            var longitude =  position.coords.longitude;
            console.log("Latitude: " + latitude + 
            "<br>Longitude: " + longitude);

            var test = document.getElementById("location");
            test.innerHTML =" Latitude: " + latitude + 
            " Longitude: " + longitude;
            document.getElementById('latitude').value=latitude;
            document.getElementById('longitude').value=longitude;
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

        var options = {
            enableHighAccuracy: true,
            timeout: 1000,
            maximumAge: 0
        };
    </script>
    <script async
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHQxwBJAiHYROOX3zT6P7AwnBq1WGVmnM&callback=initAutocomplete&libraries=places&v=weekly"
      defer
    ></script>
</x-layout>