// 対応する言語のページに移動
const moveToLangPage = (lang) => {
  let currentUrl = location.pathname;
  let langUrl = "";
  const regex = new RegExp('\/[ce]n\/');
  if (regex.test(currentUrl)) {
    currentUrl = currentUrl.slice(3);
  }
  if (currentUrl == "/" || currentUrl == "/contact/" || currentUrl == "/join/") {
    currentUrl = "";
  }
  if (lang !== "ja") {
    langUrl = lang;
  }
  const destinationUrl = location.protocol + "//" + location.host + "/" + langUrl + currentUrl;
  window.location.href = destinationUrl;
}

document.addEventListener("DOMContentLoaded", function () {
  // head
  const head = document.head;

  let head_content =
    '<script async src="https://www.googletagmanager.com/gtag/js?id=G-8GC99E31DE"></script>' +
    '<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments)}gtag("js",new Date());gtag("config","G-8GC99E31DE")</script>' +
    '<meta http-equiv="X-UA-Compatible" content="IE=edge">' +
    '<meta name="viewport" content="width=device-width,initial-scale=1">' +
    '<link rel="icon" href="/images/vcborn.svg" type="image/svg+xml">' +
    '<link rel="stylesheet" href="/css/style.css">' +
    '<link rel="stylesheet" href="/css/responsive.css">' +
    '<link rel="preconnect" href="https://fonts.googleapis.com">' +
    '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' +
    '<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">' +
    '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">';

  head.insertAdjacentHTML("afterbegin", head_content);

  // header
  const header = document.getElementById("header");

  const header_content =
    '<div id="header-inner">' +
    "<h1>" +
    '<a href="/">' +
    '<img src="/images/vcborn-logo.svg" alt="VCborn">' +
    "</a>" +
    "</h1>" +
    "<ul>" +
    '<li><a href="/">Home</a></li>' +
    '<li><a href="/#about">About</a></li>' +
    '<li><a href="/#services">Services</a></li>' +
    '<li><a href="/news">News</a></li>' +
    '<li><a href="https://blog.vcborn.com">Blog</a></li>' +
    "</ul>" +
    "</div>";

  if (header) {
    header.innerHTML = header_content;
  }

  // footer
  const footer = document.getElementById("footer");

  const footer_content =
    '<div id="footer-inner">' +
    '<div id="footer-top">' +
    '<a href="/"><img src="/images/vcborn-logo.svg" alt="VCborn ロゴ"></a>' +
    '<div id="footer-sns">' +
    '<a href="https://twitter.com/vcborn_support" aria-label="Twitter" target="_blank" rel="noreferrer noopener"><img src="/images/svg/twitter-icon.svg" alt="Twitter"></a>' +
    '<a href="https://www.youtube.com/channel/UCTYGbx_XscPRPglh1xdflwQ" aria-label="Youtube" target="_blank" rel="noreferrer noopener"><img src="/images/svg/youtube-icon.svg" alt="Youtube"></a>' +
    '<a href="https://github.com/vcborn" aria-label="Github" target="_blank" rel="noreferrer noopener"><img src="/images/svg/github-icon.svg" alt="Github"></a>' +
    '<a href="https://honi.club/@vcborn_support" aria-label="Misskey" target="_blank" rel="noreferrer noopener"><picture><source srcset="/images/webp/misskey-icon.webp" type="image/webp"><img src="/images/jpg/misskey-icon.jpg" alt="Misskey"></picture></a>' +
    "</div>" +
    "</div>" +
    '<div id="footer-nav">' +
    "<ul>" +
    "<li>ABOUT</li>" +
    '<li><a href="/#about">VCbornとは</a></li>' +
    '<li><a href="/creators">所属クリエイター</a></li>' +
    '<li><a href="/join/">参加する</a></li>' +
    "</ul>" +
    "<ul>" +
    "<li>SERVICES</li>" +
    '<li><a href="/services/vclinux/">VCLinux</a></li>' +
    '<li><a href="/services/reamix/">Reamix</a></li>' +
    "</ul>" +
    "<ul>" +
    "<li>CONTACT</li>" +
    '<li><a href="https://support.vcborn.com/">お問い合わせ</a></li>' +
    '<li><a href="/presskit">プレスキット</a></li>' +
    "</ul>" +
    "<ul>" +
    "<li>LANGUAGE</li>" +
    '<li><a href=\'javascript:moveToLangPage("en")\'>English</a></li>' +
    '<li><a href=\'javascript:moveToLangPage("cn")\'>中文</a></li>' +
    '<li><a href=\'javascript:moveToLangPage("ja")\'>日本語</a></li>' +
    "</ul>" +
    "</div>" +
    "</div>" +
    '<div id="footer-last">' +
    "<ul>" +
    '<li><a href="/tos">利用規約</a></li>' +
    '<li><a href="/privacypolicy">プライバシーポリシー</a></li>' +
    '<li><a href="/sitepolicy">サイトポリシー</a></li>' +
    '<li>&copy; 2021 <a href="/">VCborn</a></li>' +
    "</ul>" +
    "</div>";

  if (footer) {
    footer.innerHTML = footer_content;
  }
});

// AdSense 遅延読み込み
// 一時的に無効化
/*
(function(window, document) {
  function main() {
    var ad = document.createElement('script');
    ad.async = true;
    ad.src = 'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1336300432888389';
	  ad.crossOrigin = "anonymous"
    var sc = document.getElementsByTagName('script')[0];
    sc.parentNode.insertBefore(ad, sc);
  }

  var lazyLoad = false;
  function onLazyLoad() {
    if (lazyLoad === false) {
      lazyLoad = true;
      window.removeEventListener('scroll', onLazyLoad);
      window.removeEventListener('mousemove', onLazyLoad);
      window.removeEventListener('mousedown', onLazyLoad);
      window.removeEventListener('touchstart', onLazyLoad);
      window.removeEventListener('keydown', onLazyLoad);
      main();
    }
  }
  window.addEventListener('scroll', onLazyLoad);
  window.addEventListener('mousemove', onLazyLoad);
  window.addEventListener('mousedown', onLazyLoad);
  window.addEventListener('touchstart', onLazyLoad);
  window.addEventListener('keydown', onLazyLoad);
  window.addEventListener('load', function() {
    if (window.pageYOffset) {
      onLazyLoad();
      window.setTimeout(onLazyLoad,3000)
    }
  });
})(window, document);
*/
