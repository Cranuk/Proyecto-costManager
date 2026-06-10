<header class="header-page">
    <nav class="container-options">
        <ul class="menu-list">
            <li>
                <a href="{{ route('index') }}" title='Inicio'>
                    <span class="material-symbols-outlined icon-big hover:text-amber-600 duration-300">home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('category') }}" title="Categorias">
                    <span class="material-symbols-outlined icon-big hover:text-amber-600 duration-300">category</span>
                </a>
            </li>
            <li>
                <a href="{{ route('expense') }}" title='Gastos'>
                    <span class="material-symbols-outlined icon-big hover:text-amber-600 duration-300">shopping_cart</span>
                </a>
            </li>
            <li>
                <a href="{{ route('revenue') }}" title='Ingresos'>
                    <span class="material-symbols-outlined icon-big hover:text-amber-600 duration-300">account_balance</span>
                </a>
            </li>
            <li>
                <a href="{{ route('record') }}" title='Historial'>
                    <span class="material-symbols-outlined icon-big hover:text-amber-600 duration-300">calendar_today</span>
                </a>
            </li>
        </ul>
    </nav>
</header>
