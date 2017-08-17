<!-- User Account Menu -->
<li class="dropdown user user-menu">
    <!-- Menu Toggle Button -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <!-- The user image in the navbar-->
        <img src="{{ Gravatar::get(Auth::user()->getEmail())  }}" class="user-image" alt="User Image">
        <!-- hidden-xs hides the username on small devices so only the image appears. -->
        <span class="hidden-xs">{{ Auth::user()->getName() }}</span>
    </a>
    <ul class="dropdown-menu">
        <!-- The user image in the menu -->
        <li class="user-header">
            <img src="{{ Gravatar::get(Auth::user()->getEmail())  }}" class="img-circle" alt="User Image">

            <p>
                <span class="white-font-15"> <a href="/settings">{{ Auth::user()->getName() }}</a></span>

                <small><span class="white-font"><a href="/settings">{{ Auth::user()->getEmail() }}</a></span></small>

            </p>


        </li>


    </ul>
</li>
