<li class="notifications dropdown">
    <a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">
        <i class="icon-mail"></i>
        <span class="badge badge-secondary">{{$threads->count()}}</span>
    </a>
    <ul class="dropdown-menu pull-right">
        <li class="first">
            <div class="dropdown-content-header"><i class="fa fa-pencil-square-o pull-right"></i> Mensajes</div>
        </li>
        @if($threads->count()>0)
            @foreach($threads as $thread)
                <li>
                    <ul class="media-list">
                        <li class="media">

                            <div class="media-body">
                                <a class="media-heading" href="{{ route('messages.show', $thread->id) }}">
                                    <span class="text-semibold"> {{ $thread->creator()->name }}</span>
                                    <span class="media-annotation pull-right">{{ $thread->created_at->diffForHumans() }}</span>
                                </a>
                                <span class="text-muted">{{ $thread->subject }}</span>
                            </div>
                        </li>
                    </ul>
                </li>
            @endforeach
        @else
            <li><ul class="media-list">
                    <li class="media">

                        <div class="media-body">No tiene mensajes</div></li>
                </ul>
            </li>
        @endif
        <li class="external-last"> <a class="danger" href="{{ route('messages.index') }}">Todos los mensajes</a> </li>
    </ul>
</li>