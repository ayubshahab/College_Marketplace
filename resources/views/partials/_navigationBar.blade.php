{{-- source code using Coding Nepal --}}
{{-- link: https://www.codingnepalweb.com/responsive-dropdown-menu-bar-html-css/ --}}

 {{-- css for the navigation bar --}}
<link rel="stylesheet" types ="text/css" href="/css/navigation.css" />
{{-- navbar area --}}
<div class="wrapper">
    <nav>
        <input type="checkbox" id="show-search">
        <input type="checkbox" id="show-menu">
        <label for="show-menu" class="menu-icon"><i class="fas fa-bars"></i></label>
        <div class="content">

            {{-- logo for college marketplace --}}
            <div class="logo">
                <a href="/">College Marketplace</a>
            </div>
            <ul class="links">
                <li><a href="/">Home</a></li>
                <li><a href="#">About</a></li>

                {{-- button for buying --}}
                <li>
                    <a class="desktop-link">Buy</a>
                    <input type="checkbox" id="show-features">
                    <label for="show-features" style="position: relative;">Buy <span class="down-arrow"></span> </label>
                    <ul>
                    <li><a href="#">Free Listings</a></li>
                    <li><a href="">Rent Items</a></li>
                    <li>
                        <a class="desktop-link">By Category</a>
                        <input type="checkbox" id="show-items">

                        <label for="show-items" style="position:relative;">By Category<span class="down-arrow"></span></label>
                        <ul>
                        <li><a href="#">Furniture</a></li>
                        <li><a href="#">Kitchen</a></li>
                        <li><a href="#">Electronics</a></li>
                        <li><a href="#">Clothes</a></li>
                        <li><a href="#">School Accessories</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Listings < 1 mile</a></li>
                    <li><a href="#">Yard Sales</a></li>
                    <li><a href="#">Find Subleases</a></li>
                    <li><a href="#">All Listings</a></li>
                    </ul>
                </li>

                {{-- button to sell --}}
                <li>
                    <a class="desktop-link">Sell</a>
                    <input type="checkbox" id="show-services">

                    {{-- used in the collapsed menu --}}
                    <label for="show-services" style="position:relative;">Sell <span class="down-arrow"></span></label>
                    <ul>
                    <li><a href="/listings/create">Post Single Item</a></li>
                    {{-- <li><a href="/yardsales/create">Host a Yard Sale</a></li> --}}
                    <li><a href="#">Post Item for Rent</a></li>
                    <li><a href="#">Post a Sublease</a></li>
                    {{-- <li>
                        <a href="#" class="desktop-link">More Items</a>
                        <input type="checkbox" id="show-items">
                        <label for="show-items">More Items</label>
                        <ul>
                        <li><a href="#">Sub Menu 1</a></li>
                        <li><a href="#">Sub Menu 2</a></li>
                        <li><a href="#">Sub Menu 3</a></li>
                        </ul>
                    </li> --}}
                    </ul>
                </li>

                {{-- rent button --}}
                {{-- <li><a href="#">Rent</a></li> --}}
            
                {{-- login button --}}
                @auth
                    <li>
                        <a class="desktop-link">{{auth()->user()->first_name}}</a>
                        <input type="checkbox" id="show-user-links">
                        <label for="show-user-links">{{auth()->user()->first_name}}</label>
                        <ul>
                            <li><a href="/users/manage">Manage Listings</a></li>
                            <li>
                                <a id="logout-button" onclick="document.getElementById('logout-form').submit();">Logout</a>
                                <form method="POST" id="logout-form" action="/users/logout">
                                    @csrf
                                    {{-- <input type='submit' value="Logout"> --}}
                                </form>
                            </li>
                        </ul>
                        {{-- <a href="/listings/manage">{{auth()->user()->first_name}}</a> --}}
                    </li>
                @else   
                    <li><a href="/users/loginRegister">Login</a></li>
                @endauth
            </ul>
        </div>

        {{-- this is the search forum --}}
        <label for="show-search" class="search-icon"><i class="fas fa-search"></i></label>
        <form action="/shop/listings/" class="search-box">
            <input type="text" name = "search" placeholder="Type Something to Search..." required>
            <button type="submit" class="go-icon"><i class="fas fa-long-arrow-alt-right"></i></button>
        </form>
    </nav>
    <script>
        // var form = document.getElementById("logout-form");

        // document.getElementById("logout-button").addEventListener("click", function () {
        // form.submit();
        // });
    </script>
</div>