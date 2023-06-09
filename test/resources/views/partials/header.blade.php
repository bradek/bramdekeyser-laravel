<!-- Hier onder staat de header.
De header bevat de navigatie van de website.
De stijl van de navigatie is overgenomen van codepen.io.
Deze stijl komt van: 'Navigation bar' door TM.
Deze navigatiebalk leek me simpel en netjes.
In de about.blade.php wordt hier ook naar verwezen.
Daar komen dus ook de complexe class-namen uit voort die ik zelf nooit verzonnen zou hebben.-->
<div class="main-header__brand">
      <img src="https://freesvg.org/img/barretr-Book.png" width="300" alt="logo">
    </div>
    <nav class="main-navigation">
      <ul class="main-navigation__items">
        <li class="main-navigation__item">
          <a href="/">Home</a>
        <li class="main-navigation__item">
          <a href="/about">About</a>
          <li class="main-navigation__item">
          <a href="{{ route('boeken.index') }}">Boeken</a>
          <!--Als de ingelogde gebruiker geen admin is, zal deze link niet worden weergegeve.
        Wanneer de ingelogde gegeven adminrechten heeft, zal de link naar de admin-pagina zichtbaar worden.-->
          @if (auth()->check() && auth()->user()->isAdmin())
                <li class="main-navigation__item">
          <a href="/admin">Admin</a>
          @endif
          <li class="main-navigation__item">
          <a href="{{ route('profielpagina') }}">Profielpagina</a>
          <li class="main-navigation__item">
          <a href="{{ route('contact') }}">Contact</a>
          <li class="main-navigation__item">
          <a href="{{ route('faq') }}">FAQ</a>
          <li class="main-navigation__item">
          <a href="{{ route('laatstenieuws') }}">Laatste Nieuws</a>
          <li class="main-navigation__item">
          <a href="{{ route('gastenboek.index') }}">Gastenboek</a>
          <li class="main-navigation__item">
          <a href="{{ route('showRegistratieFormulier') }}">Registreer</a>
              <li class="main-navigation__item">
          <a href="{{ route('login') }}">Login</a>
        </li>
      </ul>
    </nav>
</header>