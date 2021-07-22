    @if (Auth::user()->is_beingFavorite($micropost->id))
        {{-- Unfavoriteボタンのフォーム --}}
        {!! Form::open(['route' => ['favorites.unfavorite', $micropost->id], 'method' => 'delete']) !!}
            {!! Form::submit('Unfavorite', ['class' => "btn btn-danger"]) !!}
        {!! Form::close() !!}
    @else
        {{-- Favoriteボタンのフォーム --}}
        {!! Form::open(['route' => ['favorites.favorite', $micropost->id]]) !!}
            {!! Form::submit('Favorite', ['class' => "btn btn-success"]) !!}
        {!! Form::close() !!}
    @endif
