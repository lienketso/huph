{{--cơ sở dữ liệu bài thuốc--}}
<div class="form-group">
    <label>Tên bài thuốc</label>
    <div class="row">
        <div class="col-lg-4">
            <input class="form-control"
                   name="meta[meta_data_group_text][title]"
                   type="text"
                   value="{{($postModel->getPostMetaJson('meta_data_group_text','title',$data->id)=='null')) ? $setting->getSettingMeta('form_key_34_'.$lang) : $postModel->getPostMetaJson('meta_data_group_text','title',$data->id}}"
                   placeholder="Tiêu đề trường (hiển thị ở trường search)">
        </div>
        <div class="col-lg-8">
            <input class="form-control"
                   name="meta[meta_data_group_text][name]"
                   type="text"
                   value="{{old('meta_data_group_text',$postModel->getPostMetaJson('meta_data_group_text','name',$data->id))}}"
                   placeholder="Tên bài thuốc">
        </div>
    </div>

</div>
<div class="form-group">
    <label>Nhóm chủ trị</label>
    <div class="row">
        <div class="col-lg-4">
            <input class="form-control"
                   name="meta[meta_data_group][title]"
                   type="text"
                   value="{{($postModel->getPostMetaJson('meta_data_group','title',$data->id)=='null')) ? $setting->getSettingMeta('form_key_16_'.$lang) : $postModel->getPostMetaJson('meta_data_group','title',$data->id}}"
                   placeholder="Tiêu đề trường (hiển thị ở trường search)">
        </div>
        <div class="col-lg-8">
            <select id="" name="meta[meta_data_group][name]" class="form-control" style="width: 100%" >
                @if($factory)
                @foreach($factory as $f)
                <option value="{{$f->name}}"
                    {{ ($postModel->getPostMetaJson('meta_data_group','name',$data->id) == $f->name ) ? 'selected' : ''}}>{{$f->name}}</option>
                @endforeach
                @endif    

               
            </select>
        </div>
    </div>

</div>
