@foreach($posts as $post)
<div class="col-md-12 grid-margin post-element pl-0 pr-0">
    <div class="card rounded">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img class="img-xs rounded-circle" src="{{ asset($post->user->image ?? 'https://via.placeholder.com/37x37') }}" alt="">
                    <div class="ml-2">
                        <p>{{ $post->user->name ?? '' }}</p>
                        <p class="tx-11 text-muted">{{ $post->created_at->format('d M, y') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <p class="mb-3 tx-14">{!! $post->post_content ?? '' !!}</p>
            @if($post->files != Null && count(explode(',',$post->files)))
                <table class="table">
                    <thead>
                        <tr>
                            <th class="w-80">Title</th>
                            <th class="w-20">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(explode(',',$post->files) as $file)
                            <tr>
                                <td>{{ str_replace('assets/files/','',$file) }}</td>
                                <td>
                                    <a target="_blank" href="{{ $file }}" class="badge badge-info"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="card-footer">
            <div class="comment-section">
                <div class="fb-comments w-100" data-id="{{ $post->id }}" data-href="http://engineers-asso.test/" data-width="100%" data-numposts="5"></div>
            </div>
        </div>
    </div>
</div>
@endforeach
