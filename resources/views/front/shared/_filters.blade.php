<form class="product_sidebar">
    <div class="product_block">
        <div class="sidebar_heading">
            <h3>Búsqueda</h3>
            <img src="{{ asset('front_template/images/footer_underline.png') }}" alt="image">
        </div>
        <button type="submit">Filtrar</button>
        <div class="sidebar_search">
            <input type="text" name="search" placeholder="¡Busca algún producto!" value="{{ old('search', request('search')) }}">
            <a><i class="fa fa-search" aria-hidden="true"></i></a>
        </div>
    </div>

    <div class="product_block">
        <div class="sidebar_heading">
            <h3>Categorías</h3>
            <img src="{{ asset('front_template/images/footer_underline.png') }}" alt="image">
        </div>
        <div class="product_category">
            <ul>
                <li>
                    <input type="checkbox" id="all" @if(empty(request('categories'))) checked @endif>
                    <label for="all">Todos</label>
                </li>
                @foreach($categorias as $categoria)
                    <li>
                        <input type="checkbox" id="{{ $categoria->id }}" name="categories[]" value="{{ $categoria->id }}" @if(is_array(request('categories')) && in_array($categoria->id, request('categories'))) checked @endif>
                        <label for="{{ $categoria->id  }}">{{ $categoria->name }}</span></label>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</form>
