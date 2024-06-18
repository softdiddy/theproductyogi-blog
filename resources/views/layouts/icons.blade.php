<div class="icons">
    <ul>
        <li><a href="/home" title="Home"><i class="bi bi-house-fill"></i></a></li>


        {{-- <li class="mt-5"><a href="#" title="Choose Language" data-toggle="modal" data-target="#exampleModalCenter">
                <i class="bi bi-building"></i></a></li> --}}
        {{-- <li><a href="/cpp" title="C++"> <i class="bi bi-building-add"></i></a></li>
        <li><a href="/java" title="Java"> <i class="bi bi-filetype-java"></i></a></li> --}}
        <li class="mt-5"><a href="/files" title="Manage Files"><i class="bi bi-pass-fill"></i></a></li>
        {{-- <a href="/test-yourself" title="Test yourself"> <i class="bi bi-book"></i></a></li> --}}
        <li><a href="/projects" title="Host Project"><i class="bi bi-puzzle"></i></a></li>

        <hr />

        <li><a href="/subscription" title="Subscriptions"><i class="bi bi-coin"></i></a></li>
        <li><a href="/settings"><i class="bi bi-gear"></i></a></li>
        <li class="mt-5">
            <a {{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
            </a>
        </li>
    </ul>
</div>
