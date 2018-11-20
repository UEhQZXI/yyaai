@extends('wap.public.index')
@section('plugin')
    xmlns:wb="http://open.weibo.com/wb"
@endsection
@section('title')
    商品详情
@endsection
@section('css')
    <script src="https://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="/css/wap/searchGood.css">
@endsection
@section('body-style')
    overflow:hidden;
@endsection
@section('content')
    <div class="Ty_mall">
        <div class="Ty_header">
            <a href="/" class="left"><span class="mui-icon mui-icon-arrowleft"></span></a>
            <span>商品详情</span>
            <div id="shares" style="position:absolute;right:0.2rem;top: 0;width: 50px;height: 100%;">
                <span class="mui-icon mui-icon-more"></span>
            </div>
            <!-- <a href="javascript:void(0)"  target="_blank" class="iconfont" style="color: #d7282a;position:absolute;right:0;left:8.6rem;width: 30px;font-size: 0.45rem;" id="shareBtn">&#xe669;</a> -->
        </div>
        <div class="Ty_main">
            <!--滚动容器的父盒子-->
            <div class="mui-scroll-wrapper">
                <!--子盒子-->
                <div class="mui-scroll">
              <!--这里放置真实显示的DOM内容-->

              </div>

            </div>
            <div class="share">
                <ul>
                    <li>
                        <span class="iconfont">&#xe605;</span>
                        <a href="/">首页</a>
                    </li>
                    <li>
                        <span class="iconfont">&#xe602;</span>
                        <a href="my">我的商城</a>
                    </li>
                    <li class="shareChose">
                        <span class="iconfont">&#xe659;</span>
                        <p>分享</p>
                    </li>
                </ul>
            </div>
            <div class="choose">
                <a href="javascript:void(0)" target="_blank" class="iconfont" style="color: #d7282a" id="shareBtn">&#xe660;</a>
                <a href="javascript:void(0)" target="_blank" class="iconfont">&#xe606;</a>
                <a href="javascript:void(0)" target="_blank" class="iconfont" style="color: #00a7ff;">&#xe603;</a>
                <a href="javascript:void(0)" target="_blank" class="iconfont" style="color: #09bb07;">&#xe604;</a>
            </div>
        </div>
        <div class="showlist" style="z-index: 999;bottom: -1000px;transition: all 0.5s linear;opacity: 0;">
               <!-- 模板 -->

          </div>
        <div class="Ty_footer">
            <a href="/cart"><span class="fa fa-shopping-cart"></span></a>
            <button class="mui-btn mui-btn-danger mui-pull-right add_car"style="margin-right:20px;">加入购物车</button>
            <button class="mui-btn mui-btn-warning mui-pull-right buy" style="margin-right:20px;">立即购买</button>
        </div>
        <!-- 阴影 -->
        <div class="ying"></div>

    </div>
@endsection
@section('script')

    <script>
        function weiboShare(){
            var wb_shareBtn = document.getElementById("shareBtn");
            wb_url = document.URL,
                wb_appkey = "694367508",
                wb_title = "",
                wb_pic = "",
                wb_language = "zh_cn";
            wb_shareBtn.setAttribute("href","http://service.weibo.com/share/share.php?url="+wb_url+"&appkey="+wb_appkey+"&title="+wb_title+"&pic="+wb_pic+"&language="+wb_language+"");
        }
        weiboShare();
    </script>

    <script type="text/html" id="tpl_good">
        @verbatim
            <div class="mui-slider">
                {{if pt.length>1}}
                    <div class="mui-slider-group mui-slider-loop">
                        <div class="mui-slider-item mui-slider-item-duplicate"><img src="{{pt[pt.length-1].picName}}" /></div>
                        {{each pt v i}}
                            <div class="mui-slider-item"><img src="{{v.picName}}"/></div>
                        {{/each}}
                        <div class="mui-slider-item mui-slider-item-duplicate"><img src="{{pt[0].picName}}" /></div>
                    </div>
                    <div class="mui-slider-indicator">
                        {{each pt v i}}
                            <div class="mui-indicator {{i == 0?'mui-active':''}}"></div>
                        {{/each}}
                    </div>
                {{/if}}
                {{elseif}}
                    <img src="{{pt[0].picName}}" alt="">
                {{/elseif}}
            </div>
            <div class="price" style="margin-top:0.2667rem;">
                <span style="color:red;font-size:0.5rem;margin-left:0.35rem;">&yen;{{data.current_price}}</span><br>
                <span style="margin-left:0.35rem;">价格：<span style="text-decoration:line-through;">&yen;{{data.original_price}}</span></span>
            </div>
            <p style="margin-left:0.35rem;color:#000;font-size:0.4rem;font-weight:600;margin-right:0.35rem;">{{data.title}}</p>
            <span style="margin-left:0.35rem;color:#aaa;">快递：0.00</span>
            <span style="margin-left:2.3rem;color:#aaa;">销量：{{data.inventory}}</span>
            <span class="pull-right" style="margin-right:0.35rem;color:#aaa;">上海</span>
            <p>{{data.description}}</p>
        @endverbatim
    </script>

    <script type="text/html" id="tpl_show">
        @verbatim
            {{if data.linked.length == 0}}
                <div style="margin-bottom:1.3rem;">
                    <img src="{{data.image1}}" alt="" style="width:2.1rem;height:2.1rem;margin-top:.35rem;margin-left:0.35rem;">
                    <span style="position:absolute;top:0.35rem;left:3.5rem;font-size:0.4rem;">价格:{{data.current_price}}</span>
                    <span style="position:absolute;top:1.3rem;left:3.5rem;font-size:0.4rem;">库存:{{data.inventory}}</span>
                </div>
                <div class="goods" style="margin-bottom:1.5rem;margin-left:0.35rem;">
                    <span class="title" data-id="{{data.id}}" style="">{{data.model}}</span>
                </div>
                <div class="lt_num mui-clearfix" style="margin-left:0.5333rem;font-size:0.4rem;">
                    <span style="display:inline-block;margin-top:0.21rem;"> 数量：</span>
                    <div class="mui-numbox" data-numbox-step="1" data-numbox-min="1" data-numbox-max="{{data.inventory}}" style="float:right;margin-right:0.5rem">
                        <button class="mui-btn mui-numbox-btn-minus" type="button">-</button>
                        <input class="mui-numbox-input" type="number"/>
                        <button class="mui-btn mui-numbox-btn-plus" type="button">+</button>
                    </div>
                </div>
                <span class="mui-icon mui-icon-closeempty"></span>
                <div class="Join">
                    <a href="/cart"><span class="fa fa-shopping-cart"></span></a>
                    <button class="mui-btn mui-btn-danger mui-pull-right add_car">加入购物车</button>
                    <button class="mui-btn mui-btn-warning mui-pull-right buy">立即购买</button>
                </div>
            {{/if}}
            {{if data.linked.length !== 0}}
                <div style="margin-bottom:1.3rem;">
                    <img src="{{data.image1}}" alt="" style="width:2.1rem;height:2.1rem;margin-top:.35rem;margin-left:0.35rem;" id="showImg">
                    <span style="position:absolute;top:0.35rem;left:3.5rem;font-size:0.4rem;" id="price">价格:{{data.current_price}}</span>
                    <span style="position:absolute;top:1.3rem;left:3.5rem;font-size:0.4rem;" id="invent">库存:{{data.inventory}}</span>
                </div>
                <div class="goods" style="margin-bottom:1.5rem;margin-left:0.5333rem;">
                    {{each data.linked v i}}
                        <span class="title" data-id="{{v.id}}" style="margin-right:0.2667rem"  data-src="{{v.image2}}"
                          data-price="{{v.current_price}}" data-inventory={{v.inventory}}>{{v.model}}</span>
                    {{/each}}
                    <span class="title" data-id="{{data.id}}" style="margin-right:0.2667rem"  data-src="{{data.image1}}"
                          data-price="{{data.current_price}}" data-inventory={{data.inventory}}>{{data.model}}</span>
                </div>
                <div class="lt_num mui-clearfix" style="margin-left:0.5333rem;font-size:0.4rem;">
                    <span style="display:inline-block;margin-top:0.21rem;"> 数量：</span>
                    <div class="mui-numbox" data-numbox-step="1" data-numbox-min="1" data-numbox-max="{{data.inventory}}" style="float:right;margin-right:0.5rem">
                        <button class="mui-btn mui-numbox-btn-minus" type="button">-</button>
                        <input class="mui-numbox-input" type="number"/>
                        <button class="mui-btn mui-numbox-btn-plus" type="button">+</button>
                    </div>
                </div>
                <span class="mui-icon mui-icon-closeempty"></span>
                <div class="Join">
                    <a href="/cart"><span class="fa fa-shopping-cart"></span></a>
                    <button class="mui-btn mui-btn-danger mui-pull-right add_car">加入购物车</button>
                    <button class="mui-btn mui-btn-warning mui-pull-right buy">立即购买</button>
                </div>
            {{/if}}
        @endverbatim
    </script>

    <script src="/js/wap/searchGood.js"></script>
@endsection