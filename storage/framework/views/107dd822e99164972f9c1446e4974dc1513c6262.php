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

                    
                    
                    <div id="svg_wrap"></div>
                    <h1>Update My Rental</h1>
                    <form class="listingForm" method = "POST" action="/rentables/<?php echo e($rentable->id); ?>" id="listingForm"
                    enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <input type="hidden" name="user_id"  value="<?php echo e(old('user_id', '3')); ?>"
                        >

                        
                        <section class = "listingCard default-card">
                            <p class="create-listing-header">Rental Details</p>
                            <input type="text" name = "rental_title" placeholder="Rental Title"  value="<?php echo e($rentable->rental_title); ?>" />
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
                                    <option value="Hourly" <?php echo e($rentable->rental_duration == 'Hourly' ? "selected":""); ?>>Hourly</option>
                                    
                                    <option value="Daily" <?php echo e($rentable->rental_duration == 'Daily' ? "selected":""); ?>>Daily</option>

                                    <option value="Weekly" <?php echo e($rentable->rental_duration == 'Weekly' ? "selected":""); ?>>Weekly</option>

                                    <option value="Monthly" <?php echo e($rentable->rental_duration == 'Monthly' ? "selected":""); ?>>Monthly</option>
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

                            <input id="rental_charging" type="number" min="0.00" name = "rental_charging" max="10000.00" step="0.01" placeholder="Rental Price per Hour "  value="<?php echo e($rentable->rental_charging); ?>"/>
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

                            <p class="create-listing-header">
                                Price Negotiable or Fixed
                            </p>
                            <div class="condition-box">
                                <select name="negotiable" id="">
                                     <option value="Fixed"<?php echo e($rentable->negotiable == 'Fixed' ? "selected":""); ?>>Fixed</option>
                                    
                                    <option value="Negotiable" <?php echo e($rentable->negotiable == 'Negotiable' ? "selected":""); ?>

                                        >Negotiable/ OBO (best offer)</option>
                                </select>
                                <?php $__errorArgs = ['negotiable'];
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

                            <p class="create-listing-header">Condition</p>
                            <div class ="conditionBox">
                                <select name="condition" id="">
                                    <option value="New" <?php echo e($rentable->condition == 'New' ? "selected":""); ?>>New</option>

                                    <option value="Good" 
                                    <?php echo e($rentable->condition == 'Good' ? "selected":""); ?>

                                    >Good</option>
                                    <option value="Slightly Used" <?php echo e($rentable->condition == 'Slightly Used' ? "selected":""); ?>>Slightly Used </option>
                                    <option value="Used Normal Wear" <?php echo e($rentable->condition == 'Used Normal Wear' ? "selected":""); ?>>Used Normal Wear </option>
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
                                 <?php
                                    $categories = explode(", ", $rentable->category);
                                    while(count($categories)<6)
                                        array_push($categories, '')
                                    
                                ?>
                                <ul class="ks-cboxtags">
                                    <li>
                                        <input type="checkbox" name="category[]" id="checkboxSix" value="Furniture" 
                                        <?php echo e($categories[0] == 'Furniture' ? 'checked' : ''); ?>

                                        <?php echo e($categories[1] == 'Furniture' ? 'checked' : ''); ?>

                                        <?php echo e($categories[2] == 'Furniture' ? 'checked' : ''); ?>

                                        <?php echo e($categories[3] == 'Furniture' ? 'checked' : ''); ?>

                                        <?php echo e($categories[4] == 'Furniture' ? 'checked' : ''); ?>

                                        <?php echo e($categories[5] == 'Furniture' ? 'checked' : ''); ?>

                                        >
                                        <label for="checkboxSix"
                                        >Furniture</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="category[]" id="checkboxSeven" value="Clothes"
                                        <?php echo e($categories[0]  == 'Clothes' ? 'checked' : ''); ?>

                                        <?php echo e($categories[1]  == 'Clothes' ? 'checked' : ''); ?>

                                        <?php echo e($categories[2]  == 'Clothes' ? 'checked' : ''); ?>

                                        <?php echo e($categories[3]  == 'Clothes' ? 'checked' : ''); ?>

                                        <?php echo e($categories[4]  == 'Clothes' ? 'checked' : ''); ?>

                                        <?php echo e($categories[5]  == 'Clothes' ? 'checked' : ''); ?>

                                        >
                                        <label for="checkboxSeven">Clothes</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="category[]" id="checkboxEight" value="Electronics" 
                                        <?php echo e($categories[0]  == 'Electronics' ? 'checked' : ''); ?>

                                        <?php echo e($categories[1] == 'Electronics' ? 'checked' : ''); ?>

                                        <?php echo e($categories[2]  == 'Electronics' ? 'checked' : ''); ?>

                                        <?php echo e($categories[3]  == 'Electronics' ? 'checked' : ''); ?>

                                        <?php echo e($categories[4] == 'Electronics' ? 'checked' : ''); ?>

                                        <?php echo e($categories[5] == 'Electronics' ? 'checked' : ''); ?>

                                        >
                                        <label for="checkboxEight">Electronics</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="category[]" id="checkboxNine" value="Kitchen"
                                        <?php echo e($categories[0]  == 'Kitchen' ? 'checked' : ''); ?>

                                        <?php echo e($categories[1]  == 'Kitchen' ? 'checked' : ''); ?>

                                        <?php echo e($categories[2]  == 'Kitchen' ? 'checked' : ''); ?>

                                        <?php echo e($categories[3]  == 'Kitchen' ? 'checked' : ''); ?>

                                        <?php echo e($categories[4]  == 'Kitchen' ? 'checked' : ''); ?>

                                        <?php echo e($categories[5]  == 'Kitchen' ? 'checked' : ''); ?>

                                        >
                                        <label for="checkboxNine">Kitchen</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="category[]" id="checkboxTen" value="School Accessories"
                                        <?php echo e($categories[0]  == 'School Accessories' ? 'checked' : ''); ?>

                                        <?php echo e($categories[1]  == 'School Accessories' ? 'checked' : ''); ?>

                                        <?php echo e($categories[2]  == 'School Accessories' ? 'checked' : ''); ?>

                                        <?php echo e($categories[3]  == 'School Accessories' ? 'checked' : ''); ?>

                                        <?php echo e($categories[4] == 'School Accessories' ? 'checked' : ''); ?>

                                        <?php echo e($categories[5] == 'School Accessories' ? 'checked' : ''); ?>

                                        >
                                        <label for="checkboxTen">School Accessories</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="category[]" id="checkboxEleven" value="Books"
                                        <?php echo e($categories[0]  == 'Books' ? 'checked' : ''); ?>

                                        <?php echo e($categories[1]  == 'Books' ? 'checked' : ''); ?>

                                        <?php echo e($categories[2]  == 'Books' ? 'checked' : ''); ?>

                                        <?php echo e($categories[3]  == 'Books' ? 'checked' : ''); ?>

                                        <?php echo e($categories[4] == 'Books' ? 'checked' : ''); ?>

                                        <?php echo e($categories[5] == 'Books' ? 'checked' : ''); ?>

                                        >
                                        <label for="checkboxEleven">Books</label>
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
                            <input name = "tags" type="text" placeholder="Tags" value="<?php echo e($rentable->tags); ?>"/>
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
                            <textarea name="description" placeholder="Description" rows="3" style="resize: none;"><?php echo e($rentable->description); ?></textarea>
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
                                
                                <ul class = "user-img-list">
                                    <?php if(is_array(json_decode($rentable->image_uploads))): ?>
                                        <?php $__currentLoopData = json_decode($rentable->image_uploads); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                 <img src=<?php echo e($rentable->image_uploads ? Storage::disk('s3')->url($link): asset('/images/rotunda.jpg')); ?> alt = "User Uploads">
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <h6>No files uploaded</h6>
                                    <?php endif; ?>
                                </ul>
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
                            <p class="create-listing-header">Address:</p>
                            <input type="text" name="street" placeholder="Street, nbr"  value="<?php echo e($rentable->street); ?>"/>
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
                            <input type="text" name = "city" placeholder="City"  value="<?php echo e($rentable->city); ?>"/>
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
                            <input type="text" name = "state" placeholder="State"  value="<?php echo e($rentable->state); ?>"/>
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
                            <input type="text" name = "country" placeholder="Country"  value="<?php echo e($rentable->country); ?>" />
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
                            <input type="text" name = "postcode" placeholder="Postcode"  value="<?php echo e($rentable->postcode); ?>" />
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\College_Marketplace\resources\views/rentables/edit.blade.php ENDPATH**/ ?>