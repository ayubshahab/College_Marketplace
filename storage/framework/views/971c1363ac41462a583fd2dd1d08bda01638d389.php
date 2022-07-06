



<link rel="stylesheet" type="text/css" href="/css/loginSignup.css">
<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.layout','data' => []] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <section>
        <div class="login-page">
            <div class="login-parent-container">
                <div class="login-inner-container">

                    <!-- with the login/signup text -->
                    
                    <div class="login-inner-left">
                        <div class="login-toggle-container">
                            <div class="login-div" id="login-div" onclick="showLoginPanel()">
                                Login
                            </div>
                            <div class="sign-up-div" id="sign-up-div" onclick="showSignUpPanel()">
                                Sign Up
                            </div>
                        </div>

                        <!-- style={toggleStatus[0]} -->
                        <div class="sign-in-and-up-toggle-container cont-1" id="sign-in-cont">
                            <!-- onSubmit={comparePasswords} -->
                            <?php
                                if (!empty($error_msg)) {
                                    echo "<div class='alert alert-danger'>$error_msg</div>";
                                }
                            ?>
                            <form class="login-form" action="/users/authenticate" method="POST">
                                <?php echo csrf_field(); ?>
                                <h1>Welcome Back!</h1>
                                <br />
                                <input type="text" class="email-text-input" placeholder="Email Address" name="email"
                                value = "<?php echo e(old('email', null)); ?>"/>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <input type="password" class="name-text-input" placeholder="Password" name="password"
                                value = "<?php echo e(value('password', null)); ?>" />
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <br />

                                <input type="submit" class="btn-hover color-3 shrink-on-hover" value="Login" />
                            </form>
                        </div>
                        <!-- style={toggleStatus[1]} -->
                        <div class="sign-in-and-up-toggle-container cont-2" id="sign-up-cont">
                            <form name="signupForm" class="sign-up-form"  action="/users" method="POST">
                                <?php echo csrf_field(); ?>
                                <h1>Sign Up</h1>
                                <br>
                                <input type="text" class="name-text-input" placeholder="First Name" name="first_name"
                                value="<?php echo e(old('first_name', null)); ?>"/>
                                <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <?php echo e($message); ?>

                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <input type="text" class="name-text-input" placeholder="Last Name" name="last_name"
                                value="<?php echo e(old('last_name', null)); ?>" />
                                <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p>
                                        <?php echo e($message); ?>

                                    </p>    
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <input type="text" class="email-text-input" placeholder="Email Address" name="email"
                                value="<?php echo e(old('email', null)); ?>" />
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p>
                                        <?php echo e($message); ?>

                                    </p> 
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <input id="pw" type="password" class="name-text-input" placeholder="Password"
                                    name="password" 
                                value="<?php echo e(old('password', null)); ?>" />
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p>
                                        <?php echo e($message); ?>

                                    </p> 
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <input id="password_confirmation" type="password" class="name-text-input" placeholder="Confirm Password"
                                    name="password_confirmation" 
                                value="<?php echo e(old('password_confirmation', null)); ?>" />
                                <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p>
                                        <?php echo e($message); ?>

                                    </p> 
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                
                                <input type="submit" class="btn-hover color-3 shrink-on-hover" 
                                value="Join">
                                
                            </form>
                        </div>
                    </div>

                    <!-- container for image on the right side -->
                    <div class="login-inner-right">
                        <!-- <img class="size-image"
                        src="https://lv7ms1pq6dm2sea8j1mrajzw-wpengine.netdna-ssl.com/wp-content/uploads/2020/09/shutterstock_634562399-1200x675.jpg"
                        alt="Shopping Cart">
                         -->
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="vertical-socials">
            <span><a href="https://discord.gg/BxXGmT72PT"><i class="fab fa-discord" /></a></span>
            <span><a href="https://www.instagram.com/outsmartodds/"><i class="fa fa-instagram" /></a></span>
            <span><a href="https://twitter.com/OutsmartOdds"><i class="fa fa-twitter" /></a></span>
        </div> -->
        <!-- </div> -->
    </section>
    <script>


        const selector = [
            { display: "flex" }, { display: "none" }, { givenColor: "rgba(176, 38, 255, 1)" }, { givenColor: "none" }
        ];

        function showLoginPanel() {
            document.getElementById('login-div').style.backgroundColor = 'transparent';
            document.getElementById('sign-up-div').style.backgroundColor = 'rgba(255, 255, 255, .25)';

            document.getElementById('sign-in-cont').style.display = "flex";
            document.getElementById('sign-up-cont').style.display = "none";
        }

        function showSignUpPanel() {
            document.getElementById('login-div').style.backgroundColor = 'rgba(255, 255, 255, .25)';
            document.getElementById('sign-up-div').style.backgroundColor = 'transparent';

            document.getElementById('sign-in-cont').style.display = "none";
            document.getElementById('sign-up-cont').style.display = "flex";
        }

        function CheckPassword(input, min, max) { 
            var passw=  /^[A-Za-z]\w{7,14}$/;
            if(input.value.length < min || input.value.length > max){
                console.log(input.value.length );

                console.log("Check if eror block exists: ",document.getElementById("ErrorBlock1"));
                if(document.getElementById("ErrorBlock1") == null){
                    // create new div for error and submit
                    var iDiv = document.createElement('div');
                    iDiv.id = 'ErrorBlock1';
                    iDiv.className = 'ErrorBlock';
                    iDiv.innerHTML = "Length of password should be between " + min + " and " + max +" characters";
                    document.getElementById('sign-up-cont').appendChild(iDiv);
                }
            }
        
        }

    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\College_Marketplace\resources\views/users/loginSignup.blade.php ENDPATH**/ ?>