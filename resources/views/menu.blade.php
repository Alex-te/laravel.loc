<li class="nav-item">
    <a class="nav-link {{request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home')  }}">Главная</a>
</li>
<li class="nav-item">
    <a class="nav-link {{request()->routeIs('news.categories') ? 'active' : '' }}" href="{{ route('news.categories')}}">Категории новостей</a>
</li>
<li class="nav-item">
    <a class="nav-link {{request()->routeIs('admin.index') ? 'active' : '' }}" href="{{ route('admin.index') }}">Админка</a>
</li>
<li class="nav-item">
    <a class="nav-link {{request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">Авторизация</a>
</li>

