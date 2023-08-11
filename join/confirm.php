<?php
$recaptcha_site_key = "";
$recaptcha_secret_key = "";
//ランダムな文字列を生成
$random_string = sha1(uniqid(mt_rand(), true));

// フォームのボタンが押されたら
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // フォームから送信されたデータを各変数に格納
    $name = $_POST["name"];
    $furigana = $_POST["furigana"];
    $email = $_POST["email"];
    $twitterid = $_POST["twitterid"];
    $group = $_POST["group"];
    $active = $_POST["active"];
    if (isset($_POST["departments"]) && is_array($_POST["departments"])) {
        $checkbox = implode(", ", $_POST["departments"]);
    } elseif ($_POST["checkbox0"]) {
        $checkbox = $_POST["checkbox0"];
    } else {
        $checkbox = "なし";
    }
    $content = $_POST["content"];
    $ip = $_SERVER["REMOTE_ADDR"];
}

// 送信ボタンが押されたら
if (isset($_POST["go"])) {
    $token = isset($_POST["recaptchaToken"]) ? $_POST["recaptchaToken"] : null;
    $action = isset($_POST["recaptchaaction"])
        ? $_POST["recaptchaaction"]
        : null;
    if ($token && $action) {
        $ch = curl_init();
        curl_setopt(
            $ch,
            CURLOPT_URL,
            "https://www.google.com/recaptcha/api/siteverify"
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            http_build_query([
                "secret" => $recaptcha_secret_key,
                "response" => $token,
            ])
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $api_response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($api_response);
        if (
            $result->success &&
            $result->action === $action &&
            $result->score >= 0.5
        ) {
            // HTMLメールのテンプレート読み込み
            $client_template = "../templates/join-client.php";
            $host_template = "../templates/join-host.php";

            // 管理者宛
            $host = mb_convert_encoding(
                file_get_contents($host_template),
                "utf-8",
                "auto"
            );
            $host = str_replace(
                "<%NAME>",
                htmlspecialchars($name, ENT_QUOTES, "UTF-8"),
                $host
            );
            $host = str_replace(
                "<%FURIGANA>",
                htmlspecialchars($furigana, ENT_QUOTES, "UTF-8"),
                $host
            );
            $host = str_replace(
                "<%EMAIL>",
                htmlspecialchars($email, ENT_QUOTES, "UTF-8"),
                $host
            );
            $host = str_replace(
                "<%TWITTERID>",
                htmlspecialchars($twitterid, ENT_QUOTES, "UTF-8"),
                $host
            );
            $host = str_replace(
                "<%GROUP>",
                htmlspecialchars($group, ENT_QUOTES, "UTF-8"),
                $host
            );
            $host = str_replace(
                "<%ACTIVE>",
                htmlspecialchars($active, ENT_QUOTES, "UTF-8"),
                $host
            );
            $host = str_replace(
                "<%CHECKBOX>",
                htmlspecialchars($checkbox, ENT_QUOTES, "UTF-8"),
                $host
            );
            $host = str_replace(
                "<%CONTENT>",
                htmlspecialchars($content, ENT_QUOTES, "UTF-8"),
                $host
            );
            $host = str_replace(
                "<%IP>",
                htmlspecialchars($ip, ENT_QUOTES, "UTF-8"),
                $host
            );

            // 応募者宛
            $client = mb_convert_encoding(
                file_get_contents($client_template),
                "utf-8",
                "auto"
            );
            $client = str_replace(
                "<%NAME>",
                htmlspecialchars($name, ENT_QUOTES, "UTF-8"),
                $client
            );
            $client = str_replace(
                "<%FURIGANA>",
                htmlspecialchars($furigana, ENT_QUOTES, "UTF-8"),
                $client
            );
            $client = str_replace(
                "<%EMAIL>",
                htmlspecialchars($email, ENT_QUOTES, "UTF-8"),
                $client
            );
            $client = str_replace(
                "<%TWITTERID>",
                htmlspecialchars($twitterid, ENT_QUOTES, "UTF-8"),
                $client
            );
            $client = str_replace(
                "<%GROUP>",
                htmlspecialchars($group, ENT_QUOTES, "UTF-8"),
                $client
            );
            $client = str_replace(
                "<%ACTIVE>",
                htmlspecialchars($active, ENT_QUOTES, "UTF-8"),
                $client
            );
            $client = str_replace(
                "<%CHECKBOX>",
                htmlspecialchars($checkbox, ENT_QUOTES, "UTF-8"),
                $client
            );
            $client = str_replace(
                "<%CONTENT>",
                htmlspecialchars($content, ENT_QUOTES, "UTF-8"),
                $client
            );

            // 送信ボタンが押された時に動作
            mb_language("uni");
            mb_internal_encoding("UTF-8");

            // 件名を変数subjectに格納
            $subject = "【VCborn】応募内容の確認【自動送信】";

            // 送信元のメールアドレスを変数fromEmailに格納
            $fromEmail = "support@vcborn.com";

            // 送信元の名前を変数fromNameに格納
            $fromName = "VCborn";

            // ヘッダ情報を変数headerに格納する
            $header = "From: {$fromName} <{$fromEmail}>";
            $header .= "\r\n";
            $header .= "Content-type: text/html; charset=UTF-8";

            // メール送信を行う
            mb_send_mail($fromEmail, "応募フォーム", $host, $header);
            mb_send_mail($email, $subject, $client, $header);

            function send_to_discord($message)
            {
                $webhook_url = "https://discord.com/api/webhooks/";
                $options = [
                    "http" => [
                        "method" => "POST",
                        "header" => "Content-Type: application/json",
                        "content" => json_encode($message),
                    ],
                ];
                $response = file_get_contents(
                    $webhook_url,
                    false,
                    stream_context_create($options)
                );
                return $response === "ok";
            }
            //メッセージの内容を定義
            $message = [
                "username" => "応募フォーム",
                "content" => "",
                "embeds" => [
                    [
                        "title" => "新規応募",
                        "color" => 1455209,
                        "description" => "",
                        "timestamp" => "",
                        "author" => [
                            "name" => "",
                        ],
                        "image" => [],
                        "thumbnail" => [],
                        "footer" => [],
                        "fields" => [
                            [
                                "name" => "名前",
                                "value" => "{$name}({$furigana})",
                            ],
                            [
                                "name" => "メールアドレス",
                                "value" => "{$email}",
                            ],
                            [
                                "name" => "Twitter ID",
                                "value" => "{$twitterid}",
                            ],
                            [
                                "name" => "所属中のグループ",
                                "value" => "{$group}",
                            ],
                            [
                                "name" => "平均浮上日数（一週間）",
                                "value" => "{$active}",
                            ],
                            [
                                "name" => "入りたい部署",
                                "value" => "{$checkbox}",
                            ],
                            [
                                "name" => "一言",
                                "value" => "{$content}",
                            ],
                            [
                                "name" => "IPアドレス",
                                "value" => "{$ip}",
                            ],
                        ],
                    ],
                ],
            ];

            send_to_discord($message); //処理を実行
            // サンクスページに画面遷移させる
            header("Location: /join/thanks");
            exit();
        } else {
            header("Location: /join");
        }
    }
}

if (isset($_POST["name"])) { ?>
    <!DOCTYPE html>
    <html lang="ja">

    <head id="head">
        <!-- ページの内容 -->
        <title>確認 | VCborn</title>
        <meta name="description" content="VCborn公式サイト">

        <!-- OGPタグ用 -->
        <meta property="og:url" content="https://vcborn.com/join/confirm.php" />
        <meta property="og:title" content="確認 | VCborn" />
        <meta property="og:type" content="website">
        <meta property="og:description" content="VCborn公式サイト">
        <meta property="og:image" content="https://vcborn.com/images/jpg/ogp.jpg" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="@vcborn_support" />
        <meta property="og:site_name" content="VCborn" />
        <meta property="og:locale" content="ja_JP" />
        <meta charset="utf-8" />
        <script src="https://www.google.com/recaptcha/api.js?render=<?php echo $recaptcha_site_key; ?>"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <!-- GooogleAdsense -->
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1336300432888389" crossorigin="anonymous"></script>

        <!-- GoogleAnalytics-->
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-8GC99E31DE"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'G-8GC99E31DE');
        </script>

    </head>

    <body>
        <header id="header"></header>
        <main id="">
            <section id="h2-title">
                <div id="particles-js"></div>
                <h2><span>JOIN US</span><span>参加する</span></h2>
            </section>
            <section id="contents-check">
                <form action="confirm" method="post" id="rc_form">
                    <input type="hidden" name="name" value="<?php echo htmlspecialchars(
                        $name,
                        ENT_QUOTES
                    ); ?>">
                    <input type="hidden" name="furigana" value="<?php echo htmlspecialchars(
                        $furigana,
                        ENT_QUOTES
                    ); ?>">
                    <input type="hidden" name="email" value="<?php echo htmlspecialchars(
                        $email,
                        ENT_QUOTES
                    ); ?>">
                    <input type="hidden" name="twitterid" value="<?php echo htmlspecialchars(
                        $twitterid,
                        ENT_QUOTES
                    ); ?>">
                    <input type="hidden" name="group" value="<?php echo htmlspecialchars(
                        $group,
                        ENT_QUOTES
                    ); ?>">
                    <input type="hidden" name="active" value="<?php echo htmlspecialchars(
                        $active,
                        ENT_QUOTES
                    ); ?>">
                    <input type="hidden" name="checkbox0" value="<?php echo htmlspecialchars(
                        $checkbox,
                        ENT_QUOTES
                    ); ?>">
                    <input type="hidden" name="content" value="<?php echo htmlspecialchars(
                        $content,
                        ENT_QUOTES
                    ); ?>">
                    <input type="hidden" name="recaptchaToken" id="recaptchaToken" />
                    <input type="hidden" name="recaptchaaction" id="recaptchaaction" />
                    <input type="hidden" name="go" value="ok" />
                    <h3 class="contact-title">参加 内容確認</h3>
                    <p class="first-p">参加内容はこちらで宜しいでしょうか？<br>よろしければ「送信する」ボタンを押して下さい。</p>
                    <div class="contents-check-inner">
                        <div>
                            <label>お名前</label>
                            <p><?php echo htmlspecialchars(
                                $name,
                                ENT_QUOTES
                            ); ?></p>
                        </div>
                        <div>
                            <label>ふりがな</label>
                            <p><?php echo htmlspecialchars(
                                $furigana,
                                ENT_QUOTES
                            ); ?></p>
                        </div>
                        <div>
                            <label>メールアドレス</label>
                            <p><?php echo htmlspecialchars(
                                $email,
                                ENT_QUOTES
                            ); ?></p>
                        </div>
                        <div>
                            <label>TwitterID</label>
                            <p><?php echo htmlspecialchars(
                                $twitterid,
                                ENT_QUOTES
                            ); ?></p>
                        </div>
                        <div>
                            <label>所属中のグループ</label>
                            <p><?php echo htmlspecialchars(
                                $group,
                                ENT_QUOTES
                            ); ?></p>
                        </div>
                        <div>
                            <label>平均浮上日数（一週間）</label>
                            <p><?php echo htmlspecialchars(
                                $active,
                                ENT_QUOTES
                            ); ?></p>
                        </div>
                        <div>
                            <label>入りたい部署</label>
                            <p><?php echo htmlspecialchars(
                                $checkbox,
                                ENT_QUOTES
                            ); ?></p>
                        </div>
                        <div>
                            <label>できること</label>
                            <p><?php echo nl2br($content); ?></p>
                        </div>
                    </div>
                    <div class="buttons">
                        <input type="button" value="内容を修正する" onclick="history.back(-1)">
                        <button type="submit">送信する</button>
                    </div>
                </form>
                <script>
                    function clickBtn1() {
                        const arr1 = [];
                        const color1 = document.form1.color1;

                        for (let i = 0; i < color1.length; i++) {
                            if (color1[i].checked) { //(color1[i].checked === true)と同じ
                                arr1.push(color1[i].value);
                            }
                        }
                        document.getElementById("span1").textContent = arr1;
                    }
                    document.getElementById('rc_form').addEventListener('submit', onSubmit);

                    function onSubmit(e) {
                        e.preventDefault();
                        grecaptcha.ready(function() {
                            // サイトキーを設定する
                            grecaptcha.execute('<?php echo $recaptcha_site_key; ?>', {
                                action: '<?php echo $random_string; ?>'
                            }).then(function(token) {
                                var recaptchaToken = document.getElementById('recaptchaToken');
                                recaptchaToken.value = token;
                                var recaptchaaction = document.getElementById('recaptchaaction');
                                recaptchaaction.value = '<?php echo $random_string; ?>';
                                document.getElementById("rc_form").submit();
                            });
                        });
                    }
                </script>
            </section>
        </main>
        <footer id="footer"></footer>

        <!-- リンク読み込み -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tsparticles/1.33.3/tsparticles.slim.min.js"></script> <!-- particles.js -->
        <script src="/js/script.js"></script>
        <script src="/include.js"></script><!-- 共通化用 -->
    </body>

    </html>
<?php } else {header("Location: /join");} ?>
