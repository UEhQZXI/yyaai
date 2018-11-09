@extends('admin.public.public')
@section('css')
<link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="/admin/css/style.css"/>
<link href="/admin/assets/css/codemirror.css" rel="stylesheet">
<link rel="stylesheet" href="/admin/assets/css/ace.min.css" />
<link rel="stylesheet" href="/admin/Widget/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">
<link rel="stylesheet" href="/admin/assets/css/font-awesome.min.css" />
<!--[if IE 7]>
<link rel="stylesheet" href="/admin/assets/css/font-awesome-ie7.min.css" />
<![endif]-->
<link href="/admin/Widget/icheck/icheck.css" rel="stylesheet" type="text/css" />
<link href="/admin/Widget/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
<link href="/admin/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="/css/font-fileuploader.css" rel="stylesheet">
<link href="/css/jquery.fileuploader.min.css" rel="stylesheet">
<link href="/css/jquery.fileuploader-theme-thumbnails.css" rel="stylesheet">
<style>
    .select2-search__field{
        margin-left: 0 !important;
    }
    .select2-search:after{
        content: '';
    }
    .c-red{
        color:red;
    }

</style>
@endsection
@section('script')
    <script src="/admin/assets/layer/layer.js" type="text/javascript" ></script>
    <script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>
    <script type="text/javascript" src="/admin/Widget/My97DatePicker/WdatePicker.js"></script>
    <script type="text/javascript" src="/admin/Widget/icheck/jquery.icheck.min.js"></script>
    <script type="text/javascript" src="/admin/Widget/zTree/js/jquery.ztree.all-3.5.min.js"></script>
    <script type="text/javascript" src="/admin/Widget/Validform/5.3.2/Validform.min.js"></script>
    <script type="text/javascript" src="/admin/Widget/webuploader/0.1.5/webuploader.min.js"></script>
    <script type="text/javascript" src="/admin/Widget/ueditor/1.4.3/ueditor.config.js"></script>
    <script type="text/javascript" src="/admin/Widget/ueditor/1.4.3/ueditor.all.min.js"> </script>
    <script type="text/javascript" src="/admin/Widget/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
    <script src="/admin/js/lrtk.js" type="text/javascript" ></script>
    <script type="text/javascript" src="/admin/js/H-ui.js"></script>
    <script type="text/javascript" src="/admin/js/H-ui.admin.js"></script>
    <script type="text/javascript" src="/admin/js/select2.full.min.js"></script>
    <script src="/js/upload.js"></script>
    <script>
        function selectCate(that, cid) {
            $('#category-name').val(that.getElementsByClassName('cate-name')[0].innerHTML);
            $('#category-id').val(cid);
            var span = document.getElementsByClassName('cate-name');
            for (var i = 0; i < span.length; i++) {
                span[i].style.backgroundColor = '';
                span[i].style.color = '#333';
            }
            that.getElementsByClassName('cate-name')[0].style.backgroundColor = 'cornflowerblue';
            that.getElementsByClassName('cate-name')[0].style.color = '#fff';
        }

        function product_save_submit() {
            var data = $('#form-article-add').serialize();
            $.ajax({
                type: "PATCH",
                url: "/api/store/products/{{$product->id}}",
                data: data,
                success: function(data){
                    if (data.status_code == 200) {
                        layer.msg('商品编辑成功', function () {
                            // window.location.href = '/admin/products/list';
                        });
                    }
                },
                complete: function(data){
                    console.log(data);
                }
            });
        }

        function product_close() {
            layer.confirm('确认要取消吗？',function(index){
                window.location.href = '/admin/products/list';
            });
        }
    </script>
    <script>
        $(function() {
            var windowInner = window.innerHeight;

            $('#add_picture').height(windowInner - ($('#navbar').height() + $('#breadcrumbs').height()) - 10);
            $('#nav_list').height(windowInner - ($('#navbar').height() + $('#breadcrumbs').height()) - 20);
            $("#add_picture").fix({
                float : 'left',
                skin : 'green',
                durationTime :false,
                stylewidth:'220',
                spacingw:0,
                spacingh:260,
            });
        });

        $(function() {
            // enable fileuploader plugin
            $(document).ready(function() {
                // enable fileuploader plugin
                $('input[name="file"]').fileuploader({
                    extensions: null,
                    changeInput: ' ',
                    theme: 'thumbnails',
                    enableApi: true,
                    addMore: true,
                    limit:5,
                    listInput: true,
                    files: [
                        @if($product->image1)
                            {
                                name :'{{$product->image1}}',
                                file:'{{$product->image1}}',
                                data: {
                                    thumbnail: '{{$product->image1}}',
                                }
                            },
                        @endif
                        @if($product->image2)
                            {
                                name :'{{$product->image2}}',
                                file:'{{$product->image2}}',
                                data: {
                                    thumbnail: '{{$product->image2}}',
                                }
                            },
                        @endif
                        @if($product->image3)
                            {
                                name :'{{$product->image3}}',
                                file:'{{$product->image3}}',
                                data: {
                                    thumbnail: '{{$product->image3}}',
                                }
                            },
                        @endif
                        @if($product->image4)
                            {
                                name :'{{$product->image4}}',
                                file:'{{$product->image4}}',
                                data: {
                                    thumbnail: '{{$product->image4}}',
                                }
                            },
                        @endif
                        @if($product->image5)
                            {
                                name :'{{$product->image5}}',
                                file:'{{$product->image5}}',
                                data: {
                                    thumbnail: '{{$product->image5}}',
                                }
                            }
                        @endif
                    ],
                    captions: {
                        button: function(options) { return '选择 ' + (options.limit == 1 ? '图片' : '图片'); },
                        feedback: function(options) { return '选择 ' + (options.limit == 1 ? '图片' : '图片') + '上传'; },
                        feedback2: function(options) { return options.length + ' ' + (options.length > 1 ? ' files were' : ' file was') + ' chosen'; },
                        confirm: '确认',
                        cancel: '取消',
                        name: '名称',
                        type: '类型',
                        size: '大小',
                        dimensions: '尺寸',
                        duration: 'Duration',
                        crop: '裁剪',
                        rotate: '旋转',
                        sort: '排序',
                        download: '下载',
                        remove: '删除',
                        drop: '将图片拖动到此处上传',
                        paste: '<div class="fileuploader-pending-loader"></div> 粘贴图片，单击此处取消。',
                        removeConfirmation: '您确定要删除此图片吗？',
                        errors: {
                            filesLimit: '只允许上传 ${limit} 张图片',
                            filesType: '图片类型只能是 ${extensions} ',
                            fileSize: '${name} 太大，只允许上传 ${fileMaxSize}MB 之内的图片',
                            filesSizeAll: 'Files that you chose are too large! Please upload files up to ${maxSize} MB.',
                            fileName: '${name} 已存在',
                            folderUpload: '不能上传文件夹'
                        }
                    },
                    thumbnails: {
                        box: '<div class="fileuploader-items">' +
                            '<ul class="fileuploader-items-list">' +
                            '<li class="fileuploader-thumbnails-input"><div class="fileuploader-thumbnails-input-inner"><i>+</i></div></li>' +
                            '</ul>' +
                            '</div>',
                        item: '<li class="fileuploader-item file-has-popup">' +
                            '<div class="fileuploader-item-inner">' +
                            '<div class="type-holder">${extension}</div>' +
                            '<div class="actions-holder">' +
                            '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i></i></a>' +
                            '</div>' +
                            '<div class="thumbnail-holder">' +
                            '${image}' +
                            '<span class="fileuploader-action-popup"></span>' +
                            '</div>' +
                            '<div class="content-holder"><h5>${name}</h5><span>${size2}</span></div>' +
                            '<div class="progress-holder">${progressBar}</div>' +
                            '</div>' +
                            '</li>',
                        item2: '<li class="fileuploader-item file-has-popup">' +
                            '<div class="fileuploader-item-inner">' +
                            '<div class="type-holder">${extension}</div>' +
                            '<div class="actions-holder">' +
                            '<a href="${file}" class="fileuploader-action fileuploader-action-download" title="${captions.download}" download><i></i></a>' +
                            '<a class="fileuploader-action fileuploader-action-sort" title="${captions.sort}"><i></i></a>' +
                            '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i></i></a>' +
                            '</div>' +
                            '<div class="thumbnail-holder">' +
                            '${image}' +
                            '<span class="fileuploader-action-popup"></span>' +
                            '</div>' +
                            '<div class="content-holder"><h5>${name}</h5><span>${size2}</span></div>' +
                            '<div class="progress-holder">${progressBar}</div>' +
                            '</div>' +
                            '</li>',
                        startImageRenderer: false,
                        canvasImage: false,
                        _selectors: {
                            list: '.fileuploader-items-list',
                            item: '.fileuploader-item',
                            start: '.fileuploader-action-start',
                            retry: '.fileuploader-action-retry',
                            remove: '.fileuploader-action-remove'
                        },
                        onItemShow: function(item, listEl, parentEl, newInputEl, inputEl) {
                            var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                                api = $.fileuploader.getInstance(inputEl.get(0));

                            plusInput.insertAfter(item.html)[api.getOptions().limit && api.getChoosedFiles().length >= api.getOptions().limit ? 'hide' : 'show']();

                            if(item.format == 'image') {
                                item.html.find('.fileuploader-item-icon').hide();
                            }
                        }
                    },
                    dragDrop: {
                        container: '.fileuploader-thumbnails-input'
                    },
                    afterRender: function(listEl, parentEl, newInputEl, inputEl) {
                        var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                            api = $.fileuploader.getInstance(inputEl.get(0));

                        plusInput.on('click', function() {
                            api.open();
                        });
                    },
                    upload: {
                        url: '/api/upload',
                        data: null,
                        type: 'POST',
                        enctype: 'multipart/form-data',
                        start: true,
                        synchron: true,
                        beforeSend: null,
                        onSuccess: function(data, item) {
                            item.html.find('.fileuploader-action-remove').addClass('fileuploader-action-success');

                            setTimeout(function() {
                                item.html.find('.progress-holder').hide();
                                item.renderThumbnail();

                                item.html.find('.fileuploader-action-popup, .fileuploader-item-image').show();
                                item.html.find('.fileuploader-action-remove').before('<a class="fileuploader-action fileuploader-action-sort" title="Sort"><i></i></a>');
                            }, 400);
                            console.log('----=-=-=');
                            console.log(item);
                            item.name = data.data['path'];
                        },
                        onError: function(item) {
                            item.html.find('.progress-holder, .fileuploader-action-popup, .fileuploader-item-image').hide();
                        },
                        onProgress: function(data, item) {
                            var progressBar = item.html.find('.progress-holder');

                            if(progressBar.length > 0) {
                                progressBar.show();
                                progressBar.find('.fileuploader-progressbar .bar').width(data.percentage + "%");
                            }

                            item.html.find('.fileuploader-action-popup, .fileuploader-item-image').hide();
                        }
                    },
                    sorter: {
                        selectorExclude: null,
                        placeholder: null,
                        scrollContainer: window,
                        onSort: function(list, listEl, parentEl, newInputEl, inputEl) {
                            var api = $.fileuploader.getInstance(inputEl.get(0)),
                                fileList = api.getFileList(),
                                _list = [];

                            $.each(fileList, function(i, item) {
                                _list.push({
                                    name: item.name,
                                    index: item.index
                                });
                            });

                            console.log(_list);
                            if (_list.length < 5) {
                                $('.fileuploader-thumbnails-input').show();
                            }
                            $('#images1').val(_list[0] ? _list[0].name : '');
                            $('#images2').val(_list[1] ? _list[1].name : '');
                            $('#images3').val(_list[2] ? _list[2].name : '');
                            $('#images4').val(_list[3] ? _list[3].name : '');
                            $('#images5').val(_list[4] ? _list[4].name : '');
                            // $.post('php/ajax_sort_files.php', {
                            //     _list: JSON.stringify(_list)
                            // });
                        }
                    },
                    onRemove: function(item) {
                        // $.post('php/ajax_remove_file.php', {
                        //     file: item.name
                        // });
                    }
                });

            });
        });

        // $(function(){
        //     var ue = UE.getEditor('editor');
        // });
        /******树状图********/

        var code;

        function showCode(str) {
            if (!code) code = $("#code");
            code.empty();
            code.append("<li>"+str+"</li>");
        }
        $(document).ready(function(){
            $.ajax({
                type: "GET",
                url: "/api/store/categorie?type=admin",
                success: function(data){
                    if (data.status_code == 200) {
                        var data = data.data;
                        var ctn = $('#ctn').val();
                        console.log(data);
                        var ul1 = '';
                        for (var i = 0; i < data.length; i++) {
                            ul1 += '<ul class="level0 "style="display:block">';
                            ul1 += '<li class="level1"><span id="treeDemo_8_switch" class="button level1 switch noline_open"></span><a class="level1"><span class="button ico_open"></span><span>'+data[i].name+'</span></a>';
                            if (data[i].son.length) {
                                ul1 += '<ul class="level1 ">';
                                for (var j = 0; j < data[i].son.length; j++) {
                                    if (ctn == data[i].son[j].id ) {
                                        ul1 += '<li class="level2" onclick="selectCate(this,'+data[i].son[j].id+')"><span class="button level2 switch noline_docu"></span><a class="level2"><span class="button ico_docu"></span><span class="cate-name" style="color: rgb(255, 255, 255); background-color: cornflowerblue;">'+data[i].son[j].name+'</span></a></li>';
                                    } else {
                                        ul1 += '<li class="level2" onclick="selectCate(this,'+data[i].son[j].id+')"><span class="button level2 switch noline_docu"></span><a class="level2"><span class="button ico_docu"></span><span class="cate-name">'+data[i].son[j].name+'</span></a></li>';
                                    }
                                }
                                ul1 += '</ul>';
                            }
                            ul1 += '</li></ul>';
                        }
                        $('#treeDemo_1').append(ul1);
                    }
                }
            });

            $.ajax({
                type: "GET",
                url: "/api/store/products?total=all",
                success: function(data){
                    if (data.status_code == 200) {
                        var data = data.data;
                        var options = '<option>无</option>';
                        var gnp = $('#gnp').val();
                        var pid = $('#pid').val();
                        for (var i = 0; i < data.length; i++) {
                            if (gnp == data[i].group_number && pid !=data[i].id ) {
                                options += '<option selected value="'+data[i].group_number+'">'+data[i].title+'</option>';
                            } else {
                                if (pid == data[i].id) {
                                    continue;
                                } else {
                                    options += '<option value="'+data[i].group_number+'">'+data[i].title+'</option>';
                                }
                            }
                        }
                        $('#group-number').append(options);
                    }
                    $('#group-number').select2({
                        width:300
                    });
                }
            });
        });
    </script>
    <script type="text/javascript">
        window.onresize = function () {
            var windowInner = window.innerHeight;

            $('#add_picture').height(windowInner - ($('#navbar').height() + $('#breadcrumbs').height()) - 10);
            $('#nav_list').height(windowInner - ($('#navbar').height() + $('#breadcrumbs').height()) - 20);
        };
    </script>
@endsection
@section('content')
    <div class="clearfix" id="add_picture">
        <div id="scrollsidebar" class="left_Treeview" style="height: 100%">
            <div class="show_btn" id="rightArrow">
            <span>
            </span>
            </div>
            <div class="widget-box side_content">
                <div class="side_title">
                    <a title="隐藏" class="close_btn">
                    <span>
                    </span>
                    </a>
                </div>
                <div class="side_list">
                    <div class="widget-header header-color-green2">
                        <h4 class="lighter smaller">
                            选择商品分类
                        </h4>
                    </div>
                    <div class="widget-body">
                        <div class="widget-main padding-8">
                            <div id="treeDemo" class="ztree">
                                <li id="treeDemo_1" class="level0" tabindex="0" hidefocus="true" treenode="">
                                    <span id="treeDemo_1_switch" class="button level0 switch noline_open" treenode_switch=""></span>
                                    <a id="treeDemo_1_a" class="level0" treenode_a="" onclick="" target="_blank" title="商城分类列表">
                                        <span id="treeDemo_1_ico" treenode_ico="" class="button ico_open"></span>
                                        <span id="treeDemo_1_span">
                                            商城分类列表
                                        </span>
                                    </a>
                                </li>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page_right_style">
            <div class="type_title">
                编辑 {{$product->title}}
            </div>
            <form action="" class="form form-horizontal" id="form-article-add">
                <div class="clearfix cl">
                    <label class="form-label col-2">
                        <span class="c-red">*</span>
                        商品标题：
                    </label>
                    <div class="formControls col-10">
                        <input type="text" class="input-text" value="{{$product->title}}" placeholder=""  name="title">
                    </div>
                </div>
                <div class="clearfix cl">
                    <label class="form-label col-2">
                        商品描述：
                    </label>
                    <div class="formControls col-10">
                        <input type="text" class="input-text" value="{{$product->description}}" placeholder=""  name="description">
                    </div>
                </div>
                <div class=" clearfix cl">
                    <div class="Add_p_s">
                        <label class="form-label col-2">
                            商品编号：
                        </label>
                        <div class="formControls col-2">
                            <input type="text" class="input-text" value="{{$product->numbering}}" placeholder=""  name="numbering">
                        </div>
                    </div>
                    <div class="Add_p_s">
                        <label class="form-label col-2">
                            <span class="c-red">*</span>
                            颜色/规格：
                        </label>
                        <div class="formControls col-2">
                            <input type="text" class="input-text" value="{{$product->model}}" placeholder=""  name="model">
                        </div>
                    </div>

                    {{--<div class="Add_p_s">--}}
                        {{--<label class="form-label col-2">--}}
                            {{--产&nbsp;&nbsp;&nbsp;&nbsp;地：--}}
                        {{--</label>--}}
                        {{--<div class="formControls col-2">--}}
                            {{--<input type="text" class="input-text" value="" placeholder=""  name="">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="Add_p_s">--}}
                        {{--<label class="form-label col-2">--}}
                            {{--材&nbsp;&nbsp;&nbsp;&nbsp;质：--}}
                        {{--</label>--}}
                        {{--<div class="formControls col-2">--}}
                            {{--<input type="text" class="input-text" value="" placeholder=""  name="">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="Add_p_s">--}}
                        {{--<label class="form-label col-2">--}}
                            {{--品&nbsp;&nbsp;&nbsp;&nbsp;牌：--}}
                        {{--</label>--}}
                        {{--<div class="formControls col-2">--}}
                            {{--<input type="text" class="input-text" value="" placeholder=""  name="">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="Add_p_s">--}}
                        {{--<label class="form-label col-2">--}}
                            {{--产品重量：--}}
                        {{--</label>--}}
                        {{--<div class="formControls col-2">--}}
                            {{--<input type="text" class="input-text" value="" placeholder=""  name="">--}}
                            {{--kg--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="Add_p_s">
                        <label class="form-label col-2">
                            <span class="c-red">*</span>
                            原价：
                        </label>
                        <div class="formControls col-2">
                            <input type="text" class="input-text" value="{{$product->original_price}}" placeholder=""  name="original_price">元
                        </div>
                    </div>
                    <div class="Add_p_s">
                        <label class="form-label col-2">
                            <span class="c-red">*</span>
                            现价：
                        </label>
                        <div class="formControls col-2">
                            <input type="text" class="input-text" value="{{$product->current_price}}" placeholder=""  name="current_price">元
                        </div>
                    </div>
                    <div class="Add_p_s">
                        <label class="form-label col-2">
                            <span class="c-red">*</span>
                            库存：
                        </label>
                        <div class="formControls col-2">
                            <input type="text" class="input-text" value="{{$product->inventory}}" placeholder=""  name="inventory">件
                        </div>
                    </div>
                    <div class="Add_p_s">
                        <label class="form-label col-2">
                            <span class="c-red">*</span>
                            所属分类：
                        </label>
                        <div class="formControls col-2">
                            <input type="text" class="input-text" id="category-name" value="{{$product->category->name}}" placeholder="" disabled="disabled">
                            <input type="hidden" id="category-id" class="input-text" value="{{$product->category->id}}" placeholder=""  name="category_id">
                        </div>
                    </div>
                    <div class="Add_p_s">
                        <label class="form-label col-2">状态：
                        </label>
                        <div class="formControls col-2">
                        <span class="select-box">
                            <select class="select" name="status">
                                <option {{$product->status ? 'selected' : ''}} value="1">
                                    上架
                                </option>
                                <option {{!$product->status ? 'selected' : ''}} value="0">
                                    下架
                                </option>
                            </select>
                        </span>
                        </div>
                    </div>

                    <div class="Add_p_s">
                        <label class="form-label col-2">
                            关联：
                        </label>
                        <div class="formControls col-2">
                        <span class="select-box">
                            <select id="group-number" class="select" name="group_number">

                            </select>
                        </span>
                        </div>
                    </div>
                </div>
                {{--<div class="clearfix cl">--}}
                    {{--<label class="form-label col-2">--}}
                        {{--关键词：--}}
                    {{--</label>--}}
                    {{--<div class="formControls col-10">--}}
                        {{--<input type="text" class="input-text" value="" placeholder=""  name="">--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="clearfix cl">
                    <label class="form-label col-2">
                        <span class="c-red">*</span>
                        图片上传：
                    </label>
                    <div class="formControls col-10">
                        <form enctype="multipart/form-data">
                            <!-- file input -->
                            <input type="file" name="file">

                        </form>
                        <input type="hidden" id="images1" name="image1" value="{{$product->image1}}">
                        <input type="hidden" id="images2" name="image2" value="{{$product->image2}}">
                        <input type="hidden" id="images3" name="image3" value="{{$product->image3}}">
                        <input type="hidden" id="images4" name="image4" value="{{$product->image4}}">
                        <input type="hidden" id="images5" name="image5" value="{{$product->image5}}">

                    </div>
                </div>
                <div class="clearfix cl" style="color:red;text-align: center">
                        注：商品图片最多只能上传五张，至少上传一张。第一张图片会作为商品的封面图，多张图片可以拖拽排序！
                </div>
                {{--<div class="clearfix cl">--}}
                    {{--<label class="form-label col-2">--}}
                        {{--详细内容：--}}
                    {{--</label>--}}
                    {{--<div class="formControls col-10">--}}

                        {{--<script id="editor" type="text/plain" style="width:100%;height:400px;"></script>--}}

                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="clearfix cl">--}}
                    {{--<label class="form-label col-2">--}}
                        {{--允许评论：--}}
                    {{--</label>--}}
                    {{--<div class="formControls col-2 skin-minimal">--}}
                        {{--<div class="check-box" style=" margin-top:9px">--}}
                            {{--<input type="checkbox" id="checkbox-1">--}}
                            {{--<label for="checkbox-1">--}}
                                {{--&nbsp;--}}
                            {{--</label>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="clearfix cl" style="text-align: center;margin-top: 20px">
                    <div class="Button_operation">
                        <button onclick="product_save_submit();" class="btn btn-primary radius"
                                type="button">
                            <i class="icon-save ">
                            </i>
                            提交
                        </button>
                        {{--<button onclick="article_save();" class="btn btn-secondary btn-warning"--}}
                                {{--type="button">--}}
                            {{--<i class="icon-save">--}}
                            {{--</i>--}}
                            {{--保存草稿--}}
                        {{--</button>--}}
                        <button onclick="product_close()" class="btn btn-default radius" type="button">
                            &nbsp;&nbsp;取消&nbsp;&nbsp;
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <input type="hidden" id="gnp" value="{{$product->group_number}}">
    <input type="hidden" id="pid" value="{{$product->id}}">
    <input type="hidden" id="ctn" value="{{$product->category->id}}">
@endsection