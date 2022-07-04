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
                    {{-- <div id="svg_wrap"></div> --}}
                    <h1>Post An Item!</h1>
                    <form class="listingForm" method = "POST" action="/listings" id="listingForm"
                    enctype="multipart/form-data">
                        @csrf
                        
                        <input type="hidden" name="user_id"  value="{{ old('iser_id', '3') }}"
                        >

                        {{-- card #1 --}}
                        <section class = "listingCard">
                            <p class="create-listing-header">Item Description</p>
                            <input type="text" name = "item_name" placeholder="Item Title"  value="{{ old('item_name', null) }}" />
                            @error('item_name')
                                <p>{{$message}}</p>
                            @enderror
                            <input type="number" min="0.00" name = "price" max="10000.00" step="0.01" placeholder="Price or 0 for free"  value="{{ old('price', null) }}"/>
                            @error('price')
                                <p>{{$message}}</p>
                            @enderror

                            <p class="create-listing-header">
                                Price Negotiable, Fixed, or Free
                            </p>
                            <div class="condition-box">
                                <select name="negotiableFree" id="">
                                    <option value="Fixed" {{ (old("negotiableFree") == 'Fixed' ? "selected":"") }}>Fixed</option>
                                    
                                    <option value="Negotiable" {{ (old("negotiableFree") == 'Negotiable' ? "selected":"") }}>Negotiable/ OBO (best offer)</option>

                                    <option value="Free" {{ (old("negotiableFree") == 'Free' ? "selected":"") }}>Free</option>
                                </select>
                                @error('negotiableFree')
                                    <p>{{$message}}</p>
                                @enderror
                            </div>

                            <p class="create-listing-header">Condition</p>
                            <div class ="conditionBox">
                                <select name="condition" id="">
                                    <option value="New" {{ (old("condition") == 'New' ? "selected":"") }}>New</option>
                                    <option value="Good" {{ (old("condition") == 'Good' ? "selected":"") }}>Good</option>
                                    <option value="Slightly Used" {{ (old("condition") == 'Slightly Used' ? "selected":"") }}>Slightly Used </option>
                                    <option value="Used Normal Wear" {{ (old("condition") == 'Used Normal Wear' ? "selected":"") }}>Used Normal Wear </option>
                                </select>
                                @error('condition')
                                    <p>{{$message}}</p>
                                @enderror
                            </div>

                            <p class="create-listing-header">Categories</p>
                            <div class ="conditionBox">
                                <ul class="ks-cboxtags">
                                    <li>
                                        <input type="checkbox" name="category[]" id="checkboxSix" value="Furniture" 
                                        {{ old('category.0') == 'Furniture' ? 'checked' : '' }}
                                        {{ old('category.1') == 'Furniture' ? 'checked' : '' }}
                                        {{ old('category.2') == 'Furniture' ? 'checked' : '' }}
                                        {{ old('category.3') == 'Furniture' ? 'checked' : '' }}
                                        {{ old('category.4') == 'Furniture' ? 'checked' : '' }}>
                                        <label for="checkboxSix"
                                        >Furniture</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="category[]" id="checkboxSeven" value="Clothes"
                                        {{ old('category.0') == 'Clothes' ? 'checked' : '' }}
                                        {{ old('category.1') == 'Clothes' ? 'checked' : '' }}
                                        {{ old('category.2') == 'Clothes' ? 'checked' : '' }}
                                        {{ old('category.3') == 'Clothes' ? 'checked' : '' }}
                                        {{ old('category.4') == 'Clothes' ? 'checked' : '' }}>
                                        <label for="checkboxSeven">Clothes</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="category[]" id="checkboxEight" value="Electronics" 
                                        {{ old('category.0') == 'Electronics' ? 'checked' : '' }}
                                        {{ old('category.1') == 'Electronics' ? 'checked' : '' }}
                                        {{ old('category.2') == 'Electronics' ? 'checked' : '' }}
                                        {{ old('category.3') == 'Electronics' ? 'checked' : '' }}
                                        {{ old('category.4') == 'Electronics' ? 'checked' : '' }}>
                                        <label for="checkboxEight">Electronics</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="category[]" id="checkboxNine" value="Kitchen"
                                        {{ old('category.0') == 'Kitchen' ? 'checked' : '' }}
                                        {{ old('category.1') == 'Kitchen' ? 'checked' : '' }}
                                        {{ old('category.2') == 'Kitchen' ? 'checked' : '' }}
                                        {{ old('category.3') == 'Kitchen' ? 'checked' : '' }}
                                        {{ old('category.4') == 'Kitchen' ? 'checked' : '' }}>
                                        <label for="checkboxNine">Kitchen</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="category[]" id="checkboxTen" value="School Accessories"
                                        {{ old('category.0') == 'School Accessories' ? 'checked' : '' }}
                                        {{ old('category.1') == 'School Accessories' ? 'checked' : '' }}
                                        {{ old('category.2') == 'School Accessories' ? 'checked' : '' }}
                                        {{ old('category.3') == 'School Accessories' ? 'checked' : '' }}
                                        {{ old('category.4') == 'School Accessories' ? 'checked' : '' }}>
                                        <label for="checkboxTen">School Accessories</label>
                                    </li>
                                </ul>
                                @error('category')
                                    <p>{{$message}}</p>
                                @enderror
                            </div>        
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