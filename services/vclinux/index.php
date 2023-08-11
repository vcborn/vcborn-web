<!DOCTYPE html>
<html lang="ja">

<head id="head">
  <!-- ページの内容 -->
  <title>VCLinux | VCborn</title>
  <meta name="description" content="一番優れたLinuxをあなたの手に" />

  <!-- OGPタグ用 -->
  <meta property="og:url" content="https://vcborn.com/services/vclinux/" />
  <meta property="og:title" content="VCLinux | VCborn" />
  <meta property="og:type" content="website" />
  <meta property="og:description" content="一番優れたLinuxをあなたの手に" />
  <meta property="og:image" content="https://vcborn.com/images/jpg/vclinuxdesk.jpg" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:site" content="@vcborn_support" />
  <meta property="og:site_name" content="VCborn" />
  <meta property="og:locale" content="ja_JP" />
  <meta charset="utf-8" />

  <!-- GooogleAdsense -->
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1336300432888389"
    crossorigin="anonymous"></script>

  <!-- GoogleAnalytics-->
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-8GC99E31DE"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() {
      dataLayer.push(arguments);
    }
    gtag("js", new Date());

    gtag("config", "G-8GC99E31DE");
  </script>
</head>

<body>
  <header id="header"></header>
  <section id="hero">
    <picture>
      <source srcset="/images/webp/vclinux_front.webp" type="image/webp" />
      <img src="/images/jpg/vclinux_front.jpg" alt="VCLinux Image" />
    </picture>
    <div class="contents left">
      <img src="/images/vclinux-logo.svg" alt="VCLinux ロゴ" />
      <p>一番優れたLinuxをあなたの手に</p>
      <a href="#download">
        Download
        <i class="fas fa-chevron-right"></i>
      </a>
    </div>
  </section>
  <main id="product">
    <section id="about">
      <div class="contents">
        <h2>What's VCLinux?</h2>
        <h3>VCLinuxとは？</h3>
        <p>
          VCLinuxとはVCbornが開発したカスタムLinuxです。
          <br />
          KDEneonをベースにカスタムし、日本人でも使いやすいようにしております。
          <br />
          Windows向けのソフト（AviUtlなど）の使用等ができます。（Beta1では標準搭載されておりません）
          <br />
          Beta1ではOnlyofficeの搭載はしておりません。代わりに日本語化されたLibreOffice・Braveを採用しております。
        </p>
      </div>
    </section>
    <section class="blue" id="features">
      <div class="contents">
        <h2>Features</h2>
        <h3>機能</h3>
        <div class="split">
          <div class="feature">
            <i class="fab fa-windows"></i>
            <h3>Windows用ソフトのサポート</h3>
            <p>
              Wineを使い文字化けなしでWindows向けソフトが使えます。(Beta1では不完全)
            </p>
          </div>
          <div class="feature">
            <i class="fas fa-globe"></i>
            <h3>新体感ブラウジング</h3>
            <p>独自ブラウザを採用。
              <!--後で書き足し-->
            </p>
          </div>
          <div class="feature">
            <i class="fas fa-terminal"></i>
            <h3>快適なプログラミングを</h3>
            <p>VCLinuxではテキストエディタにVSCodeを採用しております。</p>
          </div>
        </div>
      </div>
    </section>
    <section id="notes">
      <div class="contents">
        <h2>Important notes</h2>
        <h3>注意事項</h3>
        <ul>
          <li>動作が非常に不安定です</li>
          <li>
            sddmが正常に動作しないため
            <b>インストール時に自動ログインを有効</b>
            にしてください
          </li>
        </ul>
      </div>
    </section>
    <section class="blue" id="download">
      <div class="contents">
        <h2>Download</h2>
        <h3>ダウンロード</h3>
        <form name="selver" class="version">
          <select name="version" onchange="genUrl();">
            <option value="select">バージョンを選択...</option>
            <option value="beta1">Beta1</option>
          </select>
          <select name="mirror" onchange="genUrl();">
            <option value="select">ミラーを選択...</option>
            <option value="colorfulbox">ColorfulBox（メイン）</option>
            <option value="gdrive">Google Drive</option>
            <option value="onedrive">OneDrive</option>
            <option value="yoshis">yoshis.jp</option>
            <option value="cyberrex">cyberrex.jp</option>
          </select>
          <div class="agreement">
            <input type="checkbox" id="agree" onchange="genUrl();" />
            <label for="agree">
              <a href="/tos.html">利用規約</a>
              をよく読み、同意しました
            </label>
          </div>
        </form>
        <a class="button disabled" href="#" id="dllink" onclick="plusone();">
          Download
          <i class="fas fa-download"></i>
        </a>
      </div>
    </section>
    <section id="downloadnumber" style="min-height:auto">
      <div class="contents">
        <!--ここにDL数表示してほしい！-->
        <h2>Number of Downloads</h2>
        <h3>ダウンロード数</h3>
        <p id="dl_count" style="font-weight:bold;font-size:2rem"><?php 
          //ユーザー名, パスワード, ホスト, データベース名, テーブル名
          //ldzvsyxb_vc, vcborn@2021, localhost, ldzvsyxb_vc, VCL_DLCOUNT

          $pdo = new PDO('mysql:host=localhost;dbname=ldzvsyxb_vc', 'ldzvsyxb_vc', 'vcborn@2021');
          $sql = "SELECT * FROM VCL_DLCOUNT WHERE name = 'vclinux'";
          $stmt = $pdo->query($sql);
          foreach ($stmt as $row) {
              $count = $row['count'];
              echo $count;
          }         
           ?></p>
      </div>
    </section>
    <section class="blue" id="requirements">
      <div class="contents">
        <h2>Minimum Requirements</h2>
        <h3>最小要件</h3>
        <table>
          <tbody>
            <tr>
              <td>CPU</td>
              <td>Core 2 Duo以上</td>
            </tr>
            <tr>
              <td>RAM</td>
              <td>1GB(2GB以上推奨)</td>
            </tr>
            <tr>
              <td>DISK</td>
              <td>25GB以上</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
    <section id="support">
      <div class="contents">
        <h2>Support</h2>
        <h3>サポート</h3>
        <p>
          もしインストール方法を知りたい場合は
          <a href="/support/vclinux/how-to-install.html">こちら</a>
          をご覧ください。
          <br />
          その他不具合や問題点などありましたら、
          <a href="/contact/">お問い合わせ</a>
          からお問い合わせください。
        </p>
      </div>
    </section>
  </main>
  <footer id="footer"></footer>
  <script src="/js/script.js"></script>
  <script src="/include.js"></script>
  <!-- 共通化用 -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    function plusone(){
      $.ajax({
        url: "download.php",
        type: "get",
        data: {
          'name': 'vclinux'
        }
      });
    }


    function genUrl() {
      const download = document.getElementById("dllink");
      const agree = document.getElementById("agree");
      const version = document.selver.version;
      const versionValue = version.options[version.selectedIndex].value;
      const mirror = document.selver.mirror;
      const mirrorValue = mirror.options[mirror.selectedIndex].value;
      const url = {
        beta1: {
          colorfulbox: "https://vcborn.com/files/VCLinux/vclinux-beta1.zip",
          gdrive:
            "https://drive.google.com/file/d/1dFKyLVs6vmHUYpFZ6eno8Ga1hN3T5_hi/view?usp=sharing",
          onedrive:
            "https://pb82-my.sharepoint.com/personal/guriko2872_t_5tb_in/_layouts/15/onedrive.aspx?id=%2Fpersonal%2Fguriko2872%5Ft%5F5tb%5Fin%2FDocuments%2Fvclinux%2Fvclinux%2Dbeta1%2Ezip&parent=%2Fpersonal%2Fguriko2872%5Ft%5F5tb%5Fin%2FDocuments%2Fvclinux&originalPath=aHR0cHM6Ly9wYjgyLW15LnNoYXJlcG9pbnQuY29tLzp1Oi9nL3BlcnNvbmFsL2d1cmlrbzI4NzJfdF81dGJfaW4vRVZFNVJZMzJsZkJIdk1PQUEtdmE0NEFCSzdNUU5FZ2RFY3R2bElWcUx1UWlvUT9ydGltZT0tSkxaSU9DRDJVZw",
          yoshis: "https://mirror.yoshis.jp/vclinux/vclinux-beta1.zip",
          cyberrex:
            "https://mirror.cyberrex.jp/vclinux/beta1/VCLinux-beta1.iso",
        },
      };

      if (
        versionValue == "select" ||
        mirrorValue == "select" ||
        !agree.checked
      ) {
        download.classList.add("disabled");
        download.setAttribute("href", "#");
      } else {
        if (download.classList.contains("disabled")) {
          download.classList.remove("disabled");
        }
        download.setAttribute("href", url[versionValue][mirrorValue]);
      }
    }
  </script>

</html>