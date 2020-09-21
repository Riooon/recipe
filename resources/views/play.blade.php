<!doctype html>
<html ⚡>
  <head>
    <meta charset="utf-8">
    <title>Okome Mode</title>
    <link rel="canonical" href="pets.html">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-video"
        src="https://cdn.ampproject.org/v0/amp-video-0.1.js"></script>
    <script async custom-element="amp-story"
        src="https://cdn.ampproject.org/v0/amp-story-1.0.js"></script>
      <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
        <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400" rel="stylesheet">
    <style amp-custom>
      amp-story {
        font-family: 'Oswald',sans-serif;
        color: #fff;
      }
      amp-story-page {
        background-color: #000;
      }
      h1 {
        font-weight: bold;
        font-size: 50px;
        font-weight: bold;
        line-height: 1.174;
      }
      p {
        font-weight: bold;
        font-size: 1.5em;
        line-height: 1.5em;
        color: #fff;
      }
      q {
        font-weight: 300;
        font-size: 1.1em;
      }
      amp-story-grid-layer.bottom {
        align-content:end;
      }
      amp-story-grid-layer.noedge {
        padding: 0px;
      }
      amp-story-grid-layer.center-text {
        align-content: center;
      }
      .wrapper {
        display: grid;
        grid-template-columns: 50% 50%;
        grid-template-rows: 50% 50%;
      }
      .banner-text {
        text-align: center;
        background-color: #000;
        line-height: 2em;
      }
      amp-img {
        opacity: 0.8;
      }
      form input {
        border: none;
        margin: 30px 0;
        color: white;
        background: #c8bd00;
        border-radius: 30px;
        padding: 13px 70px;
        font-size: 17px;
        font-weight: bold;
      }
      .finish {
        text-align: center;
      }
    </style>
  </head>
  <body>
    <!-- Cover page -->
    <amp-story standalone
        title="Joy of Pets"
        publisher="AMP tutorials"
        publisher-logo-src="assets/AMP-Brand-White-Icon.svg"
        poster-portrait-src="assets/cover.jpg">

      <amp-story-page id="cover">
        <amp-story-grid-layer template="fill">
          <amp-img src="{{ asset('storage/img/'.$recipe->hd_img) }}"
              width="720" height="1280"
              layout="responsive">
          </amp-img>
        </amp-story-grid-layer>
        <amp-story-grid-layer template="vertical">
          <h1>{{ $recipe->title }}</h1>
        </amp-story-grid-layer>
      </amp-story-page>

      @for ($i = 0; $i < count($processes); $i++)
      <amp-story-page id="page{{$i+1}}">
        <amp-story-grid-layer template="fill">
          @if(!$processes[$i]->image==NULL)
            <amp-img src="{{ asset('storage/img/'.$processes[$i]->image) }}" width="720" height="1280" layout="responsive"></amp-img>
          @else
            <amp-img src="{{ asset('storage/img/'.$recipe->hd_img) }}" width="720" height="1280" layout="responsive"></amp-img>
          @endif
        </amp-story-grid-layer>
        <amp-story-grid-layer template="seconds">
          <p grid-area="lower-second">{{ $processes[$i]->text }}</p>
        </amp-story-grid-layer>
      </amp-story-page>
      @endfor

      <amp-story-page id="end">
        <amp-story-grid-layer template="fill">
          <amp-img src="{{ asset('storage/img/'.$recipe->hd_img) }}" width="720" height="1280" layout="responsive"></amp-img>
        </amp-story-grid-layer>
        <amp-story-grid-layer template="seconds">
          <form grid-area="ower-second" action="{{ url('recipe/'.$recipe->id) }}" method="get">
            <p class="finish">完成です！</p>
            <input type="submit" value="レシピを閉じる">
          </form>
        </amp-story-grid-layer>
      </amp-story-page>
      
      <!-- Bookend -->
      
      <amp-story-bookend layout=nodisplay>
      <script type="application/json">
        {
        "bookendVersion": "v1.0",
        "components": [
          {
            "type": "heading",
            "text": "リンク先"
          },
          {
            "type": "small",
            "title": "レシピを閉じる",
            "url": "{{ url('/recipe/'.$recipe->id)}}",
            "image": "{{ asset('storage/img/'.$recipe->hd_img) }}"
          },
          {
            "type": "small",
            "title": "ストックレシピ一覧",
            "url": "{{ url('/stock')}}",
            "image": "{{ asset('img/recipe_book.jpg') }}"
          },
          {
            "type": "small",
            "title": "トップに戻る",
            "url": "{{ url('/overview')}}",
            "image": "{{ asset('img/main_image.jpg') }}"
          }
        ],
        "shareProviders": [
          "twitter",
          "facebook"
        ]
      }
      </script>
      </amp-story-bookend>
    </amp-story>
  </body>
</html>
