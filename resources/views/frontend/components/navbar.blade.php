<nav class="flex items-center bg-gradient-to-br from-pink-400 to-pink-500 p-3 flex-wrap">
   <a href="#" class="p-2 mr-4 inline-flex items-center">
      <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="fill-current text-white h-8 w-8 mr-2">
         <path d="M12.001 4.8c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624C13.666 10.618 15.027 12 18.001 12c3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C16.337 6.182 14.976 4.8 12.001 4.8zm-6 7.2c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624 1.177 1.194 2.538 2.576 5.512 2.576 3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C10.337 13.382 8.976 12 6.001 12z" />
      </svg>
      <span class="text-xl text-white font-bold uppercase tracking-wide">SIM PASAR</span>
   </a>
   <button class="text-white inline-flex p-3 hover:bg-white rounded lg:hidden ml-auto hover:text-pink-500 outline-none nav-toggler" data-target="#navigation">
      <i class="material-icons">menu</i>
   </button>
   <div class="hidden top-navbar w-full lg:inline-flex lg:flex-grow lg:w-auto border-b lg:border-b-0" id="navigation">
      <div class="lg:inline-flex lg:flex-row lg:ml-auto lg:w-auto w-full lg:items-center items-start flex flex-col lg:h-auto">
         <a href="#" class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-pink-200 hover:text-white items-center justify-center">
            <span>Home</span>
         </a>
         @guest
            @if(Route::has('login'))
               <a href="#" class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-pink-200 hover:text-white items-center justify-center">
                  <span>Login</span>
               </a>
               {{-- <a class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white inline-flex items-center float-right" href="{{ route('login') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        {{ __('Login') }}
               </a> --}}
            @endif
            @else
            <li class="nav-item dropdown">
               <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }}
               </a>

               <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                  </form>
               </div>
            </li>
         @endguest
      </div>
   </div>
</nav>
