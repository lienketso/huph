<div class="entry-post">
    @if(!empty($metaPost) && count($metaPost))
    <div class="meta-post-single">
        <div class="row">
            @foreach($metaPost as $d)
                @php
                    $val = json_decode($d->meta_value);
                @endphp
            <div class="col-lg-4">
                <div class="item-meta">
                    <p><strong>{{$val->title}}</strong> : {{$val->name}}</p>
                </div>
            </div>
            @endforeach
            @if($data->file_attach!='')
            <div class="col-lg-4">
                <div class="item-meta">
                    <p><strong>Download</strong> : <a href="{{upload_url($data->file_attach)}}" target="_blank">File toàn văn <i class="fa fa-file-pdf-o"></i></a></p>
                </div>
            </div>
            @endif

        </div>
    </div>
    @endif
    {!! $data->content !!}
</div>
