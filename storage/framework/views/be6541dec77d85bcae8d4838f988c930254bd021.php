<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.layout','data' => []] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <link rel="stylesheet" types = "text/css" href="/css/createListing.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="listings-parent-container" style="padding-bottom: 50px; padding-top: 50px;">
        <div class ="container">
           <div class="createListingSection">
                <div class="info">
                    
                </div>
                <div class = "listingFormContainer">

                    
                    
                    <div id="svg_wrap"></div>
                    <h1>Post A Lease!</h1>
                    <form class="listingForm" method = "POST" action="/rentables" id="listingForm"
                    enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        
                        <input type="hidden" name="user_id"  value="<?php echo e(old('iser_id', '3')); ?>"
                        >

                        
                        <section class = "listingCard">
                            <p class="create-listing-header">Rental Details</p>
                            <input type="text" name = "rental_title" placeholder="Rental Title"  value="<?php echo e(old('rental_title', null)); ?>" />
                            <?php $__errorArgs = ['rental_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            

                            <p class="create-listing-header">
                                Rental Duration
                            </p>
                            <div class="condition-box">
                                <select name="rental_duration" id="rentalDuration">
                                    <option value="Hourly" <?php echo e((old("rental_duration") == 'Hourly' ? "selected":"")); ?>>Hourly</option>
                                    
                                    <option value="Daily" <?php echo e((old("rental_duration") == 'Daily' ? "selected":"")); ?>>Daily</option>

                                    <option value="Weekly" <?php echo e((old("rental_duration") == 'Free' ? "selected":"")); ?>>Weekly</option>

                                    <option value="Monthly" <?php echo e((old("rental_duration") == 'Monthly' ? "selected":"")); ?>>Monthly</option>
                                </select>
                                <?php $__errorArgs = ['rental_duration'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                
                            </div>

                            <input id="rental_charging" type="number" min="0.00" name = "rental_charging" max="10000.00" step="0.01" placeholder="Rental price per "  value="<?php echo e(old('rental_charging', null)); ?>"/>
                            <?php $__errorArgs = ['rental_charging'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <p class="create-listing-header">Condition</p>
                            <div class ="conditionBox">
                                <select name="condition" id="">
                                    <option value="New" <?php echo e((old("condition") == 'New' ? "selected":"")); ?>>New</option>
                                    <option value="Good" <?php echo e((old("condition") == 'Good' ? "selected":"")); ?>>Good</option>
                                    <option value="Slightly Used" <?php echo e((old("condition") == 'Slightly Used' ? "selected":"")); ?>>Slightly Used </option>
                                    <option value="Used Normal Wear" <?php echo e((old("condition") == 'Used Normal Wear' ? "selected":"")); ?>>Used Normal Wear </option>
                                </select>
                                <?php $__errorArgs = ['condition'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <p class="create-listing-header">Categories</p>
                            <div class ="conditionBox">
                                <ul class="ks-cboxtags">
                                    <li>
                                        <input type="checkbox" name="category[]" id="checkboxSix" value="Furniture" 
                                        <?php echo e(old('category.0') == 'Furniture' ? 'checked' : ''); ?>

                                        <?php echo e(old('category.1') == 'Furniture' ? 'checked' : ''); ?>

                                        <?php echo e(old('category.2') == 'Furniture' ? 'checked' : ''); ?>

                                        <?php echo e(old('category.3') == 'Furniture' ? 'checked' : ''); ?>

                                        <?php echo e(old('category.4') == 'Furniture' ? 'checked' : ''); ?>>
                                        <label for="checkboxSix"
                                        >Furniture</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="category[]" id="checkboxSeven" value="Clothes"
                                        <?php echo e(old('category.0') == 'Clothes' ? 'checked' : ''); ?>

                                        <?php echo e(old('category.1') == 'Clothes' ? 'checked' : ''); ?>

                                        <?php echo e(old('category.2') == 'Clothes' ? 'checked' : ''); ?>

                                        <?php echo e(old('category.3') == 'Clothes' ? 'checked' : ''); ?>

                                        <?php echo e(old('category.4') == 'Clothes' ? 'checked' : ''); ?>>
                                        <label for="checkboxSeven">Clothes</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="category[]" id="checkboxEight" value="Electronics" 
                                        <?php echo e(old('category.0') == 'Electronics' ? 'checked' : ''); ?>

                                        <?php echo e(old('category.1') == 'Electronics' ? 'checked' : ''); ?>

                                        <?php echo e(old('category.2') == 'Electronics' ? 'checked' : ''); ?>

                                        <?php echo e(old('category.3') == 'Electronics' ? 'checked' : ''); ?>

                                        <?php echo e(old('category.4') == 'Electronics' ? 'checked' : ''); ?>>
                                        <label for="checkboxEight">Electronics</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="category[]" id="checkboxNine" value="Kitchen"
                                        <?php echo e(old('category.0') == 'Kitchen' ? 'checked' : ''); ?>

                                        <?php echo e(old('category.1') == 'Kitchen' ? 'checked' : ''); ?>

                                        <?php echo e(old('category.2') == 'Kitchen' ? 'checked' : ''); ?>

                                        <?php echo e(old('category.3') == 'Kitchen' ? 'checked' : ''); ?>

                                        <?php echo e(old('category.4') == 'Kitchen' ? 'checked' : ''); ?>>
                                        <label for="checkboxNine">Kitchen</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="category[]" id="checkboxTen" value="School Accessories"
                                        <?php echo e(old('category.0') == 'School Accessories' ? 'checked' : ''); ?>

                                        <?php echo e(old('category.1') == 'School Accessories' ? 'checked' : ''); ?>

                                        <?php echo e(old('category.2') == 'School Accessories' ? 'checked' : ''); ?>

                                        <?php echo e(old('category.3') == 'School Accessories' ? 'checked' : ''); ?>

                                        <?php echo e(old('category.4') == 'School Accessories' ? 'checked' : ''); ?>>
                                        <label for="checkboxTen">School Accessories</label>
                                    </li>
                                </ul>
                                <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>        
                        </section>

                        
                        <section class = "listingCard">
                            <p class="create-listing-header">Sub-Categories/ Tags (comma seperated)</p>
                            <input name = "tags" type="text" placeholder="Tags" value="<?php echo e(old('tags', null)); ?>"/>
                            <?php $__errorArgs = ['tags'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <textarea name="description" placeholder="Description" rows="3" style="resize: none;"><?php echo e(old('description', null)); ?></textarea>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="create-listing-header">Attach Images</p>
                            <input class="imgUpload" type="file" id="image_uploads" name="image_uploads[]" accept=".jpg, .jpeg, .png" multiple >
                            <div class="preview">
                                <h6>Please select up to 5</h6>
                            </div>
                            <?php $__errorArgs = ['image_uploads'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </section>

                        
                        <section class = "listingCard">
                        <p class="create-listing-header">Location</p>
                            <input type="text" id = "street" name="street" placeholder="Enter a Location*"  value="<?php echo e(old('street', null)); ?>"/>
                            <?php $__errorArgs = ['street'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <input type="text" id = "streetTwo" name="streetTwo" placeholder="Apartment, unit, suite, or floor #"  value="<?php echo e(old('street', null)); ?>"/>
                            <input type="text" id = "city" name = "city" placeholder="City*"  value="<?php echo e(old('city', null)); ?>"/>
                            <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <input type="text" id = "state" name = "state" placeholder="State*"  value="<?php echo e(old('state', null)); ?>"/>
                            <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <input type="text" id = "country" name = "country" placeholder="Country*"  value="<?php echo e(old('country', null)); ?>" />
                            <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <input type="text" id = "postcode" name = "postcode"placeholder="Postcode*"  value="<?php echo e(old('postcode', null)); ?>" />
                            <?php $__errorArgs = ['postcode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            
                        </section>


                        <div class = "listingButtonsContainer">
                            <div class="button" id="prev">&larr; Previous</div>
                            <div class="button" id="next">Next &rarr;</div>
                            <button class="submit-create-listing button" id="submit" type="submit">
                                Submit
                            </button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
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

            $("#rental_charging").attr("placeholder", "Rental Price per hour");
            $('#rentalDuration').change(function(){
                switch ($(this).val()){
                    case 'Hourly':
                        $("#rental_charging").attr("placeholder", "Rental Price per hour");
                        break;
                    case 'Daily':
                        $("#rental_charging").attr("placeholder", "Rental Price per day");
                        break;
                    case 'Weekly':
                        $("#rental_charging").attr("placeholder", "Rental Price per week");
                        break;
                    case 'Monthly':
                        $("#rental_charging").attr("placeholder", "Rental Price per month");
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
        <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHQxwBJAiHYROOX3zT6P7AwnBq1WGVmnM&callback=initAutocomplete&libraries=places&v=weekly"
      defer
    ></script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\COLLEGE_MARKETPLACE\resources\views/subleases/create.blade.php ENDPATH**/ ?>