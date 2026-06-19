<header class="header-page">
    <nav class="container-options">
        <ul class="menu-list">
            <li>
                <a href="{{ route('index') }}" title='Inicio'>
                    <span class="material-symbols-outlined icon-big hover:text-amber-600 duration-300 {{ request()->routeIs('index') ? 'underline underline-offset-4 decoration-4 cursor-not-allowed' : '' }}">home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('categories.index') }}" title="Categorias">
                    <span class="material-symbols-outlined icon-big hover:text-amber-600 duration-300 {{ request()->routeIs('categories.index', 'categories.*') ? 'underline underline-offset-4 decoration-4 cursor-not-allowed' : '' }}">category</span>
                </a>
            </li>
            <li>
                <a href="{{ route('expenses.index') }}" title='Gastos'>
                    <span class="material-symbols-outlined icon-big hover:text-amber-600 duration-300 {{ request()->routeIs('expenses.index', 'expenses.*') ? 'underline underline-offset-4 decoration-4 cursor-not-allowed' : '' }}">shopping_cart</span>
                </a>
            </li>
            <li>
                <a href="{{ route('revenues.index') }}" title='Ingresos'>
                    <span class="material-symbols-outlined icon-big hover:text-amber-600 duration-300 {{ request()->routeIs('revenues.index', 'revenues.*') ? 'underline underline-offset-4 decoration-4 cursor-not-allowed' : '' }}">account_balance</span>
                </a>
            </li>
            <li>
                <a href="{{ route('records') }}" title='Historial'>
                    <span class="material-symbols-outlined icon-big hover:text-amber-600 duration-300 {{ request()->routeIs('records') ? 'underline underline-offset-4 decoration-4 cursor-not-allowed' : '' }}">calendar_today</span>
                </a>
            </li>
        </ul>
    </nav>
</header>
